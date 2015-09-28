
<script language="javascript">

$(document).ready(function() {
    $('.edit').click(function() {
       window.location.href = '/super/notifications/templates/' + $(this).data('id');
    });
})

</script>


<table class="table table-striped">
    <tr>
        <th>Name</th>
   
        <th>Description</th>    
  
        <th>Type</th>   
  
        <th>Action</th>
    </tr>
    <?php foreach($MessagingNotificationTemplates as $template) {?>
    <tr>
        <td><?php echo $template['name'];?></td>
        <td><?php echo $template['description'];?></td>
        <td><?php echo $template['MessagingTypes_id'];?></td>
        <td><button data-id="<?php echo $template['id'];?>" class="btn btn default edit">Edit</button> 
        <button data-id="<?php echo $template['id'];?>" class="btn btn default delete">Delete</button></td>
    </tr>
    
    <?php } ?>
</table>

<?php echo $pagination;?>