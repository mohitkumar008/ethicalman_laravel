@extends('admin/layout')
@section('page_title', 'Orders | The Ethical Man')
@section('order_select', 'active')
{{-- Additional CSS --}}
@section('additional_css')
@endsection

{{-- Main Content --}}
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                        <li class="breadcrumb-item active">Order List</li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5>Order: <span>#{{ $productDetails[0]->order_id }}</span></h5>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> The Ethical Man
                                    <small class="float-right">Date:
                                        {{ \Carbon\Carbon::parse($productDetails[0]->order_date)->isoFormat('MMM Do, YYYY') }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                {{-- <b>Invoice #007612</b><br> --}}
                                <br>
                                <address>
                                    <strong>{{ $productDetails[0]->name }}</strong><br>
                                    Phone: {{ $productDetails[0]->phone }}<br>
                                    Email: {{ $productDetails[0]->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Billing Address
                                <address>
                                    <strong>{{ $productDetails[0]->bname }}</strong><br>
                                    <p class="m-0"> {{ $productDetails[0]->baddress }},
                                        {{ $productDetails[0]->bcity }}</p>
                                    <p class="m-0"> {{ $productDetails[0]->bstate }},
                                        {{ $productDetails[0]->bzip }}</p>
                                    <p class="m-0">Company: {{ $productDetails[0]->bcompany }}</p>
                                    <p class="m-0">GSTIN: {{ $productDetails[0]->bgstin }}</p>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Shipping Address
                                <address>
                                    <strong>{{ $productDetails[0]->sname }}</strong><br>
                                    <p class="m-0"> {{ $productDetails[0]->saddress }},
                                        {{ $productDetails[0]->scity }}</p>
                                    <p class="m-0"> {{ $productDetails[0]->sstate }},
                                        {{ $productDetails[0]->szip }}</p>
                                    <p class="m-0">Company: {{ $productDetails[0]->scompany }}</p>
                                    <p class="m-0">GSTIN: {{ $productDetails[0]->sgstin }}</p>
                                </address>
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
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
                                                <td><small>Rs </small><span
                                                        class="product_price">{{ $list->subtotal }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="m-0">Payment Methods: <span class="text-success"><small>
                                            @if ($productDetails[0]->payment_type == 'COD')
                                                {{ 'Cash on delivery' }}
                                            @endif
                                            @if ($productDetails[0]->payment_type == 'Gateway')
                                                {{ 'Paid by Razorpay' }}
                                            @endif
                                        </small></span></p>
                                <p class="m-0">Payment Id: <span class="text-success"><small>
                                            {{ $productDetails[0]->payment_id }}
                                        </small></span></p>
                                <p class="">Order Status: <span class="text-success"><small>
                                            {{ $productDetails[0]->order_status }}
                                        </small></span></p>

                                <form method="post" action="{{ url('admin/change_order_status') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $productDetails[0]->order_id }}" name="order_id">
                                    <div class="form-group">
                                        <select class="custom-select form-control-border" name="order_status"
                                            id="exampleSelectBorder">
                                            <option selected value="{{ $productDetails[0]->order_status_id }}"> Change
                                                Order Status</option>
                                            @foreach ($orderStatus as $list)
                                                <option value="{{ $list->id }}">{{ $list->order_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Update Status</button>
                                </form>

                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td><small>Rs </small><span
                                                        class="subtotal_price">{{ $subtotal }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping :</th>
                                                <td><span class="shipping">Free shipping</span></td>
                                            </tr>
                                            <tr>
                                                <th>Coupon code :</th>
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
                                                <td><small>- Rs <span
                                                            class="discount_price">{{ $discount_price }}</span>,
                                                        <span
                                                            class="coupon_code">{{ $productDetails[0]->coupon_code }}</span></small>
                                                </td>
                                                <?php
                                                }

                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td><b>Rs <span
                                                            class="total_price">{{ $productDetails[0]->total_amount }}</span></b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12 text-center my-3">
                                <a href="" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

{{-- Additional JS --}}
@section('additional_js')

@endsection
