<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 0">

  <ul class="content-list">
    <li>
      <div class="col-xs-4">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_LOCATION') ?></strong>
      </div>
      <div class="col-xs-8">
        <div ng-if="equipmentList[0].WarehouseLocations_id">
          {{warehouseLocation}}
        </div>

        <get-vehicle>
          <?php foreach ($this->data['Vehicles'] as $vehicle): ?>
            <input type="hidden" class="vehicle" data-id="<?php echo $vehicle['id']?>"
              data-number="<?php echo $vehicle['number']?>"
              data-licensePlate="<?php echo $vehicle['licensePlate']?>">
          <?php endforeach; ?>
        </get-vehicle>
        <!-- <div ng-if="equipmentList[0].Vehicles_id"> -->
        <div>
          {{vehicle.number}} ({{vehicle.licensePlate}})
        </div>
      </div>
    </li>
    <li>
      <div class="col-xs-4">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_EQUIPMENT') ?></strong>
      </div>
      <div class="col-xs-8">
        <div ng-repeat="equipment in equipmentList">
          {{equipment.number}} ({{equipment.productCode}})
        </div>
      </div>
    </li>
    <li>
      <div class="col-xs-4">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_TO') ?></strong>
      </div>
      <div class="col-xs-8">
        <div class="form-group" ng-controller="claimsListCtrl">
          <div>
            <label><?php echo $this->getString('INVENTORY_TRANSFER_JOBNUMBER')?></label>
            <input type="text" ng-model="transfer.transferTo.jobNumber" ng-model-options="{debounce:500}"
              typeahead="value.jobNumber as value.jobNumber + ' - ' + value.buildingName for value in autocompleteJobNumber($viewValue)"
              typeahead-loading="loadingTypeaheadJobNumber" typeahead-no-results="noResultsAddress" class="form-control"
              typeahead-min-length='3'>
            <div class="resultspane" ng-show="noResultsJobNumber">
              <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
            </div>
            <i ng-show="loadingTypeaheadJobNumber" class="glyphicon glyphicon-refresh"></i>
          </div>
        </div>
        <div class="form-group">

        </div>
        <div ng-if="equipmentList[0].Vehicles_id" class="form-group">
          <label><?php echo $this->getString('INVENTORY_TRANSFER_VEHICLE') ?></label>
          <?php echo $claimLocationForm['Vehicles_id'] ?>
        </div>
      </div>
    </li>
  </ul>
  <div class="clearfix"></div>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="close()">
        <?php echo $this->getString('CANCEL'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('NEXT'); ?>
      </button>
    </div>
  </div>
</form>
<form id="wizard-form" name="wizard-form" ng-submit="submit()"ng-show="currentPage === 1">
  <div class="col-xs-12">
    <p><?php echo $this->getString('INVENTORY_TRANSFER_ACKNOWLEDGE') ?></p>
  </div>
  <div class="form-group">
    <label class="col-xs-4"><?php echo $this->getString('USERNAME') ?></label>
    <div class="col-xs-8">
      <?php echo $staffAuthorizationForm['username'] ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-xs-4"><?php echo $this->getString('PASSWORD') ?></label>
    <div class="col-xs-8">
      <?php echo $staffAuthorizationForm['password'] ?>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('BACK'); ?>
      </button>
      <button type="submit" class="btn btn-primary">
        <?php echo $this->getString('AUTHORIZE'); ?>
      </button>
    </div>
  </div>
</form>
