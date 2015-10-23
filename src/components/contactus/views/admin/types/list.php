
<script language="javascript">

    $(document).ready(function () {

        var currentStatus = '';


        $('.edit').click(function (e) {
            window.location = '/admin/contact/types/' + $(this).data('id');
        });


    });
</script>


<h2 class="form-signin-heading">Contact Us Types</h2>

<table class="table table-striped table-hover selectable-rows">
    <tr>
        <th align="center">Name</th>
        <th  align="center">Action</th>
    </tr>
    <?php foreach ($ContactUsTypes as $type) {
        ?>
        <tr data-type="editable" valign="top" data-id="<?php echo $type['id']; ?>">
            <td><?php echo $type['type']; ?></td>
            <td>
                <button data-id="<?php echo $type['id']; ?>" class="edit">Edit</button>
                <button data-id="<?php echo $type['id']; ?>" class="finalize">Delete</button>
            </td>
        </tr>

        <?php
    }
    ?>
</table>
<?php echo $pagination; ?>


