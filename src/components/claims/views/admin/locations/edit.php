<div ng-controller="claimsLocationsCtrl as vm">
    <input type="hidden" value='<?php echo json_encode($ClaimsLocations[0]); ?>' id="ClaimsLocation" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($AffectedAreas); ?>' id="AffectedAreas" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ProjectAddress[0]); ?>' id="ProjectAddress" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ClaimPhase[0]); ?>' id="Phase" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ClaimsCustomers); ?>' id="ClaimsCustomers" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($ClaimsLocationsNotes); ?>' id="ClaimsLocationsNotes" ng-if="!vm.loaded" />
    <input type="hidden" value='<?php echo json_encode($EquipmentLocations); ?>' id="EquipmentLocations" ng-if="!vm.loaded" />
    <!--<input type="hidden" value='<?php // echo json_encode($Claims_id); ?>' id="Claims_id" ng-if="vm.loaded === true" />-->

    <!--<input type="hidden" value='5' id="ClaimsLocation" ng-if="vm.loaded === true" />-->

    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?> - {{vm.location.jobNumber}} - {{vm.location.unitNumber}}</h1>
    <div class="pull-right">
        <button class="primary h3button" ng-click="vm.saveLocation()">
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
                    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_SPECIAL_INSTRUCTIONS_FOR_UNIT'); ?></h1>
                    <?php echo $form['specialInstructions'] ?>
                </div>
                <p></p>
            </div>
        </div>

        <div class="col-md-12 no-padding">
            <div class="card">
                <div class="cardheader">
                    <div class="pull-left">
                        <h1><?php echo $this->getString('CLAIMS_AFFECTED_AREAS'); ?></h1>
                    </div>
                    <div class="pull-right text-right row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="#" ng-click="vm.openAffectedAreasModal('affectedAreasModal', {})">
                                        <?php echo $this->getString('CLAIMS_ADD_NEW') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="table table-striped table-hover flex-table">
                    <!--<thead>-->
                        <li class="head">
                            <div><?php echo $this->getString('CLAIMS_ROOM_TYPE'); ?></div>
                            <div><?php echo $this->getString('CLAIMS_LENGTH'); ?></div>
                            <div><?php echo $this->getString('CLAIMS_WIDTH'); ?></div>
                            <div><?php echo $this->getString('CLAIMS_HEIGHT'); ?></div>
                            <div><?php echo $this->getString('CLAIMS_ENTRY_IS_NORTH'); ?></div>
                            <div sort-by-button class="cog-col row-controls">&nbsp;</div>
                        </li>
                    <!--</thead>-->
                    <li ng-if="vm.affectedAreasLoading" class="flex-row">
                        <div></div>
                        <div></div>
                        <div><span class="spinner-loader"></span></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </li>
                    <div class="flex-tbody">
                    <li ng-if="vm.affectedAreas[0].length === 0 && !vm.affectedAreasLoading" class="flex-row">
                        <div class="warning" colspan="6"><?php echo $this->getString('CLAIMS_NO_AFFECTED_AREAS'); ?></div>
                    </li>
                    <li ng-repeat="area in vm.affectedAreas" ng-if="!vm.affectedAreasLoading && vm.affectedAreas[0].length !== 0" class="flex-row">
                        <div class="flex-left">
                            <div class="content"><h4>{{area.roomType}}</h4></div>
                            <div class="content">{{area.length}} x {{area.width}} x {{area.height}}</div>
                            <div class="content"><?php echo $this->getString('CLAIMS_LWH'); ?></div>
                        </div>
                        <div class="flex-right">
                            <div class="content"><a ng-click="vm.openAffectedAreasModal('affectedAreasModal', area)" href="#"><?php echo $this->getString('EDIT'); ?></a></div>
                            <div class="content"><a href="#">Scope</a></div>
                            <div class="content"><a href="#">Secondary Sheet</a></div>
                            <div class="content"><a href="#">Material Takeoffs</a></div>
                        </div>
                        <div>
                            {{area.roomType}}
                        </div>
                        <div>
                            {{area.length}}
                        </div>
                        <div>
                            {{area.width}}
                        </div>
                        <div>
                            {{area.height}}
                        </div>
                        <div>
                            <i class="glyphicon glyphicon-ok" ng-if="area.entryIsNorth == 1"></i>
                            <i ng-if="area.entryIsNorth == 0"></i>
                        </div>
                        <div class="row-controls">
                            <div class="dropdown flex-dropdown">
                                <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                </button>
                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                    <li><a href="" ng-click="vm.openAffectedAreasModal('affectedAreasModal', area)"><?php echo $this->getString('EDIT'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    </div>
                </ul>
            </div>
        </div>

        <div class="col-md-12 no-padding">
            <uib-tabset>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_COMMENTS') ?>">
                    <notes api-path="/admin/claims/locations/notes/"
                        parent-item-id="{{vm.location.id}}"
                        parent-item-name="ClaimsLocations_id"
                        item-name="ClaimsLocationNote"
                        class="padding-vertical">
                    </notes>
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_HISTORY') ?>">
                    ...
                </uib-tab>
                <uib-tab heading="<?php echo $this->getString('CLAIMS_DOCUMENTS') ?>">
                    <documents module="claims" model="{{vm.claim}}" config="{{vm.documentsConfig}}" model-type="Claim" ng-if="vm.claim.id" class="padding-vertical">
                        <div ng-if="loadingDocuments">
                            <div class="text-center"><span class="spinner-loader"></span></div>
                        </div>
                        <div class="pull-right" ng-if="!loadingDocuments">
                            <button class="primary" ng-click="openUploadDocumentsModal(vm.claim, vm.documentsConfig, vm.claimLocationDocumentModal)">
                                <?php echo $this->getString('CLAIMS_UPLOAD_DOCUMENTS') ?>
                            </button>
                        </div>
                        <section class="document-list" ng-if="!loadingDocuments">
                            <table class="table table-striped table-hover">
                                <tr class="table-header">
                                    <th class="col-md-3"><?php echo $this->getString('CLAIMS_NAME') ?></th>
                                    <th class="col-md-3"><?php echo $this->getString('CLAIMS_CREATED_BY') ?></th>
                                    <th class="col-md-2"><?php echo $this->getString('CLAIMS_UPLOADED') ?></th>
                                    <th class="col-md-2"><?php echo $this->getString('CLAIMS_TYPE') ?></th>
                                </tr>
                                <tr class="warning"><td colspan="4"><?php echo $this->getString('CLAIMS_NO_DOCUMENTS') ?></td></tr>
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
    <div class="clearfix hidden-lg hidden-md padding-vertical"></div>
    <div class="col-md-4 no-padding-right">
        <!--Phase VS Estimated Completion Date-->
        <div class="card">
            <div class="cardheader">
                <h1>
                    <?php echo $this->getString('CLAIMS_PHASE_VS_ECD') ?>
                </h1>
            </div>
            <div class="cardleft" ng-if="vm.phase.title">

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
                <div class="text-center text-muted padding-vertical">
                    <?php echo $this->getString('CLAIMS_NOPHASE') ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_CUSTOMER_CONTACT_DETAILS'); ?></h1>
                <div class="pull-right text-right row-controls">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        </button>
                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li>
                                <a href="#" ng-click="vm.openCustomersModal('customersModal', {})">
                                    <?php echo $this->getString('CLAIMS_ADD_NEW') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div ng-if="vm.primaryCustomers.length === 0 && vm.secondaryCustomers.length === 0">
                <div class="text-primary padding-vertical"><?php echo $this->getString('CLAIMS_NO_PRIMARY_OR_SECONDARY_CONTACTS_AT_LOCATION') ?></div>
            </div>
            <div class="padding-vertical" ng-if="vm.primaryCustomers.length !== 0">
                <p><strong><?php echo $this->getString('CLAIMS_PRIMARY'); ?></strong></p>

                <div ng-repeat="customer in vm.primaryCustomers" class="list-item">
                    <div class="pull-right text-right row-controls">
                        <div class="dropdown list-dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="#" ng-click="vm.removeCustomer(customer)">
                                        <?php echo $this->getString('REMOVE') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div>{{customer.customerType}}: {{customer.firstname}} {{customer.lastname}}</div>
                        <div ng-if="customer.daytimePhone"><?php echo $this->getString('CLAIMS_PHONE'); ?>: {{customer.daytimePhone}}</div>
                        <div ng-if="customer.mobile"><?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{customer.mobile}}</div>
                        <div ng-if="customer.email"><?php echo $this->getString('CLAIMS_EMAIL'); ?>:{{customer.email}}</div>
                    </div>
                    <div ng-if="customer.vipType" class="pull-right vip-type">{{customer.vipType}}</div>
                    <div class="clearfix"></div>
                    <div class="divider" ng-if="vm.secondaryCustomers.length !== 0"></div>
                </div>
            </div>
            <div ng-if="vm.secondaryCustomers.length !== 0">
                <p><strong><?php echo $this->getString('CLAIMS_SECONDARY'); ?></strong></p>
                <div ng-repeat="customer in vm.secondaryCustomers" class="list-item">
                    <div class="pull-right text-right row-controls">
                        <div class="dropdown list-dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            </button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li>
                                    <a href="#" ng-click="vm.openCustomersModal('customersModal', {})">
                                        <?php echo $this->getString('REMOVE') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div>{{customer.customerType}}: {{customer.firstname}} {{customer.lastname}}</div>
                        <div ng-if="customer.daytimePhone"><?php echo $this->getString('CLAIMS_PHONE'); ?>: {{customer.daytimePhone}}</div>
                        <div ng-if="customer.mobile"><?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{customer.mobile}}</div>
                        <div ng-if="customer.email"><?php echo $this->getString('CLAIMS_EMAIL'); ?>: {{customer.email}}</div>
                    </div>
                        <div ng-if="customer.vipType" class="pull-right vip-type">{{customer.vipType}}</div>
                    <div class="clearfix"></div>
                    <div ng-if="$index < vm.secondaryCustomers.length-1" class="divider"></div>
                </div>

            </div>
        </div>

        <!--Equipment on Site/Location-->
        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_EQUIPMENT_ON_SITE'); ?></h1>
                <div class="pull-right text-right row-controls">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        </button>
                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li>
                                <!--ng-class="{'disabled' : vm.selectedEquipment.length === 0}"-->
                                <a href="#" ng-class="{'disabled' : vm.selectedEquipment.length === 0}" class="btn" ng-click="vm.openEquipmentTransferModal('equipmentTransferModal')">
                                    <?php echo $this->getString('CLAIMS_TRANSFER_SELECTED') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="select-col" ng-click="vm.selectAllEquipmentToggle(vm.selectAllEquipment)"><input class="select-all" type="checkbox" ng-model="vm.selectAllEquipment"></th>
                        <th><?php echo $this->getString('CLAIMS_NAME'); ?></th>
                        <th><?php echo $this->getString('CLAIMS_PRODUCT_CODE'); ?></th>
                        <th><?php echo $this->getString('CLAIMS_PRODUCT_NUMBER'); ?></th>
                        <th><?php echo $this->getString('CLAIMS_MAX_DAYS'); ?></th>
                    </tr>
                </thead>
                <tr ng-if="!vm.affectedAreasLoading && vm.equipmentLocations[0].length === 0">
                    <td colspan="5" class="info">
                        <?php echo $this->getString('CLAIMS_NO_EQUIPMENT_AT_LOCATION'); ?>
                    </td>
                </tr>
                <tr ng-repeat="equipment in vm.equipmentLocations" ng-if="!vm.affectedAreasLoading && vm.equipmentLocations[0].length !== 0">
                    <td>
                        <input class="checkbox" type="checkbox" ng-model="equipment.isSelected" ng-click="vm.checkSelectedEquipment()">
                    </td>
                    <td>
                        {{equipment.name}}
                    </td>
                    <td>
                        {{equipment.productCode}}
                    </td>
                    <td>
                        {{equipment.number}}
                    </td>
                    <td>
                        {{equipment.maxDays}}
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CLAIMS_CURRENT_KEY_HOLDER'); ?></h1>
            </div>
            <p>...</p>
        </div>
    </div>

    <script type="text/ng-template" id="documentUploadModal">
        <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/claimsLocationDocumentModal.php'); ?>
    </script>

    <script type="text/ng-template" id="affectedAreasModal">
        <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/claimsLocationAffectedAreasModal.php'); ?>
    </script>

    <!--Customers Modal-->
    <script type="text/ng-template" id="customersModal">
        <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/claimsLocationCustomersModal.php'); ?>
    </script>

    <!--Equipment Transfer Modal-->
    <script type="text/ng-template" id="equipmentTransferModal">
        <?php include(__SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . '/ng/views/equipmentTransferModal.php'); ?>
    </script>
</div>

<form></form>
<div class="clearfix"></div>
<?php // pr($this->data); ?>


