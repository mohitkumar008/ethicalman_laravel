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
            $result['prod_attr'] = DB::table('product_attr')
                ->where('pid', $list->id)
                ->get();
            // echo "<pre>";
            // print_r($result['prod_attr']);
        }
        // die();
        return view('user.index', $result);
    }
}
