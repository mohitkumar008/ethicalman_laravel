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
                {{-- <div class="col-lg-10 col-md-10 col-12 mx-auto">
                    <p><i class="bi bi-calendar3 text-red me-2"></i> Have a coupon? <a href="">Click here to enter your
                            code</a></p>
                </div> --}}
                {{-- <div class="col-lg-10 col-md-10 col-12 mx-auto">
                    <p><i class="bi bi-patch-check-fill text-red me-2"></i> Coupon code applied successfully</p>
                </div> --}}
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
                                    <label for="inputFirst4" class="form-label fs-6 f-600">Full Name<span
                                            class="vstar">*</span></label>
                                    <input type="text" class="form-control" name="b-name" id="inputFirst4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label fs-6 f-600">Address<span
                                            class="vstar">*</span></label>
                                    <input type="email" class="form-control" name="b-address" id="inputEmail4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label fs-6 f-600">Town / City<span
                                            class="vstar">*</span></label>
                                    <input type="email" class="form-control" name="b-city" id="inputEmail4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label fs-6 f-600">State<span
                                            class="vstar">*</span></label>
                                    <input type="email" class="form-control" name="b-state" id="inputEmail4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label fs-6 f-600">PIN<span
                                            class="vstar">*</span></label>
                                    <input type="email" class="form-control" name="b-pin" id="inputEmail4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputDisplayname4" class="form-label fs-6 f-600">Company name
                                        (optional)</label>
                                    <input type="text" class="form-control" name="b-company" id="inputDisplayname4">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputDisplayname4" class="form-label fs-6 f-600">GSTIN (optional)</label>
                                    <input type="text" class="form-control" name="b-gstin" id="inputDisplayname4">
                                </div>
                                @if (!session()->has('USER_LOGGEDIN'))
                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="form-label fs-6 f-600">Phone<span
                                                class="vstar">*</span></label>
                                        <input type="email" class="form-control" name="b-phone" id="inputEmail4">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="form-label fs-6 f-600">Account Email<span
                                                class="vstar">*</span></label>
                                        <input type="email" class="form-control" name="b-email" id="inputEmail4">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail4" class="form-label fs-6 f-600">Account Password<span
                                                class="vstar">*</span></label>
                                        <input type="email" class="form-control" name="b-password" id="inputEmail4">
                                    </div>
                                @endif

                            </form>
                        </div>
                        <div class="accordion accordion-flush my-2" id="accordionFlushExample2">
                            <div class="accordion-item" id="flush-headingTwo">
                                <div class="form-check mb-3" class=" collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <h5 class="fs-6 f-700">Ship to different address?</h5>
                                    </label>
                                </div>
                                <hr>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body p-0">
                                        <form class="row g-3" id="shipping-address-from">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="inputFirst4" class="form-label fs-6 f-600">Full Name<span
                                                        class="vstar">*</span></label>
                                                <input type="text" class="form-control" name="s-name" id="inputFirst4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label fs-6 f-600">Address<span
                                                        class="vstar">*</span></label>
                                                <input type="email" class="form-control" name="s-address"
                                                    id="inputEmail4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label fs-6 f-600">Town / City<span
                                                        class="vstar">*</span></label>
                                                <input type="email" class="form-control" name="s-city" id="inputEmail4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label fs-6 f-600">State<span
                                                        class="vstar">*</span></label>
                                                <input type="email" class="form-control" name="s-state" id="inputEmail4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputEmail4" class="form-label fs-6 f-600">PIN<span
                                                        class="vstar">*</span></label>
                                                <input type="email" class="form-control" name="s-pin" id="inputEmail4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputDisplayname4" class="form-label fs-6 f-600">Company name
                                                    (optional)</label>
                                                <input type="text" class="form-control" name="s-comapny"
                                                    id="inputDisplayname4">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputDisplayname4" class="form-label fs-6 f-600">GSTIN
                                                    (optional)</label>
                                                <input type="text" class="form-control" name="s-gstin"
                                                    id="inputDisplayname4">
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
                        @foreach ($cartData as $list)
                            @php
                                $totalPrice += $list->qty * $list->price;
                            @endphp
                            <div class="row">
                                <div class="col-lg-6 col-6">{{ $list->name }} - {{ $list->size }} × {{ $list->qty }}
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
                                        <input type="hidden" name="_token" id="coupon_token" value="{{ csrf_token() }}">
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
                                        <input class="form-check-input" type="radio" value="COD" name="payment_method"
                                            id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Cash on delivery
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Gateway" name="payment_method"
                                            id="flexRadioDefault2">
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
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <b>I have read and agree to the website <a href="" class="text-red">terms and
                                                conditions</a><span class="vstar">*</span></b>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn bg-red f-600 fs-6 text-white w-100" type="button" id="place-order-btn"
                                    style="z-index: 0;" onclick="place_order();">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('additional_js')
@endsection
