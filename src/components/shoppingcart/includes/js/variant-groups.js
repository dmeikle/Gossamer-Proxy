$(document).ready(function () {
    $('.variant-edit').click(function (e) {

        var id = this.dataset.id;

        $.getJSON('/admin/cart/variants/' + id, function (data) {

            var items = [];
            $.each(data, function (key1, val1) {
                $.each(val1, function (key, val) {
                    var item = (JSON.stringify(val));
                    alert(JSON.stringify(val));
                    items.push("<li id='" + val.id + "'>" + val.variant + "</li>");
                });
            });

            $("<ul/>", {
                "class": "my-new-list",
                html: items.join("")
            }).appendTo("body");
        });
    });

    $('.view-variantGroup').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '/admin/cart/variants/' + id;
    })

});