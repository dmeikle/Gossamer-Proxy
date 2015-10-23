
<div class="form-group">
    <label for="advancedSearch-CompanyTypes_id"><?php echo $this->getString('COMPANY_TYPE'); ?></label>
    <select name="CompanyTypes_id" id="advancedSearch-CompanyTypes_id" ng-model="advancedSearch.query.CompanyTypes_id" class="form-control">
        <?php foreach ($CompanyTypes as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['type']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="advancedSearch-company"><?php echo $this->getString('COMPANY_NAME'); ?></label>
    <input type="text" name="company" id="advancedSearch-company" ng-model="advancedSearch.query.company" class="form-control" />
</div>
<div class="form-group">
    <label for="advancedSearch-city"><?php echo $this->getString('COMPANY_CITY'); ?></label>
    <input type="text" name="city" id="advancedSearch-city" ng-model="advancedSearch.query.city" class="form-control" />
</div>
<div class="form-group">
    <label for="advancedSearch-telephone"><?php echo $this->getString('COMPANY_TELEPHONE'); ?></label>
    <input type="text" name="telephone" id="advancedSearch-telephone" ng-model="advancedSearch.query.telephone" class="form-control" />
</div>
<div class="form-group">
    <label for="advancedSearch-url"><?php echo $this->getString('COMPANY_URL'); ?></label>
    <input type="text" name="url" id="advancedSearch-url" ng-model="advancedSearch.query.url" class="form-control" />
</div>
