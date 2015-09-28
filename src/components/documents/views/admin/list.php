
<!--- javascript start --->

    @components/departments/includes/js/admin-departments-list.js

<!--- javascript end --->

<button id="create-department" class="btn btn-primary btn-xs">Add New Department</button><br>
<table class="table" id="table1">
    <tr>
        <td>Department</td>
        <td>Action</td>
    </tr>
    <?php foreach($Departments as $department) {?>
    <tr id="row_<?php echo $department['id'];?>">
        <td id="department_<?php echo $department['id'];?>"><?php echo $department['name']; ?></td>
        <td>
            <button data-id="<?php echo $department['id'];?>" class="btn btn-primary btn-xs edit">Edit</button> 
            <button data-id="<?php echo $department['id'];?>" class="btn btn-primary btn-xs remove">Remove</button> 
        </td>
    </tr>
    <?php } ?>
</table>
<div id="dialog-form" title="Create new department" style="display:none">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="form1">
      <input type="hidden" id="Departments_id" name="Department[id]">
    <table class="table" id="form1">
        <tr>
            <td>
                Department:
            </td>
            <td>
                <input class="form-control" type="text" name="Department[name]" id='Departments_department' />
            </td>
        </tr>
    </table>
  </form>
</div>

<div id="dialog-confirm" title="Delete this department?"  style="display:none">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
 