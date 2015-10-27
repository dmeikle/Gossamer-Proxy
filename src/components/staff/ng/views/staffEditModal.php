


<div class="modal-header" ng-switch="staff.id">
    <h1 ng-switch-when="undefined" class="modal-title">Add New Staff Member</h1>
    <h1 class="modal-title" ng-switch-default>{{staff.firstname}} {{staff.lastname}}</h1>
    <div class="clearfix"></div>
</div>
<div class="modal-body">
    <div class="cards">
        <div class="card">
            <h1>Personal Information</h1>
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
    <div class="cards">
        <div class="card">
            <h1>Contact Information</h1>
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
                <label for="city"><?php echo $this->getString('STAFF_PROVINCE'); ?></label>
                <?php echo $form['Provinces_id']; ?>
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

        </div>
    </div>
    <div class="cards">
        <div class="card">
            <h1>Test Card 3</h1>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <button class="primary" ng-click="confirm(widget)"><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>

    <button ng-click="cancel()"><?php echo $this->getString('WIDGET_CANCEL'); ?></button>
</div>
