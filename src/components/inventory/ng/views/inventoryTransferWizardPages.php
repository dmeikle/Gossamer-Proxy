<!--Page 1-->
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 0" class="padding">

    <!--<ul class="content-list">-->

    <table class="table table-striped table-hover">
        <tr>
            <th class="col-md-3"><?php echo $this->getString('INVENTORY_EQUIPMENT_NAME') ?></th>
            <th class="col-md-3"><?php echo $this->getString('INVENTORY_EQUIPMENT_NUMBER') ?></th>
            <th class="col-md-3 "><?php echo $this->getString('INVENTORY_DESCRIPTION') ?></th>
            <th class="col-md-3"><?php echo $this->getString('INVENTORY_TRANSFER_LOCATION') ?></th>
        </tr>
        <tr ng-repeat="equipment in equipmentList">
            <td>{{equipment.type}}</td>
            <td>{{equipment.number}}</td>
            <td>{{equipment.description}}</td>
            <td>{{equipment.location.currentLocation}}</td>
        </tr>
    </table>


    <!--<li>-->
    <div class="spacer">

        <div class="col-xs-4">
            <strong><?php echo $this->getString('INVENTORY_TRANSFER_TO') ?></strong>
        </div>
        <div class="col-xs-8">
            <!--<div class="input-group">-->
            <select class="form-control" ng-model="transferTo" ng-change="clearTransfer()">
                <option value="" default>-<?php echo $this->getString('INVENTORY_SELECT_TRANSFER_LOCATION') ?>-</option>
                <option value="warehouse"><?php echo $this->getString('INVENTORY_WAREHOUSELOCATION') ?></option>
                <option value="vehicle"><?php echo $this->getString('INVENTORY_TRANSFER_VEHICLE') ?></option>
                <option value="claimLocation"><?php echo $this->getString('INVENTORY_CLAIM_LOCATION') ?></option>
            </select>
            <!--</div>-->
        </div>
        <!--</li>-->
        <!--</ul>-->
    </div>
    <div class="clearfix"></div>
    <div class="spacer" ng-if="transferTo" ng-switch="transferTo">
        <div class="col-xs-offset-4 col-xs-8" ng-switch-when="warehouse">
            <?php echo $transferForm['WarehouseLocations_id'] ?>
        </div>
        <div class="col-xs-offset-4 col-xs-8" ng-switch-when="vehicle">
            <?php echo $transferForm['Vehicles_id'] ?>
        </div>
        <div class="col-xs-offset-4 col-xs-8" ng-switch-when="claimLocation">
            <label><?php echo $this->getString('INVENTORY_TRANSFER_JOBNUMBER') ?></label>
            <?php echo $transferForm['jobNumber'] ?>
            <div ng-if="claimLocations" class="clearfix"></div>
            <label ng-if="claimLocations" class="spacer"><?php echo $this->getString('INVENTORY_UNIT_NUMBER') ?> (<?php echo $this->getString('INVENTORY_OPTIONAL') ?>)</label>
            <select ng-if="claimLocations" class="form-control" ng-model="transfer.ClaimsLocations_id" ng-options="value.ClaimsLocations_id as value.unitNumber for value in claimLocations"></select>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="widgetfooter clearfix spacer">
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

<!--Page 2-->
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
    <div class="clearfix"></div>
    <div class="form-group spacer">
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
