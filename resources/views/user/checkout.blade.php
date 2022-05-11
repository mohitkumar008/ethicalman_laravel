@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                </div>
            </div>
            <div class="row alert-box">
                <div class="col-lg-10 col-md-10 col-12 mx-auto">
                    <p><i class="bi bi-calendar3 text-red me-2"></i> Have a coupon? <a href="">Click here to enter your
                            code</a></p>
                </div>
                <div class="col-lg-10 col-md-10 col-12 mx-auto">
                    <p><i class="bi bi-patch-check-fill text-red me-2"></i> Coupon code applied successfully</p>
                </div>
            </div>

            <div class="row justify-content-center py-2">
                <div class="col-lg-5 col-md-6 col-12">
                    <h5 class="fs-6 f-700">Billing Details</h5>
                    <hr>
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="inputFirst4" class="form-label fs-6 f-600">First Name<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control" id="inputFirst4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputLast4" class="form-label fs-6 f-600">Last Name<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control" id="inputLast4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputDisplayname4" class="form-label fs-6 f-600">Company name (optional)</label>
                            <input type="text" class="form-control" id="inputDisplayname4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Country / Region<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Street address<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Town / City<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">State<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">PIN<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Phone<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Email<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>

                    </form>
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
                            <div class="col-lg-6 col-6"><b>Coupon: <span>temoffer25</span></b></div>
                            <div class="col-lg-6 col-6"><b>-₹374.00</b>, Free shipping coupon</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Shipping</b></div>
                            <div class="col-lg-6 col-6">Free shipping</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-6"><b>Total</b></div>
                            <div class="col-lg-6 col-6"><b>₹1,125.00</b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Credit Card/Debit Card/NetBanking
                                    </label>
                                </div>
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
                                <button class="btn bg-red f-600 fs-6 text-white w-100" type="button" id="button-addon2"
                                    style="z-index: 0;" onclick="window.location.href='checkout'">PLACE ORDER</button>
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
