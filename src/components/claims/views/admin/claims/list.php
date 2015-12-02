

<div class="widget" ng-controller="claimsListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left">Claim List</h1>
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
            <a ng-click="openAddNewWizard()" class="btn btn-primary"><?php echo $this->getString('CLAIMS_NEW'); ?></a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_JOBNUMBER'); ?></th>
                    <th column-sortable data-column="title"><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                    <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_BUILDING_NAME'); ?></th>
                    <th column-sortable data-column="typeOfClaim"><?php echo $this->getString('CLAIMS_LOSS_TYPE'); ?></th>
                    <th column-sortable data-column="dateReceived"><?php echo $this->getString('CLAIMS_LOSS_DATE'); ?></th>
                    <th column-sortable data-column="status"><?php echo $this->getString('CLAIMS_STATUS'); ?></th>
                    <th column-sortable data-column="lastname"><?php echo $this->getString('CLAIMS_PROJECT_MANAGER'); ?></th>
                    <th column-sortable data-column="parentClaim"><?php echo $this->getString('CLAIMS_PARENT_CLAIM'); ?></th>
                    <th sort-by-button class="cog-col row-controls">&nbsp;</th>
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
                <tr ng-if="!loading" ng-repeat="claim in claimsList"
                    ng-class="{'selected': claim === previouslyClickedObject,
                        'inactive bg-warning text-warning': claim.status == 'inactive'}">
                    <td  ng-if="!claim.jobNumber" ng-click="selectRow(claim)">{{claim.unassignedJobNumber}}</td>
                    <td ng-if="claim.jobNumber" ng-click="selectRow(claim)">{{claim.jobNumber}}</td>
                    <td ng-click="selectRow(claim)">{{claim.phase}}</td>
                    <td ng-click="selectRow(claim)">{{claim.buildingName}}</td>
                    <td ng-click="selectRow(claim)">{{claim.losstype}}</td>
                    <td ng-click="selectRow(claim)">{{claim.lossDate}}</td>
                    <td ng-click="selectRow(claim)">{{claim.status}}</td>
                    <td ng-click="selectRow(claim)">
                        <span ng-if="claim.firstname">{{claim.lastname}}, {{claim.firstname}}</span>
                    </td>
                    <td ng-click="selectRow(claim)">{{claim.parentJobNumber}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="/admin/claims/edit/{{claim.unassignedJobNumber}}" ng-if="!claim.jobNumber">
                                        <?php echo $this->getString('CLAIMS_EDIT'); ?>
                                    </a>
                                    <a href="/admin/claims/edit/{{claim.jobNumber}}" ng-if="claim.jobNumber">
                                        <?php echo $this->getString('CLAIMS_EDIT'); ?>
                                    </a>
                                </li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/costcards/{{claim.id}}"><?php echo $this->getString('CLAIMS_VIEW_COST_CARDS'); ?></a></li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/breakdowns/{{claim.id}}"><?php echo $this->getString('CLAIMS_BREAKDOWNS'); ?></a></li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/invoices/{{claim.id}}"><?php echo $this->getString('CLAIMS_INVOICES'); ?></a></li>
                                <li ng-if="!claim.jobNumber"><a href="/admin/claims/edit/{{claim.unassignedJobNumber}}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                <li ng-if="!claim.jobNumber"><a href="" ng-click="assignPM(claim)"><?php echo $this->getString('CLAIMS_ASSIGN_PM'); ?></a></li>
                                <li><a href="" ng-click="remove(claim)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                <li><a href="/admin/claims/costcards/{{claim.id}}"><?php echo $this->getString('CLAIMS_VIEW_COST_CARD'); ?></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <uib-pagination class="pull-left pagination" total-items="totalItems" ng-model="currentPage"
                        items-per-page="itemsPerPage" boundary-links="true" rotate="false">
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
            <h1 ng-if="selectedClaim.jobNumber"><a href="/admin/claims/edit/{{selectedClaim.jobNumber}}">{{selectedClaim.jobNumber}}</a></h1>
            <h1 ng-if="!selectedClaim.jobNumber"><a href="/admin/claims/edit/{{selectedClaim.unassignedJobNumber}}">{{selectedClaim.unassignedJobNumber}}</a></h1>
            <h4><?php echo $this->getString('CLAIMS_ADDRESS') ?></h4>
            <div>{{selectedClaim.address1}}</div>
            <div>{{selectedClaim.address2}}</div>
            <div>{{selectedClaim.city}}</div>
            <h4><?php echo $this->getString('CLAIMS_CONTACTS') ?></h4>
            <div class="card info-card" ng-repeat="contact in selectedClaim.contacts">
                <p><strong class="ng-binding">{{contact.type}}:</strong> <a href="{{contact.email}}" class="ng-binding">{{contact.firstname}} {{contact.lastname}}</a>
                    <span style="float: right" class="ng-binding"><strong><?php echo $this->getString('CLAIMS_COMPANY') ?>:</strong> {{contact.company}} </span></p>
                <p class="ng-binding">
                    <?php echo $this->getString('CLAIMS_OFFICE') ?>: {{contact.office}} {{contact.ext}}
                    <span style="float: right" class="ng-binding"> Mobile: {{contact.mobile}}</span>
                </p>

                <div class="cardfooter clearfix">
                    <div class="pull-right"><a href="/admin/contacts/{{contact.id}}"><?php echo $this->getString('MORE_INFO') ?></a></div>
                </div>
            </div>

            <div>
                <h4 class="pull-left"><?php echo $this->getString('CLAIMS_LOCATIONS') ?></h4>
                <div class="pull-right">
                    <button class="primary btn-sm" ng-click="openClaimLocationModal()">
                        <?php echo $this->getString('CLAIMS_LOCATIONS_ADDNEW') ?>
                    </button>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-2"><?php echo $this->getString('CLAIMS_UNIT_NUMBER') ?></th>
                    <th class="col-md-3"><?php echo $this->getString('CLAIMS_NAME') ?></th>
                    <th class="col-md-3"><?php echo $this->getString('CLAIMS_PHONE') ?></th>
                    <th class="col-md-3"><?php echo $this->getString('CLAIMS_MOBILE') ?></th>
                    <th class="col-md-1"></th>
                </tr>
                <tr ng-repeat="location in selectedClaim.locations">
                    <td>{{location.unitNumber}}</td>
                    <td>{{location.firstname}} {{location.lastname}}</td>
                    <td> {{location.daytimePhone}} </td>
                    <td>{{location.mobile}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog"
                                    type="button" id="dropdownMenu1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a href="" ng-click="openClaimLocationModal(location)">Edit</a></li>
                                <li><a href="" ng-click="delete(location)"><?php echo $this->getString('DELETE') ?></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
