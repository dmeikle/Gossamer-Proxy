
$(document).ready(function() {
    $(document).on('click', '.edit', function(e){        
            getRowData($(this).data('id'));        
    });
    
    function getRowData(id) {        
        var jqxhr = $.get( "/super/inventory/categories/" + id)
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
                $.post('/super/inventory/categories/remove/' + id);
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
        
        $.post( "/super/inventory/categories/" + $('#Category_id').val(), $( "#form1" ).serialize() )
                .success(function(data) {
                    var eventType = data.Category[0];
                    var locale = eventType.defaultLocale;
                    
                    if($('#Category_categoryId').val() == 0) {
                        addRow(categoryId.id, Category.locale[locale].category) ;
                    }
                   
        });
        
    }
 
    function addRow(id, name) {
        var row = '<tr id="row_' + id + 
                '"><td id="category_' + id +'">' + name + '</td><td> <button class="btn btn-primary btn-xs edit" data-id="' + id + 
                '">Edit</button> <button class="btn btn-primary btn-xs remove" data-id="' + id + 
                '">Remove</button> </td> </tr>'
        $('#table1').append(row);
    }

    
    $( "#create-new" ).button().on( "click", function() {
            showForm(0);
    });
    
    function showForm(id, form) {
        $('dialog-form').show();
        if((form) && (form.Category)) {
            $.each(form.locales, function(key, value) {
                $('#InventoryCategory_locale_' + key + '_category').val(form.Category[0].locales[key].category);            
            });
            
            $('#Category_id').val(form.Category[0].id);
        }
        
        $( "#tabs" ).tabs();
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
