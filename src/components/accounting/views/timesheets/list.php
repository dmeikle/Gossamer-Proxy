<div class="widget" ng-controller="timesheetListCtrl">
<div class="widget-content" ng-class="{'panel-open': selectedTimesheet}">
    <h1 class="pull-left">Timesheet List</h1>
<!--    <a href="staff/edit/0" class="pull-right"><?php echo $this->getString('STAFF_NEW');?></a>-->
    <div class="clearfix"></div>
    <div class="pull-left">
        <button class="primary" data-toggle="modal" data-target="#new-timesheet">New Timesheet</button>
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
            <td>
              <span class="spinner-loader"></span>
            </td>
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

<!-- Add New Timesheet Modal -->
<div class="modal fade" id="new-timesheet" tabindex="-1" role="dialog" aria-labelledby="newTimesheet" ng-controller="timesheetListCtrl">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Timesheet</h4>
            </div>
            <div class="modal-body">
                <div class="laborer">
                    Laborer:
                    <input type="text" list="timesheet-autocomplete-list" ng-model="basicSearch.val[0]">
                    <datalist id="timesheet-autocomplete-list">
                        <option ng-if="!autocomplete.length > 0" value=""><?php echo $this->getString('STAFF_LOADING'); ?></option>
                        <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                    </datalist>           
                </div>
                
                <div class="date">
                    Date: {{ yesterday | date:'yyyy-MM-dd' }}
                </div>
                
                <div class="total-hours">
                    Total Hours
                </div>
                
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col">&nbsp;</th>
                            <th><?php echo $this->getString('ACCOUNTING_CLAIM'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_PHASE'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_LABOUR_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_REG'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_OT'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_DOT'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_SREG'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_SOT'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_SDOT'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_TOTAL'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
