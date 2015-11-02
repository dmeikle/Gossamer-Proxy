<style>

    #claim #claim-number {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }

    #claim #pm {
        float: left;
        width: 50%;
    }

    #claim #phase, #claim #ecd, #claim #start-date, #claim #called-in-by, #claim #date-received, #claim #work-auth-date {
        float: left;
        width: 33%;
    }

    #project-address #building-name, #project-address #strata-number {
        float: left;
        width: 50%;
    }

    #project-address #address, #project-address #city, #project-address #postal {
        width: 33%;
        float:left;
    }

    #project-address #age, #project-address #property, #project-address #units, #project-address #floors {
        width: 25;
        float: left;
    }
    #project-address #notes {
        clear:both;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">Claim Information</div>
    <div class="panel-body" id="claim">
        <div id="claim-number"><?php echo $claim['jobNumber']; ?></div>
        <div id="pm"><label>Project Manager:</label> <?php echo $claim['projectManager_id']; ?></div>
        <div id="pma"><label>PMA:</label> <?php echo $claim['projectManager_id']; ?></div>

        <div id="phase"><label>Phase:</label> <?php echo $claim['projectManager_id']; ?></div>
        <div id="ecd"><label>ECD:</label> <?php echo $claim['projectManager_id']; ?></div>
        <div id="start-date"><label>Start Date:</label> <?php echo $claim['projectManager_id']; ?></div>

        <div id="called-in-by"><label>Called In By:</label> <?php echo $claim['calledInBy']; ?></div>
        <div id="date-received"><label>Date:</label> <?php echo $claim['callInDate']; ?></div>
        <div id="work-auth-date"><label>Work Auth:</label> <?php echo $claim['workAuthorizationReceiveDate']; ?></div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Project Location</div>
    <div class="panel-body" id="project-address">
        <div id="building-name"><label>Building Name:</label> <?php echo $ProjectAddress['buildingName']; ?></div>
        <div id="building-name"><label>Strata #:</label> <?php echo $ProjectAddress['strataNumber']; ?></div>
        <div id="building-name"><label>Address:</label> <?php echo $ProjectAddress['address1']; ?></div>
        <div id="building-name"><label>City:</label> <?php echo $ProjectAddress['city']; ?></div>
        <div id="building-name"><label>Postal:</label> <?php echo $ProjectAddress['postalCode']; ?></div>
        <div id="building-name"><label>Age:</label> <?php echo $ProjectAddress['buildingYear']; ?></div>
        <div id="building-name"><label>Property:</label> <?php echo $ProjectAddress['propertyType']; ?></div>
        <div id="building-name"><label>Units:</label> <?php echo $ProjectAddress['numUnits']; ?></div>
        <div id="building-name"><label>Floors:</label> <?php echo $ProjectAddress['numFloors']; ?></div>
        <div id="building-name"><?php echo $ProjectAddress['notes']; ?></div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Areas Affected</div>
    <div class="panel-body" id="project-address">
        <?php foreach ($ClaimsLocation as $location) { ?>
            <div class="customer">
                <div class="unit"><?php echo $location['unitNumber']; ?></div>
                <div id="customer-type"><?php //echo $ClaimsLocation['customerType'];        ?></div>
                <div id="telephone"><?php //echo $ClaimsLocation['telephone'];        ?></div>
            </div>
        <?php } ?>
    </div>
</div>


