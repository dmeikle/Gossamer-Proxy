<div class="widget" ng-controller="inventoryEditCtrl">
    <div class="widgetheader">
        <h1 ng-if="item.id"><?php echo $this->getString('EDIT') ?> {{item.name}}</h1>
        <h1 ng-if="!item.id"><?php echo $this->getString('INVENTORY_NEWITEM') ?></h1>
    </div>
    <?php echo $form['id']; ?>
    <input type="hidden" ng-model="item.InventoryTypes_id" ng-init="item.InventoryTypes_id = 1">
    <div class="clearfix">
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_NAME') ?></label>
            <?php echo $form['name']; ?>
        </div>
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_PRODUCTCODE') ?></label>
            <?php echo $form['productCode']; ?>
        </div>
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_DESCRIPTION') ?></label>
            <?php echo $form['description']; ?>
        </div>
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_MINORDER') ?></label>
            <?php echo $form['minOrderQuantity']; ?>
            <span><small class="help-block"><?php echo $this->getString('INVENTORY_MINORDER_STRING') ?></small></span>
        </div>
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_MAXORDER') ?></label>
            <?php echo $form['maxQuantity']; ?>
        </div>
        <div class="form-group col-xs-12 col-md-4">
            <label for=""><?php echo $this->getString('INVENTORY_PACKAGETYPE') ?></label>
            <?php echo $form['PackageTypes_id']; ?>
        </div>
    </div>

    <form></form>
    <div class="widgetfooter clearfix">
        <div class="pull-right btn-group">
            <a href="/admin/inventory" class="btn btn-default">
                <?php echo $this->getString('CANCEL') ?>
            </a>
            <button class="btn-primary" ng-click="saveItem(item)">
                <?php echo $this->getString('SAVE') ?>
            </button>
        </div>
    </div>
</div>
