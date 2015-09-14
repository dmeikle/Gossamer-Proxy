<div class="modal-header" ng-switch="staff.id">
  <h1 class="modal-title"><?php echo $this->getString('STAFF_NEW_ADDNEW'); ?></h1>
</div>
<div class="modal-body">
  <div class="cards">
    <div class="card">
      <div class="cardheader">
        <h1 class="pull-left"><?php echo $this->getString('STAFF_PERSONAL_INFO'); ?></h1>
      </div>
      <div class="clearfix"></div>

      <div class="cardleft">
        <div class="form-group">
          <label for="staff-firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></label>
          <input class="form-control" type="text" name="firstname"
            id="staff-firstname" ng-model="staff.firstname">
        </div>
        <div class="form-group">
          <label for="staff-lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></label>
          <input class="form-control" type="text" name="lastname"
            id="staff-lastname" ng-model="staff.lastname">
        </div>
        <div class="form-group">
          <label for="staff-personalEmail"><?php echo $this->getString('STAFF_PERSONALEMAIL'); ?></label>
          <input class="form-control" type="email" name="personalEmail"
            id="staff-personalEmail" ng-model="staff.personalEmail">
        </div>
        <div class="form-group">
          <label for="staff-personalMobile"><?php echo $this->getString('STAFF_PERSONALMOBILE'); ?></label>
          <input class="form-control" type="tel" name="personalMobile"
            id="staff-personalMobile" ng-model="staff.personalMobile">
        </div>
        <div class="form-group">
          <label for="staff-personalTelephone"><?php echo $this->getString('STAFF_PERSONALTELEPHONE'); ?></label>
          <input class="form-control" type="tel" name="personalTelephone"
            id="staff-personalTelephone" ng-model="staff.personalTelephone">
        </div>
      </div>
      <div class="cardright">
        <div class="form-group">
          <label for="staff-address1"><?php echo $this->getString('STAFF_ADDRESS1'); ?></label>
          <input class="form-control" type="tel" name="address1"
            id="staff-address1" ng-model="staff.address1">
        </div>
        <div class="form-group">
          <label for="staff-address2"><?php echo $this->getString('STAFF_ADDRESS2'); ?></label>
          <input class="form-control" type="tel" name="address2"
            id="staff-address2" ng-model="staff.address2">
        </div>
        <div class="form-group">
          <label for="staff-city"><?php echo $this->getString('STAFF_CITY'); ?></label>
          <input class="form-control" type="tel" name="city"
            id="staff-city" ng-model="staff.city">
        </div>
        <div class="form-group">
          <label for="staff-postalCode"><?php echo $this->getString('STAFF_POSTALCODE'); ?></label>
          <input class="form-control" type="tel" name="postalCode"
            id="staff-postalCode" ng-model="staff.postalCode">
        </div>
        <div class="form-group">
          <label for="staff-dob"><?php echo $this->getString('STAFF_DOB'); ?></label>
          <input class="form-control" type="date" name="dob"
            id="staff-dob" ng-model="staff.dob" ng-model-options="{timezone: '+0000'}">
        </div>
        <div class="form-group">
          <label for="staff-gender"><?php echo $this->getString('STAFF_GENDER'); ?></label>
          <input class="form-control" type="text" name="gender"
            id="staff-gender" ng-model="staff.gender">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>


  <div class="cards">
    <div class="card">
      <div class="cardheader">
        <h1 class="pull-left"><?php echo $this->getString('STAFF_EMPLOYMENT_INFO'); ?></h1>
      </div>
      <div class="clearfix"></div>
      <div class="cardleft">
        <div class="form-group">
          <label for="staff-telephone"><?php echo $this->getString('STAFF_TELEPHONE'); ?></label>
          <input class="form-control" type="tel" name="telephone"
            id="staff-telephone" ng-model="staff.telephone">
        </div>
        <div class="form-group">
          <label for="staff-mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
          <input class="form-control" type="tel" name="mobile"
            id="staff-mobile" ng-model="staff.mobile">
        </div>
        <div class="form-group">
          <label for="staff-email"><?php echo $this->getString('STAFF_EMAIL'); ?></label>
          <input class="form-control" type="email" name="email"
            id="staff-email" ng-model="staff.email">
        </div>
        <div class="form-group">
          <label for="staff-employeeNumber"><?php echo $this->getString('STAFF_EMPLOYEENUM'); ?></label>
          <input class="form-control" type="text" name="employeeNumber"
            id="staff-employeeNumber" ng-model="staff.employeeNumber">
        </div>
        <div class="form-group">
          <label for="Departments_id"><?php echo $this->getString('STAFF_STAFFDEPARTMENT_ID'); ?></label>
          <?php echo $form['Departments_id'];?>
        </div>
        <div class="form-group">
          <label for="staff-StaffTypes_id"><?php echo $this->getString('STAFF_STAFFTYPE_ID'); ?></label>
          <?php echo $form['StaffTypes_id'];?>
        </div>
        <div class="form-group">
          <label for="staff-StaffPositions_id"><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></label>
          <?php echo $form['StaffPositions_id'];?>
        </div>
      </div>
      <div class="cardright">
        <div class="form-group">
          <label for="staff-title"><?php echo $this->getString('STAFF_TITLE'); ?></label>
          <input class="form-control" type="text" name="title"
            id="staff-title" ng-model="staff.title">
        </div>
        <div class="form-group">
          <label for="staff-hireDate"><?php echo $this->getString('STAFF_HIREDATE'); ?></label>
          <input class="form-control" type="date" name="hireDate"
            id="staff-hireDate" ng-model="staff.hireDate" ng-model-options="{timezone: '+0000'}">
        </div>
        <div class="form-group">
          <label for="staff-departureDate"><?php echo $this->getString('STAFF_DEPARTUREDATE'); ?></label>
          <input class="form-control" type="date" name="departureDate"
            id="staff-departureDate" ng-model="staff.departureDate" ng-model-options="{timezone: '+0000'}">
        </div>
        <div class="form-group">
          <label for="staff-extension"><?php echo $this->getString('STAFF_EXTENSION'); ?></label>
          <input class="form-control" type="text" name="extension"
            id="staff-extension" ng-model="staff.extension">
        </div>
        <div class="form-group">
          <label for="staff-alarmPassword"><?php echo $this->getString('STAFF_ALARMPSWD'); ?></label>
          <input class="form-control" type="text" name="alarmPassword"
            id="staff-alarmPassword" ng-model="staff.alarmPassword">
        </div>
        <div class="form-group">
          <label for="HiringAgencies_id"><?php echo $this->getString('STAFF_HIRINGAGENCY_ID'); ?></label>
          <!-- need to write the hiring agencies component still -->
          <?php  echo $form['HiringAgencies_id'];?>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="cards">
    <div class="card" ng-controller="staffRolesCtrl">
      <div class="cardheader">
        <h1><?php echo $this->getString('STAFF_ACCESS_LEVELS'); ?></h1>
      </div>
      <div class="cardleft">
        <div class="form-group">
          <input type="checkbox" name="administrator" id="staff-roles-administrator" ng-model="staffRoles.IS_ADMINISTRATOR">
          <label for="staff-roles-administrator"><?php echo $this->getString('STAFF_ROLES_ADMINISTRATOR'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="super-user" id="staff-roles-super-user" ng-model="staffRoles.IS_SUPER_USER">
          <label for="staff-roles-super-user"><?php echo $this->getString('STAFF_ROLES_SUPERUSER'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="manager" id="staff-roles-manager" ng-model="staffRoles.IS_MANAGER">
          <label for="staff-roles-manager"><?php echo $this->getString('STAFF_ROLES_MANAGER'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="developer" id="staff-roles-developer" ng-model="staffRoles.IS_DEVELOPER">
          <label for="staff-roles-developer"><?php echo $this->getString('STAFF_ROLES_DEVELOPER'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="reception" id="staff-roles-reception" ng-model="staffRoles.IS_RECEPTION">
          <label for="staff-roles-reception"><?php echo $this->getString('STAFF_ROLES_RECEPTION'); ?></label>
        </div>
      </div>
      <div class="cardright">
        <div class="form-group">
          <input type="checkbox" name="data-entry" id="staff-roles-data-entry" ng-model="staffRoles.IS_DATA_ENTRY">
          <label for="staff-roles-data-entry"><?php echo $this->getString('STAFF_ROLES_DATA_ENTRY'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="website-editor" id="staff-roles-website-editor" ng-model="staffRoles.IS_WEBSITE_EDITOR">
          <label for="staff-roles-website-editor"><?php echo $this->getString('STAFF_ROLES_WEBSITE_EDITOR'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="staff" id="staff-roles-staff" ng-model="staffRoles.IS_STAFF">
          <label for="staff-roles-staff"><?php echo $this->getString('STAFF_ROLES_STAFF'); ?></label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="human-resources" id="staff-roles-human-resources" ng-model="staffRoles.IS_HUMAN_RESOURCES">
          <label for="staff-roles-human-resources"><?php echo $this->getString('STAFF_ROLES_HUMAN_RESOURCES'); ?></label>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button class="primary" ng-click="confirm(widget)"><?php echo $this->getString('STAFF_CONFIRM'); ?></button>

  <button ng-click="cancel()"><?php echo $this->getString('STAFF_CANCEL'); ?></button>
</div>
