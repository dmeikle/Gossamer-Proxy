

<!--- javascript start --->

@core/components/locales/includes/js/admin-locales-list.js

<!--- javascript end --->
<h3><?php echo $this->getString('LABEL_LANGUAGES_LIST'); ?></h3>
<button id="create-new" class="btn btn-primary btn-xs">Add New Locale</button><br>
<table class="table" id="table1">
    <tr>
        <td><?php echo $this->getString('LABEL_LANGUAGE'); ?></td>
        <td>Locale</td>
        <td>Default</td>
        <td><?php echo $this->getString('LABEL_ACTION'); ?></td>
    </tr>
    <?php
    foreach ($Locales as $locale) {
        if (count($locale) == 0) {
            continue;
        }
        ?>
        <tr id="row_<?php echo $locale['id']; ?>">
            <td id="languageName_<?php echo $locale['id']; ?>"><?php echo $locale['languageName']; ?></td>
            <td id="locale_<?php echo $locale['id']; ?>"><?php echo $locale['locale']; ?></td>
            <td id="isDefault_<?php echo $locale['id']; ?>"><?php echo $locale['isDefault']; ?></td>
            <td>
                <button data-id="<?php echo $locale['id']; ?>" class="btn btn-primary btn-xs edit"><?php echo $this->getString('BUTTON_EDIT'); ?></button>
                <button data-id="<?php echo $locale['id']; ?>" class="btn btn-primary btn-xs remove"><?php echo $this->getString('BUTTON_DELETE'); ?></button>
            </td>
        </tr>
    <?php } ?>
</table>
<div id="dialog-form" title="Create new locale" style="display:none">
    <p class="validateTips">All form fields are required.</p>

    <form id="form1">
        <input type="hidden" id="Locale_id" name="Locale[id]" value="0">
        <table class="table" id="form1">
            <tr>
                <td>
                    Language Name:
                </td>
                <td>
                    <input class="form-control" type="text" name="Locale[languageName]" id='Locale_languageName' />
                </td>
            </tr>
            <tr>
                <td>
                    Locale:
                </td>
                <td>
                    <input class="form-control" type="text" name="Locale[locale]" id='Locale_locale' />
                </td>
            </tr>
            <tr>
                <td>
                    Default:
                </td>
                <td>

                    <input class="form-control" type="checkbox" name="Locale[isDefault]" id='Locale_isDefault' value="1"/>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" title="Delete this locale?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
