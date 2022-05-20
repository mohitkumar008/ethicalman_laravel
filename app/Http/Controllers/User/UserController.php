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
            $result['billingAddress'] = DB::table('customer_address')
                ->where(['uid' => $uid, 'address_id' => 1])
                ->get();
            $result['shippingAddress'] = DB::table('customer_address')
                ->where(['uid' => $uid, 'address_id' => 2])
                ->get();
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
        if ($request->session()->has('USER_LOGGEDIN')) {
            $uid = $request->session()->get('USER_ID');
        } else {
            $uid = getUserTempId();
        }

        $result['cartData'] = getTotalCartItems();
        $result['billingAddress'] = DB::table('customer_address')
            ->where(['uid' => $uid, 'address_id' => 1])
            ->get();
        $result['shippingAddress'] = DB::table('customer_address')
            ->where(['uid' => $uid, 'address_id' => 2])
            ->get();
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
            $userinfo = DB::table('customers')
                ->where(['id' => $uid])
                ->get();

            // prx($userinfo);
            $user_name = $userinfo[0]->name;
            $user_email = $userinfo[0]->email;
            $user_phone = $userinfo[0]->phone;

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

            $findBillingAddress = DB::table('customer_address')
                ->where(['uid' => $uid, 'address_id' => 1])
                ->get();

            $findShippingAddress = DB::table('customer_address')
                ->where(['uid' => $uid, 'address_id' => 2])
                ->get();

            if (!isset($findBillingAddress[0])) {
                DB::table('customer_address')->insertGetId([
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
            }
            $billing_address_id = DB::table('order_address')->insertGetId([
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

            if (!isset($findShippingAddress[0])) {
                DB::table('customer_address')->insertGetId([
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
            }
            $shipping_address_id = DB::table('order_address')->insertGetId([
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

            $payment_id = 'TEM' . rand(111111111, 999999999);
            $order_id = DB::table('orders')->insertGetId([
                'user_id' => $uid,
                'billing_address_id' => $billing_address_id,
                'shipping_address_id' => $shipping_address_id,
                'coupon_id' => $coupon_id,
                'order_status' => 1,
                'payment_type' => $payment_type,
                'payment_status' => 1,
                'payment_id' => $payment_id,
                'total_amount' => $totalCartAmount,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            ]);

            if ($order_id > 0) {
                foreach ($getTotalCartItems as $list) {
                    $getTotalCartItemsArr['order_id'] = $order_id;
                    $getTotalCartItemsArr['product_id'] = $list->pid;
                    $getTotalCartItemsArr['product_attr_id'] = $list->attrid;
                    $getTotalCartItemsArr['price'] = $list->price * $list->qty;
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
            'msg' => $msg,
            'user_id' => $uid,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_phone' => $user_phone,
            'order_id' => $order_id,
            'payment_type' => $payment_type,
            'totalCartAmount' => $totalCartAmount
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


    public function payment_success(Request $request)
    {
        if ($request->session()->has('ORDER_ID') && $request->session()->has('USER_ID')) {
            $user_id = $request->post('user_id');
            $order_id = $request->post('order_id');
            $payment_id = $request->post('payment_id');
            $payment_type = $request->post('payment_type');

            if ($payment_type == 'Gateway') {

                DB::table('orders')
                    ->where(['id' => $order_id, 'user_id' => $user_id])
                    ->update(['payment_status' => 3, 'payment_id' => $payment_id]);

                $status = "success";
                $msg = "Order placed successfully";
            } else {
                $status = "error";
                $msg = "Someting went wrong";
            }

            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ]);
            // return redirect('order_placed');
        } else {
            return redirect('/');
        }
    }

    public function update_address(Request $request)
    {
        if ($request->session()->has('USER_ID')) {

            $uid = $request->session()->get('USER_ID');
            $address_type = $request->post('address-type');
            if ($address_type == 'Billing') {
                $updateAddArr = [
                    'name' => $request->post('b-name'),
                    'address' => $request->post('b-address'),
                    'city' => $request->post('b-city'),
                    'state' => $request->post('b-state'),
                    'zip' => $request->post('b-pin'),
                    'company' => $request->post('b-company'),
                    'gstin' => $request->post('b-gstin'),
                    'updated_at' => date("Y-m-d h:i:s")
                ];

                $result = DB::table('order_address')
                    ->where(['uid' => $uid, 'address_id' => 1])
                    ->limit(1)
                    ->update($updateAddArr);

                $msg =  'Billing address updated successfully';
            }
            // Shipping Address
            elseif ($address_type == 'Shipping') {
                $updateAddArr = [
                    'name' => $request->post('s-name'),
                    'address' => $request->post('s-address'),
                    'city' => $request->post('s-city'),
                    'state' => $request->post('s-state'),
                    'zip' => $request->post('s-pin'),
                    'company' => $request->post('s-comapny'),
                    'gstin' => $request->post('s-gstin'),
                    'updated_at' => date("Y-m-d h:i:s")
                ];

                $result = DB::table('order_address')
                    ->where(['uid' => $uid, 'address_id' => 2])
                    ->limit(1)
                    ->update($updateAddArr);

                $msg =  'Shipping address updated successfully';
            }

            return redirect('/my-account')->with('address_msg', $msg);
        } else {
            return redirect('/');
        }
    }

    public function update_account_info(Request $request)
    {
        if ($request->session()->has('USER_ID')) {

            $uid = $request->session()->get('USER_ID');

            $accname = $request->post('accname');
            $currpassword = $request->post('currpassword');
            $newpassword = $request->post('newpassword');
            $newcpassword = $request->post('newcpassword');

            if ($accname != "") {
                $result = DB::table('customers')
                    ->where(['id' => $uid])
                    ->update(['name' => $accname]);
                if ($result) {
                    $msg =  'Changes saved successfully';
                }
                if ($currpassword != "" && $newpassword != "" && $newcpassword != "") {
                    $userifnfo = Customer::where(['id' => $uid])->first();

                    if ($userifnfo) {
                        if (Hash::check($currpassword, $userifnfo->password)) {
                            if ($newpassword === $newcpassword) {
                                $userifnfo->password = Hash::make($newpassword);
                                $userifnfo->save();
                                $msg =  'Password saved successfully';
                            } else {
                                $msg =  'New Password and Confirm Password not match';
                            }
                        } else {
                            $msg =  'Please enter correct current password';
                        }
                    }
                }
            } else {
                $msg =  '*Full Name is required';
            }

            return redirect('/my-account')->with('address_msg', $msg);
        } else {
            return redirect('/');
        }
    }

    public function order_details(Request $request, $id)
    {
        $result['productDetails'] = DB::table('order_details')
            ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('customer_address as baddress', 'orders.billing_address_id', '=', 'baddress.id')
            ->leftJoin('customer_address as saddress', 'orders.shipping_address_id', '=', 'saddress.id')
            ->leftJoin('coupons', 'orders.coupon_id', '=', 'coupons.id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('sizes', 'product_attr.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'product_attr.color_id', '=', 'colors.id')
            // ->leftJoin('customer_address', 'orders.billing_address_id', '=', 'customer_address.id')
            // ->leftJoin('customer_address', 'orders.shipping_address_id', '=', 'customer_address.id')
            // ->leftJoin('order_status', 'orders.order_status', '=', 'order_status.id')
            // ->leftJoin('payment_status', 'orders.payment_status', '=', 'payment_status.id')
            ->select('orders.*', 'orders.id as order_id', 'orders.created_at as order_date', 'products.name as product_name', 'products.slug as product_slug', 'order_details.qty as totalqty', 'order_details.price as subtotal', 'sizes.size as size', 'colors.color as color', 'coupons.code as coupon_code', 'coupons.value as coupon_val', 'coupons.type as coupon_type', 'baddress.name as bname', 'baddress.address as baddress', 'baddress.city as bcity', 'baddress.state as bstate', 'baddress.zip as bzip', 'baddress.company as bcompany', 'baddress.gstin as bgstin',  'saddress.name as sname', 'saddress.address as saddress', 'saddress.city as scity', 'saddress.state as sstate', 'saddress.zip as szip', 'saddress.company as scompany', 'saddress.gstin as sgstin',)
            ->where(['orders.id' => $id])
            ->get();

        // prx($result);
        return view('user.order-details', $result);
    }
}
