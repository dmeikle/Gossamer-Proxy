


<h2 class="form-signin-heading">Add Contact</h2>


<form method="post">
    <table class="table" ng-controller="contactsEditCtrl">
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?>:</td>
            <td>
                <?php echo $form['ContactTypes_id']; ?>
            </td>
        </tr>
        <tr valign="top" id="companyRow">
            <td><?php echo $this->getString('CONTACTS_COMPANY'); ?>:</td>
            <td>
                <input type="text" ng-model="company"
                       uib-typeahead="value as value.name for value in fetchCompaniesAutocomplete($viewValue)" typeahead-loading="loadingTypeaheadCompanies"
                       typeahead-no-results="noResultsCompanies" class="form-control" typeahead-min-length='3'
                       typeahead-on-select="setCompanyId(company);">
                <div class="resultspane" ng-show="noResultsCompanies">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIM_NORESULTS') ?>
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_FIRSTNAME'); ?>:</td>
            <td><?php echo $form['firstname']; ?></td>
        </tr>

        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_LASTNAME'); ?>:</td>
            <td><?php echo $form['lastname']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_EMAIL'); ?>:</td>
            <td><?php echo $form['email']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_MOBILE'); ?>:</td>
            <td><?php echo $form['mobile']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_HOME'); ?>:</td>
            <td><?php echo $form['home']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_OFFICE'); ?>:</td>
            <td><?php echo $form['office']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_EXTENSION'); ?>:</td>
            <td><?php echo $form['extension']; ?></td>
        </tr>
        <tr valign="top">
            <td><?php echo $this->getString('CONTACTS_NOTES'); ?>:</td>
            <td><label for="select"></label>
                <?php echo $form['notes']; ?></td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                <?php echo $form['submit']; ?>
                <?php echo $form['cancel']; ?>
                <button class="primary" ng-click="save(contact)"><?php echo $this->getString('CONTACTS_CONFIRM'); ?></button>

                <button ng-click="cancel()"><?php echo $this->getString('CONTACTS_CANCEL'); ?></button>
            </td>
        </tr>
    </table>
</form>