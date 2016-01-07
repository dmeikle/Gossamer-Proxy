<div ng-controller="claimsLocationsCtrl as vm">
    <input type="hidden" value='<?php echo json_encode($ClaimsLocations[0]); ?>' id="ClaimsLocation" ng-if="vm.loaded === true" />
    <input type="hidden" value='<?php echo json_encode($AffectedAreas); ?>' id="AffectedAreas" ng-if="vm.loaded === true" />
    <input type="hidden" value='<?php echo json_encode($ProjectAddress[0]); ?>' id="ProjectAddress" ng-if="vm.loaded === true" />
    <input type="hidden" value='<?php echo json_encode($ClaimPhase[0]); ?>' id="Phase" ng-if="vm.loaded === true" />
    <!--<input type="hidden" value='5' id="ClaimsLocation" ng-if="vm.loaded === true" />-->

    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_EDIT_LOCATION') ?> - {{vm.location.jobNumber}}</h1>
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
                    <h1 class="pull-left"><?php echo $this->getString('CLAIMS_CUSTOMER_CONTACT_DETAILS'); ?></h1>
                </div>
            <!--<div class="widget">-->
                <!--<p>{{vm.affectedAreas}}</p>-->
            </div>
        </div>

        <div class="col-md-12 no-padding">
            <div class="widget">
                <table class="table table-striped table-hover">
                    <thead>

                        <tr>
                            <th>Room Type</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Length</th>
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
                    <div ng-if="claimLoading">
                        <div class="text-center"><span class="spinner-loader"></span></div>
                    </div>
                    <div ng-if="!claimLoading">
<!--                        <documents module="claims" model='{{claim}}' model-type="Claim">
                            <div class="pull-right">
                                <button class="primary" ng-click="openUploadDocumentsModal(claim)">
                                    <?php // echo $this->getString('CLAIMS_UPLOAD_DOCUMENTS') ?>
                                </button>
                            </div>

                        </documents>-->
                    </div>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>

    <div class="col-md-4 no-padding-right">
        <!--Phase VS Estimated Completion Date-->
        <div class="card">
            <div class="cardheader">
                <h1>
                    <?php echo $this->getString('CLAIMS_PHASE_VS_ECD') ?>
                </h1>
            </div>
<!--            <div ng-if="ctrl.claimLoading">
                <div class="spinner-loader"></div>
            </div>-->
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
</div>

<form></form>
<div class="clearfix"></div>
<?php pr($this->data); ?>