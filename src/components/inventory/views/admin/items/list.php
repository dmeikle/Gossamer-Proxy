<div class="widget" ng-controller="inventoryListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left"><?php echo $this->getString('INVENTORY_LIST') ?></h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openAdvancedSearch()">
        <?php echo $this->getString('ADVANCED_SEARCH') ?>
      </button>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

      <form ng-submit="search(basicSearch.query)" class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
          ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
        <div class="resultspane" ng-show="noResults">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('INVENTORY_NORESULTS') ?>
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
        <ul class="nav nav-pills">
            <li ng-class="{active : listType === 'equipment'}"><a href="" ng-click="switchList('equipment')">
              <?php echo $this->getString('INVENTORY_EQUIPMENT') ?>
            </a></li>
            <li ng-class="{active : listType === 'materials'}"><a href="" ng-click="switchList('materials')">
              <?php echo $this->getString('INVENTORY_MATERIALS') ?>
            </a></li>
        </ul>
      <a href="/admin/inventory/items/0" class="btn btn-primary"><?php echo $this->getString('INVENTORY_NEW');?></a>
    </div>
    <table ng-if="listType === 'materials'" class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="id" class="cog-col"><?php echo $this->getString('INVENTORY_ID'); ?></th>
                <th column-sortable data-column="name"><?php echo $this->getString('INVENTORY_NAME'); ?></th>
                <th column-sortable data-column="productCode"><?php echo $this->getString('INVENTORY_PRODUCTCODE'); ?></th>
                <th column-sortable data-column="description"><?php echo $this->getString('INVENTORY_DESCRIPTION'); ?></th>
                <th column-sortable data-column="minOrderQuantity"><?php echo $this->getString('INVENTORY_MINORDER'); ?></th>
                <th column-sortable data-column="maxQuantity"><?php echo $this->getString('INVENTORY_MAXORDER'); ?></th>
                <th column-sortable data-column="PackageTypes_id"><?php echo $this->getString('INVENTORY_PACKAGETYPE'); ?></th>
                <th column-sortable data-column="InventoryTypes_id"><?php echo $this->getString('INVENTORY_INVENTORYTYPE'); ?></th>
                <th column-sortable data-column="isActive"><?php echo $this->getString('INVENTORY_ISACTIVE'); ?></th>
                <th column-sortable data-column="InventoryCategories_id"><?php echo $this->getString('INVENTORY_INVENTORYCATEGORY'); ?></th>
                <th column-sortable data-column="price"><?php echo $this->getString('INVENTORY_PRICE'); ?></th>
                <th column-sortable data-column="WarehouseLocations_id"><?php echo $this->getString('INVENTORY_WAREHOUSELOCATION'); ?></th>
                <th group-by-button class="cog-col row-controls">&nbsp;</th>
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
            <td>
              <span class="spinner-loader"></span>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr ng-if="!loading" ng-repeat="item in inventoryList"
            ng-class="{'selected': item === previouslyClickedObject, 'inactive bg-warning text-warning': item.maxQuantity=='inactive'}">
              <td ng-click="selectRow(item)">{{item.id}}</td>
              <td ng-click="selectRow(item)">{{item.name}}</td>
              <td ng-click="selectRow(item)">{{item.productCode}}</td>
              <td ng-click="selectRow(item)">{{item.description}}</td>
              <td ng-click="selectRow(item)">{{item.minOrderQuantity}}</td>
              <td ng-click="selectRow(item)">{{item.maxQuantity}}</td>
              <td ng-click="selectRow(item)">{{item.PackageTypes_id}}</td>
              <td ng-click="selectRow(item)">{{item.InventoryTypes_id}}</td>
              <td ng-click="selectRow(item)">{{item.isActive}}</td>
              <td ng-click="selectRow(item)">{{item.InventoryCategories_id}}</td>
              <td ng-click="selectRow(item)">{{item.price | currency}}</td>
              <td ng-click="selectRow(item)">{{item.WarehouseLocations_id}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a href="/admin/inventory/items/{{item.id}}"><?php echo $this->getString('EDIT') ?></a></li>
                    <li><a href="" ng-click="delete(item)"><?php echo $this->getString('DELETE') ?></a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <table ng-if="listType === 'equipment'" class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="id" class="cog-col"><?php echo $this->getString('INVENTORY_ID'); ?></th>
                <th column-sortable data-column="name"><?php echo $this->getString('INVENTORY_NAME'); ?></th>
                <th column-sortable data-column="InventoryItems_id"><?php echo $this->getString('INVENTORY_ITEMSID'); ?></th>
                <th column-sortable data-column="number"><?php echo $this->getString('INVENTORY_NUMBER'); ?></th>
                <th column-sortable data-column="InventoryEquipmentTypes_id"><?php echo $this->getString('INVENTORY_EQUIPMENTTYPESID'); ?></th>
                <th column-sortable data-column="price"><?php echo $this->getString('INVENTORY_PRICE'); ?></th>
                <th column-sortable data-column="maxDays"><?php echo $this->getString('INVENTORY_MAXDAYS'); ?></th>
                <th group-by-button class="cog-col row-controls">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <tr ng-if="loading">
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">
              <span class="spinner-loader"></span>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr ng-if="!loading" ng-repeat="item in inventoryList" multi-select="item"
            ng-class="{'selected': item === previouslyClickedObject, 'inactive bg-warning text-warning': item.maxQuantity=='inactive'}">
              <td ng-click="selectRow(item)">{{item.id}}</td>
              <td ng-click="selectRow(item)">{{item.name}}</td>
              <td ng-click="selectRow(item)">{{item.InventoryItems_id}}</td>
              <td ng-click="selectRow(item)">{{item.number}}</td>
              <td ng-click="selectRow(item)">{{item.InventoryEquipmentTypes_id}}</td>
              <td ng-click="selectRow(item)">{{item.price | currency}}</td>
              <td ng-click="selectRow(item)">{{item.maxDays}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a href="" ng-click="delete(item)"><?php echo $this->getString('DELETE') ?></a></li>
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

    <form ng-if="!sidePanelLoading && searching && !multiSelect" ng-submit="search(advancedSearch.query)">
      <h1><?php echo $this->getString('INVENTORY_ADVANCED_SEARCH');?></h1>
      <item-advanced-search-filters>

      </item-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('INVENTORY_SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('INVENTORY_RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching && !multiSelect">
      <h1><a href="/admin/inventory/items/{{selectedRow.id}}">{{selectedRow.firstname}} {{selectedRow.lastname}}</a></h1>
      <h4><?php echo $this->getString('INVENTORY_TELEPHONE')?></h3>
      <p>{{selectedRow.telephone}}</p>
      <h4><?php echo $this->getString('INVENTORY_MOBILE')?></h3>
      <p>{{selectedRow.mobile}}</p>
      <h4><?php echo $this->getString('INVENTORY_EMAIL')?></h3>
      <p>{{selectedRow.email}}</p>
      <h4><?php echo $this->getString('INVENTORY_CITY')?></h3>
      <p>{{selectedRow.city}}</p>
      <h4><?php echo $this->getString('INVENTORY_POSTALCODE')?></h3>
      <p>{{selectedRow.postalCode}}</p>
      <h4><?php echo $this->getString('INVENTORY_TITLE')?></h3>
      <p>{{selectedRow.title}}</p>
      <h4><?php echo $this->getString('INVENTORY_EMPLOYEENUM')?></h3>
      <p>{{selectedRow.employeeNumber}}</p>
    </div>

    <div ng-if="!sidePanelLoading && !searching && multiSelect">
      <h1><?php echo $this->getString('SELECTED') ?></h1>
      <div class="card" ng-repeat="item in multiSelectArray">
        <div class="cardheader">
          <h1>{{item.name}} - {{item.number}}</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
