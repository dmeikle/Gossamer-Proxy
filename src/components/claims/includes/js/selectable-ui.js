$(function () {

    $('.selectable').on('mouseup', 'label', function () {
        var el = $(this);
        console.info(el);
        if (el.hasClass('ui-selected')) {
            el.removeClass('ui-selected');
        } else {
            el.addClass('ui-selected');
        }

    })



});