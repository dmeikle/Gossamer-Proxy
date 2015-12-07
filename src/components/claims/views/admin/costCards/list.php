<?php $params = $this->httpRequest->getParameters(); ?>
<?php // pr($this->model->getParameters();  ?>
<input type="hidden" id="Claims_id" value="<?php echo $params[0]; ?>" />

<div class="widget" ng-controller="costCardListCtrl">
    <div class="widget-content" ng-class="{'panel-open':sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('CLAIMS_COST_CARDS') ?><span ng-if="jobNumber"> - {{jobNumber}}</span></h1>
        <!--<div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php // echo $this->getString('CLAIMS_DB_ERROR')                 ?></div>-->
        <div class="toolbar form-inline">
            <button class="btn-link" ng-click="openAdvancedSearch()">
                <?php echo $this->getString('CLAIMS_ADVANCED_SEARCH') ?>
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
            <a href="<?php echo $params[0]; ?>/0"><button class="primary new-item"><?php echo $this->getString('CLAIMS_NEW_COST_CARD') ?></button></a>
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'phase'" column-sortable data-column="phase"><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                    <th ng-hide="groupedBy === 'lastModified'" column-sortable data-column="lastModified"><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                    <th ng-hide="groupedBy === 'notes'" column-sortable data-column="notes"><?php echo $this->getString('CLAIMS_NOTES'); ?></th>
                    <th ng-hide="groupedBy === 'total'" column-sortable data-column="total"><?php echo $this->getString('CLAIMS_TOTAL_COST'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td ng-hide="groupedBy === 'phase'"></td>
                    <td ng-hide="groupedBy === 'lastModified'"></td>
                    <td ng-hide="groupedBy === 'notes'">
                        <span class="spinner-loader"></span>
                    </td>
                    <td ng-hide="groupedBy === 'total'"></td>
                    <td></td>
                </tr>

                <tr ng-cloak ng-if="!loading && grouped && item[groupedBy] !== list[$index - 1][groupedBy]" ng-repeat-start="item in list">
                    <th colspan="7">
                        {{item[groupedBy]}}
                        <span ng-if="item[groupedBy] === '' || item[groupedBy] === null">Blank Field</span>
                    </th>
                </tr>

                <tr ng-if="!loading && !noSearchResults" ng-repeat-end ng-class="{'selected' : item === selectedRow}">
                    <td ng-hide="groupedBy === 'phase'" ng-click="selectRow(item)">{{item.phase}}</td>
                    <td ng-hide="groupedBy === 'lastModified'" ng-click="selectRow(item)">{{item.lastModified.split(' ')[0]}}</td>
                    <td ng-hide="groupedBy === 'notes'" ng-click="selectRow(item)">{{item.notes}}</td>
                    <td ng-hide="groupedBy === 'total'" ng-click="selectRow(item)">{{item.totalCost}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a ng-href="{{item.Claims_id}}/{{item.id}}">Edit</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div ng-cloak ng-if="noSearchResults" class="results-message warning">
            <?php echo $this->getString('CLAIMS_NO_RESULTS'); ?>
        </div>

        <uib-pagination total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage" class="pagination" boundary-links="true" rotate="false"></uib-pagination>
    </div>

    <div class="widget-side-panel" ng-class="{'datepicker-open': isOpen.datepicker.fromDate || isOpen.datepicker.toDate}">
        <div class="pull-right">
            <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!sidePanelLoading && searching && sidePanelOpen">
            <h1><?php echo $this->getString('CLAIMS_ADVANCED_SEARCH'); ?></h1>
            <div id="advancedSearch">

                <label>From Date</label>
                <div class="input-group date-picker">
                    <input type="date" name="date1" ng-model="advSearch.fromDate" ng-model-options="{timezone: '+0000'}"
                           class="form-control" datepicker-popup is-open="isOpen.datepicker.fromDate"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('CLAIMS_CLOSE'); ?>" />
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
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('CLAIMS_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date2">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, 'toDate')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>

                <select class="form-control" name="ClaimPhases" ng-model="advSearch.ClaimPhases_id">
                    <option value="" selected>-Claim Phases-</option>
                    <?php
                    foreach ($ClaimPhases as $phase) {
                        echo '<option value="' . $phase['id'] . '">' . $phase['title'] . '</option>';
                    }
                    ?>
                </select>

            </div>

            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" ng-click="advancedSearch(advSearch)" value="<?php echo $this->getString('SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching && sidePanelOpen">
            <div class="breakdown-title">
                <div class="pull-left">
                    <h3><?php echo $this->getString('CLAIMS_COST_CARD_ID') ?></h3>
                    <p>{{breakdown.CostCards_id}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <h4><?php echo $this->getString('CLAIMS_COST_SUMMARY') ?></h4>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="col-md-6"><?php echo $this->getString('CLAIMS_NAME') ?></th>
                    <th class="col-md-6"><?php echo $this->getString('CLAIMS_COST') ?></th>
                </tr>
                <tr >
                    <th colspan="2"><?php echo $this->getString('CLAIMS_TIMESHEETS') ?></th>
                </tr>
                <tr ng-if="breakdown.timesheets.regHoursCost > 0 && breakdown.timesheets.regHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_REGULAR_HOURS') ?></td>
                    <td>{{breakdown.timesheets.regHoursCost| currency}}</td>
                </tr>
                <tr ng-if="breakdown.timesheets.otHoursCost > 0 && breakdown.timesheets.otHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_OVERTIME_HOURS') ?></td>
                    <td>{{breakdown.timesheets.otHoursCost| currency}}</td>
                </tr>
                <tr ng-if="breakdown.timesheets.dotHoursCost > 0 && breakdown.timesheets.dotHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_DOUBLE_OVERTIME_HOURS') ?></td>
                    <td>{{breakdown.timesheets.dotHoursCost| currency}}</td>
                </tr>
                <tr ng-if="breakdown.timesheets.statRegHoursCost > 0 && breakdown.timesheets.statRegHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_STAT_REGULAR_HOURS') ?></td>
                    <td>{{breakdown.timesheets.statRegHoursCost| currency}}</td>
                </tr>
                <tr ng-if="breakdown.timesheets.statOTHoursCost > 0 && breakdown.timesheets.statOTHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_STAT_OVERTIME_HOURS') ?></td>
                    <td>{{breakdown.timesheets.statOTHoursCost| currency}}</td>
                </tr>
                <tr ng-if="breakdown.timesheets.statDotHoursCost > 0 && breakdown.timesheets.statDotHoursCost !== null">
                    <td><?php echo $this->getString('CLAIMS_STAT_DOUBLE_OVERTIME_HOURS') ?></td>
                    <td>{{breakdown.timesheets.statDotHoursCost| currency}}</td>
                </tr>
                <!-- Equipment -->
                <tr ng-if="breakdown.eqCosts.cost > 0 && breakdown.eqCosts.cost !== null">
                    <th colspan="2"><?php echo $this->getString('CLAIMS_EQUIPMENT') ?></th>
                </tr>
                <tr ng-if="breakdown.eqCosts.cost > 0 && breakdown.eqCosts.cost !== null">
                    <td><?php echo $this->getString('CLAIMS_TOTAL_COST') ?></td>
                    <td>{{breakdown.eqCosts.cost| currency}}</td>
                </tr >
                <!-- Materials -->
                <tr ng-if="breakdown.inventoryCosts.cost > 0 && breakdown.inventoryCosts.cost !== null">
                    <th colspan="2"><?php echo $this->getString('CLAIMS_MATERIAL') ?></th>
                </tr>
                <tr ng-if="breakdown.inventoryCosts.cost > 0 && breakdown.inventoryCosts.cost !== null">
                    <td><?php echo $this->getString('CLAIMS_TOTAL_COST') ?></td>
                    <td>{{breakdown.inventoryCosts.cost| currency}}</td>
                </tr>
                <!-- General -->
                <tr ng-if="breakdown.generalCosts.cost > 0 && breakdown.generalCosts.cost !== null">
                    <th colspan="2"><?php echo $this->getString('CLAIMS_MISC_GENERAL') ?></th>
                </tr>
                <tr ng-if="breakdown.generalCosts.cost > 0 && breakdown.generalCosts.cost !== null">
                    <td><?php echo $this->getString('CLAIMS_TOTAL_COST') ?></td>
                    <td>{{breakdown.generalCosts.cost| currency}}</td>
                </tr>
                <!-- Purchase Orders -->
                <!--<div >-->
                <tr ng-if="breakdown.purchaseOrders.cost > 0 && breakdown.purchaseOrders.cost !== null">
                    <th colspan="2"><?php echo $this->getString('CLAIMS_PURCHASE_ORDERS') ?>{{breakdown.purchaseOrders}}</th>
                </tr>
                <tr ng-if="breakdown.purchaseOrders.cost > 0 && breakdown.purchaseOrders.cost !== null">
                    <td><?php echo $this->getString('CLAIMS_TOTAL_COST') ?></td>
                    <td>{{breakdown.purchaseOrders.cost| currency}}</td>
                </tr>
                <!--</div>-->
            </table>
        </div>
    </div>

    <div class="clearfix"></div>
</div>