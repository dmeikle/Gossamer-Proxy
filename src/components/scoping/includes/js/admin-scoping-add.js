

$(function () {
    // $( "#requestDate" ).datepicker();

    //  $( "#requestDate" ).datepicker( "option", "showAnim", $( this ).val() );

    function log(id, message) {
        var option = new Option(message, id);
        $(option).html(message);
        $("#projectAddress").find('option').remove().end().append(option);
        $('#projectAddress').html(message);
        $('#projectAddressId').val(id);
        $('#projectAddress_input').hide();

    }
    $('projectAddress_input').focus(function () {
        $(this).val('');
    });


    var cache = {};
    $("#projectAddress_input").autocomplete({
        minLength: 2,
        select: function (event, ui) {
            if (ui.item) {
                log(ui.item.id, ui.item.value);
            }
        },
        source: function (request, response) {
            var term = request.term;
            if (term in cache) {
                response(cache[ term ]);
                return;
            }

            $.post("/admin/projects/addresses/search", request, function (data, status, xhr) {
                cache[ term ] = data;
                response(data);
            });
        }

    });

    $('#enterAddress').click(function (event) {
        event.preventDefault();
        $('#projectAddress_input').val('');
        $('#projectAddress_input').show();

    })


});