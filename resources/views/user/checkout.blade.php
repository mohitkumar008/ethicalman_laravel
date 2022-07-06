@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="{{ asset('user_assets/assets/js/jquery.min.js') }}"></script>
@endsection

@section('content-wrapper')
    <section class="cart py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h2 class="fs-3">
                            Checkout
                        </h2>
                    </div>
                    @if (session('login_error'))
                        <p class="text-danger">{{ session('login_error') }}</p>
                    @endif
                    <p class="text-danger m-0 small">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                    <p class="text-danger m-0 small">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
            <div class="row alert-box">
                @if (!session()->has('USER_LOGGEDIN'))
                    <div class="col-lg-10 col-md-10 col-12 mx-auto">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <p id="flush-headingOne"><i class="bi bi-calendar3 text-red me-2"></i> Returning customer?
                                    <a class=" collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne" href="">Click here to
                                        login</a>
                                </p>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <form class="row g-3" method="post" action="{{ url('login') }}">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="inputUsername4" class="form-label fs-6 f-600">Email<span
                                                        class="vstar">*</span></label>
                                                <input type="text" class="form-control" id="inputUsername4"
                                                    name="login_email">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputPassword4" class="form-label fs-6 f-600">Password<span
                                                        class="vstar">*</span></label>
                                                <input type="password" class="form-control" id="inputPassword4"
                                                    name="login_password">
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-red">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-10 col-md-10 col-12 mx-auto" id="coupon_code_msg">

                </div>
            </div>

            <div class="row justify-content-center py-2">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="fs-6 f-700">Billing Details</h5>
                            <hr>
                            <form class="row g-3" id="billing-address-from">
                                @csrf
                                <div class="col-md-12">
                                    <label for="inputbFirst4" class="form-label fs-6 f-600">Full Name<span
                                            class="vstar">*</span></label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->name }} @endif"
                                        name="b-name" id="inputbFirst4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputbaddress4" class="form-label fs-6 f-600">Address<span
                                            class="vstar">*</span></label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->address }} @endif"
                                        name="b-address" id="inputbaddress4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputbcity4" class="form-label fs-6 f-600">Town / City<span
                                            class="vstar">*</span></label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->city }} @endif"
                                        name="b-city" id="inputbcity4">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputbstate4" class="form-label fs-6 f-600">State<span
                                                class="vstar">*</span></label>
                                        <select name="b-state" id="inputbstate4" class="form-control">
                                            @if (isset($billingAddress[0]))
                                                <option label="{{ $billingAddress[0]->state }}"
                                                    value="{{ $billingAddress[0]->state }}" selected="selected">
                                                    {{ $billingAddress[0]->state }}
                                                </option>
                                            @else
                                                <option label="Please Select State" selected="selected">Please Select
                                            @endif
                                            State</option>
                                            <option label="Andaman and Nicobar Islands" value="Andaman and Nicobar Islands">
                                                Andaman and Nicobar
                                                Islands</option>
                                            <option label="Andhra Pradesh" value="Andhra Pradesh">Andhra
                                                Pradesh
                                            </option>
                                            <option label="Arunachal Pradesh" value="Arunachal Pradesh">Arunachal Pradesh
                                            </option>
                                            <option label="Assam" value="Assam">Assam</option>
                                            <option label="Bihar" value="Bihar">Bihar</option>
                                            <option label="Chandigarh" value="Chandigarh">Chandigarh</option>
                                            <option label="Dadra and Nagar Haveli" value="Dadra and Nagar Haveli">Dadra
                                                and
                                                Nagar Haveli
                                            </option>
                                            <option label="Daman and Diu" value="Daman and Diu">Daman and Diu</option>
                                            <option label="Delhi" value="Delhi">Delhi</option>
                                            <option label="Goa" value="Goa">Goa</option>
                                            <option label="Gujarat" value="Gujarat">Gujarat</option>
                                            <option label="Haryana" value="Haryana">Haryana</option>
                                            <option label="Himachal Pradesh" value="Himachal Pradesh">Himachal Pradesh
                                            </option>
                                            <option label="Jammu and Kashmir" value="Jammu and Kashmir">Jammu and Kashmir
                                            </option>
                                            <option label="Karnataka" value="Karnataka">Karnataka</option>
                                            <option label="Kerala" value="Kerala">Kerala</option>
                                            <option label="Lakshadweep Islands" value="Lakshadweep Islands">Lakshadweep
                                                Islands</option>
                                            <option label="Madhya Pradesh" value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option label="Maharashtra" value="Maharashtra">Maharashtra</option>
                                            <option label="Manipur" value="Manipur">Manipur</option>
                                            <option label="Meghalaya" value="Meghalaya">Meghalaya</option>
                                            <option label="Mizoram" value="Mizoram">Mizoram</option>
                                            <option label="Nagaland" value="Nagaland">Nagaland</option>
                                            <option label="Odisha" value="Odisha">Odisha</option>
                                            <option label="Pondicherry" value="Pondicherry">Pondicherry</option>
                                            <option label="Punjab" value="Punjab">Punjab</option>
                                            <option label="Rajasthan" value="Rajasthan">Rajasthan</option>
                                            <option label="Sikkim" value="Sikkim">Sikkim</option>
                                            <option label="Tamil Nadu" value="Tamil Nadu">Tamil Nadu</option>
                                            <option label="Tripura" value="1504">Tripura</option>
                                            <option label="Uttar Pradesh" value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option label="West Bengal" value="West Bengal">West Bengal</option>
                                            <option label="Jharkhand" value="Jharkhand">Jharkhand</option>
                                            <option label="Uttarakhand" value="Uttarakhand">Uttarakhand</option>
                                            <option label="Chhattisgarh" value="Chhattisgarh">Chhattisgarh</option>
                                            <option label="Telangana" value="Telangana">Telangana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputbpin4" class="form-label fs-6 f-600">PIN<span
                                            class="vstar">*</span></label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->zip }} @endif"
                                        name="b-pin" id="inputbpin4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputbcompany4" class="form-label fs-6 f-600">Company name
                                        (optional)</label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->company }} @endif"
                                        name="b-company" id="inputbcompany4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputbgst4" class="form-label fs-6 f-600">GSTIN (optional)</label>
                                    <input type="text" class="form-control"
                                        value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->gstin }} @endif"
                                        name="b-gstin" id="inputbgst4">
                                </div>
                                @if (!session()->has('USER_LOGGEDIN'))
                                    <div class="col-md-12">
                                        <label for="inputbphone4" class="form-label fs-6 f-600">Phone<span
                                                class="vstar">*</span></label>
                                        <input type="tel" class="form-control" name="b-phone" id="inputbphone4">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputbemail4" class="form-label fs-6 f-600">Account Email<span
                                                class="vstar">*</span></label>
                                        <input type="email" class="form-control" name="b-email" id="inputbemail4">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputbpassword4" class="form-label fs-6 f-600">Account Password<span
                                                class="vstar">*</span></label>
                                        <input type="password" class="form-control" name="b-password"
                                            id="inputbpassword4">
                                    </div>
                                @endif

                            </form>
                        </div>
                        <div class="accordion accordion-flush my-2" id="accordionFlushExample2">
                            <div class="accordion-item" id="flush-headingTwo">
                                <div class="form-check mb-3" class=" collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <form id="shipToDifferentAddress-from">
                                        <input class="form-check-input" type="checkbox" name="shipToDifferentAddress"
                                            value="shipToDifferentAddress" id="flexCheckshipToDifferentAddress"
                                            onclick="shipToDifferentAdd()">
                                        <label class="form-check-label" for="flexCheckshipToDifferentAddress"
                                            onclick="shipToDifferentAdd()">
                                            <h5 class="fs-6 f-700">Ship to different address?</h5>
                                        </label>
                                    </form>
                                </div>
                                <hr>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body p-0">
                                        <form class="row g-3" id="shipping-address-from">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="inputsFirst4" class="form-label fs-6 f-600">Full Name<span
                                                        class="vstar">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->name }} @endif"
                                                    name="s-name" id="inputsFirst4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputsaddress4" class="form-label fs-6 f-600">Address<span
                                                        class="vstar">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->address }} @endif"
                                                    name="s-address" id="inputsaddress4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputscity4" class="form-label fs-6 f-600">Town / City<span
                                                        class="text">*</span></label>
                                                <input type="email" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->city }} @endif"
                                                    name="s-city" id="inputscity4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputsstate4" class="form-label fs-6 f-600">State<span
                                                        class="vstar">*</span></label>
                                                <select name="s-state" id="inputsstate4" class="form-control">
                                                    @if (isset($shippingAddress[0]))
                                                        <option label="{{ $shippingAddress[0]->state }}"
                                                            value="{{ $shippingAddress[0]->state }}"
                                                            selected="selected">
                                                            {{ $shippingAddress[0]->state }}
                                                        </option>
                                                    @else
                                                        <option label="Please Select State" selected="selected">Please
                                                            Select
                                                    @endif
                                                    <option label="Andaman and Nicobar Islands"
                                                        value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                        Islands</option>
                                                    <option label="Andhra Pradesh" value="Andhra Pradesh">Andhra Pradesh
                                                    </option>
                                                    <option label="Arunachal Pradesh" value="Arunachal Pradesh">Arunachal
                                                        Pradesh</option>
                                                    <option label="Assam" value="Assam">Assam</option>
                                                    <option label="Bihar" value="Bihar">Bihar</option>
                                                    <option label="Chandigarh" value="Chandigarh">Chandigarh</option>
                                                    <option label="Dadra and Nagar Haveli" value="Dadra and Nagar Haveli">
                                                        Dadra and Nagar Haveli
                                                    </option>
                                                    <option label="Daman and Diu" value="Daman and Diu">Daman and Diu
                                                    </option>
                                                    <option label="Delhi" value="Delhi">Delhi</option>
                                                    <option label="Goa" value="Goa">Goa</option>
                                                    <option label="Gujarat" value="Gujarat">Gujarat</option>
                                                    <option label="Haryana" value="Haryana">Haryana</option>
                                                    <option label="Himachal Pradesh" value="Himachal Pradesh">Himachal
                                                        Pradesh</option>
                                                    <option label="Jammu and Kashmir" value="Jammu and Kashmir">Jammu and
                                                        Kashmir</option>
                                                    <option label="Karnataka" value="Karnataka">Karnataka</option>
                                                    <option label="Kerala" value="Kerala">Kerala</option>
                                                    <option label="Lakshadweep Islands" value="Lakshadweep Islands">
                                                        Lakshadweep Islands</option>
                                                    <option label="Madhya Pradesh" value="Madhya Pradesh">Madhya Pradesh
                                                    </option>
                                                    <option label="Maharashtra" value="Maharashtra">Maharashtra</option>
                                                    <option label="Manipur" value="Manipur">Manipur</option>
                                                    <option label="Meghalaya" value="Meghalaya">Meghalaya</option>
                                                    <option label="Mizoram" value="Mizoram">Mizoram</option>
                                                    <option label="Nagaland" value="Nagaland">Nagaland</option>
                                                    <option label="Odisha" value="Odisha">Odisha</option>
                                                    <option label="Pondicherry" value="Pondicherry">Pondicherry</option>
                                                    <option label="Punjab" value="Punjab">Punjab</option>
                                                    <option label="Rajasthan" value="Rajasthan">Rajasthan</option>
                                                    <option label="Sikkim" value="Sikkim">Sikkim</option>
                                                    <option label="Tamil Nadu" value="Tamil Nadu">Tamil Nadu</option>
                                                    <option label="Tripura" value="1504">Tripura</option>
                                                    <option label="Uttar Pradesh" value="Uttar Pradesh">Uttar Pradesh
                                                    </option>
                                                    <option label="West Bengal" value="West Bengal">West Bengal</option>
                                                    <option label="Jharkhand" value="Jharkhand">Jharkhand</option>
                                                    <option label="Uttarakhand" value="Uttarakhand">Uttarakhand</option>
                                                    <option label="Chhattisgarh" value="Chhattisgarh">Chhattisgarh
                                                    </option>
                                                    <option label="Telangana" value="Telangana">Telangana</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputspin4" class="form-label fs-6 f-600">PIN<span
                                                        class="vstar">*</span></label>
                                                <input type="number" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->zip }} @endif"
                                                    name="s-pin" id="inputspin4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputscompany4" class="form-label fs-6 f-600">Company name
                                                    (optional)</label>
                                                <input type="text" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->company }} @endif"
                                                    name="s-comapny" id="inputscompany4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputsgst4" class="form-label fs-6 f-600">GSTIN
                                                    (optional)</label>
                                                <input type="text" class="form-control"
                                                    value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->gstin }} @endif"
                                                    name="s-gstin" id="inputsgst4">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-12 ps-5">
                    <div class="right border p-4">
                        <h5 class="fs-6 f-700 pb-3">Your Order</h5>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Product</b></div>
                            <div class="col-lg-6 col-6"><b>Subtotal</b></div>
                        </div>
                        <hr>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($cartData['cart'] as $list)
                            @php
                                $totalPrice += $list->qty * $list->price;
                            @endphp
                            <div class="row">
                                <div class="col-lg-6 col-6">{{ $list->name }} - {{ $list->size }} ×
                                    {{ $list->qty }}
                                </div>
                                <div class="col-lg-6 col-6"><b>₹{{ $list->qty * $list->price }}</b></div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Subtotal</b></div>
                            <div class="col-lg-6 col-6"><b>₹{{ $totalPrice }}</b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Shipping</b></div>
                            <div class="col-lg-6 col-6">Free shipping</div>
                        </div>
                        <hr>
                        <div class="">
                            <div id="coupon-applied" class="row">

                            </div>

                            <div id="enter-coupon">
                                <form id="coupon_code_form">
                                    <div class="input-group">
                                        <input type="hidden" name="_token" id="coupon_token"
                                            value="{{ csrf_token() }}">
                                        <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                            placeholder="Coupon Code" aria-label="Enter Coupon"
                                            aria-describedby="applyCoupon" required>
                                        <button class="btn bg-red f-600 fs-6 text-white" type="button" id="applyCoupon"
                                            style="z-index: 0;" onclick="apply_coupon()">APPLY COUPON</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Total</b></div>
                            <div class="col-lg-6 col-6" id="totalAmount"><b>₹{{ $totalPrice }}</b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <form id="payment_method_form">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="COD"
                                            name="payment_method" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Cash on delivery
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Gateway"
                                            name="payment_method" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Credit Card/Debit Card/NetBanking
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 my-2">
                                <p class="fs-6">Your personal data will be used to process your order, support
                                    your experience throughout this website, and for other purposes described in our <a
                                        href="" class="text-red">privacy policy</a>.</p>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="termsPolicy">
                                    <label class="form-check-label" for="termsPolicy">
                                        <b>I have read and agree to the website <a href="" class="text-red">terms
                                                and
                                                conditions</a><span class="vstar">*</span></b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn bg-red f-600 fs-6 text-white w-100" type="button"
                                    id="place-order-btn" style="z-index: 0;" onclick="place_order();">PLACE
                                    ORDER</button>
                                <small>
                                    <p class="text-danger pt-2" id="required_error"></p>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('additional_js')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection
