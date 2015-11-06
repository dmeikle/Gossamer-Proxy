<div class="widget" ng-controller="vendorsListCtrl">
    <div class="widget-content" ng-class="{'panel-open':sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('VENDORS_LIST') ?></h1>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
                <?php echo $this->getString('ADVANCED_SEARCH') ?>
            </button>
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
                       ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
                <div class="resultspane" ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('VENDORS_NORESULTS') ?>
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
            <a href="" ng-click="edit()" class="btn btn-primary"><?php echo $this->getString('VENDORS_NEW'); ?></a>
        </div>
        <table  class="table table-striped table-hover">
            <thead>
                <tr>
                    <th column-sortable data-column="company"><?php echo $this->getString('VENDORS_COMPANY'); ?></th>
                    <th column-sortable data-column="telephone"><?php echo $this->getString('VENDORS_TELEPHONE'); ?></th>
                    <th column-sortable data-column="accountId"><?php echo $this->getString('VENDORS_ACCOUNT_ID'); ?></th>
                    <th column-sortable data-column="salesRep"><?php echo $this->getString('VENDORS_SALES_REP'); ?></th>
                    <th column-sortable data-column="deliveryFee"><?php echo $this->getString('VENDORS_DELIVERY_FEE'); ?></th>
                    <th group-by-button class="cog-col row-controls">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td></td>
                    <td></td>
                    <td colspan="2">
                        <span class="spinner-loader"></span>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr ng-if="!loading" ng-repeat="item in vendorsList"
                    ng-class="{'selected':item === previouslyClickedObject,
                        'inactive bg-warning text-warning': item.maxQuantity == 'inactive'}">
                    <td ng-click="selectRow(item)"><a href="{{item.url}}">{{item.company}}</a></td>
                    <td ng-click="selectRow(item)">{{item.telephone}}</td>
                    <td ng-click="selectRow(item)">{{item.accountId}}</td>
                    <td ng-click="selectRow(item)">{{item.salesRep}}</td>
                    <td ng-click="selectRow(item)">{{item.deliveryFee | currency}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a href="" ng-click="edit(item)"><?php echo $this->getString('EDIT') ?></a></li>
                                <li>
                                    <a href="" ng-click="viewPurchaseOrders(item)">
                                        <?php echo $this->getString('PURCHASE_ORDERS') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/vendors/items/{{ item.id}}">
                                        <?php echo $this->getString('VENDORS_SET_PRICES') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="" ng-click="delete(item)">
                                        <?php echo $this->getString('DELETE') ?>
                                    </a>
                                </li>
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
                <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 10}"
                    ng-click="setItemsPerPage(10)">10</button>
                <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 20}"
                    ng-click="setItemsPerPage(20)">20</button>
                <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 50}"
                    ng-click="setItemsPerPage(50)">50</button>
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

        <form ng-if="!sidePanelLoading && searching && !multiSelect" ng-submit="search(advancedSearch.vendor)">
            <h1><?php echo $this->getString('ADVANCED_SEARCH'); ?></h1>
            <advanced-search-filters data-service="vendorsListSrv">

            </advanced-search-filters>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary"
                        value="<?php echo $this->getString('VENDORS_SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()">
                        <?php echo $this->getString('VENDORS_RESET') ?>
                    </button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching && !multiSelect">
            <div class="breakdown-title">
                <div class="pull-left">
                    <h3>{{selectedRow.company}}</h3>
                    <p>
                        <span class="glyphicon glyphicon-envelope"></span>
                        <a href="mailto:{{selectedRow.email}}">{{selectedRow.email}}</a>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-earphone"></span>
                        <a href="tel:{{selectedRow.tollFree}}">{{selectedRow.tollFree}}</a>
                    </p>
                    <!-- <p>{{selectedRow.address1}}</p>
                    <p>{{selectedRow.city}}</p>
                    <p>{{selectedRow.Provinces_id}}</p>
                    <p>{{selectedRow.postalCode}}</p> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="card" ng-repeat="item in vendorLocations">
                <div class="cardheader">
                    <h1>{{selectedRow.company}} - {{item.city}}</h1>
                    <h2><?php echo $this->getString('VENDORS_ACCOUNT_ID') ?> {{item.accountId}}</h2>
                </div>
                <div>

                </div>
                <table class="table cardtable">
                    <tr>
                        <td>
                            <strong>
                                <?php echo $this->getString('VENDORS_ADDRESS1') ?>
                            </strong>
                        </td>
                        <td>
                            <div>
                                {{item.address1}}
                            </div>
                            <div>
                                {{item.address2}}
                            </div>
                            <div>
                                {{item.city}}
                            </div>
                            <div>
                                {{item.Provinces_id}}
                            </div>
                            <div>
                                {{item.postalCode}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo $this->getString('VENDORS_TELEPHONE') ?></strong></td>
                        <td>{{item.telephone}}</td>
                    </tr><tr>
                        <td><strong><?php echo $this->getString('VENDORS_TOLLFREE') ?></strong></td>
                        <td>{{item.tollFree}}</td>
                    </tr>
                </table>
                <div class="clearfix"></div>
                <div class="cardfooter clearfix">
                    <div class="pull-right">
                        <button class="btn-link" ng-click="openVendorLocationModal()">
                            <?php echo $this->getString('MORE_INFO') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
