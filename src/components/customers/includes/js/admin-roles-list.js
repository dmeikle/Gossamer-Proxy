
$(document).ready(function () {
    $(document).on('click', '.edit', function (e) {
        e.stopPropagation();

        showForm($(this).data('id'), $('#role_' + $(this).data('id')).html(), $('#title_' + $(this).data('id')).html());
    })

    $(document).on('click', '.remove', function (e) {
        var id = $(this).data('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Delete item": function () {
                    $.post('/super/customers/roles/remove/' + id);
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
        $.post("/super/customers/roles/" + $('#Role_id').val(), $("#form1").serialize())
                .success(function (data) {
                    if ($('#Role_id').val() == 0) {
                        addRow(data.CustomerRole[0].id, data.CustomerRole[0].role, data.CustomerRole[0].title);
                    }

                });

    }

    function addRow(id, name, title) {
        var row = '<tr id="row_' + id +
                '"><td id="role_' + id + '">' + name + '</td><td id="title_' + id + '">' + title + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id +
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id +
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }


    $("#create-new").button().on("click", function () {
        showForm(0, '');
    });

    function showForm(id, value, title) {

        $('dialog-form').show();
        $('#Role_role').val(value);
        $('#Role_title').val(title);
        $('#Role_id').val(id);
        $("#dialog-form").dialog({
            resizable: false,
            height: 250,
            modal: true,
            buttons: {
                "Save": function () {
                    save();
                    $('#role_' + id).html($('#Role_role').val());
                    $('#title_' + id).html($('#Role_title').val());
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    }

})
