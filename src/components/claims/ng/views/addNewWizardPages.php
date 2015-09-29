<div>
  <div class="wizard-page clearfix" ng-submit="nextPage()" ng-hide="addNewClient">
    <h2><?php echo $this->getString('CLAIMS_ADDNEW_CREATENEW'); ?></h2>
    <form id="wizard-form" name="wizard-form" class="form-inline col-xs-12 col-md-6">
      <div class="form-group">
        <label>
          <input type="radio" name="claim-by" id="claim-by-strata" class="form-control" ng-model="claim.by" value="strata" required>
          <?php echo $this->getString('CLAIMS_ADDNEW_STRATA'); ?>
        </label>
        <input type="text" ng-model="claim.strata" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'strata'"
          typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeaheadStrata"
          typeahead-no-results="noResultsStrata" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'strata'">
        <div class="resultspane" ng-show="noResultsStrata">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
        </div>
        <i ng-show="loadingTypeaheadStrata" class="glyphicon glyphicon-refresh"></i>
      </div>
      <div class="form-group">
        <label>
          <input type="radio" name="claim-by" id="claim-by-building" class="form-control" ng-model="claim.by" value="building">
          <?php echo $this->getString('CLAIMS_ADDNEW_BUILDING'); ?>
        </label>
        <input type="text" ng-model="claim.building" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'building'"
          typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeaheadBuilding"
          typeahead-no-results="noResultsBuilding" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'building'">
        <div class="resultspane" ng-show="noResultsBuilding">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
        </div>
        <i ng-show="loadingTypeaheadBuilding" class="glyphicon glyphicon-refresh"></i>
      </div>
      <div class="form-group">
        <label>
          <input type="radio" name="claim-by" id="claim-by-address" class="form-control" ng-model="claim.by" value="address">
          <?php echo $this->getString('CLAIMS_ADDNEW_ADDRESS'); ?>
        </label>
        <input type="text" ng-model="claim.address" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'address'"
          typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeaheadAddress"
          typeahead-no-results="noResultsAddress" class="form-control" typeahead-min-length='3' ng-required="claim.by === 'address'">
        <div class="resultspane" ng-show="noResultsAddress">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
        </div>
        <i ng-show="loadingTypeaheadAddress" class="glyphicon glyphicon-refresh"></i>
      </div>
    </form>
    <div class="col-xs-12 col-md-6">
      <button class="btn-default" ng-click="toggleAdding()">
        <?php echo $this->getString('CLAIMS_ADDNEW_ORNEW'); ?>
      </button>
    </div>
  </div>
  <form class="clearfix form-horizontal" ng-submit="" ng-show="addNewClient" name="wizard-add-new" id="wizard-add-new">
    <div class="form-group">
      <div class="col-xs-12 col-md-6">
        <label for="addNew-strata">
          <?php echo $this->getString('CLAIMS_ADDNEW_STRATA');?>
        </label>
        <input class="form-control" type="text" name="addNew-strata" id="addNew-strata" ng-model="addNew.strata">
      </div>
      <div class="col-xs-12 col-md-6">
        <label for="addNew-building">
          <?php echo $this->getString('CLAIMS_ADDNEW_BUILDING');?>
        </label>
        <input class="form-control" type="text" name="addNew-building" id="addNew-building" ng-model="addNew.building">
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-12 col-md-6">
        <label>
          <?php echo $this->getString('CLAIMS_ADDNEW_ADDRESS');?>
        </label>
        <input class="form-control" type="text">
      </div>
      <div class="col-xs-12 col-md-6">
        <label>
          <?php echo $this->getString('CLAIMS_ADDNEW_ADDRESS');?>
        </label>
        <input class="form-control" type="text">
      </div>
    </div>
  </form>
</div>
<form id="wizard-form" name="wizard-form" class="wizard-page">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONTACTDETAILS'); ?></h2>
  <div class="clearfix">
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label><?php echo $this->getString('CLAIMS_CONTACT_FIRSTNAME');?></label>
        <input class="form-control" type="text" name="contactFirstname" id="claim-contactFirstname" ng-model="claim.contactFirstname">
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label><?php echo $this->getString('CLAIMS_CONTACT_LASTNAME');?></label>
        <input class="form-control" type="text" name="contactLastname" id="claim-contactLastname" ng-model="claim.contactLastname">
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label><?php echo $this->getString('CLAIMS_CONTACT_PHONE');?></label>
        <input class="form-control" type="tel" name="contactPhone" id="claim-contactPhone" ng-model="claim.contactPhone">
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="claim-date">
          <?php echo $this->getString('CLAIM_DATE'); ?>
        </label>
        <div class="input-group">
          <input type="date" name="date" id="claim-date" ng-model="claim.date" ng-model-options="{timezone: '+0000'}"
            class="form-control" datepicker-popup is-open="isOpen.date"
            datepicker-options="dateOptions" ng-required="true" close-text="<?php echo $this->getString('CLAIM_CLOSE');?>" />
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
            <timepicker name="time" id="claim-time" ng-model="claim.time" show-meridian="true" required></timepicker>
          </label>
        </div>
      </div>
    </div>
  </div>
</form>
<form id="wizard-form" name="wizard-form" class="wizard-page">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONFIRMATION'); ?></h2>
  
</form>
<form id="wizard-form" name="wizard-form" class="wizard-page" ng-submit="confirm()">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_DISPATCH'); ?></h2>
</form>
