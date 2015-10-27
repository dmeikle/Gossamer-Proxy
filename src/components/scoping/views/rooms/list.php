<script language="javascript">

    $(document).ready(function () {

        $('.view').click(function () {
            window.location = '/admin/scoping/view/' + $(this).data('id');
        });

        $('.scope').click(function () {
            window.location = '/admin/scoping/' + $(this).data('id');
        });

    });

</script>


<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th align="center">Room</th>
            <th width="11%" align="center">Length</th>
            <th width="11%" align="center">Width</th>
            <th width="11%" align="center">Tag</th>
            <th  align="center">Action</th>
        </tr>
    </thead>
    <tr data-type="editable" valign="top" data-id="1">
        <td>Bedroom 1</td>
        <td>12</td>
        <td>10</td>
        <td>101</td>
        <td>
            <button data-id="1" class="delete">Delete</button>
            <button data-id="1" class="scope">Edit Scope</button>
            <button data-id="1" class="view">View</button>
        </td>
    </tr>

    <tr data-type="editable" valign="top" data-id="1">
        <td>Bedroom 2</td>
        <td>12</td>
        <td>10</td>
        <td>101</td>
        <td>
            <button data-id="1" class="delete">Delete</button>
            <button data-id="1" class="scope">Edit Scope</button>
            <button data-id="1" class="view">View</button>
        </td>
    </tr>

    <tr data-type="editable" valign="top" data-id="1">
        <td>Kitchen</td>
        <td>12</td>
        <td>10</td>
        <td>101</td>
        <td>
            <button data-id="1" class="delete">Delete</button>
            <button data-id="1" class="scope">Edit Scope</button>
            <button data-id="1" class="view">View</button>
        </td>
    </tr>
</table>