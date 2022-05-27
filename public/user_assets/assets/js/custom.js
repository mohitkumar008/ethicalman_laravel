function add_to_cart(pid) {
    var size = $('#size').val($('#size_id').val());
    var qty = $('#qty').val($('#quantity').val());
    var pid = $('#pid').val(pid);
    // alert(pid);
    jQuery.ajax({
        url: '/add_to_cart',
        data: jQuery('#addtocartform').serialize(),
        type: 'post',
        success: function (data) {
            alert('Product ' + data);
        }
    })
}

function updatecart(pid, aid, price) {
    var qty = document.getElementById('qty' + aid).value;
    var token = $('#token').val();
    console.log(qty);
    jQuery.ajax({
        url: '/update_cart',
        data: `pid=${pid}&aid=${aid}&qty=${qty}&_token=${token}`,
        type: 'post',
        success: function (data) {
            // alert('Cart updated');
            $('#total_cart_price_' + aid).html(qty * price);
        }
    })
}

function apply_coupon() {
    jQuery('#coupon_code_msg').html('')
    var coupon_code = jQuery('#coupon_code').val();
    var token = $('#coupon_token').val();
    if (coupon_code != "") {
        jQuery.ajax({
            url: '/apply_coupon',
            data: `coupon=${coupon_code}&_token=${token}`,
            type: 'post',
            success: function (data) {
                if (data.status == 'success') {
                    jQuery('#totalAmount').html(`<b>₹${data.totalCartAmount}</b>`);
                    jQuery('#coupon_code_msg').html(`<p><i class="bi bi-patch-check-fill text-red me-2"></i> ${data.msg}</p>`);
                    jQuery('#coupon-applied').html(`
                        <div class="col-lg-6 col-6"><b>Coupon: <span>${data.coupon}</span></b></div>
                        <div class="col-lg-6 col-6"><b>-₹${data.discount_price}</b>, ${data.title} <a href="javascript:void(0)" onclick="remove_coupon()">Remove</a></div>
                    `);
                    jQuery('#enter-coupon').hide();
                } else {
                    jQuery('#coupon_code_msg').html(`<p><i class="bi bi-exclamation-circle-fill text-red me-2"></i> ${data.msg}</p>`);
                }
            }
        })
    } else {
        jQuery('#coupon_code_msg').html('<p><i class="bi bi-exclamation-circle-fill text-red me-2"></i> Please enter the coupon code</p>');
    }
}

function remove_coupon() {
    // alert('s');
    jQuery('#coupon_code_msg').html('')
    var coupon_code = jQuery('#coupon_code').val();
    var token = $('#coupon_token').val();
    if (coupon_code != "") {
        jQuery.ajax({
            url: '/remove_coupon',
            data: `coupon=${coupon_code}&_token=${token}`,
            type: 'post',
            success: function (data) {
                if (data.status == 'success') {
                    jQuery('#totalAmount').html(`<b>₹${data.totalCartAmount}</b>`);
                    jQuery('#coupon_code_msg').html(`<p><i class="bi bi-patch-check-fill text-red me-2"></i> ${data.msg}</p>`);
                    jQuery('#coupon-applied').html(`
                        <div class="col-lg-6 col-6"><b>Coupon: <span>${data.coupon}</span></b></div>
                        <div class="col-lg-6 col-6"><b>-₹${data.discount_price}</b>, ${data.title} <a href="javascript.void(0)" onclick="remove_coupon()">Remove</a></div>
                    `);
                    jQuery('#enter-coupon').show();
                    jQuery('#coupon-applied').html('');
                    jQuery('#coupon_code').val('');
                } else {
                    jQuery('#coupon_code_msg').html(`<p><i class="bi bi-exclamation-circle-fill text-red me-2"></i> ${data.msg}</p>`);
                }
            }
        })
    } else {
        jQuery('#coupon_code_msg').html('<p><i class="bi bi-exclamation-circle-fill text-red me-2"></i> Please enter the coupon code</p>');
    }
}

