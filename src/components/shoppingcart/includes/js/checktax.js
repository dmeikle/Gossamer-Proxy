$(document).ready(function () {
//    $('#stateId').on('change', function () {
//        var id = this.value;
//        var total = $('#subtotal').val(); 
//        $.get('/cart/tax/estimate/' + id + '/' + total), function(data) {
//            
//           console.log(data);
//            $('#taxResult').html(data);
//        }
//    });

    $('#stateId').on('change', function () {
        var id = this.value;
        var total = $('#subtotal').val();
        $.ajax({
            type: "GET",
            url: '/cart/tax/estimate/' + id + '/' + total,
            contentType: "application/json",
            dataType: "json",
            success: function (response) {
                console.log(response);
                $('#taxResult').html(response.tax.toFixed(2));
                updateTotal();
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    function updateTotal() {
        var subtotal = $('#subtotal').val();
        var tax = $('#taxResult').html();

        var total = (parseFloat(subtotal) + parseFloat(tax)).toFixed(2);

        $('#total').html(total);
    }

});