$(document).ready(function () {



    $('.pagination').click(function (e) {
        e.stopPropagation();
        var url = $(this).data('url');

        window.location = url + '/' + $(this).data('offset') + '/' + $(this).data('limit');
    });

    $('#resultsPerPage').change(function () {
        var num = $('#resultsPerPage').val();
        var url = $(this).data('url');
        window.location.href = url + '/0/' + num;
    });
});