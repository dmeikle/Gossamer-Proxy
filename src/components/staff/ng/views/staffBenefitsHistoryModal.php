<div class="modal-header">
  <h1 class="pull-left"><?php echo $this->getString('STAFF_BENEFITS_HISTORY'); ?></h1>
  <button ng-if="!addingNew" class="pull-right" ng-click="addNewBenefits()">
    <?php echo $this->getString('STAFF_UPDATE');?>
  </button>
  <button ng-if="addingNew" class="pull-right" ng-click="saveNewBenefits()">
    <?php echo $this->getString('STAFF_SAVE');?>
  </button>
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
        <td><?php echo $form['StaffPositions_id']; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr ng-repeat="benefits in staffBenefits">
        <td>{{benefits.StaffPositions_id}}</td>
        <td>{{benefits.Departments_id}}</td>
        <td>{{benefits.salary | currency}}</td>
        <td bool-to-string data-value="{{benefits.isHourly}}"></td>
        <td>{{benefits.accruedVacationMonthly}}</td>
        <td>{{benefits.accruedSickMonthly}}</td>
        <td>{{benefits.startDate}}</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="modal-footer">
  <button class="primary">
    <?php echo $this->getString('STAFF_CLOSE'); ?>
  </button>
</div>
<?php pr($this->data); ?>
