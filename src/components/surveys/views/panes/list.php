<script language="javascript">
    $(document).ready(function () {

        $('.edit').click(function () {
            window.location = '/admin/surveys/panes/' + $(this).data('id');
        });

        $('.list-questions').click(function () {
            window.location = '/admin/surveys/panes/questions/' + $(this).data('id') + '/0/20';
        });

        $("#dialog-confirm").dialog({
            autoOpen: false,
            modal: true
        });

        $('.remove').click(function () {

            var url = '/admin/surveys/panes/remove/' + $(this).data('id');

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
<div id="dialog-confirm" title="Delete this pane?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These pane will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

<a href="/admin/surveys/panes/0">Create New Pane</a>
<table class="table table-hover table-striped">
    <tr>
        <td>Name</td>
        <td>CSS Class</td>
        <td>Action</td>
    </tr>

    <?php
    foreach ($SurveyPanes as $pane) {
        if (count($pane) == 0) {
            return;
        }
        ?>
        <tr>
            <td><?php echo $pane['name']; ?></td>
            <td><?php echo $pane['cssClass']; ?></td>
            <td>
                <button class="btn btn-default btn-sm edit" data-id="<?php echo $pane['id']; ?>">Edit</button>
                <button class="btn btn-default btn-sm remove" data-id="<?php echo $pane['id']; ?>">Delete</button>
                <button class="btn btn-default btn-sm list-questions" data-id="<?php echo $pane['id']; ?>">List Questions</button>
            </td>
        </tr>
    <?php } ?>
</table>
