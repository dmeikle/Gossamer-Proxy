


<div class="modal-header">
    <h1 ng-if="!contact.id"><?php echo $this->getString('STAFF_EMERGENCY_ADDNEW') ?></h1>
    <h1 ng-if="contact.id"><?php echo $this->getString('STAFF_EDIT') ?> {{contact.firstname}} {{contact.lastname}}</h1>
</div>
<div class="modal-body clearfix">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="contact-firstname"><?php echo $this->getString('STAFF_SALARY'); ?></label>
            <?php echo $form['StaffPositions_id']; ?>
        </div>
        <div class="form-group">
            <label for="contact-firstname"><?php echo $this->getString('STAFF_SALARY'); ?></label>
            <?php echo $form['Departments_id']; ?>
        </div>
        <div class="form-group">
            <label for="contact-firstname"><?php echo $this->getString('STAFF_SALARY'); ?></label>
            <input class="form-control" type="number" name="staff-salary" id="staff-salary" ng-model="staff.salary">
        </div>
        <div class="form-group">
            <label for="contact-lastname"><?php echo $this->getString('STAFF_IS_HOURLY'); ?></label>
            <select class="form-control" ng-model="staff.isHourly" name="staff-hourly" id="staff-hourly">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact-relation"><?php echo $this->getString('STAFF_VACATION_MONTHLY'); ?></label>
            <input class="form-control" type="number" name="staff-accruedVacationMonthly" id="staff-accruedVacationMonthly" ng-model="staff.accruedVacationMonthly">
        </div>
        <div class="form-group">
            <label for="contact-email"><?php echo $this->getString('STAFF_SICK_MONTHLY'); ?></label>
            <input class="form-control" type="number" name="staff-accruedSickMonthly" id="staff-accruedSickMonthly" ng-model="staff.accruedSickMonthly">
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="contact-mobile"><?php echo $this->getString('STAFF_START_DATE'); ?></label>
            <div class="input-group">
                <input type="text" name="startDate" id="staff-startDate" ng-model="staff.startDate" ng-model-options="{timezone: '+0000'}"
                       class="form-control" datepicker-popup is-open="isOpen.startDate"
                       datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                <span class="input-group-btn" data-datepickername="startDate">
                    <button type="button" class="btn-default" data-datepickername="startDate" ng-click="openDatepicker($event)">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="contact-telephone"><?php echo $this->getString('STAFF_TELEPHONE'); ?></label>
            <input class="form-control" type="text" name="telephone"
                   id="contact-telephone" ng-model="ctrl.contact.telephone">
        </div>
        <div class="form-group">
            <label for="contact-workTelephone"><?php echo $this->getString('STAFF_WORK_TELEPHONE'); ?></label>
            <input class="form-control" type="text" name="workTelephone"
                   id="contact-workTelephone" ng-model="ctrl.contact.workTelephone">
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <button class="primary" ng-click="ctrl.save(ctrl.contact)">
            <?php echo $this->getString('STAFF_SAVE'); ?>
        </button>
        <button ng-click="ctrl.close()">
            <?php echo $this->getString('STAFF_CANCEL'); ?>
        </button>
    </div>
</div>
