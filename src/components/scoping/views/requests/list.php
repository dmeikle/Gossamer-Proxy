

<script language="javascript">

  $(document).ready(function() {

    $('.addLocation').click(function(e) {
       e.preventDefault();
       window.location = '/admin/scoping/locations/' + $(this).data('id') + '/0';
    });

    $('.takeoff').click(function(e) {
       e.preventDefault();
       window.location = '/admin/scoping/takeoff/' + $(this).data('id');
    });

    $('.view').click(function(e) {
        e.preventDefault();
        window.location = '/admin/scoping/requests/' + $(this).data('id');
    })

    $('.create').click(function(e) {
        e.preventDefault();
        
        window.location = '/admin/scoping/locations/rooms/' + $(this).data('id') + '/0/20';
    })
    
    $('.selectable-rows tr').mouseup(function() {

        if($(this).data('type') == 'request') {
            $( this ).next().slideToggle();
        }
        if($(this).data('type') == 'contact') {
            window.location = '/admin/scoping/requests/contact/' + $(this).data('id');
        }
        
    });
});
</script>
<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th>
                Job Number
            </th>
            <th>
                Request Date
            </th>
            <th>
                Scope Date
            </th>
            <th>
                Source
            </th>
            <th>
                Notes
            </th>
            <th>
                Address
            </th>
            <th>
                Scoped By
            </th>
            <th>
                Actions
            </th>
        </tr>
    </thead>

<?php

foreach($ScopeRequests as $row) {?>
<tr data-type="request">
    <td>
        <a href="/admin/scoping/requests/<?php echo $row['id'];?>"><?php echo $row['jobNumber'];?></a>
    </td>
    <td>
        <?php echo $row['requestDate'];?>
    </td>
    <td>
        <?php echo $row['scopeDate'];?>
    </td>
    <td>
        <?php echo $row['source'];?>
    </td>
    <td>
        <?php echo $row['notes'];?>
    </td>
    <td>
        <?php echo $row['ProjectAddresses_id'];?>
        this area needs to be tied in to project addresses table
    </td>
    <td>
        <?php echo $row['Staff_id'];?>
    </td>
    <td>
        <button class="view" data-id="<?php echo $row['id'];?>" title="click to view the details of this request">View</button> 
        <button class="addLocation" data-id="<?php echo $row['id'];?>" title="add a new unit/location to a claim">Add Location</button> 
        <button class="remove" data-id="<?php echo $row['id'];?>" title="this will completely remove the scope request from record">Delete</button>
    </td>
</tr>
<tr style="display:none;" id="row_<?php echo $row['id'];?>">
    <td></td>
    <td colspan="7">
        <table class="table">
            <thead>
            <tr>
                <th>Unit</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Area</th>
                <th>Time</th>
                <th>Notes</th>
                <th><button class="add-contact" data-id="" >Add Contact</button>
                </th>
            </tr>  
            </thead>
            <tr data-type="contact" data-id="123">
                <td>302</td>
                <td>Alicia Jones</td>
                <td>604-123-1233</td>
                <td>Kitchen, Living Room</td>
                <td>2:30PM</td>
                <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                <td>
        <button class="create" data-id="<?php echo $row['id'];?>" title="this scope will display in completed scopes list">Scope</button> </td>
            </tr>
            <tr data-type="contact" dta-id="124">
                <td>202</td>
                <td>Alvin Smith</td>
                <td>604-123-1233</td>
                <td>Kitchen</td>
                <td>2:00PM</td>
                <td></td>
                <td>
        <button class="create" data-id="<?php echo $row['id'];?>" title="this scope will display in completed scopes list">Scope</button> 
                <button class="takeoff" data-id="<?php echo $row['id'];?>" title="">Material Takeoff</button> </td>
            </tr>
        </table>
    </td>
</tr>
<?php } ?>
</table>
