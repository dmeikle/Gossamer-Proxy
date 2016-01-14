
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
                    <label for="staff-StaffPositions_id"><?php echo $this->getString('STAFF_POSITION'); ?></label>
                    <?php echo $form['StaffPositions_id']; ?>
                </div>



                <div class="form-group">
                    <label for="staff-hireDate"><?php echo $this->getString('STAFF_HIREDATE'); ?></label>
                    <div class="input-group">
                        <input type="text" name="hireDate" id="staff-hireDate" ng-model="ctrl.staff.hireDate" ng-model-options="{timezone: '+0000'}"
                               class="form-control" datepicker-popup is-open="ctrl.isOpen.hireDate"
                               datepicker-options="dateOptions" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                        <span class="input-group-btn" data-datepickername="hireDate">
                            <button type="button" class="btn-default" data-datepickername="hireDate" ng-click="ctrl.openDatepicker('hireDate')">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="staff-departureDate"><?php echo $this->getString('STAFF_DEPARTUREDATE'); ?></label>
                    <div class="input-group">
                        <input type="text" name="departureDate" id="staff-departureDate" ng-model="ctrl.staff.departureDate" ng-model-options="{timezone: '+0000'}"
                               class="form-control" datepicker-popup is-open="ctrl.isOpen.departureDate"
                               datepicker-options="dateOptions" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                        <span class="input-group-btn" data-datepickername="departureDate">
                            <button type="button" class="btn-default" data-datepickername="departureDate" ng-click="ctrl.openDatepicker('departureDate')">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>


                <div class="clearfix"></div>
                <div class="cardfooter">
                    <input type="button" ng-click="ctrl.save(ctrl.staff)" class="btn btn-primary pull-right" ng-disabled="!ctrl.staff.firstname || !ctrl.staff.lastname"
                           value="<?php echo $this->getString('STAFF_SAVE'); ?>">
                    <div class="clearfix"></div>
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

                <div>


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
                            <input type="text" name="dob" id="staff-dob" ng-model="ctrl.staff.dob" ng-model-options="{timezone: '+0000'}"
                                   class="form-control" datepicker-popup is-open="ctrl.isOpen.dob"
                                   datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                            <span class="input-group-btn" data-datepickername="dob">
                                <button type="button" class="btn-default" data-datepickername="dob" ng-click="ctrl.openDatepicker('dob')">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staff-gender"><?php echo $this->getString('STAFF_GENDER'); ?></label>
                        <div class="input-group">
                            <label style="margin-right: 20px">
                                <input type="radio" ng-model="ctrl.staff.gender" value="m" /> <?php echo $this->getString('STAFF_MALE'); ?>
                            </label>
                            <label>
                                <input type="radio" ng-model="ctrl.staff.gender" value="f" /> <?php echo $this->getString('STAFF_FEMALE'); ?>
                            </label>
                        </div>
                    </div>




                    <div class="clearfix"></div>
                    <div class="cardfooter">
                        <input type="submit" class="btn btn-primary pull-right" ng-disabled="!ctrl.staff.firstname || !ctrl.staff.lastname"
                               value="<?php echo $this->getString('STAFF_SAVE'); ?>" ng-click="ctrl.save(ctrl.staff)">
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
                                    <td><strong><?php echo $this->getString('STAFF_POSITION'); ?></strong></td>
                                    <td>{{staffBenefits[0].position}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_DEPARTMENT'); ?></strong></td>
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
                                    <td><strong><?php echo $this->getString('STAFF_VACATION_MONTHLY'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].accruedVacationMonthly}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_SICK_MONTHLY'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].accruedSickMonthly}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('STAFF_START_DATE'); ?></strong></td>
                                    <td>{{ctrl.staffBenefits[0].startDate| date:'dd-MM-yyyy':+0000}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                                <td><strong><?php echo $this->getString('STAFF_DEPARTMENT'); ?></strong></td>
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
                <div class="clearfix"></div>
                <a href=#" ng-click="ctrl.displayPhotoUploadForm()">Upload New Image</a>
            </div>
            <div class="clearfix"></div>

            <div class="card" ng-controller="staffPhotoCtrl as ctrl" ng-show="ctrl.displayForm">
                <div class="cardheader">
                    <h1><?php echo $this->getString('STAFF_PHOTOUPLOAD') ?></h1>
                </div>
                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>
                <div ng-if="!loading">
                    <div dropzone="ctrl.dropzoneConfig" class="dropzone">
                        <p class="text-center">
                            <?php echo $this->getString('STAFF_PHOTOUPLOAD_UPLOADHERE'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" ng-controller="staffAuthorizationCtrl as ctrl">
            <div class="cardheader">
                <h1><?php echo $this->getString('STAFF_CREDENTIALS'); ?></h1>
            </div>

            <div class="alert alert-warning" ng-if="ctrl.credentialStatus.success === 'false'">
                <p>
                    {{ctrl.credentialStatus.message}}
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
                <input type="checkbox" name="emailUser" id="staff-emailUser" ng-model="ctrl.staffAuthorization.emailUser">
                <label for="staff-emailUser"><?php echo $this->getString('STAFF_EMAILUSER'); ?></label>
                <p class="help-block">
                    <?php echo $this->getString('STAFF_SEND_TO_USER'); ?>
                </p>
            </div>

            <div class="cardfooter">
                <div class="pull-right btn-group">
                    <button class="primary" ng-click="ctrl.submitCredentials(ctrl.staffAuthorization)" ng-disabled="!ctrl.staff && ! ctrl.staffAuthorization.username">
                        <?php echo $this->getString('STAFF_SUBMIT'); ?>
                    </button>
                    <button ng-click="ctrl.resetCredentials()">
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
<div class="col-xs-12">
    <uib-tabset>
        <uib-tab heading="Emergency Contacts">
            <div class="card" ng-controller="staffEmergencyContactsCtrl as ctrl">
                <div class="cardheader">
                    <h1 class="pull-left"><?php //echo $this->getString('STAFF_INFO');                                ?></h1>
                    <button ng-if="!ctrl.loading" class="primary pull-right"
                            ng-click="ctrl.openEditEmergencyContactModal()"  ng-disabled="!ctrl.staffLoaded">
                                <?php echo $this->getString('STAFF_NEW') ?>
                    </button>
                </div>
                <div ng-if="loading"><span class="spinner-loader"></span></div>
                <div ng-if="!ctrl.loading">
                    <p ng-if="!ctrl.staffEmergencyContacts">
                        <?php echo $this->getString('STAFF_NONE'); ?>
                    </p>
                    <table ng-if="ctrl.staffEmergencyContacts" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo $this->getString('STAFF_NAME'); ?></th>
                                <th><?php echo $this->getString('STAFF_RELATIONSHIP'); ?></th>
                                <th><?php echo $this->getString('STAFF_MOBILE'); ?></th>
                                <th><?php echo $this->getString('STAFF_TELEPHONE'); ?></th>
                                <th><?php echo $this->getString('STAFF_WORK_TELEPHONE'); ?></th>
                                <th><?php echo $this->getString('STAFF_EMAIL'); ?></th>
                                <th class="cog-col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="contact in ctrl.staffEmergencyContacts">
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
                                            <li><a ng-click="ctrl.openEditEmergencyContactModal(contact)">Edit</a></li>
                                            <li><a ng-click="ctrl.delete(contact)">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>

            </div>
        </uib-tab>
        <uib-tab heading="Benefits">


            <div ng-controller="staffBenefitsCtrl as ctrl">
                <div class="modal-header">
                    <h1 class="pull-left"><?php //echo $this->getString('STAFF_BENEFITS_HISTORY');                                ?></h1>
                    <button ng-if="!ctrl.addingNew" class="pull-right" ng-click="ctrl.openAddNewBenefitsModal()" ng-disabled="!ctrl.staffLoaded">
                        <?php echo $this->getString('STAFF_NEW'); ?>
                    </button>
                    <div ng-if="ctrl.addingNew" class="btn-group pull-right">
                        <button class="primary" ng-click="ctrl.saveNewBenefits(staff)">
                            <?php echo $this->getString('STAFF_SAVE'); ?>
                        </button>
                        <button ng-click="ctrl.toggleAddNewBenefits()">
                            <?php echo $this->getString('STAFF_RESET'); ?>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo $this->getString('STAFF_POSITION'); ?></th>
                                <th><?php echo $this->getString('STAFF_DEPARTMENT'); ?></th>
                                <th><?php echo $this->getString('STAFF_SALARY'); ?></th>
                                <th><?php echo $this->getString('STAFF_IS_HOURLY'); ?></th>
                                <th><?php echo $this->getString('STAFF_VACATION_MONTHLY'); ?></th>
                                <th><?php echo $this->getString('STAFF_SICK_MONTHLY'); ?></th>
                                <th><?php echo $this->getString('STAFF_START_DATE'); ?></th>
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
                                <td class="has-datepicker">{{benefits.startDate| date:'yyyy-MM-dd':+0000}}</td>
                            </tr>
                        </tbody>
                    </table>

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
        </uib-tab>
        <uib-tab heading="Documents">
            <div ng-if="claimLoading">
                <div class="text-center"><span class="spinner-loader"></span></div>
            </div>
            <div ng-if="!claimLoading">
                <documents module="claims" model='{{claim}}' model-type="Claim">
                    <div class="pull-right">
                        <button class="primary" ng-click="openUploadDocumentsModal(claim)">
                            Upload Documents
                        </button>
                    </div>
                </documents>
            </div>
        </uib-tab>
        <uib-tab heading="<?php echo $this->getString('STAFF_ACCESS_LEVELS'); ?>">
            <div class="card" ng-controller="staffRolesCtrl as ctrl">
                <div class="cardheader">
                    <h1><?php // /echo $this->getString('STAFF_ACCESS_LEVELS');                               ?></h1>
                </div>
                <div ng-if="ctrl.loading">
                    <div class="spinner-loader"></div>
                </div>
                <div ng-if="!ctrl.loading" ng-disabled="!ctrl.staffLoaded">


                    <?php foreach ($roleForm as $item) { ?>
                        <div class="form-group col-md-4">
                            <?php echo $item['html']; ?>
                            <label for="StaffRoles[<?php echo $item['id']; ?>]"><?php echo $this->getString('STAFF_ROLES_' . $item['role']); ?></label>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="clearfix"></div>
                    <div class="cardfooter">
                        <div class="pull-right btn-group">
                            <button class="primary" ng-click="ctrl.submitRoles(ctrl.staffRoles)">
                                <?php echo $this->getString('STAFF_SUBMIT'); ?>
                            </button>
                            <button ng-click="ctrl.resetCredentials()">
                                <?php echo $this->getString('STAFF_RESET'); ?>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </uib-tab>
    </uib-tabset>
</div>

<script id="emergencyContactInfo" type="text/ng-template">
<?php
include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/editEmergencyContactModal.php');
?>
</script>

<script id="addNewBenefit" type="text/ng-template">
    <?php
    include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/addNewBenefitForm.php');
    ?>
</script>