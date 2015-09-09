<div class="content full-width" ng-controller="staffEditCtrl">
  <div class="widget">

    <h1 class="pull-left"><?php echo $this->getString('STAFF_EDIT') ?> {{staff.firstname}} {{staff.lastname}}</h1>
    <div class="clearfix"></div>
    <div class="cards">
      <div class="card">
        <h1 class="pull-left"><?php echo $this->getString('STAFF_PERSONAL_INFO'); ?></h1>
        <div class="pull-right">
          <button ng-if="!loading" class="primary" ng-click="save(staff)"><?php echo $this->getString('STAFF_SAVE');?></button>
        </div>
        <div class="clearfix"></div>
        <div ng-if="loading">
          <span class="spinner-loader"></span>
        </div>

        <div ng-if="!loading">
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
          <div class="cardfooter">
            <button class="primary pull-right" ng-click="save(staff)"><?php echo $this->getString('STAFF_SAVE');?></button>
          </div>
        </div>
      </div>

      <div class="card" ng-controller="staffRolesCtrl">
        <h1><?php echo $this->getString('STAFF_ACCESS_LEVELS'); ?></h1>
        <div ng-if="staffRoles.loading">
          <div class="spinner-loader"></div>
        </div>
        <div ng-if="!staffRoles.loading">
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
          <div class="cardfooter">
            <div class="pull-right">
              <button class="primary" ng-click="submitRoles(staffRoles)">
                <?php echo $this->getString('STAFF_SUBMIT'); ?>
              </button>
              <button ng-click="resetCredentials()">
                <?php echo $this->getString('STAFF_RESET'); ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cards">
      <div class="card">
        <h1 class="pull-left"><?php echo $this->getString('STAFF_EMPLOYMENT_INFO'); ?></h1>
        <div class="pull-right">
          <button ng-if="!loading" class="primary" ng-click="save(staff)"><?php echo $this->getString('STAFF_SAVE');?></button>
        </div>
        <div class="clearfix"></div>

        <div ng-if="loading">
          <span class="spinner-loader"></span>
        </div>

        <div ng-if="!loading">
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
          <div class="cardfooter">
            <button class="primary pull-right" ng-click="save(staff)"><?php echo $this->getString('STAFF_SAVE');?></button>
          </div>
        </div>
      </div>
      <div class="card" ng-controller="staffBenefitsCtrl">
        <h1><?php echo $this->getString('STAFF_BENEFITS_INFO'); ?></h1>
        <div ng-if="staffBenefitsLoading"><span class="spinner-loader"></span></div>

        <div ng-if="!staffBenefitsLoading">
          <div class="cardleft">
            <table class="cardtable">
              <tbody>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].StaffPositions_id}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].Departments_id}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_SALARY'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].salary | currency:$}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_IS_HOURLY'); ?></strong></td>
                  <td bool-to-string data-value="{{staffBenefits[staffBenefits.length-1].isHourly}}"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="cardright">
            <table class="cardtable">
              <tbody>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_VACATIONMONTHLY'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].accruedVacationMonthly}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_SICKMONTHLY'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].accruedSickMonthly}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_STARTDATE'); ?></strong></td>
                  <td>{{staffBenefits[staffBenefits.length-1].startDate}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="cardfooter">
            <button class="primary" ng-click="openStaffBenefitsHistoryModal()">
              <?php echo $this->getString('STAFF_BENEFITS_HISTORY'); ?>
            </button>
          </div>
        </div>
      </div>

    </div>
    <div class="cards">
      <div class="card">
        <h1><?php echo $this->getString('STAFF_GENERAL_INFO'); ?></h1>
        <div ng-if="loading">
          <span class="spinner-loader"></span>
        </div>

        <div ng-if="!loading">
          <h3>{{staff.firstname}} {{staff.lastname}}</h3>
          <h4>{{staff.title}}</h4>
          <div class="cardleft">
            <table class="cardtable">
              <tbody>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></strong></td>
                  <td get-department></td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_EMAIL'); ?></strong></td>
                  <td>{{staff.email}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_MOBILE'); ?></strong></td>
                  <td>{{staff.mobile}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('STAFF_EXTENSION'); ?></strong></td>
                  <td>{{staff.extension}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="cardright" ng-if="!loading">
          <img class="pull-right" ng-src="/images/staff/{{staff.imageName}}">
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="card">
        <h1><?php echo $this->getString('STAFF_CREDENTIALS'); ?></h1>

        <div ng-if="authorizationLoading"><span class="spinner-loader"></span></div>

        <form name="authorizationForm" class="form clearfix" ng-if="!authorizationLoading">
          <div class="alert alert-warning" ng-if="credentialStatus.success === 'false'">
            <p>
              {{credentialStatus.message}}
            </p>
          </div>
          <div class="cardleft">
            <div class="form-group" ng-class="{'has-success':staff.usernameValid, 'has-error':!staff.usernameValid}">
              <label for="StaffAuthorization_username"><?php echo $this->getString('STAFF_USERNAME'); ?></label>
              <?php echo $aform['username']; ?>
            </div>
            <p class="help-block"><?php echo $this->getString('STAFF_PASSWORD_RULES');?></p>
          </div>
          <div class="cardright">
            <div class="form-group">
              <label for="StaffAuthorization_password"><?php echo $this->getString('STAFF_PASSWORD'); ?></label>
              <?php echo $aform['password']; ?>
            </div>
            <div class="form-group" ng-class="{'has-success':authorization.password !== undefined && authorization.password === authorization.passwordConfirm,
              'has-error':authorization.password !== undefined && authorization.password !== authorization.passwordConfirm}">
              <label for="StaffAuthorization_passwordConfirm"><?php echo $this->getString('STAFF_PASSWORD_CONFIRM'); ?></label>
              <?php echo $aform['passwordConfirm']; ?>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
            <input type="checkbox" name="emailUser" id="staff-emailUser" ng-model="authorization.emailUser">
            <label for="staff-emailUser"><?php echo $this->getString('STAFF_EMAILUSER'); ?></label>
            <p class="help-block">
              <?php echo $this->getString('STAFF_SEND_TO_USER'); ?>
            </p>
          </div>

          <div class="cardfooter">
            <div class="pull-right">
              <button class="primary" ng-click="submitCredentials(authorization)">
                <?php echo $this->getString('STAFF_SUBMIT'); ?>
              </button>
              <button ng-click="resetCredentials()">
                <?php echo $this->getString('STAFF_RESET'); ?>
              </button>
            </div>
          </div>
        </form>

      </div>

      <div class="card">
        <h1><?php echo $this->getString('STAFF_EMERGENCY_INFO'); ?></h1>
      </div>

    </div>
    <div class="clearfix"></div>
    <form class="hide"></form>
  </div>
</div>
