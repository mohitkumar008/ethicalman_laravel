@extends('user/layout')
@section('page_title', 'Products | The Ethical Man')
@section('additional_css')
@endsection

@section('content-wrapper')
    <!-- Banner -->
    <section class="about-banner py-5"
        style="background-image: url('{{ asset('user_assets/images/Carousel-Background.png') }}')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="banner-text">About Us</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner ends -->

    <section class="py-3">
        <div class="container">
            <h3 class="f-800">Crafted For <br> Impccably Perfect Personality</h3>
            <br>
            <p>The Ethical Man is a new generation fashion brand that crafts Men’s formals by merging together comfort and
                style. The brand provides Men’s Formal Fashion that is Simple, Supportive, Effortless yet, Elegant and tuned
                to the time. </p>
            <p>The brand believes that fashion doesn’t have to be rigid but Relaxing, Comforting, and should be
                Body-friendly. Moving on with this belief, the brand brings out men’s formal fashion that supports the outer
                appearance as well as the inner state of mind. </p>
            <p>The brand uses the finest quality fabric to design formals for men that are modern styled, innovative yet
                comfortable to serve their need for timeless classic dressing. The brand encourages a dressing that leaves
                room for personal expression with several patterns, colors, designs, and textures. </p>
            <p><b>Our designs are minimal, effective, and aim for comfort.</b></p>
        </div>
    </section>

    <section class="bg-red py-4 about-get-started">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center">
                    <h3 class="">Get Best Offers On Every Product!</h3>
                </div>
                <div class="col-lg-6 text-center">
                    <button class="bth">GET STARTED &nbsp;></button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-grey py-4" style="opacity:0.9;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 text-center px-2">
                    <img src="{{ asset('user_assets/images/icons/shipping.png') }}" alt="" class="img-fluid w-20">
                    <h5 class="f-600 fs-5 my-3 text-black">PAN India Shipping</h5>
                    <p class="fs-6">We deliver all over India. Our common delivery period is 2-7 working days.
                        Know that shipments are not sent on National holidays & Sundays and the same are processed on the
                        next working day.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 text-center px-2">
                    <img src="{{ asset('user_assets/images/icons/badge.png') }}" alt="" class="img-fluid w-20">
                    <h5 class="f-600 fs-5 my-3">Best Quality</h5>
                    <p class="fs-6">Our products are made with 100 % Cotton fully breathable fabric that allows
                        your skin to breathe freely.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 text-center px-2">
                    <img src="{{ asset('user_assets/images/icons/lock.png') }}" alt="" class="img-fluid w-20">
                    <h5 class="f-600 fs-5 my-3">Secure Payments</h5>
                    <p class="fs-6">Our Website has stringent security measures in place to protect the loss and
                        misuse of the information under our control. We adhere to strict security guidelines, protecting it
                        against unauthorized access.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
