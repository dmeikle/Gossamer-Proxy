<div ng-show="currentPage === 0"> <!-- PAGE 0 -->
    <div class="wizard-page clearfix" ng-show="!addNewClient && !loading">
        <h2><?php echo $this->getString('CLAIMS_ADDNEW_CREATENEW'); ?></h2>
        <form id="wizard-form" name="wizard-form" class="col-xs-12 col-md-6">

            <button class="btn-default" ng-click="toggleAdding()">
                <?php echo $this->getString('CLAIMS_ADDNEW_ORNEW'); ?>
            </button>
            <div class="clearfix"></div>
            <div class="form-group form-inline">
                <label>
                    <input type="radio" name="claim-by" id="claim-by-strata" ng-model="claim.by" value="strata" required>
                    <?php echo $this->getString('CLAIMS_ADDNEW_STRATA'); ?>
                </label>
                <div>
                    <input type="text" ng-model="claim.strata" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'strata'"
                           uib-typeahead="value.strata + ' #' + value.strataNumber for value in autocompleteStrata($viewValue)" typeahead-loading="loadingTypeaheadStrata"
                           typeahead-no-results="noResultsStrata" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'strata'"
                           typeahead-on-select="selectAddress($item, $model, $label)">
                    <div class="resultspane" ng-show="noResultsStrata">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                    </div>
                    <i ng-show="loadingTypeaheadStrata" class="glyphicon glyphicon-refresh"></i>
                </div>
            </div>
            <div class="form-group form-inline">
                <label>
                    <input type="radio" name="claim-by" id="claim-by-building" ng-model="claim.by" value="building">
                    <?php echo $this->getString('CLAIMS_ADDNEW_BUILDING'); ?>
                </label>
                <div>
                    <input type="text" ng-model="claim.building" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'building'"
                           uib-typeahead="value.strata + ' ' + value.buildingName for value in autocompleteBuilding($viewValue)" typeahead-loading="loadingTypeaheadBuilding"
                           typeahead-no-results="noResultsBuilding" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'building'">
                    <div class="resultspane" ng-show="noResultsBuilding">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                    </div>
                    <i ng-show="loadingTypeaheadBuilding" class="glyphicon glyphicon-refresh"></i>
                </div>
            </div>
            <div class="form-group form-inline">
                <label>
                    <input type="radio" name="claim-by" id="claim-by-address" ng-model="claim.by" value="address">
                    <?php echo $this->getString('CLAIMS_ADDNEW_ADDRESS'); ?>
                </label>
                <div>
                    <input type="text" ng-model="claim.address" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'address'"
                           uib-typeahead="value.strata + ' ' + value.address1 for value in autocompleteAddress($viewValue)" typeahead-loading="loadingTypeaheadAddress"
                           typeahead-no-results="noResultsAddress" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'address'">
                    <div class="resultspane" ng-show="noResultsAddress">
                        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                    </div>
                    <i ng-show="loadingTypeaheadAddress" class="glyphicon glyphicon-refresh"></i>
                </div>
            </div>
        </form>
        <div class="col-xs-12 col-md-6">
            <?php echo $this->getString('CLAIMS_LOCATIONS_ADDORSELECT') ?>
            <form ng-submit="addToUnitList()">
                <div class="input-group">
                    <?php echo $claimLocationForm['claimLocationsAutocomplete'] ?>
                    <span class="input-group-btn">
                        <button type="submit" class="btn-default">
                            <?php echo $this->getString('CLAIMS_ADDUNIT') ?>
                        </button>
                    </span>
                </div>
            </form>
            <h4><?php echo $this->getString('CLAIMS_UNITS') ?></h4>
            <ul>
                <li ng-if="unitList.length > 0" ng-repeat="unit in unitList track by unit.id" class="clearfix">
                    {{unit.unitNumber}}
                    <button ng-click="removeFromUnitList(unit)" class="pull-right btn-link glyphicon glyphicon-remove"></button>
                </li>
                <li ng-if="unitList.length == 0">
                    <?php echo $this->getString('CLAIMS_NOUNITS') ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <div class="pull-left">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CLAIMS_CANCEL'); ?>
        </button>
    </div>
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0" ng-if="!addNewClient">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button class="btn-default" ng-click="toggleAdding()" ng-if="addNewClient">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form"
                ng-if="!addNewClient">
                    <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
        </button>
        <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form"
                ng-if="addNewClient">
                    <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
        </button>
    </div>
    </div>
    <form class="clearfix" name="wizard-form" id="wizard-form" ng-show="addNewClient && !loading && currentPage === 0">
        <div class="form-group">
            <label for="project-firstname"><?php echo $this->getString('PROJECTS_BUILDINGNAME'); ?></label>
            <?php echo $form['buildingName']; ?>
        </div>
        <div class="form-group">
            <label for="project-lastname"><?php echo $this->getString('PROJECTS_ADDRESS'); ?></label>
            <?php echo $form['address1']; ?><br />
            <?php echo $form['address2']; ?>

        </div>
        <div class="form-group">
            <label for="project-personalEmail"><?php echo $this->getString('PROJECTS_CITY'); ?></label>
            <?php echo $form['city']; ?>
        </div>
        <div class="form-group">
            <label for="project-personalMobile"><?php echo $this->getString('PROJECTS_PROVINCE'); ?></label>
            <?php echo $form['Provinces_id']; ?>
        </div>
        <div class="form-group">
            <label for="project-personalTelephone"><?php echo $this->getString('PROJECTS_POSTALCODE'); ?></label>
            <?php echo $form['postalCode']; ?>
        </div>

        <div class="form-group">
            <label for="project-address1"><?php echo $this->getString('PROJECTS_STRATANUMBER'); ?></label>
            <?php echo $form['strataNumber']; ?>
        </div>


        <div class="form-group">
            <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_BUILDINGYEAR'); ?></label>
            <?php echo $form['buildingYear']; ?>
        </div>
    </form>
    <div class="clearfix"></div>
