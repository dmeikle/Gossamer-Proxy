<div class="widget" ng-controller="posCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1><?php echo $this->getString('ACCOUNTING_NEW_POS') ?></h1>
        
        <div class="pull-left col-md-3">
            
            <div class="form-group">
                <label for="vendors"><?php echo $this->getString('ACCOUNTING_VENDOR'); ?></label>
                <?php echo $form['Vendors_id']; ?>
            </div>
            
            <div class="form-group">
                <label for="departments"><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></label>
                <?php echo $form['Departments_id']; ?>
            </div>
        </div>
        
        <div class="pull-right col-md-3">
            <div class="form-group">
                <label for="paymentMethods"><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?></label>
                <?php echo $form['AccountingPaymentsMethods_id']; ?>
            </div>
            
            <div class="form-group">
                <label for="phaseCode"><?php echo $this->getString('ACCOUNTING_PHASE'); ?></label>
                <?php echo $form['AccountingPhaseCodes']; ?>
            </div>
            
            <div class="form-group">
                <label for="description"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></label>
                <?php echo $form['description']; ?>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
                <label for="status"><?php echo $this->getString('ACCOUNTING_STATUS'); ?></label>
                <?php echo $form['status']; ?>
            </div>
            
            <div class="form-group">
                <label for="tax"><?php echo $this->getString('ACCOUNTING_TAX'); ?></label>
                <?php echo $form['tax']; ?>
            </div>

            <div class="form-group">
                <label for="deliveryFee"><?php echo $this->getString('ACCOUNTING_DELIVERY_FEE'); ?></label>
                <?php echo $form['deliveryFee']; ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>