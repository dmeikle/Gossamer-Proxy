
<script language="javascript">

$(document).ready(function() {
   $('.view').click(function() {
     // window.location = '/admin/incidents/view/' 
   });
});

</script>


<table class="table table-striped">
    <thead>
        <tr>
            <th>Job Number</th>
            <th>Incident Date</th>
            <th>Request Date</th>
            <th>Scope Date</th>
            <th>Staff</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <?php
    foreach($ScopeIncidents as $incident) {
       
    ?>
    <tr>
        <td>
            <?php echo $incident['ScopeRequests'][0]['jobNumber'];?>
        </td>
        <td>
            <?php echo $incident['incidentDate'];?>
        </td>
        <td>
            <?php echo $incident['ScopeRequests'][0]['requestDate'];?>
        </td>
        <td>
            <?php echo $incident['ScopeRequests'][0]['scopeDate'];?>
        </td>
        <td>
            <?php echo $incident['Staff'][0]['firstname'];?> <?php echo $incident['Staff'][0]['lastname'];?>
        </td>
        <td>
            <?php echo $IncidentTypes[$incident['IncidentTypes_id']]; ?>
        </td>
        <td>
            <button data-id="<?php echo $incident['id'];?>" data-typeid="<?php echo $incident['id'];?>" class="btn btn-primary view">View</button>
            <button data-id="<?php echo $incident['id'];?>" class="btn btn-primary remove">Close</button>
            
            <?php //echo $Departments[$incident['Staff'][0]['Departments_id']];?> 
        </td>
    </tr>
    <?php
    }
    ?>
</table>


<div>
    <select id="resultsPerPage">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>    
    </select>
    <ul class="pagination">
        <?php $firstPagination = current($pagination);?>
        <?php $lastPagination = end($pagination);?>
        <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/staff" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
        <?php foreach($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/staff" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
        <?php } ?>
      <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/staff" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
    </ul>
</div>
