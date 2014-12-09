
<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
       window.location = '/admin/incidents/type/' + $(this).data('id');
   });
});

</script>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Incident Type</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach($IncidentTypes as $type) {?>
    <tr>
        <td>
            <?php echo $type['incidentType']; ?>
        </td>
        <td>
            <?php echo $type['score']; ?>
        </td>
        <td>
            <button class="btn btn-primary edit" data-id="<?php echo $type['id'];?>">Edit</button>
            <button class="btn btn-primary delete" data-id="<?php echo $type['id'];?>">Delete</button>
        </td>
    </tr>
    <?php } ?>
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
        <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
        <?php foreach($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
        <?php } ?>
      <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
    </ul>
</div>

