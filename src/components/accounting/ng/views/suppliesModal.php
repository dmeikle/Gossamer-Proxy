<!-- Supplies Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $this->getString('ACCOUNTING_NEW_MATERIAL_FROM_STOCK') ?></h4>
</div>
<div class="modal-body general-costs-modal">

    <div id="item-headings">

        <div class="input-group">
            <label><?php echo $this->getString('ACCOUNTING_STAFF_NAME') ?></label>
            <input placeholder="<?php echo $this->getString('ACCOUNTING_STAFF_NAME') ?>" type="text" ng-model="headings.staffName" typeahead-wait-ms="500"
                   uib-typeahead="value as value.firstname + ' ' + value.lastname for value in fetchStaffAutocomplete($viewValue)"
                   typeahead-loading="loadingTypeaheadStaff" typeahead-no-results="noResultsStaff" class="form-control typeahead"
                   typeahead-min-length="3" typeahead-on-select="getStaffID(headings.staffName)">
            <i ng-show="loadingTypeaheadStaff" class="glyphicon glyphicon-refresh"></i>
            <div class="resultspane" ng-show="noResultsStaff">
                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
            </div>
        </div>

        <div class="input-group">
            <label><?php echo $this->getString('ACCOUNTING_JOB_NUMBER') ?></label>
            <input placeholder="<?php echo $this->getString('ACCOUNTING_JOB_NUMBER') ?>" type="text" ng-model="headings.jobNumber" typeahead-wait-ms="500"
                   uib-typeahead="value as value.jobNumber for value in fetchClaimAutocomplete($viewValue)"
                   typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsClaim" class="form-control typeahead"
                   typeahead-min-length="2" typeahead-on-select="getClaimsID(headings.jobNumber)">
            <div class="resultspane claim-number" ng-show="noResultsClaim">
                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
            </div>
        </div>
        <div class="input-group">
            <label><?php echo $this->getString('ACCOUNTING_PHASE_CODE') ?></label>
            <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="headings.ClaimPhases_id">
                <option value="" selected>-<?php echo $this->getString('ACCOUNTING_PHASE_CODE') ?>-</option>
                <?php
                foreach ($AccountingPhaseCodes as $phase) {
                    echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="input-group">
            <label><?php echo $this->getString('ACCOUNTING_DEPARTMENT') ?></label>
            <select class="department form-control" name="unitMeasure" ng-model="headings.Departments_id">
                <option value="" selected>-<?php echo $this->getString('ACCOUNTING_DEPARTMENT') ?>-</option>
                <?php
                foreach ($Departments as $department) {
                    echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="input-group">
            <label><?php echo $this->getString('ACCOUNTING_CLAIM_LOCATION') ?></label>
            <select class="form-control" name="ClaimsLocations_id" ng-model="headings.ClaimsLocations_id" ng-options="obj.id as obj.unitNumber for obj in claimsLocations">
                <option value="" selected>-<?php echo $this->getString('ACCOUNTING_CLAIM_LOCATION') ?>-</option>
            </select>
        </div>

        <div class="input-group date-input">
            <label><?php echo $this->getString('ACCOUNTING_DATE') ?></label>
            <input type="date" name="date{{$index}}" ng-model="headings.dateUsed" ng-model-options="{timezone: '+0000'}"
                   class="form-control" datepicker-popup is-open="isOpen.datepicker"
                   datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
            <span class="input-group-btn" data-datepickername="date{{$index}}">
                <button type="button" class="btn-default" data-datepickername="date{{$index}}" ng-click="openDatepicker($event, $index)">
                    <i class="glyphicon glyphicon-calendar"></i>
                </button>
            </span>
            <div class="clearfix"></div>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all" type="checkbox" ng-model="selectAll"></th>
                <th><?php echo $this->getString('ACCOUNTING_PRODUCT_CODE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_NAME'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_UNIT_OF_MEASURE'); ?></th>
                <th class="cost-col"><?php echo $this->getString('ACCOUNTING_UNIT_PRICE'); ?></th>
                <th class="quantity-col"><?php echo $this->getString('ACCOUNTING_QUANTITY'); ?></th>
                <th class="cost-col"><?php echo $this->getString('ACCOUNTING_COST'); ?></th>
                <th class="cost-col"><?php echo $this->getString('ACCOUNTING_CHARGEOUT'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-if="loading">
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
            </tr>
            <tr ng-repeat="row in lineItems track by $index">
                <td>
                    <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)">
                </td>
                <td class="typeahead-col">
                    <div class="input-group">
                        <input placeholder="<?php echo $this->getString('ACCOUNTING_PRODUCT_CODE') ?>" type="text" ng-model="row.productCode" typeahead-wait-ms="500"
                               uib-typeahead="value as value.productCode for value in fetchProductCodeAutocomplete($viewValue)"
                               typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsProductCode" class="form-control typeahead"
                               typeahead-min-length="2" typeahead-on-select="getProductCodeInfo(row, row.productCode)">
                        <div class="resultspane claim-number" ng-show="noResultsProductCode">
                            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                        </div>
                    </div>
                </td>
                <td class="typeahead-col">
                    <div class="input-group">
                        <input placeholder="<?php echo $this->getString('ACCOUNTING_MATERIAL_NAME') ?>" type="text" ng-model="row.name" typeahead-wait-ms="500"
                               uib-typeahead="value as value.name for value in fetchMaterialsAutocomplete($viewValue)"
                               typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsMaterials" class="form-control typeahead"
                               typeahead-min-length="2" typeahead-on-select="getMaterialNameInfo(row, row.name)">
                        <div class="resultspane claim-number" ng-show="noResultsMaterials">
                            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                        </div>
                    </div>
                </td>
                <td>
                    <select class="department form-control" name="unitMeasure" ng-model="row.PackageTypes_id">
                        <option value="" selected>-<?php echo $this->getString('ACCOUNTING_UNIT_OF_MEASURE') ?>-</option>
                        <?php
                        foreach ($PackageTypes as $type) {
                            echo '<option value="' . $type['id'] . '">' . $type['name'] . '</option>';
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <input placeholder="Price" class="form-control cost" type="number" ng-model="row.unitPrice" ng-change="updateCost(row);
                                updateTotal();">
                </td>
                <td>
                    <input placeholder="Qty" class="form-control cost" type="number" ng-model="row.quantity" ng-change="updateCost(row);
                                updateTotal();">
                </td>

                <td>
                    <input placeholder="Cost" class="form-control cost" type="number" ng-model="row.cost" ng-change="updateTotal()">
                </td>
                <td>
                    <input placeholder="Chargeout" class="form-control chargeout" type="number" ng-model="row.chargeOut" ng-change="updateTotal()">
                </td>
            </tr>
            <tr class="totalRow">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $this->getString('ACCOUNTING_TOTAL') ?>:</td>
                <td>{{total.cost}}</td>
                <td>{{total.chargeOut}}</td>
            </tr>
        </tbody>
    </table>

    <button class="btn-info" ng-click="addRow()"><?php echo $this->getString('ACCOUNTING_NEW_ROW') ?></button>
    <button class="btn-info" ng-click="insertRows()" ng-disabled="!rowSelected"><?php echo $this->getString('ACCOUNTING_INSERT_ROWS') ?></button>
    <button class="btn-warning" ng-click="removeRows();
        updateTotal();" ng-disabled="!rowSelected"><?php echo $this->getString('ACCOUNTING_DELETE_ROWS') ?></button>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" ng-click="cancel()"><?php echo $this->getString('ACCOUNTING_CANCEL') ?></button>
    <button type="button" class="btn btn-primary" ng-click="save();
        clearModal()"><?php echo $this->getString('ACCOUNTING_SAVE_AND_NEW') ?></button>
    <button type="button" class="btn btn-primary" ng-click="save();
        confirm();"><?php echo $this->getString('ACCOUNTING_SAVE_AND_CLOSE') ?></button>
</div>
<form class="hidden"></form>