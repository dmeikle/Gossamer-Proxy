<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 0">

    <ul class="content-list">
        <li>
            <div class="col-xs-4">
                <strong><?php echo $this->getString('INVENTORY_TRANSFER_LOCATION') ?></strong>
            </div>
            <div class="col-xs-8">
                <div ng-repeat="equipment in equipmentList">
                    {{equipment.location.currentLocation}}
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

                <div ng-if="equipmentList[0].location.warehouseLocation">
                    <div class="form-group">
                      <!-- <input type="radio" name="cageTransferBy" ng-model="cageTransferBy" value="Vehicles_id" id=""> -->
                        <label for="ClaimLocation_Vehicles_id"><?php echo $this->getString('INVENTORY_TRANSFER_VEHICLE') ?></label>
                        <?php echo $transferForm['Vehicles_id'] ?>
                    </div>
                </div>

                <div ng-if="equipmentList[0].location.vehicleNumber">
                    <div  class="form-group">
                      <!-- <input type="radio" name="vehicleTransferBy" ng-model="vehicleTransferBy" value="WarehouseLocations_id" id=""> -->
                        <label><?php echo $this->getString('INVENTORY_TRANSFER_WAREHOUSE') ?></label>
                        <?php echo $transferForm['WarehouseLocations_id'] ?>
                    </div>
                    <div class="form-group">
                        <div>
                          <!-- <input type="radio" name="vehicleTransferBy" ng-model="vehicleTransferBy" value="jobNumber" id=""> -->
                            <label><?php echo $this->getString('INVENTORY_TRANSFER_JOBNUMBER') ?></label>
                            <input type="text" ng-model="Claim" ng-model-options="{debounce:500}"
                                   uib-typeahead="value as value[0].jobNumber for value in autocompleteJobNumber($viewValue)"
                                   typeahead-loading="loadingTypeaheadJobNumber" typeahead-no-results="noResultsJobNumber" class="form-control"
                                   typeahead-min-length='2'>
                            <div class="resultspane" ng-show="noResultsJobNumber">
                                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                            </div>
                            <i ng-show="loadingTypeaheadJobNumber" class="glyphicon glyphicon-refresh"></i>
                            <div ng-if="Claim[0].jobNumber">
                                <select class="form-control" ng-model="transfer.ClaimsLocations_id" ng-options="value.ClaimsLocations_id as value.unitNumber for value in Claim"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <!-- <input type="radio" name="vehicleTransferBy" ng-model="vehicleTransferBy" value="Vehicles_id" id=""> -->
                        <label><?php echo $this->getString('INVENTORY_TRANSFER_VEHICLE') ?></label>
                        <?php echo $transferForm['Vehicles_id'] ?>
                    </div>
                </div>
                <div ng-if="equipmentList[0].location.unitNumber">
                    <div class="form-group">
                      <!-- <input type="radio" name="unitNumberTransferBy" ng-model="unitNumberTransferBy" value="Vehicles_id" id=""> -->
                        <label><?php echo $this->getString('INVENTORY_TRANSFER_VEHICLE') ?></label>
                        <?php echo $transferForm['Vehicles_id'] ?>
                    </div>
                    <div class="form-group">
                      <!-- <input type="radio" name="unitNumberTransferBy" ng-model="unitNumberTransferBy" value="unitNumber" id=""> -->
                        <label><?php echo $this->getString('INVENTORY_TRANSFER_UNIT') ?></label>
                        <?php echo $claimLocationForm['unitNumber'] ?>
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
<form id="wizard-form" name="wizard-form" ng-submit="submit()" ng-show="currentPage === 1">
    <div class="col-xs-12">
        <p><?php echo $this->getString('INVENTORY_TRANSFER_ACKNOWLEDGE') ?></p>
    </div>
    <div class="form-group">
        <label class="col-xs-4"><?php echo $this->getString('USERNAME') ?></label>
        <div class="col-xs-8">
            <input type="text" name="transfer[username]" ng-model="transfer.Staff.username"
                   class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-4"><?php echo $this->getString('PASSWORD') ?></label>
        <div class="col-xs-8">
            <input type="password" name="transfer[password]" ng-model="transfer.Staff.password"
                   class="form-control">
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