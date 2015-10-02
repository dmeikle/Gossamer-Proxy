<div id="wizard-form">
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
</div>
<div id="wizard-form">
  <div class="toolbar">
    <button class="btn-default" ng-click="addOwnerTenant()">
      <?php echo $this->getString('NEW') ?>
    </button>
  </div>
  <div ng-repeat="ownerTenant in jobSheet.query.ownerTenant track by $index">
    <div class="col-xs-10 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_OWNERTENANT') ?>
      </label>
      <div>
        <div class="radio-inline">
          <label for="owner">
            <input type="radio" ng-model="ownerTenant" name="owner-tenant" id="owner{{$index}}" value="owner">
            <?php echo $this->getString('CLAIMS_OWNER') ?>
          </label>
        </div>
        <div class="radio-inline">
          <label for="tenant">
            <input type="radio" ng-model="ownerTenant" name="owner-tenant" id="tenant{{$index}}" value="tenant">
            <?php echo $this->getString('CLAIMS_TENANT') ?>
          </label>
        </div>
      </div>
    </div>
    <div class="col-xs-2">
      <div class="pull-right">
        <button ng-click="removeOwnerTenant($index)" class="btn-link">
          <span class="glyphicon glyphicon-remove"></span>
        </button>
      </div>
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_NAME') ?>
      </label>
      <input type="text" ng-model="ownerTenant.name" class="form-control" name="name" id="name{{$index}}">
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_HOMEPHONE') ?>
      </label>
      <input type="tel" ng-model="ownerTenant.homePhone" class="form-control" name="homePhone" id="homePhone{{$index}}">
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_MOBILEPHONE') ?>
      </label>
      <input type="tel" ng-model="ownerTenant.mobilePhone" class="form-control" name="mobilePhone" id="mobilePhone{{$index}}">
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_WORKPHONE') ?>
      </label>
      <input type="tel" ng-model="ownerTenant.workPhone" class="form-control" name="workPhone" id="workPhone{{$index}}">
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_BUZZER') ?>
      </label>
      <input type="tel" ng-model="ownerTenant.buzzer" class="form-control" name="buzzer" id="buzzer{{$index}}">
    </div>
    <div class="col-xs-6 form-group">
      <label>
        <?php echo $this->getString('CLAIMS_EMAIL') ?>
      </label>
      <input type="tel" ng-model="ownerTenant.email" class="form-control" name="email" id="email{{$index}}">
    </div>
  </div>
</div>
<div id="wizard-form">
  <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>

</div>
