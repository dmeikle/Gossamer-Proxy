$(document).ready(function () {
    $(document).ready(function () {
        $('.edit').editable('http://www.example.com/save.php');
    });

    $(".dblclick").editable("/admin/cart/sales_edit", {
        submitdata: {clientId: $('#clientId').val()},
        //indicator : "<img src='img/indicator.gif'>",
        tooltip: "Doubleclick to edit...",
        event: "dblclick",
        style: "inherit"
    });
});