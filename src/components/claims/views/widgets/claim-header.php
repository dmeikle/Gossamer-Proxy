<!--- javascript start --->

@components/claims/includes/js/admin-claims-list-ng.js


<!--- javascript end --->

    <div class="col-sm-6 col-md-3">
        <div class="c-widget c-widget-blank">
            <div class="profile-info">
                <h3>Project Address Information</h3>
                <?php echo $ProjectAddress['buildingName'];?><br>
                <?php echo $ProjectAddress['address1'];?> <br>
                <?php echo $ProjectAddress['city'];?>, <?php echo $ProjectAddress['Provinces_id'];?>, <?php echo $ProjectAddress['postalCode'];?>  <br>
                country
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="c-widget c-widget-blank">
            <div class="profile-info">
                <h3>Blank Widget</h3>
                Loss Date: <?php echo $claim['callInDate'];?> <br>
                Building Year: <?php echo $ProjectAddress['buildingYear'];?> <br>
                Source: <?php echo $claim['reason'];?> <br>
                Flood Category Type: need type here
            </div>
        </div>
    </div>
