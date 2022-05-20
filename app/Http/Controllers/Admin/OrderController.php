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
        $result['data'] = Order::all();
        prx($result['data'][0]->user_id);
        $result['user'] = DB::table('customers')->where(['id' => $result['data'][0]->user_id])->get();

        return view('admin/order', $result);
    }
}
