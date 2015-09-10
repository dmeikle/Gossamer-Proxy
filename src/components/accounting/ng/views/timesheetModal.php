
<!-- Add New Timesheet Modal -->
<div class="modal fade" id="new-timesheet" tabindex="-1" role="dialog" aria-labelledby="newTimesheet" ng-controller="timesheetListCtrl">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Timesheet</h4>
            </div>
            <div class="modal-body">
                <div class="laborer">
                    Laborer:
                    <input type="text" list="timesheet-autocomplete-list" ng-model="basicSearch.val[0]">
                    <datalist id="timesheet-autocomplete-list">
                        <option ng-if="!autocomplete.length > 0" value="">Loading</option>
                        <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
                    </datalist>           
                </div>
                
                <div class="date">
                    Date: {{ yesterday | date:'yyyy-MM-dd' }}
                </div>
                
                <div class="total-hours">
                    Total Hours
                </div>
                
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col"><input class="select-all" type="checkbox"></th>
                            <th>Claim</th>
                            <th>Phase</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Reg</th>
                            <th>OT</th>
                            <th>DOT</th>
                            <th>SReg</th>
                            <th>SOT</th>
                            <th>SDOT</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="row in newTimesheet track by $index">
                            <td>
                                <input class="checkbox" type="checkbox" ng-model="row.selected">
                            </td>
                            <td>
                                <input ng-model="row.claim">
                            </td>
                            <td>
                                <select name="ClaimPhases_id" ng-model="row.phase">
                                    <?php foreach($ClaimPhases as $phase) {
                                        echo '<option value="' . $phase['id'] . '">' . $phase['description'] . '</option>';
                                       } ?>
                                </select>
                            </td>
                            <td>
                                <select name="ClaimPhases_id" ng-model="row.category">
                                    <?php foreach($StaffPositions as $position) {
                                        echo '<option value="' . $position['id'] . '">' . $position['position'] . '</option>';
                                       }
                                       ?>
                                </select>
                            </td>
                            <td>
                                <input ng-model="row.description">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.reg" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.ot" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.dot" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.sreg" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.sot" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.sdot" ng-change="updateTotal(row)">
                            </td>
                            <td>
                                <input class="hours" ng-model="row.total">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <button class="btn-info" ng-click="addTimesheetRow()">New Row</button>
                <button class="btn-info" ng-click="insertTimesheetRows()" ng-disabled="">Insert Row(s)</button>
                <button class="default" ng-click="removeTimesheetRows()">Delete Row(s)</button>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
