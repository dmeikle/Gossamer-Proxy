<div class="widget" ng-controller="warehouseListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left"><?php echo $this->getString('WAREHOUSE_LIST') ?></h1>
    <div ng-hide="grouped" class="toolbar form-inline">
      <button class="btn-link" ng-click="openWarehouseAdvancedSearch()">
        <?php echo $this->getString('WAREHOUSE_ADVANCED_SEARCH') ?>
      </button>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

      <form ng-submit="search(basicSearch.query)" class="input-group">
        <input type="text" ng-model="basicSearch.query.name" ng-model-options="{debounce:500}"
          uib-typeahead="value for value in fetchAutocomplete($viewValue)"
          typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control"
          typeahead-on-select="search(basicSearch.query)" typeahead-min-length='3'>
        <div class="resultspane" ng-show="noResults">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('WAREHOUSE_NORESULTS') ?>
        </div>
        <span class="input-group-btn" ng-if="!searchSubmitted">
          <button type="submit" class="btn-default">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
        <span ng-if="searchSubmitted" class="input-group-btn">
          <button type="reset" class="btn-default" ng-click="resetSearch()">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </span>
      </form>
      <a href="/admin/warehouse/edit/0" class="btn btn-primary"><?php echo $this->getString('NEW');?></a>
    </div>
    <table class="table table-striped table-hover">
      <thead>
          <tr>
              <th ng-hide="groupedBy === 'id'" column-sortable data-column="id"><?php echo $this->getString('WAREHOUSE_ID'); ?></th>
              <th ng-hide="groupedBy === 'parentId'" column-sortable data-column="parentId"><?php echo $this->getString('WAREHOUSE_PARENTID'); ?></th>
              <th ng-hide="groupedBy === 'name'" column-sortable data-column="name"><?php echo $this->getString('WAREHOUSE_NAME'); ?></th>
              <th ng-hide="groupedBy === 'priority'" column-sortable data-column="priority"><?php echo $this->getString('WAREHOUSE_PRIORITY'); ?></th>
              <th ng-hide="groupedBy === 'description'" column-sortable data-column="description"><?php echo $this->getString('WAREHOUSE_DESCRIPTION'); ?></th>
              <th ng-hide="groupedBy === 'isActive'" column-sortable data-column="isActive"><?php echo $this->getString('WAREHOUSE_ISACTIVE'); ?></th>
              <th group-by-button class="cog-col row-controls"></th>
          </tr>
      </thead>
      <tbody ng-if="loading">
        <tr>
          <td ng-hide="groupedBy === 'id'"></td>
          <td ng-hide="groupedBy === 'parentId'"></td>
          <td ng-hide="groupedBy === 'name'"></td>
          <td ng-hide="groupedBy === 'priority'">
            <span class="spinner-loader"></span>
          </td>
          <td ng-hide="groupedBy === 'description'"></td>
          <td ng-hide="groupedBy === 'isActive'"></td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
      <tbody>
        <tr ng-if="!loading && grouped && warehouse[groupedBy] !== warehouseList[$index-1][groupedBy]" ng-repeat-start="warehouse in warehouseList">
          <th colspan="7">
            <span ng-if="groupedBy === 'id'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_ID'); ?>
            </span>
            <span ng-if="groupedBy === 'parentId'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_PARENTID'); ?>
            </span>
            <span ng-if="groupedBy === 'name'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_NAME'); ?>
            </span>
            <span ng-if="groupedBy === 'extension'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_PRIORITY'); ?>
            </span>
            <span ng-if="groupedBy === 'description'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_DESCRIPTION'); ?>
            </span>
            <span ng-if="groupedBy === 'isActive'">
              <?php echo $this->getString('WAREHOUSE_GROUPEDBY_ISACTIVE'); ?>
            </span>
            {{warehouse[groupedBy]}}
          </th>
        </tr>
        <tr ng-if="!loading" ng-repeat-end
          ng-class="{'selected': warehouse === previouslyClickedObject, 'inactive bg-warning text-warning': warehouse.isActive=='inactive'}">
          <td ng-hide="groupedBy === 'id'" ng-click="selectRow(warehouse)">{{warehouse.id}}</td>
          <td ng-hide="groupedBy === 'parentId'" ng-click="selectRow(warehouse)">{{warehouse.parentId}}</td>
          <td ng-hide="groupedBy === 'name'" ng-click="selectRow(warehouse)">{{warehouse.name}}</td>
          <td ng-hide="groupedBy === 'priority'" ng-click="selectRow(warehouse)">{{warehouse.priority}}</td>
          <td ng-hide="groupedBy === 'description'" ng-click="selectRow(warehouse)">{{warehouse.description}}</td>
          <td ng-hide="groupedBy === 'isActive'" ng-click="selectRow(warehouse)">{{warehouse.isActive}}</td>
          <td class="row-controls">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
              <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                <li><a ng-click="openWarehouseScheduleModal(warehouse)">Schedule</a></li>
                <li><a href="/admin/warehouse/edit/{{warehouse.id}}">Edit</a></li>
                <li><a href="#">Emergency Contacts</a></li>
                <li><a href="#">Delete</a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <uib-pagination class="pull-left" total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage"
      class="pagination" boundary-links="true" rotate="false">
    </uib-pagination>

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
      <h1><?php echo $this->getString('WAREHOUSE_ADVANCED_SEARCH');?></h1>
      <warehouse-advanced-search-filters>

      </warehouse-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('WAREHOUSE_SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('WAREHOUSE_RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching">
      <h1><a href="/admin/warehouse/edit/{{selectedWarehouse.id}}">{{selectedWarehouse.id}} {{selectedWarehouse.parentId}}</a></h1>
      <h4><?php echo $this->getString('WAREHOUSE_TELEPHONE')?></h3>
      <p>{{selectedWarehouse.priority}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_DESCRIPTION')?></h3>
      <p>{{selectedWarehouse.description}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_EMAIL')?></h3>
      <p>{{selectedWarehouse.email}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_CITY')?></h3>
      <p>{{selectedWarehouse.city}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_POSTALCODE')?></h3>
      <p>{{selectedWarehouse.postalCode}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_NAME')?></h3>
      <p>{{selectedWarehouse.name}}</p>
      <h4><?php echo $this->getString('WAREHOUSE_EMPLOYEENUM')?></h3>
      <p>{{selectedWarehouse.employeeNumber}}</p>
    </div>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
