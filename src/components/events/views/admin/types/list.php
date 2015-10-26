
<!--- javascript start --->

@components/events/includes/js/admin-eventtypes-list.js

<!--- javascript end --->

<button id="create-eventtype" class="btn btn-primary btn-xs">Add New Event Type</button><br>
<table class="table" id="table1">
    <tr>
        <td>Event Type</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($EventTypes as $type) {
        if (count($type) == 0) {
            continue;
        }
        ?>
        <tr id="row_<?php echo $type['id']; ?>">
            <td id="department_<?php echo $type['id']; ?>"><?php echo $type['type']; ?></td>
            <td>
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary btn-xs edit">Edit</button>
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary btn-xs remove">Remove</button>
            </td>
        </tr>
    <?php } ?>
</table>
<div id="dialog-form" title="Create new event type" style="display:none">
    <p class="validateTips">All form fields are required.</p>

    <form id="form1">
        <input type="hidden" id="EventType_id" name="EventType[id]" value="0">
        <table class="table" id="table1">
            <tr>
                <td>
                    Event Type:
                </td>
                <td>
                    <div id="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            foreach ($locales as $locale) {
                                if ($locale['isDefault']) {
                                    echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                } else {
                                    echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                }
                            }
                            ?>
                        </ul>

                        <div class="tab-content">
                            <?php foreach ($locales as $key => $locale) { ?>
                                <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active' : ''; ?>" id="<?php echo $key; ?>">
                                    <?php echo $form['type']['locales'][$key]; ?>

                                </div>

                            <?php } ?>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" title="Delete this event type?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
