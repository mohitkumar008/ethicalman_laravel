@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
@endsection

@section('content-wrapper')
    <section class="cart py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h2 class="fs-3">
                            Cart
                        </h2>
                    </div>
                </div>
            </div>
            @if (isset($cart[0]))
                <div class="row alert-box">
                    <div class="col-lg-10 col-md-10 col-12 mx-auto">
                        <p><i class="bi bi-patch-check-fill text-red me-2"></i> Customer matched zone "India"</p>
                    </div>
                    <div class="col-lg-10 col-md-10 col-12 mx-auto">
                        <p><i class="bi bi-patch-check-fill text-red me-2"></i> Coupon code applied successfully</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-12 mx-auto text-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $list)
                                    <tr class="vertical-middle">
                                        <td><a href="" class="text-red"><i class="bi bi-x-circle"></i></a></td>
                                        <td class="w-10"><a href=""><img
                                                    src="{{ asset('storage/media/' . $list->image . '') }}" alt=""
                                                    class="img-fluid"></a></td>
                                        <td><a href="" class="text-red f-700">{{ $list->name }} -
                                                {{ $list->size }}</a><br><span>Return 7 days</span></td>
                                        <td>₹{{ $list->price }}</td>
                                        <td class="w-10"><input class="w-50 text-center p-1 form-control"
                                                value='{{ $list->qty }}' type="number" min="1"></td>
                                        <td><b> ₹{{ $list->price * $list->qty }}</b></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="vertical-middle">
                                <td colspan="3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Coupon Code"
                                            aria-label="Enter Coupon" aria-describedby="button-addon2">
                                        <button class="btn bg-red f-600 fs-6 text-white" type="button" id="button-addon2"
                                            style="z-index: 0;">APPLY COUPON</button>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <div class="input-group">
                                        <button class="btn bg-red f-600 fs-6 ms-auto text-white" type="button"
                                            id="button-addon2" style="z-index: 0;">UPDATE CART</button>
                                    </div>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row checkout-row">
                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between py-3">
                                <span class="fs-6 f-700 text-black">Billing address</span>
                                <span><a href="">Edit</a></span>
                            </div>
                            <div class="card-body px-3">
                                <div class="row">
                                    <div class="col-lg-6 col-6"><b>Subtotal</b></div>
                                    <div class="col-lg-6 col-6"><b>₹1,499.00</b></div>
                                </div>
                                <hr class="m-0">
                                <div class="row">
                                    <div class="col-lg-6 col-6"><b>Coupon: <span>temoffer25</span></b></div>
                                    <div class="col-lg-6 col-6"><b>-₹374.00</b>, Free shipping coupon</div>
                                </div>
                                <hr class="m-0">
                                <div class="row">
                                    <div class="col-lg-6 col-6"><b>Shipping</b></div>
                                    <div class="col-lg-6 col-6">Free shipping Shipping to <b>Sector-3, Noida, E-46,
                                            Basement,
                                            Noida 201301, Uttar Pradesh.</b></div>
                                </div>
                                <hr class="m-0">
                                <div class="row">
                                    <div class="col-lg-6 col-6"><b>Total</b></div>
                                    <div class="col-lg-6 col-6"><b>₹1,125.00</b></div>
                                </div>
                                <hr class="m-0">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <button class="btn bg-red f-600 fs-6 text-white w-100" type="button"
                                            id="button-addon2" style="z-index: 0;"
                                            onclick="window.location.href='checkout'">PROCEED TO
                                            CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-12 mx-auto text-center">

                        <img src="{{ asset('user_assets/images/empty-cart.jpg') }}" class="img-fluid w-50 mx-auto" alt="">

                    </div>
                </div>

            @endif
        </div>
    </section>
@endsection
@section('additional_js')
@endsection