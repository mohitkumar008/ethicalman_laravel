<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index()
    {
        $result['data'] = DB::table('ratings')
            ->leftJoin('products', 'ratings.pid', '=', 'products.id')
            ->leftJoin('customers', 'ratings.uid', '=', 'customers.id')
            ->select('ratings.*', 'products.name as product_name', 'customers.name as customer_name')
            ->get();

        // prx($result);

        return view('admin/review', $result);
    }

    public function change_review_status(Request $request, $status, $id)
    {
        if ($status == 'activate') {
            $changestatus = '1';
            $msg = "Review approved";
        }
        if ($status == 'deactivate') {
            $changestatus = '0';
            $msg = "Review not approved";
        }

        DB::table('ratings')->where('id', $id)->update(['status' => $changestatus]);

        return redirect('admin/review')->with('update_msg', $msg);
    }

    public function delete_review(Request $request, $id)
    {
        DB::table('ratings')->where('id', $id)->delete();

        return redirect('admin/review')->with('update_msg', 'Review deleted successfully');
    }
}
