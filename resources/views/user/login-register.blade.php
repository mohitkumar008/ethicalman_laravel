@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content-wrapper')
    <section class="login-register py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    @if (session('register_msg'))
                        <h6 class="text-success">{{ session('register_msg') }}</h6>
                    @endif
                    <div class="section-title">
                        <h2 class="fs-3">
                            My Account
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly">
                <div class="col-lg-4 login">
                    <h4 class="mb-4 fs-4 f-700">Login</h4>
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="inputUsername4" class="form-label fs-6 f-600">Username<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control" id="inputUsername4">

                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label fs-6 f-600">Password<span
                                    class="vstar">*</span></label>
                            <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-red">Login</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 register">
                    <h4 class="mb-4 fs-4 f-700">Register</h4>
                    <form class="row g-3" method="post" action="{{ url('register') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="inputUsername4" class="form-label fs-6 f-600">Name<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control" name="username" id="inputUsername4">
                            <p class="text-danger m-0 small">
                                @error('username')
                                    {{ $message }}
                                @enderror

                            </p>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label fs-6 f-600">Email<span
                                    class="vstar">*</span></label>
                            <input type="email" class="form-control" name="email" id="inputEmail4">
                            <p class="text-danger m-0 small">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label fs-6 f-600">Password<span
                                    class="vstar">*</span></label>
                            <input type="password" class="form-control" name="password" id="inputPassword4">
                            <p class="text-danger m-0 small">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPhone4" class="form-label fs-6 f-600">Phone<span
                                    class="vstar">*</span></label>
                            <input type="tel" class="form-control" name="phone" id="inputPhone4">
                            <p class="text-danger m-0 small">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>

                        <div class="col-12">
                            <p>Your personal data will be used to support your experience throughout this website, to manage
                                access to your account, and for other purposes described in our <a href="#"
                                    class="text-red">privacy policy</a>.</p>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="register" class="btn btn-red">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
