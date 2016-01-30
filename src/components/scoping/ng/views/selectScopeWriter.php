<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_ASSIGN_SCOPE_WRITER'); ?>
    </h1>
</div>
<div class="modal-body">

    <table class="table table-hover table-striped">
        <tr>
            <th>Name</th>

            <th></th>
        </tr>

        <?php foreach ($Staff as $staff) { ?>
            <tr>
                <td><?php echo $staff['lastname']; ?>, <?php echo $staff['firstname']; ?></td>
                <td><a href="" ng-click="selectScopeWriter(<?php echo $staff['id']; ?>)">select</a></td>
            </tr>
        <?php } ?>
    </table>
</div>