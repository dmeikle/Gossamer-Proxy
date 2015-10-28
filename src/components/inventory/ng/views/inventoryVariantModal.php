<div class="modal-header">
    <h1></h1>
</div>
<div class="modal-body">
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
        <div ng-show="selectedLocale === '<?php echo $key;?>'" id="<?php echo $key; ?>"
            class="form-group">
            <label for="VariantOption_locale_en_US_variantOption">
                <?php echo $this->getString('INVENTORY_VARIANT_OPTIONLOCALE') ?>
                <?php echo $locales[$key]['languageName'] ?>
            </label>
            <?php echo $row; ?>
        </div>
    <?php } ?>
</div>
<div class="modal-footer">
    <div class="pull-right btn-group">
        <button class="btn-default">
            <?php echo $this->getString('CANCEL') ?>
        </button>
        <button class="primary">
            <?php echo $this->getString('CONFIRM') ?>
        </button>
    </div>
</div>
