
<!--- javascript start --->
@components/staff/includes/js/admin-staff-list.js
<!--- javascript end --->

<!--- css start --->
@components/staff/includes/css/admin-staff-list.css
<!--- css end --->

<form method="post" style="float:right">
    here is search
</form>

<div id="loading" style="display:none"><img src="/css/jqm/images/ajax-loader.gif"></div>
      <h2 class="form-signin-heading">Staff List</h2>
  
              <?php 
			  $count = 0;
			  
			  foreach($Staffs as $staff) {
                  if($staff['firstname'] == '') {
                      continue;
                  }
              
//			if($count++ %4 == 0) {
//				echo '<div style="clear:both"></div>';
//			}
            ?>
            <div class="staff-member" data-id="<?php echo $staff['id'];?>">
            <img src="/images/feature.png" width="100" />
                <div class="name"><?php echo $staff['lastname'];?>, <?php echo $staff['firstname'];?></div>
                <div class="title"><?php echo $staff['title'];?></div>
                <div class="department"><?php echo (isset($staff['Departments_id'])? $DepartmentsList[$staff['Departments_id']] : '(not specified)');?></div>
                <div class="mobile">Mobile: <?php echo $staff['mobile'];?></div>
                <div class="telephone">Extension: <?php echo $staff['telephone'];?></div>
                <div class="email"><?php echo $staff['email'];?></div>
                <div>
                <div class="status-select" style="display:none">
                   <select class="staffStatus">
                        <option <?php echo ($staff['status'] == 'active') ? 'selected' :'';?>>active</option>
                        <option <?php echo ($staff['status'] == 'suspended') ? 'selected' :'';?>>suspended</option>
                        <option <?php echo ($staff['status'] == 'locked') ? 'selected' :'';?>>locked</option>
                    </select>
                    </div>
                    <a data-type="status" onclick="return false;" class="status"><?php echo $staff['status'];?></a>
                </div>
                <div align="center"><?php echo (time() - strtotime($staff['lastLogin'])) < 20000? '<span class="glyphicon glyphicon-star"></span>':'' ;?></div>
                <div>last Login: <?php echo $staff['lastLogin'];?></div>
                <div>
                    <a href="#" data-id="<?php echo $staff['id'];?>" class="btn btn-primary btn-xs schedule">Schedule</a> 
                    <a href="#" data-id="<?php echo $staff['id'];?>" class="btn btn-primary btn-xs edit">Edit</a> 
                    <a href="#" class="btn btn-primary btn-xs credentials" data-id="<?php echo $staff['id'];?>">Credentials</a> 
                    <a href="#" class="btn btn-primary btn-xs permissions" data-id="<?php echo $staff['id'];?>">Permissions</a> 
                    <a href="#" class="btn btn-primary btn-xs emergency" data-id="<?php echo $staff['id'];?>">Emergency Contacts</a> 
                    <a href="#" data-id="<?php echo $staff['id'];?>" class="btn btn-primary btn-xs delete">Delete</a> </div>
            </div>
            <?php 
              }
              ?>
        
<div style="clear:both"></div>
<?php echo $pagination; ?>

<div id="staff-edit-slider" data-role="panel" data-position="right" data-display="overlay" data-dismissible="false">
    
    <input type="hidden" id="staffId" value="0" />
<div id="tabs">
<ul>
  
  <li><a href="#contact-info">Contact Info</a></li>
  <li><a href="#company-info">Company Info</a></li>
  <li><a href="#personal-info">Personal Info</a></li>
  <li><a href="#emergency-info">Emergency Info</a></li>
  <li><a href="#equipment-info">Equipment</a></li>
  <li style="float: right"> <?php echo $form['isActive'];?>This employee is active</li>
</ul>
<form method="post" role="form" class="form-standard" id="staff-form" action="/admin/staff/ajaxsave/">
  <div id="contact-info">
   <table >
    <tr>      
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" rowspan="4"><img src="" width="150" /></td>
      </tr>
    <tr>
      <td>Firstname:</td>
      <td><?php echo $form['firstname']; ?></td>
      </tr>
    <tr>
    <tr>
      <td>Lastname:</td>
      <td><?php echo $form['lastname']; ?></td>
      </tr>
    <tr>
      <td>Telephone:</td>
      <td><?php echo $form['telephone']; ?></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Mobile:</td>
      <td><?php echo $form['mobile']; ?></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Personal Email:</td>
      <td><?php echo $form['personalEmail']; ?></td>
      <td colspan="2">Email Signature</td>
      </tr>
    <tr>
      <td>Address:</td>
      <td><?php echo $form['address2']; ?><?php echo $form['address1']; ?></td>
      <td colspan="2" rowspan="4" valign="top"><?php echo $form['signature']; ?></td>
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
        <td></td>
        <td></td>
      <td rowspan="9"><img src="" width="150" />
          <?php echo $form['imageName']; ?>
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
    <?php if($id > 0) {?>
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
    <form method="post" id=econtact-form">
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

</div>