<!-- Timesheet Modal -->
<!--<form>-->
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Inventory Item</h4>
    </div>
    <div class="modal-body general-costs-modal">
        
        <div id="item-headings">
            <div class="input-group">
                <label>Claim Number</label>
                <input placeholder="Claim Number" type="text" ng-model="headings.jobNumber" ng-model-options="{debounce:100}"
                       typeahead="value for value in fetchClaimAutocomplete($viewValue)"
                       typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsClaim" class="form-control typeahead"
                       typeahead-min-length="2" ng-blur="getClaimsID(headings.jobNumber)">
                <div class="resultspane claim-number" ng-show="noResultsClaim">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                </div>
            </div>
            <div class="input-group">
                <label>Phase</label>
                <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="headings.ClaimPhases_id">
                    <option value="" selected>-Phase Code-</option>
                    <?php foreach($AccountingPhaseCodes as $phase) {
                        echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                    } ?>
                </select>
            </div>

            <div class="input-group date-input">
                <label>Date</label>
                <input type="date" name="date{{$index}}" ng-model="headings.dateEntered" ng-model-options="{timezone: '+0000'}"
                       class="form-control" datepicker-popup is-open="isOpen.datepicker"
                       datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE');?>" />
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
                    <th><?php echo $this->getString('ACCOUNTING_NAME'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_UNIT_OF_MEASURE'); ?></th>
<!--                    <th><?php// echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>-->
                    <th><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></th>
<!--                    <th class="date-col"><?php// echo $this->getString('ACCOUNTING_DATE'); ?></th>-->
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
                </tr>
                <tr ng-repeat="row in lineItems track by $index">
                    <td>
                        <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"> 
                    </td>
                    <td>
<!--                        <input placeholder="Material Name" class="form-control" type="text" ng-model="row.name">                      -->
                        <div class="input-group">
                            <input placeholder="Material Name" type="text" ng-model="row.materialName" ng-model-options="{debounce:100}"
                                   typeahead="value for value in fetchMaterialsAutocomplete($viewValue)"
                                   typeahead-loading="loadingTypeahead" typeahead-no-results="noResultsMaterials" class="form-control typeahead"
                                   typeahead-min-length="2" ng-blur="getMaterialInfo(row.materialName)">
                            <div class="resultspane claim-number" ng-show="noResultsMaterials">
                                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                            </div>
                        </div>
                    </td>
                    <td>
<!--                        <input placeholder="Unit of Measure" class="form-control" type="text" ng-model="row.unitMeasure">-->
                        <select class="department form-control" name="unitMeasure" ng-model="row.unitMeasure">
                            <option value="" selected>-Unit of Measure-</option>
                            <?php foreach($PackageTypes as $type) {
                                pr($PackageTypes);
                                echo '<option value="' . $type['id'] . '">' . $type['name'] . '</option>';
                            }?>
                        </select>
                    </td>                    
<!--
                    <td>
                        <input placeholder="Description" class="form-control" type="text" ng-model="row.description">                      
                    </td>
-->                    
                    <td>
                        <select class="department form-control" name="departments" ng-model="row.Departments_id">
                            <option value="" selected>-Department-</option>
                            <?php foreach($Departments as $department) {
                                echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                            }?>
                        </select>
                    </td>
                    
<!--
                    <td class="date-col">
                        <div class="input-group">
                            <input type="date" name="date{{$index}}" ng-model="row.dateEntered" ng-model-options="{timezone: '+0000'}"
                                   class="form-control" datepicker-popup is-open="isOpen.datepicker[$index]"
                                   datepicker-options="dateOptions" close-text="<?php// echo $this->getString('ACCOUNTING_CLOSE');?>" />
                            <span class="input-group-btn" data-datepickername="date{{$index}}">
                                <button type="button" class="btn-default" data-datepickername="date{{$index}}" ng-click="openDatepicker($event, $index)">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </td>
-->
                    
                    <td>
                        <input placeholder="Price" class="form-control cost" type="number" ng-model="row.unitPrice" ng-change="updateCost(row);updateTotal();">
                    </td>
                    <td>
                        <input placeholder="Qty" class="form-control cost" type="number" ng-model="row.qty" ng-change="updateCost(row);updateTotal();">
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
<!--                    <td></td>-->
                    <td>Total:</td>
                    <td>{{total.cost}}</td>
                    <td>{{total.chargeout}}</td>


                </tr>
            </tbody>
        </table>
        
        <button class="btn-info" ng-click="addRow()">New Row</button>
        <button class="btn-info" ng-click="insertRows()" ng-disabled="!rowSelected">Insert Row(s)</button>
        <button class="btn-warning" ng-click="removeRows()" ng-disabled="!rowSelected">Delete Row(s)</button>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="saveGeneralCostItems(); clearModal()">Save and New</button>
        <button type="button" class="btn btn-primary" ng-click="saveGeneralCostItems()">Save and Close</button>
    </div>
<form class="hidden"></form>
<!--</form>-->