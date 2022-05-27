<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $result['data'] = Order::select('orders.*', 'orders.id as order_id', 'customers.id', 'customers.name', 'order_status.id', 'order_status.order_status')
            ->leftJoin('customers', 'orders.user_id', '=', 'customers.id')
            ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
            ->orderBy('orders.id', 'desc')
            ->get();

        // prx($result);

        return view('admin/order', $result);
    }

    public function order_details(Request $request, $id)
    {
        $result = getOrderDetails($id);
        // prx($result);

        $result['orderStatus'] = DB::table('order_status')->get();

        return view('admin/order-details', $result);
    }

    public function change_order_status(Request $request)
    {
        $order_id = $request->post('order_id');
        $order_status = $request->post('order_status');
        $result['user'] = DB::table('orders')->where(['id' => $order_id])->update(['order_status' => $order_status]);
        $result['getDetails'] = DB::table('orders')->where(['orders.id' => $order_id])
            ->leftJoin('customers', 'orders.user_id',  '=', 'customers.id')
            ->get();

        //Get order details
        $data = getOrderDetails($order_id);
        //Mail function starts
        $dataVar = $data;
        $userEmail = $result['getDetails'][0]->email;
        if ($data['productDetails'][0]->order_status == 'Completed') {
            $mailSubject = 'You order has been delivered successfully | The Ethical Man';
        } else {
            $mailSubject = 'Thank you for your order';
        }
        $template = 'order_placed_template';
        send_mail($dataVar, $userEmail, $mailSubject, $template);
        //Mail function ends

        return redirect('admin/order')->with('update_msg', 'Order updated successfully');
    }
}
