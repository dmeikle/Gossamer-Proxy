<div class="widget" ng-controller="cashReceiptsCtrl">
    <div class="widget-content" ng-class="{
            'panel-open'
            :sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('ACCOUNTING_CASH_RECEIPTS') ?></h1>
        <div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php echo $this->getString('ACCOUNTING_TIMESHEET_DB_ERROR') ?></div>
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
            <button ng-click="openModal()"class="primary new-item"><?php echo $this->getString('ACCOUNTING_NEW_CASH_RECEIPT') ?></button>
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'chequeNumber'" column-sortable data-column="chequeNumber"><?php echo $this->getString('ACCOUNTING_CHEQUE_NUMBER'); ?></th>
                    <th ng-hide="groupedBy === 'jobNumber'" column-sortable data-column="jobNumber"><?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?></th>
                    <th ng-hide="groupedBy === 'company'" column-sortable data-column="company"><?php echo $this->getString('ACCOUNTING_PAYER'); ?></th>
                    <th ng-hide="groupedBy === 'description'" column-sortable data-column="description"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                    <th ng-hide="groupedBy === 'creditAccount'" column-sortable data-column="creditAccount"><?php echo $this->getString('ACCOUNTING_CREDIT_ACCOUNT'); ?></th>
                    <th ng-hide="groupedBy === 'debitAccount'" column-sortable data-column="debitAccount"><?php echo $this->getString('ACCOUNTING_DEBIT_ACCOUNT'); ?></th>
                    <th ng-hide="groupedBy === 'paymentMethod'" column-sortable data-column="paymentMethod"><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?></th>
                    <th ng-hide="groupedBy === 'dateReceived'" column-sortable data-column="dateReceived"><?php echo $this->getString('ACCOUNTING_DATE'); ?></th>
                    <th ng-hide="groupedBy === 'amount'" column-sortable data-column="amount"><?php echo $this->getString('ACCOUNTING_AMOUNT'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td ng-hide="groupedBy === 'chequeNumber'"></td>
                    <td ng-hide="groupedBy === 'jobNumber'"></td>
                    <td ng-hide="groupedBy === 'company'"></td>
                    <td ng-hide="groupedBy === 'description'"></td>
                    <td ng-hide="groupedBy === 'creditAccount'">
                        <span class="spinner-loader"></span>
                    </td>
                    <td ng-hide="groupedBy === 'debitAccount'"></td>
                    <td ng-hide="groupedBy === 'paymentMethod'"></td>
                    <td ng-hide="groupedBy === 'dateReceived'"></td>
                    <td ng-hide="groupedBy === 'amount'"></td>
                    <td></td>
                </tr>

                <tr ng-cloak ng-if="!loading && grouped && item[groupedBy] !== list[$index - 1][groupedBy]" ng-repeat-start="item in list">
                    <th colspan="7">
                        {{item[groupedBy]}}
                        <span ng-if="item[groupedBy] === '' || item[groupedBy] === null">Blank Field</span>
                    </th>
                </tr>

                <tr ng-if="!loading && !noSearchResults" ng-repeat-end ng-class="{
                        'selected'
                        : item === selectedRow}">
                    <td ng-hide="groupedBy === 'chequeNumber'" ng-click="selectRow(item)">{{item.chequeNumber}}</td>
                    <td ng-hide="groupedBy === 'jobNumber'" ng-click="selectRow(item)">{{item.jobNumber}}</td>
                    <td ng-hide="groupedBy === 'company'" ng-click="selectRow(item)">{{item.company}}</td>
                    <td ng-hide="groupedBy === 'description'" ng-click="selectRow(item)">{{item.description}}</td>
                    <td ng-hide="groupedBy === 'creditAccount'" ng-click="selectRow(item)">{{item.creditAccount}}</td>
                    <td ng-hide="groupedBy === 'debitAccount'" ng-click="selectRow(item)">{{item.debitAccount}}</td>
                    <td ng-hide="groupedBy === 'paymentMethod'" ng-click="selectRow(item)">{{item.paymentMethod}}</td>
                    <td ng-hide="groupedBy === 'dateReceived'" ng-click="selectRow(item)">{{item.dateReceived}}</td>
                    <td ng-hide="groupedBy === 'amount'" ng-click="selectRow(item)">{{item.amount| currency}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a ng-click="openModal(item)">Edit</a></li>
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

                <label><?php echo $this->getString('ACCOUNTING_FROM_DATE'); ?></label>
                <div class="input-group date-picker">
                    <input type="date" name="date1" ng-model="advSearch.fromDate" ng-model-options="{timezone: '+0000'}"
                           class="form-control" uib-datepicker-popup is-open="isOpen.datepicker.fromDate"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date1">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, 'fromDate')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>

                <label><?php echo $this->getString('ACCOUNTING_TO_DATE'); ?></label>
                <div class="input-group date-picker">
                    <input type="date" name="date2" ng-model="advSearch.toDate" ng-model-options="{timezone: '+0000'}"
                           class="form-control" uib-datepicker-popup is-open="isOpen.datepicker.toDate"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date2">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, 'toDate')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>

                <div class="input-group">
                    <label><?php echo $this->getString('ACCOUNTING_PAYER'); ?></label>
                    <input placeholder="<?php echo $this->getString('ACCOUNTING_PAYER'); ?>" type="text" ng-model="company" typeahead-wait-ms="500"
                           uib-typeahead="value as value.name for value in fetchCompanyAutocomplete($viewValue)"
                           typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsCompany" class="form-control typeahead"
                           typeahead-min-length="3" typeahead-on-select="getCompanyID(company)">
                    <div class="resultspane" ng-show="noResultsCompany">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                    </div>
                </div>

                <div class="input-group">
                    <label><?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?></label>
                    <input placeholder="<?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?>" type="text" ng-model="claim" typeahead-wait-ms="500"
                           uib-typeahead="value as value.jobNumber for value in fetchClaimsAutocomplete($viewValue)"
                           typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsCompany" class="form-control typeahead"
                           typeahead-min-length="2" typeahead-on-select="getClaimsID(claim)">
                    <div class="resultspane" ng-show="noResultsCompany">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                    </div>
                </div>

                <select class="form-control" name="PurchaseOrderTypes" ng-model="advSearch.AccountingPaymentMethods_id">
                    <option value="" selected>-Payment Methods-</option>
                    <?php
                    foreach ($AccountingPaymentMethods as $paymentMethod) {
                        echo '<option value="' . $paymentMethod['id'] . '">' . $paymentMethod['type'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="ClaimPhases" ng-model="advSearch.ClaimPhases_id">
                    <option value="" selected>-Claim Phases-</option>
                    <?php
                    foreach ($ClaimPhases as $phase) {
                        echo '<option value="' . $phase['id'] . '">' . $phase['title'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="DebitAccounts" ng-model="advSearch.AccountingDebitAccounts_id">
                    <option value="" selected>-Debit Account-</option>
                    <?php
                    foreach ($DebitAccounts as $debitAccount) {
                        echo '<option value="' . $debitAccount['id'] . '">' . $debitAccount['name'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="CreditAccounts" ng-model="advSearch.AccountingCreditAccounts_id">
                    <option value="" selected>-Credit Account-</option>
                    <?php
                    foreach ($CreditAccounts as $creditAccount) {
                        echo '<option value="' . $creditAccount['id'] . '">' . $creditAccount['name'] . '</option>';
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
                    <h3><?php echo $this->getString('ACCOUNTING_CHEQUE_NUMBER') ?></h3>
                    <p>{{breakdown.chequeNumber}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_PAYER') ?></h3>
                    <p>{{selectedRow.company}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_DEBIT_ACCOUNT') ?></h3>
                    <p>{{selectedRow.debitAccount}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD') ?></h3>
                    <p>{{selectedRow.paymentMethod}}</p>
                </div>
                <div class="pull-right">
                    <h3><?php echo $this->getString('ACCOUNTING_DATE') ?></h3>
                    <p>{{selectedRow.dateReceived}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_JOB_NUMBER') ?></h3>
                    <p>{{breakdown.jobNumber}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_CREDIT_ACCOUNT') ?></h3>
                    <p>{{selectedRow.creditAccount}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_AMOUNT') ?></h3>
                    <p>{{selectedRow.amount| currency}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>