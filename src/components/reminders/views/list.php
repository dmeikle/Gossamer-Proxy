
<script language="javascript">
    $(document).ready(function (e) {

        $('.view').click(function () {
            window.location = '/admin/reminders/' + $(this).data('id');
        });

        $('.remove').click(function () {
            if (confirm('Are you sure you want to delete this reminder?') == false) {
                return false;
            }

            $.ajax({
                type: "POST",
                url: '/admin/reminders/remove/' + $(this).data('id')
            });
            $(this).closest('tr').remove();
        });

    });
</script>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>
                Job Number
            </th>
            <th>
                Subject
            </th>
            <th>
                Notification Date
            </th>
            <th>
                Reminder Time
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <?php foreach ($StaffReminders as $reminder) { ?>
        <tr>
            <td><?php echo $reminder['claimNumber']; ?></td>
            <td><?php echo $reminder['subject']; ?></td>
            <td><?php echo $reminder['notificationDate']; ?></td>
            <td><?php echo $reminder['remindBeforeTime']; ?></td>
            <td>
                <button class="btn btn-primary view" data-id="<?php echo $reminder['id']; ?>">View</button>
                <button class="btn btn-primary remove" data-id="<?php echo $reminder['id']; ?>">Remove</button>
            </td>
        </tr>

    <?php } ?>


</table>