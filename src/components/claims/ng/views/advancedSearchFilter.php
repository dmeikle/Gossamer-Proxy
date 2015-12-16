
<div class="form-group">
    <label for="advancedSearch-status"><?php echo $this->getString('CLAIMS_STATUS'); ?></label>
    <select name="status" id="advancedSearch-status" ng-model="advancedSearch.query.status" class="form-control">
        <option value="" selected>- Status -</option>
        <option value="unassigned" selected>Unassigned</option>
        <option value="24hours" selected>Last 24 Hours</option>
        <option value="72hours" selected>Last 72 Hours</option>
        <option value="125hours" selected>Last 5 Days</option>
        <option value="pending" selected>Pending</option>
        <option value="onhold" selected>On Hold</option>
        <option value="complete" selected>Complete</option>
        <option value="cancelled" selected>Cancelled</option>
    </select>
</div>

<div class="form-group">
    <label for="advancedSearch-ContactVIPTypes_id"><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?></label>
    <select name="ContactVIPTypes_id" id="advancedSearch-ContactVIPTypes_id" ng-model="advancedSearch.query.ContactVIPTypes_id" class="form-control">
        <option value="" selected>- VIP Type -</option>
        <?php //foreach (ContactVIPTypes as $item) { ?>
        <option value="<?php //echo $item['ContactVIPTypes_id'];      ?>"><?php //echo $item['contactVIPType'];      ?></option>
        <?php //} ?>
    </select>
</div>

<div class="form-group">
    <label for="advancedSearch-customerName"><?php echo $this->getString('CLAIMS_CUSTOMER_NAME'); ?></label>
    <input type="text" class="form-control" id="advancedSearch-customerName" name="customerName" ng-model="advancedSearch.query.customerName">
</div>
<div class="form-group">
    <label for="advancedSearch-customerTelephone"><?php echo $this->getString('CLAIMS_CUSTOMER_TELEPHONE'); ?></label>
    <input type="tel" class="form-control" id="advancedSearch-customerTelephone" name="customerTelephone" ng-model="advancedSearch.query.customerTelephone">
</div>