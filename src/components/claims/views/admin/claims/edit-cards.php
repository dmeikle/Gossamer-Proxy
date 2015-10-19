<div class="card" ng-controller="claimsContactsList">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th colspan="2" column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_JOBNUMBER'); ?></th>
                <th column-sortable data-column="phase"><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                <th column-sortable data-column="parentClaim"><?php echo $this->getString('CLAIMS_PARENT_CLAIM'); ?></th>
                <th sort-by-button class="cog-col row-controls">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-if="loading">
                <td colspan="2"></td>
                <td></td>
                <td>
                    <span class="spinner-loader"></span>
                </td>
                <td></td>
            </tr>
            <tr ng-if="!loading" ng-repeat="contact in contacts" 
                ng-class="{'selected': contact === previouslyClickedObject, 'inactive bg-warning text-warning': claim.status == 'inactive'}">
                <td colspan="2" ng-click="selectRow(contact)">{{contact.firstname}} {{ contact.lastname }}</td>
                <td ng-click="selectRow(contact)">{{contact.email}}</td>
                <td ng-click="selectRow(contact)">{{contact.office}}</td>
                <td ng-click="selectRow(contact)">{{contact.mobile}}</td>
                <td ng-click="selectRow(contact)">{{contact.type}}</td>
                <td class="row-controls">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li><a href="/admin/claims/edit/{{location.id}}">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
