@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="{{asset('user_assets/assets/js/jquery.min.js')}}"></script>
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
                    <div class="col-lg-10 col-md-10 col-12 mx-auto" id="coupon_code_msg">
                        
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
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($cart as $list)
                                    @php
                                        $totalPrice += $list->qty * $list->price;
                                    @endphp
                                    <tr class="vertical-middle">
                                        <td><a href="{{ url('cart/removeItem/' . $list->id . '') }}"
                                                class="text-red"><i class="bi bi-x-circle"></i></a></td>
                                        <td class="w-10"><a href=""><img
                                                    src="{{ asset('storage/media/' . $list->image . '') }}" alt=""
                                                    class="img-fluid"></a></td>
                                        <td><a href="" class="text-red f-700">{{ $list->name }} -
                                                {{ $list->size }}</a><br><span>Return 7 days</span></td>
                                        <td>₹{{ $list->price }}</td>
                                        <td class="w-10"><input class="w-50 text-center p-1 form-control"
                                                value='{{ $list->qty }}' type="number" id="qty{{ $list->attrid }}"
                                                min="1"
                                                onchange="updatecart('{{ $list->pid }}', '{{ $list->attrid }}', '{{ $list->price }}')">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </td>
                                        <td><b> ₹ <span
                                                    id="total_cart_price_{{ $list->attrid }}">{{ $list->price * $list->qty }}</span></b>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="vertical-middle">
                                <td colspan="4">
                                </td>
                                <td colspan="2">
                                    <button class="btn bg-red f-600 fs-6 text-white w-100" type="button"
                                            id="button-addon2" style="z-index: 0;"
                                            onclick="window.location.href='{{ url('checkout') }}'">PROCEED TO
                                            CHECKOUT</button>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-12 mx-auto text-center">

                        <img src="{{ asset('user_assets/images/empty-cart.jpg') }}" class="img-fluid w-50 mx-auto"
                            alt="">

                    </div>
                </div>

            @endif
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
