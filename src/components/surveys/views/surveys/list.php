

<script language="javascript">

    $(document).ready(function () {
        $('.edit').click(function () {
            window.location = '/admin/surveys/' + $(this).data('id');
        });

        $('.builder').click(function () {
            window.location = '/admin/surveys/builder/' + $(this).data('id');
        });

        $('.pages').click(function () {
            window.location = '/admin/surveys/survey/pages/' + $(this).data('id');
        });

        $('.responses').click(function () {
            window.location = '/admin/surveys/responses/' + $(this).data('id');
        });

    });

</script>
<a href="/admin/surveys/0">Add New Survey</a>


<table class="table table-striped">
    <thead>
        <tr>
            <th>Survey</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($Surveys as $survey) {
        ?>
        <tr>
            <td><?php echo $survey['name']; ?></td>
            <td><?php echo (($survey['isActive'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : ''); ?></td>
            <td><button class="btn btn-primary edit" data-id="<?php echo $survey['id']; ?>">Edit</button>
                <button class="btn btn-primary remove" data-id="<?php echo $survey['id']; ?>">Delete</button>
                <button class="btn btn-primary pages" data-id="<?php echo $survey['id']; ?>">Pages</button>
                <button class="btn btn-primary responses" data-id="<?php echo $survey['id']; ?>">Responses</button></td>
                <?php
            }
            ?>
</table>

<?php echo $pagination; ?>