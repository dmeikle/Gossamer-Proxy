

<script language="javascript">

  $(document).ready(function() {

    $('.selectable-rows tr').click(function() {

        if($(this).data('type') == 'request') {
            $( this ).next().slideToggle();
        }
        if($(this).data('type') == 'contact') {
            window.location = '/admin/scoping/requests/contact/' + $(this).data('id');
        }
        
    });

    $('.view').click(function(e) {
        e.preventDefault();
        window.location = '/admin/scoping/requests/' + $(this).data('id');
    })
});
</script>
<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th>
                Claim ID
            </th>
            <th>
                Name
            </th>
            <th>
                Loss Type
            </th>
            <th>
                Loss Date
            </th>
            <th>
                Status
            </th>
            <th>
                Project Manager
            </th>
            <th>
                Adjuster
            </th>
            <th>
                Property Manager
            </th>
            <th>
                Management Co
            </th>
            <th>
                Address
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>

<?php

/*foreach($Claims as $row) {
?>
  <!--
 
<tr data-type="request">
    <td>
        <a href="/admin/claims/view/<?php echo $row['id'];?>"><?php echo $row['claimNumber'];?></a>
    </td>
    <td>
        <?php echo $row['name'];?>
    </td>
    <td>
        <?php echo $row['lossType'];?>
    </td>
    <td>
        <?php echo $row['lossDate'];?>
    </td>
    <td>
        <?php echo $row['status'];?>
    </td>
    <td>
        <?php echo $row['projectManager'];?>
    </td>
    <td>
        <?php echo $row['adjuster'];?>
    </td>
    <td>
        <?php echo $row['propertyManager'];?>
    </td>
    <td>
        <?php echo $row['managementCompany'];?>
    </td>
    <td>
        <?php echo $row['address'];?>
    </td>
    <td>
        <button class="view" data-id="<?php echo $row['id'];?>" title="click to view the details of this request">View</button> <button class="complete" data-id="<?php echo $row['id'];?>" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="<?php echo $row['id'];?>" title="this will completely remove the scope request from record">Delete</button>
    </td>
</tr>
 -->
<tr data-type="request">
    <td>
        <a href="/admin/claims/view/<?php //echo $row['id'];?>"><?php //echo $row['claimNumber'];?></a>
    </td>
    <td>
        project name
    </td>
    <td>
       flooding
    </td>
    <td>
        2014-09-12
    </td>
    <td>
       In Progress
    </td>
    <td>
       Trevor Klann
    </td>
    <td>
        adjust name
    </td>
    <td>
        manager name
    </td>
    <td>
        mgmnt co
    </td>
    <td>
        1234 University Drive, Surrey, BC, V6Z 3B3
    </td>
    <td>
        <button class="view" data-id="<?php echo //$row['id'];?>" title="click to view the details of this request">View</button> <button class="complete" data-id="<?php //echo $row['id'];?>" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="<?php echo $row['id'];?>" title="this will completely remove the scope request from record">Delete</button>
    </td>
</tr>
<tr style="display:none;" id="row_<?php //echo $row['id'];?>">
    <td></td>
    <td colspan="10">
        <table class="table">
            <thead>
            <tr>
                <th>Unit</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Area</th>
                <th>Time</th>
                <th>Status</th>
                <th>Notes</th>
                <th><button class="add-contact" data-id="" >Add Contact</button></th>
            </tr>  
            </thead>
            <tr data-type="contact" data-id="123">
                <td>302</td>
                <td>Alicia Jones</td>
                <td>604-123-1233</td>
                <td>Kitchen, Living Room</td>
                <td>2:30PM</td>
                <td>in-progress</td>
                <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                <td></td>
            </tr>
            <tr data-type="contact" dta-id="124">
                <td>202</td>
                <td>Alvin Smith</td>
                <td>604-123-1233</td>
                <td>Kitchen</td>
                <td>2:00PM</td>
                <td>in-progress</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </td>
</tr>
<?php  } 
 * 
 */
?>
</table>
