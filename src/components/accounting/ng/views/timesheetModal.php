<!-- Timesheet Modal -->
<form>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add/Edit Timesheet</h4>
    </div>
    <div class="modal-body">
        
        <div class="pull-left">
            <div class="form-group laborer">
                <label for="timesheet-laborer"><?php echo $this->getString('ACCOUNTING_LABORER'); ?></label>
                <input name="timesheet-laborer" class="form-control" type="text" list="timesheet-autocomplete-list" ng-model="laborer" ng-blur="findExistingTimesheet(laborer, timesheetDate); getStaffInfo(laborer);">
                <datalist id="timesheet-autocomplete-list">
                    <option ng-if="!autocomplete.length > 0" value="">Loading</option>
                    <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                </datalist>
                <label ng-if="findExisting">Checking for existing timesheet...</label>
            </div>
            
<!--
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input type="text" ng-model="basicSearch.query.name" ng-model-options="{debounce:500}"
                  typeahead="value for value in fetchLaborerAutocomplete($viewValue)"
                  typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control"
                  typeahead-on-select="search(basicSearch.query)" typeahead-min-length='3'>
                <div class="resultspane" ng-show="noResults">
                  <i class="glyphicon glyphicon-remove"></i> <?php// echo $this->getString('STAFF_NORESULTS') ?>
                </div>
                <span class="input-group-btn" ng-if="!searchSubmitted">
                  <button type="submit" class="btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
                <span ng-if="searchSubmitted" class="input-group-btn">
                  <button type="reset" class="btn-default" ng-click="resetSearch()">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                </span>
            </form>
-->
            
            <div class="form-group rate">
                <label for="timesheet-rate"><?php echo $this->getString('ACCOUNTING_TIMESHEET_RATE'); ?></label>
                {{hourlyRate | currency}}
            </div>
        </div>
        <div class="pull-right">
            <div class="form-group date">
                <label for="timesheet-date"><?php echo $this->getString('ACCOUNTING_DATE'); ?></label>
                <input class="form-control" type="date" name="timesheet-date" id="timesheet-date" ng-model="timesheetDate" ng-blur="findExistingTimesheet(laborer, timesheetDate)">
            </div>
            <div class="form-group vehicle">
                <label for="vehicle-num"><?php echo $this->getString('ACCOUNTING_VEHICLE_NUMBER'); ?></label>
                <select class="form-control" name="vehicle-num" ng-model="vehicleID" ng-change="getVehicleTolls(vehicleID)">
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
                    <th><?php echo $this->getString('ACCOUNTING_TIMESHEET_ITEM_RATE'); ?></th>
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
                
                <tr ng-if="!loading" ng-repeat="row in timesheetItems track by $index">
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
                        <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="row.AccountingPhaseCodes_id" ng-focus="getRateVarianceOptions($event)" ng-change="getRateVariance(row, row.AccountingPhaseCodes_id)">
                            <?php foreach($AccountingPhaseCodes as $phase) {
                                echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                               } ?>
                        </select>
                    </td>
                    <td>
                        <input class="rate form-control" ng-model="row.hourlyRate">
                    </td>
                    <td>
                        <input class="description form-control" ng-model="row.description">
                    </td>
                    <td>
                        <select class="toll form-control" ng-model="row.toll1">                            
                            <option ng-repeat="toll in tolls track by $index" value="{{toll.cost}}" ng-selected="selectToll1[{{$parent.$index}}][{{$index}}]">{{toll.abbreviation}}</option>
                        </select>
                        
<!--
                        <select class="toll form-control" ng-model="row.toll1">                            
                            <option ng-repeat="toll in tolls track by $index" value="{{toll.cost}}">{{toll.abbreviation}}</option>
                        </select>
-->
                    </td>
                    <td>
                        <select class="toll form-control" ng-model="row.toll2">
                            <option ng-repeat="toll in tolls track by $index" value="{{toll.cost}}" ng-selected="selectToll2[{{$parent.$index}}][{{$index}}]">{{toll.abbreviation}}</option>
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
                        <input class="hours form-control" type="number" ng-model="row.statDoubleOTHours" ng-change="updateTotal(row, 'statDoubleOTHours')" ng-blur="checkEmpty(row, 'statDoubleOTHours')">
                    </td>
                    <td class="total">
                       <strong>{{row.totalHours}}</strong>
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
                    <td>{{sumTotal.statDoubleOTHours}}</td>
                    <td><strong>{{sumTotal.totalHours}}</strong></td>
                </tr>
            </tbody>
        </table>

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
<!--
        </div>
    </div>
</div>
-->
