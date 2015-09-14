<div class="widget" ng-controller="staffListCtrl">
  <div class="widget-content" ng-class="{'panel-open': selectedStaff}">
    <h1 class="pull-left">Staff List</h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openStaffAdvancedSearchModal()">
        <?php echo $this->getString('STAFF_ADVANCED_SEARCH') ?>
      </button>
      <div class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.val[0]">
        <span class="input-group-btn">
          <button class="btn-default" ng-click="search(basicSearch)">
            <?php echo $this->getString('STAFF_SEARCH') ?>
          </button>
        </span>
        <datalist id="autocomplete-list">
          <option ng-if="!autocomplete.length > 0" value=""><?php echo $this->getString('STAFF_LOADING'); ?></option>
          <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
        </datalist>
      </div>
      <button ng-click="openAddNewStaffModal()" class="btn-primary"><?php echo $this->getString('STAFF_NEW');?></button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->getString('STAFF_NAME'); ?></th>
                <th><?php echo $this->getString('STAFF_TITLE'); ?></th>
                <th><?php echo $this->getString('STAFF_EXTENSION'); ?></th>
                <th><?php echo $this->getString('STAFF_MOBILE'); ?></th>
                <th><?php echo $this->getString('STAFF_STATUS'); ?></th>
                <th><?php echo $this->getString('STAFF_LAST_LOGIN'); ?></th>
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
          <tr ng-if="!loading" ng-repeat="staff in staffList"
            ng-class="{'selected': staff.clicked, 'inactive bg-warning text-warning': staff.status=='inactive'}">
              <td ng-click="selectRow(staff)"><a href="mailto:{{staff.email}}">{{staff.lastname}}, {{staff.firstname}}</a></td>
              <td ng-click="selectRow(staff)">{{staff.title}}</td>
              <td ng-click="selectRow(staff)">{{staff.telephone}}</td>
              <td ng-click="selectRow(staff)">{{staff.mobile}}</td>
              <td ng-click="selectRow(staff)">{{staff.status}}</td>
              <td ng-click="selectRow(staff)">{{staff.lastLogin}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="openStaffScheduleModal(staff)">Schedule</a></li>
                    <li><a href="edit/{{staff.id}}">Edit</a></li>
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

  <div class="widget-side-panel">
    <h1><a href="edit/{{selectedStaff.id}}">{{selectedStaff.firstname}} {{selectedStaff.lastname}}</a></h1>
    <h4><?php echo $this->getString('STAFF_TELEPHONE')?></h3>
    <p>{{selectedStaff.telephone}}</p>
    <h4><?php echo $this->getString('STAFF_MOBILE')?></h3>
    <p>{{selectedStaff.mobile}}</p>
    <h4><?php echo $this->getString('STAFF_EMAIL')?></h3>
    <p>{{selectedStaff.email}}</p>
    <h4><?php echo $this->getString('STAFF_CITY')?></h3>
    <p>{{selectedStaff.city}}</p>
    <h4><?php echo $this->getString('STAFF_POSTALCODE')?></h3>
    <p>{{selectedStaff.postalCode}}</p>
    <h4><?php echo $this->getString('STAFF_TITLE')?></h3>
    <p>{{selectedStaff.title}}</p>
    <h4><?php echo $this->getString('STAFF_EMPLOYEENUM')?></h3>
    <p>{{selectedStaff.employeeNumber}}</p>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
