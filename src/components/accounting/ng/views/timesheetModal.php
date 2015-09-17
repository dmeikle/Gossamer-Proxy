<!-- Add New Timesheet Modal -->
<!--
<div class="modal fade" id="new-timesheet" tabindex="-1" role="dialog" aria-labelledby="newTimesheet" ng-controller="timesheetListCtrl">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
-->
<form>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add/Edit Timesheet</h4>
    </div>
    <div class="modal-body">
        
<!--
        <div class="laborer">
            Laborer:
            <input class="form-control" type="text" list="timesheet-autocomplete-list" ng-model="basicSearch.val[0]" ng-blur="search()">
            <datalist id="timesheet-autocomplete-list" ng-click="setCategory(basicSearch)">
                <option ng-if="!autocomplete.length > 0" value="">Loading</option>
                <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
            </datalist>           
        </div>
-->
        <div class="pull-left">
            <div class="form-group laborer">
                <label for="timesheet-laborer"><?php echo $this->getString('ACCOUNTING_LABORER'); ?></label>
                <input name="timesheet-laborer" class="form-control" type="text" list="timesheet-autocomplete-list" ng-model="laborer" ng-blur="search()">
                <datalist id="timesheet-autocomplete-list" ng-click="setCategory(basicSearch)">
                    <option ng-if="!autocomplete.length > 0" value="">Loading</option>
                    <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                </datalist> 
            </div>
        </div>
        <div class="pull-right">
            <div class="form-group date">
                <label for="timesheet-date"><?php echo $this->getString('ACCOUNTING_DATE'); ?></label>
                <input class="form-control" type="date" name="timesheet-date" id="timesheet-date" ng-model="timesheetDate">
            </div>
            <div class="form-group vehicle">
                <label for="vehicle-num"><?php echo $this->getString('ACCOUNTING_VEHICLE_NUMBER'); ?></label>
                <select class="form-control" name="vehicle-num" ng-model="vehicleNumber" ng-change="getVehicleTolls(vehicleNumber)">
                    <?php
                    //pr($Vehicles);    

                    foreach($Vehicles as $vehicle) {
                        echo '<option value="' . $vehicle['id'] . '">' . $vehicle['number'] . ' ' . $vehicle['licensePlate'] . '</option>';
                    } ?>
                </select>
            </div>
        </div>

    <!--
        <div class="total-hours">
            Total Hours
        </div>
    -->

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all" type="checkbox" ng-model="selectAll"></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_CLAIM'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_PHASE'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_CATEGORY'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_DESCRIPTION'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_TOLL1'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_TOLL2'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_REGULAR_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_OVERTIME_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_DOUBLE_OT_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_STAT_REGULAR_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_STAT_OVERTIME_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_STAT_DOUBLE_OT_HOURS'); ?></th>
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_TOTAL_HOURS'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-if="loading">
                    <td></td>
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
                    <td></td>
                    <td></td>
                </tr>
                
                <tr ng-if="!loading" ng-repeat="row in timesheet track by $index">
                    <td>
                        <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)">
                    </td>
                    <td>
                        <input class="claim form-control" type="text" ng-model="row.jobNumber" list="timesheet-claims-list" ng-change="watchClaims(row)" ng-model-options="{ debounce: 500 }" ng-blur="clearClaimsList(row)">
                        <datalist id="timesheet-claims-list">
                            <option ng-if="!claimsAutocomplete.length > 0" value="">Loading</option>
                            <option ng-repeat="value in claimsAutocomplete" value="{{value.label}}" data="{{value.id}}"></option>
                        </datalist>
                    </td>
                    <td>
                        <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="row.AccountingPhaseCodes_id">
                            <?php foreach($AccountingPhaseCodes as $phase) {
                                echo '<option value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                               } ?>
                        </select>
                    </td>
                    <td>
                        <select class="category form-control" name="StaffTypes_id" ng-model="row.StaffTypes_id" ng-init="row.StaffTypes_id">
                            <?php foreach($StaffPositions as $position) {
                                echo '<option value="' . $position['id'] . '">' . $position['position'] . '</option>';
                               } ?>
                        </select>
                    </td>
                    <td>
                        <input class="description form-control" ng-model="row.description">
                    </td>
                    <td>
                        <select class="toll form-control" ng-model="row.toll1">
    <!--                                    <option value="toll">Toll</option>-->
                                <?php// echo $TollBridges; ?>
    <!--                                    <option value="toll">Toll</option>-->
                            
                            <option ng-repeat="toll in tolls" value="{{toll.cost}}">{{toll.abbreviation}}</option>
                        </select>
                    </td>
                    <td>
                        <select class="toll form-control" ng-model="row.toll2">
                            <option ng-repeat="toll in tolls" value="{{toll.cost}}">{{toll.abbreviation}}</option>
                            <?php// echo $TollBridges; ?>
                        </select>
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.regularHours" ng-change="updateTotal(row, 'regularHours')" ng-blur="checkEmpty(row, 'regularHours')">
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.overtimeHours" ng-change="updateTotal(row, 'overtimeHours')" ng-blur="checkEmpty(row, 'overtimeHours')">
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.doubleOTHours" ng-change="updateTotal(row, 'doubleOTHours')" ng-blur="checkEmpty(row, 'doubleOTHours')">
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.statRegularHours" ng-change="updateTotal(row, 'statRegularHours')" ng-blur="checkEmpty(row, 'statRegularHours')">
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.statOTHours" ng-change="updateTotal(row, 'statOTHours')" ng-blur="checkEmpty(row, 'statOTHours')">
                    </td>
                    <td>
                        <input class="hours form-control" type="number" ng-model="row.statDOTHours" ng-change="updateTotal(row, 'statDOTHours')" ng-blur="checkEmpty(row, 'statDOTHours')">
                    </td>
                    <td class="total">
                       <strong>{{row.total}}</strong>
                    </td>
                </tr>
                <tr class="totalRow">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td>{{sumTotal.regularHours}}</td>
                    <td>{{sumTotal.overtimeHours}}</td>
                    <td>{{sumTotal.doubleOTHours}}</td>
                    <td>{{sumTotal.statRegularHours}}</td>
                    <td>{{sumTotal.statOTHours}}</td>
                    <td>{{sumTotal.statDOTHours}}</td>
                    <td><strong>{{sumTotal.total}}</strong></td>
                </tr>
            </tbody>
        </table>

        <button class="btn-info" ng-click="addTimesheetRow()">New Row</button>
        <button class="btn-info" ng-click="insertTimesheetRows()" ng-disabled="!timesheetSelected">Insert Row(s)</button>
        <button class="btn-warning" ng-click="removeTimesheetRows()" ng-disabled="!timesheetSelected">Delete Row(s)</button>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="saveTimesheet(newTimesheet)">Save</button>
    </div>
</form>
<!--
        </div>
    </div>
</div>
-->
