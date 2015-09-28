
$(document).ready(function() {
   
    
    $(document).on('click', '.edit', function(e){
      //  $('#statusId').val($(this).data('id'));
        getRowData($(this).data('id'));
    });
    
    function getRowData(id) {        
        var jqxhr = $.get( "/super/tickets/statuses/" + id)
        .done(function(data) {
            showForm($(this).data('id'), data);
            $('#statusId').val(id);
        });
    }
    
    
    $(document).on('click', '.remove', function(e){
        var id = $(this).data('id');
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height:140,
          modal: true,
          buttons: {
            "Delete item": function() {
                $.post('/super/tickets/statuses/remove/' + id);
                $( this ).dialog( "close" );
                $('#row_' + id).remove();
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
          }
        });
       
    }) 
    
    
    function save() {
        
        $.post( "/super/tickets/statuses/" + $('#statusId').val(), $( "#form1" ).serialize() )
                .success(function(data) {
                    var status = data.TicketStatus[0];
                    var locale = status.defaultLocale;
                    
                    if($('#statusId').val() == 0) {
                        addRow(status.id, status.locale[locale].status) ;
                    }
                   
        });
        
    }
 
    function addRow(id, name) {
        var row = '<tr id="row_' + id + 
                '"><td id="status_' + id + '">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id + 
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id + 
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }

    
    $( "#create-new" ).button().on( "click", function() {
        $('#form1').trigger("reset");
        showForm(0, '');
    });
    
    function showForm(id, form) {
        $('dialog-form').show();
         if(form != '') {
           parseElements(form);
        }
       
        $('#statusId').val(id);
        $( "#dialog-form" ).dialog({
            resizable: false,
            height:250,
            width: 500,
            modal: true,
            buttons: {
              "Save": function() {
                  save();
                  $('#status_' + id).html( $('#TicketStatus_status').val());
                $( this ).dialog( "close" );
              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
          });
    }
    
    function parseElements(data) {
        $.each(data.TicketStatus, function(i, item) {           
            if(i == 'locales'){               
                $.each(item, function(locale, value) {
                    $('#TicketStatus_locale_'+ locale + '_status').val(value.status);                   
                });
            }
        });
    }
    
})    
