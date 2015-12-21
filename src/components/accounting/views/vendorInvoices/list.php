<div class="widget" ng-controller="vendorInvoicesCtrl">
    <div class="widget-content" ng-class="{
            'panel-open'
            :sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('ACCOUNTING_PAYABLES_INVOICES') ?></h1>
        <div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php echo $this->getString('ACCOUNTING_DB_ERROR') ?></div>
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
                <?php echo $this->getString('ACCOUNTING_ADVANCED_SEARCH') ?>
            </button>
            <form ng-submit="search(basicSearch.query, 'name')" class="input-group">
                <input placeholder="Search" type="text" ng-model="basicSearch.query" ng-model-options="{debounce:500}" class="form-control" ng-change="autoSearch(basicSearch.query)">
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
            <a href="invoices/0"><button class="primary new-item"><?php echo $this->getString('ACCOUNTING_NEW_INVOICE') ?></button></a>
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'invoiceNumber'" column-sortable data-column="invoiceNumber"><?php echo $this->getString('ACCOUNTING_INVOICE_NUMBER'); ?></th>
                    <th ng-hide="groupedBy === 'phase'" column-sortable data-column="phase"><?php echo $this->getString('ACCOUNTING_PHASE'); ?></th>
                    <th ng-hide="groupedBy === 'department'" column-sortable data-column="department"><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></th>
                    <th ng-hide="groupedBy === 'subcontractor'" column-sortable data-column="subcontractor"><?php echo $this->getString('ACCOUNTING_SUBCONTRACTOR'); ?></th>
                    <th ng-hide="groupedBy === 'vendor'" column-sortable data-column="vendor"><?php echo $this->getString('ACCOUNTING_VENDOR'); ?></th>
                    <th ng-hide="groupedBy === 'paymentType'" column-sortable data-column="paymentType"><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?></th>
                    <th ng-hide="groupedBy === 'entryDate'" column-sortable data-column="entryDate"><?php echo $this->getString('ACCOUNTING_DATE'); ?></th>
                    <th ng-hide="groupedBy === 'description'" column-sortable data-column="description"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                    <th ng-hide="groupedBy === 'subtotal'" column-sortable data-column="subtotal"><?php echo $this->getString('ACCOUNTING_SUBTOTAL'); ?></th>
                    <th ng-hide="groupedBy === 'total'" column-sortable data-column="total"><?php echo $this->getString('ACCOUNTING_TOTAL'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td ng-hide="groupedBy === 'invoiceNumber'"></td>
                    <td ng-hide="groupedBy === 'phase'"></td>
                    <td ng-hide="groupedBy === 'department'"></td>
                    <td ng-hide="groupedBy === 'subcontractor'"></td>
                    <td ng-hide="groupedBy === 'vendor'"></td>
                    <td ng-hide="groupedBy === 'paymentType'"><span class="spinner-loader"></span></td>
                    <td ng-hide="groupedBy === 'entryDate'"></td>
                    <td ng-hide="groupedBy === 'description'"></td>
                    <td ng-hide="groupedBy === 'subtotal'"></td>
                    <td ng-hide="groupedBy === 'total'"></td>
                    <td></td>
                </tr>

                <tr ng-cloak ng-if="!loading && grouped && item[groupedBy] !== list[$index - 1][groupedBy]" ng-repeat-start="item in list">
                    <th colspan="7">
                        {{item[groupedBy]}}
                        <span ng-if="item[groupedBy] === '' || item[groupedBy] === null"><?php echo $this->getString('ACCOUNTING_BLANK_FIELD'); ?></span>
                    </th>
                </tr>

                <tr ng-if="!loading && !noSearchResults" ng-repeat-end ng-class="{
                        'selected'
                        : item === selectedRow}">
                    <td ng-hide="groupedBy === 'invoiceNumber'" ng-click="selectRow(item)">{{item.invoiceNumber}}</td>
                    <td ng-hide="groupedBy === 'phase'" ng-click="selectRow(item)">{{item.phase}}</td>
                    <td ng-hide="groupedBy === 'department'" ng-click="selectRow(item)">{{item.department}}</td>
                    <td ng-hide="groupedBy === 'subcontractor'" ng-click="selectRow(item)">{{item.subcontractor}}</td>
                    <td ng-hide="groupedBy === 'vendor'" ng-click="selectRow(item)">{{item.vendor}}</td>
                    <td ng-hide="groupedBy === 'paymentType'" ng-click="selectRow(item)">{{item.paymentType}}</td>
                    <td ng-hide="groupedBy === 'entryDate'" ng-click="selectRow(item)">{{item.entryDate}}</td>
                    <td ng-hide="groupedBy === 'description'" ng-click="selectRow(item)">{{item.description}}</td>
                    <td ng-hide="groupedBy === 'subtotal'" ng-click="selectRow(item)">{{item.subtotal| currency}}</td>
                    <td ng-hide="groupedBy === 'total'" ng-click="selectRow(item)">{{item.total| currency}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a ng-href="invoices/{{item.id}}"><?php echo $this->getString('EDIT'); ?></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-cloak ng-if="noSearchResults" class="results-message warning">
            <?php echo $this->getString('ACCOUNTING_NO_RESULTS'); ?>
        </div>

        <uib-pagination total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage" class="pagination" boundary-links="true" rotate="false"></uib-pagination>
    </div>

    <div class="widget-side-panel" ng-class="{
            'datepicker-open'
            : isOpen.datepicker.fromDate || isOpen.datepicker.toDate}">
        <div class="pull-right">
            <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!sidePanelLoading && searching && sidePanelOpen">
            <h1><?php echo $this->getString('ACCOUNTING_ADVANCED_SEARCH'); ?></h1>
            <div id="advancedSearch">

                <label>From Date</label>
                <div class="input-group date-picker">
                    <input type="date" name="date1" ng-model="advSearch.fromDate" ng-model-options="{timezone: '+0000'}"
                           class="form-control" datepicker-popup is-open="isOpen.datepicker.fromDate"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date1">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, 'fromDate')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>

                <label>To Date</label>
                <div class="input-group date-picker">
                    <input type="date" name="date2" ng-model="advSearch.toDate" ng-model-options="{timezone: '+0000'}"
                           class="form-control" datepicker-popup is-open="isOpen.datepicker.toDate"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date2">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, 'toDate')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>

                <!--Vendors Typeahead-->
                <div class="input-group">
                    <label><?php echo $this->getString('ACCOUNTING_VENDOR'); ?></label>
                    <input type="text" ng-model="vendor" typeahead-wait-ms="500" typeahead-min-length="2" typeahead-on-select="getVendorsID(vendor)"
                           uib-typeahead="value as value.company for value in fetchVendorsAutocomplete($viewValue)" typeahead-loading="loadingVendors"
                           typeahead-no-results="noResultsVendor" class="form-control typeahead">
                    <i ng-show="loadingVendors" class="glyphicon glyphicon-refresh"></i>
                    <div class="resultspane" ng-show="noResultsVendor">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                    </div>
                </div>

                <!--Subcontrators Typeahead-->
                <div class="input-group">
                    <label><?php echo $this->getString('ACCOUNTING_SUBCONTRACTOR'); ?></label>
                    <input type="text" ng-model="subcontractor" typeahead-wait-ms="500" typeahead-min-length="2" typeahead-on-select="getSubcontractorsID(subcontractor)"
                           uib-typeahead="value as value.companyName for value in fetchSubcontractorsAutocomplete($viewValue)" typeahead-loading="loadingSubcontractors"
                           typeahead-no-results="noResultsVendor" class="form-control typeahead">
                    <i ng-show="loadingSubcontractors" class="glyphicon glyphicon-refresh"></i>
                    <div class="resultspane" ng-show="noResultsVendor">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                    </div>
                </div>

                <select class="form-control" name="Vendors_id" ng-model="advSearch.Departments_id">
                    <option value="" selected>-<?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?>-</option>
                    <?php
                    foreach ($Departments as $department) {
                        echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="PurchaseOrderTypes" ng-model="advSearch.AccountingPaymentMethods_id">
                    <option value="" selected>-<?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?>-</option>
                    <?php
                    foreach ($AccountingPaymentMethods as $paymentMethod) {
                        echo '<option value="' . $paymentMethod['id'] . '">' . $paymentMethod['type'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="ClaimPhases" ng-model="advSearch.ClaimPhases_id">
                    <option value="" selected>-<?php echo $this->getString('ACCOUNTING_CLAIM_PHASE'); ?>-</option>
                    <?php
                    foreach ($ClaimPhases as $phase) {
                        echo '<option value="' . $phase['id'] . '">' . $phase['title'] . '</option>';
                    }
                    ?>
                </select>

            </div>

            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" ng-click="advancedSearch(advSearch)" value="<?php echo $this->getString('ACCOUNTING_SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('ACCOUNTING_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching && sidePanelOpen">
            <div class="breakdown-title">
                <div class="pull-left">
                    <h3><?php echo $this->getString('ACCOUNTING_INVOICE_NUMBER') ?></h3>
                    <p>{{selectedRow.invoiceNumber}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_VENDOR') ?></h3>
                    <p>{{selectedRow.vendor}}</p>
                </div>
                <div class="pull-right">
                    <h3><?php echo $this->getString('ACCOUNTING_DATE') ?></h3>
                    <p>{{selectedRow.entryDate}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_JOB_NUMBER') ?></h3>
                    <p>{{breakdown.jobNumber}}</p>
                </div>
            </div>
            <div ng-if="breakdown.filename">
                <p><a href="invoices/download/{{breakdown.id}}" target="_blank"><i class="glyphicon glyphicon-download"></i> <?php echo $this->getString('ACCOUNTING_DOWNLOAD_ATTACHED_PDF'); ?></a></p>
            </div>
            <h4><?php echo $this->getString('ACCOUNTING_PURCHASE_ORDER_ITEMS') ?></h4>

            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-3"><?php echo $this->getString('ACCOUNTING_PRODUCT_NAME') ?></th>
                    <th class="col-md-3"><?php echo $this->getString('ACCOUNTING_QUANTITY') ?></th>
                    <th class="col-md-2"><?php echo $this->getString('ACCOUNTING_PRICE') ?></th>
                    <th class="col-md-2"><?php echo $this->getString('ACCOUNTING_TAX_TYPE') ?></th>
                    <th class="col-md-2"><?php echo $this->getString('ACCOUNTING_AMOUNT') ?></th>
                </tr>
                <tr ng-repeat="item in breakdownLineItems">
                    <td>{{item.name}}</td>
                    <td>{{item.quantity}}</td>
                    <td>{{item.price| currency}}</td>
                    <td>{{item.taxType}} </td>
                    <td>{{item.amount| currency}}</td>
                </tr>
            </table>
            <div class="col-md-5 col-md-offset-7">
                <div class="pull-left">
                    <p><strong><?php echo $this->getString('ACCOUNTING_SUBTOTAL') ?></strong></p>
                    <p ng-if="breakdown.deliveryFee"><strong><?php echo $this->getString('ACCOUNTING_DELIVERY_FEE') ?></strong></p>
                    <p><strong><?php echo $this->getString('ACCOUNTING_TAX') ?></strong></p>
                    <p><strong><?php echo $this->getString('ACCOUNTING_TOTAL') ?></strong></p>
                </div>
                <div class="pull-right">
                    <p>{{breakdown.subtotal| currency}}</p>
                    <p ng-if="breakdown.deliveryFee">{{breakdown.deliveryFee| currency}}</p>
                    <p>{{breakdown.tax| currency}}</p>
                    <p>{{breakdown.total| currency}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>