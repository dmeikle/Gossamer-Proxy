<div ng-controller="claimsLocationsCtrl as vm">
    <input type="hidden" value='<?php echo json_encode($ClaimsLocations[0]); ?>' id="ClaimsLocation" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($AffectedAreas); ?>' id="AffectedAreas" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ProjectAddress[0]); ?>' id="ProjectAddress" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ClaimPhase[0]); ?>' id="Phase" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ClaimsCustomers); ?>' id="ClaimsCustomers" ng-if="!vm.loaded" />
    <!--<input type="hidden" value='<?php // echo json_encode($Claims_id); ?>' id="Claims_id" ng-if="vm.loaded === true" />-->

    <!--<input type="hidden" value='5' id="ClaimsLocation" ng-if="vm.loaded === true" />-->

    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?> - {{vm.location.jobNumber}} - {{vm.location.unitNumber}}</h1>
    <div class="pull-right">
        <button class="primary h3button" ng-click="">
            <?php echo $this->getString('SAVE') ?>
        </button>
    </div>
    <div class="clearfix"></div>

    <div ng-if="vm.loading">
        <div class="text-center"><span class="spinner-loader"></span></div>
    </div>

    <div class="col-md-8 no-padding">
        <div class="col-md-6 no-padding-left">
            <div class="card">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_ADDRESS_INFO'); ?></h1>
                </div>
                <div class="clearfix"></div>
                <address>
                    <div><strong>{{vm.projectAddress.buildingName}}</strong></div>
                    <div>{{vm.projectAddress.strata}} - {{vm.projectAddress.strataNumber}}</div>
                    <div>{{vm.projectAddress.neighborhood}}</div>
                    <div>{{vm.projectAddress.address1}}</div>
                    <div>{{vm.projectAddress.city}}</div>
                    <div>{{vm.projectAddress.postalCode}}</div>
                </address>
            </div>
        </div>

        <div class="col-md-6 no-padding">
            <div class="card">
                <div class="cardheader">
                    <h1><?php echo $this->getString('CLAIMS_CUSTOMER_CONTACT_DETAILS'); ?></h1>
                </div>
                <div ng-repeat="customer in vm.claimsCustomers">
                    <div ng-if="customer.isPrimary === '1'"><strong><?php echo $this->getString('CLAIMS_PRIMARY_CONTACT'); ?></strong></div>
                    <div><strong><?php echo $this->getString('CLAIMS_NAME'); ?>:</strong> {{customer.firstname}} {{customer.lastname}}</div>
                    <div><strong><?php echo $this->getString('CLAIMS_TYPE'); ?>:</strong> {{customer.customerType}}</div>
                    <div ng-if="customer.vipType"><strong><?php echo $this->getString('CLAIMS_VIP_TYPE'); ?>:</strong> {{customer.vipType}}</div>
                    <div><strong><?php echo $this->getString('CLAIMS_PHONE'); ?>:</strong> {{customer.daytimePhone}}</div>
                    <div ng-if="customer.mobile"><strong><?php echo $this->getString('CLAIMS_MOBILE'); ?>:</strong> {{customer.mobile}}</div>
                    <div><strong><?php echo $this->getString('CLAIMS_EMAIL'); ?>:</strong> {{customer.email}}</div>
                    <div class="divider"></div>
                </div>

            <!--<div class="widget">-->
                <!--<p>{{vm.affectedAreas}}</p>-->
            </div>
        </div>

        <div class="col-md-12 no-padding">
            <div class="card">
                <div class="cardheader">
                    <h1><?php echo $this->getString('CLAIMS_AFFECTED_AREAS'); ?></h1>
                </div>
                <table class="table table-striped table-hover">
                    <thead>

                        <tr>
                            <th><?php echo $this->getString('CLAIMS_ROOM_TYPE'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_WIDTH'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_HEIGHT'); ?></th>
                            <th><?php echo $this->getString('CLAIMS_LENGTH'); ?></th>
                        </tr>
                    </thead>
                    <tr ng-repeat="area in vm.affectedAreas">
                        <td>
                            {{area.roomType}}
                        </td>
                        <td>
                            {{area.width}}
                        </td>
                        <td>
                            {{area.height}}
                        </td>
                        <td>
                            {{area.length}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-12 no-padding">
            <uib-tabset>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_COMMENTS') ?>">
                    ...
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_HISTORY') ?>">
                    ...
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_DOCUMENTS') ?>">
                    <documents module="claims" model="{{vm.claim}}" config="{{vm.documentsConfig}}" model-type="Claim" ng-if="vm.claim.id" class="padding-vertical">
                        <div class="pull-right">
                            <button class="primary" ng-click="openUploadDocumentsModal(vm.claim, vm.documentsConfig, 'documentUploadModal')">
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
                                    <tbody ng-repeat-start="(unitKey, docTypes) in documents" ng-if="unitKey === vm.location.unitNumber">
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
                </uib-tab>
            </uib-tabset>
        </div>
    </div>

    <div class="col-md-4 no-padding-right">
        <!--Phase VS Estimated Completion Date-->
        <div class="card">
            <div class="cardheader">
                <h1>
                    <?php echo $this->getString('CLAIMS_PHASE_VS_ECD') ?>dsadada
                </h1>
            </div>
            <div class="cardleft">

                <h1>{{vm.phase.title}}</h1>

                <span class="big" ng-class="{'text-danger' : vm.phase.numDays > 0}">
                    {{vm.phase.numDays}} <?php echo $this->getString('CLAIMS_DAYS_REMAINING') ?>
                </span>
            </div>
            <div class="cardright" ng-if="vm.phase.numDays">
                <table class="table cardtable">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $this->getString('CLAIMS_STARTDATE') ?>
                                </strong>
                            </td>
                            <td>
                                {{vm.phase.startDate| date: mediumDate : '+0000'}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $this->getString('CLAIMS_ESTIMATE') ?>
                                </strong>
                            </td>
                            <td>
                                {{vm.phase.scheduledEndDate| date : mediumDate : '+0000'}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div ng-if="!vm.phase.numDays">
                <p class="text-center text-muted">
                    <?php echo $this->getString('CLAIMS_NOPHASE') ?>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_SPECIAL_INSTRUCTIONS_FOR_UNIT'); ?></h1>
                <?php echo $form['specialInstructions'] ?>
            </div>
            <p></p>
        </div>

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_CURRENT_KEY_HOLDER'); ?></h1>
            </div>
            <p>...</p>
        </div>

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_EQUIPMENT_ON_SITE'); ?></h1>
            </div>
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

<form></form>
<div class="clearfix"></div>
