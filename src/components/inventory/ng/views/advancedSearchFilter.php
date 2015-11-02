
<div class="form-group">
    <label for="advancedSearch-Vendors_id"><?php echo $this->getString('COMPANY_VENDOR'); ?></label>
    <select name="Vendors_id" id="advancedSearch-CompanyTypes_id" ng-model="advancedSearch.query.Vendors_id" class="form-control">
        <?php foreach ($Vendors as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['company']; ?></option>
        <?php } ?>
    </select>
</div>
