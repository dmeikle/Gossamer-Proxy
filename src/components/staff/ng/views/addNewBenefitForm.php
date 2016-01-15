


<div class="modal-header">
    <h1><?php echo $this->getString('STAFF_EMERGENCY_ADDNEW') ?></h1>
</div>
<div class="modal-body clearfix">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="contact-position"><?php echo $this->getString('STAFF_POSITION'); ?></label>
            <?php echo $form['StaffPositions_id']; ?>
        </div>
        <div class="form-group">
            <label for="contact-department"><?php echo $this->getString('STAFF_DEPARTMENT'); ?></label>
            <?php echo $form['Departments_id']; ?>
        </div>
        <div class="form-group">
            <label for="contact-salary"><?php echo $this->getString('STAFF_SALARY'); ?></label>
            <input class="form-control" type="number" name="staff-salary" id="staff-salary" ng-model="ctrl.staff.salary">
        </div>
        <div class="form-group">
            <label for="contact-hourly"><?php echo $this->getString('STAFF_IS_HOURLY'); ?></label>
            <select class="form-control" ng-model="ctrl.staff.isHourly" name="staff-hourly" id="staff-hourly">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="contact-mobile"><?php echo $this->getString('STAFF_START_DATE'); ?></label>
            <div class="input-group">
                <input type="text" name="startDate" id="staff-startDate" ng-model="ctrl.staff.startDate" ng-model-options="{timezone: '+0000'}"
                       class="form-control" uib-datepicker-popup is-open="ctrl.isOpen.startDate"
                       datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('STAFF_CLOSE'); ?>" />
                <span class="input-group-btn" data-datepickername="startDate">
                    <button type="button" class="btn-default" data-datepickername="startDate" ng-click="ctrl.openDatepicker('startDate')">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </button>
                </span>

            </div>
        </div>
        <div class="form-group">
            <label for="contact-vacation"><?php echo $this->getString('STAFF_VACATION_MONTHLY'); ?></label>
            <input class="form-control" type="number" name="staff-accruedVacationMonthly" id="staff-accruedVacationMonthly" ng-model="ctrl.staff.accruedVacationMonthly">
        </div>
        <div class="form-group">
            <label for="contact-sick"><?php echo $this->getString('STAFF_SICK_MONTHLY'); ?></label>
            <input class="form-control" type="number" name="staff-accruedSickMonthly" id="staff-accruedSickMonthly" ng-model="ctrl.staff.accruedSickMonthly">
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <button class="primary" ng-click="ctrl.save(ctrl.staff)">
            <?php echo $this->getString('STAFF_SAVE'); ?>
        </button>
        <button ng-click="ctrl.close()">
            <?php echo $this->getString('STAFF_CANCEL'); ?>
        </button>
    </div>
</div>
