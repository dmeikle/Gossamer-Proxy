



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
            <?php echo $address['claimsHistoryCount'];?>
        </td>
        <td>
            <?php echo $address['activeClaimsCount'];?>
        </td>
        <td>
           <input type="" class="btn btn-primary btn-xs edit" data-id="<?php echo $address['id']; ?>" value="Edit" />
        </td>
    </tr>
    <?php } ?>
</table>