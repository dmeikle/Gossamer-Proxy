
<script language="javascript">

    $(document).ready(function () {

        $('.return').click(function () {
            var id = $(this).data('id');

            $.post('/admin/keys/retire/' + id, function (data) {

            });
        });


        $('.remove').click(function () {
            alert('remove');
        });

        $('.edit').click(function () {
            document.location.href = '/admin/keys/' + $(this).data('id');
        });

    });



</script>



<table class="table table-striped">
    <tr>
        <th>Job Number</th>
        <th>Location</th>
        <th>Type</th>
        <th>Action</th>
    </tr>
    <?php foreach ($ClaimsKeys as $key) { ?>
        <tr>
            <td><?php echo $key['jobNumber']; ?></td>
            <td><?php echo $key['unitNumber']; ?></td>
            <td><?php echo $key['KeyTypes_id']; ?></td>
            <td>
                <button data-id="<?php echo $key['ClaimsKeys_id']; ?>" class="btn btn-default edit">Edit</button>
                <button data-id="<?php echo $key['ClaimsKeys_id']; ?>" class="btn btn-default remove">Delete</button>
                <button data-id="<?php echo $key['ClaimsKeys_id']; ?>" class="btn btn-default return">Set Returned</button>
            </td>
        </tr>

    <?php } ?>

</table>