<div class="modal-header" ng-switch="contact.id">
    <h1 class="modal-title"><?php echo $this->getString('CONTACTS_ADDNEW'); ?></h1>
</div>
<form method="post">
    <div class="modal-body">

        <div class="card">
            <div class="cardheader">
                <h1 class="pull-left"><?php echo $this->getString('CONTACTS_PERSONAL_INFO'); ?></h1>
            </div>
            <div class="clearfix"></div>

            <div class="form-group">
                <label for="contact-CompanyTypes_id"><?php echo $this->getString('CONTACTS_COMPANYTYPE'); ?></label>
                <?php echo $form['ContactTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="contact-ContactVIPTypes_id"><?php echo $this->getString('CONTACTS_VIP'); ?></label>
                <?php echo $form['ContactVIPTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="contact-firstname"><?php echo $this->getString('CONTACTS_FIRSTNAME'); ?></label>
                <?php echo $form['firstname']; ?>
            </div>
            <div class="form-group">
                <label for="contact-lastname"><?php echo $this->getString('CONTACTS_LASTNAME'); ?></label>
                <?php echo $form['lastname']; ?>
            </div>
            <div class="form-group">
                <label for="contact-personalEmail"><?php echo $this->getString('CONTACTS_PERSONALEMAIL'); ?></label>
                <?php echo $form['email']; ?>
            </div>
            <div class="form-group">
                <label for="contact-mobile"><?php echo $this->getString('CONTACTS_MOBILE'); ?></label>
                <?php echo $form['mobile']; ?>
            </div>
            <div class="form-group">
                <label for="contact-office"><?php echo $this->getString('CONTACTS_OFFICE'); ?></label>
                <?php echo $form['office']; ?>
            </div>
            <div class="form-group">
                <label for="contact-home"><?php echo $this->getString('CONTACTS_HOME'); ?></label>
                <?php echo $form['home']; ?>
            </div>
            <div class="form-group">
                <label for="contact-extension"><?php echo $this->getString('CONTACTS_EXTENSION'); ?></label>
                <?php echo $form['extension']; ?>
            </div>
            <div class="form-group">
                <label for="contact-notes"><?php echo $this->getString('CONTACTS_NOTES'); ?></label>
                <?php echo $form['notes']; ?>
            </div>

            <div class="clearfix"></div>
        </div>



        <div class="clearfix"></div>
    </div>
<div class="clearfix"></div>
<div class="modal-footer">
    <button class="primary" ng-click="confirm(contact)"><?php echo $this->getString('CONTACTS_CONFIRM'); ?></button>

    <button ng-click="cancel()"><?php echo $this->getString('CONTACTS_CANCEL'); ?></button>
</div>

</form>