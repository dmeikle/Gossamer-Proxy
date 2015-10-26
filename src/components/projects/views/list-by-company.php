<?php foreach ($ProjectAddresses as $address) { ?>
    <div class="address">
        <div class="image">image here<?php echo $address['mainImage']; ?></div>
        <div class="buldingName"><?php echo $address['buildingName']; ?></div>
        <div class="details"><?php echo $address['address1']; ?> <br />
            <?php echo $address['city']; ?>, <?php echo $address['Provinces_id']; ?> <?php echo $address['postalCode']; ?></div>
        <div class="age"><?php echo $address['buildingAge']; ?></div>
        <div class="navigation"><a href="/portal/claims/<?php echo $address['id']; ?>/0/20">view claims</a> | edit | delete</div>

    </div>
<?php } ?>