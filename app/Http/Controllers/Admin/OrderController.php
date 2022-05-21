<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $result['data'] = Order::select('orders.*', 'orders.id as order_id', 'customers.id', 'customers.name', 'order_status.id', 'order_status.order_status')
            ->leftJoin('customers', 'orders.user_id', '=', 'customers.id')
            ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
            ->get();

        // prx($result);

        return view('admin/order', $result);
    }

    public function order_details(Request $request, $id)
    {
        $result['productDetails'] = DB::table('order_details')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('customers as customer', 'orders.user_id', '=', 'customer.id')
            ->leftJoin('customer_address as baddress', 'orders.billing_address_id', '=', 'baddress.id')
            ->leftJoin('customer_address as saddress', 'orders.shipping_address_id', '=', 'saddress.id')
            ->leftJoin('coupons', 'orders.coupon_id', '=', 'coupons.id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'product_attr.color_id', '=', 'colors.id')
            ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
            // ->leftJoin('payment_status', 'orders.payment_status', '=', 'payment_status.id')
            ->select('orders.*', 'orders.id as order_id', 'orders.created_at as order_date', 'orders.order_status as order_status_id', 'products.name as product_name', 'products.slug as product_slug', 'order_details.qty as totalqty', 'order_details.price as subtotal', 'sizes.size as size', 'colors.color as color', 'coupons.code as coupon_code', 'coupons.value as coupon_val', 'coupons.type as coupon_type', 'baddress.name as bname', 'baddress.address as baddress', 'baddress.city as bcity', 'baddress.state as bstate', 'baddress.zip as bzip', 'baddress.company as bcompany', 'baddress.gstin as bgstin',  'saddress.name as sname', 'saddress.address as saddress', 'saddress.city as scity', 'saddress.state as sstate', 'saddress.zip as szip', 'saddress.company as scompany', 'saddress.gstin as sgstin', 'customer.name', 'customer.email', 'customer.phone', 'order_status.order_status')
            ->where(['orders.id' => $id])
            ->orderBy('orders.id', 'desc')
            ->get();
        // prx($result);

        $result['orderStatus'] = DB::table('order_status')->get();

        return view('admin/order-details', $result);
    }

    public function change_order_status(Request $request)
    {
        $order_id = $request->post('order_id');
        $order_status = $request->post('order_status');
        $result['user'] = DB::table('orders')->where(['id' => $order_id])->update(['order_status' => $order_status]);

        return redirect('admin/order')->with('update_msg', 'Order updated successfully');
    }
}
