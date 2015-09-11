    <div class="widget" ng-controller="timesheetListCtrl">
<div class="widget-content" ng-class="{'panel-open': selectedTimesheet}">
    <h1 class="pull-left">Timesheet List</h1>
<!--    <a href="staff/edit/0" class="pull-right"><?php echo $this->getString('STAFF_NEW');?></a>-->
    <div class="clearfix"></div>
    <div class="pull-left">
        <button class="primary" ng-click="openTimesheetModal()"><?php echo $this->getString('ACCOUNTING_NEW_TIMESHEET') ?></button>
    </div>
    <div class="pull-right">
      <button class="btn-link" ng-click="openStaffAdvancedSearchModal()">
        <?php echo $this->getString('STAFF_ADVANCED_SEARCH') ?>
      </button>
      <input type="text" list="autocomplete-list" ng-model="basicSearch.val[0]">
      <datalist id="autocomplete-list">
        <option ng-if="!autocomplete.length > 0" value=""><?php echo $this->getString('STAFF_LOADING'); ?></option>
        <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
      </datalist>
      <select name="basicSearchCol" id="basic-search-col" ng-model="basicSearch.col[0]"
        ng-init="basicSearch.col[0] = 'name'">
        <option value="name" ng-selected="true"><?php echo $this->getString('STAFF_NAME');?></option>
        <option value="ext"><?php echo $this->getString('STAFF_EXT');?></option>
        <option value="phone"><?php echo $this->getString('STAFF_PHONE');?></option>
      </select>
      <button class="primary" ng-click="search(basicSearch)">
        <?php echo $this->getString('STAFF_SEARCH') ?>
      </button>
    </div>
    <div class="clearfix"></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->getString('ACCOUNTING_LABORER'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_CLAIM'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_PHASE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_LABOUR_CATEGORY'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_HOURLY_RATE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_REG'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_OT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_DOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SREG'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SDOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_DATE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_EXPORTED'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_TOTAL'); ?></th>
                <th class="cog-col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <tr ng-if="loading">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>  
            <td>
              <span class="spinner-loader"></span>
            </td>
            <td></td>  
            <td></td>
            <td></td>  
            <td></td>  
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr ng-if="!loading" ng-repeat="timesheet in timesheetList" ng-click="selectRow(timesheet)" ng-class="{'selected': timesheet.clicked}">
              <td>{{timesheet.lastname}}, {{timesheet.firstname}}</td>
              <td>{{timesheet.numJobs}}</td>
              <td>{{timesheet.title}}</td>
              <td>{{timesheet.typeOfStaff}}</td>
              <td>{{timesheet.description}}</td>
              <td>{{timesheet.hourlyRate | currency}}</td>
              <td>{{timesheet.regularHours}}</td>
              <td>{{timesheet.overtimeHours}}</td>
              <td>{{timesheet.doubleOTHours}}</td>
              <td>{{timesheet.statRegularHours}}</td>
              <td>{{timesheet.statOTHours}}</td>
              <td>{{timesheet.statDoubleOTHours}}</td>
              <td>{{timesheet.workDate}}</td>
              <td>{{timesheet.isExported}}</td>
              <td>{{timesheet.totalHours}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="openStaffScheduleModal(staff)">Schedule</a></li>
                    <li><a href="staff/edit/{{staff.id}}">Edit</a></li>
                    <li><a href="#">Emergency Contacts</a></li>
                    <li><a href="#">Delete</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <pagination total-items="totalItems" ng-model="currentPage" max-size="itemsPerPage"
      class="pagination" boundary-links="true" rotate="false">
    </pagination>
  </div>
</div>