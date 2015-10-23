
<script language="javascript">

    $(document).ready(function () {

        var currentStatus = '';

        $('.permissions').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/staff/permissions/' + $(this).data('id');
        });

        $('.status').click(function (e) {
            e.stopPropagation();
            $(this).prev('.staffStatus').toggle();
            if ($(this).text() == 'cancel') {
                $(this).text(currentStatus);
            } else {
                currentStatus = $(this).prev('.staffStatus').val();
                $(this).text('cancel');
            }

        });

//    $('.staffStatus').click(function(e) {
//         e.stopPropagation();
//         $(this).prev().toggle();
//         $(this).toggle();
//    });
//
        $('.staffStatus').change(function () {

            if ($(this).val() != currentStatus && confirm("are you sure you want to change the status of this employee?")) {
                alert('this will eventually perform a save'); //save();
                $(this).next().text($(this).val());
            } else {
                $(this).next().text(currentStatus);
            }

            $(this).toggle();
        });

        $('.edit').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/staff/edit/' + $(this).data('id');
        });

        $('.credentials').click(function (e) {
            // e.stopPropogation();
            window.location = '/admin/staff/credentials/' + $(this).data('id');
        });

        $('.emergency').click(function (e) {
            // e.stopPropogation();
            window.location = '/admin/staff/emergencycontacts/' + $(this).data('id');
        });

    });
</script>
<form method="post" style="float:right">
    here is search
</form>

<h2 class="form-signin-heading">Staff List</h2>

<table class="table table-striped table-hover selectable-rows">
    <tr>
        <th width="20%">Name</th>
        <th width="11%" align="center">Job Title</th>
        <th width="11%" align="center">Department</th>
        <th width="11%" align="center">Email</th>
        <th align="center">Telephone</th>
        <th  align="center">Mobile</th>
        <th  align="center">Status</th>
        <th  align="center">Logged In</th>
        <th  align="center">Last Log In</th>
        <th  align="center">Action</th>
    </tr>
    <?php
    foreach ($Staffs as $staff) {
        if ($staff['firstname'] == '') {
            continue;
        }
        ?>
        <tr data-type="editable" valign="top" data-id="<?php echo $staff['id']; ?>">
            <td><?php echo $staff['lastname']; ?>, <?php echo $staff['firstname']; ?></td>
            <td><?php echo $staff['title']; ?></td>
            <td><?php echo (isset($staff['Departments_id']) ? $DepartmentsList[$staff['Departments_id']] : '(not specified)'); ?></td>
            <td><?php echo $staff['email']; ?></td>
            <td><?php echo $staff['telephone']; ?></td>
            <td><?php echo $staff['mobile']; ?></td>
            <td>
                <select class="staffStatus" style="display: none">
                    <option <?php echo ($staff['status'] == 'active') ? 'selected' : ''; ?>>active</option>
                    <option <?php echo ($staff['status'] == 'suspended') ? 'selected' : ''; ?>>suspended</option>
                    <option <?php echo ($staff['status'] == 'locked') ? 'selected' : ''; ?>>locked</option>
                </select>
                <a data-type="status" onclick="return false;" class="status"><?php echo $staff['status']; ?></a>
            </td>
            <td align="center"><?php echo (time() - strtotime($staff['lastLogin'])) < 20000 ? '<span class="glyphicon glyphicon-star"></span>' : ''; ?></td>
            <td><?php echo $staff['lastLogin']; ?></td>
            <td>
                <button data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs schedule">Schedule</button>
                <button data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs edit">Edit</button>
                <button class="btn btn-primary btn-xs credentials" data-id="<?php echo $staff['id']; ?>">Credentials</button>
                <button class="btn btn-primary btn-xs permissions" data-id="<?php echo $staff['id']; ?>">Permissions</button>
                <button class="btn btn-primary btn-xs emergency" data-id="<?php echo $staff['id']; ?>">Emergency Contacts</button>
                <button data-id="<?php echo $staff['id']; ?>" class="btn btn-primary btn-xs delete">Delete</button> </td>
        </tr>
        <?php
    }
    ?>
</table>


<?php echo $pagination; ?>