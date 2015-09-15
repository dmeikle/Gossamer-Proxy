<!-- Add New Timesheet Modal -->
<!--
<div class="modal fade" id="new-timesheet" tabindex="-1" role="dialog" aria-labelledby="newTimesheet" ng-controller="timesheetListCtrl">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
-->
<form>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Timesheet</h4>
            </div>
            <div class="modal-body">
                <div class="laborer">
                    Laborer:
                    <input class="form-control" type="text" list="timesheet-autocomplete-list" ng-model="basicSearch.val[0]" ng-blur="search()">
                    <datalist id="timesheet-autocomplete-list" ng-click="setCategory(basicSearch)">
                        <option ng-if="!autocomplete.length > 0" value="">Loading</option>
                        <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                    </datalist>           
                </div>
                
                <div class="date">
                    Date: {{ yesterday | date:'yyyy-MM-dd' }}
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
                            <th>Claim</th>
                            <th>Phase</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Toll1</th>
                            <th>Toll2</th>
                            <th>Reg</th>
                            <th>OT</th>
                            <th>DOT</th>
                            <th>SReg</th>
                            <th>SOT</th>
                            <th>SDOT</th>
                            <th>TotalH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="row in newTimesheet track by $index">
                            <td>
                                <input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)">
                            </td>
                            <td>
                                <input class="form-control" ng-model="row.Claims_id">
                            </td>
                            <td>
                                <select class="form-control" name="AccountingPhaseCodes_id" ng-model="row.AccountingPhaseCodes_id">
                                    <?php foreach($AccountingPhaseCodes as $phase) {
                                        echo '<option value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                                       } ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="StaffTypes_id" ng-model="row.StaffTypes_id" ng-init="row.StaffTypes_id">
                                    <?php foreach($StaffPositions as $position) {
                                        echo '<option value="' . $position['id'] . '">' . $position['position'] . '</option>';
                                       } ?>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" ng-model="row.description">
                            </td>
                            <td>
                                <select class="form-control" ng-model="row.toll1" ng-init="row.toll1">
                                    <?php
                                    echo $TollBridges; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" ng-model="row.toll2" ng-init="row.toll2">
                                    <?php
                                    echo $TollBridges; ?>
                                </select>
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.regularHours" ng-change="updateTotal(row, 'reg', row.reg)" ng-blur="checkEmpty(row, 'regularHours')">
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.overtimeHours" ng-change="updateTotal(row, 'ot', row.ot)" ng-blur="checkEmpty(row, 'overtimeHours')">
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.doubleOTHours" ng-change="updateTotal(row, 'dot', row.dot)" ng-blur="checkEmpty(row, 'doubleOTHours')">
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.statRegularHours" ng-change="updateTotal(row, 'sreg', row.sreg)" ng-blur="checkEmpty(row, 'statRegularHours')">
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.statOTHours" ng-change="updateTotal(row, 'sot', row.sot)" ng-blur="checkEmpty(row, 'statOTHours')">
                            </td>
                            <td>
                                <input class="hours form-control" ng-model="row.statDOTHours" ng-change="updateTotal(row, 'sdot', row.sdot)" ng-blur="checkEmpty(row, 'statDOTHours')">
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
