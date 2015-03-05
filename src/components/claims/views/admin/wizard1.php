<script language="javascript">
    
$(document).ready(function() {
               
            
    var cache = {};
  
    function addAnswer( answer ) {
      $( "#sortable" ).append(
      '<li id="Answers_id-' + answer.id + '" class="new"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + answer.value + '</li>'); 
    }
    
    function addAnswerId(answer) {
        $('<input>').attr('type','hidden').attr('name','answerId[]').attr('value', answer.id).appendTo('#form1');
    }
    
    $('#ProjectAddress_strataNumber').on('blur', function(){
        
        $(this).val('');
    });
    
    $( "#ProjectAddress_strataNumber" ).autocomplete({
      minLength: 2,
      select: function( event, ui ) {
          addAnswer(ui.item);
          addAnswerId(ui.item);
          hideSearch();

      },
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );

          addAnswerId(ui.item);
          hideSearch();
          return;
        }
 
        $.post( "/admin/claims/projectaddresses/stratanumber/search", request, function( data, status, xhr ) {

          cache[ term ] = data;
          response( data );
        });
      }
    });
    

});  
    
</script>    

<h2>Create New Claim - Step 1</h2>
<form method="post">
    <table class="class">
        <tr>
            <td>Create new claim by strata #:</td>
        </tr>
        <tr>
            <td><?php echo $form['strataNumber'];?></td>
        </tr>
        <tr>
            <td>Create new claim by building name #:</td>
        </tr>
        <tr>
            <td><?php echo $form['buildingName'];?></td>
        </tr>
        <tr>
            <td>Create new claim by address #:</td>
        </tr>
        <tr>
            <td><?php echo $form['address1'];?></td>
        </tr>
        <tr>
            <td><?php echo $form['cancel'];?> <?php echo $form['next'];?></td>
        </tr>
    </table>
</form>