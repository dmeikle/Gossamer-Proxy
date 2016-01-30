

<div class="widget" ng-controller="scopingListCtrl
            as
            ctrl">
    <div class="widget-content" ng-class="{'panel-open': ctrl.sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('SCOPING_CLAIMS_LIST') ?></h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="ctrl.openAdvancedSearch()">
                <?php echo $this->getString('CLAIMS_ADVANCED_SEARCH') ?>
            </button>
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="ctrl.search(basicSearch.query)" class="input-group">
                <input class="form-control" type="text" list="autocomplete-list" ng-model="ctrl.basicSearch.query.name"
                       ng-model-options="{debounce:500}" ng-change="ctrl.search(basicSearch.query)">
                <div class="resultspane" ng-show="ctrl.noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIMS_NORESULTS') ?>
                </div>
                <span class="input-group-btn" ng-if="!ctrl.searchSubmitted">
                    <button type="submit" class="btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                <span ng-if="ctrl.searchSubmitted" class="input-group-btn">
                    <button type="reset" class="btn-default" ng-click="ctrl.resetSearch()">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </span>
            </form>
        </div>
        <div class="clearfix"></div>
        <ul class="table table-striped table-hover flex-table"  ng-class="{'loading':ctrl.loading}">
            <li class="head">
                <div column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_JOBNUMBER'); ?></div>
                <div column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_BUILDING_NAME'); ?></div>
                <div column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_ADDRESS'); ?></div>
                <div column-sortable data-column="typeOfClaim"><?php echo $this->getString('CLAIMS_LOSS_TYPE'); ?></div>
                <div column-sortable data-column="dateReceived"><?php echo $this->getString('SCOPING_PHASE_CHANGE_DATE'); ?></div>
                <div column-sortable data-column="dateReceived"><?php echo $this->getString('SCOPING_SCHEDULE_DATE'); ?></div>
                <div column-sortable data-column="status"><?php echo $this->getString('SCOPING_SOURCE'); ?></div>
                <div column-sortable data-column="lastname"><?php echo $this->getString('SCOPING_NUM_UNITS'); ?></div>
                <div column-sortable data-column="parentClaim"><?php echo $this->getString('SCOPING_SCOPE_WRITER'); ?></div>
                <div column-sortable data-column="parentClaim"><?php echo $this->getString('SCOPING_STATUS'); ?></div>
                <div group-by-button class="cog-col row-controls">&nbsp;</div>
            </li>
            <div class="flex-tbody">
                <li ng-if="loading" class="flex-loading">
                    <div class="padding-vertical"><span class="spinner-loader"></span></div>
                </li>
                <li ng-if="!loading" class="flex-row" ng-repeat="claim in ctrl.claimsList"
                    ng-class="{'selected': claim === previouslyClickedObject,
                        'inactive bg-warning text-warning': claim.status == 'pending assignment'}">
                    <div class="flex-left">
                        <div>
                            <div class="content" ng-if="claim.jobNumber"><h4><?php echo $this->getString('CLAIMS_JOBNUMBER') ?> {{claim.jobNumber}}</h4></div>
                            <div class="content" ng-if="!claim.jobNumber"><h4><?php echo $this->getString('CLAIMS_JOBNUMBER') ?> {{claim.unassignedJobNumber}}</h4></div>
                            <div class="content" ng-if="claim.buildingName">{{claim.buildingName}}<br />{{claim.address1}}<br />{{claim.city}}, {{claim.postalCode}}</div>
                            <div class="content" ng-if="claim.numUnits"><?php echo $this->getString('SCOPING_NUM_UNITS') ?>:  {{claim.numUnits}}</div>

                        </div>
                    </div>
                    <div class="flex-right">
                        <div class="row-controls pull-right">
                            <div class="dropdown flex-dropdown">
                                <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                </button>
                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                    <li ng-if="!claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.unassignedJobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                    <li ng-if="claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.jobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                    <li><a href="" ng-click="ctrl.openPhotoUploadModal(claim)"><?php echo $this->getString('CLAIM_UPLOAD_PHOTOS') ?></a></li>
                                    <li><a href="" ng-click="ctrl.remove(claim)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                    <li ng-if="claim.jobNumber" class="divider"></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="content" ng-if="claim.phaseChangeDate">{{claim.phaseChangeDate}}</div>
                            <div class="content" ng-if="claim.typeOfClaim">{{claim.typeOfClaim}}</div>
                            <div class="content" ng-if="claim.status">{{claim.status}}</div>
                            <div class="content" ng-if="claim.parentJobNumber">{{claim.parentJobNumber}}</div>
                        </div>
                    </div>
                    <!--<div>{{location.unitNumber}}</div>-->
                    <div ng-if="!claim.jobNumber" ng-click="ctrl.selectRow(claim)">{{claim.unassignedJobNumber}}</div>
                    <div ng-if="claim.jobNumber" ng-click="ctrl.selectRow(claim)">{{claim.jobNumber}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.buildingName}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.address1}}<br />{{claim.city}}, {{claim.postalCode}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.typeOfClaim}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.phaseChangeDate}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.status}}</div>
                    <div ng-click="ctrl.selectRow(claim)" ng-show="claim.lastname">{{claim.lastname}}, {{claim.firstname}}</div>
                    <div ng-click="ctrl.selectRow(claim)" ng-show="!claim.lastname"> </div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.numUnits}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.scopeFirstname}} {{claim.scopeLastname}}</div>
                    <div ng-click="ctrl.selectRow(claim)">{{claim.scopeStatus}}</div>
                    <div class="row-controls">
                        <div class="dropdown flex-dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li ng-if="!claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.unassignedJobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                <li ng-if="claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.jobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                <li><a href="" ng-click="ctrl.selectScopeWriter(claim)"><?php echo $this->getString('CLAIMS_ASSIGN_SCOPE_WRITER'); ?></a></li>
                                <li><a href="" ng-click="ctrl.openPhotoUploadModal(claim)"><?php echo $this->getString('CLAIM_UPLOAD_PHOTOS') ?></a></li>
                                <li><a href="" ng-click="ctrl.remove(claim)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </div>
            <!--<div sort-by-button class="cog-col row-controls">&nbsp;</div>-->
        </ul>

        <uib-pagination class="pull-left pagination" total-items="totalItems" ng-model="ctrl.currentPage"
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
            <button class="btn-link" ng-click="ctrl.closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="ctrl.sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!ctrl.sidePanelLoading && ctrl.searching" ng-submit="ctrl.search(advancedSearch.query)">
            <h1><?php echo $this->getString('CLAIMS_ADVANCED_SEARCH'); ?></h1>

            <div class="form-group">
                <label for="advancedSearch-status"><?php echo $this->getString('CLAIMS_STATUS'); ?></label>
                <select name="status" id="advancedSearch-status" ng-model="ctrl.advancedSearch.query.status" class="form-control">
                    <option value="" selected>- Status -</option>
                    <option value="unassigned" selected>Unassigned</option>
                    <option value="24hours" selected>Last 24 Hours</option>
                    <option value="72hours" selected>Last 72 Hours</option>
                    <option value="125hours" selected>Last 5 Days</option>
                    <option value="pending" selected>Pending</option>
                    <option value="onhold" selected>On Hold</option>
                    <option value="complete" selected>Complete</option>
                    <option value="cancelled" selected>Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="advancedSearch-ContactVIPTypes_id"><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?></label>
                <select name="ContactVIPTypes_id" id="advancedSearch-ContactVIPTypes_id" ng-model="ctrl.advancedSearch.query.ContactVIPTypes_id" class="form-control">
                    <option value="" selected>- VIP Type -</option>
                </select>
            </div>

            <div class="form-group">
                <label for="advancedSearch-customerName"><?php echo $this->getString('CLAIMS_CUSTOMER_NAME'); ?></label>
                <input type="text" class="form-control" id="advancedSearch-customerName" name="customerName" ng-model="ctrl.advancedSearch.query.customerName">
            </div>
            <div class="form-group">
                <label for="advancedSearch-customerTelephone"><?php echo $this->getString('CLAIMS_CUSTOMER_TELEPHONE'); ?></label>
                <input type="tel" class="form-control" id="advancedSearch-customerTelephone" name="customerTelephone" ng-model="ctrl.advancedSearch.query.customerTelephone">
            </div>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('CLAIMS_SUBMIT') ?>">
                    <button class="btn-default" ng-click="ctrl.resetAdvancedSearch()"><?php echo $this->getString('CLAIMS_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!ctrl.sidePanelLoading && !ctrl.searching">
            <h1 ng-if="ctrl.selectedClaim.jobNumber"><a href="/admin/claims/edit/{{ctrl.selectedClaim.jobNumber}}">{{ctrl.selectedClaim.jobNumber}}</a></h1>
            <h1 ng-if="!ctrl.selectedClaim.jobNumber"><a href="/admin/claims/edit/{{ctrl.selectedClaim.unassignedJobNumber}}">{{ctrl.selectedClaim.unassignedJobNumber}}</a></h1>
            <h4><?php echo $this->getString('CLAIMS_ADDRESS') ?></h4>
            <div>{{ctrl.selectedClaim.address1}}</div>
            <div>{{ctrl.selectedClaim.address2}}</div>
            <div>{{ctrl.selectedClaim.city}}</div>

            <div>
                <h4 class="pull-left"><?php echo $this->getString('CLAIMS_LOCATIONS') ?></h4>
                <div class="pull-right">
                    <button class="primary btn-sm" ng-click="ctrl.openClaimLocationModal()">
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
                <tr ng-repeat="location in ctrl.selectedClaim.locations">
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
                                <li><a href="" ng-click="ctrl.openClaimLocationModal(location)"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?></a></li>
                                <li><a href="" ng-click="ctrl.delete(location)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                <li><a href="" ng-click="ctrl.openCustomersModal('customersModal', location, {})"><?php echo $this->getString('CLAIMS_ADD_CUSTOMER') ?></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>

    <script type="text/ng-template" id="scopeWriterModal">
        <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/selectScopeWriter.php'); ?>
    </script>
</div>

