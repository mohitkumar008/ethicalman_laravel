<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data'] = Customer::all();
        return view('admin/customer', $result);
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

        $model = new Customer();
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
        return view('admin/manage_customer');
    }

    public function edit(Request $request, $id)
    {
        $result['data'] = Customer::where(['id' => $id])->get();
        return view('admin/manage_customer', $result);
    }

    public function update(Request $request)
    {
        $request->validate([
            'cname' => 'required',
            'cemail' => 'required|unique:customers,email,' . $request->post('customer_id'),
            'cphone' => 'required',
            'caddress' => 'required',
            'ccity' => 'required',
            'cstate' => 'required',
            'czip' => 'required',
        ]);

        $model = Customer::find($request->post('customer_id'));
        $model->name = $request->post('cname');
        $model->email = $request->post('cemail');
        $model->phone = $request->post('cphone');
        $model->address = $request->post('caddress');
        $model->city = $request->post('ccity');
        $model->state = $request->post('cstate');
        $model->zip = $request->post('czip');
        $model->company = $request->post('ccompany');
        $model->gstin = $request->post('cgstin');
        $model->save();
        return redirect('admin/customer')->with('update_msg', "Customer updated successfully:)");
    }


    public function delete(Request $request, $id)
    {
        $model = Customer::find($id);
        $model->delete();
        return redirect('admin/customer')->with('delete_msg', "Customer deleted successfully!");
    }

    public function status(Request $request, $type, $id)
    {
        if ($type == 'activate') {
            $model = Customer::find($id);
            $model->status = '1';
            $model->save();
            return redirect('admin/customer')->with('activate_msg', "Customer activated successfully!");
        } elseif ($type == 'deactivate') {
            $model = Customer::find($id);
            $model->status = '0';
            $model->save();
            return redirect('admin/customer')->with('deactivate_msg', "Customer deactivated successfully!");
        }
    }
}
