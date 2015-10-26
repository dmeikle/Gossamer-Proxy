
$(document).ready(function () {
    $(document).on('click', '.edit', function (e) {
        e.stopPropagation();

        showForm($(this).data('id'), $('#locale_' + $(this).data('id')).html(), $('#languageName_' + $(this).data('id')).html(), $('#isDefault_' + $(this).data('id')).html());
    })

    $(document).on('click', '.remove', function (e) {
        var id = $(this).data('id');
        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Delete item": function () {
                    $.post('/super/locales/remove/' + id);
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
        $.post("/super/locales/" + $('#Locale_localeid').val(), $("#form1").serialize())
                .success(function (data) {
                    if ($('#Locale_id').val() == 0) {
                        addRow(data.Locale[0].id, data.Locale[0].locale, data.Locale[0].languageName, data.Locale[0].isDefault);
                    }

                });

    }

    function addRow(id, locale, name, isDefault) {
        alert(name);
        var row = '<tr id="row_' + id +
                '"><td id="name_' + id + '">' + name + '</td><td id="locale_' + id + '">' + locale + '</td><td id="isDefault_' + id + '">' + isDefault + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id +
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id +
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }


    $("#create-new").button().on("click", function () {
        showForm(0, '', '', '0');
    });

    function showForm(id, locale, langName, isDefault) {
        $('dialog-form').show();
        $('#Locale_locale').val(locale);
        $('#Locale_languageName').val(langName);
        if (isDefault == 1) {
            $('#Locale_isDefault').prop('checked', true);
        } else {
            $('#Locale_isDefault').prop('checked', false);
        }

        $('#Locale_localeid').val(id);
        $("#dialog-form").dialog({
            resizable: false,
            height: 310,
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

})
