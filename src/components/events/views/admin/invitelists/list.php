<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
      document.location = '/admin/events/lists/' + $(this).data('id');
   });
   $('.view').click(function() {
      document.location = '/admin/events/list/' + $(this).data('id') + '/0/20';
   });
});

</script>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    
    
    foreach($InviteLists as $eventList) {
        if(count($eventList) < 1) {
            continue;
        }
        ?>
    <tr>
        <td><?php echo $eventList['name']; ?></td>
        <td><?php echo $eventList['dateCreated']; ?></td>
        <td>
            <button data-id="<?php echo $eventList['id']; ?>" class="btn view">View</button> 
            <button data-id="<?php echo $eventList['id']; ?>" class="btn edit">Edit</button> 
            <button data-id="<?php echo $eventList['id']; ?>" class="btn delete">Delete</button> 
        </td>
    </tr>
    <?php } ?>
</table>

<?php
echo $pagination;
?>