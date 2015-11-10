
<form method="post">

    <div class="modal-header" ng-switch="item.id">
        <h1 ng-switch-when="undefined" class="modal-title"><?php echo $this->getString('INVENTORY_NEW_VENDOR_ITEM'); ?></h1>
        <h1 class="modal-title" ng-switch-default><?php echo $this->getString('INVENTORY_EDIT_VENDOR_ITEM'); ?></h1>
        <div class="clearfix"></div>
    </div>
    <div class="modal-body">
        <?php echo $form['Vendors_id']; ?>
        <?php echo $form['InventoryItems_id']; ?>
        <?php echo $form['id']; ?>

        <div class="card">

            <div class="form-group">
                <label for="firstname"><?php echo $this->getString('INVENTORY_PACKAGETYPE'); ?></label>
                <?php echo $form['PackageTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="lastname"><?php echo $this->getString('INVENTORY_LEAD_TIME'); ?></label>
                <?php echo $form['leadTime']; ?>
            </div>
            <div class="form-group">
                <label for="dob"><?php echo $this->getString('INVENTORY_PRICE'); ?></label>
                <?php echo $form['price']; ?>
            </div>
            <div class="form-group">
                <label for="gender"><?php echo $this->getString('INVENTORY_MIN_ORDER_QUANTITY'); ?></label>
                <?php echo $form['minOrderQuantity']; ?>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer">
        <button class="primary" ng-click="submit(item)"><?php echo $this->getString('INVENTORY_CONFIRM'); ?></button>

        <button ng-click="close()"><?php echo $this->getString('INVENTORY_CANCEL'); ?></button>
    </div>
</form>