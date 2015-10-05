<form id="wizard-form" name="wizard-form"  ng-submit="nextPage()" ng-show="currentPage === 0">
  <div class="col-xs-6 form-group">
    <label for="jobsheet-location"><?php echo $this->getString('CLAIMS_LOCATION') ?></label>
    <input type="text" id="jobsheet-location" class="form-control" ng-model="jobSheet.query.location" required>
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-source"><?php echo $this->getString('CLAIMS_SOURCE') ?></label>
    <label for="jobsheet-is-source">
      <input type="checkbox" name="jobsheet-is-source" id="jobsheet-is-source" ng-model="jobSheet.isSource">
      <?php echo $this->getString('CLAIMS_ISSOURCE') ?>
    </label>
    <input type="text" name="jobsheet-source" id="jobsheet-source" class="form-control" ng-model="jobSheet.query.source" ng-disabled="!jobSheet.isSource"
      ng-required="jobSheet.isSource">
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-workAuthorization"><?php echo $this->getString('CLAIMS_WORKAUTHORIZATION') ?></label>
    <div class="input-group">
      <label for="jobsheet-is-workAuthorization">
        <input type="checkbox" name="jobsheet-is-workAuthorization" id="jobsheet-is-workAuthorization" ng-model="jobSheet.query.workAuthorization">
        <?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>
      </label>
    </div>
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
        <input type="checkbox" name="jobsheet-pictures" id="jobsheet-pictures" ng-model="jobSheet.query.pictures">
        <?php echo $this->getString('CLAIMS_ISPICTURES') ?>
      </label>
    </div>
  </div>
  <div class="col-xs-6 form-group">
    <label for="jobsheet-keys"><?php echo $this->getString('CLAIMS_KEYS') ?></label>
    <label for="jobsheet-is-keys">
      <input type="checkbox" name="jobsheet-is-keys" id="jobsheet-is-keys" ng-model="jobSheet.keys">
      <?php echo $this->getString('CLAIMS_ISKEYS') ?>
    </label>
    <input type="text" id="jobsheet-keys" class="form-control" ng-model="jobSheet.query.keys"
    ng-disabled="!jobSheet.keys" ng-required="jobSheet.keys">
  </div>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
      </button>
    </div>
  </div>
</form>
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 1">
  <div class="toolbar">
    <a href="" class="btn btn-default" ng-click="addOwnerTenant()">
      <?php echo $this->getString('NEW') ?>
    </a>
  </div>
  <div ng-repeat="ownerTenant in jobSheet.query.ownerTenant">
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
        <button ng-click="removeOwnerTenant($event, $index)" class="btn-link">
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
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
      </button>
    </div>
  </div>
