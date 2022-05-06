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
                    <li class="nav-item d-flex">
                        <a class="nav-link px-2 fs-5 text-red" href="#"><i class="bi bi-search"></i></a>
                        <a class="nav-link px-2 fs-3 py-0 text-red" href="#"><i class="bi bi-bag cart-icon"
                                value='0'></i></a>
                    </li>

                </ul>
            </div>
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

    @section('additional_js')
    @show
    <script src="{{ asset('user_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
