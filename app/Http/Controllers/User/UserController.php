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
}
