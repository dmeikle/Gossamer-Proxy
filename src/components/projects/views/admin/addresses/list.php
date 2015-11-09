<div class="widget" ng-controller="projectAddressesListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('PROJECTS_LIST') ?></h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
                <?php echo $this->getString('PROJECTS_ADVANCED_SEARCH') ?>
            </button>
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input type="text" ng-model="basicSearch.query.name" ng-model-options="{debounce:500}"
                       typeahead="value for value in fetchAutocomplete($viewValue)"
                       typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control"
                       typeahead-on-select="search(basicSearch.query)" typeahead-min-length='3'>
                <div class="resultspane" ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('PROJECTS_NORESULTS') ?>
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
            <a  ng-click="openNewBuildingModal('')" class="btn btn-primary"><?php echo $this->getString('PROJECTS_NEW'); ?></a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('PROJECTS_BUILDINGNAME'); ?></th>
                    <th column-sortable data-column="address1"><?php echo $this->getString('PROJECTS_ADDRESS'); ?></th>
                    <th column-sortable data-column="city"><?php echo $this->getString('PROJECTS_CITY'); ?></th>
                    <th column-sortable data-column="postalCode"><?php echo $this->getString('PROJECTS_POSTALCODE'); ?></th>
                    <th column-sortable data-column="Provinces_id"><?php echo $this->getString('PROJECTS_PROVINCE'); ?></th>
                    <th column-sortable data-column="strataNumber"><?php echo $this->getString('PROJECTS_STRATANUMBER'); ?></th>
                    <th column-sortable data-column="activeClaimsCount"><?php echo $this->getString('PROJECTS_CLAIMSCOUNT'); ?></th>
                    <th column-sortable><?php echo $this->getString('PROJECTS_HISTORYCOUNT'); ?></th>
                    <th sort-by-button class="cog-col row-controls" data-column="claimsHistoryCount">&nbsp;</th>
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
                    <td></td>
                </tr>
                <tr ng-if="!loading" ng-repeat="project in projectAddressesList" ng-click="selectRow(project)" ng-class="{'selected': project.clicked}">
                    <td>{{project.buildingName}}</td>
                    <td>{{project.address1}}</td>
                    <td>{{project.city}}</td>
                    <td>{{project.postalCode}}</td>
                    <td>{{project.Provinces_id}}</td>
                    <td>{{project.strataNumber}}</td>
                    <td>{{project.activeClaimsCount}}</td>
                    <td>{{project.claimsHistoryCount}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a href="/admin/projects/edit/{{ project.id}}">Edit</a></li>
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
            <h1><?php echo $this->getString('PROJECTS_ADVANCED_SEARCH'); ?></h1>
            <project-address-advanced-search-filters>

            </project-address-advanced-search-filters>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('PROJECTS__SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('PROJECTS__RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <h1><a href="/admin/projects/edit/{{selectedProjectAddress.id}}">{{selectedProjectAddress.buildingName}}</a></h1>
            <h3><?php echo $this->getString('PROJECTADDRESS_STRATANUMBER') ?></h3>
            <p>{{selectedProjectAddress.strataNumber}}</p>
            <h3><?php echo $this->getString('PROJECTADDRESS_ADDRESS') ?></h3>
            <p>{{selectedProjectAddress.address1}}<br />
                {{selectedProjectAddress.city}}, {{selectedProjectAddress.Provinces_id}} {{selectedProjectAddress.postalCode}} <br />
                {{selectedProjectAddress.neighborhood}}
            </p>
            <h3><?php echo $this->getString('PROJECTADDRESS_NUMFLOORS') ?></h3>
            <p>{{selectedProjectAddress.city}}</p>
            <h3><?php echo $this->getString('PROJECTADDRESS_PROPERTY') ?></h3>
            <p>{{selectedProjectAddress.numFloors}}</p>
            <h3><?php echo $this->getString('PROJECTADDRESS_NUMSTRATA') ?></h3>
            <p>{{selectedProjectAddress.numStrata}}</p>
            <h3><?php echo $this->getString('PROJECTADDRESS_NUMUNITS') ?></h3>
            <p>{{selectedProjectAddress.numUnits}}</p>
            <h3><?php echo $this->getString('PROJECTADDRESS_PROPERTYTYPE') ?></h3>
            <p>{{selectedProjectAddress.propertyType}}</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
