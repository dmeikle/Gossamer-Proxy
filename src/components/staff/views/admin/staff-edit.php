<a href="/admin/staff/0/20">go</a>	
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css"/>
<script src="/js/jqm/jquery.js"></script>
<script src="/js/jquery-ui.js"></script>

<script>
$(function() {
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
    
    
});
</script>

<div id="tabs">
<ul>
  
  <li><a href="#contact-info">Contact Info</a></li>
  <li><a href="#company-info">Company Info</a></li>
  <li><a href="#personal-info">Personal Info</a></li>
  <li><a href="#emergency-info">Emergency Info</a></li>
  <li><a href="#equipment-info">Equipment</a></li>
  <li style="float: right"> <?php echo $form['isActive'];?>This employee is active</li>
</ul>
<form method="post" role="form" class="form-standard">
  <div id="contact-info">
  
  <table class="table">
    <tr>
      <td>Firstname:</td>
      <td>&nbsp;</td>
      <td colspan="2" rowspan="4"><img src="" width="150" /></td>
      </tr>
    <tr>
      <td>Lastname:</td>
      <td><?php echo $form['lastname']; ?></td>
      </tr>
    <tr>
      <td>Telephone:</td>
      <td><?php echo $form['telephone']; ?></td>
      </tr>
    <tr>
      <td>Mobile:</td>
      <td><?php echo $form['mobile']; ?></td>
      </tr>
    <tr>
      <td>Personal Email:</td>
      <td><?php echo $form['personalEmail']; ?></td>
      <td colspan="2">Email Signature</td>
      </tr>
    <tr>
      <td>Address:</td>
      <td><?php echo $form['address2']; ?><?php echo $form['address1']; ?></td>
      <td colspan="2" rowspan="4"><?php echo $form['signature']; ?></td>
      </tr>
    <tr>
      <td>City:</td>
      <td><?php echo $form['city']; ?></td>
      </tr>
    <tr>
      <td>Province:</td>
      <td><?php echo $form['Provinces_id']; ?></td>
      </tr>
    <tr>
      <td>Postal Code:</td>
      <td><?php echo $form['postalCode']; ?></td>
      </tr>
  </table>
  </div>
  
  <div id="company-info">
    <table class="table">
      <tr>
        <td>Firstname:</td>
        <td><?php echo $form['firstname']; ?></td>
      <td rowspan="10"><img src="" width="150" />
          <?php echo $form['imageName']; ?>
      </tr>
      <tr>
        <td>Lastname</td>
        <td><?php echo $form['lastname']; ?></td>
      </tr>
      <tr>
        <td>Company Email:</td>
        <td><?php echo $form['email']; ?></td>
      </tr>
      <tr>
        <td>Staff Type:</td>
        <td><?php echo $form['StaffTypes_id']; ?></td>
      </tr>
      <tr>
        <td>Department:</td>
        <td><?php echo $form['Departments_id']; ?></td>
      </tr>
      <tr>
        <td>Position:</td>
        <td><?php echo $form['Positions_id']; ?></td>
      </tr>
      <tr>
        <td>Employee #</td>
        <td><?php echo $form['employeeNumber']; ?></td>
      </tr>
      <tr>
        <td>Hire Date</td>
        <td><?php echo $form['hireDate']; ?></td>
      </tr>
      <tr>
        <td>Departure Date:</td>
        <td><?php echo $form['departureDate']; ?></td>
      </tr>
    </table>
  </div>
  
  
  <div id="personal-info">
    <table class="table">
      <tr>
        <td>Firstname:</td>
        <td><?php echo $form['firstname']; ?></td>
      <td rowspan="6"><img src="" width="150" />
      </tr>
      <tr>
        <td>Lastname</td>
        <td><?php echo $form['lastname']; ?></td>
      </tr>
      <tr>
        <td>Gender:</td>
        <td><?php echo $form['gender']; ?></td>
      </tr>
      <tr>
        <td>D.O.B.:</td>
        <td><?php echo $form['dob']; ?></td>
      </tr>
      <tr>
        <td>SIN:</td>
        <td><?php echo $form['SIN']; ?></td>
      </tr>
      <tr>
        <td>Alarm Password:</td>
        <td><?php echo $form['alarmPassword']; ?></td>
      </tr>
    </table>
  </div>
    <?php if(isset($id) && $id > 0) {?>
    <div id="emergency-info">
        <a href="#" class="add-emergency">add emergency contact</a>
        <table class="table">
             <tr>
            <td>Name </td>
            <td>Telephone</td>
            <td>Mobile</td>
            <td>Work Telephone</td>
            <td>Relation</td>
            <td>Email</td>
            <td>Action
        </tr>
        <?php foreach($emergencyContacts as $contact) {?>
        <tr>
            <td><?php echo $contact['firstname'];?> <?php echo $contact['lastname'];?> </td>
            <td><?php echo $contact['telephone'];?></td>
            <td><?php echo $contact['mobile'];?></td>
            <td><?php echo $contact['workTelephone'];?></td>
            <td><?php echo $contact['relation'];?></td>
            <td><?php echo $contact['email'];?></td>
            <td><input type="button" class="remove" data-id="<?php echo $contact['id'];?>" value="remove" /></td>
        </tr>
        <?php } ?>
        </table>
    </div>
    <?php } ?>
   <?php echo $form['cancel'];?> <?php echo $form['submit'];?> 
</form>
</div>
<style>
    #dialog-confirm {
        display: none;
    }
</style>
<div id="dialog-confirm" title="Add New Emergency Contact">
    <form method="post" id=emergencyContact">
  <table class="table">
    <tr>
      <td>Firstname:</td>
      <td><?php echo $eform['firstname']; ?></td>
      </tr>
    <tr>
      <td>Lastname:</td>
      <td><?php echo $eform['lastname']; ?></td>
      </tr>
    <tr>
      <td>Telephone:</td>
      <td><?php echo $eform['telephone']; ?></td>
      </tr>
    <tr>
      <td>Mobile:</td>
      <td><?php echo $eform['mobile']; ?></td>
      </tr>
    <tr>
      <td>Relation:</td>
      <td><?php echo $eform['relation']; ?></td>      
      </tr>
    <tr>
      <td>Work Telephone:</td>
      <td><?php echo $eform['workTelephone']; ?></td>
      </tr>
   
  </table>
    </form>
</div>