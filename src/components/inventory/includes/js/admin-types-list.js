
$(document).ready(function () {
    $(document).on('click', '.edit', function (e) {
        getRowData($(this).data('id'));
    });

    function getRowData(id) {
        var jqxhr = $.get("/super/inventory/types/" + id)
                .done(function (data) {
                    showForm($(this).data('id'), data);
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
                    $.post('/super/inventory/types/remove/' + id);
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

        $.post("/super/inventory/types/" + $('#InventoryType_id').val(), $("#form1").serialize())
                .success(function (data) {

                    var inventoryType = data.Type[0];

                    if ($('#InventoryType_id').val() == 0) {
                        addRow(inventoryType.id, inventoryType.name);
                    }

                });

    }

    function addRow(id, name) {
        var row = '<tr id="row_' + id +
                '"><td id="type_' + id + '">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id +
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id +
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }


    $("#create-new").button().on("click", function () {
        showForm(0);
    });

    function showForm(id, form) {
        $('dialog-form').show();
        if ((form) && (form.Type)) {
            $.each(form.locales, function (key, value) {
                $('#InventoryType_locale_' + key + '_type').val(form.Type[0].locales[key].type);
            });

            $('#Type_id').val(form.Type[0].id);
        }

        $("#tabs").tabs();
        $("#dialog-form").dialog({
            resizable: false,
            height: 280,
            width: 500,
            modal: true,
            buttons: {
                "Save": function () {
                    save();
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    }

    $("#tabs").tabs();
})
