
<h2><?php echo $Event[0]['name']; ?> - Attendees List</h2>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <?php
            if ($Event[0]['cost'] > 0) {
                echo '<th>Paid</th>';
            }
            ?>
            <th>Company</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($EventAttendees as $contact) {

        if (!is_array($contact) || count($contact) < 1) {
            continue;
        }
        ?>
        <tr>
            <td>
                <?php echo $contact['lastname'] . ', ' . $contact['firstname']; ?>
            </td>
            <td>
                <?php echo $contact['mobile']; ?>
            </td>
            <td>
                <?php echo $contact['email']; ?>
            </td>
            <?php
            if ($Event[0]['cost'] > 0) {
                echo '<td>' . ((0 < $contact['paid']) ? '<span class="glyphicon glyphicon-ok"></span>' : '') . '</td>';
            }
            ?>
            <td>
                <?php //echo $contact['company'];  ?>
            </td>
            <td>
                <button data-id="<?php echo $contact['id']; ?>" class="btn btn-primary edit">Edit</button>
                <button data-id="<?php echo $contact['id']; ?>" class="btn btn-primary remove">Delete</button>

            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>


