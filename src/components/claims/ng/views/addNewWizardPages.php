<div class="wizard-page clearfix">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_CREATENEW'); ?></h2>
  <div class="form-inline col-xs-12 col-md-6">
    <div class="form-group">
      <label>
        <input type="radio" name="claim-by" id="claim-by-strata" class="form-control" ng-model="claim.by" value="strata">
        <?php echo $this->getString('CLAIMS_ADDNEW_STRATA'); ?>
      </label>
      <input type="text" ng-model="claim.strata" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'strata'"
        typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeahead"
        typeahead-no-results="noResults" class="form-control" typeahead-min-length='3'>
      <div class="resultspane" ng-show="noResults">
        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('STAFF_NORESULTS') ?>
      </div>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>
    </div>
    <div class="form-group">
      <label>
        <input type="radio" name="claim-by" id="claim-by-building" class="form-control" ng-model="claim.by" value="building">
        <?php echo $this->getString('CLAIMS_ADDNEW_BUILDING'); ?>
      </label>>
      <input type="text" ng-model="claim.building" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'building'"
        typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeahead"
        typeahead-no-results="noResults" class="form-control" typeahead-min-length='3'>
      <div class="resultspane" ng-show="noResults">
        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('STAFF_NORESULTS') ?>
      </div>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>
    </div>
    <div class="form-group">
      <label>
        <input type="radio" name="claim-by" id="claim-by-address" class="form-control" ng-model="claim.by" value="address">
        <?php echo $this->getString('CLAIMS_ADDNEW_ADDRESS'); ?>
      </label>
      <input type="text" ng-model="claim.address" ng-model-options="{debounce:500}" ng-disabled="claim.by !== 'address'"
        typeahead="value for value in fetchAutocomplete($viewValue)" typeahead-loading="loadingTypeahead"
        typeahead-no-results="noResults" class="form-control" typeahead-min-length='3'>
      <div class="resultspane" ng-show="noResults">
        <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('STAFF_NORESULTS') ?>
      </div>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <button class="btn-default">
      <?php echo $this->getString('CLAIMS_ADDNEW_ORNEW'); ?>
    </button>
  </div>
</div>
<div class="wizard-page">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONTACTDETAILS'); ?></h2>
  <div>
    <div class="form-group">
      <label><input type="text" ng-model="claim.contactFirstname"><?php echo $this->getString('CLAIMS_CONTACT_FIRSTNAME');?></label>
    </div>
    <div class="form-group">
      <label><input type="text" ng-model="claim.contactLastname"><?php echo $this->getString('CLAIMS_CONTACT_LASTNAME');?></label>
    </div>
    <div class="form-group">
      <label><input type="tel" ng-model="claim.contactPhone"><?php echo $this->getString('CLAIMS_CONTACT_PHONE');?></label>
    </div>
    <div class="form-group">
      <label><input type="datetime" ng-model="claim.datetime"><?php echo $this->getString('CLAIMS_CONTACT_TIME');?></label>
    </div>
  </div>
</div>
<div class="wizard-page">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_CONFIRMATION'); ?></h2>
</div>
<div class="wizard-page">
  <h2><?php echo $this->getString('CLAIMS_ADDNEW_DISPATCH'); ?></h2>
</div>