function place_order() {
    $('#required_error').html('');
    var termsPolicy = $('#termsPolicy').is(':checked');
    if (termsPolicy == true) {
        var b_name = $.trim($('#inputbFirst4').val());
        var b_address = $.trim($('#inputbaddress4').val());
        var b_city = $.trim($('#inputbcity4').val());
        var b_state = $.trim($('#inputbstate4').val());
        var b_pin = $.trim($('#inputbpin4').val());
        if (b_name == "" || b_address == "" || b_city == "" || b_state == "" || b_pin == "") {
            $('#required_error').html('All(*) fields are required!');
        } else {
            var isChecked = $('#flexCheckshipToDifferentAddress').is(':checked');
            if (isChecked == true) {
                var s_name = $.trim($('#inputsFirst4').val());
                var s_address = $.trim($('#inputsaddress4').val());
                var s_city = $.trim($('#inputscity4').val());
                var s_state = $.trim($('#inputsstate4').val());
                var s_pin = $.trim($('#inputspin4').val());

                if (s_name == "" || s_address == "" || s_city == "" || s_state == "" || s_pin == "") {
                    $('#required_error').html('All(*) fields are required!!');
                } else {
                    jQuery('#place-order-btn').html('Please wait...');
                    var token = $('#coupon_token').val();
                    jQuery.ajax({
                        url: '/place_order',
                        data: jQuery('#billing-address-from, #shipping-address-from, #coupon_code_form, #payment_method_form, #shipToDifferentAddress-from').serialize(),
                        type: 'post',
                        success: function (data) {
                            if (data.status == 'success') {
                                if (data.payment_type == 'Gateway') {
                                    var options = {
                                        "key": "rzp_test_cPY1RE9Kn38kqy",
                                        "amount": data.totalCartAmount * 100,
                                        "currency": "INR",
                                        "name": "The Ethical Man",
                                        "description": "Thank you for shopping",
                                        "image": "https://www.ethicalman.in/wp-content/uploads/2022/01/TEM-Footer-Logo-150x150.png",
                                        "handler": function (response) {
                                            jQuery.ajax({
                                                method: 'post',
                                                url: '/payment-success',
                                                data: {
                                                    'user_id': data.user_id,
                                                    'order_id': data.order_id,
                                                    'payment_id': response.razorpay_payment_id,
                                                    'payment_type': data.payment_type,
                                                    '_token': token
                                                },
                                                success: function (result) {
                                                    if (result.status == 'success') {
                                                        window.location.href = "order_placed";
                                                    }
                                                }
                                            })
                                        },
                                        "prefill": {
                                            "name": data.user_name,
                                            "email": data.user_email,
                                            "contact": data.user_phone
                                        },
                                        "theme": {
                                            "color": "#3399cc"
                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                    rzp1.open();

                                } else if (data.payment_type == 'COD') {

                                    window.location.href = "order_placed";
                                    jQuery('#place-order-btn').html(data.msg);
                                }
                            }
                        }
                    })
                }
            } else {
                jQuery('#place-order-btn').html('Please wait...');
                var token = $('#coupon_token').val();
                jQuery.ajax({
                    url: '/place_order',
                    data: jQuery('#billing-address-from, #shipping-address-from, #coupon_code_form, #payment_method_form, #shipToDifferentAddress-from').serialize(),
                    type: 'post',
                    success: function (data) {
                        if (data.status == 'success') {
                            if (data.payment_type == 'Gateway') {
                                var options = {
                                    "key": "rzp_test_cPY1RE9Kn38kqy",
                                    "amount": data.totalCartAmount * 100,
                                    "currency": "INR",
                                    "name": "The Ethical Man",
                                    "description": "Thank you for shopping",
                                    "image": "https://www.ethicalman.in/wp-content/uploads/2022/01/TEM-Footer-Logo-150x150.png",
                                    "handler": function (response) {
                                        jQuery.ajax({
                                            method: 'post',
                                            url: '/payment-success',
                                            data: {
                                                'user_id': data.user_id,
                                                'order_id': data.order_id,
                                                'payment_id': response.razorpay_payment_id,
                                                'payment_type': data.payment_type,
                                                '_token': token
                                            },
                                            success: function (result) {
                                                if (result.status == 'success') {
                                                    window.location.href = "order_placed";
                                                }
                                            }
                                        })
                                    },
                                    "prefill": {
                                        "name": data.user_name,
                                        "email": data.user_email,
                                        "contact": data.user_phone
                                    },
                                    "theme": {
                                        "color": "#3399cc"
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.open();

                            } else if (data.payment_type == 'COD') {

                                window.location.href = "order_placed";
                                jQuery('#place-order-btn').html(data.msg);
                            }
                        }
                    }
                })

            }
        }
    } else {
        $('#required_error').html('Please accept terms and conditions');
    }

}


function shipToDifferentAdd() {
    $('#inputsFirst4').val('');
    $('#inputsaddress4').val('');
    $('#inputscity4').val('');
    $('#inputsstate4').val('');
    $('#inputspin4').val('');
}
