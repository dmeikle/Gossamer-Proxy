<?php $params = $this->httpRequest->getParameters(); ?>

<input type="hidden" id="Claims_id" value="<?php echo $params[0]; ?>" />
<input type="hidden" id="CostCards_id" value="<?php echo $params[1]; ?>" />

<div ng-controller="costCardEditCtrl">
    <div class="widget" >
        <div class="widget-content">

            <h1 class="pull-left">
                <span ng-if="!editing"><?php echo $this->getString('NEW') ?></span>
                <span ng-if="editing"><?php echo $this->getString('EDIT') ?></span>
                <?php echo $this->getString('CLAIMS_COST_CARD') ?>
            </h1>
            <div class="toolbar form-inline">
                <!--<button class="btn-primary" ng-click="approveItems()"><?php // echo $this->getString('CLAIMS_APPROVE');                                                                                                   ?></button>-->
                <div class="btn-group" uib-dropdown>
                    <button id="split-button" type="button" class="btn btn-primary"  ng-click="disapproveSelected()">
                        <?php echo $this->getString('CLAIMS_DISAPPROVE_SELECTED'); ?>
                    </button>
                    <button type="button" class="btn btn-primary" uib-dropdown-toggle>
                        <span class="caret"></span>
                        <!--<span class="sr-only"><?php // echo $this->getString('CLAIMS_APPROVE_SELECTED');                                                                                                   ?></span>-->
                    </button>
                    <ul class="uib-dropdown-menu pull-right row-controls" role="menu" aria-labelledby="split-button">
                        <li role="menuitem"><a ng-click="assignSelected();"><?php echo $this->getString('CLAIMS_ASSIGN_SELECTED'); ?></a></li>
                        <li role="menuitem"><a href="#"><?php echo $this->getString('CLAIMS_GENERATE_BREAKDOWN_REPORT'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>

            <div ng-if="loading" class="col-md-12 spacer">
                <span class="spinner-loader"></span>
            </div>
            <div ng-if="!loading">
                <div  class="col-md-4">
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
                                    <div class="card-content" ng-if="costCard.timesheets[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_TIMESHEET_COUNT') ?>: </strong>{{costCard.timesheets.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_HOURS') ?>: </strong>{{timesheetsTotalHours}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{timesheetsTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCard.timesheets[0].length === 0">
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
                                    <div class="card-content" ng-if="costCard.eqUsed[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_EQUIPMENT_COUNT') ?>: </strong>{{costCard.eqUsed.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{equipmentTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCard.eqUsed[0].length === 0">
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
                                    <div class="card-content" ng-if="costCard.inventoryUsed[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_MATERIALS_COUNT') ?>: </strong>{{costCard.inventoryUsed.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{materialsTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCard.inventoryUsed[0].length === 0">
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
                                    <div class="card-content" ng-if="costCard.miscUsed[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_MISC_COUNT') ?>: </strong>{{costCard.miscUsed.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{miscTotalCost| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCard.miscUsed[0].length === 0">
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
                                    <div class="card-content" ng-if="costCard.purchaseOrders[0].length !== 0">
                                        <p><strong><?php echo $this->getString('CLAIMS_PURCHASE_ORDER_COUNT') ?>: </strong>{{costCard.purchaseOrders.length}}</p>
                                        <p><strong><?php echo $this->getString('CLAIMS_TOTAL_COST') ?>: </strong>{{purchaseOrdersTotal| currency}}</p>
                                    </div>
                                    <div class="card-content" ng-if="costCard.purchaseOrders[0].length === 0">
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_CATEGORY');                                                                                           ?></th>-->
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');                                                                                  ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCard.timesheets[0].length === 0">
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
                                <tr ng-if="!loading && costCard.timesheets[0].length !== 0" ng-repeat="row in costCard.timesheets track by $index">
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
                                    <td>breakdown</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCard.timesheets[0].length !== 0 && costCard.timesheets.length !== 0">
                                    <th colspan="5"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsRegHours}}</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsOTHours}}</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsDOTHours}}</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsSRegHours}}</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsSOTHours}}</th>
                                    <th ng-if="showHours" class="cell-border" colspan="1">{{timesheetsSDOTHours}}</th>
                                    <th colspan="1">{{timesheetsTotalHours}}
                                        <span ng-if="!showHours" ng-click="toggleHours()" class="glyphicon glyphicon-plus expand-btn"></span>
                                        <span ng-if="showHours" ng-click="toggleHours()" class="glyphicon glyphicon-minus expand-btn"></span>
                                    </th>
                                    <th colspan="2">{{timesheetsTotalCost| currency}}</th>
                                </tr>
                                <tr ng-if="!editing">
                                    <th class="select-col"><input class="checkbox" type="checkbox" ng-model="selectUnassigned.timesheets" ng-click="selectAllUnassigned('timesheets', selectUnassigned.timesheets)"></th>
                                    <th colspan="8" ng-if="!showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                    <th colspan="14" ng-if="showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                </tr>
                                <tr ng-if="!editing && !loading" ng-repeat="row in unassignedItems.timesheets">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkUnassignedSelected('timesheets', row.isSelected)"></td>
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
                                    <td>-</td>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.timesheets[0].length === 0 || !editing && !loading && unassignedItems.timesheets.length === 0">
                                    <td ng-if="!showHours" colspan="9" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_TIMESHEET'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
                                    <td ng-if="showHours" colspan="15" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_TIMESHEET'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');                                                                                            ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCard.eqUsed[0].length === 0">
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
                                <tr ng-if="!loading && costCard.eqUsed[0].length !== 0" ng-repeat="row in costCard.eqUsed track by $index">
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
                                <tr ng-if="!loading && costCard.eqUsed[0].length !== 0 && costCard.eqUsed.length !== 0">
                                    <th colspan="7"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{equipmentTotalCost| currency}}</th>
                                </tr>

                                <!--Unassigned equipment items-->
                                <tr ng-if="!editing">
                                    <th class="select-col"><input class="checkbox" type="checkbox" ng-model="selectUnassigned.equipment" ng-click="selectAllUnassigned('eqUsed', selectUnassigned.equipment)"></th>
                                    <th colspan="9" ng-if="!showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.eqUsed[0].length !== 0" ng-repeat="row in unassignedItems.eqUsed">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkUnassignedSelected('eqUsed', row.isSelected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.transferDate}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.category}}</td>
                                    <td>{{row.number}}</td>
                                    <td>{{row.numDays}}</td>
                                    <td>{{row.maxDays}}</td>
                                    <td>{{row.price| currency}}</td>
                                    <td>-</td>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.eqUsed[0].length === 0 || !editing && !loading && unassignedItems.eqUsed.length === 0">
                                    <td colspan="10" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_EQUIPMENT'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_CHARGE_OUT');                                                                                                             ?></th>-->
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');                                                                                            ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCard.inventoryUsed[0].length === 0">
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
                                <tr ng-if="!loading && costCard.inventoryUsed[0].length !== 0" ng-repeat="row in costCard.inventoryUsed track by $index">
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
                                <tr ng-if="!loading && costCard.inventoryUsed[0].length !== 0 && costCard.inventoryUsed.length !== 0">
                                    <th colspan="6"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{materialsTotalCost| currency}}</th>
                                </tr>

                                <!--Unassigned material items-->
                                <tr ng-if="!editing">
                                    <th class="select-col"><input class="checkbox" type="checkbox" ng-model="selectUnassigned.material" ng-click="selectAllUnassigned('inventoryUsed', selectUnassigned.material)"></th>
                                    <th colspan="8" ng-if="!showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.inventoryUsed[0].length !== 0" ng-repeat="row in unassignedItems.inventoryUsed">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkUnassignedSelected('inventoryUsed', row.isSelected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.dateUsed}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.category}}</td>
                                    <td>{{row.department}}</td>
                                    <td>{{row.productCode}}</td>
                                    <td>{{row.cost| currency}}</td>
                                    <!--<td>{{row.chargeout}}</td>-->
                                    <td>-</td>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.inventoryUsed[0].length === 0 || !editing && !loading && unassignedItems.inventoryUsed.length === 0">
                                    <td colspan="9" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_MATERIAL'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_CHARGE_OUT');                                                                                                           ?></th>-->
                                    <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');                                                                                            ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCard.miscUsed[0].length === 0">
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
                                <tr ng-if="!loading && costCard.miscUsed[0].length !== 0" ng-repeat="row in costCard.miscUsed track by $index">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.dateEntered}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.cost| currency}}</td>
                                    <!--<td>{{row.chargeOut| currency}}</td>-->
                                    <td>{{row.breakdownReport}}</td>
                                    <!--<td>{{row.statusType}}</td>-->
                                </tr>
                                <tr ng-if="!loading && costCard.miscUsed[0].length !== 0 && costCard.miscUsed.length !== 0">
                                    <th colspan="3"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="2">{{miscTotalCost| currency}}</th>
                                </tr>
                                <!--Unassigned Misc items-->
                                <tr ng-if="!editing">
                                    <th class="select-col"><input class="checkbox" type="checkbox" ng-model="selectUnassigned.miscItems" ng-click="selectAllUnassigned('miscUsed', selectUnassigned.miscItems)"></th>
                                    <th colspan="5" ng-if="!showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.miscUsed[0].length !== 0" ng-repeat="row in unassignedItems.miscUsed">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkUnassignedSelected('miscUsed', row.isSelected)"></td>
                                    <td>{{row.name}}</td>
                                    <td>{{row.dateEntered}}</td>
                                    <td>{{row.phase}}</td>
                                    <td>{{row.cost| currency}}</td>
                                    <!--<td>{{row.chargeOut| currency}}</td>-->
                                    <td>-</td>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.miscUsed[0].length === 0 || !editing && !loading && unassignedItems.miscUsed.length === 0">
                                    <td colspan="6" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_MISC_GENERAL'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
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
                                    <!--<th><?php // echo $this->getString('CLAIMS_APPROVED');                                                                                            ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-if="!loading && costCard.purchaseOrders[0].length === 0">
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
                                <tr ng-if="!loading && costCard.purchaseOrders[0].length !== 0" ng-repeat="row in costCard.purchaseOrders track by $index">
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
                                <tr ng-if="!loading && costCard.purchaseOrders[0].length !== 0 && costCard.purchaseOrders">
                                    <th colspan="7"></th>
                                    <th colspan="1" class="align-right"><?php echo $this->getString('CLAIMS_TOTAL'); ?>:</th>
                                    <th colspan="1">{{purchaseOrdersSubtotal| currency}}</th>
                                    <th colspan="1">{{purchaseOrdersTax| currency}}</th>
                                    <th colspan="2">{{purchaseOrdersTotal| currency}}</th>
        <!--                            <th colspan="1">{{timesheetsTotalHours}}</th>-->
                                </tr>
                                <!-- Unassigned Purchase Orders -->
                                <tr ng-if="!editing">
                                    <th class="select-col"><input class="checkbox" type="checkbox" ng-model="selectUnassigned.purchaseOrders" ng-click="selectAllUnassigned('purchaseOrders', selectUnassigned.purchaseOrders)"></th>
                                    <th colspan="11" ng-if="!showHours"><?php echo $this->getString('CLAIMS_UNASSIGNED_ITEMS'); ?></th>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.purchaseOrders[0].length !== 0" ng-repeat="row in unassignedItems.purchaseOrders">
                                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkUnassignedSelected('purchaseOrders', row.isSelected)"></td>
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
                                    <td>-</td>
                                </tr>
                                <tr ng-if="!editing && !loading && unassignedItems.purchaseOrders[0].length === 0 || !editing && !loading && unassignedItems.purchaseOrders.length === 0">
                                    <td colspan="12" class="alert-success">
                                        <?php echo $this->getString('CLAIMS_NO_UNASSIGNED_ITEMS_MESSAGE_START'); ?>
                                        <?php echo $this->getString('CLAIMS_PURCHASE_ORDER'); ?>
                                        <?php echo $this->getString('CLAIMS_NO_ITEMS_MESSAGE_END'); ?>
                                        <?php echo $this->getString('CLAIMS_CLAIM'); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </uib-tab>
            </uib-tabset>
            <button class="btn-primary pull-right" ng-click="save()"><?php echo $this->getString('SAVE'); ?></button>
<!--            <button class="btn-primary pull-right" ng-click="getTotals()"><?php // echo $this->getString('GET_TOTALS');      ?></button>-->
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndNew()"><?php // echo $this->getString('ACCOUNTING_SAVE_AND_NEW');                                                                                                          ?></button>-->
            <!--<a href="../"><button class="btn-default save-purchase-order"><?php // echo $this->getString('ACCOUNTING_CANCEL');                                                                                                         ?></button></a>-->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<form></form>