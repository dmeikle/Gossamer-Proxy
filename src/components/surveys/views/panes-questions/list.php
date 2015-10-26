<script language="javascript">

    $(document).ready(function () {

        $('.cancel').click(function () {
            window.location = '/admin/surveys/panes/0/20';
        });

        var cache = {};

        function addQuestion(question) {
            $("#sortable").append(
                    '<li id="Questions_id-' + question.id + '" class="new"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' + question.value + '</li>');
        }

        function addQuestionId(question) {
            $('<input>').attr('type', 'hidden').attr('name', 'questionId[]').attr('value', question.id).appendTo('#form1');
        }

        $('#search').on('blur', function () {

            $(this).val('');
        });

        $("#search").autocomplete({
            minLength: 2,
            select: function (event, ui) {
                addQuestion(ui.item);
                addQuestionId(ui.item);
                hideSearch();

            },
            source: function (request, response) {
                var term = request.term;
                if (term in cache) {
                    response(cache[ term ]);

                    addQuestionId(ui.item);
                    hideSearch();
                    return;
                }

                $.post("/admin/surveys/questions/search", request, function (data, status, xhr) {

                    cache[ term ] = data;
                    response(data);
                });
            }
        });


        $('#searchToggle').click(function () {
            $('#search').toggle(true);
        });

        function hideSearch() {
            $('#search').toggle(false);
            $('#search').val('');
        }


        $("#sortable").sortable({
            axis: 'y',
            stop: function (event, ui) {
                $('#trashcan').empty();
                $('#trashcan').append('<span class="glyphicon glyphicon-trash"></span>');

                var data = $(this).sortable('serialize');
                var url = window.location.pathname.split('/');

                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '/admin/surveys/panes/questions/saveorder/' + url[5]
                });
                setLIColors();
            },
            receive: function (event, ui) {
                var data = $(this).sortable('serialize');
                var url = window.location.pathname.split('/');

                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '/admin/surveys/panes/questions/saveorder/' + url[5]
                });
            }
        });

        $("#sortable").disableSelection();


        $('#save').click(function () {
            $('#trashcan').empty();
            $('#trashcan').append('delete me');

            var data = $("#sortable").sortable('serialize');
            var url = window.location.pathname.split('/');

            $.ajax({
                data: data,
                type: 'POST',
                url: '/admin/surveys/panes/questions/saveorder/' + url[5]
            });
            //location.reload();
            setLIColors();
        });

        function setLIColors() {
            $('#sortable').children().removeClass('ui-state-default ui-sortable-handle').addClass('ui-state-default ui-sortable-handle');
        }

        $("#sortable, #trashcan").sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();
    });

</script>

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 30px; }
    #sortable li span { position: absolute; margin-left: -1.3em; }
    .new {
        background-color: infobackground;
    }
</style>

<h3>Add/Edit Questions - <?php echo $SurveyPane['name']; ?></h3>
<form method="post" id="form1">
    <table class="table">
        <tr>
            <th>
                Question List
            </th>
        </tr>
        <tr>
            <td>

                <div id="trashcan" class="connectedSortable" style="float:right" title="drop here to delete question">
                    <span class="glyphicon glyphicon-trash"></span>
                </div>

                <ul id="sortable" class="connectedSortable">


                    <?php
                    foreach ($SurveyPaneQuestions as $question) {
                        if (count($question) == 0) {
                            continue;
                        }
                        ?>
                        <li id="Questions_id-<?php echo $question['id']; ?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $question['question']; ?></li>

                    <?php } ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <div class="glyphicon glyphicon-plus" id="searchToggle"> </div><br>
                <input style="display: none" type=text id="search" class="form-control" />

            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="save" class="btn btn-default" value="Save" />
                <input type="cancel" class="btn btn-default cancel" value="Cancel" />

            </td>
        </tr>
    </table>
</form>