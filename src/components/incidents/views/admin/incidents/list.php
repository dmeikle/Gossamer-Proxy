
<script language="javascript">

$(document).ready(function() {
   $('.edit').click(function() {
       window.location = '/admin/incidents/type/' + $(this).data('id');
   });
});

</script>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Incident Type</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach($IncidentTypes as $type) {?>
    <tr>
        <td>
            <?php echo $type['incidentType']; ?>
        </td>
        <td>
            <?php echo $type['score']; ?>
        </td>
        <td>
            <button class="btn btn-primary edit" data-id="<?php echo $type['id'];?>">Edit</button>
            <button class="btn btn-primary delete" data-id="<?php echo $type['id'];?>">Delete</button>
        </td>
    </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>

