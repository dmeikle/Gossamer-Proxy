
<!--- javascript start --->

@components/inventory/includes/js/admin-types-list.js

<!--- javascript end --->

<button id="create-new" class="btn btn-primary btn-xs">Add New Type</button><br>
<table class="table" id="table1">
    <tr>
        <td>Type</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($Types as $type) {
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
<div id="dialog-form" title="Create new type" style="display:none">
    <p class="validateTips">All form fields are required.</p>


    <form id="form1">
        <input type="hidden" id="InventoryType_id" name="InventoryType[id]" value="0">
        <table class="table" id="form1">
            <tr>
                <td>
                    Inventory Type:
                </td>
                <td>
                    <input class="form-control" type="text" name="InventoryType[name]" id='InventoryTypes_name' />
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

<div id="dialog-confirm" title="Delete this type?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
