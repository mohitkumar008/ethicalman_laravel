<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    function shipOrder($id)
    {
        $orderInfo = getOrderDetails($id);
        // prx($orderInfo['productDetails'][0]->id);
        $productArr = json_decode(json_encode($orderInfo['productDetails']), true);

        $shipOrder['order_id'] = $productArr[0]['id'];
        $shipOrder['order_date'] = $productArr[0]['order_date'];
        $shipOrder['pickup_location'] = 'Primary';
        $shipOrder['channel_id'] = '2383903';
        $shipOrder['comment'] = 'The Ethical Man';
        $shipOrder['billing_customer_name'] = $productArr[0]['bname'];
        $shipOrder['billing_last_name'] = "";
        $shipOrder['billing_address'] = $productArr[0]['baddress'];
        $shipOrder['billing_address_2'] = "";
        $shipOrder['billing_city'] = $productArr[0]['bcity'];
        $shipOrder['billing_pincode'] = $productArr[0]['bzip'];
        $shipOrder['billing_state'] = $productArr[0]['bstate'];
        $shipOrder['billing_country'] = 'India';
        $shipOrder['billing_email'] = $productArr[0]['cemail'];
        $shipOrder['billing_phone'] = $productArr[0]['cphone'];
        $shipOrder['shipping_is_billing'] = false;
        $shipOrder['shipping_customer_name'] = $productArr[0]['sname'];
        $shipOrder['shipping_last_name'] = '';
        $shipOrder['shipping_address'] = $productArr[0]['saddress'];
        $shipOrder['shipping_address_2'] = '';
        $shipOrder['shipping_city'] = $productArr[0]['scity'];
        $shipOrder['shipping_pincode'] = $productArr[0]['szip'];
        $shipOrder['shipping_country'] = 'India';
        $shipOrder['shipping_state'] = $productArr[0]['sstate'];
        $shipOrder['shipping_email'] = $productArr[0]['cemail'];
        $shipOrder['shipping_phone'] = $productArr[0]['cphone'];
        // prx($productArr);
        foreach ($productArr as $key => $item) {
            $shipOrder['order_items'][$key]['name'] = $item['product_name'];
            $shipOrder['order_items'][$key]['sku'] = $item['product_sku'];
            $shipOrder['order_items'][$key]['units'] = $item['totalqty'];
            $shipOrder['order_items'][$key]['selling_price'] = $item['subtotal'];
            $shipOrder['order_items'][$key]['discount'] = '';
            $shipOrder['order_items'][$key]['tax'] = '';
            $shipOrder['order_items'][$key]['hsn'] = '';
        }
        if ($orderInfo['productDetails'][0]->payment_type == 'COD') {
            $payment_method = 'COD';
        } else {
            $payment_method = 'Prepaid';
        }
        $shipOrder['payment_method'] = $payment_method;
        $shipOrder['shipping_charges'] = 0;
        $shipOrder['giftwrap_charges'] = 0;
        $shipOrder['transaction_charges'] = 0;
        $shipOrder['total_discount'] = 0;
        $shipOrder['sub_total'] = $orderInfo['productDetails'][0]->total_amount;
        $shipOrder['length'] = 1;
        $shipOrder['breadth'] = 1;
        $shipOrder['height'] = 1;
        $shipOrder['weight'] = 1;

        // prx($shipOrder);
        $shipOrder = json_encode($shipOrder);

        //Generate access token
        $c = curl_init();
        $url = "https://apiv2.shiprocket.in/v1/external/auth/login";
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, "email=mohit.itechverse@gmail.com&password=Mohit@123");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $server_output = curl_exec($c);
        curl_close($c);
        $server_output = json_decode($server_output, true);
        // prx($server_output);

        // Create order in shiprocket
        $url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $shipOrder);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $server_output['token'] . ''));
        $result = curl_exec($c);
        curl_close($c);

        $getShipmentResponse = json_decode($result, true);
        // prx($getShipmentResponse['order_id']);
        if ($getShipmentResponse['status_code'] == 1) {
            DB::table('orders')->where(['id' => $id])->update(['shipped' => 1]);
            return redirect('admin/order/order-details/' . $id)->with('shipment_status', 'Order sent to shiprocket successfully');
        } else {
            return redirect('admin/order/order-details/' . $id)->with('shipment_status', 'Something went wrong. Please try again later');
        }
    }
}
