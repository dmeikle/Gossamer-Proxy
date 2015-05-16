


<script language="javascript">

$(document).ready(function() {
 
   
   
    var cache = {};
    
    $( "#ProjectAddress_strataNumber" ).autocomplete({        
      minLength: 2,
      select: function( event, ui ) {  
        $('#projectAddressId').val(ui.item.id);
        //var result = JSON.parse(ui.item);
       $('#ProjectAddress_buildingName').val(ui.item.buildingName);
       $('#ProjectAddress_city').val(ui.item.city);
       $('#ProjectAddress_projectAddressId').val(ui.item.id);
       $('#ProjectAddress_address1').val(ui.item.address1);
      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
 
        $.post( "/admin/projects/addresses/search", request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      }
    });
    
    function loadResponse(data) {
        $('#strataNumber_results').empty();
        $.each(data, function (i, item) {
           $("<div>").text(item.firstname).appendTo('#strataNumber_results');
        });        
    }
  
    $( "#buildingAge" ).datepicker();
  
  
    $('#next-1').click(function() {
        //first, you need to save the data and get anew id number
        
        $('#left-feature-slider-edit1').toggle(false);
        $('#left-feature-slider-edit2').toggle(true);
        
    });
    
    $('#cancel-1').click(function() {
        $('#left-feature-slider-edit1').toggle(false);
    });
});

</script>

<div class="panel panel-default">
    <div class="panel-heading">
       New Claim Form
    </div>
   
    <form class="form-standard" role="form" method="post">
       
        <?php 
            echo $this->getContent('projectaddress_get_form', array(0));
        ?>

        <table class="table">
      
    <!--                        
            </tr>
                <tr>
                <td>Property Manager</td>
                        <td><input class="form-control" placeholder="Property Manager" id="propertyManager"  />                                
                        <input type="hidden" id="claim_PropertyManagers_id" name="claim[PropertyManagers_id]" />                                
                </td>
                <tr>
                <td>Property MGMT Co:</td>
                        <td><input class="form-control" placeholder="Property MGMT Co" name="dateReceived" type="text" /></td>
            </tr>-->
            <tr>
                <td>Source Unit:</td>
                <td><?php echo $form['sourceUnit'];?></td>
            </tr>
            <tr>
                <td>Reason:</td>
                <td><?php echo $form['reason'];?></td>
            </tr>
            <tr>
                <td>Affected Units:</td>
                <td><input class="form-control" placeholder="affected units" id="affectedUnits" name="affectedUnits" type="text" /></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="slider-nav cancel-slider" id="cancel-1"><span class="fa fa-times-circle-o"></span></div> <div class="slider-nav" id="next-1"><span class="fa fa-arrow-circle-o-right"></span></div></td>
            </tr>

        </table>

    </form>
</div>