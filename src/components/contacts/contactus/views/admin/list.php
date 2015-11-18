
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



        $('.view').click(function (e) {
            window.location = '/admin/contact/' + $(this).data('id');
        });

        $('.edit').click(function (e) {
            window.location = '/admin/contact/' + $(this).data('id');
        });


    });
</script>


<h2 class="form-signin-heading">Contact Us List</h2>

<table class="table table-striped table-hover selectable-rows">
    <tr>
        <th align="center">Name</th>
        <th align="center">Date Received</th>
        <th align="center">Company</th>
        <th width="11%" align="center">Type</th>
        <th width="11%" align="center">Email</th>
        <th align="center">Telephone</th>
        <th  align="center">Subject</th>
        <th  align="center">Action</th>
    </tr>
    <?php foreach ($ContactUss as $contactus) {
        ?>
        <tr data-type="editable" valign="top" data-id="<?php echo $contactus['id']; ?>">
            <td><?php echo $contactus['name']; ?></td>
            <td><?php echo $contactus['dateReceived']; ?></td>
            <td><?php echo $contactus['company']; ?></td>
            <td><?php echo $contactus['contactUsType']; ?></td>
            <td><?php echo $contactus['email']; ?></td>
            <td><?php echo $contactus['telephone']; ?></td>
            <td><?php echo $contactus['subject']; ?></td>
            <td>
                <button data-id="<?php echo $contactus['id']; ?>" class="view">View</button>
                <button data-id="<?php echo $contactus['id']; ?>" class="assign">Assign</button>
                <button data-id="<?php echo $contactus['id']; ?>" class="finalize">Close</button>
            </td>
        </tr>

        <?php
    }
    ?>
</table>
<?php echo $pagination; ?>


