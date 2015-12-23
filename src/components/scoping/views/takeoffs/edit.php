<div class="widget" ng-controller="scopingTakeoffsEditCtrl as vm">
    <!--<div class="widgetheader">-->
    <h1 class="pull-left"><?php echo $this->getString('SCOPING_MATERIAL_TAKE_OFF') ?></h1>
    <!--</div>-->
    <div class="toolbar form-inline">
        <button class="btn-primary" ng-click="vm.addRow()"><?php echo $this->getString('SAVE'); ?></button>
    </div>
    <input type="hidden" value="<?php echo $Claims_id; ?>" id="Claims_id" />
    <input type="hidden" value="<?php echo $ClaimsLocations_id; ?>" id="ClaimsLocations_id" />
    <div class="clearfix"></div>
    <div ng-if="vm.loading">
        <div class="text-center"><span class="spinner-loader"></span></div>
    </div>
    <div ng-if="!vm.loading">
        <!--        <uib-tabset>
                    <uib-tab heading="vmlocation.unitNumber">-->

        <button class="btn-info" ng-click="vm.addRow()"><?php echo $this->getString('SCOPING_NEW_ROW'); ?></button>
        <button class="btn-info" ng-click="vm.insertRows()" ng-disabled="!vm.rowSelected"><?php echo $this->getString('SCOPING_INSERT_ROWS'); ?></button>
        <button class="btn-warning" ng-click="vm.removeRows()" ng-disabled="!vm.rowSelected"><?php echo $this->getString('SCOPING_DELETE_ROWS'); ?></button>
        <div class="divider"></div>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
<!--                    <th>
                    <?php // echo $this->getString('SCOPING_UNIT') ?>
                    </th>-->
                    <th class="select-col" ng-click="vm.selectAllToggle(vm.selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="vm.selectAll"></th>
                    <th>
                        <?php echo $this->getString('SCOPING_INSULATION') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_VAPOUR_BARRIER') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_DRYWALL') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_CORNER_BEAD') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_J_BEAD') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_BASE_BOARD') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_COVE') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_CASING') ?>
                    </th>
                    <th>
                        <?php echo $this->getString('SCOPING_OTHER') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in vm.lineItems track by $index">
<!--                    <td class="table-title-column">
                        <div class="form-group">
                            {{item.name}}
                        </div>
                    </td>-->
                    <td class="select-col"><input class="checkbox" type="checkbox" ng-model="item.isSelected"  ng-click="vm.checkSelected()"></td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['insulation'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['vapourBarrier'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['drywall'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['cornerBead'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['jBead'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['baseboard'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['cove'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['casing'] ?>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <?php echo $form['other'] ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--        </uib-tab>
                </uib-tabset>-->
    </div>
    <div class="clearfix"></div>
</div>