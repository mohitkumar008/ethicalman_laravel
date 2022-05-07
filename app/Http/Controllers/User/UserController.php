<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result['data'] = Product::where('status', '1')->get();
        foreach ($result['data'] as $list) {
            $result['prod_attr'][$list->id] = DB::table('product_attr')
                ->where('pid', $list->id)
                ->get();
            // echo "<pre>";
            // print_r($result);
            // die();
        }
        return view('user.index', $result);
    }

    public function product(Request $request)
    {
        $result['product'] = Product::select('products.*', 'categories.category_name')
            ->leftJoin('categories', 'categories.id', '=', 'products.cid')
            ->where('products.status', '1')->get();
        foreach ($result['product'] as $list) {
            $result['prod_attr'][$list->id] = DB::table('product_attr')
                ->where('pid', $list->id)
                ->get();
            // echo "<pre>";
            // print_r($result);
            // die();
        }
        return view('user.product', $result);
    }

    public function product_info(Request $request, $slug)
    {
        $result['data'] = Product::where('slug', $slug)->get();

        foreach ($result['data'] as $list) {
            $result['product_attr'][$list->id] = DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where('pid', $list->id)
                ->get();
        }
        foreach ($result['data'] as $list) {
            $result['prod_img'][$list->id] = DB::table('product_images')
                ->where('pid', $list->id)
                ->get();
        }

        // echo "<pre>";
        // print_r($result['product_attr']);
        // die();
        return view('user/product_info', $result);
    }

    public function add_to_cart(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_LOGGEDIN');
            $usertype = "Customer";
        } else {
            $uid = getUserTempId();
            $usertype = "Guest";
        }

        $pid = $request->post('pid');
        $size = $request->post('size');
        $qty = $request->post('qty');

        $result = DB::table('product_attr')
            ->where('pid', $pid)
            ->where('size_id', $size)
            ->get();
        $pattrid = $result[0]->id;

        $check = DB::table('cart')
            ->where(['pid' => $pid])
            ->where(['pattrid' => $pattrid])
            ->where(['uid' => $uid])
            ->where(['usertype' => $usertype])
            ->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;
            $check = DB::table('cart')
                ->where(['id' => $update_id])
                ->update(['qty' => $qty]);
            $msg = "Updated";
        } else {
            $id = DB::table('cart')->insertGetId([
                'pid' => $pid,
                'pattrid' => $pattrid,
                'uid' => $uid,
                'usertype' => $usertype,
                'qty' => $qty
            ]);
            $msg = "Added";
        }
        return response()->json(json_encode($msg));
    }

    public function cart(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_LOGGEDIN');
            $usertype = "Customer";
        } else {
            $uid = getUserTempId();
            $usertype = "Guest";
        }

        $result['cart'] = DB::table('cart')
            ->where(['uid' => $uid])
            ->where(['usertype' => $usertype])
            ->leftJoin('products', 'cart.pid', '=', 'products.id')
            ->leftJoin('product_attr', 'cart.pattrid', '=', 'product_attr.id')
            ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
            ->select('cart.qty', 'products.name', 'products.image', 'sizes.size', 'product_attr.price')
            ->get();

        // prx($result);
        return view('user.cart', $result);
    }
}
