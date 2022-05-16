<?php

use Illuminate\Support\Facades\DB;

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
    $result = DB::table('cart')
        ->where('uid', $uid)
        ->leftJoin('products', 'cart.pid', '=', 'products.id')
        ->leftJoin('product_attr', 'cart.pattrid', '=', 'product_attr.id')
        ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
        ->select('cart.id', 'cart.qty', 'products.name', 'products.image', 'sizes.size', 'product_attr.price', 'products.id as pid', 'product_attr.id as attrid')
        ->get();

    return $result;
}

function test()
{
    dd(":(");
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
