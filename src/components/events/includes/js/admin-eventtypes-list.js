
$(document).ready(function() {
    $(document).on('click', '.edit', function(e){
        getRowData($(this).data('id'));
    });
    
    function getRowData(id) {        
        var jqxhr = $.get( "/super/events/eventtypes/" + id)
        .done(function(data) {
            showForm($(this).data('id'), data);
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
                $.post('/super/events/eventtypes/remove/' + id);
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
        
        $.post( "/super/events/eventtypes/" + $('#EventType_typeId').val(), $( "#form1" ).serialize() )
                .success(function(data) {
                    var eventType = data.EventType[0];
                    var locale = eventType.defaultLocale;
                    
                    if($('#EventType_typeId').val() == 0) {
                        addRow(eventType.id, eventType.locale[locale].type) ;
                    }
                   
        });
        
    }
 
    function addRow(id, name) {
        var row = '<tr id="row_' + id + 
                '"><td id="eventtype_' + id +'">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id + 
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id + 
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }

    
    $( "#create-eventtype" ).button().on( "click", function() {
       
       getRowData(0);
    });
    
    function showForm(id, form) {
        $('dialog-form').show();
        if(form != '') {
            $('#form1').html(form);
        }
        $( "#tabs" ).tabs();
        $('#EventType_id').val(id);
        $( "#dialog-form" ).dialog({
            resizable: false,
            height:280,
            width:500,
            modal: true,
            buttons: {
              "Save": function() {
                  save();
                $( this ).dialog( "close" );
              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
          });
    }
    
    $( "#tabs" ).tabs();
})    
