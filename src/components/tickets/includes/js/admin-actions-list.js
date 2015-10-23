
$(document).ready(function () {


    $(document).on('click', '.edit', function (e) {

        getRowData($(this).data('id'));
    });

    function getRowData(id) {
        var jqxhr = $.get("/super/tickets/actions/" + id)
                .done(function (data) {
                    showForm($(this).data('id'), data);
                    $('#itemId').val(id);
                });
    }


    $(document).on('click', '.remove', function (e) {
        var id = $(this).data('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Delete item": function () {
                    $.post('/super/tickets/actions/remove/' + id);
                    $(this).dialog("close");
                    $('#row_' + id).remove();
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });

    })


    function save() {
        //get it now in case it gets changed after saving
        var itemId = $('#itemId').val();
        $.post("/super/tickets/actions/" + $('#itemId').val(), $("#form1").serialize())
                .success(function (data) {
                    var item = data.TicketAction[0];
                    var locale = item.defaultLocale;

                    if (itemId == 0) {
                        addRow(item.id, item.locale[locale].name);
                    }

                });

    }

    function addRow(id, name) {
        var row = '<tr id="row_' + id +
                '"><td id="item_' + id + '">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id +
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id +
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }


    $("#create-new").button().on("click", function () {
        $('#form1').trigger("reset");
        $('#itemId').val(0);
        showForm(0, '');
    });

    function showForm(id, form) {
        $('dialog-form').show();
        if (form != '') {
            parseElements(form);
        }

        $('#statusId').val(id);
        $("#dialog-form").dialog({
            resizable: false,
            height: 400,
            width: 550,
            modal: true,
            buttons: {
                "Save": function () {
                    save();
                    $('#item_' + id).html($('#TicketAction_action').val());
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    }

    function parseElements(data) {
        $.each(data.TicketAction, function (i, item) {
            if (i == 'locales') {
                $.each(item, function (locale, value) {
                    $('#TicketAction_locale_' + locale + '_action').val(value.action);
                    $('#TicketAction_locale_' + locale + '_history').val(value.history);
                });
            } else {

                $('#TicketAction_' + i).val(item);
            }
        });
    }

})
