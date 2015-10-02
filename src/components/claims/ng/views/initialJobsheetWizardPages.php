<form id="wizard-form">
  <div class="col-xs-6 form-group">
    <label for="jobsheet-location"><?php echo $this->getString('CLAIMS_LOCATION') ?></label>
    <input type="text" id="jobsheet-location" class="form-control" ng-model="jobSheet.query.location" required>
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-source"><?php echo $this->getString('CLAIMS_SOURCE') ?></label>
    <label for="jobsheet-is-source">
      <input type="checkbox" name="" id="jobsheet-is-source" ng-model="jobSheet.isSource">
      <?php echo $this->getString('CLAIMS_ISSOURCE') ?>
    </label>
    <input type="text" id="jobsheet-source" class="form-control" ng-model="jobSheet.query.source" ng-disabled="!jobSheet.isSource"
      ng-required="jobSheet.isSource">
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-workAuthorization"><?php echo $this->getString('CLAIMS_WORKAUTHORIZATION') ?></label>
    <label for="jobsheet-is-workAuthorization">
      <input type="checkbox" name="" id="jobsheet-is-workAuthorization" ng-model="jobSheet.workAuthorization">
      <?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>
    </label>
    <input type="text" id="jobsheet-workAuthorization" class="form-control" ng-model="jobSheet.query.workAuthorization"
    ng-disabled="!jobSheet.workAuthorization" ng-required="jobSheet.workAuthorization">
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-lockBox"><?php echo $this->getString('CLAIMS_LOCKBOX') ?></label>
    <label for="jobsheet-is-lockBox">
      <input type="checkbox" id="jobsheet-is-lockBox" ng-model="jobSheet.lockBox">
      <?php echo $this->getString('CLAIMS_ISLOCKBOX') ?>
    </label>
    <input type="text" id="jobsheet-lockBox" class="form-control" ng-model="jobSheet.query.lockBox"
    ng-disabled="!jobSheet.lockBox" ng-required="jobSheet.lockBox">
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-pictures"><?php echo $this->getString('CLAIMS_PICTURES') ?></label>
    <div>
      <label for="jobsheet-pictures">
        <input type="checkbox" name="" id="jobsheet-pictures" ng-model="jobSheet.query.pictures">
        <?php echo $this->getString('CLAIMS_ISPICTURES') ?>
      </label>
    </div>
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-keys"><?php echo $this->getString('CLAIMS_KEYS') ?></label>
    <label for="jobsheet-is-keys">
      <input type="checkbox" name="" id="jobsheet-is-keys" ng-model="jobSheet.keys">
      <?php echo $this->getString('CLAIMS_ISKEYS') ?>
    </label>
    <input type="text" id="jobsheet-keys" class="form-control" ng-model="jobSheet.query.keys"
    ng-disabled="!jobSheet.keys" ng-required="jobSheet.keys">
  </div>
</form>
<form id="wizard-form">
  Page Two
</form>
<form id="wizard-form">
  Page Three
</form>
