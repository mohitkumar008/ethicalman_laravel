function add_to_cart(pid) {
    var size = $('#size').val($('#size_id').val());
    var qty = $('#qty').val($('#quantity').val());
    var pid = $('#pid').val(pid)
    // alert(pid);
    jQuery.ajax({
        type: 'post',
        url: '/add_to_cart',
        // data: `pid=${pid}&size=${size}&qty=${qty}`,
        data: jQuery('#addtocartform').serialize(),
        success: function (data) {
            alert(data);
        }
    })
}
