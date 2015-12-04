<div ng-controller="costCardEditCtrl">
    <div class="widget" >
        <div class="widget-content">

            <h1 class="pull-left">
                <span ng-if="!editing"><?php echo $this->getString('NEW') ?></span>
                <span ng-if="editing"><?php echo $this->getString('EDIT') ?></span>
                <?php echo $this->getString('CLAIMS_COST_CARD') ?>
            </h1>
            <div class="toolbar form-inline">
                <!--<button class="btn-primary" ng-click="approveItems()"><?php // echo $this->getString('CLAIMS_APPROVE');              ?></button>-->
                <div class="btn-group" uib-dropdown>
                    <button id="split-button" type="button" class="btn btn-primary"  ng-click="disapproveSelected()">
                        <?php echo $this->getString('CLAIMS_DISAPPROVE_SELECTED'); ?>
                    </button>
                    <button type="button" class="btn btn-primary" uib-dropdown-toggle>
                        <span class="caret"></span>
                        <!--<span class="sr-only"><?php // echo $this->getString('CLAIMS_APPROVE_SELECTED');              ?></span>-->
                    </button>
                    <ul class="uib-dropdown-menu pull-right row-controls" role="menu" aria-labelledby="split-button">
                        <li role="menuitem"><a href="#"><?php echo $this->getString('CLAIMS_GENERATE_BREAKDOWN_REPORT'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-4">

                <div class="form-group">
                    <label for="ClaimPhases_id" class="heading-label"><?php echo $this->getString('CLAIMS_PHASE'); ?></label>
                    <?php echo $form['ClaimPhases_id']; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="notes" class="heading-label"><?php echo $this->getString('CLAIMS_NOTES'); ?></label>
                    <?php echo $form['notes']; ?>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>
            <!--Tabs-->
            <uib-tabset>
                <!-- Summary Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_SUMMARY') ?>">
                    <div ng-if="loading" class="col-md-12 spacer">
                        <span class="spinner-loader"></span>
                    </div>
                    <div ng-if="!loading">
                        <div class="row spacer">
                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_LABORER_TIMESHEETS') ?></h4>
                                    <div class="card-content" ng-if="costCardTimesheets[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_TIMESHEET_COUNT') ?>: </strong>{{costCardTimesheets.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_HOURS') ?>: </strong>{{timesheetsTotalHours}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{timesheetsTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCardTimesheets[0].length === 0">
                                        <p>
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                            <?php echo $this->getString('CLAIMS_TIMESHEET'); ?>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                            <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_EQUIPMENT') ?></h4>
                                    <div class="card-content" ng-if="costCardEquipment[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_EQUIPMENT_COUNT') ?>: </strong>{{costCardEquipment.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{equipmentTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCardEquipment[0].length === 0">
                                        <p>
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                            <?php echo $this->getString('CLAIMS_EQUIPMENT'); ?>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                            <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_MATERIAL') ?></h4>
                                    <div class="card-content" ng-if="costCardMaterials[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_MATERIALS_COUNT') ?>: </strong>{{costCardMaterials.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{materialsTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCardMaterials[0].length === 0">
                                        <p>
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                            <?php echo $this->getString('CLAIMS_MATERIAL'); ?>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                            <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_MISC_GENERAL') ?></h4>
                                    <div class="card-content" ng-if="costCardMiscItems[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_MISC_COUNT') ?>: </strong>{{costCardMiscItems.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{miscTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCardMiscItems[0].length === 0">
                                        <p>
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                            <?php echo $this->getString('CLAIMS_MISC_GENERAL'); ?>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                            <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_PURCHASE_ORDERS') ?></h4>
                                    <div class="card-content" ng-if="costCardPurchaseOrders[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_PURCHASE_ORDER_COUNT') ?>: </strong>{{costCardPurchaseOrders.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{purchaseOrdersTotal| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCardPurchaseOrders[0].length === 0">
                                        <p>
                                            <i class="glyphicon glyphicon-exclamation-sign"></i>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                            <?php echo $this->getString('CLAIMS_PURCHASE_ORDERS'); ?>
                                            <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                            <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card info-card">
                                    <h4><?php echo $this->getString('CLAIMS_COST_CARD') ?> <?php echo $this->getString('CLAIMS_SUMMARY') ?></h4>
                                    <div class="card-content">
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{costCardTotalCost| currency}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_APPROVED_COST') ?>: </strong>{{costCardApprovedCost| currency}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_UNAPPROVED_COST') ?>: </strong>{{costCardUnapprovedCost| currency}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </uib-tab>
                <!-- Laborers / Timesheets Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_LABORER_TIMESHEETS') ?>">
                    <div class="form-items">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-col" ng-click="selectAllTimesheetsToggle(selectAllTimesheets)">
                                        <input class="select-all checkbox" type="checkbox" ng-model="selectAllTimesheets">
                                    </th>
                                    <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_CATEGORY');      ?></th>-->
                                    <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_EXPORTED'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_REGULAR_HOURS'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_OVERTIME_HOURS'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_DOUBLE_OVERTIME_HOURS'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_STAT_REGULAR_HOURS'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_STAT_OVERTIME_HOURS'); ?></th>
                                    <th ng-if="showHours"><?php echo $this->getString('CLAIMS_STAT_DOUBLE_OVERTIME_HOURS'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_TOTAL_HOURS'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_HOURLY_RATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCardTimesheets[0].length === 0">
                                    <td colspan="9" class="alert-info">
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_TIMESHEET'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                    </td>
                                </tr>
                                <tr ng-if="loading">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!--<td></td>-->
                                    <td>
                                        <span class="spinner-loader"></span>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!--<td></td>-->
                                </tr>
                                <tr ng-if="!loading && costCardTimesheets[0].length !== 0" ng-repeat="row in costCardTimesheets track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.lastname}}, {{row.firstname}}</td>
                                    <td>{{row.workDate}}</td>
                                    <td>{{row.phase}}</td>
                                    <!--<td>{{row.category}}</td>-->
                                    <td>{{row.department}}</td>
                                    <td>{{row.isExported}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.regularHours}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.overtimeHours}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.doubleOTHours}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.statRegularHours}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.statOTHours}}</td>
                                    <td ng-if="showHours" class="cell-border">{{row.statDoubleOTHours}}</td>
                                    <td>{{row.totalHours}}</td>
                                    <td>{{row.hourlyRate| currency}}</td>
                                    <td>BREAK IT DOWN NOW</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCardTimesheets[0].length !== 0">
                                    <th colspan="5"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsRegHours}}</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsOTHours}}</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsDOTHours}}</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsSRegHours}}</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsSOTHours}}</th>
                                    <th ng-if="showHours" colspan="1">{{timesheetsSDOTHours}}</th>
                                    <th colspan="1">{{timesheetsTotalHours}}
                                        <span ng-if="!showHours" ng-click="toggleHours()" class="glyphicon glyphicon-plus expand-btn"></span>
                                        <span ng-if="showHours" ng-click="toggleHours()" class="glyphicon glyphicon-minus expand-btn"></span>
                                    </th>
                                    <th colspan="2">{{timesheetsTotalCost| currency}}</th>
                                </tr>
                                <tr>
                                    <th colspan="9">Unassigned Items</th>
                                </tr>
                                <tr ng-repeat="row in unassignedTimesheets">
                                    <td colspan="9">Unassigned Item!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>
                <!-- Equipment Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_EQUIPMENT') ?>">

                    <div class="form-items">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-col" ng-click="selectAllEquipmentToggle(selectAllEquipment)">
                                        <input class="select-all checkbox" type="checkbox" ng-model="selectAllEquipment">
                                    </th>
                                    <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_NUMBER'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_NUM_DAYS'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_MAX_DAYS'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PRICE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCardEquipment[0].length === 0">
                                    <td colspan="10" class="alert-info">
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_EQUIPMENT'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                    </td>
                                </tr>
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
                                    <!--<td></td>-->
                                </tr>
                                <tr ng-if="!loading && costCardEquipment[0].length !== 0" ng-repeat="row in costCardEquipment track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.transferDate}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.category}}</td>
                                    <td>{{row.number}}</td>
                                    <td>{{row.numDays}}</td>
                                    <td>{{row.maxDays}}</td>
                                    <td>{{row.price| currency}}</td>
                                    <td>BREAK IT DOWN NOW</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCardEquipment[0].length !== 0">
                                    <th colspan="7"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{equipmentTotalCost| currency}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>

                <!-- Materials Tab-->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_MATERIAL') ?>">
                    <div class="form-items">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-col" ng-click="selectAllMaterialsToggle(selectAllMaterials)">
                                        <input class="select-all checkbox" type="checkbox" ng-model="selectAllMaterials">
                                    </th>
                                    <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PRODUCT_CODE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_CHARGE_OUT');                        ?></th>-->
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCardMaterials[0].length === 0">
                                    <td colspan="9" class="alert-info">
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_MATERIAL'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                    </td>
                                </tr>
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
                                    <!--<td></td>-->
                                    <td></td>
                                    <!--<td></td>-->
                                </tr>
                                <tr ng-if="!loading && costCardMaterials[0].length !== 0" ng-repeat="row in costCardMaterials track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.dateUsed}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.category}}</td>
                                    <td>{{row.department}}</td>
                                    <td>{{row.productCode}}</td>
                                    <td>{{row.cost| currency}}</td>
                                    <!--<td>{{row.chargeout}}</td>-->
                                    <td>BREAK IT DOWN NOW</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCardMaterials[0].length !== 0">
                                    <th colspan="6"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{materialsTotalCost| currency}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>

                <!-- Misc Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_MISC_GENERAL') ?>">
                    <div class="form-items">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-col" ng-click="selectAllMiscItemsToggle(selectAllMisc)">
                                        <input class="select-all checkbox" type="checkbox" ng-model="selectAllMisc">
                                    </th>
                                    <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_CHARGE_OUT');                      ?></th>-->
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCardMiscItems[0].length === 0">
                                    <td colspan="6" class="alert-info">
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_MISC_GENERAL'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                    </td>
                                </tr>
                                <tr ng-if="loading">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span class="spinner-loader"></span>
                                    </td>
                                    <td></td>
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                </tr>
                                <tr ng-if="!loading && costCardMiscItems[0].length !== 0" ng-repeat="row in costCardMiscItems track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.dateEntered}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.cost| currency}}</td>
                                    <!--<td>{{row.chargeOut| currency}}</td>-->
                                    <td>{{row.breakdownReport}}</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCardMiscItems[0].length !== 0">
                                    <th colspan="3"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{miscTotalCost| currency}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>
                <!-- Purchase Orders Tab -->
                <uib-tab heading="<?php echo $this->getString('CLAIMS_PURCHASE_ORDERS') ?>">
                    <div class="form-items">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-col" ng-click="selectAllPurchaseOrdersToggle(selectAllPurchaseOrders)">
                                        <input class="select-all checkbox" type="checkbox" ng-model="selectAllPurchaseOrders">
                                    </th>
                                    <th><?php echo $this->getString('CLAIMS_PURCHASE_ORDER_NUMBER'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_ORDER_TYPE'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_SUBCONTRACTOR'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_PAYMENT_METHOD'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_SUBTOTAL'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_TAX'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_TOTAL'); ?></th>
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');       ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCardPurchaseOrders[0].length === 0">
                                    <td colspan="12" class="alert-info">
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_PURCHASE_ORDER'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_COST_CARD'); ?>
                                    </td>
                                </tr>
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
                                    <!--<td></td>-->
                                </tr>
                                <tr ng-if="!loading && costCardPurchaseOrders[0].length !== 0" ng-repeat="row in costCardPurchaseOrders track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.items_id}}</td>
                                    <td>{{row.creationDate}}</td>
                                    <td>{{row.ClaimPhases_id}}</td>
                                    <td>{{row.PurchaseOrderTypes_id}}</td>
                                    <td>{{row.Departments_id}}</td>
                                    <td>{{row.companyName}}</td>
                                    <td>{{row.AccountingPaymentMethods_id}}</td>
                                    <td>{{row.subtotal| currency}}</td>
                                    <td>{{row.tax| currency}}</td>
                                    <td>{{row.total| currency}}</td>
                                    <td>{{row.breakdownReport}}</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCardPurchaseOrders[0].length !== 0">
                                    <th colspan="7"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="1">{{purchaseOrdersSubtotal| currency}}</th>
                                    <th colspan="1">{{purchaseOrdersTax| currency}}</th>
                                    <th colspan="2">{{purchaseOrdersTotal| currency}}</th>
        <!--                            <th colspan="1">{{timesheetsTotalHours}}</th>-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>
            </uib-tabset>
            <button class="btn-primary pull-right" ng-click="saveDetails()"><?php echo $this->getString('SAVE'); ?></button>
            <button class="btn-primary pull-right" ng-click="getTotals()"><?php echo $this->getString('GET_TOTALS'); ?></button>
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndNew()"><?php // echo $this->getString('ACCOUNTING_SAVE_AND_NEW');                     ?></button>-->
            <!--<a href="../"><button class="btn-default save-purchase-order"><?php // echo $this->getString('ACCOUNTING_CANCEL');                    ?></button></a>-->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<form></form>