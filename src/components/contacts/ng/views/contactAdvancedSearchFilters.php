
<div class="form-group">
    <label for="advancedSearch-ContactTypes_id"><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?></label>
    <select name="ContactTypes_id" id="advancedSearch-ContactTypes_id" ng-model="advancedSearch.query.ContactTypes_id" class="form-control">
        <option value="" selected>-Contact Type-</option>
        <?php foreach ($ContactTypes as $item) { ?>
            <option value="<?php echo $item['ContactTypes_id']; ?>"><?php echo $item['contactType']; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="advancedSearch-StatusTypes_id"><?php echo $this->getString('CONTACTS_STATUS'); ?></label>
    <select name="StatusTypes_id" id="advancedSearch-ContactTypes_id" ng-model="advancedSearch.query.StatusTypes_id" class="form-control">
        <option value="" selected>-Status Type-</option>
        <option value="active">Active</option>
        <option value="locked">Locked</option>
        <option value="inactive">Inactive</option>
    </select>
</div>


