<!--- javascript start --->

@components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->

<div class="col-md-12">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Create New Staff
            </div>
            <div class="block-controls">
                <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">
                <div id="rootwizard-1" class="wizard-container">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                <span class="icon icon-number-one"></span>
                                <span class="main-text">
                                    <span class="h2">Personal</span>
                                    <small>Home contact info</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">
                                <span class="icon icon-number-two"></span>
                                <span class="main-text">
                                    <span class="h2">Employment</span>
                                    <small>Company contact info</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">
                                <span class="icon icon-number-three"></span>
                                <span class="main-text">
                                    <span class="h2">Permissions</span>
                                    <small>Roles within the software</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">
                                <span class="icon icon-number-four"></span>
                                <span class="main-text">
                                    <span class="h2">Credentials</span>
                                    <small>Username and password</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">
                                <span class="icon icon-number-four"></span>
                                <span class="main-text">
                                    <span class="h2">Finish</span>
                                    <small>You're done!</small>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar  progress-bar-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" id="wizard-stage-1" >

                                        <div ng-controller="EditStaffController">
                                            <?php echo $form['id']; ?>
                                            <div class="form-group">
                                                <label class="control-label">Firstname</label>
                                                <?php echo $form['firstname']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Lastname</label>
                                                <?php echo $form['lastname']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Telephone</label>
                                                <?php echo $form['personalTelephone']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Mobile</label>
                                                <?php echo $form['personalMobile']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Personal Email address</label>
                                                <?php echo $form['personalEmail']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <?php echo $form['address1']; ?>
                                                <?php echo $form['address2']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <?php echo $form['city']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Province</label>
                                                <?php echo $form['Provinces_id']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Postal Code</label>
                                                <?php echo $form['postalCode']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Date of Birth</label>
                                                <?php echo $form['dob']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Gender</label>
                                                <?php echo $form['gender']; ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"></label>
                                                <?php echo $form['savePersonal']; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" id="wizard-stage-2">
                                        <div ng-controller="EditStaffController">
                                            <div class="form-group">
                                                <label class="control-label">Company Email</label>
                                                <?php echo $form['email']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Staff Type</label>
                                                <?php echo $form['StaffTypes_id']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Department</label>
                                                <?php echo $form['Departments_id']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <?php echo $form['StaffPositions_id']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Employee Number</label>
                                                <?php echo $form['employeeNumber']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Extension</label>
                                                <?php echo $form['extension']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company Mobile</label>
                                                <?php echo $form['mobile']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Hire Date</label>
                                                <?php echo $form['hireDate']; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Departure Date</label>
                                                <?php echo $form['departureDate']; ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"></label>
                                                <?php echo $form['saveEmployment']; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" id="wizard-stage-3">
                                        <div ng-controller="StaffRolesController">
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <p class="selectable">
                                                            <?php foreach ($StaffRoles as $role) { ?>
                                                            <div class="checkbox">
                                                                <label class="">
                                                                    <div class="icheckbox_square-blue" style="position: relative;">
                                                                        <input id="StaffAuthorization_<?php echo $role['role']; ?>" ng-model="rolesList['<?php echo $role['role']; ?>']" type="checkbox" name="userAuthorizations[<?php echo $role['role']; ?>]" value="1"  style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                                                        <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                                                    </div>
                                                                    <?php echo $role['title']; ?>
                                                                </label>
                                                            </div>


                                                        <?php } ?>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="form-group">
                                                <label class="control-label"></label>
                                                <?php echo $form['saveRoles']; ?>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-wizard-review-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="row">
                                <form method="post" id="wizard-stage-4">
                                    <div class="col-md-6" ng-controller="CredentialsController">

                                        <div class="form-group {{usernameExistsClass}}" >
                                            <label class="control-label">Username</label>
                                            <?php echo $aform['username']; ?>
                                            <small ng-show="isUsernameExists" class="help-block" data-bv-validator="StaffAuthorization[username]" data-bv-for="StaffAuthorization[username]" data-bv-result="INVALID" style="">This username is already in use</small>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <?php echo $aform['password']; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <?php echo $aform['passwordConfirm']; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <?php echo $aform['saveCredentials']; ?>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>You're Done!</h2>
                                    <p>Thanks for filling out this form. We'll get back to you shortly.</p>
                                </div>
                            </div>
                        </div>
                        <ul class="pager wizard">
                            <li class="previous first disabled" style="display:none;"><a href="#">First</a></li>
                            <li class="previous disabled"><a href="#">Previous</a></li>
                            <li class="next last" style="display:none;"><a href="#">Last</a></li>
                            <li class="next"><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>