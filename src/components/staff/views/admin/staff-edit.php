<div class="content full-width" ng-controller="staffEditCtrl">
  <div class="widget">

    <h1 class="pull-left"><?php echo $this->getString('STAFF_EDIT') ?> {{staff.firstname}} {{staff.lastname}}</h1>
    <div class="pull-right">
    <button class="primary" ng-click="save(staff)"><?php echo $this->getString('STAFF_SAVE');?></button>

    <button ng-click="discardChanges()"><?php echo $this->getString('STAFF_DISCARD');?></button>
    </div>
    <div class="clearfix"></div>
    <div class="cards">
      <div class="card">
        <h1>Personal Information</h1>

        <div ng-if="staff.loading">
          <div class="spinner-loader"></div>
        </div>

        <div ng-if="!staff.loading">
          <div class="form-group">
            <label for="firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></label>
            <input class="form-control" type="text" name="firstname"
              id="staff-firstname" ng-model="staff.firstname">
          </div>
          <div class="form-group">
            <label for="lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></label>
            <input class="form-control" type="text" name="lastname"
              id="staff-lastname" ng-model="staff.lastname">
          </div>
          <div class="form-group">
            <label for="personalEmail"><?php echo $this->getString('STAFF_PERSONALEMAIL'); ?></label>
            <input class="form-control" type="email" name="personalEmail"
              id="staff-personalEmail" ng-model="staff.personalEmail">
          </div>
          <div class="form-group">
            <label for="personalMobile"><?php echo $this->getString('STAFF_PERSONALMOBILE'); ?></label>
            <input class="form-control" type="tel" name="personalMobile"
              id="staff-personalMobile" ng-model="staff.personalMobile">
          </div>
          <div class="form-group">
            <label for="personalTelephone"><?php echo $this->getString('STAFF_PERSONALTELEPHONE'); ?></label>
            <input class="form-control" type="tel" name="personalTelephone"
              id="staff-personalTelephone" ng-model="staff.personalTelephone">
          </div>
          <div class="form-group">
            <label for="address1"><?php echo $this->getString('STAFF_ADDRESS1'); ?></label>
            <input class="form-control" type="tel" name="address1"
              id="staff-address1" ng-model="staff.address1">
          </div>
          <div class="form-group">
            <label for="address2"><?php echo $this->getString('STAFF_ADDRESS2'); ?></label>
            <input class="form-control" type="tel" name="address2"
              id="staff-address2" ng-model="staff.address2">
          </div>
          <div class="form-group">
            <label for="city"><?php echo $this->getString('STAFF_CITY'); ?></label>
            <input class="form-control" type="tel" name="city"
              id="staff-city" ng-model="staff.city">
          </div>
          <div class="form-group">
            <label for="postalCode"><?php echo $this->getString('STAFF_POSTALCODE'); ?></label>
            <input class="form-control" type="tel" name="postalCode"
              id="staff-postalCode" ng-model="staff.postalCode">
          </div>
          <div class="form-group">
            <label for="dob"><?php echo $this->getString('STAFF_DOB'); ?></label>
            <input class="form-control" type="date" name="dob"
              id="staff-dob" ng-model="staff.dob">
          </div>
          <div class="form-group">
            <label for="gender"><?php echo $this->getString('STAFF_GENDER'); ?></label>
            <input class="form-control" type="text" name="gender"
              id="staff-gender" ng-model="staff.gender">
          </div>
        </div>
      </div>
    </div>
    <div class="cards">
      <div class="card">
        <h1>Employment Information</h1>

        <div ng-if="staff.loading">
          <div class="spinner-loader"></div>
        </div>

        <div ng-if="!staff.loading">
          <div class="form-group">
            <label for="telephone"><?php echo $this->getString('STAFF_TELEPHONE'); ?></label>
            <input class="form-control" type="tel" name="telephone"
              id="staff-telephone" ng-model="staff.telephone">
          </div>
          <div class="form-group">
            <label for="mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
            <input class="form-control" type="tel" name="mobile"
              id="staff-mobile" ng-model="staff.mobile">
          </div>
          <div class="form-group">
            <label for="email"><?php echo $this->getString('STAFF_EMAIL'); ?></label>
            <input class="form-control" type="email" name="email"
              id="staff-email" ng-model="staff.email">
          </div>
          <div class="form-group">
            <label for="employeeNumber"><?php echo $this->getString('STAFF_EMPLOYEENUM'); ?></label>
            <input class="form-control" type="text" name="employeeNumber"
              id="staff-employeeNumber" ng-model="staff.employeeNumber">
          </div>
          <div class="form-group">
            <label for="StaffTypes_id"><?php echo $this->getString('STAFF_STAFFTYPE_ID'); ?></label>
            <input class="form-control" type="text" name="StaffTypes_id"
              id="staff-StaffTypes_id" ng-model="staff.StaffTypes_id">
          </div>
          <div class="form-group">
            <label for="StaffPositions_id"><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></label>
            <input class="form-control" type="text" name="StaffPositions_id"
              id="staff-StaffPositions_id" ng-model="staff.StaffPositions_id">
          </div>
          <div class="form-group">
            <label for="title"><?php echo $this->getString('STAFF_TITLE'); ?></label>
            <input class="form-control" type="text" name="title"
              id="staff-title" ng-model="staff.title">
          </div>
          <div class="form-group">
            <label for="hireDate"><?php echo $this->getString('STAFF_HIREDATE'); ?></label>
            <input class="form-control" type="date" name="hireDate"
              id="staff-hireDate" ng-model="staff.hireDate">
          </div>
          <div class="form-group">
            <label for="departureDate"><?php echo $this->getString('STAFF_DEPARTUREDATE'); ?></label>
            <input class="form-control" type="date" name="departureDate"
              id="staff-departureDate" ng-model="staff.departureDate">
          </div>
          <div class="form-group">
            <label for="extension"><?php echo $this->getString('STAFF_EXTENSION'); ?></label>
            <input class="form-control" type="text" name="extension"
              id="staff-extension" ng-model="staff.extension">
          </div>
          <div class="form-group">
            <label for="alarmPassword"><?php echo $this->getString('STAFF_ALARMPSWD'); ?></label>
            <input class="form-control" type="text" name="alarmPassword"
              id="staff-alarmPassword" ng-model="staff.alarmPassword">
          </div>
          <div class="form-group">
            <label for="HiringAgencies_id"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
            <input class="form-control" type="text" name="HiringAgencies_id"
              id="staff-HiringAgencies_id" ng-model="staff.HiringAgencies_id">
          </div>
        </div>
      </div>
    </div>
    <div class="cards">
      <div class="card">
        <h1>Test Card 3</h1>
      </div>
    </div>
    <div class="clearfix"></div>
    <form class="hide"></form>
  </div>
</div>
