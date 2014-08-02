$( document ).ready(function() {
    $('.edit').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '/admin/cart/products/' + id;
    })
});