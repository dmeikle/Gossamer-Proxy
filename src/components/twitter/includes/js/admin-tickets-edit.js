/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


$(function() {
   
    var cache = {};
    
    var currentSearch = '';
    var currentStaff = '';
    
    
    $( "#lowertabs" ).tabs();
    
 
    
    
    $( "#Ticket_assignedStaff" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {  
            changeAssignedStaff(ui.item.id);
            $('#Ticket_Staff_id').val(ui.item.id);
       
      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
        currentSearch = 'staffResults';
        $.getJSON( "/admin/staff/search/" , request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
    
   
    function getLocations() {
        $.getJSON( "/admin/claimlocations/claim/" + $('#Ticket_Claims_id').val(), function(data) {
            var options =  $('#Ticket_ClaimsLocations_id');
            options.append('<option value="null">Choose Location</option>');
            
            $.each(data.ClaimsLocations, function(key, obj) {
                options.append($("<option />").val(obj.id).text(obj.unitNumber));
            });   
            
            $('#location').show();
        });
        
    }
   
    function changeAssignedStaff(id) {;
        if(parseInt($("#Ticket_id").val()) == 0) {
            return;
        }
        
        $.post("/admin/tickets/changeassignee/" + $("#Ticket_id").val(), {staffId: id})
    }
    
    
    $( "#Ticket_jobNumber" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {  
        $('#Ticket_Claims_id').val(ui.item.id);
        getLocations();
      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
        currentSearch = 'jobNumberResults';
        $.getJSON( "/admin/claims/search/" , request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
    
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#" + currentSearch );
      $( "#" + currentSearch ).scrollTop( 0 );
    }
    
    
    $("#save").click(function() {
        $.post("/admin/tickets/" + $("#Ticket_id").val(),  $("#ticket-info").serialize())
    });
    
    
  });