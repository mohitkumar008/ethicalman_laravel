<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Admin\Customer;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            $uid = $request->session()->get('USER_ID');
            $usertype = "Customer";
        } else {
            $uid = getUserTempId();
            $usertype = "Guest";
            // die($uid);
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
                ->update(['qty' => $qty, 'updated_at' => date("Y-m-d h:i:s")]);
            $msg = "Updated";
        } else {
            $id = DB::table('cart')->insertGetId([
                'pid' => $pid,
                'pattrid' => $pattrid,
                'uid' => $uid,
                'usertype' => $usertype,
                'qty' => $qty,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);
            $msg = "Added";
        }
        return response()->json(json_encode($msg));
    }

    public function cart(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_ID');
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
            ->select('cart.id', 'cart.qty', 'products.name', 'products.image', 'sizes.size', 'product_attr.price', 'products.id as pid', 'product_attr.id as attrid')
            ->get();

        // prx($result);
        return view('user.cart', $result);
    }

    public function update_cart(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_LOGGEDIN');
            $usertype = "Customer";
        } else {
            $uid = getUserTempId();
            $usertype = "Guest";
        }

        $result['cart'] = DB::table('cart')
            ->where(['pattrid' => $request->post('aid')])
            ->where(['pid' => $request->post('pid')])
            ->update(['qty' => $request->post('qty'), 'updated_at' => date("Y-m-d h:i:s")]);

        return view('user.cart');
    }

    public function remove_item_from_cart(Request $request, $id)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_LOGGEDIN');
            $usertype = "Customer";
        } else {
            $uid = getUserTempId();
            $usertype = "Guest";
        }

        $result['cart'] = DB::table('cart')
            ->where(['id' => $id])
            ->delete();

        return redirect('cart');
    }

    public function user_account(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_ID');
            $result['userinfo'] = DB::table('customers')
                ->where(['id' => $uid])
                ->get();
            $result['orders'] = DB::table('orders')
                ->where(['user_id' => $uid])
                ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
                ->select('orders.id as order_id', 'orders.total_amount', 'orders.created_at', 'order_status.order_status')
                ->get();
            foreach ($result['orders'] as $list) {
                $result['orders_detail'][$list->order_id] = DB::table('order_details')
                    ->where(['order_id' => $list->order_id])
                    ->get();
            }
            // prx($result);
            return view('user.my-account', $result);
        } else {
            return view('user.login-register');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:customers,email',
            'password' => 'required',
            'phone' => 'required',
        ]);

        $rand_id = rand(111111111, 999999999);
        $model = new Customer();
        $model->name = $request->post('username');
        $model->email = $request->post('email');
        $model->phone = $request->post('phone');
        $model->password = Hash::make($request->post('password'));
        $model->status = '1';
        $model->rand_id = $rand_id;
        $model->save();

        // Send verificaton mail
        $data = ['name' => $request->post('username'), 'rand_id' => $rand_id];
        $user['to'] = $request->post('email');
        Mail::send('user/email_verification', $data, function ($messages) use ($user) {
            $messages->to($user['to']);
            $messages->subject('Email Verification | The Ethical Man');
        });

        return redirect('my-account')->with('register_msg', "Account created successfully. Please login to continue...");
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required',
            'login_password' => 'required',
        ]);

        $email = $request->post('login_email');
        $password = $request->post('login_password');

        $result = Customer::where(['email' => $email, 'status' => 1])->first();

        if ($result) {
            if (Hash::check($password, $result->password)) {
                $request->session()->put('USER_LOGGEDIN', 'ture');
                $request->session()->put('USER_ID', $result->id);

                $uid = getUserTempId();
                DB::table('cart')
                    ->where(['uid' => $uid])
                    ->where(['usertype' => 'Guest'])
                    ->update(['uid' => $result->id, 'usertype' => 'Customer']);

                return redirect()->back();
            } else {
                return redirect()->back()->with('login_error', '*Incorrect Password!');
            }
        } else {
            return redirect()->back()->with('login_error', '*Email address not found!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('USER_LOGGEDIN');
        $request->session()->forget('USER_ID');
        $request->session()->forget('USER_TEMP_ID');
        return redirect('my-account')->with('logout_msg', 'Logout successfully:)');
    }

    public function verify_email(Request $request, $id)
    {

        $result = DB::table('customers')
            ->where(['rand_id' => $id])
            ->update(['is_verify' => '1']);

        return redirect('my-account')->with('verify_msg', 'Email verified successfully :)');
    }

    public function checkout(Request $request)
    {
        $result['cartData'] = getTotalCartItems();
        // prx($result);
        if (isset($result['cartData'][0])) {
            return view('user.checkout', $result);
        } else {
            return redirect('/');
        }
    }

    public function apply_coupon(Request $request)
    {
        $coupon = apply_coupon($request->post('coupon'));
        return json_decode($coupon, true);
    }

    public function remove_coupon(Request $request)
    {
        $coupon = $request->post('coupon');
        $findCoupon = DB::table('coupons')
            ->where(['code' => $coupon])
            ->get();

        $totalCartAmount = 0;
        $getTotalCartItems = getTotalCartItems();
        foreach ($getTotalCartItems as $list) {
            $totalCartAmount += $list->price * $list->qty;
        }
        // die($totalCartAmount);

        return response()->json([
            'status' => 'success',
            'msg' => 'Coupon Removed successfully',
            'totalCartAmount' => $totalCartAmount
        ]);
    }

    public function place_order(Request $request)
    {
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_ID');
            $usertype = "Customer";

            $totalCartAmount = 0;
            $coupon_id = 0;
            $getTotalCartItems = getTotalCartItems();
            // prx($getTotalCartItems);
            foreach ($getTotalCartItems as $list) {
                $totalCartAmount += $list->price * $list->qty;
            }
            if ($request->post('coupon_code') != "") {
                $coupon = apply_coupon($request->post('coupon_code'));
                $coupon_data = json_decode($coupon, true);
                if ($coupon_data['status'] == 'success') {
                    $totalCartAmount = $coupon_data['totalCartAmount'];
                    $coupon_id = $coupon_data['coupon_id'];
                }
            }

            $b_name = $request->post('b-name');
            $b_address = $request->post('b-address');
            $b_city = $request->post('b-city');
            $b_state = $request->post('b-state');
            $b_pin = $request->post('b-pin');
            $b_company = $request->post('b-company');
            $b_gstin = $request->post('b-gstin');
            $s_name = $request->post('s-name');
            $s_address = $request->post('s-address');
            $s_city = $request->post('s-city');
            $s_state = $request->post('s-state');
            $s_pin = $request->post('s-pin');
            $s_company = $request->post('s-company');
            $s_gstin = $request->post('s-gstin');
            $payment_type = $request->post('payment_method');

            if ($s_name == "" || $s_address == "" || $s_city == "" || $s_state == "" || $s_pin == "") {
                $s_name = $b_name;
                $s_address = $b_address;
                $s_city = $b_city;
                $s_state = $b_state;
                $s_pin = $b_pin;
                $s_company = $b_company;
                $s_gstin = $b_gstin;
            }


            $billing_address_id = DB::table('customer_address')->insertGetId([
                'uid' => $uid,
                'address_id' => 1,
                'name' => $b_name,
                'address' => $b_address,
                'city' => $b_city,
                'state' => $b_state,
                'zip' => $b_pin,
                'company' => $b_company,
                'gstin' => $b_gstin,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            $shipping_address_id = DB::table('customer_address')->insertGetId([
                'uid' => $uid,
                'address_id' => 2,
                'name' => $s_name,
                'address' => $s_address,
                'city' => $s_city,
                'state' => $s_state,
                'zip' => $s_pin,
                'company' => $s_company,
                'gstin' => $s_gstin,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            $order_id = DB::table('orders')->insertGetId([
                'user_id' => $uid,
                'billing_address_id' => $billing_address_id,
                'shipping_address_id' => $shipping_address_id,
                'coupon_id' => $coupon_id,
                'order_status' => 1,
                'payment_type' => $payment_type,
                'payment_status' => 1,
                'payment_id' => 'TEM' . rand(111111111, 999999999),
                'total_amount' => $totalCartAmount,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            if ($order_id > 0) {
                foreach ($getTotalCartItems as $list) {
                    $getTotalCartItemsArr['order_id'] = $order_id;
                    $getTotalCartItemsArr['product_id'] = $list->pid;
                    $getTotalCartItemsArr['product_attr_id'] = $list->attrid;
                    $getTotalCartItemsArr['price'] = $list->price;
                    $getTotalCartItemsArr['qty'] = $list->qty;
                    $getTotalCartItemsArr['created_at'] = date("Y-m-d h:i:s");
                    $getTotalCartItemsArr['updated_at'] = date("Y-m-d h:i:s");
                    DB::table('order_details')->insert($getTotalCartItemsArr);
                }

                DB::table('cart')->where(['uid' => $uid, 'usertype' => 'Customer'])->delete();

                $request->session()->put('ORDER_ID', $order_id);

                $status = "success";
                $msg = "Order placed successfully";
            } else {
                $status = "error";
                $msg = "Please try after sometime!";
            }
        } else {
            // Guest Checkout
        }

        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);
    }


    public function order_placed(Request $request)
    {
        if ($request->session()->has('ORDER_ID')) {
            return view('user.order-placed');
        } else {
            return redirect('/');
        }
    }
}
