$(document).ready(function () {

    $('.cancel').click(function (e) {
        var id = this.dataset.id;
        window.location.href = '../categories';
    })
});