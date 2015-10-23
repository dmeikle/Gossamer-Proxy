
<script language="javascript">

    $(document).ready(function () {
        $('.delete').click(function (e) {
            if (confirm('Are you sure you want to delete this floorplan?') == false) {
                return;
            }

            $('#floorPlanId').val($(this).data('id'));

            $('#form1').submit();
        });
    });

</script>
<a href="<?php echo $projectAddressId; ?>/0">add floorplan</a>

<form method="post" id="form1">
    <input type="hidden" id="floorPlanId" name="floorplan[id]" />
    <table class="table table-striped">
        <?php
        foreach ($ProjectAddresssFloorPlans as $floorplan) {
            if (count($floorplan) == 0) {
                continue;
            }
            ?>
            <tr>
                <td><?php echo $floorplan['name']; ?></td>
                <td><img src="<?php echo "/images/floorplans/$projectAddressId/thumbs/" . $floorplan['floorPlan']; ?>"</td>
                <td><input type="button" data-id="<?php echo $floorplan['id']; ?>" class="btn btn-default delete" value="Delete" /></td>
            </tr>
        <?php } ?>
    </table>
</form>