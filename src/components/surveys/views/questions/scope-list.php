<script language="javascript">

    $(document).ready(function () {
        $('.view').click(function () {
            window.location = '/admin/surveys/sheetquestions/' + $(this).data('id');
        });

        $('.remove').click(function () {
            window.location = '/admin/surveys/sheetquestions/' + $(this).data('id');
        });


    });

</script>


<a href="">English</a> | <a href="">Chinese</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>
                Question
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tr>
        <td>
            S/I Insulation to Walls
        </td>
        <td>
            <button class="btn btn-primary view" data-id="1">View</button>
            <button class="btn btn-primary remove" data-id="1">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            S/I Insulation to Ceilings
        </td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
</table>