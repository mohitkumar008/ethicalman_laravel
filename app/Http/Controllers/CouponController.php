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
        return view('admin/manage_coupon', $result);
    }

    public function update(Request $request)
    {
        $request->validate([
            'coupon_title' => 'required',
            'coupon_code' => 'required|unique:coupons,code,' . $request->post('coupon_code'),
            'coupon_value' => 'required',
        ]);

        $model = Coupon::find($request->post('coupon_id'));
        $model->title = $request->post('coupon_title');
        $model->code = $request->post('coupon_code');
        $model->value = $request->post('coupon_value');
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
