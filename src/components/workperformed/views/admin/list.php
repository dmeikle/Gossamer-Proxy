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
        <th  align="center">Translations</th>
        <th  align="center">Action</th>
    </tr>
    <tr data-type="editable" valign="top" data-id="2">
        <td>remove drywall</td>
        <td>Water Damage</td>
        <td>Emergency</td>
        <td>2nd</td>
        <td>english<br />
          chinese</td>
        <td>
            <button data-id="2" class="btn btn-primary edit">Edit</button> 
            <button data-id="2" class="btn btn-primary delete">Delete</button> 
        </td>
    </tr>
    <tr data-type="editable" valign="top" data-id="82">
        <td>remove insulation</td>
        <td>Water Damage</td>
        <td>Emergency</td>
        <td>3rd</td>
        <td>english<br />
chinese</td>
        <td>
            <button data-id="82" class="btn btn-primary edit">Edit</button> 
            <button data-id="82" class="btn btn-primary delete">Delete</button> 
        </td>
    </tr>
    <tr data-type="editable" valign="top" data-id="84">
        <td>remove baseboard</td>
        <td>Water Damage</td>
        <td>Emergency</td>
        <td>1st</td>
        <td>english<br />
chinese</td>
        <td>
            <button data-id="84" class="btn btn-primary edit">Edit</button>  
            <button data-id="84" class="btn btn-primary delete">Delete</button> 
        </td>
    </tr>
</table>