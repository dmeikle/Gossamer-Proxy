

<table class="table table-striped table-hover">
    <tr>
        <th scope="col">Job Number</th>
        <th scope="col">Start Date</th>
        <th scope="col">ECD</th>
        <th scope="col">Claim Type</th>
        <th scope="col">Source</th>
        <th scope="col">Phase</th>
        <th scope="col">Status</th>
        <th scope="col">Affected Locations</th>
        <th scope="col">Action</th>
    </tr>
    <?php foreach ($Claims as $claim) { ?>
        <tr>
            <td><?php echo $claim['claimNumber']; ?></td>
            <td><?php echo $claim['startDate']; ?></td>
            <td><?php echo $claim['completionDate']; ?></td>
            <td><?php echo $claim['ClaimTypes_id']; ?></td>
            <td><?php echo $claim['source']; ?></td>
            <td><?php // echo $claim['Phase'];         ?></td>
            <td><?php // echo $claim['status'];         ?></td>
            <td><?php //echo $claim['claimNumber'];         ?></td>
            <td>view</td>

        </tr>
    <?php } ?>
</table>
