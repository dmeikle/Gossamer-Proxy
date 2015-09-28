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
        var staffId =  $(this).data('id');
     // $('#permissions-form').trigger("reset");
       $('input[type=checkbox]').each(function() 
        { 
            this.checked = false; 
//            if(this.closest('label')) {
//                this.closest('label').removeClass('ui-selected');
//            }
        }); 
        
       $( "#left-feature-slider-edit3" ).toggle( "true"  );
       
       $.get( '/admin/staff/permissionsajax/' + staffId,
           function(data) {
               console.log(data);
                $.each(data.roles, function(i, item) {
                   $('#StaffAuthorization_' + item).prop('checked', true);
                   //$('#StaffAuthorization_' + item).attr('checked', 'true').triggerHandler("selecting");
                   
                   $('#StaffAuthorization_' + item).closest('label').addClass('ui-selected');
                     
                });
            }
        );
        $('#staffId').val(staffId);
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
       $( "#left-feature-slider-edit1" ).toggle( "true"  );
       
       $.get( '/admin/staff/ajaxedit/' + staffId,
           function(data) {
               
                $.each(data.Staff, function(i, item) {
                   $('#Staff_' + i).val(item);
                });
            }
        );
        $('#staffId').val(staffId);
    });
    
    $('#add-user').click(function() {
        $('#myForm').trigger("reset");
       $( "#left-feature-slider-edit1" ).toggle( "true"  );
    })
    
    $('.credentials').click(function() {
        $('#credentials-form').trigger('reset');
        $( "#left-feature-slider-edit2" ).toggle( "true"  );
       var staffId = $(this).data('id');
       $('#staffId').val(staffId);
       $.get( '/admin/staff/credentialsajaxedit/' + staffId,
           function(data) {               
                $('#StaffAuthorization_username').val(data.StaffAuthorization.username);                
            }
        );
    })
    
   $('.cancel-staff').click(function() {
       $( "#left-feature-slider-edit1" ).toggle( "false"  );
   });
   
   $('#StaffAuthorization_cancel').click(function() {
       $( "#left-feature-slider-edit2" ).toggle( "false"  );
   })
   
    $('#cancel-permissions').click(function() {
        $( "#left-feature-slider-edit3" ).toggle( "false"  );
    });
   
    function getCloseButton() {
        return '<a href="#right-panel-slider" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close panel</a>';
    }
  
    
    $('.emergency').click(function(e) {
        $('#credentials-form').trigger('reset');
        $( "#left-feature-slider-edit4" ).toggle( "true"  );
        var staffId = $(this).data('id');
        $('#staffId').val(staffId);
        $.get( '/admin/staff/emergencycontacts/' + staffId,
           function(data) { 
               $.each(data.EmergencyContacts, function(i, value) {
                  var row = '<tr id="row_' + value.id + '">' + 
                    '<td>' + value.lastname + ', ' + value.firstname + '</td>' +
                    '<td>' + value.telephone + '</td>' +
                    '<td>' + value.mobile + '</td>' +
                    '<td>' + value.workTelephone + '</td>' +
                    '<td>' + value.email + '</td>' +
                    '<td>' + value.relation + '</td>' +
                    '<td>buttons go here</td>' +
                  '</tr>';
                  ('#emergency-contacts-list > tbody:last').append(row);
               });
             //   $('#StaffAuthorization_username').val(data.StaffAuthorization.username);                
            }
        );
       
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
  
    });
    
    
    $('#StaffAuthorization_submit').click(function(e) {
        var postData = $('#credentials-form').serializeArray();
        var formUrl = $('#credentials-form').attr('action') + $('#staffId').val();
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
                } else {
                    $( "#left-feature-slider-edit2" ).toggle( "false"  );
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              
                //if fails      
            }
        });
        e.preventDefault(); //STOP default action
        e.unbind(); //unbind. to stop multiple form submit.
  
    });
    
    
    $('#save-permissions').click(function(e) {
        var postData = $('#permissions-form').serializeArray();
        var formUrl = $('#permissions-form').attr('action') + $('#staffId').val();
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
                } else {
                    $( "#left-feature-slider-edit3" ).toggle( "false"  );
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
              
                //if fails      
            }
        });
        e.preventDefault(); //STOP default action
        $('#permissions-form').get(0).reset();
  
    });
    
});