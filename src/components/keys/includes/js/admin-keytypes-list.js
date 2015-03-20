
$(document).ready(function() {
    $(document).on('click', '.edit', function(e){
        e.stopPropagation();
        showForm($(this).data('id'), $('#keytype_' + $(this).data('id')).html());
    })
    
    $(document).on('click', '.remove', function(e){
        var id = $(this).data('id');
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height:140,
          modal: true,
          buttons: {
            "Delete item": function() {
                $.post('/super/keys/types/remove/' + id);
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
        $.post( "/super/keys/types/" + $('#KeyType_id').val(), $( "#form1" ).serialize() )
                .success(function(data) {
                    if($('#KeyType_id').val() == 0) {
                        addRow(data.KeyType[0].id, data.KeyType[0].description) ;
                    }
                   
        });
        
    }
 
    function addRow(id, name) {
        var row = '<tr id="row_' + id + 
                '"><td id="keytype_' + id + '">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id + 
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id + 
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }

    
    $( "#create-new" ).button().on( "click", function() {
       showForm(0, '');
    });
    
    function showForm(id, value) {
        $('dialog-form').show();
        $('#KeyTypes_type').val(value);
        $('#KeyType_id').val(id);
        $( "#dialog-form" ).dialog({
            resizable: false,
            height:200,
            modal: true,
            buttons: {
              "Save": function() {
                  save();
                  $('#keytype_' + id).html( $('#KeyTypes_type').val());
                $( this ).dialog( "close" );
              },
              Cancel: function() {
                $( this ).dialog( "close" );
              }
            }
          });
    }
    
})    
