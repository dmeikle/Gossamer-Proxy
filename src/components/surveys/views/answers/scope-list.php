<script language="javascript">

    $(document).ready(function () {
        $('.view').click(function () {
            window.location = '/admin/surveys/sheetanswers/' + $(this).data('id');
        });

        $('.remove').click(function () {
            window.location = '/admin/surveys/sheetanswers/' + $(this).data('id');
        });


    });

</script>


<a href="">English</a> | <a href="">Chinese</a>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>
                Selection
            </th>
            <th>
                Type
            </th>
            <th># Times Used</th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tr>
        <td>
            Size
        </td>
        <td>
            Text
        </td>
        <td>23</td>
        <td>
            <button class="btn btn-primary view" data-id="1">View</button>
            <button class="btn btn-primary remove" data-id="1">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            R Rating
        </td>
        <td>
            Text
        </td>
        <td>12</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            North
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>16</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            South
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>16</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            East
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>16</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            West
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>16</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            Each
        </td>
        <td>
            Text
        </td>
        <td>15</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            Bi-Fold
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>6</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
    <tr>
        <td>
            Entry Door
        </td>
        <td>
            Multi-Select Button
        </td>
        <td>5</td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
            <button class="btn btn-primary remove" data-id="2">Retire</button>
        </td>
    </tr>
</table>