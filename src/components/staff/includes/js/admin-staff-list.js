/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */



  $(document).ready(function() {

    var currentStatus = '';
    
    $('.permissions').click(function(e) {
        e.stopPropagation(); 
        window.location = '/admin/staff/permissions/' + $(this).data('id');       
    });
    
    $('.status').click(function(e) {
         e.stopPropagation(); 
         $(this).prev('.status-select').toggle();
         if($(this).text() == 'cancel') {
            $(this).text(currentStatus);
         } else {
            currentStatus = $(this).prev('.staffStatus').val();
            $(this).text('cancel');
         }
         
    });
    
//    $('.staffStatus').click(function(e) {
//         e.stopPropagation();        
//         $(this).prev().toggle();
//         $(this).toggle();
//    });
//    
    $('.staffStatus').change(function() {
        
         if($(this).val() != currentStatus && confirm("are you sure you want to change the status of this employee?")) {
            alert('this will eventually perform a save'); //save();
            $(this).next().text($(this).val());
         } else {
            $(this).next().text(currentStatus); 
         }
                 
         $(this).toggle();
    });
    $.ajaxSetup({
    beforeSend:function(){
        // show gif here, eg:
        $("#loading").show();
    },
    complete:function(){
        // hide gif here, eg:
        $("#loading").hide();
    }
});
    $('.edit').click(function(e) {
       var staffId =  $(this).data('id');
       $('#myForm').trigger("reset");
       $( "#staff-edit-slider" ).panel( "open"  );
       
       $.get( '/admin/staff/ajaxedit/' + staffId,
           function(data) {
               
                $.each(data.Staff, function(i, item) {
                   $('#Staff_' + i).val(item);
                });
            }
        );
        $('#staffId').val(staffId);
    });
    
   
    function getCloseButton() {
        return '<a href="#right-panel-slider" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close panel</a>';
    }
    $('.credentials').click(function(e) {
       // e.stopPropogation();
        window.location = '/admin/staff/credentials/' + $(this).data('id');  
    });
    
    $('.emergency').click(function(e) {
       // e.stopPropogation();
        window.location = '/admin/staff/emergencycontacts/' + $(this).data('id');  
    });
    
    ///////////// edit pane //////////////
    

    $( "#tabs" ).tabs();
    $( ".datepicker" ).datepicker();


    $('.remove').click(function() {
        url = '/admin/staff/emergencycontacts/remove/' + $(this).data('id');
        alert(url);
    });

    $("#dialog-confirm").dialog({
      autoOpen: false,
      modal: true
    });
    
    $('.add-emergency').click(function() {        
        
        var url = '/admin/staff/emergencycontacts/' + $(this).data('id');
        
        $("#dialog-confirm").dialog({
          buttons : {
            "Confirm" : function() {
              alert('submit');
            },
            "Cancel" : function() {
              $(this).dialog("close");
            }
          }
        });

        $("#dialog-confirm").dialog("open");

    });


    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:440,
      width: 400,
      modal: true,
      buttons: {
        "Delete selected item": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    
    $('#Staff_submit').click(function(e) {
        var postData = $('#staff-form').serializeArray();
        var formUrl = $('#staff-form').attr('action') + $('#staffId').val();
        $('.validation_error').remove();
        
        $.ajax( 
        {
            url : formUrl,
            type: "POST",
            data : postData,
            success:function(response, textStatus, jqXHR) 
            {
                if(response.result == 'error') {
                    $.each(response.data.Staff, function(i, item) {
                        //go to the parent since the system auto-wraps a styling div around our element
                        $('<div class="validation_error">' + item + '</div>').insertAfter($('#Staff_' + i).parent());
                    });
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              
                //if fails      
            }
        });
        e.preventDefault(); //STOP default action
        e.unbind(); //unbind. to stop multiple form submit.
//        $.post('/admin/staff/ajaxsave/' + $('#staffId').val(), function(data) {
//            $( "#staff-edit-slider" ).panel( "close"  );
//        });
        
        
    })
});