</form>
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 2">
  <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>
  <div class="col-xs-12 col-md-4">
    <div>
      <label for="jobsheet-entry">
        <?php echo $this->getString('CLAIMS_JOBSHEET_ENTRY') ?>
        <input type="checkbox" name="jobsheet-entry" id="jobsheet-entry"
          ng-model="jobSheet.query.affectedAreas.entry">
      </label>
    </div>
    <div>
      <label for="jobSheet-closet">
        <?php echo $this->getString('CLAIMS_JOBSHEET_CLOSET') ?>
        <input type="checkbox" name="jobSheet-closet" id="jobSheet-closet"
        ng-model="jobSheet.query.affectedAreas.closet">
      </label>
    </div>
    <div>
      <label for="jobSheet-hallway">
        <?php echo $this->getString('CLAIMS_JOBSHEET_HALLWAY') ?>
        <input type="checkbox" name="jobSheet-hallway" id="jobSheet-hallway"
          ng-model="jobSheet.query.affectedAreas.hallway">
      </label>
    </div>
    <div>
      <label for="jobSheet-kitchen">
        <?php echo $this->getString('CLAIMS_JOBSHEET_KITCHEN') ?>
        <input type="checkbox" name="jobSheet-kitchen" id="jobSheet-kitchen"
          ng-model="jobSheet.query.affectedAreas.kitchen">
      </label>
    </div>
  </div>


  <div class="col-xs-12 col-md-4">
    <div>
      <label for="jobsheet-livingroom">
        <?php echo $this->getString('CLAIMS_JOBSHEET_LIVINGROOM') ?>
        <input type="checkbox" name="jobsheet-livingroom" id="jobsheet-livingroom"
          ng-model="jobSheet.query.affectedAreas.livingroom">
      </label>
    </div>
    <div>
      <label for="jobSheet-diningroom">
        <?php echo $this->getString('CLAIMS_JOBSHEET_DININGROOM') ?>
        <input type="checkbox" name="jobSheet-diningroom" id="jobSheet-diningroom"
          ng-model="jobSheet.query.affectedAreas.diningroom">
      </label>
    </div>
    <div>
      <label for="jobSheet-bathroom1">
        <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM1') ?>
        <input type="checkbox" name="jobSheet-bathroom1" id="jobSheet-bathroom1"
          ng-model="jobSheet.query.affectedAreas.bathroom1">
      </label>
    </div>
    <div>
      <label for="jobSheet-bathroom2">
        <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM2') ?>
        <input type="checkbox" name="jobSheet-bathroom2" id="jobSheet-bathroom2"
          ng-model="jobSheet.query.affectedAreas.bathroom2">
      </label>
    </div>
  </div>


  <div class="col-xs-12 col-md-4">
    <div>
      <label for="jobsheet-masterBed">
        <?php echo $this->getString('CLAIMS_JOBSHEET_MASTERBED') ?>
        <input type="checkbox" name="jobsheet-masterBed" id="jobsheet-masterBed"
          ng-model="jobSheet.query.affectedAreas.masterBed">
      </label>
    </div>
    <div>
      <label for="jobsheet-bedroom1">
        <?php echo $this->getString('CLAIMS_JOBSHEET_BEDROOM1') ?>
        <input type="checkbox" name="jobsheet-bedroom1" id="jobsheet-bedroom1"
          ng-model="jobSheet.query.affectedAreas.bedroom1">
      </label>
    </div>
    <div>
      <label for="jobsheet-den">
        <?php echo $this->getString('CLAIMS_JOBSHEET_DEN') ?>
        <input type="checkbox" name="jobsheet-den" id="jobsheet-den"
          ng-model="jobSheet.query.affectedAreas.den">
      </label>
    </div>
    <div>
      <label for="jobSheet-laundry">
        <?php echo $this->getString('CLAIMS_JOBSHEET_LAUNDRY') ?>
        <input type="checkbox" name="jobSheet-laundry" id="jobSheet-laundry"
          ng-model="jobSheet.query.affectedAreas.laundry">
      </label>
    </div>
    <div>
      <label for="jobSheet-is-other">
        <?php echo $this->getString('CLAIMS_JOBSHEET_OTHER') ?>
        <input type="checkbox" name="jobSheet-is-other" id="jobSheet-is-other"
          ng-model="jobSheet.isOther">
      </label>
      <input type="text" class="form-control" ng-disabled="!jobSheet.isOther"
         ng-required="jobSheet.isOther" ng-model="jobSheet.query.affectedAreas.other">
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-xs-12">
    <label for="jobsheet-is-asbestos">
      <?php echo $this->getString('CLAIMS_JOBSHEET_ASBESTOS') ?>
      <input type="checkbox" name="jobsheet-is-asbestos" id="jobsheet-is-asbestos"
        ng-model="jobSheet.isAsbestos">
    </label>
    <input type="text" class="form-control" ng-disabled="!jobSheet.isAsbestos"
      ng-required="jobSheet.isAsbestos" ng-model="jobSheet.query.affectedAreas.asbestosSample">
  </div>
  <div class="col-xs-12">
    <label for="jobsheet-existing">
      <?php echo $this->getString('CLAIMS_JOBSHEET_EXISTING') ?>
      <input type="checkbox" name="jobsheet-isexisting" id="jobsheet-isexisting"
        ng-model="jobSheet.isExisting">
    </label>
    <textarea name="jobsheet-existing" id="jobsheet-existing" class="form-control"
      ng-disabled="!jobSheet.isExisting" ng-required="jobSheet.isExisting" rows="8" cols="40"
      ng-model="jobSheet.query.affectedAreas.existing"></textarea>
  </div>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
      </button>
    </div>
  </div>
</form>

<form id="wizard-form" ng-submit="confirm()" ng-show="currentPage === 3">
  <table class="table">
    <tbody>
      <tr>
        <td>
          <strong><?php echo $this->getString('CLAIMS_JOBSHEET_BLOWERS') ?></strong>
        </td>
        <td>
          Bind equipment here
        </td>
      </tr>
      <tr>
        <td>
          <strong><?php echo $this->getString('CLAIMS_JOBSHEET_DEHUMS') ?></strong>
        </td>
        <td>
          Bind equipment here
        </td>
      </tr>
      <tr>
        <td>
          <strong><?php echo $this->getString('CLAIMS_JOBSHEET_AIRSCRUB') ?></strong>
        </td>
        <td>
          Bind equipment here
        </td>
      </tr>
      <tr>
        <td>
          <strong><?php echo $this->getString('CLAIMS_JOBSHEET_INJECTIDRY') ?></strong>
        </td>
        <td>
          Bind equipment here
        </td>
      </tr>
      <tr>
        <td>
          <strong><?php echo $this->getString('CLAIMS_JOBSHEET_EXTEN') ?></strong>
        </td>
        <td>
          Bind equipment here
        </td>
      </tr>
      <tr>
        <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_ELEC') ?></strong></td>
        <td>
          Bind equipment here
        </td>
      </tr>
    </tbody>
  </table>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
      </button>
    </div>
  </div>
</form>
