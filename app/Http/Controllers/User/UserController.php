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
            return view('user.my-account');
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
        $coupon = $request->post('coupon');
        $findCoupon = DB::table('coupons')
            ->where(['code' => $coupon])
            ->get();
        $discount_price = "";
        $title = "";
        $totalCartAmount = "";
        $coupon = "";
        if (isset($findCoupon[0])) {
            // prx($findCoupon);
            if ($findCoupon[0]->status == 1) {
                $value = $findCoupon[0]->value;
                $type = $findCoupon[0]->type;
                $coupon = $findCoupon[0]->code;
                $title = $findCoupon[0]->title;
                if ($findCoupon[0]->is_one_time == 1) {
                    $status = 'success';
                    $msg = 'Coupon code is for one time use only';
                } else {
                    $totalCartAmount = 0;
                    $getTotalCartItems = getTotalCartItems();
                    // prx($getTotalCartItems);
                    foreach ($getTotalCartItems as $list) {
                        $totalCartAmount += $list->price * $list->qty;
                    }
                    // die($totalCartAmount);
                    if ($findCoupon[0]->min_order_amount > 0) {
                        if ($totalCartAmount  >= $findCoupon[0]->min_order_amount) {
                            $status = 'success';
                            $msg = 'Coupon code applied successfully';
                        } else {

                            $status = 'error';
                            $msg = 'Order amount is not greater than minimum order amount so u can use that coupon';
                        }
                    } else {

                        $status = 'error';
                        $msg = 'No minimum order amount limit';
                    }
                }
            } else {

                $status = 'error';
                $msg = 'Coupon code deactivated';
            }
        } else {
            $status = 'error';
            $msg = 'Coupon code not found';
        }
        if($status == 'success') {
            if($type == 'Value'){
                $discount_price = $value;
                $totalCartAmount -= $discount_price;
            }elseif($type == 'Per'){
                $discount_price = ($value/100)*$totalCartAmount;
                $totalCartAmount -= $discount_price;
            }
        }

        return response()->json([
            'status'=>$status,
            'msg'=>$msg,
            'title'=>$title,
            'coupon'=>$coupon,
            'discount_price'=>$discount_price,
            'totalCartAmount' => $totalCartAmount
            ]);

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
            'status'=>'success',
            'msg'=>'Coupon Removed successfully',
            'totalCartAmount' => $totalCartAmount
            ]);

    }
}
