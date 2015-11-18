

<div class="modal-header" ng-switch="subcontractor.id">
    <h1 class="modal-title"><?php echo $this->getString('SUBCONTRACTORS_ADD_NEW'); ?></h1>
</div>
<form method="post">
    <?php echo $form['id']; ?>
    <div class="modal-body">
        <div class="cards col-md-12">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('SUBCONTRACTORS_INFO'); ?></h1>
            </div>
            <div class="clearfix"></div>
            <div class="card-left col-md-6">


                <div class="form-group">
                    <label for="subcontractors-subcontractorsName"><?php echo $this->getString('SUBCONTRACTORS_NAME'); ?></label>
                    <?php echo $form['companyName']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-telephone"><?php echo $this->getString('SUBCONTRACTORS_TELEPHONE'); ?></label>
                    <?php echo $form['telephone']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-address1"><?php echo $this->getString('SUBCONTRACTORS_ADDRESS'); ?></label>
                    <?php echo $form['address1']; ?>
                    <?php echo $form['address2']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-city"><?php echo $this->getString('SUBCONTRACTORS_CITY'); ?></label>
                    <?php echo $form['city']; ?>
                </div>

                <div class="form-group">
                    <label for="subcontractors-Provinces_id"><?php echo $this->getString('SUBCONTRACTORS_PROVINCE'); ?></label>
                    <?php echo $form['Provinces_id']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-postalCode"><?php echo $this->getString('SUBCONTRACTORS_POSTAL_CODE'); ?></label>
                    <?php echo $form['postalCode']; ?>
                </div>
            </div>
            <div class="card-right col-md-6">

                <div class="form-group">
                    <label for="subcontractors-SubcontractorTypes_id"><?php echo $this->getString('SUBCONTRACTORS_TYPE'); ?></label>
                    <?php echo $form['SubcontractorTypes_id']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-url"><?php echo $this->getString('SUBCONTRACTORS_URL'); ?></label>
                    <?php echo $form['url']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-email"><?php echo $this->getString('SUBCONTRACTORS_EMAIL'); ?></label>
                    <?php echo $form['email']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-postalCode"><?php echo $this->getString('SUBCONTRACTORS_POSTAL_CODE'); ?></label>
                    <?php echo $form['postalCode']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-rating"><?php echo $this->getString('SUBCONTRACTORS_RATING'); ?></label>
                    <?php echo $form['rating']; ?>
                </div>
                <div class="form-group">
                    <label for="subcontractors-notes"><?php echo $this->getString('SUBCONTRACTORS_NOTES'); ?></label>
                    <?php echo $form['notes']; ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</form>

<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
    <button class="primary" ng-click="confirm(subcontractor)"><?php echo $this->getString('SUBCONTRACTORS_CONFIRM'); ?></button>

    <button ng-click="cancel()"><?php echo $this->getString('SUBCONTRACTORS_CANCEL'); ?></button>
</div>
