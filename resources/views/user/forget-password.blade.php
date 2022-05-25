@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content-wrapper')
    <section class="login-register py-4">
        <div class="container">
            <div class="row alert-box">
                <div class="col-lg-10 col-md-10 col-12 mx-auto" id="alert-msg">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h2 class="fs-3">
                            Forget Password
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly text-center">
                <div class="col-lg-6 forget-passowrd border rounded py-5 px-3">
                    <div id="password-changed-success">
                        <div class=""><i class="bi bi-check-circle-fill text-danger me-2"
                                style="font-size:5em"></i></div>
                        <a href="{{ url('/my-account') }}" class="btn btn-red">Go to Login</a>
                    </div>
                    <form class="row g-3" id="forget-pass-form" method="post"
                        action="{{ url('/forget-password-verification-send') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="verify_email" class="form-label fs-6 f-600">Enter Email<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control text-center" id="verify_email" name="verify_email">
                        </div>
                        <div class="col-md-12" id="verify_otp_label">
                            <label for="verify_otp" class="form-label fs-6 f-600">Enter Otp<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control text-center" id="verify_otp" name="verify_otp">
                        </div>
                        <div class="col-md-12" id="new_password_label">
                            <label for="new_password" class="form-label fs-6 f-600">Enter New Password<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control text-center" id="new_password" name="new_password">
                        </div>
                        <div class="col-md-12" id="newc_password_label">
                            <label for="newc_password" class="form-label fs-6 f-600">Confirm New Password<span
                                    class="vstar">*</span></label>
                            <input type="text" class="form-control text-center" id="newc_password" name="newc_password">
                        </div>
                        <div class="col-12">
                            <button type="button" id="btn-verify-email" class="btn btn-red"
                                onclick="verifyEmail()">Verify Email</button>
                            <button type="button" id="btn-verify-otp" class="btn btn-red" onclick="verifyOtp()">Verify
                                Otp</button>
                            <button type="button" id="btn-verify-password" onclick="changePassword()"
                                class="btn btn-red">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
    <script>
        function verifyEmail() {
            jQuery('#btn-verify-email').text('Please wait...');
            var email = jQuery('#verify_email').val();
            var token = jQuery("input[name=_token]").val();;
            jQuery.ajax({
                method: 'POST',
                url: '/forget-password-verification-send',
                data: `email=${email}&_token=${token}&action=verifyemail`,
                success: function(response) {
                    jQuery('#alert-msg').html(response.msg);
                    if (response.status == 'success') {
                        $('#verify_otp_label').show();
                        $('#btn-verify-email').hide();
                        $('#btn-verify-otp').show();
                        jQuery('#verify_email').prop('disabled', true);
                    } else if (response.status == 'error') {
                        jQuery('#btn-verify-email').text('Verify Email');
                    }
                }
            })
        }

        function verifyOtp() {
            var email = jQuery('#verify_email').val();
            var otp = jQuery('#verify_otp').val();
            var token = jQuery("input[name=_token]").val();;
            jQuery.ajax({
                method: 'POST',
                url: '/forget-password-verification-send',
                data: `email=${email}&otp=${otp}&_token=${token}&action=verifyotp`,
                success: function(response) {
                    jQuery('#alert-msg').html(response.msg);
                    if (response.status == 'success') {
                        jQuery('#verify_otp').prop('disabled', true);
                        $('#new_password_label').show();
                        $('#newc_password_label').show();
                        $('#btn-verify-otp').hide();
                        $('#btn-verify-password').show();
                    }
                }
            })
        }

        function changePassword() {
            jQuery('#alert-msg').html("");
            var email = jQuery('#verify_email').val();
            var new_password = jQuery('#new_password').val();
            var newc_password = jQuery('#newc_password').val();
            var token = jQuery("input[name=_token]").val();;
            if (new_password === newc_password) {
                jQuery.ajax({
                    method: 'POST',
                    url: '/forget-password-verification-send',
                    data: `email=${email}&new_password=${new_password}&newc_password=${newc_password}&_token=${token}&action=changepassword`,
                    success: function(response) {
                        jQuery('#alert-msg').html(response.msg);
                        if (response.status == 'success') {
                            $('#forget-pass-form').hide();
                            $('#password-changed-success ').show();
                        }
                    }
                })
            } else {
                jQuery('#alert-msg').html(
                    `<p class="text-danger"><i class="bi bi-check-circle-fill text-danger me-2"></i> Password not match!</p>`
                );
            }
        }
    </script>
@endsection
