
<select name="Departments_id" ng-model="advancedSearch.Departments_id">
<?php
foreach($Departments as $item) {?>
    <option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
<?php } ?>
</select>


<select name="StaffTypes_id" ng-model="advancedSearch.StaffTypes_id">
<?php
foreach($StaffTypes as $item) {?>
    <option value="<?php echo $item['id'];?>"><?php echo $item['typeOfStaff'];?></option>
<?php } ?>
</select>


<select name="StaffPositions_id" ng-model="advancedSearch.StaffPositions_id">
<?php
foreach($StaffPositions as $item) {?>
    <option value="<?php echo $item['id'];?>"><?php echo $item['position'];?></option>
<?php } ?>
</select>
