<!-- Inventory Item Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">
        <span ng-if="newItem"><?php echo $this->getString('ACCOUNTING_NEW'); ?></span>
        <span ng-if="!newItem"><?php echo $this->getString('ACCOUNTING_EDIT'); ?></span>
        <?php echo $this->getString('ACCOUNTING_INVENTORY_ITEM'); ?></h4>
</div>
<div class="modal-body">
    <div class="cards col-md-12">
        <div>
            <div class="form-group col-md-6">
                <label for="name"><?php echo $this->getString('ACCOUNTING_NAME'); ?></label>
                <?php echo $form['name']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="productCode"><?php echo $this->getString('ACCOUNTING_PRODUCT_CODE'); ?></label>
                <?php echo $form['productCode']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="description"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></label>
                <?php echo $form['description']; ?>
            </div>
            <!--            <div class="form-group col-md-6">
                            <label for="PackageTypes_id"><?php echo $this->getString('ACCOUNTING_PACKAGE_TYPE'); ?></label>
            <?php //echo $form['PackageTypes_id']; ?>
                        </div>-->
            <div class="form-group col-md-6">
                <label for="markup"><?php echo $this->getString('ACCOUNTING_MARKUP'); ?></label>
                <?php echo $form['markup']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="taxType"><?php echo $this->getString('ACCOUNTING_TAX_TYPE'); ?></label>
                <?php echo $form['taxType']; ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <button ng-click="cancel()"><?php echo $this->getString('ACCOUNTING_CANCEL'); ?></button>
    <button class="primary" ng-click="save(inventoryItem);
        clear()"><?php echo $this->getString('ACCOUNTING_SAVE_AND_NEW'); ?></button>
    <button class="primary" ng-click="save(inventoryItem);
        confirm()"><?php echo $this->getString('ACCOUNTING_SAVE_AND_CLOSE'); ?></button>
</div>