<div class="modal-header">
    <h1 ng-if="selectedVariant && selectedVariant.id"><?php echo $this->getString('INVENTORY_VARIANT_EDITVARIANT') ?></h1>
    <h1 ng-if="!selectedVariant || !selectedVariant.id"><?php echo $this->getString('INVENTORY_VARIANT_ADDVARIANT') ?></h1>
</div>
<div class="modal-body">
    <div ng-if="loading">
        <div class="spinner-loader"></div>
    </div>
    <form ng-if="!loading">
        <div class="form-group">
            <label for="VariantOption_variantCode">
                <?php echo $this->getString('INVENTORY_VARIANT_CODE') ?>
            </label>
            <?php echo $variantOptionForm['variantCode'] ?>
        </div>
        <div class="form-group">
            <label for="VariantOption_variantSurcharge">
                <?php echo $this->getString('INVENTORY_VARIANT_SURCHARGE') ?>
            </label>
            <?php echo $variantOptionForm['variantSurcharge'] ?>
        </div>
        <div>
            <ul class="nav nav-tabs">
                <?php foreach ($locales as $locale) { ?>
                    <li ng-class="{active: selectedLocale === '<?php echo $locale['locale']; ?>'}">
                        <a href="" ng-click="selectLocale('<?php echo $locale['locale']; ?>')">
                            <?php echo $locale['languageName']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <?php foreach ($variantOptionForm['variantOption']['locales'] as $key => $row) { ?>
                <div ng-if="selectedLocale === '<?php echo $key;?>'" id="<?php echo $key; ?>"
                    class="form-group">
                    <label for="VariantOption_locale_en_US_variantOption">
                        <?php echo $this->getString('INVENTORY_VARIANT_OPTIONLOCALE') ?>
                        <?php echo $locales[$key]['languageName'] ?>
                    </label>
                    <?php echo $row; ?>
                </div>
            <?php } ?>
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
