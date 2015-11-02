<script language="javascript">

    $(document).ready(function () {
        $('.edit').click(function () {
            window.location = '/admin/events/eventlocations/' + $(this).data('id');
        });
    });

</script>
<h3>Event Locations</h3>
<a href="/admin/events/eventlocations/0">Add New Location</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Location</th>
            <th>Room</th>
            <th>Address</th>
            <th>City</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($EventLocations as $location) {
        if (count($location) < 1) {
            return;
        }
        ?>
        <tr>
            <td>
                <?php echo $location['name']; ?>
            </td>
            <td>
                <?php echo $location['room']; ?>
            </td>
            <td>
                <?php echo $location['address']; ?>
            </td>
            <td>
                <?php echo $location['city']; ?>
            </td>
            <td>
                <button data-id="<?php echo $location['id']; ?>" class="btn btn-primary edit">Edit</button>
                <button data-id="<?php echo $location['id']; ?>" class="btn btn-primary remove">Delete</button>
            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>