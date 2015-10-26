
<!--- javascript start --->

@components/contacts/includes/js/admin-roles-list.js

<!--- javascript end --->

<h3>Client Role Types</h3>
<button id="create-new" class="btn btn-primary btn-xs">Add New Role</button><br>
<table class="table" id="table1">
    <tr>
        <td>Titles</td>
        <td>Roles</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($ContactRoles as $role) {
        if (count($role) == 0) {
            continue;
        }
        ?>
        <tr id="row_<?php echo $role['id']; ?>">
            <td id="title_<?php echo $role['id']; ?>"><?php echo $role['title']; ?></td>
            <td id="role_<?php echo $role['id']; ?>"><?php echo $role['role']; ?></td>
            <td>
                <button data-id="<?php echo $role['id']; ?>" class="btn btn-primary btn-xs edit">Edit</button>
                <button data-id="<?php echo $role['id']; ?>" class="btn btn-primary btn-xs remove">Remove</button>
            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>
<div id="dialog-form" title="Create new role" style="display:none">
    <p class="validateTips">All form fields are required.</p>

    <form id="form1">
        <input type="hidden" id="Role_id" name="ContactRole[id]" value="0">
        <table class="table" id="form1">
            <tr>
                <td>
                    Display Title:
                </td>
                <td>
                    <input class="form-control" type="text" name="ContactRole[title]" id='Role_title' />
                </td>
            </tr>
            <tr>
                <td>
                    Role:
                </td>
                <td>
                    <input class="form-control" type="text" name="ContactRole[role]" id='Role_role' />
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" title="Delete this role?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
