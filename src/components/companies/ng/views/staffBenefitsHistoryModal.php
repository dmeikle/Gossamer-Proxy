<div class="modal-header">
    <h1 class="pull-left"><?php echo $this->getString('STAFF_BENEFITS_HISTORY'); ?></h1>
    <button ng-if="!addingNew" class="pull-right" ng-click="toggleAddNewBenefits()">
        <?php echo $this->getString('STAFF_UPDATE'); ?>
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
                <td><input class="form-control" type="number" name="staff-salary" id="staff-salary" ng-model="staff.salary"></td>
                <td>
                    <select class="form-control" ng-model="staff.isHourly" name="staff-hourly" id="staff-hourly">
                        <option value="0" selected>No</option>
                        <option value="1">Yes</option>
                    </select>
                </td>
                <td><input class="form-control" type="number" name="staff-accruedVacationMonthly" id="staff-accruedVacationMonthly" ng-model="staff.accruedVacationMonthly"></td>
                <td><input class="form-control" type="number" name="staff-accruedSickMonthly" id="staff-accruedSickMonthly" ng-model="staff.accruedSickMonthly"></td>
                <td>
                    <div class="input-group">
                        <input type="date" name="startDate" id="staff-startDate" ng-model="staff.startDate" ng-model-options="{timezone: '+0000'}"
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
            <tr ng-repeat="benefits in staffBenefits">
                <td>{{benefits.position}}</td>
                <td>{{benefits.department}}</td>
                <td>{{benefits.salary| currency}}</td>
                <td bool-to-string data-value="{{benefits.isHourly}}"></td>
                <td>{{benefits.accruedVacationMonthly}}</td>
                <td>{{benefits.accruedSickMonthly}}</td>
                <td>{{benefits.startDate| date:'dd-MM-yyyy':+0000}}</td>
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
