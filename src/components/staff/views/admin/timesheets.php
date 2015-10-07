<div class="widget" ng-controller="staffTimesheetCtrl">
    <div class="widget-content" ng-class="{'panel-open': selectedTimesheet}">
        <h1 class="pull-left">Timesheet List</h1>
        <div class="clearfix"></div>
        <div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php echo $this->getString('ACCOUNTING_TIMESHEET_DB_ERROR') ?></div>
        <div class="pull-left">
            <button class="primary" ng-click="openStaffTimesheetModal()"><?php echo $this->getString('STAFF_TIMESHEET_NEW') ?></button><span ng-cloak ng-if="loadingModal" class="modal-spinner spinner-loader"></span>
        </div>        
    </div>
    <div class="clearfix"></div>
</div>