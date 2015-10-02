<!-- Timesheet Modal -->
<!--<form>-->
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New General Cost Item</h4>
    </div>
    <div class="modal-body">
        <div class="input-group">
            
            
            
            <label>Claim Number</label>
            <input placeholder="Claim Number" type="text" ng-model="search.query.claim" ng-model-options="{debounce:500}"
                   typeahead="value for value in fetchClaimAutocomplete($viewValue)"
                   typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control typeahead"
                   typeahead-min-length="2">
            <div class="resultspane" ng-show="noResults">
                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
            </div>
        </div>
        <div class="input-group">
            <label>Phase</label>
            <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="AccountingPhaseCodes_id">
                <?php foreach($AccountingPhaseCodes as $phase) {
                    echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                } ?>
            </select>
        </div>
        
        <div class="input-group">
            <label>Credit Account</label>
            <select class="credit-account form-control" name="AccountingCreditAccount_id" ng-model="AccountingCreditAccount_id">
                <?php foreach($CreditAccounts as $account) {
                    echo '<option value="' . $account['id'] . '">' . $account['name'] . '</option>';
                }?>
            </select>
        </div>
        
        <table class="table table-striped table-hover general-cost-items">
            <thead>
                <tr>
                    <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all" type="checkbox" ng-model="selectAll"></th>
                    <th><?php echo $this->getString('ACCOUNTING_NAME'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_DATE'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_COST'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_CHARGEOUT'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_DEBIT_ACCOUNT'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="row in generalCostItems track by $index">
                    <td>
                        <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"> 
                    </td>
                    <td>
                        <input placeholder="Staff Name" type="text" ng-model="row.name" ng-model-options="{debounce:500}"
                               typeahead="value for value in fetchStaffAutocomplete($viewValue)"
                               typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control typeahead"
                               typeahead-min-length="3">
                        <div class="resultspane" ng-show="noResults">
                            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
                        </div>
                    </td>
                    <td>
                        <input class="form-control" type="text" ng-model="row.description">
                    </td>
                    <td class="date-col">
                        <div class="input-group">
                            <input type="date" name="date{{$index}}" ng-model="advSearch.workDate" ng-model-options="{timezone: '+0000'}"
                                   class="form-control" datepicker-popup is-open="isOpen.datepicker[$index]"
                                   datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE');?>" />
                            <span class="input-group-btn" data-datepickername="date{{$index}}">
                                <button type="button" class="btn-default" data-datepickername="date{{$index}}" ng-click="openDatepicker($event, $index)">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </button>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </td>
                    <td>
                        <select class="credit-account form-control" name="departments" ng-model="row.department">
                            <?php foreach($Departments as $department) {
                                echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                            }?>
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" ng-model="row.cost">
                    </td>
                    <td>
                        <input class="form-control" type="text" ng-model="row.chargeout">
                    </td>
                    <td>
                        <input class="form-control" type="text" ng-model="row.debitAccount ">
                    </td>
                </tr>
            </tbody>
        </table>
        
        <button class="btn-info" ng-click="addRow()">New Row</button>
        <button class="btn-info" ng-click="insertRows()" ng-disabled="!rowSelected">Insert Row(s)</button>
        <button class="btn-warning" ng-click="removeRows()" ng-disabled="!rowSelected">Delete Row(s)</button>
        
        <div class="line-items">
            <h5>Line Items</h5>
            <input placeholder="Staff Name" type="text" ng-model="search.query.name" ng-model-options="{debounce:500}"
                   typeahead="value for value in fetchStaffAutocomplete($viewValue)"
                   typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control typeahead"
                   typeahead-min-length="3">
            <div class="resultspane" ng-show="noResults">
                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('ACCOUNTING_NO_RESULTS') ?>
            </div>
        </div>
    </div>
<!--</form>-->