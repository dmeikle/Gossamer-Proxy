
<script language="javascript">

$(document).ready(function() {
 
   
   
    var cache = {};
    
    $( "#propertyManager" ).autocomplete({        
      minLength: 2,
      select: function( event, ui ) {  
        $('#claim_PropertyManagers_id').val(ui.item.id);
      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
 
        $.post( "/admin/contacts/propertymanagers/search", request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
    
    function loadResponse(data) {
        $('#propertyManager_list').empty();
        $.each(data, function (i, item) {
           $("<div>").text(item.firstname).appendTo('#propertyManager_list');
        });        
    }
  
    $( "#buildingAge" ).datepicker();
  
});

</script>

<form class="form-standard" role="form" method="post">
                <h2 class="form-signin-heading">new claim form</h2>
                <table class="table">
                    </tr>
                	<tr>
                    	<td>Strata No:</td>
                		<td><input class="form-control" placeholder="Strata No" name="claim[strataNumber]" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Project Name</td>
                		<td><input class="form-control" placeholder="Project Name" name="claim[projectName]" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Property Manager</td>
                		<td><input class="form-control" placeholder="Property Manager" id="propertyManager"  />                                
                                <input type="hidden" id="claim_PropertyManagers_id" name="claim[PropertyManagers_id]" />                                
                        </td>
                	<tr>
                    	<td>Property MGMT Co:</td>
                		<td><input class="form-control" placeholder="Property MGMT Co" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Source Unit:</td>
                		<td><input class="form-control" placeholder="Source Unit" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Affected Units:</td>
                		<td><input class="form-control" placeholder="Affected Units" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Address:</td>
                		<td><input class="form-control" placeholder="Address" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>City:</td>
                		<td><input class="form-control" placeholder="City" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Phone/Fax/Cell:</td>
                		<td><input class="form-control" placeholder="Phone/Fax/Cell" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                    	<td>Building Year:</td>
                	<td><input id="buildingAge" class="form-control" placeholder="building age" name="buildingAge" type="text" /></td>
                    </tr>
                
                </table>
                	
                	<button class="btn btn-lg btn-primary btn-block" type="submit">Next</button>
              	</form>
