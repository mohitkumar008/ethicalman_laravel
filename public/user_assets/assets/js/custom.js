function add_to_cart(pid) {
    var size = $('#size').val($('#size_id').val());
    var qty = $('#qty').val($('#quantity').val());
    var pid = $('#pid').val(pid)
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
    jQuery('#place-order-btn').html('Please wait...');
    // alert('s');
    jQuery.ajax({
        url: '/place_order',
        data: jQuery('#billing-address-from, #shipping-address-from, #coupon_code_form, #payment_method_form').serialize(),
        type: 'post',
        success: function (data) {
            if (data.status == 'success') {
                window.location.href = "order_placed";
            }
            jQuery('#place-order-btn').html(data.msg);
        }
    })
}
