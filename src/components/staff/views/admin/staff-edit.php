
<div class="content full-width">


    <div  ng-controller="staffInformationCtrl as ctrl">
        <h1 ng-if="!ctrl.staff"><?php echo $this->getString('STAFF_CREATE'); ?></h1>
        <h1 class="pull-left" ng-if="ctrl.staff"><?php echo $this->getString('STAFF_EDIT') ?> {{ctrl.staff.firstname}} {{ctrl.staff.lastname}}</h1>
        <div class="clearfix"></div>
        <div class="cards">
            <div class="card">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('STAFF_EMPLOYMENT_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>

                <div ng-if="ctrl.loading">
                    <span class="spinner-loader"></span>
                </div>


                <div class="form-group splitcolumn left-tight">
                    <label for="staff-firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></label>
                    <?php echo $form['firstname']; ?>
                </div>
                <div class="form-group splitcolumn right-tight">
                    <label for="staff-lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></label>
                    <?php echo $form['lastname']; ?>
                </div>
                <div class="form-group">
                    <label for="staff-title"><?php echo $this->getString('STAFF_TITLE'); ?></label>
                    <?php echo $form['title']; ?>
                </div>
                <div class="form-group">
                    <label for="staff-email"><?php echo $this->getString('STAFF_EMAIL'); ?></label>
                    <?php echo $form['email']; ?>
                </div>
                <div class="form-group splitcolumn left-tight">
                    <label for="staff-extension"><?php echo $this->getString('STAFF_EXTENSION'); ?></label>
                    <div class="clearfix"></div>
                    <?php echo $form['extension']; ?>
                </div>
                <div class="form-group splitcolumn right-tight">
                    <label for="staff-mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
                    <?php echo $form['mobile']; ?>
                </div>

                <div class="form-group">
                    <label for="Departments_id"><?php echo $this->getString('STAFF_STAFFDEPARTMENT_ID'); ?></label>
                    <?php echo $form['Departments_id']; ?>
                </div>
                <div class="form-group">
                    <label for="staff-StaffTypes_id"><?php echo $this->getString('STAFF_STAFFTYPE_ID'); ?></label>
                    <?php echo $form['StaffTypes_id']; ?>
                </div>
                <div class="form-group">
                    <label for="staff-StaffPositions_id"><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></label>
                    <?php echo $form['StaffPositions_id']; ?>
                </div>



                <div class="form-group">
                    <label for="staff-hireDate"><?php echo $this->getString('STAFF_HIREDATE'); ?></label>
                    <div class="input-group">
                        <input type="text" name="dob" id="staff-hireDate" ng-model="staff.hireDate" ng-model-options="{timezone: '+0000'}"
                               class="form-control" datepicker-popup is-open="isOpen.hireDate"
                               datepicker-options="dateOptions" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                        <span class="input-group-btn" data-datepickername="hireDate">
                            <button type="button" class="btn-default" data-datepickername="hireDate" ng-click="openDatepicker($event)">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="staff-departureDate"><?php echo $this->getString('STAFF_DEPARTUREDATE'); ?></label>
                    <div class="input-group">
                        <input type="text" name="departureDate" id="staff-departureDate" ng-model="staff.departureDate" ng-model-options="{timezone: '+0000'}"
                               class="form-control" datepicker-popup is-open="isOpen.departureDate"
                               datepicker-options="dateOptions" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                        <span class="input-group-btn" data-datepickername="departureDate">
                            <button type="button" class="btn-default" data-datepickername="departureDate" ng-click="openDatepicker($event)">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>


                <div class="clearfix"></div>
                <div class="cardfooter">
                    <input type="submit" class="btn btn-primary pull-right" ng-disabled="!staff.telephone || !staff.email"
                           value="<?php echo $this->getString('STAFF_SAVE'); ?>">
                    <div class="clearfix"></div>
                </div>
                <div class="card" ng-controller="staffRolesCtrl">
                    <div class="cardheader">
                        <h1><?php echo $this->getString('STAFF_ACCESS_LEVELS'); ?></h1>
                    </div>
                    <div ng-if="staffRoles.loading">
                        <div class="spinner-loader"></div>
                    </div>
                    <div ng-if="!staffRoles.loading">
                        <fieldset ng-disabled="!staff">
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
                        </fieldset>
                        <div class="clearfix"></div>
                        <div class="cardfooter">
                            <div class="pull-right btn-group">
                                <button class="primary" ng-click="submitRoles(staffRoles)" ng-disabled="!staff">
                                    <?php echo $this->getString('STAFF_SUBMIT'); ?>
                                </button>
                                <button ng-click="resetCredentials()" ng-disabled="!staff">
                                    <?php echo $this->getString('STAFF_RESET'); ?>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards">
            <div class="card" >
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('STAFF_PERSONAL_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>
                <div ng-if="ctrl.loading">
                    <span class="spinner-loader"></span>
                </div>

                <div ng-submit="save(staff)">


                    <div class="form-group">
                        <label for="staff-personalEmail"><?php echo $this->getString('STAFF_PERSONALEMAIL'); ?></label>
                        <?php echo $form['personalEmail']; ?>
                    </div>
                    <div class="form-group splitcolumn left-tight">
                        <label for="staff-personalTelephone"><?php echo $this->getString('STAFF_PERSONALTELEPHONE'); ?></label>
                        <?php echo $form['personalTelephone']; ?>
                    </div>
                    <div class="form-group splitcolumn right-tight">
                        <label for="staff-personalMobile"><?php echo $this->getString('STAFF_PERSONALMOBILE'); ?></label>
                        <?php echo $form['personalMobile']; ?>
                    </div>


                    <div class="form-group">
                        <label for="staff-address1"><?php echo $this->getString('STAFF_ADDRESS1'); ?></label>
                        <?php echo $form['address1']; ?>
                    </div>
                    <div class="form-group">
                        <label for="staff-address2"><?php echo $this->getString('STAFF_ADDRESS2'); ?></label>
                        <?php echo $form['address2']; ?>
                    </div>
                    <div class="form-group">
                        <label for="staff-city"><?php echo $this->getString('STAFF_CITY'); ?></label>
                        <?php echo $form['city']; ?>
                    </div>
                    <div class="form-group splitcolumn left-tight">
                        <label for="staff-postalCode"><?php echo $this->getString('STAFF_POSTALCODE'); ?></label>
                        <?php echo $form['postalCode']; ?>
                    </div>
                    <div class="form-group splitcolumn right-tight">
                        <label for="staff-dob"><?php echo $this->getString('STAFF_DOB'); ?></label>
                        <div class="input-group">
                            <input type="text" name="dob" id="staff-dob" ng-model="staff.dob" ng-model-options="{timezone: '+0000'}"
                                   class="form-control" datepicker-popup is-open="isOpen.dob"
                                   datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                            <span class="input-group-btn" data-datepickername="dob">
                                <button type="button" class="btn-default" data-datepickername="dob" ng-click="openDatepicker($event)">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staff-gender"><?php echo $this->getString('STAFF_GENDER'); ?></label>
                        <input class="form-control" type="text" name="gender"
                               id="staff-gender" ng-model="staff.gender">
                    </div>




                    <div class="clearfix"></div>
                    <div class="cardfooter">
                        <input type="submit" class="btn btn-primary pull-right" ng-disabled="!staff.firstname || !staff.lastname"
                               value="<?php echo $this->getString('STAFF_SAVE'); ?>">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="card" ng-controller="staffBenefitsCtrl as ctrl">
                <div ng-if="!ctrl.staffBenefitsLoading && ctrl.staffBenefits">
                    <div class="cardleft">
                        <table class="cardtable">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></strong></td>
                                    <td>{{staffBenefits[0].position}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></strong></td>
                                    <td>{{staffBenefits[0].department}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_SALARY'); ?></strong></td>
                                    <td>{{staffBenefits[0].salary| currency:$}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_IS_HOURLY'); ?></strong></td>
                                    <td bool-to-string data-value="{{staffBenefits[0].isHourly}}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card">
                        <table class="cardtable">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_VACATIONMONTHLY'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].accruedVacationMonthly}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_SICKMONTHLY'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].accruedSickMonthly}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_STARTDATE'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].startDate| date:'dd-MM-yyyy':+0000}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="cardfooter">
                    <button class="btn-link pull-right" ng-click="ctrl.openStaffBenefitsHistoryModal()">
                        <?php echo $this->getString('STAFF_BENEFITS_HISTORY'); ?>
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="cards">
        <div class="card" ng-controller="staffGeneralInfoCtrl as ctrl">
            <div class="cardheader">
                <h1><?php echo $this->getString('STAFF_GENERAL_INFO'); ?></h1>
            </div>

            <div ng-if="loading">
                <span class="spinner-loader"></span>
            </div>

            <div ng-if="!loading">
                <h3>{{ctrl.staff.firstname}} {{ctrl.staff.lastname}}</h3>
                <h4>{{ctrl.staff.title}}</h4>
                <div class="cardleft">
                    <table class="cardtable">
                        <tbody>
                            <tr>
                                <td><strong><?php echo $this->getString('STAFF_EMPLOYEENUM'); ?></strong></td>
                                <td>{{ctrl.staff.employeeNumber}}</td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></strong></td>
                                <td get-department></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $this->getString('STAFF_EMAIL'); ?></strong></td>
                                <td>{{ctrl.staff.email}}</td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $this->getString('STAFF_MOBILE'); ?></strong></td>
                                <td>{{ctrl.staff.mobile}}</td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $this->getString('STAFF_EXTENSION'); ?></strong></td>
                                <td>{{ctrl.staff.extension}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cardright" ng-if="!ctrl.loading && ctrl.staff.imageName">
                <img class="staff-picture pull-right" ng-src="/images/staff/{{ctrl.staff.imageName}}">

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card" ng-controller="staffAuthorizationCtrl as ctrl">
            <div class="cardheader">
                <h1><?php echo $this->getString('STAFF_CREDENTIALS'); ?></h1>
            </div>

            <div ng-if="ctrl.authorizationLoading">
                <span class="spinner-loader"></span>
            </div>


            <div class="alert alert-warning" ng-if="credentialStatus.success === 'false'">
                <p>
                    {{credentialStatus.message}}
                </p>
            </div>
            <fieldset ng-disabled="!ctrl.staffLoaded">

                <div class="form-group" ng-class="{'has-success':ctrl.usernameValid, 'has-error':ctrl.staff.username && !ctrl.staff.usernameValid}">
                    <label for="StaffAuthorization_username"><?php echo $this->getString('STAFF_USERNAME'); ?></label>
                    <?php echo $aForm['username']; ?>
                </div>


                <div class="form-group">
                    <label for="StaffAuthorization_password"><?php echo $this->getString('STAFF_PASSWORD'); ?></label>
                    <?php echo $aForm['password']; ?>
                </div>
                <div class="form-group" ng-class="{'has-success':ctrl.staffAuthorization.password !== undefined && ctrl.staffAuthorization.password === ctrl.staffAuthorization.passwordConfirm,
                                    'has-error':ctrl.staffAuthorization.password !== undefined && ctrl.staffAuthorization.password !== ctrl.staffAuthorization.passwordConfirm}">
                    <label for="StaffAuthorization_passwordConfirm"><?php echo $this->getString('STAFF_PASSWORD_CONFIRM'); ?></label>
                    <?php echo $aForm['passwordConfirm']; ?>
                </div>

            </fieldset>
            <div class="clearfix"></div>
            <p class="help-block"><?php echo $this->getString('STAFF_PASSWORD_RULES'); ?></p>
            <div class="form-group">
                <input type="checkbox" name="emailUser" id="staff-emailUser" ng-model="authorization.emailUser" ng-disabled="!staff">
                <label for="staff-emailUser"><?php echo $this->getString('STAFF_EMAILUSER'); ?></label>
                <p class="help-block">
                    <?php echo $this->getString('STAFF_SEND_TO_USER'); ?>
                </p>
            </div>

            <div class="cardfooter">
                <div class="pull-right btn-group">
                    <button class="primary" ng-click="submitCredentials(authorization)" ng-disabled="!staff">
                        <?php echo $this->getString('STAFF_SUBMIT'); ?>
                    </button>
                    <button ng-click="resetCredentials()" ng-disabled="!staff">
                        <?php echo $this->getString('STAFF_RESET'); ?>
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>


        </div>
    </div>
</div>


<div class="clearfix"></div>
<form>
    <input type="hidden" value="<?php echo intval($id); ?>" id="Staff_id" />
</form>

<div ng-controller="staffBenefitsCtrl as ctrl">
    <div class="modal-header">
        <h1 class="pull-left"><?php echo $this->getString('STAFF_BENEFITS_HISTORY'); ?></h1>
        <button ng-if="!addingNew" class="pull-right" ng-click="toggleAddNewBenefits()" ng-disabled="!ctrl.staff">
            <?php echo $this->getString('STAFF_NEW'); ?>
        </button>
        <div ng-if="addingNew" class="btn-group pull-right">
            <button class="primary" ng-click="saveNewBenefits(staff)">
                <?php echo $this->getString('STAFF_SAVE'); ?>
            </button>
            <button ng-click="toggleAddNewBenefits()">
                <?php echo $this->getString('STAFF_RESET'); ?>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></th>
                    <th><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></th>
                    <th><?php echo $this->getString('STAFF_SALARY'); ?></th>
                    <th><?php echo $this->getString('STAFF_IS_HOURLY'); ?></th>
                    <th><?php echo $this->getString('STAFF_VACATIONMONTHLY'); ?></th>
                    <th><?php echo $this->getString('STAFF_SICKMONTHLY'); ?></th>
                    <th><?php echo $this->getString('STAFF_STARTDATE'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="addingNew">
                    <td><?php echo $form['StaffPositions_id']; ?></td>
                    <td><?php echo $form['Departments_id']; ?></td>
                    <td><input class="form-control" type="number" name="staff-salary" id="staff-salary" ng-model="ctrl.staff.salary"></td>
                    <td>
                        <select class="form-control" ng-model="ctrl.staff.isHourly" name="staff-hourly" id="staff-hourly">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </td>
                    <td><input class="form-control" type="number" name="staff-accruedVacationMonthly" id="staff-accruedVacationMonthly" ng-model="staff.accruedVacationMonthly"></td>
                    <td><input class="form-control" type="number" name="staff-accruedSickMonthly" id="staff-accruedSickMonthly" ng-model="staff.accruedSickMonthly"></td>
                    <td class="has-datepicker">
                        <div class="input-group">
                            <input type="text" name="startDate" id="staff-startDate" ng-model="ctrl.staff.startDate" ng-model-options="{timezone: '+0000'}"
                                   class="form-control" datepicker-popup is-open="isOpen.startDate"
                                   datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                            <span class="input-group-btn" data-datepickername="startDate">
                                <button type="button" class="btn-default" data-datepickername="startDate" ng-click="openDatepicker($event)">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr ng-repeat="benefits in ctrl.staffBenefits">
                    <td>{{benefits.position}}</td>
                    <td>{{benefits.department}}</td>
                    <td>{{benefits.salary| currency}}</td>
                    <td bool-to-string data-value="{{benefits.isHourly}}"></td>
                    <td>{{benefits.accruedVacationMonthly}}</td>
                    <td>{{benefits.accruedSickMonthly}}</td>
                    <td class="has-datepicker">{{benefits.startDate| date:'dd-MM-yyyy':+0000}}</td>
                </tr>
            </tbody>
        </table>
        <form class="hidden"></form>
    </div>
    <div class="modal-footer">
        <button ng-if="!addingNew" class="primary" ng-click="close()">
            <?php echo $this->getString('STAFF_CLOSE'); ?>
        </button>
        <div ng-if="addingNew" class="btn-group pull-right">
            <button class="primary" ng-click="saveNewBenefits(staff)">
                <?php echo $this->getString('STAFF_SAVE'); ?>
            </button>
            <button ng-click="toggleAddNewBenefits()">
                <?php echo $this->getString('STAFF_RESET'); ?>
            </button>
        </div>
    </div>
</div>