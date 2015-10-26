
<!--- javascript start --->

@components/keys/includes/js/admin-keytypes-list.js

<!--- javascript end --->

<button id="create-new" class="btn btn-primary btn-xs">Add New Key Type</button><br>
<table class="table" id="table1">
    <tr>
        <td>Key Types</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($KeyTypes as $type) {
        if (count($type) == 0) {
            continue;
        }
        ?>
        <tr id="row_<?php echo $type['id']; ?>">
            <td id="keytype_<?php echo $type['id']; ?>"><?php echo $type['description']; ?></td>
            <td>
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary btn-xs edit">Edit</button>
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary btn-xs remove">Remove</button>
            </td>
        </tr>
    <?php } ?>
</table>
<div id="dialog-form" title="Create new key type" style="display:none">
    <p class="validateTips">All form fields are required.</p>

    <form id="form1">
        <input type="hidden" id="KeyType_id" name="KeyType[id]" value="0">
        <table class="table" id="form1">
            <tr>
                <td>
                    Key Type:
                </td>
                <td>
                    <input class="form-control" type="text" name="KeyType[description]" id='KeyTypes_type' />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" title="Delete this key type?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
