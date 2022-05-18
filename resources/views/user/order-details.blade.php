@extends('user/layout')
@section('page_title', 'Order Details | The Ethical Man')
@section('additional_css')
@endsection

@section('content-wrapper')

    <section class="order-details-page">
        <div class="container">
            <div class="row heading-row mt-4">
                <div class="col-12 text-center py-4 mt-3">
                    <h4 class="m-0 f-600 text-red">Thank you. Your order has been received.</h4>
                </div>
            </div>
            <div class="row my-5 text-center">
                <div class="col-lg-3 col-md-3 col-sm-12 border-end">
                    <p class="m-0"><b> Order number: </b></p>
                    <p><small><span class="text-red"><em>#</em></span> {{ $order[0]->order_id }}</small></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 border-end">
                    <p class="m-0"><b> Date: </b></p>
                    <p><small>{{ \Carbon\Carbon::parse($order[0]->order_date)->isoFormat('MMM Do, YYYY') }}</small></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 border-end">
                    <p class="m-0"><b> Total: </b></p>
                    <p><small>Rs {{ $order[0]->totalamount }}</small></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <p class="m-0"><b> Payment Method: </b></p>
                    <p><small>
                            @if ($order[0]->payment_type == 'COD')
                                {{ 'Cash on delivery' }}
                            @endif
                            @if ($order[0]->payment_type == 'Gateway')
                                {{ 'Paid by Razorpay' }}
                            @endif
                        </small></p>
                </div>
            </div>
            <div class="row">
                <h6 class="text-center f-700 mb-4 text-uppercase">Order Details</h6>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $list)
                                @foreach ($product as $list2)
                                    {{-- @php
                                        prx($list2);
                                    @endphp --}}
                                    <tr>
                                        <td>
                                            <span class="product_name">{{ $list2[0]->name }}</span>
                                            &nbsp;<b>x</b>&nbsp;
                                            <span class="product_qty">{{ $list->qty }}</span>
                                            &nbsp;-&nbsp;
                                            (<small>Size : <span class="product_size">42</span></small>)
                                            &nbsp;-&nbsp;
                                            (<small>Color : <span class="product_color">Pink</span></small>)
                                        </td>
                                        <td><small>Rs </small><span class="product_price">1499</span></td>
                                    </tr>
                                @endforeach
                            @endforeach

                            <tr>
                                <td>Subtotal :</td>
                                <td><small>Rs </small><span class="subtotal_price">9499</span></td>
                            </tr>
                            <tr>
                                <td>Shipping :</td>
                                <td><span class="shipping">Free shipping</span></td>
                            </tr>
                            <tr>
                                <td>Coupon code :</td>
                                <td><small>- Rs <span class="discount_price">399</span>, <span
                                            class="coupon_code">TEM20</span></small>
                                </td>
                            </tr>
                        <tfoot>
                            <tr>
                                <td><b>Total :</b></td>
                                <td><b>Rs <span class="total_price">6999</span></b></td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between py-3">
                            <span class="fs-6 f-700 text-black">Billing address</span>
                        </div>
                        <div class="card-body">
                            {{-- @if (isset($billingAddress[0])) --}}
                            <p class="m-0"> Mohit</p>
                            <p class="m-0"> Bhangel</p>
                            <p class="m-0"> Noida</p>
                            <p class="m-0"> UP</p>
                            <p class="m-0"> 201304</p>
                            <p class="m-0"> Mohit Pvt Ltd</p>
                            <p class="m-0"> GSKD12051510</p>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between py-3">
                            <span class="fs-6 f-700 text-black">Shipping address</span>
                        </div>
                        <div class="card-body">
                            {{-- @if (isset($billingAddress[0])) --}}
                            <p class="m-0"> Mohit</p>
                            <p class="m-0"> Bhangel</p>
                            <p class="m-0"> Noida</p>
                            <p class="m-0"> UP</p>
                            <p class="m-0"> 201304</p>
                            <p class="m-0"> Mohit Pvt Ltd</p>
                            <p class="m-0"> GSKD12051510</p>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('additional_js')
@endsection
