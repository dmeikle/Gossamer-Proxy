<script language="javascript">

    $(document).ready(function () {
        $('.edit').click(function () {
            window.location = '/admin/events/eventprospects/' + $(this).data('id');
        });
    });

</script>
<h2>Events Prospects List</h2>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Event</th>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Merged</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($EventProspects as $prospect) {
        if (!is_array($prospect) || count($prospect) < 1) {
            continue;
        }
        ?>
        <tr>
            <td>
                <?php echo $prospect['Events_id']; ?>
            </td>
            <td>
                <?php echo $prospect['firstname'] . ', ' . $prospect['lastname']; ?>
            </td>
            <td>
                <?php echo $prospect['email']; ?>
            </td>
            <td>
                <?php echo $prospect['company']; ?>
            </td>
            <td>
                <?php echo $prospect['merged']; ?>
            </td>
            <td>
                <button data-id="<?php echo $prospect['id']; ?>" class="btn btn-primary edit">Edit</button>

            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>