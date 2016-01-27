

<div class="widget" ng-controller="claimsListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('CLAIMS_LIST') ?></h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
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
        <div class="clearfix"></div>
        <ul class="table table-striped table-hover flex-table"  ng-class="{'loading':loading}">
            <li class="head">
                <div column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_JOBNUMBER'); ?></div>
                <div column-sortable data-column="title"><?php echo $this->getString('CLAIMS_PHASE'); ?></div>
                <div column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_BUILDING_NAME'); ?></div>
                <div column-sortable data-column="typeOfClaim"><?php echo $this->getString('CLAIMS_LOSS_TYPE'); ?></div>
                <div column-sortable data-column="dateReceived"><?php echo $this->getString('CLAIMS_LOSS_DATE'); ?></div>
                <div column-sortable data-column="status"><?php echo $this->getString('CLAIMS_STATUS'); ?></div>
                <div column-sortable data-column="lastname"><?php echo $this->getString('CLAIMS_PROJECT_MANAGER'); ?></div>
                <div column-sortable data-column="parentClaim"><?php echo $this->getString('CLAIMS_PARENT_CLAIM'); ?></div>
                <div group-by-button class="cog-col row-controls">&nbsp;</div>
            </li>
            <div class="flex-tbody">
                <li ng-if="loading" class="flex-loading">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div class="padding-vertical"><span class="spinner-loader"></span></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </li>
                <li ng-if="!loading" class="flex-row" ng-repeat="claim in claimsList"
                    ng-class="{'selected': claim === previouslyClickedObject,
                        'inactive bg-warning text-warning': claim.status == 'pending assignment'}">
                    <div class="flex-left">
                        <div>
                            <div class="content" ng-if="!claim.jobNumber"><h4><?php echo $this->getString('CLAIMS_JOBNUMBER') ?> {{claim.unassignedJobNumber}}</h4></div>
                            <div class="content" ng-if="claim.jobNumber"><h4><?php echo $this->getString('CLAIMS_JOBNUMBER') ?> {{claim.jobNumber}}</h4></div>
                            <div class="content" ng-if="claim.title"><?php echo $this->getString('CLAIMS_PHASE') ?>: {{claim.title}}</div>
                            <div class="content" ng-if="!claim.title"><?php echo $this->getString('CLAIMS_NO_PHASE_SET') ?></div>
                            <div class="content" ng-if="claim.buildingName"><?php echo $this->getString('CLAIMS_BUILDING_NAME') ?>: {{claim.buildingName}}</div>
                        </div>
                    </div>
                    <div class="flex-right">
                        <div class="row-controls pull-right">
                            <div class="dropdown flex-dropdown">
                                <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                </button>
                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                    <li ng-if="!claim.jobNumber"><a href="" ng-click="assignPM(claim)"><?php echo $this->getString('CLAIMS_ASSIGN_PM'); ?></a></li>
                                    <li ng-if="!claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.unassignedJobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                    <li ng-if="claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.jobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                    <li><a href="" ng-click="openPhotoUploadModal(claim)"><?php echo $this->getString('CLAIM_UPLOAD_PHOTOS') ?></a></li>
                                    <li><a href="" ng-click="remove(claim)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                    <li ng-if="claim.jobNumber" class="divider"></li>
                                    <li ng-if="claim.jobNumber"><a href="/admin/claims/costcards/{{claim.id}}"><?php echo $this->getString('CLAIMS_VIEW_COST_CARDS'); ?></a></li>
                                    <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/breakdowns/{{claim.id}}"><?php echo $this->getString('CLAIMS_BREAKDOWNS'); ?></a></li>
                                    <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/invoices/{{claim.id}}"><?php echo $this->getString('CLAIMS_INVOICES'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="content" ng-if="claim.typeOfClaim">{{claim.typeOfClaim}}</div>
                            <div class="content" ng-if="claim.callInDate">{{claim.callInDate}}</div>
                            <div class="content" ng-if="claim.status">{{claim.status}}</div>
                            <div class="content" ng-if="claim.parentJobNumber">{{claim.parentJobNumber}}</div>
                        </div>
                    </div>
                    <!--<div>{{location.unitNumber}}</div>-->
                    <div ng-if="!claim.jobNumber" ng-click="selectRow(claim)">{{claim.unassignedJobNumber}}</div>
                    <div ng-if="claim.jobNumber" ng-click="selectRow(claim)">{{claim.jobNumber}}</div>
                    <div ng-click="selectRow(claim)">{{claim.title}}</div>
                    <div ng-click="selectRow(claim)">{{claim.buildingName}}</div>
                    <div ng-click="selectRow(claim)">{{claim.typeOfClaim}}</div>
                    <div ng-click="selectRow(claim)">{{claim.callInDate}}</div>
                    <div ng-click="selectRow(claim)">{{claim.status}}</div>
                    <div ng-click="selectRow(claim)" ng-show="claim.lastname">{{claim.lastname}}, {{claim.firstname}}</div>
                    <div ng-click="selectRow(claim)" ng-show="!claim.lastname"> </div>
                    <div ng-click="selectRow(claim)">{{claim.parentJobNumber}}</div>
                    <div class="row-controls">
                        <div class="dropdown flex-dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li ng-if="!claim.jobNumber"><a href="" ng-click="assignPM(claim)"><?php echo $this->getString('CLAIMS_ASSIGN_PM'); ?></a></li>
                                <li ng-if="!claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.unassignedJobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                <li ng-if="!claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='TESTING'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>

                                <li ng-if="claim.jobNumber"><a gcms="{uri='admin_claims_edit' params='{{claim.jobNumber}}'}"><?php echo $this->getString('CLAIMS_EDIT'); ?></a></li>
                                <li><a href="" ng-click="openPhotoUploadModal(claim)"><?php echo $this->getString('CLAIM_UPLOAD_PHOTOS') ?></a></li>
                                <li><a href="" ng-click="remove(claim)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                <li ng-if="claim.jobNumber" class="divider"></li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/costcards/{{claim.id}}"><?php echo $this->getString('CLAIMS_VIEW_COST_CARDS'); ?></a></li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/breakdowns/{{claim.id}}"><?php echo $this->getString('CLAIMS_BREAKDOWNS'); ?></a></li>
                                <li ng-if="claim.jobNumber"><a href="/admin/claims/accounting/invoices/{{claim.id}}"><?php echo $this->getString('CLAIMS_INVOICES'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </div>
            <!--<div sort-by-button class="cog-col row-controls">&nbsp;</div>-->
        </ul>

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

            <div class="form-group">
                <label for="advancedSearch-status"><?php echo $this->getString('CLAIMS_STATUS'); ?></label>
                <select name="status" id="advancedSearch-status" ng-model="advancedSearch.query.status" class="form-control">
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
                <select name="ContactVIPTypes_id" id="advancedSearch-ContactVIPTypes_id" ng-model="advancedSearch.query.ContactVIPTypes_id" class="form-control">
                    <option value="" selected>- VIP Type -</option>
                </select>
            </div>

            <div class="form-group">
                <label for="advancedSearch-customerName"><?php echo $this->getString('CLAIMS_CUSTOMER_NAME'); ?></label>
                <input type="text" class="form-control" id="advancedSearch-customerName" name="customerName" ng-model="advancedSearch.query.customerName">
            </div>
            <div class="form-group">
                <label for="advancedSearch-customerTelephone"><?php echo $this->getString('CLAIMS_CUSTOMER_TELEPHONE'); ?></label>
                <input type="tel" class="form-control" id="advancedSearch-customerTelephone" name="customerTelephone" ng-model="advancedSearch.query.customerTelephone">
            </div>
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
            <div ng-if="!loading && !hasContacts()" ng-repeat="contact in selectedClaim.contacts" class="card info-card ng-scope">
                <p><strong class="ng-binding">{{contact.type}}:</strong> <a class="ng-binding" href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
                    <span class="ng-binding" style="float: right"><strong><?php echo $this->getString('CLAIMS_COMPANY'); ?>:</strong> {{contact.company}} </span></p>
                <p class="ng-binding">
                    <?php echo $this->getString('CLAIMS_OFFICE'); ?>: {{contact.office}}
                    <span class="ng-binding" style="float: right"> <?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{contact.mobile}}</span>
                </p>

                <div class="cardfooter clearfix">
                    <div class="pull-right"><a href="/admin/contacts/{{contact.id}}"><?php echo $this->getString('CLAIMS_MORE_INFORMATION'); ?></a></div>
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
                                <li><a href="" ng-click="openClaimLocationModal(location)"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?></a></li>
                                <li><a href="" ng-click="delete(location)"><?php echo $this->getString('CLAIMS_REMOVE') ?></a></li>
                                <li><a href="" ng-click="openCustomersModal('customersModal', location, {})"><?php echo $this->getString('CLAIMS_ADD_CUSTOMER') ?></a></li>
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

<!--Customers Modal-->
<script type="text/ng-template" id="customersModal">
    <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/claimsLocationCustomersModal.php'); ?>
</script>
