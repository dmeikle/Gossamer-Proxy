<div class="form-group">
    <label for="advancedSearch-Departments_id"><?php echo $this->getString('STAFF_DEPARTMENT_ID'); ?></label>
    <select name="Departments_id" id="advancedSearch-Departments_id" ng-model="advancedSearch.query.Departments_id" class="form-control">
        <?php foreach ($Departments as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="advancedSearch-StaffTypes_id"><?php echo $this->getString('STAFF_STAFFTYPE_ID'); ?></label>
    <select name="StaffTypes_id" id="advancedSearch-StaffTypes_id" ng-model="advancedSearch.query.StaffTypes_id" class="form-control">
        <?php foreach ($StaffTypes as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['typeOfStaff']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="advancedSearch-StaffPositions_id"><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></label>
    <select name="StaffPositions_id" id="advancedSearch-StaffPositions_id" ng-model="advancedSearch.query.StaffPositions_id" class="form-control">
        <?php foreach ($StaffPositions as $item) { ?>
            <option value="<?php echo $item['id']; ?>"><?php echo $item['position']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="advancedSearch-title"><?php echo $this->getString('STAFF_TITLE'); ?></label>
    <input type="text" class="form-control" id="advancedSearch-title" name="title" ng-model="advancedSearch.query.title">
</div>
<div class="form-group">
    <label for="advancedSearch-mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
    <input type="tel" class="form-control" id="advancedSearch-mobile" name="mobile" ng-model="advancedSearch.query.mobile">
</div>
<div class="form-group">
    <label for="advancedSearch-city"><?php echo $this->getString('STAFF_CITY'); ?></label>
    <input type="text" class="form-control" id="advancedSearch-city" name="city" ng-model="advancedSearch.query.city">
</div>
<div class="form-group">
    <label for="advancedSearch-gender"><?php echo $this->getString('STAFF_STAFFPOSITIONS_ID'); ?></label>
    <input type="text" class="form-control" id="advancedSearch-gender" name="gender" ng-model="advancedSearch.query.gender">
</div>
