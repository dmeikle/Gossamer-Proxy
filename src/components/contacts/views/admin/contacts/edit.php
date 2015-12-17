<div  ng-controller="contactsEditCtrl">
    <div class="modal-header" ng-switch="contact.id">
        <h1 class="modal-title"><?php echo $this->getString('CONTACTS_ADD_NEW'); ?></h1>
    </div>
    <form method="post">
        <div class="modal-body">
            <div class="cards col-md-12">
                <div class="card-left col-md-6">
                    <?php echo $form['id']; ?>
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

                </div>

                <div class="card-right col-md-6">
                    <div class="form-group">
                        <label for="contact-company"><?php echo $this->getString('CONTACTS_COMPANY'); ?>:</label>

                        <input type="text" ng-model="company"
                               uib-typeahead="value as value.name for value in fetchCompaniesAutocomplete($viewValue)" typeahead-loading="loadingTypeaheadCompanies"
                               typeahead-no-results="noResultsCompanies" class="form-control" typeahead-min-length='3'
                               typeahead-on-select="setCompanyId(company);">
                        <div class="resultspane" ng-show="noResultsCompanies">
                            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-CompanyTypes_id"><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?></label>
                        <?php echo $form['ContactTypes_id']; ?>
                    </div>
                    <div class="form-group">
                        <label for="contact-ContactVIPTypes_id"><?php echo $this->getString('CONTACTS_VIP'); ?></label>
                        <?php echo $form['ContactVIPTypes_id']; ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-notes"><?php echo $this->getString('CONTACTS_NOTES'); ?></label>
                        <?php echo $form['notes']; ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer">
            <button class="btn btn-primary ng-scope" ng-click="save(contact)"><?php echo $this->getString('CONTACTS_CONFIRM'); ?></button>
            <button ng-click="/admin/contacts" class="btn-default ng-scope" ><?php echo $this->getString('CONTACTS_CANCEL'); ?></button>
        </div>
    </form>
</div>