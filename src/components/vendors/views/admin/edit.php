<div class="col-md-4">
    <form role="form" class="form-standard" method="post" id="company-form" ng-controller="vendorsEditCtrl">
        <div class="widgetheader">
            <h1 ng-if="item.id"><?php echo $this->getString('EDIT') ?> {{item.name}}</h1>
            <h1 ng-if="!item.id"><?php echo $this->getString('VENDORS_NEWITEM') ?></h1>
        </div>

        <?php echo $form['id'];
        ?>
        <input type="hidden" ng-model="item.InventoryTypes_id" ng-init="item.InventoryTypes_id = 1">
        <table class="table">
            <tr>
                <td><?php echo $this->getString('VENDORS_COMPANY') ?></td>
                <td><?php echo $form['company']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_URL') ?></td>
                <td><?php echo $form['url']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_EMAIL') ?></td>
                <td><?php echo $form['email']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_TELEPHONE') ?></td>
                <td><?php echo $form['telephone']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_TOLLFREE') ?></td>
                <td><?php echo $form['tollFree']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_ADDRESS1') ?></td>
                <td>
                    <?php echo $form['address1']; ?><br />
                    <?php echo $form['address2']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_CITY') ?></td>
                <td><?php echo $form['city']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_PROVINCE') ?></td>
                <td><?php echo $form['Provinces_id']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_POSTALCODE') ?></td>
                <td><?php echo $form['postalCode']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_ACCOUNT_ID') ?></td>
                <td><?php echo $form['accountId']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_SALES_REP') ?></td>
                <td><?php echo $form['salesRep']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('VENDORS_DELIVERY_FEE') ?></td>
                <td><?php echo $form['deliveryFee']; ?></td>
            </tr>
        </table>
        <div class="widgetfooter clearfix">
            <div class="pull-right btn-group">
                <a href="/admin/vendors" class="btn btn-default">
                    <?php echo $this->getString('CANCEL') ?>
                </a>
                <button class="btn-primary" ng-click="save(vendor)">
                    <?php echo $this->getString('SAVE') ?>
                </button>
            </div>
        </div>

    </form>
</div>
