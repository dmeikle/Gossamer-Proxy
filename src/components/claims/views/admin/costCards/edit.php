<div ng-controller="costCardCtrl">
    <div class="widget" >
        <div class="widget-content">
            <h1 class="pull-left"><?php echo $this->getString('CLAIMS_COST_CARD') ?></h1>
            <div class="toolbar form-inline">
                <button class="btn-primary" ng-click="approveItems()"><?php echo $this->getString('CLAIMS_APPROVE'); ?></button>
            </div>

            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_LABORER') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CHARGE_OUT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DETAILS'); ?></th>
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
                            <td>{{row.cost| currency}}</td>
                            <td>{{row.chargeout}}</td>
                            <td>{{row.category}}</td>
                            <td>{{row.department}}</td>
                            <td>BREAK IT DOWN NOW</td>
                            <td>{{row.totalHours}} hours @ rate</td>
                            <td>{{row.isDeptApproved}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-items">
                <h4 colspan="12"><?php echo $this->getString('CLAIMS_EQUIPMENT') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_COST'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CHARGE_OUT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_CATEGORY'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DEPARTMENT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_BREAKDOWN'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DETAILS'); ?></th>
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
                            <td>{{row.lastname}}, {{row.firstname}}</td>
                            <td>{{row.description}}</td>
                            <td>{{row.dateUsed}}</td>
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

            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_MATERIAL') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DESCRIPTION'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
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
                        <tr ng-if="!loading" ng-repeat="row in costCardMaterials track by $index">
                            <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                            <td>{{row.lastname}}, {{row.firstname}}</td>
                            <td>{{row.description}}</td>
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

            <div class="form-items">
                <h4><?php echo $this->getString('CLAIMS_MISC_GENERAL') ?></h4>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DESCRIPTION'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_DATE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
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
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndClose()"><?php //echo $this->getString('CLAIMS_SAVE_AND_CLOSE');                                               ?></button>-->
            <!--<button class="btn-primary save-purchase-order" ng-click="saveAndNew()"><?php // echo $this->getString('ACCOUNTING_SAVE_AND_NEW');                                              ?></button>-->
            <!--<a href="../"><button class="btn-default save-purchase-order"><?php // echo $this->getString('ACCOUNTING_CANCEL');                                              ?></button></a>-->
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<form></form>