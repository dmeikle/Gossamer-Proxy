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




      <?php echo $pagination; ?>