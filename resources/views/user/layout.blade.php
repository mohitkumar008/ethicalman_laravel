<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('user_assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @section('additional_css')
    @show

    <link rel="stylesheet" href="{{ asset('user_assets/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user_assets/assets/css/responsive.css') }}">

    <title>@yield('page_title')</title>
    <script>
        let PRODUCT_IMG = "{{ asset('storage/media/') }}";
        let ROOT_URL = "{{ url('/') }}";
    </script>
</head>

<body>

    <!-- Topbar -->
    <div class="container-fluid border-bottom">
        <div class="row">
            <div class="col-12 text-center my-1">
                <span class="fw-bold fs-6">Free delivery on every order</span>
            </div>
        </div>
    </div>
    <!-- Topbar ends -->

    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light border-bottom bg-white">
        {{-- <nav class="navbar navbar-expand-lg navbar-light border-bottom bg-white"> --}}
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('user_assets/images/ethicalman-logo.png') }}" alt="" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 250px;">
                    <li class="nav-item">
                        <a class="nav-link active px-3 fs-6" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fs-6" href="{{ url('/product') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fs-6" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fs-6" href="{{ url('/contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 fs-6" href="{{ url('/my-account') }}">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2 fs-5 text-red" href="#"><i class="bi bi-search"></i></a>
                    </li>
                    <li class="nav-item dropdown" id="cart">
                        <a class="nav-link px-2 fs-3 py-0 "><i class="bi bi-cart3 cart-icon text-red" value=''></i></a>
                    </li>
                </ul>
            </div>
        </div>
        @php
            $getTotalCartItems = getTotalCartItems();
            // prx($getTotalCartItems);
        @endphp

        <div class="shopping-cart" style="display: none;">
            @if ($getTotalCartItems['totalCartCount'] == 0)
                <div class="shopping-cart-header">
                    No items in cart..
                </div>
            @else
                <div class="shopping-cart-header">
                    <div class=""><i class="bi bi-cart3 cart-icon text-red"></i><span
                            class="badge">{{ $getTotalCartItems['totalCartCount'] }}</span></div>
                    <div class="shopping-cart-total">
                        <span class="lighter-text">Total:</span>
                        <span class="main-color-text">₹{{ $getTotalCartItems['totalCartAmount'] }}</span>
                    </div>
                </div>
                <ul class="shopping-cart-items">
                    @foreach ($getTotalCartItems['cart'] as $list)
                        <li class="clearfix">
                            <img src="{{ asset('storage/media/' . $list->image . '') }}" width="25%"
                                alt="{{ $list->name }}" />
                            <span class="item-name">{{ $list->name }}</span>
                            <span class="item-price text-red">₹{{ $list->price }}</span>
                            <span class="item-quantity">x</span>
                            <span class="item-quantity">Quantity: {{ $list->qty }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="text-center">
                    <a href="{{ url('/cart') }}" class="btn bg-red rounded-pill text-white me-auto px-4">View
                        Cart</a>
                    <a href="{{ url('/checkout') }}"
                        class="btn bg-red rounded-pill text-white me-auto px-4">Checkout</a>
                </div>
            @endif
        </div>
    </nav>
    <!-- Navbar ends -->

    <div class="content-wrapper">
        @section('content-wrapper')
        @show
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 first">
                    <div class="tem-heading text-center">
                        <h5>THE ETHICAL MAN</h5>
                    </div>
                    <div class="tem-logo text-center my-4">
                        <img src="{{ asset('user_assets/images/TEM-Footer-Logo.png') }}" class="img-fluid w-60"
                            alt="">
                    </div>
                    <div class="tem-social">
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 second px-5">
                    <div class="tem-heading mb-4">
                        <h5>Get in touch with us for the best quality men’s formal</h5>
                    </div>
                    <div class="tem-text">
                        <p>The Ethical Man aims to redefine formal fashion by delivering formals that are a blend of
                            comfort and style. </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 third px-5">
                    <div class="tem-heading mb-4">
                        <h5>Quick Links</h5>
                    </div>
                    <div class="tem-text">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/cart') }}">Cart</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 fourth px-5">
                    <div class="tem-heading mb-4">
                        <h5>Important Links</h5>
                    </div>
                    <div class="tem-text">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ url('/refund_returns') }}">Refund and Returns Policy</a></li>
                            <li><a href="{{ url('/product') }}">Product</a></li>
                            <li><a href="{{ url('/my-account') }}">My account</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->

    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p class="m-0">Copyright © 2022 | THE ETHICAL MAN</p>
                </div>
                <div class="col-lg-6 text-end">
                    <p class="m-0">Powered By I-techverse Solutions India Pvt. Ltd.</p>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="{{ asset('user_assets/assets/plugins/smooth/js/jquery-2.1.3.min.js') }}">
    </script>
    @section('additional_js')
    @show
    <script src="{{ asset('user_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_assets/assets/js/custom.js') }}"></script>
    <script></script>
</body>

</html>
