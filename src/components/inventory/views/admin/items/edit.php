<div  ng-controller="inventoryEditItemCtrl">

    <div class="widget col-md-6">
        <div class="widgetheader">
            <h1 ng-if="item.id"><?php echo $this->getString('EDIT') ?> {{item.name}}</h1>
            <h1 ng-if="!item.id"><?php echo $this->getString('INVENTORY_NEWITEM') ?></h1>
        </div>
        <?php echo $form['id']; ?>
        <input type="hidden" ng-model="item.InventoryTypes_id" ng-init="item.InventoryTypes_id = 1">


        <table class="table">
            <tr>
                <td><?php echo $this->getString('INVENTORY_NAME') ?>:</td>
                <td><div class="form-group"><?php echo $form['name']; ?></div></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('INVENTORY_PRODUCTCODE') ?>:</td>
                <td><div class="form-group"><?php echo $form['productCode']; ?></div></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('INVENTORY_DESCRIPTION') ?>:</td>
                <td><div class="form-group"><?php echo $form['description']; ?></div></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('INVENTORY_MINORDER') ?>:</td>
                <td><div class="form-group">
                        <?php echo $form['minOrderQuantity']; ?>
                        <span><small class="help-block"><?php echo $this->getString('INVENTORY_MINORDER_STRING') ?></small></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td><?php echo $this->getString('INVENTORY_MAXORDER') ?>:</td>
                <td><div class="form-group"><?php echo $form['maxQuantity']; ?></div></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('INVENTORY_PACKAGETYPE') ?>:</td>
                <td><div class="form-group"><?php echo $form['PackageTypes_id']; ?></div></td>
            </tr>
            <tr>
                <td>Inventory Type:</td>
                <td><div class="form-group"><?php echo $form['InventoryTypes_id']; ?></div></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td><div class="form-group"><?php echo $form['InventoryCategories_id']; ?></div></td>
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
                <td><div class="form-group"><?php echo $form['AccountingTaxTypes_id']; ?></div></td>
            </tr>
            <tr>
                <td>MarkUp:</td>
                <td><div class="form-group"><?php echo $form['markup']; ?></div></td>
            </tr>
            <tr>
                <td>Warehouse Location:</td>
                <td><div class="form-group"><?php echo $form['WarehouseLocations_id']; ?></div></td>
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
    <div class="col-md-6">
        this is for displaying list of vendors and prices for this item
        <div class="widget" >
            <div class="widget-content">
                <div class="form-items">
                    <button class="btn-info" ng-click="addRow()"><?php echo $this->getString('INVENTORY_NEW_ROW'); ?></button>
                    <button class="btn-info" ng-click="insertRows()" ng-disabled="!rowSelected"><?php echo $this->getString('INVENTORY_INSERT_ROW'); ?></button>
                    <button class="btn-warning" ng-click="removeRows();" ng-disabled="!rowSelected"><?php echo $this->getString('INVENTORY_DELETE_ROW'); ?></button>

                    <div ng-if="loading">
                        <span class="spinner-loader"></span>
                    </div>
                    <div ng-if="!loading">
                        <table class="table" ng-repeat="row in lineItems track by $index">
                            <tr><td colspan="5" style="background-color: #059ADE"></td></tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <?php echo $this->getString('INVENTORY_VENDOR'); ?>
                                    <?php echo $vendorForm['id']; ?>
                                </td>
                                <td><?php echo $this->getString('INVENTORY_PRODUCTCODE'); ?></td>
                                <td><?php echo $this->getString('INVENTORY_PRICE'); ?></td>
                                <td><?php echo $this->getString('INVENTORY_PREFERRED'); ?></td>
                            </tr>
                            <tr>
                                <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                                <td><div class="form-group"><?php echo $vendorForm['vendorsAutocomplete']; ?></div></td>
                                <td><div class="form-group"><?php echo $vendorForm['productCode']; ?><div class="form-group"></div></td>
                                <td><div class="form-group"><?php echo $vendorForm['price']; ?></div></td>
                                <td><div class="form-group"><?php echo $vendorForm['isPreferredVendor']; ?></div></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><?php echo $this->getString('INVENTORY_NUM_PER_BOX'); ?></td>
                                <td><?php echo $this->getString('INVENTORY_MIN_ORDER_QUANTITY'); ?></td>
                                <td>package type</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><div class="form-group"><?php echo $vendorForm['numPerBox']; ?></div></td>
                                <td><div class="form-group"><?php echo $vendorForm['minOrderQuantity']; ?></div></td>
                                <td><div class="form-group"><?php echo $vendorForm['PackageTypes_id']; ?></div></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="widgetfooter clearfix">
                    <div class="pull-right btn-group">
                        <a href="/admin/inventory" class="btn btn-default">
                            <?php echo $this->getString('CANCEL') ?>
                        </a>
                        <button class="btn-primary" ng-click="saveLineItems()">
                            <?php echo $this->getString('SAVE') ?>
                        </button>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
