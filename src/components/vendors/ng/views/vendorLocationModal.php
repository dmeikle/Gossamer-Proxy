<div class="modal-header">
    <h1>
        <?php echo $this->getString('VENDORS_ADDLOCATION') ?>
    </h1>
</div>
<form class="modal-body">
    <div class="form-group col-xs-12 col-md-6">
        <label for="VendorLocation_address1">
            <?php echo $this->getString('VENDORS_LOCATION_ADDRESS') ?>
        </label>
        <?php echo $form['address1'] ?>
        <?php echo $form['address2'] ?>
        <label for="VendorLocation_city">
            <?php echo $this->getString('VENDORS_LOCATION_CITY') ?>
        </label>
        <?php echo $form['city'] ?>
        <label for="VendorLocation_Provinces_id">
            <?php echo $this->getString('VENDORS_LOCATION_PROVINCE') ?>
        </label>
        <?php echo $form['Provinces_id'] ?>
        <label for="VendorLocation_postalCode">
            <?php echo $this->getString('VENDORS_LOCATION_POSTALCODE') ?>
        </label>
        <?php echo $form['postalCode'] ?>
    </div>
    <div class="form-group col-xs-12 col-md-6">
        <label for="VendorLocation_Vendors_id">
            <?php echo $this->getString('VENDORS_VENDOR') ?>
        </label>
        <?php echo $form['Vendors_id'] ?>
        <label for="VendorLocation_accountId">
            <?php echo $this->getString('VENDORS_LOCATION_ACCOUNT') ?>
        </label>
        <?php echo $form['accountId'] ?>
        <label for="VendorLocation_salesRep">
            <?php echo $this->getString('VENDORS_LOCATION_SALESREP') ?>
        </label>
        <?php echo $form['salesRep'] ?>
        <label for="VendorLocation_telephone">
            <?php echo $this->getString('VENDORS_LOCATION_PHONE') ?>
        </label>
        <?php echo $form['telephone'] ?>
        <label for="VendorLocation_email">
            <?php echo $this->getString('VENDORS_LOCATION_EMAIL') ?>
        </label>
        <?php echo $form['email'] ?>

    </div>
    <div class="clearfix"></div>
</form>
<div class="modal-footer">
    <div class="btn-group pull-right">
        <button ng-click="close()" class="btn-default">
            <?php echo $this->getString('CLOSE') ?>
        </button>
        <button ng-click="submit()" class="primary">
            <?php echo $this->getString('CONFIRM') ?>
        </button>
    </div>
</div>
