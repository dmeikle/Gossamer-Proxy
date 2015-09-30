<div class="content full-width" ng-controller="claimEditCtrl" ng-cloak>
  <div class="widget">
    <h1 ng-if="!claim"><?php echo $this->getString('CLAIM_CREATE'); ?></h1>
    <h1 class="pull-left" ng-if="claim"><?php echo $this->getString('CLAIM_EDIT') ?> {{claim.buildingName}} {{claim.strataNumber}}</h1>
    <div class="clearfix"></div>
    <div class="cards">
      <div class="card">
        <div class="cardheader">
          <h1 class="pull-left"><?php echo $this->getString('CLAIM_ADDRESS_INFO'); ?></h1>
        </div>
        <div class="clearfix"></div>
        <div ng-if="loading">
          <span class="spinner-loader"></span>
        </div>

        <form ng-if="!loading" ng-submit="save(claim)">
          <div class="cardleft">
            <div class="form-group">
              <label for="claim-buildingName"><?php echo $this->getString('CLAIM_ADDRESS'); ?></label>
              <input class="form-control" type="text" name="buildingName" required
                id="claim-buildingName" ng-model="claim.buildingName">
            </div>
            <div class="form-group">
              <label for="claim-lastname"><?php echo $this->getString('CLAIM_LASTNAME'); ?></label>
              <input class="form-control" type="text" name="lastname" required
                id="claim-lastname" ng-model="claim.lastname">
            </div>
            <div class="form-group">
              <label for="claim-personalEmail"><?php echo $this->getString('CLAIM_PERSONALEMAIL'); ?></label>
              <input class="form-control" type="email" name="personalEmail"
                id="claim-personalEmail" ng-model="claim.personalEmail">
            </div>
            <div class="form-group">
              <label for="claim-personalMobile"><?php echo $this->getString('CLAIM_PERSONALMOBILE'); ?></label>
              <input class="form-control" type="tel" name="personalMobile"
                id="claim-personalMobile" ng-model="claim.personalMobile">
            </div>
            <div class="form-group">
              <label for="claim-personalTelephone"><?php echo $this->getString('CLAIM_PERSONALTELEPHONE'); ?></label>
              <input class="form-control" type="tel" name="personalTelephone"
                id="claim-personalTelephone" ng-model="claim.personalTelephone">
            </div>
          </div>
          <div class="cardright">
            <div class="form-group">
              <label for="claim-address1"><?php echo $this->getString('CLAIM_ADDRESS1'); ?></label>
              <input class="form-control" type="tel" name="address1" required
                id="claim-address1" ng-model="claim.address1">
            </div>
            <div class="form-group">
              <label for="claim-address2"><?php echo $this->getString('CLAIM_ADDRESS2'); ?></label>
              <input class="form-control" type="tel" name="address2"
                id="claim-address2" ng-model="claim.address2">
            </div>
            <div class="form-group">
              <label for="claim-city"><?php echo $this->getString('CLAIM_CITY'); ?></label>
              <input class="form-control" type="tel" name="city" required
                id="claim-city" ng-model="claim.city">
            </div>
            <div class="form-group">
              <label for="claim-postalCode"><?php echo $this->getString('CLAIM_POSTALCODE'); ?></label>
              <input class="form-control" type="tel" name="postalCode" required
                id="claim-postalCode" ng-model="claim.postalCode">
            </div>
            <div class="form-group">
              <label for="claim-dob"><?php echo $this->getString('CLAIM_DOB'); ?></label>
              <div class="input-group">
                <input type="date" name="dob" id="claim-dob" ng-model="claim.dob" ng-model-options="{timezone: '+0000'}"
                  class="form-control" datepicker-popup is-open="isOpen.dob"
                  datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('CLAIM_CLOSE');?>" />
                <span class="input-group-btn" data-datepickername="dob">
                  <button type="button" class="btn-default" data-datepickername="dob" ng-click="openDatepicker($event)">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="claim-gender"><?php echo $this->getString('CLAIM_GENDER'); ?></label>
              <input class="form-control" type="text" name="gender"
                id="claim-gender" ng-model="claim.gender">
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="cardfooter">
            <input type="submit" class="btn btn-primary pull-right" ng-disabled="!claim.firstname || !claim.lastname"
              value="<?php echo $this->getString('CLAIM_SAVE');?>">
            <div class="clearfix"></div>
          </div>
        </form>
      </div>

      <div class="card">
        <div class="cardheader">
          <h1><?php echo $this->getString('CLAIM_ACCESS_LEVELS'); ?></h1>
        </div>
        <div ng-if="staffRoles.loading">
          <div class="spinner-loader"></div>
        </div>
        <div ng-if="!staffRoles.loading">
          <fieldset ng-disabled="!staff">
            <div class="cardleft">
              <div class="form-group">
                <input type="checkbox" name="administrator" id="staff-roles-administrator" ng-model="staffRoles.IS_ADMINISTRATOR">
                <label for="staff-roles-administrator"><?php echo $this->getString('CLAIM_ROLES_ADMINISTRATOR'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="super-user" id="staff-roles-super-user" ng-model="staffRoles.IS_SUPER_USER">
                <label for="staff-roles-super-user"><?php echo $this->getString('CLAIM_ROLES_SUPERUSER'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="manager" id="staff-roles-manager" ng-model="staffRoles.IS_MANAGER">
                <label for="staff-roles-manager"><?php echo $this->getString('CLAIM_ROLES_MANAGER'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="developer" id="staff-roles-developer" ng-model="staffRoles.IS_DEVELOPER">
                <label for="staff-roles-developer"><?php echo $this->getString('CLAIM_ROLES_DEVELOPER'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="reception" id="staff-roles-reception" ng-model="staffRoles.IS_RECEPTION">
                <label for="staff-roles-reception"><?php echo $this->getString('CLAIM_ROLES_RECEPTION'); ?></label>
              </div>
            </div>
            <div class="cardright">
              <div class="form-group">
                <input type="checkbox" name="data-entry" id="staff-roles-data-entry" ng-model="staffRoles.IS_DATA_ENTRY">
                <label for="staff-roles-data-entry"><?php echo $this->getString('CLAIM_ROLES_DATA_ENTRY'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="website-editor" id="staff-roles-website-editor" ng-model="staffRoles.IS_WEBSITE_EDITOR">
                <label for="staff-roles-website-editor"><?php echo $this->getString('CLAIM_ROLES_WEBSITE_EDITOR'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="staff" id="staff-roles-staff" ng-model="staffRoles.IS_STAFF">
                <label for="staff-roles-staff"><?php echo $this->getString('CLAIM_ROLES_STAFF'); ?></label>
              </div>
              <div class="form-group">
                <input type="checkbox" name="human-resources" id="staff-roles-human-resources" ng-model="staffRoles.IS_HUMAN_RESOURCES">
                <label for="staff-roles-human-resources"><?php echo $this->getString('CLAIM_ROLES_HUMAN_RESOURCES'); ?></label>
              </div>
            </div>
          </fieldset>
          <div class="clearfix"></div>
          <div class="cardfooter">
            <div class="pull-right btn-group">
              <button class="primary" ng-click="submitRoles(staffRoles)" ng-disabled="!staff">
                <?php echo $this->getString('CLAIM_SUBMIT'); ?>
              </button>
              <button ng-click="resetCredentials()" ng-disabled="!staff">
                <?php echo $this->getString('CLAIM_RESET'); ?>
              </button>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="cards">
      <div class="card">
        <div class="cardheader">
          <h1 class="pull-left"><?php echo $this->getString('CLAIM_EMPLOYMENT_INFO'); ?></h1>
        </div>
        <div class="clearfix"></div>

        <div ng-if="loading">
          <span class="spinner-loader"></span>
        </div>

        <form ng-submit="save(staff)" ng-if="!loading">
          <div class="cardleft">
            <div class="form-group">
              <label for="staff-telephone"><?php echo $this->getString('CLAIM_TELEPHONE'); ?></label>
              <input class="form-control" type="tel" name="telephone" required
                id="staff-telephone" ng-model="staff.telephone">
            </div>
            <div class="form-group">
              <label for="staff-mobile"><?php echo $this->getString('CLAIM_MOBILE'); ?></label>
              <input class="form-control" type="tel" name="mobile"
                id="staff-mobile" ng-model="staff.mobile">
            </div>
            <div class="form-group">
              <label for="staff-email"><?php echo $this->getString('CLAIM_EMAIL'); ?></label>
              <input class="form-control" type="email" name="email" required
                id="staff-email" ng-model="staff.email">
            </div>
            <div class="form-group">
              <label for="staff-employeeNumber"><?php echo $this->getString('CLAIM_EMPLOYEENUM'); ?></label>
              <input class="form-control" type="text" name="employeeNumber" ng-disabled="!$rootScope.staff"
                id="staff-employeeNumber" ng-model="staff.employeeNumber">
            </div>
            <div class="form-group">
              <label for="Departments_id"><?php echo $this->getString('CLAIM_STAFFDEPARTMENT_ID'); ?></label>
              <?php echo $form['Departments_id'];?>
            </div>
            <div class="form-group">
              <label for="staff-StaffTypes_id"><?php echo $this->getString('CLAIM_STAFFTYPE_ID'); ?></label>
              <?php echo $form['StaffTypes_id'];?>
            </div>
            <div class="form-group">
              <label for="staff-StaffPositions_id"><?php echo $this->getString('CLAIM_STAFFPOSITIONS_ID'); ?></label>
              <?php echo $form['StaffPositions_id'];?>
            </div>
          </div>
          <div class="cardright">
            <div class="form-group">
              <label for="staff-title"><?php echo $this->getString('CLAIM_TITLE'); ?></label>
              <input class="form-control" type="text" name="title"
                id="staff-title" ng-model="staff.title">
            </div>
            <div class="form-group">
              <label for="staff-hireDate"><?php echo $this->getString('CLAIM_HIREDATE'); ?></label>
              <div class="input-group">
                <input type="date" name="dob" id="staff-hireDate" ng-model="staff.hireDate" ng-model-options="{timezone: '+0000'}"
                  class="form-control" datepicker-popup is-open="isOpen.hireDate"
                  datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('CLAIM_CLOSE');?>" />
                <span class="input-group-btn" data-datepickername="hireDate">
                  <button type="button" class="btn-default" data-datepickername="hireDate" ng-click="openDatepicker($event)">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="staff-departureDate"><?php echo $this->getString('CLAIM_DEPARTUREDATE'); ?></label>
              <div class="input-group">
                <input type="date" name="departureDate" id="staff-departureDate" ng-model="staff.departureDate" ng-model-options="{timezone: '+0000'}"
                  class="form-control" datepicker-popup is-open="isOpen.departureDate"
                  datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('CLAIM_CLOSE');?>" />
                <span class="input-group-btn" data-datepickername="departureDate">
                  <button type="button" class="btn-default" data-datepickername="departureDate" ng-click="openDatepicker($event)">
                    <i class="glyphicon glyphicon-calendar"></i>
                  </button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="staff-extension"><?php echo $this->getString('CLAIM_EXTENSION'); ?></label>
              <input class="form-control" type="text" name="extension"
                id="staff-extension" ng-model="staff.extension">
            </div>
            <div class="form-group">
              <label for="staff-alarmPassword"><?php echo $this->getString('CLAIM_ALARMPSWD'); ?></label>
              <input class="form-control" type="text" name="alarmPassword"
                id="staff-alarmPassword" ng-model="staff.alarmPassword">
            </div>
            <div class="form-group">
              <label for="HiringAgencies_id"><?php echo $this->getString('CLAIM_HIRINGAGENCY_ID'); ?></label>
              <!-- need to write the hiring agencies component still -->
              <?php  echo $form['HiringAgencies_id'];?>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="cardfooter">
            <input type="submit" class="btn btn-primary pull-right" ng-disabled="!staff.telephone || !staff.email"
              value="<?php echo $this->getString('CLAIM_SAVE');?>">
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
      <div class="card">
        <div class="cardheader">
          <h1><?php echo $this->getString('CLAIM_BENEFITS_INFO'); ?></h1>
        </div>

        <div ng-if="staffBenefitsLoading"><span class="spinner-loader"></span></div>

        <div ng-if="!staffBenefitsLoading && !staffBenefits">
          <?php echo $this->getString('CLAIM_BENEFITS_NONE'); ?>
        </div>

        <div ng-if="!staffBenefitsLoading && staffBenefits">
          <div class="cardleft">
            <table class="cardtable">
              <tbody>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_STAFFPOSITIONS_ID'); ?></strong></td>
                  <td>{{staffBenefits[0].position}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_DEPARTMENT_ID'); ?></strong></td>
                  <td>{{staffBenefits[0].department}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_SALARY'); ?></strong></td>
                  <td>{{staffBenefits[0].salary | currency:$}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_IS_HOURLY'); ?></strong></td>
                  <td bool-to-string data-value="{{staffBenefits[0].isHourly}}"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="cardright">
            <table class="cardtable">
              <tbody>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_VACATIONMONTHLY'); ?></strong></td>
                  <td>{{staffBenefits[0].accruedVacationMonthly}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_SICKMONTHLY'); ?></strong></td>
                  <td>{{staffBenefits[0].accruedSickMonthly}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_STARTDATE'); ?></strong></td>
                  <td>{{staffBenefits[0].startDate | date:'dd-MM-yyyy':+0000}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="cardfooter">
          <button class="btn-link pull-right" ng-click="openStaffBenefitsHistoryModal()">
            <?php echo $this->getString('CLAIM_BENEFITS_HISTORY'); ?>
          </button>
          <div class="clearfix"></div>
        </div>
      </div>

    </div>
    <div class="cards">
      <div class="card">
        <div class="cardheader">
          <h1><?php echo $this->getString('CLAIM_GENERAL_INFO'); ?></h1>
        </div>

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
                  <td><strong><?php echo $this->getString('CLAIM_DEPARTMENT_ID'); ?></strong></td>
                  <td get-department></td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_EMAIL'); ?></strong></td>
                  <td>{{staff.email}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_MOBILE'); ?></strong></td>
                  <td>{{staff.mobile}}</td>
                </tr>
                <tr>
                  <td><strong><?php echo $this->getString('CLAIM_EXTENSION'); ?></strong></td>
                  <td>{{staff.extension}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="cardright" ng-if="!loading && staff.imageName">
          <img class="staff-picture pull-right" ng-src="/images/staff/{{staff.imageName}}">

        </div>
        <div class="clearfix"></div>
      </div>

      


      <div class="card" >
        <div class="cardheader">
          <h1 class="pull-left"><?php echo $this->getString('CLAIM_EMERGENCY_INFO'); ?></h1>
          <button ng-if="!loading" class="primary pull-right"
            ng-click="openEditEmergencyContactModal()"  ng-disabled="!staff">
            <?php echo $this->getString('CLAIM_NEW')?>
          </button>
        </div>
        <div ng-if="loading"><span class="spinner-loader"></span></div>
        <div ng-if="!loading">
          <p ng-if="!staffEmergencyContacts">
            <?php echo $this->getString('CLAIM_EMERGENCY_NONE');?>
          </p>
          <table ng-if="staffEmergencyContacts" class="cardtable">
            <thead>
              <tr>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_NAME'); ?></td>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_RELATIONSHIP'); ?></td>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_MOBILE'); ?></td>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_TELEPHONE'); ?></td>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_WORKTELEPHONE'); ?></td>
                <td><?php echo $this->getString('CLAIM_EMERGENCY_EMAIL'); ?></td>
                <td class="cog-col">&nbsp;</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="contact in staffEmergencyContacts">
                <td><strong>{{contact.firstname}} {{contact.lastname}}</strong></td>
                <td>{{contact.relation}}</td>
                <td>{{contact.mobile}}</td>
                <td>{{contact.telephone}}</td>
                <td>{{contact.workTelephone}}</td>
                <td>{{contact.email}}</td>
                <td class="row-controls">
                  <div class="dropdown">
                    <button class="dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                      <li><a ng-click="openEditEmergencyContactModal(contact)">Edit</a></li>
                      <li><a ng-click="delete(contact)">Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="clearfix"></div>
        </div>

      </div>

    </div>
    <div class="clearfix"></div>
    <form class="hide"></form>
  </div>
</div>