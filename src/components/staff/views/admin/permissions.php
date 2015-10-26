
<script language="javascript">
    $(function () {
        $('.selectable input:checkbox:checked').each(function () {

            $("label[for='" + this.id + "']").addClass('ui-selected');
        });

        $('.selectable').on('mouseup', 'label', function () {
            var el = $(this);
            console.info(el);
            if (el.hasClass('ui-selected')) {
                el.removeClass('ui-selected');
            } else {
                el.addClass('ui-selected');
            }
        });



    });
</script>


<h2 class="form-signin-heading">Staff Permissions</h2>
<form class="form-standard" method="post" role="form" id="permissions-form" action="/admin/staff/permissions/">


    <h3>Authorizations</h3>
    <table class="table">
        <tr>
            <td valign="top">
                Roles: </td>
            <td>
                <p class="selectable">
                    <?php foreach ($StaffRoles as $role) { ?>
                        <label for="StaffAuthorization_<?php echo $role['role']; ?>"><input id="StaffAuthorization_<?php echo $role['role']; ?>" <?php echo (in_array($role['role'], $roles)) ? "checked" : ""; ?> type="checkbox" name="userAuthorizations[<?php echo $role['role']; ?>]" value="1"><?php echo $role['title']; ?></label>
                    <?php } ?>
                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button class="btn btn-primary" id="cancel-permissions" type="button">Cancel</button>
                <button class="btn btn-primary" id="save-permissions" type="button">Save</button>
            </td>
        </tr>
    </table>

</form>
