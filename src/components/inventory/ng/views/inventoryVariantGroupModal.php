<div class="modal-header">
    <h1 ng-if="selectedGroup && selectedGroup.id"><?php echo $this->getString('INVENTORY_VARIANT_EDITVARIANT') ?></h1>
    <h1 ng-if="!selectedGroup || !selectedGroup.id"><?php echo $this->getString('INVENTORY_VARIANT_ADDVARIANT') ?></h1>
</div>
<div class="modal-body">
    <div ng-if="loading">
        <div class="spinner-loader"></div>
    </div>
    <form ng-if="!loading">
        <?php foreach ($locales as $locale) ?>
        <div>
            <ul class="nav nav-tabs">
                <?php foreach ($locales as $locale) { ?>
                    <li ng-class="{active: selectedLocale === '<?php echo $locale['locale']; ?>'}">
                        <a href="" ng-click="selectLocale('<?php echo $locale['locale']; ?>')">
                            <?php echo $locale['languageName']; ?>
                        </a>
                    </li>
                    <?php if ($locale['isDefault']): ?>
                        <get-default-locale data-locale="<?php echo $locale['locale'] ?>">
                        </get-default-locale>
                    <?php endif; ?>
                <?php } ?>
            </ul>
            <div class="tabbed-container">
                <?php foreach ($variantGroupForm['groupName']['locales'] as $key => $row) { ?>
                    <div ng-if="selectedLocale === '<?php echo $key;?>'" id="<?php echo $key; ?>"
                        class="form-group">
                        <label for="VariantGroup_locale_en_US_groupName">
                            <?php echo $this->getString('INVENTORY_VARIANT_NAME') ?>

                            <?php echo $locales[$key]['languageName'] ?>
                        </label>
                        <?php echo $row; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label for="VariantGroup_groupCode">
                <?php echo $this->getString('INVENTORY_VARIANT_CODE') ?>
            </label>
            <?php echo $variantGroupForm['groupCode'] ?>
        </div>
    </form>
</div>
<div class="modal-footer">
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="close()">
            <?php echo $this->getString('CANCEL') ?>
        </button>
        <button class="primary" ng-click="submit()">
            <?php echo $this->getString('CONFIRM') ?>
        </button>
    </div>
</div>
