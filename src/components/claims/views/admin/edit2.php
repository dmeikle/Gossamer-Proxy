
<!--- javascript start --->
@components/claims/includes/js/jquery.ptTimeSelect.js

<!--- javascript end --->

<!--- css start --->
@components/claims/includes/css/jquery.ptTimeSelect.css

<!--- css end --->


<script language="javascript">

$(document).ready(function() {
  
    $('#previous-2').click(function() {
        //first, you need to save the data and get anew id number
        
        $('#left-feature-slider-edit1').toggle(true);
        $('#left-feature-slider-edit2').toggle(false);
        
    });
  
    $('#next-2').click(function() {
        //first, you need to save the data and get anew id number
        
        $('#left-feature-slider-edit2').toggle(false);
        $('#left-feature-slider-edit3').toggle(true);
        
    });
    
    $( "#Claim_callInDate" ).datepicker({dateFormat: "yy-mm-dd", minDate: 0, maxDate: "+12M +10D" });
    $( "#Claim_timeCalledIn" ).ptTimeSelect();
    
    $('#cancel-2').click(function() {
        $('#left-feature-slider-edit2').toggle(false);
    });
});

</script>

<div class="panel panel-default">
    <div class="panel-heading">
       New Claim - On Site Contact
    </div>
   
    <form class="form-standard" role="form">

        <table class="table">
            <tr>
                <td>Contact Name:</td>
                <td><?php echo $form['contactName'];?></td>
            </tr>
            <tr>
                <td>Contact Phone:</td>
                <td><?php echo $form['contactPhone'];?></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td>Call Received From:</td>
                <td><?php echo $form['calledInBy'];?></td>
            </tr>
            <tr>
                <td>Time:</td>
                <td><?php echo $form['timeCalledIn'];?></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><?php echo $form['callInDate'];?></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><?php echo $form['calledInPhone'];?></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="slider-nav" id="previous-2"><span class="fa fa-arrow-circle-o-left"></span></div> <div class="slider-nav cancel-slider" id="cancel-2"><span class="fa fa-times-circle-o"></span></div> <div class="slider-nav" id="next-2"><span class="fa fa-arrow-circle-o-right"></span></div></td>
            </tr>
        </table>
       
        <?php echo $form['id'];?>
    </form>
</div>
<!--
<h2 class="form-signin-heading">new claim form - type of claim</h2>
                <table class="table">
                	<tr>
                    	<td>Water</td>
                		<td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
                    </tr>
                	<tr>
                    	<td>Fire</td>
                		<td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
                    </tr>
                	<tr>
                    	<td>Sewer Back-UP</td>
                		<td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
                    </tr>
                	<tr>
                    	<td>Vehicle Impact</td>
                		<td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
                    </tr>
                	<tr>
                    	<td>Contents</td>
                		<td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
                    </tr>
                	<tr>
                    	<td>Other</td>
                		<td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
                    </tr>
                	<tr>
                	  <td>Asbestos Test Required:</td>
                	  <td><input placeholder="Username" name="ClaimTypes_id" type="radio" value="1" />
                	    Yes<br /><input placeholder="Username" name="ClaimTypes_id" type="radio" value="1" />
                	    No</td>
              	  </tr>
                
                </table>-->