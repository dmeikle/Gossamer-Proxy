
<div class="form-group">
    <label for="advancedSearch-url"><?php echo $this->getString('COMPANY_JOB_NUMBER'); ?></label>
    <input type="text" name="jobNumber" id="advancedSearch-jobNumber" ng-model="advancedSearch.query.jobNumber" class="form-control" />
</div>
<div class="form-group">
    <label for="advancedSearch-CompanyTypes_id"><?php echo $this->getString('COMPANY_TYPE'); ?></label>
    <select name="CompanyTypes_id" id="advancedSearch-CompanyTypes_id" ng-model="advancedSearch.query.CompanyTypes_id" class="form-control">
        <option value=""> - <?php echo $this->getString('COMPANY_TYPE'); ?> - </option>
        <?php foreach ($CompanyTypes as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['type']; ?></option>
        <?php } ?>
    </select>
</div>