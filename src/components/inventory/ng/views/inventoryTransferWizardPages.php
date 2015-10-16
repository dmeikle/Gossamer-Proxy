<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 0">
  <ul class="content-list">
    <li>
      <div class="col-xs-6">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_LOCATION') ?></strong>
      </div>
      <div class="col-xs-6">

      </div>
    </li>
    <li>
      <div class="col-xs-6">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_EQUIPMENT') ?></strong>
      </div>
      <div class="col-xs-6">
        <div ng-repeat="equipment in equipmentList">
          {{equipment.name}} - {{equipment.number}}
        </div>
      </div>
    </li>
    <li>
      <div class="col-xs-6">
        <strong><?php echo $this->getString('INVENTORY_TRANSFER_TO') ?></strong>
      </div>
      <div class="col-xs-6">
        <div class="form-group" ng-controller="claimsListCtrl">
          <input type="text" ng-model="transfer.transferTo.address" ng-model-options="{debounce:500}"
            typeahead="value.id as value.strata + ' ' + value.address1 for value in autocompleteAddress($viewValue)"
            typeahead-loading="loadingTypeaheadAddress" typeahead-no-results="noResultsAddress" class="form-control"
            typeahead-min-length='3'>
          <div class="resultspane" ng-show="noResultsAddress">
            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
          </div>
          <i ng-show="loadingTypeaheadAddress" class="glyphicon glyphicon-refresh"></i>
        </div>
        <div>
          <div class="form-group">
            <?php echo $claimLocationForm['Vehicles_id'] ?>
          </div>
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
