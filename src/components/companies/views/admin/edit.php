

<form role="form" class="form-standard" method="post" id="company-form" ng-controller="companyEditCtrl">
    <?php echo $form['companyId']; ?>
    <table class="table">
        <tr>
            <td>Name:</td>
            <td ng-init="name = 'dave'"><?php echo $form['name']; ?></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <?php echo $form['CompanyTypes_id']; ?>
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $form['address1']; ?>
                <?php echo $form['address2']; ?></td>
        </tr>
        <tr>
            <td>City:</td>
            <td><?php echo $form['city']; ?></td>
        </tr>
        <tr>
            <td>Province:</td>
            <td><?php echo $form['Provinces_id']; ?></td>
        </tr>
        <tr>
            <td>Province:</td>
            <td><?php echo $form['Countries_id']; ?></td>
        </tr>
        <tr>
            <td>Postal Code:</td>
            <td><?php echo $form['postalCode']; ?></td>
        </tr>
        <tr>
            <td>Telephone:</td>
            <td><?php echo $form['telephone']; ?></td>
        </tr>
        <tr>
            <td>Fax:</td>
            <td><?php echo $form['fax']; ?></td>
        </tr>
        <tr>
            <td>URL:</td>
            <td><?php echo $form['url']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <?php echo $form['cancel']; ?>  <?php echo $form['save']; ?>
                <button class="primary" ng-click="save(company)" ng-disabled="!company">
                    <?php echo $this->getString('COMPANY_CONFIRM'); ?>
                </button>
                <button ng-click="cancel()"><?php echo $this->getString('COMPANY_CANCEL'); ?></button>
            </td>
        </tr>
    </table>
</form>
