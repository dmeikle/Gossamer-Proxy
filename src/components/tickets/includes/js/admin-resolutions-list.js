
$(document).ready(function () {


    $(document).on('click', '.edit', function (e) {

        getRowData($(this).data('id'));
    });

    function getRowData(id) {
        var jqxhr = $.get("/super/tickets/resolutions/" + id)
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
                    $.post('/super/tickets/resolutions/remove/' + id);
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
        $.post("/super/tickets/resolutions/" + $('#itemId').val(), $("#form1").serialize())
                .success(function (data) {
                    var item = data.TicketResolution[0];
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
            height: 250,
            width: 550,
            modal: true,
            buttons: {
                "Save": function () {
                    save();
                    $('#item_' + id).html($('#TicketResolution_name').val());
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    }

    function parseElements(data) {
        $.each(data.TicketResolution, function (i, item) {
            if (i == 'locales') {
                $.each(item, function (locale, value) {
                    $('#TicketResolution_locale_' + locale + '_resolution').val(value.resolution);
                });
            } else {

                $('#TicketResolution_' + i).val(item);
            }
        });
    }

})
