<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
      window.location = '/admin/workperformed/' + $(this).data('id');
   });
});

</script>


<h2 class="form-signin-heading">Work Actions List</h2>
     
<table class="table table-striped table-hover selectable-rows">
    <tr>
      <th width="20%">Name</th>
        <th width="11%" align="center">Department</th>
        <th width="11%" align="center">Phase</th>               
        <th width="11%" align="center">Layer</th>
        <th  align="center">Action</th>
    </tr>
    <?php
    foreach($ActionPerformeds as $action) {?>
    <tr data-type="editable" valign="top" data-id="2">
        <td><?php echo $action['action'];?></td>
        <td><?php echo $Departments[$action['Departments_id']]; ?></td>
        <td><?php echo $ClaimPhases[$action['ClaimPhases_id']]; ?></td>
        <td><?php echo $action['layer'];?></td>
        <td>
            <button data-id="<?php echo $action['id'];?>" class="btn btn-primary edit">Edit</button> 
            <button data-id="<?php echo $action['id'];?>" class="btn btn-primary delete">Delete</button> 
        </td>
    </tr>
    <?php }?>

</table>


<select id="resultsPerPage">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>    
    </select>
    <ul class="pagination">
        <?php $firstPagination = current($pagination);?>
        <?php $lastPagination = end($pagination);?>
        <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
        <?php foreach($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
        <?php } ?>
      <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
    </ul>
</div>

