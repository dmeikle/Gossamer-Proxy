$( document ).ready(function() {
    $('.locales-edit').click(function (e) {
        var id = this.dataset.id;
        window.location.href='locales/' + id;
    })

    $('.locales-cancel').click(function (e) {
        var id = this.dataset.id;
        window.location.href='locales';
    })
});