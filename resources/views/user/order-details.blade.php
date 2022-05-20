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
                    <p><small><span class="text-red"><em>#</em></span> {{ $productDetails[0]->order_id }}</small>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 border-end">
                    <p class="m-0"><b> Date: </b></p>
                    <p><small>{{ \Carbon\Carbon::parse($productDetails[0]->order_date)->isoFormat('MMM Do, YYYY') }}</small>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 border-end">
                    <p class="m-0"><b> Total: </b></p>
                    <p><small>Rs {{ $productDetails[0]->total_amount }}</small></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <p class="m-0"><b> Payment Method: </b></p>
                    <p><small>
                            @if ($productDetails[0]->payment_type == 'COD')
                                {{ 'Cash on delivery' }}
                            @endif
                            @if ($productDetails[0]->payment_type == 'Gateway')
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
                            @php($subtotal = 0)
                            @foreach ($productDetails as $list)
                                @php($subtotal += $list->subtotal)
                                <tr>
                                    <td>
                                        <span class="product_name">{{ $list->product_name }}</span>
                                        &nbsp;<b>x</b>&nbsp;
                                        <span class="product_qty">(Qty: {{ $list->totalqty }})</span>
                                        @if ($list->size != '')
                                            &nbsp;/&nbsp;
                                            (<small>Size : <span class="product_size">{{ $list->size }})
                                                </span></small>
                                        @endif
                                        @if ($list->color != '')
                                            &nbsp;/&nbsp;
                                            (<small>Color : <span
                                                    class="product_color">{{ $list->color }})</span></small>
                                        @endif
                                    </td>
                                    <td><small>Rs </small><span class="product_price">{{ $list->subtotal }}</span></td>
                                </tr>
                            @endforeach

                            <tr>
                                <td>Subtotal :</td>
                                <td><small>Rs </small><span class="subtotal_price">{{ $subtotal }}</span></td>
                            </tr>
                            <tr>
                                <td>Shipping :</td>
                                <td><span class="shipping">Free shipping</span></td>
                            </tr>
                            <tr>
                                <td>Coupon code :</td>
                                <?php
                                if ($productDetails[0]->coupon_id == 0) {
                                    echo '<td><small>Not Used</small></td>';
                                } elseif ($productDetails[0]->coupon_id != 0) {
                                    if ($productDetails[0]->coupon_type == 'Per') {
                                        $discount_price = ($productDetails[0]->coupon_val / 100) * $subtotal;
                                    } elseif ($productDetails[0]->coupon_type == 'Value') {
                                        $discount_price = $productDetails[0]->coupon_val;
                                    }
                                    ?>
                                <td><small>- Rs <span class="discount_price">{{ $discount_price }}</span>, <span
                                            class="coupon_code">{{ $productDetails[0]->coupon_code }}</span></small>
                                </td>
                                <?php
                                }

                                ?>
                            </tr>
                        <tfoot>
                            <tr>
                                <td><b>Total :</b></td>
                                <td><b>Rs <span class="total_price">{{ $productDetails[0]->total_amount }}</span></b>
                                </td>
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
                            <p class="m-0"> {{ $productDetails[0]->bname }}</p>
                            <p class="m-0"> {{ $productDetails[0]->baddress }}</p>
                            <p class="m-0"> {{ $productDetails[0]->bcity }}</p>
                            <p class="m-0"> {{ $productDetails[0]->bstate }}</p>
                            <p class="m-0"> {{ $productDetails[0]->bzip }}</p>
                            <p class="m-0"> {{ $productDetails[0]->bcompany }}</p>
                            <p class="m-0"> {{ $productDetails[0]->bgstin }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between py-3">
                            <span class="fs-6 f-700 text-black">Shipping address</span>
                        </div>
                        <div class="card-body">
                            <p class="m-0"> {{ $productDetails[0]->sname }}</p>
                            <p class="m-0"> {{ $productDetails[0]->saddress }}</p>
                            <p class="m-0"> {{ $productDetails[0]->scity }}</p>
                            <p class="m-0"> {{ $productDetails[0]->sstate }}</p>
                            <p class="m-0"> {{ $productDetails[0]->szip }}</p>
                            <p class="m-0"> {{ $productDetails[0]->scompany }}</p>
                            <p class="m-0"> {{ $productDetails[0]->sgstin }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('additional_js')
@endsection
