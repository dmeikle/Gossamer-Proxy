$( document ).ready(function() {

    $('.cancel').click(function (e) {
        var id = this.dataset.id;
        window.location.href='../cart/products/0/20';
    });
    
    $('#addRow').click(function () {
        var numDiscounts = $('#numDiscounts').val();
        $('#fields').append('<tr><td><input type="text" name="volumeDiscount[' + (++numDiscounts) +
                '][quantity]" /></td><td><input type="text" name="volumeDiscount[' + numDiscounts + '][price]" /></td></tr>');
        $('#numDiscounts').val(numDiscounts);
      });
});