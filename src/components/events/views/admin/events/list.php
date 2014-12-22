<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
      window.location = '/admin/events/' + $(this).data('id');
   });
   
   $('.attendees').click(function() {
       window.location = '/admin/events/eventattendees/' + $(this).data('id') + '/0/20';
   })
   
   $('.prospects').click(function() {
       window.location = '/admin/events/eventprospects/' + $(this).data('id') + '/0/20';
   })
});

</script>
<h2>Events List</h2>
<a href="/admin/events/0">Add New Event</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Event</th>
            <th>Date</th>
            <th>RSVP Required</th>
            <th>Attendees</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach($Events as $event) {
        if(!is_array($event) || count($event) < 1) {
            continue;
        } ?>    
        <tr>
            <td>
                <?php echo $event['name']; ?>
            </td>
            <td>
                <?php echo $event['eventDate']; ?>
            </td>
            <td>
                <?php echo $event['rsvpRequired']; ?>
            </td>
            <td>
                <?php// echo $event['numActions']; ?>
            </td>
            <td>
                <button data-id="<?php echo $event['id'];?>" class="btn btn-primary edit">Edit</button> 
                <button data-id="<?php echo $event['id'];?>" class="btn btn-primary attendees">Attendees</button>
                <button data-id="<?php echo $event['id'];?>" class="btn btn-primary prospects">Prospects</button>
               
            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>