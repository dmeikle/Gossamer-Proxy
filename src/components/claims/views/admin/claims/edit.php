<div class="content full-width" ng-controller="claimsEditCtrl" ng-cloak>
    <?php echo $form['id']; ?>
    <?php echo $form['ProjectAddresses_id']; ?>
    <div class="widget">
        <h1 ng-if="!claim"><?php echo $this->getString('CLAIM_CREATE'); ?></h1>
        <h1 class="pull-left" ng-if="claim"><?php echo $this->getString('CLAIM_EDIT') ?> {{claim.jobNumber}}</h1>
        <div class="clearfix"></div>
        <div class="cards">
            <div class="card" ng-model="projectAddress">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('CLAIM_ADDRESS_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>
                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>

                <div class="form-group">
                    <label ng-value="claim.buildingName">{{projectAddress.buildingName}}</label><br />
                    <label>{{projectAddress.address1}}</label><br />
                    <label>{{projectAddress.city}}</label><br />
                    <label>{{projectAddress.postalCode}}</label><br />
                    <label>{{projectAddress.neighborhood}}</label>
                </div>

            </div>
        </div>
        <div class="cards">
            <div class="card" ng-model="claim">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('CLAIM_TYPE_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>

                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>
                <div class="form-group">
                    <label ng-value="claim.workAuthorizationReceiveDate">{{claim.workAuthorizationReceiveDate}}</label><br />
                    <label>{{claim.ClaimTypes_id}}</label><br />
                    <label>{{claim.ProjectManager_id}}</label><br />
                    <label>{{claim.currentClaimPhases_id}}</label><br />
                    <label>{{claim.currentClaimStatusTypes_id}}</label>
                    <label>{{claim.unassignedJobNumber}}</label>
                </div>
            </div>
        </div>
        
         <div class="clearfix"></div>
         <div class="cards">
        <div class="card" ng-controller="claimsLocationsListCtrl">

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
                    <tr ng-if="!loading" ng-repeat="location in claimsLocations" ng-class="getStatusColor(location)"
                        ng-class="{'selected': location === previouslyClickedObject, 'inactive bg-warning text-warning': claim.status == 'inactive'}">
                        <td colspan="2" ng-click="selectRow(location)">{{location.unitNumber}}</td>
                        <td ng-click="selectRow(location)">{{location.phase}}</td>
                        <td ng-click="selectRow(location)">{{location.jobNumber}}</td>
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
        </div>
        <div class="clearfix"></div>
        <form class="hide"></form>
    </div>
</div>