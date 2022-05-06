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
                    <h2 class="banner-text">Contact Us</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner ends -->

    <section class="contact py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h2 class="fs-2 f-700 text-red">Questions, Comments?<br> You tell us. We listen.</h2>
                    <p class="my-5"><b>Address:</b> H.No. 286, Main road, Mandawali, East Delhi, Delhi- 110092.
                    </p>
                    <p class="my-5"><b>Email:</b> support@ethicalman.in</p>
                    <p class="my-5">Monday to Saturday – 10:00 am to 6:00 pm</p>
                    <div class="">
                        <h4 class="fs-4 f-700 text-red">Need Us? Call Us.</h4>
                        <p class="fs-4 f-800">7669496700</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 contact-form">
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="inputFirst4" class="form-label fs-6 f-600">Name<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control" id="inputFirst4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Email</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Subject</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-red px-4">SEND MESSAGE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
