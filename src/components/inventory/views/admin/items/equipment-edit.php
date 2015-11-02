
<div ng-controller="inventoryEquipmentEditCtrl">
    <div class="col-xs-12 col-md-6">
        <?php echo $form['id'] ?>
        <div class="widget">
            <div class="widgetheader">
                <h1>
                    {{equipment.number}} <?php echo $this->getString('DETAILS') ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="widget">
            <div class="widgetheader">
                <h1>
                    <?php echo $this->getString('STATUS') ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <div class="widget">
            <div class="widgetheader">
                <h1>
                    <?php echo $this->getString('INVENTORY_EQUIPMENT_MAINTENANCEHISTORY') ?>
                </h1>
            </div>
        </div>
    </div>
</div>
