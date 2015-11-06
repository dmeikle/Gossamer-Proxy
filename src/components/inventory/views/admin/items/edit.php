<div class="widget col-md-5" ng-controller="inventoryEditItemCtrl">
    <div class="widgetheader">
        <h1 ng-if="item.id"><?php echo $this->getString('EDIT') ?> {{item.name}}</h1>
        <h1 ng-if="!item.id"><?php echo $this->getString('INVENTORY_NEWITEM') ?></h1>
    </div>
    <?php echo $form['id']; ?>
    <input type="hidden" ng-model="item.InventoryTypes_id" ng-init="item.InventoryTypes_id = 1">


    <table class="table">
        <tr>
            <td><?php echo $this->getString('INVENTORY_NAME') ?>:</td>
            <td><?php echo $form['name']; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getString('INVENTORY_PRODUCTCODE') ?>:</td>
            <td><?php echo $form['productCode']; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getString('INVENTORY_DESCRIPTION') ?>:</td>
            <td><?php echo $form['description']; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getString('INVENTORY_MINORDER') ?>:</td>
            <td><?php echo $form['minOrderQuantity']; ?>
                <span><small class="help-block"><?php echo $this->getString('INVENTORY_MINORDER_STRING') ?></small></span>
            </td>
        </tr>
        <tr>
            <td><?php echo $this->getString('INVENTORY_MAXORDER') ?>:</td>
            <td><?php echo $form['maxQuantity']; ?></td>
        </tr>
        <tr>
            <td><?php echo $this->getString('INVENTORY_PACKAGETYPE') ?>:</td>
            <td><?php echo $form['PackageTypes_id']; ?></td>
        </tr>
        <tr>
            <td>Inventory Type:</td>
            <td><?php echo $form['InventoryTypes_id']; ?></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td><?php echo $form['InventoryCategories_id']; ?></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Tax Type:</td>
            <td><?php echo $form['AccountingTaxTypes_id']; ?></td>
        </tr>
        <tr>
            <td>MarkUp:</td>
            <td><?php echo $form['markup']; ?></td>
        </tr>
        <tr>
            <td>Warehouse Location:</td>
            <td><?php echo $form['WarehouseLocations_id']; ?></td>
        </tr>
    </table>
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
<div class="col-md-1"></div>
<div class="widget col-md-5" ng-controller="inventoryEditItemCtrl">
    this is for displaying list of vendors and prices for this item


</div>