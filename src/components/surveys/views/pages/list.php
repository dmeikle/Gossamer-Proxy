
<script language="javascript">

    $(document).ready(function() {
        $('.edit').click(function() {
           document.location = '/admin/surveys/pages/' + $(this).data('id');
        });
        
        $('.panes').click(function() {
           document.location = '/admin/surveys/pages/panes/' + $(this).data('id') + '/0/20';
        });
        
        
    });
    
</script>
<a href="/admin/surveys/pages/0">Add New Page</a>

<table class="table">
    <tr>
        <td>
            Name
        </td>
        <td>
            Action
        </td>
    </tr>
    <?php foreach($SurveyPages as $page) {
        if(count($page) == 0) {
            continue;
        }
?>
    <tr>
        <td>
            <?php echo $page['name'];?>
        </td>
        <td>
            <button class="btn btn-small btn-primary edit" data-id="<?php echo $page['id'];?>">Edit</button> 
            <button class="btn btn-small btn-primary delete" data-id="<?php echo $page['id'];?>">Delete</button> 
            <button class="btn btn-small btn-primary panes" data-id="<?php echo $page['id'];?>">List Panes</button> 
        </td>
    </tr>
    <?php }?>
</table>