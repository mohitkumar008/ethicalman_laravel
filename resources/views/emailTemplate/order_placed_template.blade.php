<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .bg-light {
            --bs-bg-opacity: 1;
            background-color: #ededed !important;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: #96588a !important;
        }

        .text-primary {
            color: #96588a !important;
        }

        .p-1 {
            padding: 0.5rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .text-white {
            color: #fff !important;
        }

        .bg-white {
            background-color: rgb(255, 255, 255) !important;
        }

        table,
        th,
        td {
            border: 2px solid lightgrey;
            border-collapse: collapse;
            padding: 0.5rem !important;
            text-align: justify;
        }

        a {
            text-decoration: none
        }

        .m-0 {
            margin: 0 !important;
        }

    </style>

    <title>The Ethical Man</title>
</head>

<body class="bg-light">
    <div class="container p-4">
        <div class="heading bg-primary p-3">
            <h1 class="text-white">Thank you for your order</h1>
        </div>
        <div class="p-4 bg-white">
            {{-- <p>Hii {{ $name }},</p> --}}
            <p>Hii Mohit Kumar,</p>
            <p>Just to let you know — we've received your order <span
                    class="text-primary">#{{ $productDetails[0]->order_id }}</span>, and it is now
                being <span class="text-primary">{{ $productDetails[0]->order_status }}</span>.</p>
            <p>
                @if ($productDetails[0]->payment_type == 'COD')
                    {{ 'Cash on delivery' }}
                @endif
                @if ($productDetails[0]->payment_type == 'Gateway')
                    {{ 'Paid by Razorpay' }}
                @endif
            </p>
            <h3 class="text-primary">[Order #{{ $productDetails[0]->order_id }}]
                ({{ \Carbon\Carbon::parse($productDetails[0]->order_date)->isoFormat('MMM Do, YYYY') }})</h3>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                @php($subtotal = 0)
                @foreach ($productDetails as $list)
                    @php($subtotal += $list->subtotal)
                    <tr>
                        <td>
                            <span class="product_name">{{ $list->product_name }}</span>
                        </td>
                        <td>{{ $list->totalqty }}</td>
                        <td>₹<span class="product_price">{{ $list->subtotal }}</span></td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2">Subtotal:</th>
                    <td>₹{{ $subtotal }}</td>
                </tr>
                <tr>
                    <th colspan="2">Coupon code :</th>
                    <?php
                    if ($productDetails[0]->coupon_id == 0) {
                        echo '<td>Not Used</td>';
                    } elseif ($productDetails[0]->coupon_id != 0) {
                        if ($productDetails[0]->coupon_type == 'Per') {
                            $discount_price = ($productDetails[0]->coupon_val / 100) * $subtotal;
                        } elseif ($productDetails[0]->coupon_type == 'Value') {
                            $discount_price = $productDetails[0]->coupon_val;
                        }
                        ?>
                    <td> <span class="discount_price">-₹{{ $discount_price }}</span>, <span
                            class="coupon_code">{{ $productDetails[0]->coupon_code }}</span>
                    </td>
                    <?php
                    }

                    ?>
                </tr>
                <tr>
                    <th colspan="2">Shipping:</th>
                    <td>Free shipping</td>
                </tr>
                <tr>
                    <th colspan="2">Payment method:</th>
                    <td>
                        @if ($productDetails[0]->payment_type == 'COD')
                            <span>{{ 'Cash on delivery' }}</span>
                        @endif
                        @if ($productDetails[0]->payment_type == 'Gateway')
                            <span>{{ 'Paid by Razorpay' }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="2">Total:</th>
                    <td>₹{{ $productDetails[0]->total_amount }}</td>
                </tr>
            </table>
            <br>
            <br>
            <table>
                <tr>
                    <th class="text-primary">Billing Address</th>
                    <th class="text-primary">Shipping Address</th>
                </tr>
                <tr>
                    <td>
                        <p class="m-0"> {{ $productDetails[0]->bname }}</p>
                        <p class="m-0"> {{ $productDetails[0]->baddress }}</p>
                        <p class="m-0"> {{ $productDetails[0]->bcity }}</p>
                        <p class="m-0"> {{ $productDetails[0]->bstate }}</p>
                        <p class="m-0"> {{ $productDetails[0]->bzip }}</p>
                        <p class="m-0"> {{ $productDetails[0]->bcompany }}</p>
                        <p class="m-0"> {{ $productDetails[0]->bgstin }}</p>
                    </td>
                    <td>
                        <p class="m-0"> {{ $productDetails[0]->sname }}</p>
                        <p class="m-0"> {{ $productDetails[0]->saddress }}</p>
                        <p class="m-0"> {{ $productDetails[0]->scity }}</p>
                        <p class="m-0"> {{ $productDetails[0]->sstate }}</p>
                        <p class="m-0"> {{ $productDetails[0]->szip }}</p>
                        <p class="m-0"> {{ $productDetails[0]->scompany }}</p>
                        <p class="m-0"> {{ $productDetails[0]->sgstin }}</p>
                    </td>
                </tr>
            </table>
            <br><br>
            <p>Thanks for using <a href="https://www.ethicalman.in/">The Ethical Man!</a></p>
            <br>

            <p>Regards</p>
            <p>The Ethical Man</p>
        </div>
    </div>
    <p style="text-align:center; padding:20px;">Powered By The Ethical Man</p>

</body>

</html>
