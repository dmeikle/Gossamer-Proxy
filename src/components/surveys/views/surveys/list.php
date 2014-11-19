
<script language="javascript">

$(document).ready(function() {
   $('.view').click(function() {
       window.location = '/admin/surveys/scopeforms/' + $(this).data('id');
   })
});

</script>


<table class="table table-striped">
    <thead>
        <tr>
            <th>
                Form Name
            </th>
            <th>
                Active
            </th>
            <th>
                Date Modified
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tr>
        <td>
            Form 1
        </td>
        <td>
            <span class="glyphicon glyphicon-ok-circle"></span>
        </td>
        <td>
            2014-10-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="1">View</button>
        </td>
    </tr>
    <tr>
        <td>
            Form 2
        </td>
        <td>
            
        </td>
        <td>
            2014-05-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
        </td>
    </tr>
    <tr>
        <td>
            Form 3
        </td>
        <td>
            
        </td>
        <td>
            2014-01-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="3">View</button>
        </td>
    </tr>
</table>