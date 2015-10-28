<div class="widget" ng-controller="posCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1><?php echo $this->getString('ACCOUNTING_NEW_POS') ?></h1>
        
        <div class="input-row">            
        
            <div class="input-group">
                <label>Vendor</label>
                <select class="phase form-control" name="AccountingPhaseCodes_id" ng-model="PurchaseOrder.ClaimPhases_id">
                    <option value="" selected>-Phase Code-</option>
                    <?php
                    foreach ($AccountingPhaseCodes as $phase) {
                        echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <label>Phase</label>
                <select class="form-control" name="Vendor_id" ng-model="PurchaseOrder.Vendor_id">
                    <option value="" selected>-Phase Code-</option>
                    <?php
                    foreach ($AccountingPhaseCodes as $phase) {
                        echo '<option data-rateVariance="' . $phase['rateVariance'] . '" value="' . $phase['id'] . '">' . $phase['phaseCode'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <label>Department</label>
                <select class="form-control" name="Departments_id" ng-model="PurchaseOrder.Departments_id">
                    <option value="" selected>-Phase Code-</option>
                    <?php
                    foreach ($Departments as $department) {
                        echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>