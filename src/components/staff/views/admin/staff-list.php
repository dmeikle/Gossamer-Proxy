<div class="widget" ng-controller="staffListCtrl">
  <div class="widget-content" ng-class="{'panel-open': selectedStaff}">
    <h1 class="pull-left">Staff List</h1>
    <button class="pull-right"><?php echo $this->getString('STAFF_NEW');?></button>
    <div class="clearfix"></div>
    <div class="pull-right">
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
      <button ng-click="search(basicSearch)">
        <?php echo $this->getString('STAFF_SEARCH') ?>
      </button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->getString('STAFF_NAME'); ?></th>
                <th><?php echo $this->getString('STAFF_TITLE'); ?></th>
                <th><?php echo $this->getString('STAFF_EXT'); ?></th>
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
          <tr ng-if="!loading" ng-repeat="staff in staffList" ng-click="selectRow(staff)" ng-class="{'selected': staff.clicked}">
              <td><a href="mailto:{{staff.email}}">{{staff.lastname}}, {{staff.firstname}}</a></td>
              <td>{{staff.title}}</td>
              <td>{{staff.telephone}}</td>
              <td>{{staff.mobile}}</td>
              <td>{{staff.status}}</td>
              <td>{{staff.lastLogin}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="openStaffScheduleModal(staff)">Schedule</a></li>
                    <li><a ng-click="openStaffEditModal(staff)">Edit</a></li>
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
    <h1>{{selectedStaff.firstname}} {{selectedStaff.lastname}}</h1>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
