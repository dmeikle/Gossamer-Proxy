$(document).ready(function () {

    $(".confirm").confirm({
        text: "Are you sure you want to remove that purchase?",
        title: "Confirmation required",
        confirm: function (button) {
            var id = $(button).attr('data-id');

            $("#purchaseId").val(id);
            $("#removeItemForm").submit();
        },
        cancel: function (button) {
            // do something
        },
        confirmButton: "Yes I am",
        cancelButton: "No",
        post: true
    });

    $('.view-sale').click(function () {
        var id = $(this).attr('data-id');
        window.location.href = '/admin/cart/sales/' + id;
    });

    $('#resultsPerPage').change(function () {
        var num = $('#resultsPerPage').val();
        window.location.href = '/admin/cart/sales/0/' + num;
    });
});