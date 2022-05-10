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
