<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::all()->sortDesc();
        return view('admin/coupon', $result);
    }


    public function add(Request $request)
    {
        // echo '<pre>';
        // print_r($request->post());
        // die();
        $request->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons,code',
            'coupon_value' => 'required',
            'type' => 'required',
            'min_order_amount' => 'required',
            'is_one_time' => 'required',
        ]);

        $model = new Coupon();
        $model->title = $request->post('coupon_title');
        $model->code = $request->post('coupon_code');
        $model->value = $request->post('coupon_value');
        $model->type = $request->post('type');
        $model->min_order_amount = $request->post('min_order_amount');
        $model->is_one_time = $request->post('is_one_time');
        $model->status = '1';
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
        return view('admin/manage_coupon', $result);
    }

    public function update(Request $request)
    {
        $request->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons,code,' . $request->post('id'),
            'coupon_value' => 'required',
            'type' => 'required',
            'min_order_amount' => 'required',
            'is_one_time' => 'required',
        ]);

        $model = Coupon::find($request->post('coupon_id'));
        $model->title = $request->post('coupon_title');
        $model->code = $request->post('coupon_code');
        $model->value = $request->post('coupon_value');
        $model->type = $request->post('type');
        $model->min_order_amount = $request->post('min_order_amount');
        $model->is_one_time = $request->post('is_one_time');
        $model->save();
        return redirect('admin/coupon')->with('update_coupon_msg', "Coupon updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        return redirect('admin/coupon')->with('delete_coupon_msg', "Coupon deleted successfully!");
    }
}
