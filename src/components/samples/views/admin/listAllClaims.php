<script language="javascript">

    $(document).ready(function () {

        $('.view').click(function () {

            window.location = '/admin/samples/edit/' + $(this).data('id');
        });
    });

</script>
note to self: use Claims_id as the data-id for loading, so that<br>
it can interface with link from claims-list page
<table class="table table-striped">
    <thead>
        <tr>
            <th>
                Claim ID
            </th>
            <th>
                Quantity
            </th>
            <th>
                Date
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tr>
        <td>
            MV-14JS123
        </td>
        <td>
            2
        </td>
        <td>
            2014-10-10
        </td>
        <td>
            <button class="btn btn-primary view" data-id="1">View</button>
        </td>
    </tr>
    <tr>
        <td>
            MV-14JS124
        </td>
        <td>
            1
        </td>
        <td>
            2014-10-11
        </td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
        </td>
    </tr>
    <tr>
        <td>
            MV-14JS125
        </td>
        <td>
            3
        </td>
        <td>
            2014-10-11
        </td>
        <td>
            <button class="btn btn-primary view" data-id="3">View</button>
        </td>
    </tr>
</table>