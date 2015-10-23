

<script language="javascript">

    $(document).ready(function () {
        $("#dialog-confirm").dialog({
            autoOpen: false,
            modal: true
        });

        $('.edit').click(function () {
            window.location = '/admin/surveys/answers/' + $(this).data('id');
        })

        $('.remove').click(function () {

            var url = '/admin/surveys/answers/remove/' + $(this).data('id');

            $("#dialog-confirm").dialog({
                buttons: {
                    "Confirm": function () {
                        window.location = url;
                    },
                    "Cancel": function () {
                        $(this).dialog("close");
                    }
                }
            });

            $("#dialog-confirm").dialog("open");
//        if(confirm('Are you sure you want to delete this answer?') == false) {
//            return;
//        }

            //window.location = '/admin/surveys/answers/remove/' + $(this).data('id');
        });

        $("#dialog-confirm").dialog({
            resizable: false,
            height: 140,
            modal: true,
            buttons: {
                "Delete selected item": function () {
                    $(this).dialog("close");
                },
                Cancel: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

</script>
<style>
    #dialog-confirm {
        display: none;
    }
</style>
<div id="dialog-confirm" title="Delete this answer?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These answer will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

<a href="/admin/surveys/answers/0">Add New Answer</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Answer</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach ($Answers as $answer) {
        if (count($answer) == 0) {
            continue;
        }
        ?>
        <tr>
            <td><?php echo $answer['answer']; ?></td>
            <td><?php echo (($answer['isActive'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : ''); ?></td>
            <td><button class="btn btn-primary edit" data-id="<?php echo $answer['id']; ?>">Edit</button>
                <button class="btn btn-primary remove" data-id="<?php echo $answer['id']; ?>">Delete</button>

                <?php
            }
            ?>
</table>


<?php echo $pagination; ?>