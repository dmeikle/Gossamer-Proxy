
<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
       window.location = '/admin/events/eventtypes/' + $(this).data('id');
   })
});

</script>
<h3>List Event Types</h3>

<a href="/admin/events/eventtypes/0">Add New Event Type</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Type</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach($EventTypes as $type) {
        if(count($type) < 1) {
            continue;
        }
?>    
        <tr>
            <td>
                <?php echo $type['type']; ?>
            </td>
            
            <td>
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary edit">Edit</button> 
                <button data-id="<?php echo $type['id']; ?>" class="btn btn-primary remove">Delete</button> 
                
            </td>
        </tr>
    <?php } ?>
</table>