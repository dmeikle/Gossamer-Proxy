<script language="javascript">
$(document).ready(function() {
    $('.edit').click(function() {
        window.location = '/admin/surveys/panes/' + $(this).data('id');
    })
    
    $('.list-questions').click(function() {
        window.location = '/admin/surveys/panes/questions/' + $(this).data('id') + '/0/20';
    })
});
</script>
<a href="/admin/surveys/panes/0">Create New Pane</a>
<table class="table table-hover table-striped">
    <tr>
        <td>Name</td>
        <td>CSS Class</td>
        <td>Action</td>
    </tr>
    
    <?php
    foreach($SurveyPanes as $pane) {?>
    <tr>
        <td><?php echo $pane['name'];?></td>
        <td><?php echo $pane['cssClass'];?></td>
        <td>
            <button class="btn btn-default btn-sm edit" data-id="<?php echo $pane['id']; ?>">Edit</button> 
            <button class="btn btn-default btn-sm delete" data-id="<?php echo $pane['id']; ?>">Delete</button> 
            <button class="btn btn-default btn-sm list-questions" data-id="<?php echo $pane['id']; ?>">List Questions</button> 
        </td>
    </tr>
    <?php } ?>
</table>
