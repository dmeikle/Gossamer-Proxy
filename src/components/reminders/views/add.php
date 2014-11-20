
<!--- javascript start --->

    @components/reminders/includes/js/jquery.datetimepicker.js
<!--- javascript end --->

<!--- css start --->

    @components/reminders/includes/css/jquery.datetimepicker.css
<!--- css end --->

 <script language="javascript">
$(document).ready(function() {
    $( "#reminder_notificationDate" ).datetimepicker();
    
    $('#reminder_claimId').change(function() {
       var id = $('#reminder_claimId').val();
       
       $.ajax({
            url: '/admin/claimlocations/claim/' + id,
            data: null,
            success: loadLocationsList,
            dataType: "json",
            fail: fail
        });
    });
    
    function fail() {
       
    }
    function loadLocationsList(data) {
        var $select = $('#reminder_claimslocations'); 
        $select.find('option').remove();  
        $select.append('<option value=0>Public Area</option>');
        $.each(data.ClaimsLocations,function(i, row) 
        {
            $select.append('<option value=' + row.id + '>Unit ' + row.unitNumber + '</option>');
        });
    }
    
});
</script>

** need to add notification types selection box
<form method="post" role="form">
    <table class="table">
      <tr>
        <td>Notification Date:</td>
        <td><input class="form-control" type="text" name="reminder[notificationDate]" id="reminder_notificationDate" value="<?php echo $StaffReminder['notificationDate'];?>"/></td>
      </tr>
      <tr>
        <td>Project:</td>
        <td><select class="form-control" name="reminder[Claims_id]" id="reminder_claimId">
                <option value="0"></option>
                <?php echo $claimsList; ?>
        </select></td>
      </tr>
      <tr>
        <td>Location:</td>
        <td><select class="form-control" name="reminder[ClaimsLocations_id]" id="reminder_claimslocations">
        </select></td>
      </tr>
      <tr>
        <td>Subject:</td>
        <td><input class="form-control" type="text" name="reminder[subject]" id="reminder_subject" value="<?php echo $StaffReminder['subject'];?>"/></td>
      </tr>
      <tr>
        <td>Message:</td>
        <td><textarea class="form-control" name="reminder[message]" id="reminder_message" cols="45" rows="5"><?php echo $StaffReminder['message'];?></textarea></td>
      </tr>
      <tr>
        <td>Remind Time:</td>
        <td><select class="form-control" name="reminder[remindBeforeTime]" id="reminder_remindbeforetime">
                <option value="15">15 minutes</option>
                <option value="30">30 minutes</option>
                <option value="60">1 hour</option>
                <option value="120">2 hours</option>
                <option value="1440">1 day</option>
                <option value="2880">2 days</option>
                <option value="10080">1 week</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
            <button class="btn btn-primary" id="save">Save</button> 
            <button class="btn btn-primary" id="cancel">Cancel</button> 
        </td>
      </tr>
    </table>
</form>