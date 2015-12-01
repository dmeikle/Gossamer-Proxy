

<form role="form" class="form-standard" method="post" id="company-form" ng-controller="companyEditCtrl">
    <?php echo $form['companyId']; ?>
    <table class="table">
        <tr>
            <td>Name:</td>
            <td><div class="form-group"><?php echo $form['name']; ?></div></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <div class="form-group"><?php echo $form['CompanyTypes_id']; ?></div>
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>
                <div class="form-group"><?php echo $form['address1']; ?></div>
                <div class="form-group"><?php echo $form['address2']; ?></div>
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td>
                <div class="form-group"><?php echo $form['city']; ?></div>
            </td>
        </tr>
        <tr>
            <td>Province:</td>
            <td>
                <div class="form-group"><?php echo $form['Provinces_id']; ?></div>
            </td>
        </tr>
        <!--
        <tr>
            <td>Country:</td>
            <td><?php echo $form['Countries_id']; ?></td>
        </tr>
        -->
        <tr>
            <td>Postal Code:</td>
            <td>
                <div class="form-group"><?php echo $form['postalCode']; ?></div>
            </td>
        </tr>
        <tr>
            <td>Telephone:</td>
            <td>
                <div class="form-group"><?php echo $form['telephone']; ?></div>
            </td>
        </tr>
        <tr>
            <td>Fax:</td>
            <td>
                <div class="form-group"><?php echo $form['fax']; ?></div>
            </td>
        </tr>
        <tr>
            <td>URL:</td>
            <td>
                <div class="form-group"><?php echo $form['url']; ?></div>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>

                <button class="primary" ng-click="save(company)" ng-disabled="!company">
                    <?php echo $this->getString('COMPANY_CONFIRM'); ?>
                </button>
                <button ng-click="cancel()"><?php echo $this->getString('COMPANY_CANCEL'); ?></button>
            </td>
        </tr>
    </table>
</form>
