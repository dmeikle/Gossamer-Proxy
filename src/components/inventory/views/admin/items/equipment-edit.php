
<div ng-controller="inventoryEquipmentEditCtrl">
    <div class="col-xs-12 col-md-6">
        <?php echo $form['id'] ?>
        <div class="widget">
            <div class="widgetheader">
                <h1>
                    {{item.number}} <?php echo $this->getString('DETAILS') ?>
                </h1>
            </div>
            <table class="table cardtable">
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_NAME') ?>
                        </strong>
                    </td>
                    <td>
                        {{item.InventoryItem.name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_DESCRIPTION') ?>
                        </strong>
                    </td>
                    <td>
                        {{item.InventoryItem.description}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_MAXDAYS') ?>
                        </strong>
                    </td>
                    <td>
                        <?php echo $form['maxDays'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_PRICE') ?>
                        </strong>
                    </td>
                    <td>
                        <?php echo $form['price'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_TYPE') ?>
                        </strong>
                    </td>
                    <td>
                        <?php echo $form['InventoryEquipmentTypes_id'] ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="widget">
            <div class="widgetheader">
                <h1>
                    <?php echo $this->getString('STATUS') ?>
                </h1>
            </div>
            <table class="table cardtable">
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_LOCATION') ?>
                        </strong>
                    </td>
                    <td>
                        {{transferHistory[0].currentLocation}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_MAINTENANCESTATUS') ?>
                        </strong>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>
                            <?php echo $this->getString('INVENTORY_EQUIPMENT_MAINTENANCEDAYS') ?>
                        </strong>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
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
            <?php echo $this->getString('COMING_SOON') ?>
            <table class="table">
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
