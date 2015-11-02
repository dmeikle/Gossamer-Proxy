<table class="table">
    <tr>
        <td>Type:</td>
        <td colspan="3">select</td>
    </tr>
    <tr>
        <td>Start Date:</td>
        <td><?php echo $form['fromDate']; ?></td>
        <td>Start Time:</td>
        <td><?php echo $form['fromTime']; ?></td>
    </tr>
    <tr>
        <td>End Date:</td>
        <td><?php echo $form['toDate']; ?></td>
        <td>End Time:</td>
        <td><?php echo $form['toTime']; ?></td>
    </tr>
</table>
<?php foreach ($Staffs as $staff) { ?>
    <?php echo $staff['firstname']; ?>
<?php } ?>
