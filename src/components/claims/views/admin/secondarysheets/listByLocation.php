
<?php $params = $this->httpRequest->getParameters(); ?>

<input type="hidden" id="Claims_id" value="<?php echo intval($params[0]); ?>" />
<input type="hidden" id="ClaimsLocations_id" value="<?php echo intval($params[1]); ?>" />



<div class="widget" ng-controller="secondarySheetsListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('CLAIMS_SECONDARY_SHEETS') ?></h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openClaimAdvancedSearch()">
                <?php echo $this->getString('CLAIMS_ADVANCED_SEARCH') ?>
            </button>
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
                       ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
                <div class="resultspane" ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIMS_NORESULTS') ?>
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
            <a ng-click="openAddNewWizard()" class="btn btn-primary"><?php echo $this->getString('CLAIMS_NEW_SECONDARY_SHEET'); ?></a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_WORK_DATE'); ?></th>
                    <th column-sortable data-column="title"><?php echo $this->getString('CLAIMS_UNIT_NUMBER'); ?></th>
                    <th column-sortable data-column="title"><?php echo $this->getString('CLAIMS_AREA'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_NUMBER_OF_ITEMS'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_NUMBER_OF_ITEMS_COMPLETED'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_STAFF'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_CLOSED_BY_STAFF'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_CREATION_DATE'); ?></th>
                    <th sort-by-button class="cog-col row-controls">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
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
                </tr>
                <tr ng-if="!loading" ng-repeat="item in sheetsList"
                    ng-class="{'selected': item === previouslyClickedObject, 'inactive bg-warning text-warning': item.status == 'inactive'}">
                    <td ng-click="selectRow(item)">{{item.workDate}}</td>
                    <td ng-click="selectRow(item)">{{item.unitNumber}}</td>
                    <td ng-click="selectRow(item)">{{item.name}}</td>
                    <td ng-click="selectRow(item)">{{item.numItems}}</td>
                    <td ng-click="selectRow(item)">{{item.numItemsCompleted}}</td>
                    <td ng-click="selectRow(item)">{{item.firstname}} {{item.lastname}}</td>
                    <td ng-click="selectRow(item)">{{item.closedFirstname}} {{item.closedLastname}}</td>
                    <td ng-click="selectRow(item)">{{item.lastModified}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a gcms="{uri='admin_claims_secondarysheets_get' params='{{item.Claims_id}}/{{item.ClaimsLocations_id}}/{{item.id}}'}"><?php echo $this->getString('CLAIMS_EDIT_SECONDARY_SHEET'); ?></a></li>
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
            <h1><?php echo $this->getString('CLAIMS_ADVANCED_SEARCH'); ?></h1>
            <claim-advanced-search-filters>

            </claim-advanced-search-filters>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('CLAIMS_SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('CLAIMS_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <h1><a gcms="{uri='admin_claims_secondarysheets_edit' params='{{selectedSheet.Claims_id}}/{{selectedSheet.ClaimsLocations_id}}/{{selectedSheet.AffectedAreas_id}}/{{selectedSheet.id}}'}">{{selectedSheet.workDate}}</a></h1>


            <div class="card">
                <div ng-repeat="action in selectedSheet.actionsList">
                    <h3 ng-if="isNewHeading(action)" >{{action.category}}</h3>
                    <div ng-class="getClass(action)" style="padding: 2px 5px; margin-top: 1px">
                        {{action.action}}
                    </div>
                </div>
                <div ng-if="!hasActions">
                    <?php echo $this->getString("CLAIMS_SECONDARY_SHEETS_NO_ACTIONS"); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
