
$(document).ready(function() {
    $(document).on('click', '.edit', function(e){
        e.stopPropagation();
        showForm($(this).data('id'), $('#department_' + $(this).data('id')).html());
    })
    
    $(document).on('click', '.remove', function(e){
        var id = $(this).data('id');
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height:140,
          modal: true,
          buttons: {
            "Delete all items": function() {
                $.post('/super/departments/remove/' + id);
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
        $.post( "/super/departments/" + $('#Departments_id').val(), $( "#form1" ).serialize() )
                .success(function(data) {
                    if($('#Departments_id').val() == 0) {
                        addRow(data.Department[0].id, data.Department[0].name) ;
                    }
                   
        });
        
    }
 
    function addRow(id, name) {
        var row = '<tr id="row_' + id + 
                '"><td id="department_6">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id + 
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id + 
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }

    
    $( "#create-department" ).button().on( "click", function() {
       showForm(0, '');
    });
    
    function showForm(id, value) {
        $('dialog-form').show();
        $('#Departments_department').val(value);
        $('#Departments_id').val(id);
        $( "#dialog-form" ).dialog({
            resizable: false,
            height:200,
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
    
})    
