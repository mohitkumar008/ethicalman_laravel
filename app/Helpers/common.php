<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


function test()
{
    dd(":(");
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function getUserTempId()
{
    if (session()->has('USER_TEMP_ID') == '') {
        $rand = rand(111111111, 999999999);
        session()->put('USER_TEMP_ID', $rand);
        return $rand;
    } else {
        // return '1234';
        return session()->get('USER_TEMP_ID');
    }
}

function getTotalCartItems()
{
    if (session()->has('USER_ID')) {
        $uid = session()->get('USER_ID');
    } else {
        $uid = session()->get('USER_TEMP_ID');
    }
    $result['cart'] = DB::table('cart')
        ->where('uid', $uid)
        ->leftJoin('products', 'cart.pid', '=', 'products.id')
        ->leftJoin('product_attr', 'cart.pattrid', '=', 'product_attr.id')
        ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
        ->select('cart.id', 'cart.qty', 'products.name', 'products.image', 'sizes.size', 'product_attr.price', 'products.id as pid', 'product_attr.id as attrid')
        ->get();
    $result['totalCartAmount'] = 0;
    $result['totalCartCount'] = count($result['cart']);
    foreach ($result['cart'] as $list) {
        $result['totalCartAmount'] += $list->price * $list->qty;
    }

    return $result;
}

function apply_coupon($coupon)
{
    // $coupon = $request->post('coupon');
    $findCoupon = DB::table('coupons')
        ->where(['code' => $coupon])
        ->get();
    $discount_price = "";
    $title = "";
    $totalCartAmount = "";
    $coupon = "";
    $coupon_id = 0;
    if (isset($findCoupon[0])) {
        // prx($findCoupon);
        if ($findCoupon[0]->status == 1) {
            $value = $findCoupon[0]->value;
            $type = $findCoupon[0]->type;
            $coupon = $findCoupon[0]->code;
            $title = $findCoupon[0]->title;
            $coupon_id = $findCoupon[0]->id;
            if ($findCoupon[0]->is_one_time == 1) {
                $status = 'success';
                $msg = 'Coupon code is for one time use only';
            } else {
                $totalCartAmount = 0;
                $getTotalCartItems = getTotalCartItems();
                // prx($getTotalCartItems);
                foreach ($getTotalCartItems as $list) {
                    $totalCartAmount += $list->price * $list->qty;
                }
                // die($totalCartAmount);
                if ($findCoupon[0]->min_order_amount > 0) {
                    if ($totalCartAmount  >= $findCoupon[0]->min_order_amount) {
                        $status = 'success';
                        $msg = 'Coupon code applied successfully';
                    } else {

                        $status = 'error';
                        $msg = 'Total amount is less than Rs ' . $findCoupon[0]->min_order_amount;
                    }
                } else {

                    $status = 'error';
                    $msg = 'No minimum order amount limit';
                }
            }
        } else {

            $status = 'error';
            $msg = 'Coupon code deactivated';
        }
    } else {
        $status = 'error';
        $msg = 'Coupon code not found';
    }
    if ($status == 'success') {
        if ($type == 'Value') {
            $discount_price = $value;
            $totalCartAmount -= $discount_price;
        } elseif ($type == 'Per') {
            $discount_price = ($value / 100) * $totalCartAmount;
            $totalCartAmount -= $discount_price;
        }
    }

    return json_encode([
        'status' => $status,
        'msg' => $msg,
        'title' => $title,
        'coupon' => $coupon,
        'coupon_id' => $coupon_id,
        'discount_price' => $discount_price,
        'totalCartAmount' => $totalCartAmount
    ]);
}

function send_mail($dataVar, $userEmail, $mailSubject, $template)
{
    // Send verificaton mail
    // $data = $dataVar;
    // $user['to'] = $userEmail;
    // $user['subject'] = $mailSubject;
    // Mail::send('emailTemplate.' . $template, $data, function ($messages) use ($user) {
    //     $messages->to($user['to']);
    //     $messages->subject($user['subject']);
    // });
    return true;
}


function getOrderDetails($order_id)
{
    $result['productDetails'] = DB::table('order_details')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->leftJoin('customers as customer', 'orders.user_id', '=', 'customer.id')
        ->leftJoin('order_address as baddress', 'orders.billing_address_id', '=', 'baddress.id')
        ->leftJoin('order_address as saddress', 'orders.shipping_address_id', '=', 'saddress.id')
        ->leftJoin('coupons', 'orders.coupon_id', '=', 'coupons.id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
        ->leftJoin('colors', 'product_attr.color_id', '=', 'colors.id')
        ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
        ->select('orders.*', 'orders.id as order_id', 'orders.shipped as shipped_status', 'orders.created_at as order_date', 'products.name as product_name', 'products.slug as product_slug', 'order_details.qty as totalqty', 'order_details.price as subtotal', 'sizes.size as size', 'colors.color as color', 'coupons.code as coupon_code', 'coupons.value as coupon_val', 'coupons.type as coupon_type', 'baddress.name as bname', 'baddress.address as baddress', 'baddress.city as bcity', 'baddress.state as bstate', 'baddress.zip as bzip', 'baddress.company as bcompany', 'baddress.gstin as bgstin',  'saddress.name as sname', 'saddress.address as saddress', 'saddress.city as scity', 'saddress.state as sstate', 'saddress.zip as szip', 'saddress.company as scompany', 'saddress.gstin as sgstin', 'order_status.order_status as order_status', 'order_status.id as order_status_id', 'customer.name as cname', 'customer.email as cemail', 'customer.phone as cphone', 'product_attr.sku as product_sku')
        ->where(['orders.id' => $order_id])
        ->get();

    // prx($result);
    return $result;
}
