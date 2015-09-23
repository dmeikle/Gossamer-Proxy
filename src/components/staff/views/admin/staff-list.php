<div class="widget" ng-controller="staffListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left">Staff List</h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openStaffAdvancedSearch()">
        <?php echo $this->getString('STAFF_ADVANCED_SEARCH') ?>
      </button>
      <div class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
          ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
        <span class="input-group-addon" ng-if="!searchSubmitted">
          <span class="glyphicon glyphicon-search"></span>
        </span>
        <span ng-if="searchSubmitted" class="input-group-btn">
          <button class="btn-default" ng-click="resetSearch()">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </span>
        <datalist id="autocomplete-list">
          <option ng-if="!autocomplete" value="" disabled><?php echo $this->getString('STAFF_LOADING'); ?></option>
          <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
        </datalist>
      </div>
      <a href="/admin/staff/edit/0" class="btn btn-primary"><?php echo $this->getString('STAFF_NEW');?></a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></th>
                <th column-sortable data-column="lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></th>
                <th column-sortable data-column="title"><?php echo $this->getString('STAFF_TITLE'); ?></th>
                <th column-sortable data-column="telephone"><?php echo $this->getString('STAFF_EXTENSION'); ?></th>
                <th column-sortable data-column="mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></th>
                <th column-sortable data-column="status"><?php echo $this->getString('STAFF_STATUS'); ?></th>
                <th column-sortable data-column="lastLogin"><?php echo $this->getString('STAFF_LAST_LOGIN'); ?></th>
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
            ng-class="{'selected': staff === previouslyClickedObject, 'inactive bg-warning text-warning': staff.status=='inactive'}">
              <td ng-click="selectRow(staff)">{{staff.firstname}}</td>
              <td ng-click="selectRow(staff)">{{staff.lastname}}</td>
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
                    <li><a href="/admin/staff/edit/{{staff.id}}">Edit</a></li>
                    <li><a href="#">Emergency Contacts</a></li>
                    <li><a href="#">Delete</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <pagination class="pull-left" total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage"
      class="pagination" boundary-links="true" rotate="false">
    </pagination>

    <div class="pull-right">
      <p class="pull-left"><?php echo $this->getString('ITEMS_PER_PAGE'); ?></p>
      <ul class="btn-group pull-right">
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 10}" ng-click="setItemsPerPage(10)">10</button>
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 20}" ng-click="setItemsPerPage(20)">20</button>
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 50}" ng-click="setItemsPerPage(50)">50</button>
      </ul>
    </div>
  </div>

  <div class="widget-side-panel">
    <div class="pull-right">
      <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
    <div ng-if="sidePanelLoading">
      <span class="spinner-loader"></span>
    </div>

    <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
      <h1><?php echo $this->getString('STAFF_ADVANCED_SEARCH');?></h1>
      <staff-advanced-search-filters>

      </staff-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('STAFF_SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('STAFF_RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching">
      <h1><a href="/admin/staff/edit/{{selectedStaff.id}}">{{selectedStaff.firstname}} {{selectedStaff.lastname}}</a></h1>
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
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
