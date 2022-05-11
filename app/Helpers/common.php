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
