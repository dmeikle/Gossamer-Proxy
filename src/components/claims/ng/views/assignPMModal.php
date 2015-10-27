<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_ASSIGN_PM'); ?>
    </h1>
</div>
<div class="modal-body">
    <div ng-if="modalLoading"></div>
    <table class="table table-hover table-striped">
        <tr>
            <th>Name</th>
            <th>Preferred</th>
            <th></th>
        </tr>
        <?php foreach ($ProjectManagers as $staff) { ?>
            <tr>
                <td><?php echo $staff['lastname']; ?>, <?php echo $staff['firstname']; ?></td>
                <td> </td>
                <td><a ng-click="selectPM(<?php echo $staff['Staff_id']; ?>)">select</a></td>
            </tr>
        <?php } ?>
    </table>
</div>