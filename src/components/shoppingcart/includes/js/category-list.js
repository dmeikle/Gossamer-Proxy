$(document).ready(function () {
    $('.edit').click(function (e) {
        var id = this.dataset.id;
        window.location.href = 'category/' + id;
    })

    $('.cancel').click(function (e) {
        var id = this.dataset.id;
        window.location.href = 'categories';
    })
});