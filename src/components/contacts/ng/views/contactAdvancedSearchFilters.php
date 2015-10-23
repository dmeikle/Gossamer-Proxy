
<div class="form-group">
    <label for="advancedSearch-ContactTypes_id"><?php echo $this->getString('CONTACTS_CONTACTTYPE'); ?></label>
    <select name="ContactTypes_id" id="advancedSearch-ContactTypes_id" ng-model="advancedSearch.query.ContactTypes_ID" class="form-control">
        <option value="" selected>-Contact Type-</option>
        <?php foreach ($ContactTypes as $item) { ?>
            <option value="<?php echo $item['ContactTypes_id']; ?>"><?php echo $item['contactType']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label for="advancedSearch-title"><?php echo $this->getString('CONTACTS_TITLE'); ?></label>
    <input type="text" class="form-control" id="advancedSearch-title" name="title" ng-model="advancedSearch.query.title">
</div>
<div class="form-group">
    <label for="advancedSearch-mobile"><?php echo $this->getString('CONTACTS_MOBILE'); ?></label>
    <input type="tel" class="form-control" id="advancedSearch-mobile" name="mobile" ng-model="advancedSearch.query.mobile">
</div>