</div>
<form id="wizard-form" name="wizard-form" class="wizard-page" ng-show="currentPage === 1 && !loading"> <!-- PAGE 1 -->
    <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONTACTDETAILS'); ?></h2>
    <div class="clearfix">
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label><?php echo $this->getString('CLAIMS_CALLEDIN_NAME'); ?></label>
                <input class="form-control" type="text" name="calledInBy" id="claim-calledInBy" ng-model="claim.query.calledInBy">
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label><?php echo $this->getString('CLAIMS_CALLEDIN_PHONE'); ?></label>
                <input class="form-control" type="tel" name="calledInPhone" id="claim-calledInPhone" ng-model="claim.query.calledInPhone">
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label><?php echo $this->getString('CLAIMS_CONTACT_FIRSTNAME'); ?></label>
                <input class="form-control" type="text" name="contactName" id="claim-contactName" ng-model="claim.query.contactName">
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label><?php echo $this->getString('CLAIMS_CONTACT_PHONE'); ?></label>
                <input class="form-control" type="tel" name="contactPhone" id="claim-contactPhone" ng-model="claim.query.contactPhone">
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <label for="claim-date">
                    <?php echo $this->getString('CLAIM_DATE'); ?>
                </label>
                <div class="input-group">
                    <input type="date" name="date" id="claim-date" ng-model="claim.query.date" ng-model-options="{timezone: '+0000'}"
                           class="form-control" uib-datepicker-popup is-open="isOpen.date"
                           datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('CLAIM_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event)">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="form-group">
                <div class="input-group">
                    <label>
                        <?php echo $this->getString('CLAIM_TIME'); ?>
                        <uib-timepicker name="time" id="claim-time" ng-model="claim.query.date" ng-model-options="{timezone: '+0000'}"
                            show-meridian="true" required></uib-timepicker>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-left">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CLAIMS_CANCEL'); ?>
        </button>
    </div>
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="prevPage()" ng-if="!addNewClient">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form">
            <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
        </button>
    </div>
    <div class="clearfix"></div>
</form>
<div ng-show="currentPage === 2"> <!-- PAGE 2 -->
    <form id="wizard-form" class="wizard-page" ng-show="!loading && !addingLocation">
        

        
    </form>
    <div class="pull-left">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CLAIMS_CANCEL'); ?>
        </button>
    </div>
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form">
                    <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
        </button>
    </div>
    <div class="clearfix"></div>
</div>

<form id="wizard-form" name="wizard-form" class="wizard-page" ng-show="!loading && currentPage === 3"> <!-- PAGE 3 -->
    <div class="clearfix">
        <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONFIRMATION'); ?></h2>
        <div>
            <ul>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_CALLEDINBY'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.query.calledInBy}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_CALLEDINPHONE'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.query.calledInPhone}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_CONTACT_NAME'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.query.contactName}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_CONTACT_PHONE'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.query.contactPhone}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_MANAGEMENT'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.management}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_STRATA'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.strata}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_STRATANUM'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.strataNumber}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_TYPE'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.propertyType}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_ADDRESS'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.address1}} <br>
                        <span ng-if="claim.projectAddress.neighborhood">
                            {{claim.ProjectAddress.neighborhood}} <br>
                        </span>
                        {{claim.ProjectAddress.city}} <br>
                        {{claim.ProjectAddress.postalCode}}
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_ASBESTOSTEST'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.query.asbestosTestRequired}}&nbsp;
                    </div>
                </li>
                <li>
                    <div class="col-xs-12 col-md-6">
                        <?php echo $this->getString('CLAIMS_NOTES'); ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {{claim.ProjectAddress.notes}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="form-group">
        <input type="checkbox" name="confirm" id="claim-confirm" ng-model="claim.confirm" class="form-control" required>
        <label for="claim-confirm">
            <?php echo $this->getString('CLAIMS_CONFIRM'); ?>
        </label>
    </div>
    <div class="pull-left">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CLAIMS_CANCEL'); ?>
        </button>
    </div>
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0" ng-if="!addingLocation">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form"
            ng-disabled="!claim.confirm">
            <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
        </button>
    </div>
    <div class="clearfix"></div>
</form>
<form id="wizard-form" name="wizard-form" class="wizard-page" ng-show="currentPage === 4"> <!-- PAGE 4 -->
    <h2><?php echo $this->getString('CLAIMS_ADDNEW_DISPATCH'); ?></h2>
    <div class="pull-left">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CLAIMS_CANCEL'); ?>
        </button>
    </div>
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0" ng-if="!addingLocation">
            <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
        </button>
        <button type="submit" ng-click="confirm()" class="btn btn-primary" form="wizard-form"
            ng-disabled="!claim.confirm">
            <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
        </button>
    </div>
    <div class="clearfix"></div>
</form>
