


<div class="widget" ng-controller="subcontractorsListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left">Subcontractor List</h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openSubcontractorAdvancedSearch()">
                <?php echo $this->getString('SUBCONTRACTORS_ADVANCED_SEARCH') ?>
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
                    <option ng-if="!autocomplete" value="" disabled><?php echo $this->getString('SUBCONTRACTORS_LOADING'); ?></option>
                    <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                </datalist>
            </div>
            <button ng-click="openAddNewSubcontractorModal()" class="btn-primary"><?php echo $this->getString('SUBCONTRACTORS_NEW'); ?></button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo $this->getString('SUBCONTRACTORS_NAME'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_EMAIL'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_TYPE'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_ADDRESS'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_CITY'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_POSTALCODE'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_TELEPHONE'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_FAX'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_URL'); ?></th>
                    <th><?php echo $this->getString('SUBCONTRACTORS_RATING'); ?></th>
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
                    <td>
                        <span class="spinner-loader"></span>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr ng-if="!loading" ng-repeat="subcontractor in subcontractorsList track by $index"
                    ng-class="{'selected': subcontractor === previouslyClickedObject, 'inactive bg-warning text-warning': subcontractor.status == 'inactive'}">
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.companyName}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.email}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.contractorType}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.address1}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.city}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.postalCode}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.telephone}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.fax}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.url}}</td>
                    <td ng-click="selectRow(subcontractor)">{{subcontractor.rating}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a href="" ng-click="openAddNewSubcontractorModal(subcontractor)">Quick Edit</a></li>
                                <li><a href="/admin/subcontractors/edit/{{subcontractor.Subcontractors_id}}">View</a></li>
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
        <div class="pull-right">
            <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
            <h1><?php echo $this->getString('SUBCONTRACTORS_ADVANCED_SEARCH'); ?></h1>
            <subcontractors-advanced-search-filters>

            </subcontractors-advanced-search-filters>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <h1><a href="/admin/subcontractors/edit/{{selectedSubcontractor.Subcontractors_id}}">{{selectedSubcontractor.companyName}} </a></h1>
            <h4><?php echo $this->getString('SUBCONTRACTORS_NAME') ?></h4>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-md-2"><?php echo $this->getString('SUBCONTRACTORS_JOBNUMBER') ?></th>
                        <th class="col-md-3"><?php echo $this->getString('SUBCONTRACTORS_UNIT_NUMBER') ?></th>
                        <th class="col-md-2"><?php echo $this->getString('SUBCONTRACTORS_START_DATE') ?></th>
                        <th class="col-md-2"><?php echo $this->getString('SUBCONTRACTORS_COMPLETION_DATE') ?></th>
                        <th class="col-md-1"></th>
                    </tr>
                </thead>
                <tr ng-repeat="claim in claimsList">
                    <td>{{ claim.jobNumber}} </td>
                    <td>{{ claim.unitNumber}} </td>
                    <td>{{ claim.startDate}} </td>
                    <td>{{ claim.actualCompletionDate}} </td>
                    <td><a href="/admin/claims/edit/{{ claim.jobNumber}}">view</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>