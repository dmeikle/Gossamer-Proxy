<div ng-controller="costCardCtrl">
    <div class="widget" >
        <div class="widget-content">
            <h1 class="pull-left"><?php echo $this->getString('CLAIMS_COST_CARD') ?></h1>
            <div class="toolbar form-inline">
                <!--<button class="btn-primary" ng-click="approveItems()"><?php // echo $this->getString('CLAIMS_APPROVE');                          ?></button>-->
                <div class="btn-group" uib-dropdown>
                    <button id="split-button" type="button" class="btn btn-primary"><?php echo $this->getString('CLAIMS_APPROVE'); ?></button>
                    <button type="button" class="btn btn-primary" uib-dropdown-toggle>
                        <span class="caret"></span>
                        <span class="sr-only"><?php echo $this->getString('CLAIMS_APPROVE'); ?></span>
                    </button>
                    <ul class="uib-dropdown-menu cog-col  pull-right row-controls" role="menu" aria-labelledby="split-button">
                        <li role="menuitem"><a href="#"><?php echo $this->getString('CLAIMS_APPROVE'); ?></a></li>
                        <li role="menuitem"><a href="#"><?php echo $this->getString('CLAIMS_UNAPPROVE'); ?></a></li>
                    </ul>
                </div>

            </div>
            <!-- Laborers / Timesheets -->
            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_LABORER') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_EXPORTED'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_HOURLY_RATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_TOTAL_HOURS'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_APPROVED'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="row in costCardTimesheets track by $index">
                            <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                            <td>{{row.lastname}}, {{row.firstname}}</td>
                            <td>{{row.date}}</td>
                            <td>{{row.phase}}</td>
                            <td>{{row.category}}</td>
                            <td>{{row.department}}</td>
                            <td>{{row.isExported}}</td>
                            <td>{{row.totalHours}}</td>
                            <td>{{row.hourlyRate| currency}}</td>
                            <td>BREAK IT DOWN NOW</td>
                            <td>{{row.isDeptApproved}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Equipment -->
            <div class="form-items">
                <h4 colspan="12"><?php echo $this->getString('CLAIMS_EQUIPMENT') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_NUMBER'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_NUM_DAYS'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_MAX_DAYS'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PRICE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_APPROVED'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="row in costCardEquipment track by $index">
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
                            <td>{{row.status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Materials -->
            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_MATERIAL') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PRODUCT_CODE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CHARGE_OUT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_APPROVED'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="row in costCardMaterials track by $index">
                            <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                            <td>{{row.name}}</td>
                            <td>{{row.dateUsed}}</td>
                            <td>{{row.phase}}</td>
                            <td>{{row.category}}</td>
                            <td>{{row.department}}</td>
                            <td>{{row.productCode}}</td>
                            <td>{{row.cost| currency}}</td>
                            <td>{{row.chargeout}}</td>
                            <td>BREAK IT DOWN NOW</td>
                            <td>{{row.isDeptApproved}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Misc -->
            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_MISC_GENERAL') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DESCRIPTION'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CHARGE_OUT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_APPROVED'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="row in costCardGeneral track by $index">
                            <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                            <td>{{row.lastname}}, {{row.firstname}}</td>
                            <td>N/A</td>
                            <td>{{row.date}}</td>
                            <td>{{row.phase}}</td>
                            <td>{{row.cost| currency}}</td>
                            <td>{{row.chargeout}}</td>
                            <td>{{row.category}}</td>
                            <td>{{row.department}}</td>
                            <td>BREAK IT DOWN NOW</td>
                            <td>{{row.isDeptApproved}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndClose()"><?php //echo $this->getString('CLAIMS_SAVE_AND_CLOSE');                                                                        ?></button>-->
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndNew()"><?php // echo $this->getString('ACCOUNTING_SAVE_AND_NEW');                                                                       ?></button>-->
            <!--<a href="../"><button class="btn-default save-purchase-order"><?php // echo $this->getString('ACCOUNTING_CANCEL');                                                                       ?></button></a>-->
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<form></form>