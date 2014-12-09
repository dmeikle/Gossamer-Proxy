$(function() {
    $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone"
    });
    $( "#cart ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
       
        $( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
       
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    $(".loadOptions").click(function(e) {
         var id = this.dataset.id;
         $.ajax({
            url: '/admin/cart/variants/' + id,
            success: function(data) {alert('here1');
               
                var json = JSON.stringify(data);
                alert(json[1].variant);
            },
            fail: function(data) {alert('there2');
                var json = $.parseJSON(data);
                alert(json)
            },
            dataType: 'json',
            type: 'get'
        });
    })
  });