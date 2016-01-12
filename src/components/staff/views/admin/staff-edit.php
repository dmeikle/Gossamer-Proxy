
<div class="content full-width">

    <h1 ng-if="!ctrl.staff"><?php echo $this->getString('STAFF_CREATE'); ?></h1>
    <h1 class="pull-left" ng-if="staff"><?php echo $this->getString('STAFF_EDIT') ?> {{ctrl.staff.firstname}} {{ctrl.staff.lastname}}</h1>
    <div class="clearfix"></div>
    <div  ng-controller="staffInformationCtrl as ctrl">
        <div class="cards">
            <div class="card">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('STAFF_EMPLOYMENT_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>

                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>

                <div class="cardleft">
                    <div class="form-group">
                        <label for="staff-telephone"><?php echo $this->getString('STAFF_TELEPHONE'); ?></label>
                        <?php echo $form['telephone']; ?>
                    </div>
                    <div class="form-group">
                        <label for="staff-mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
                        <?php echo $form['mobile']; ?>
                    </div>
                    <div class="form-group">
                        <label for="staff-email"><?php echo $this->getString('STAFF_EMAIL'); ?></label>
                        <?php echo $form['email']; ?>
                    </div>
                    <div class="form-group">
                        <label for="staff-employeeNumber"><?php echo $this->getString('STAFF_EMPLOYEENUM'); ?></label>
                        <!--<input class="form-control" type="text" name="employeeNumber" ng-disabled="!$rootScope.staff"
                               id="staff-employeeNumber" ng-model="staff.employeeNumber">-->
                        <?php echo $form['employeeNumber']; ?>
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
                </div>
                <div class="cardright">
                    <div class="form-group">
                        <label for="staff-title"><?php echo $this->getString('STAFF_TITLE'); ?></label>
                        <?php echo $form['title']; ?>
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
                    <div class="form-group">
                        <label for="staff-extension"><?php echo $this->getString('STAFF_EXTENSION'); ?></label>
                        <?php echo $form['extension']; ?>
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
                    <div class="cardleft">
                        <div class="form-group">
                            <label for="staff-firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></label>
                            <?php echo $form['firstname']; ?>
                        </div>
                        <div class="form-group">
                            <label for="staff-lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></label>
                            <?php echo $form['lastname']; ?>
                        </div>
                        <div class="form-group">
                            <label for="staff-personalEmail"><?php echo $this->getString('STAFF_PERSONALEMAIL'); ?></label>
                            <?php echo $form['personalEmail']; ?>
                        </div>
                        <div class="form-group">
                            <label for="staff-personalMobile"><?php echo $this->getString('STAFF_PERSONALMOBILE'); ?></label>
                            <?php echo $form['personalMobile']; ?>
                        </div>
                        <div class="form-group">
                            <label for="staff-personalTelephone"><?php echo $this->getString('STAFF_PERSONALTELEPHONE'); ?></label>
                            <?php echo $form['personalTelephone']; ?>
                        </div>
                    </div>
                    <div class="cardright">
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
                        <div class="form-group">
                            <label for="staff-postalCode"><?php echo $this->getString('STAFF_POSTALCODE'); ?></label>
                            <?php echo $form['postalCode']; ?>
                        </div>
                        <div class="form-group">
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
                    </div>



                    <div class="clearfix"></div>
                    <div class="cardfooter">
                        <input type="submit" class="btn btn-primary pull-right" ng-disabled="!staff.firstname || !staff.lastname"
                               value="<?php echo $this->getString('STAFF_SAVE'); ?>">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


        </div>

    </div>


    <div class="clearfix"></div>
    <form>
        <input type="hidden" value="<?php echo intval($id); ?>" id="Staff_id" />
    </form>
</div>
</div>
