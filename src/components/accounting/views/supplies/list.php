<div class="widget" ng-controller="suppliesCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left">Supplies</h1>
        <div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php echo $this->getString('ACCOUNTING_TIMESHEET_DB_ERROR') ?></div>

        <!--    <div class="pull-right">-->
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
                <?php echo $this->getString('ACCOUNTING_ADVANCED_SEARCH') ?>
            </button>
            <form ng-submit="search(basicSearch.query, 'name')" class="input-group">
                <input placeholder="Search" type="text" ng-model="basicSearch.query" ng-model-options="{debounce:500}" class="form-control" ng-change="autoSearch(basicSearch.query)">
<!--                <button type="submit" class="primary"><?php // echo $this->getString('ACCOUNTING_SEARCH')            ?></button>-->
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
            <button class="primary new-item" ng-click="openModal()"><?php echo $this->getString('ACCOUNTING_NEW_INVENTORY') ?></button>
<!--            <span ng-cloak ng-if="modalLoading" class="modal-spinner spinner-loader"></span>-->
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'firstname'" column-sortable data-column="firstname"><?php echo $this->getString('ACCOUNTING_FIRST_NAME'); ?></th>
                    <th ng-hide="groupedBy === 'lastname'" column-sortable data-column="lastname"><?php echo $this->getString('ACCOUNTING_LAST_NAME'); ?></th>
                    <th ng-hide="groupedBy === 'jobNumber'" column-sortable data-column="jobNumber"><?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?></th>
                    <th ng-hide="groupedBy === 'numItems'" column-sortable data-column="numItems"><?php echo $this->getString('ACCOUNTING_ITEMS'); ?></th>
                    <th ng-hide="groupedBy === 'title'" column-sortable data-column="title"><?php echo $this->getString('ACCOUNTING_PHASE'); ?></th>
                    <th ng-hide="groupedBy === 'department'" column-sortable data-column="department"><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></th>
                    <th ng-hide="groupedBy === 'totalCost'" column-sortable data-column="totalCost"><?php echo $this->getString('ACCOUNTING_COST'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td ng-hide="groupedBy === 'firstname'"></td>
                    <td ng-hide="groupedBy === 'lastname'"></td>
                    <td ng-hide="groupedBy === 'jobNumber'"></td>
                    <td ng-hide="groupedBy === 'numItems'"></td>
                    <td ng-hide="groupedBy === 'title'">
                        <span class="spinner-loader"></span>
                    </td>
                    <td ng-hide="groupedBy === 'department'" column-sortable data-column="department"></td>
                    <td ng-hide="groupedBy === 'totalCost'" column-sortable data-column="totalCost"></td>
                    <td></td>
<!--                    <td></td>                   -->
                </tr>

                <tr ng-cloak ng-if="!loading && grouped && item[groupedBy] !== list[$index - 1][groupedBy]" ng-repeat-start="item in list">
                    <th colspan="7">
                        <!--
                                                <span ng-if="groupedBy === 'firstname'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_FIRSTNAME'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'lastname'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_LASTNAME'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'jobNumber'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_TITLE'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'numItems'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_EXTENSION'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'title'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_MOBILE'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'department'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_STATUS'); ?>
                                                </span>
                                                <span ng-if="groupedBy === 'totalCost'">
                        <?php // echo $this->getString('STAFF_GROUPEDBY_LASTLOGIN'); ?>
                                                </span>
                        -->
                        {{item[groupedBy]}}
                        <span ng-if="item[groupedBy] === '' || item[groupedBy] === null">Blank Field</span>
                    </th>
                </tr>

                <tr ng-if="!loading && !noSearchResults" ng-repeat-end ng-class="{'selected': item === previouslyClickedObject}">
                    <td ng-hide="groupedBy === 'firstname'" ng-click="selectRow(item)">{{item.firstname}}</td>
                    <td ng-hide="groupedBy === 'lastname'" ng-click="selectRow(item)">{{item.lastname}}</td>
                    <td ng-hide="groupedBy === 'jobNumber'" ng-click="selectRow(item)">{{item.jobNumber}}</td>
                    <td ng-hide="groupedBy === 'numItems'" ng-click="selectRow(item)">{{item.numItems}}</td>
                    <td ng-hide="groupedBy === 'title'" ng-click="selectRow(item)">{{item.title}}</td>
                    <td ng-hide="groupedBy === 'department'" ng-click="selectRow(item)">{{item.department}}</td>
                    <td ng-hide="groupedBy === 'totalCost'" ng-click="selectRow(item)">{{item.totalCost| currency}}</td>
<!--                    <td ng-click="selectRow(item)">{{item.totalChargeout | currency}}</td>-->
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a ng-click="openModal(item)"><?php echo $this->getString('EDIT') ?></a></li>
                                <li><a ng-click="deleteItem(item)"><?php echo $this->getString('DELETE') ?></a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-cloak ng-if="noSearchResults" class="results-message warning">
            <?php echo $this->getString('ACCOUNTING_NO_RESULTS'); ?>
        </div>

        <pagination total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage" class="pagination" boundary-links="true" rotate="false"></pagination>
    </div>

    <div class="widget-side-panel" ng-class="{'datepicker-open': isOpen.datepicker.fromDate || isOpen.datepicker.toDate}">
        <div class="pull-right">
            <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!sidePanelLoading && searching">
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

                <input placeholder="Claim" class="form-control" name="jobNumber" ng-model="advSearch.jobNumber">

                <select class="form-control" name="ClaimPhases_id" ng-model="advSearch.ClaimPhases_id">
                    <option value="" selected>-<?php echo $this->getString('ACCOUNTING_PHASE_CODE') ?>-</option>
                    <?php
                    foreach ($AccountingPhaseCodes as $phase) {
                        echo '<option value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                    }
                    ?>
                </select>

                <select class="form-control" name="Departments_id" ng-model="advSearch.Departments_id">
                    <option value="" selected>-<?php echo $this->getString('ACCOUNTING_DEPARTMENT') ?>-</option>
                    <?php
                    foreach ($Departments as $department) {
                        echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                    }
                    ?>
                </select>

                <input placeholder="Inventory Item" class="form-control" name="inventoryItemID" ng-model="advSearch.inventoryItem">

            </div>

            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" ng-click="advancedSearch(advSearch)" value="<?php echo $this->getString('ACCOUNTING_SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('ACCOUNTING_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <div class="breakdown-title">
                <div class="pull-left">
                    <h3><?php echo $this->getString('ACCOUNTING_JOB_NUMBER') ?></h3>
                    <p>{{selectedRow.jobNumber}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_DEPARTMENT') ?></h3>
                    <p>{{selectedRow.department}}</p>
                </div>
                <div class="pull-right">
                    <h3><?php echo $this->getString('ACCOUNTING_DATE') ?></h3>
                    <p>{{selectedRow.dateUsed}}</p>
                    <h3><?php echo $this->getString('ACCOUNTING_PHASE') ?></h3>
                    <p>{{selectedRow.title}}</p>
                </div>
            </div>

            <div ng-repeat="item in rowBreakdown">
                <div class="card info-card">
                    <p><strong><?php echo $this->getString('ACCOUNTING_NAME') ?>:</strong> {{item.name}}</p>
                    <p><strong><?php echo $this->getString('ACCOUNTING_UNIT_OF_MEASURE') ?>:</strong> {{item.packageType}}</p>
                    <p><strong><?php echo $this->getString('ACCOUNTING_COST') ?>:</strong> {{item.cost| currency}}</p>
                    <p><strong><?php echo $this->getString('ACCOUNTING_CHARGEOUT') ?>:</strong> {{item.chargeOut| currency}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
</div>
