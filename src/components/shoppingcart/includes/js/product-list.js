$(document).ready(function () {
    $('.edit').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '/admin/cart/products/' + id;
    })

    $('.discount').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '/admin/cart/discounts/' + id;
    })

    $('.variants').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '/admin/cart/variants/select/' + id;
    })
});