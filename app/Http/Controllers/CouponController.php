<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin/coupon', $result);
    }


    public function add(Request $request)
    {
        $request->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons,code',
            'coupon_value' => 'required',
        ]);

        $model = new Coupon();
        $model->title = $request->post('coupon_title');
        $model->code = $request->post('coupon_code');
        $model->value = $request->post('coupon_value');
        $model->save();
        return redirect('admin/coupon')->with('add_coupon_msg', "Coupon added successfully:)");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/manage_coupon');
    }

    public function edit(Request $request, $id)
    {
        $result['data'] = Coupon::where(['id' => $id])->get();
        return view('admin/manage_category', $result);
        // echo '<pre>';
        // print_r($result['data'][0]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'catname' => 'required',
            'catslug' => 'required|unique:categories,category_slug,' . $request->post('catid'),
        ]);

        $model = Coupon::find($request->post('catid'));
        $model->category_name = $request->post('catname');
        $model->category_slug = $request->post('catslug');
        $model->save();
        return redirect('admin/category')->with('update_cat_msg', "Category updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        return redirect('admin/category')->with('delete_cat_msg', "Category deleted successfully!");
    }
}
