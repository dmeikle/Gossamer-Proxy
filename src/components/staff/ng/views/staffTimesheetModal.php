<!-- Timesheet Modal -->
<form>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Timesheet</h4>
    </div>
    <div class="modal-body">

        <div class="pull-left">
            <div class="form-group date">
                <label for="timesheet-date"><?php echo $this->getString('STAFF_TIMESHEET_DATE'); ?></label>
                <input class="form-control" type="date" name="timesheet-date" id="timesheet-date" ng-model="timesheetDate">
            </div>
        </div>
        <div class="pull-right">
            
            <div class="form-group vehicle">
              <label for="vehicle-num"><?php echo $this->getString('STAFF_TIMESHEET_VEHICLE_NUMBER'); ?></label>
                <select class="form-control" name="vehicle-num" ng-model="vehicleID" ng-change="getVehicleTolls(vehicleID)">
                    <?php
                    foreach($Vehicles as $vehicle) {
                        echo '<option value="' . $vehicle['id'] . '">' . $vehicle['number'] . ' ' . $vehicle['licensePlate'] . '</option>';
                    } ?>
                </select>
            </div>
        </div>
        
        <div id="timesheetGrid" class="table" ng-repeat="row in timesheetItems track by $index">
            <div class="row">
                <div class="col-md-1 select-col">
                    <div class="heading">
                        <!--<input class="select-all" type="checkbox" ng-model="selectAll">-->
                    </div>
                    <div class="field select-box">
                        <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="heading"><?php echo $this->getString('STAFF_TIMESHEET_JOB_NUMBER'); ?></div>
                    <div class="field">
                        <input class="claim form-control" type="text" ng-model="row.jobNumber" list="timesheet-claims-list" ng-change="watchClaims(row)" ng-model-options="{ debounce: 500 }" ng-blur="clearClaimsList(row)">
                        <datalist id="timesheet-claims-list">
                            <option ng-if="!claimsAutocomplete.length > 0" value="">Loading</option>
                            <option ng-repeat="value in claimsAutocomplete" value="{{value.label}}" data="{{value.id}}"></option>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_PHASE'); ?>
                    </div>
                    <div class="field">
                        <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="row.AccountingPhaseCodes_id" ng-focus="getRateVarianceOptions($event)" ng-change="getRateVariance(row, row.AccountingPhaseCodes_id)">
                            <?php foreach($AccountingPhaseCodes as $phase) {
                            echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_UNIT_NUMBER'); ?>
                    </div>
                    <div class="field">
                        <input class="form-control unit-number" ng-model="row.unitNumber">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_ADDRESS'); ?>
                    </div>
                    <div class="field">
                        <input class="description form-control" ng-model="row.address">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_CITY'); ?>
                    </div>
                    <div class="field">
                        <input class="description form-control" ng-model="row.city">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_TOLL1'); ?>
                    </div>
                    <div class="field">
                        <select class="toll form-control" ng-model="row.toll1">
                            <option ng-repeat="toll in tolls track by $index" value="{{toll.cost}}" ng-selected="selectToll2[{{$parent.$index}}][{{$index}}]">{{toll.abbreviation}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_TOLL2'); ?>
                    </div>
                    <div class="field">
                        <select class="toll form-control" ng-model="row.toll2">
                            <option ng-repeat="toll in tolls track by $index" value="{{toll.cost}}" ng-selected="selectToll2[{{$parent.$index}}][{{$index}}]">{{toll.abbreviation}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- end of row -->
            
            <div class="row time-row">
                <div class="col-md-1 col-md-offset-5 timepicker">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_TIME_FROM'); ?>
                    </div>
                    <div class="field">
                        <timepicker ng-model="row.timeFrom" hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
                    </div>
                </div>
                <div class="col-md-1 timepicker">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_TIME_TO'); ?>
                    </div>
                    <div class="field">
                        <timepicker ng-model="row.timeTo" hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
                    </div>
                </div>
                <div class="col-md-1 hours">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_HOURS_REGULAR'); ?>
                    </div>
                    <div class="field">
                        <input class="form-control" type="number" ng-model="row.regularHours" ng-change="updateTotal(row, 'regularHours')" ng-blur="checkEmpty(row, 'regularHours')">
                    </div>
                </div>
                <div class="col-md-1 hours">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_HOURS_OVERTIME'); ?>
                    </div>
                    <div class="field">
                        <input class="form-control" type="number" ng-model="row.overtimeHours" ng-change="updateTotal(row, 'overtimeHours')" ng-blur="checkEmpty(row, 'overtimeHours')">
                    </div>
                </div>
                <div class="col-md-1 hours">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_HOURS_DOUBLE_OVERTIME'); ?>
                    </div>
                    <div class="field hours">
                        <input class="form-control" type="number" ng-model="row.doubleOTHours" ng-change="updateTotal(row, 'doubleOTHours')" ng-blur="checkEmpty(row, 'doubleOTHours')">
                    </div>
                </div>
                <div class="col-md-1 hours">
                    <div class="heading">
                        <?php echo $this->getString('STAFF_TIMESHEET_HOURS_TOTALS'); ?>
                    </div>
                    <div class="field total-hours">
                        <p>{{row.totalHours}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="btn-info" ng-click="addTimesheetRow()">New Row</button>
        <button class="btn-info" ng-click="insertTimesheetRows()" ng-disabled="!timesheetSelected">Insert Row(s)</button>
        <button class="btn-warning" ng-click="removeTimesheetRows()" ng-disabled="!timesheetSelected">Delete Row(s)</button>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
        <button type="button" class="btn btn-primary" ng-click="clearTimesheet()">Save and New</button>
        <button type="button" class="btn btn-primary" ng-click="saveTimesheet(timesheetItems)">Save and Close</button>
    </div>
</form>
