<script language="javascript">
$(document).ready(function() {
    $('.edit').click(function() {
        window.location = '/admin/projects/' + $(this).data('id');
    });

    $('.floorplans').click(function() {
        window.location = '/admin/projects/floorplans/' + $(this).data('id');
    });
});
</script>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Building Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
            <th>Claim History Count</th>
            <th>Active Claim Count</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach($ProjectAddresses as $address) { ?>
    <tr>
        <td>
            <?php echo $address['buildingName'];?>
        </td>
        <td>
            <?php echo $address['address1'];?>
        </td>        
        <td>
            <?php echo $address['city'];?>
        </td>
        <td>
            <?php //echo $address['buildingName'];?>
        </td>
        <td>
            <?php echo $address['postalCode'];?>
        </td>
        <td>
            <?php echo $address['claimsHistoryCount'];?><br>
            clickable to other page
        </td>
        <td>
            <?php echo $address['activeClaimsCount'];?><br>
            clickable to other page
        </td>
        <td>
           <input type="" class="btn btn-primary btn-xs edit" data-id="<?php echo $address['id']; ?>" value="Edit" />
           <input type="" class="btn btn-primary btn-xs floorplans" data-id="<?php echo $address['id']; ?>" value="Floor Plans" />
        </td>
    </tr>
    <?php } ?>
</table>