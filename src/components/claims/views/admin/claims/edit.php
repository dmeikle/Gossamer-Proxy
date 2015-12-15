<div ng-controller="claimsEditCtrl" ng-cloak>
    <?php echo $form['id']; ?>
    <?php echo $form['ProjectAddresses_id']; ?>
    <?php echo $form['jobNumberHidden']; ?>
    <?php echo $form['unassignedJobNumberHidden']; ?>
    <div>
        <div class="col-xs-12">
            <h1 class="pull-left">
                <?php echo $this->getString('CLAIMS_EDIT') ?>
                <span ng-if="!claim" class="spinner-loader"></span>
                <span ng-if="claim">{{claim.jobNumber}}</span>
            </h1>
            <div class="clearfix"></div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="card" ng-model="projectAddress">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_ADDRESS_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>
                <div ng-if="paLoading">
                    <span class="spinner-loader"></span>
                </div>

                <address ng-if="!paLoading">
                    <strong>{{projectAddress.buildingName}}</strong><br>
                    {{projectAddress.neighborhood}}<br>
                    {{projectAddress.address1}}<br>
                    {{projectAddress.city}}<br>
                    {{projectAddress.postalCode}}
                </address>

            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="card" ng-model="claim">
                <div class="cardheader row">
                    <h1 class="col-xs-4"><?php echo $this->getString('CLAIMS_SUMMARY'); ?></h1>
                    <div class="col-xs-5 text-right" ng-class="{'text-warning':claim.phase.title !== 'Cancelled' && claim.phase.title !== 'Complete',
                    'text-success': claim.phase.title == 'Complete', 'text-danger':claim.phase.title == 'Cancelled'}">{{claim.phase.title}}</div>
                    <div class="col-xs-3 text-right row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="#" ng-click="openEditModal(claim)">
                                        <?php echo $this->getString('CLAIMS_EDIT') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div ng-if="claimLoading">
                    <span class="spinner-loader"></span>
                </div>
                <div ng-if="!claimLoading">
                    <table class="table cardtable">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo $this->getString('CLAIMS_WORK_AUTH_RECEIVE_DATE'); ?>:
                                    </strong>
                                </td>
                                <td>{{claim.workAuthorizationReceiveDate}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo $this->getString('CLAIMS_TYPE'); ?>:
                                    </strong>
                                </td>
                                <td>{{claim.typeOfClaim}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo $this->getString('CLAIMS_PROJECT_MANAGER'); ?>:
                                    </strong>
                                </td>
                                <td>
                                    {{claim.projectManager}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo $this->getString('CLAIMS_STATUS'); ?>:
                                    </strong>
                                </td>
                                <td>
                                    {{claim.status}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>
                                        <?php echo $this->getString('CLAIMS_UNASSIGNED_JOB_NUMBER'); ?>:
                                    </strong>
                                </td>
                                <td>
                                    {{claim.unassignedJobNumber}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="widget" ng-controller="claimsLocationsListCtrl">
                <div class="widgetheader">
                    <h2 class="pull-left"><?php echo $this->getString('CLAIMS_LOCATIONS') ?></h2>
                    <div class="pull-right">
                        <button class="primary" ng-click="openClaimLocationModal()">
                            <?php echo $this->getString('CLAIMS_LOCATIONS_ADDNEW') ?>
                        </button>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th column-sortable data-column="jobNumber">
                                <?php echo $this->getString('CLAIMS_JOBNUMBER'); ?>
                            </th>
                            <th column-sortable data-column="phase">
                                <?php echo $this->getString('CLAIMS_PHASE'); ?>
                            </th>
                            <th column-sortable data-column="parentClaim">
                                <?php echo $this->getString('CLAIMS_PARENT_CLAIM'); ?>
                            </th>
                            <th sort-by-button class="cog-col row-controls">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-if="loading">
                            <td></td>
                            <td colspan="2">
                                <span class="spinner-loader"></span>
                            </td>
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="location in claimsLocations" ng-class="getStatusColor(location)"
                            ng-class="{'selected': location === previouslyClickedObject,
                                'inactive bg-warning text-warning': claim.status == 'inactive'}">
                            <td ng-click="selectRow(location)">{{location.unitNumber}}</td>
                            <td ng-click="selectRow(location)">{{location.phase}}</td>
                            <td ng-click="selectRow(location)">{{location.jobNumber}}</td>
                            <td class="row-controls">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog"
                                            type="button" id="dropdownMenu1" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                    </button>
                                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="" ng-click="openClaimLocationModal(location)"><?php echo $this->getString('CLAIMS_LOCATIONS_EDIT') ?></a></li>
                                        <li><a href="/admin/claim/initial-jobsheet/{{location.Claims_id}}/{{location.id}}"><?php echo $this->getString('CLAIMS_INITIAL_JOBSHEET') ?></a></li>
                                        <li><a href="/admin/claim/initial-jobsheet/view/{{location.Claims_id}}/{{location.id}}"><?php echo $this->getString('CLAIMS_EDIT_INITIAL_JOBSHEET') ?></a></li>
                                        <li><a href="" ng-click="delete(location)"><?php echo $this->getString('DELETE') ?></a></li>
                                        <li>
                                            <a gcms="{uri='admin_claims_secondarysheets_home' params='{{location.Claims_id}}/{{location.id}}'}"><?php echo $this->getString('CLAIMS_SECONDARY_SHEETS'); ?></a>
                                        </li>
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
        <div class="col-xs-12">

            <!-- Nav tabs -->
            <ul class="widgettabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">
                        <?php echo $this->getString('CLAIMS_PHOTOS') ?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">
                        <?php echo $this->getString('CLAIMS_COMMENTS') ?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#history" aria-controls="history" role="tab" data-toggle="tab">
                        <?php echo $this->getString('CLAIMS_HISTORY') ?>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="widget tab-pane active" id="photos">...</div>
                <div role="tabpanel" class="widget tab-pane" id="comments">...</div>
                <div role="tabpanel" class="widget tab-pane" id="history">...</div>
            </div>

        </div>
    </div>
</div>