
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
                <span ng-if="claim">
                    <span ng-show="claim.jobNumber">{{claim.jobNumber}} / </span>
                    {{claim.unassignedJobNumber}}
                </span>
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
                    {{projectAddress.strata}} - {{projectAddress.strataNumber}}<br>
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
                    <h1 class="col-xs-9"><?php echo $this->getString('CLAIMS_SUMMARY'); ?></h1>
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
                    <div style="float: right;
                         border: solid 1px #cccccc;
                         padding: 5px;
                         border-radius: 5px;text-align: center;margin-top: 10px"><strong>Phase</strong><br>
                        {{claim.phase.title}}<br /></div>
                    <label ng-value="claim.workAuthorizationReceiveDate"><?php echo $this->getString('CLAIMS_WORK_AUTH_RECEIVE_DATE'); ?>: {{claim.workAuthorizationReceiveDate}}</label><br />
                    <label><?php echo $this->getString('CLAIMS_TYPE'); ?>: {{claim.typeOfClaim}}</label><br />
                    <label><?php echo $this->getString('CLAIMS_PROJECT_MANAGER'); ?>: {{claim.projectManager}}</label><br />
                    <label><?php echo $this->getString('CLAIMS_STATUS'); ?>: {{claim.status}}</label><br />
                    <label><?php echo $this->getString('CLAIMS_UNASSIGNED_JOB_NUMBER'); ?>: {{claim.unassignedJobNumber}}</label>
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
                            <th column-sortable data-column="buzzerCode">
                                <?php echo $this->getString('CLAIMS_BUZZER'); ?>
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
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="location in claimsLocations" ng-class="getStatusColor(location)"
                            ng-class="{'selected': location === previouslyClickedObject,
                                'inactive bg-warning text-warning': claim.status == 'inactive'}">
                            <td ng-click="selectRow(location)">{{location.unitNumber}}</td>
                            <td ng-click="selectRow(location)">{{location.phase}}</td>
                            <td ng-click="selectRow(location)">{{location.buzzerCode}}</td>
                            <td ng-click="selectRow(location)">{{location.jobNumber}}</td>
                            <td class="row-controls">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog"
                                            type="button" id="dropdownMenu1" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                    </button>
                                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="" ng-click="openClaimLocationModal(location)"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?></a></li>
                                        <li><a href="/admin/claim/initial-jobsheet/edit/{{location.Claims_id}}/{{location.id}}"><?php echo $this->getString('CLAIMS_EDIT_INITIAL_JOBSHEET') ?></a></li>
                                        <li><a href="/admin/claim/initial-jobsheet/view/{{location.Claims_id}}/{{location.id}}"><?php echo $this->getString('CLAIMS_VIEW_INITIAL_JOBSHEET') ?></a></li>
                                        <li><a href="/admin/scoping/takeoffs/{{location.Claims_id}}/{{location.id}}"><?php echo $this->getString('CLAIMS_SCOPING_MATERIAL_TAKEOFFS') ?></a></li>
                                        <li>
                                            <a gcms="{uri='admin_claims_secondarysheets_home' params='{{location.Claims_id}}/{{location.id}}'}"><?php echo $this->getString('CLAIMS_SECONDARY_SHEETS'); ?></a>
                                        </li>
                                        <li><a href="" ng-click="delete(location)"><?php echo $this->getString('REMOVE') ?></a></li>
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
            <uib-tabset>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_COMMENTS') ?>">
                    ...
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_HISTORY') ?>">
                    ...
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_DOCUMENTS') ?>">
                    <div ng-if="claimLoading">
                        <div class="text-center"><span class="spinner-loader"></span></div>
                    </div>
                    <div ng-if="!claimLoading">
                        <documents module="claims" model='{{claim}}' model-type="Claim" class="padding">
                            <div class="pull-right">
                                <button class="primary" ng-click="openUploadDocumentsModal(claim, 'documentUploadModal')">
                                    <?php echo $this->getString('CLAIMS_UPLOAD_DOCUMENTS') ?>
                                </button>
                            </div>
                            <section class="document-list">
                                <table class="table table-striped table-hover">
                                    <tr class="table-header">
                                        <th class="col-md-3"><?php echo $this->getString('CLAIMS_NAME') ?></th>
                                        <th class="col-md-3"><?php echo $this->getString('CLAIMS_CREATED_BY') ?></th>
                                        <th class="col-md-2"><?php echo $this->getString('CLAIMS_UPLOADED') ?></th>
                                        <th class="col-md-2"><?php echo $this->getString('CLAIMS_TYPE') ?></th>
                                    </tr>
                                    <tbody ng-repeat-start="(unitKey, docTypes) in documents">
                                        <tr>
                                            <th ng-if="unitKey" colspan="4" class="bg-info">{{unitKey}}</th>
                                            <th ng-if="!unitKey" colspan="4" class="bg-info"><?php echo $this->getString('CLAIMS_CLAIM_DOCUMENTS') ?></th>
                                        </tr>
                                        <tr ng-repeat-start="(typeKey, documents) in docTypes">
                                            <th colspan="4">{{typeKey}}</th>
                                        </tr>
                                        <tr ng-repeat-end ng-repeat="document in documents">
                                            <td>{{document.filename}}</td>
                                            <td>{{document.firstname}} {{document.lastname}}</td>
                                            <td>{{document.uploadDate| date:'yyyy-MM-dd'}}</td>
                                            <td><i class="document-icon {{document.filename.slice(document.filename.lastIndexOf('.') + 1)}}"></i></td>
                                        </tr>
                                    </tbody>
                                    <tbody ng-repeat-end></tbody>
                                </table>
                            </section>
                        </documents>
                    </div>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>

    <script type="text/ng-template" id="documentUploadModal">
        <div class="modal-header">
        <h1>
        <?php echo $this->getString('CLAIMS_UPLOAD_DOCUMENTS_TO') ?>
        <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
        <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
        </h1>
        </div>
        <div class="modal-body">
        <form name="documentUploadForm">
        <div class="col-xs-6">
        <div class="form-group">
        <label for="DocumentType_documentType">
        <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_TYPE') ?>
        </label>
        <?php echo $documentForm['DocumentTypes_id']; ?>
        </div>
        <div class="form-group">
        <label for="DocumentType_ClaimLocations_id">
        <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_UNIT') ?>
        </label>
        <?php echo $documentForm['ClaimsLocations_id']; ?>
        </div>
        </div>
        <div class="col-xs-6">
        <label>
        <?php echo $this->getString('CLAIMS_UPLOAD_TO') ?>
        <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
        <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
        </label>

        <div ng-if="!upload.DocumentTypes_id">
        <p class="text-center text-muted">
        <?php echo $this->getString('CLAIMS_DOCUMENTS_PLEASE_SELECT_TYPE') ?>
        </p>
        </div>
        <div ng-if="upload.DocumentTypes_id">
        <div dropzone="dropzoneConfig" class="dropzone">
        <p class="text-center">
        <?php echo $this->getString('CLAIMS_UPLOAD_TO'); ?>
        <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
        <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
        </p>
        <p class="text-center text-muted">
        <small>
        <span ng-if="documentCount && !documentUploading">{{documentCount}} <?php echo $this->getString('CLAIMS_DOCUMENTS') ?></span>
        <span ng-if="documentUploading">
        <span class="spinner-loader align-middle padding-right"></span> <?php echo $this->getString('CLAIMS_UPLOADING') ?>
        </span>

        </small>
        </p>
        </div>
        </div>
        </div>
        </form>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
        <div class="pull-right">
        <button class="primary" ng-click="close()">
        <?php echo $this->getString('CLOSE') ?>
        </button>
        </div>
        </div>
    </script>
</div>