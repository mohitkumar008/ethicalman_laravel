@extends('user/layout')
@section('page_title', 'Thank you for your order | The Ethical Man')
@section('additional_css')
@endsection

@section('content-wrapper')
    <!-- Banner -->
    <section class="about-banner py-5"
        style="background-image: url('{{ asset('user_assets/images/Carousel-Background.png') }}')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="banner-text">Thank you for your order :)</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner ends -->

    <section class="contact py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <h6 class="fs-5 f-700 text-red">Thank you your order has been confirmed.</h6>
                    <p class="my-5"><b>Order id :</b> {{ session()->get('ORDER_ID') }}</p>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
