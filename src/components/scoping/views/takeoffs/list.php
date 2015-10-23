
<script language="javascript">

    $(function () {

        $('.selectable-rows tr').click(function (e) {

            e.preventDefault();

            window.location = '/admin/scoping/takeoffs/' + $(this).data('id');

        });

    });

</script>




<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th>Claim ID</th>
            <th>Location</th>
            <th>Date</th>
            <th>Scope By</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tr id="1">
        <td>MV-14JS123</td>
        <td>The Palace, 1234 University Pl, Surrey, BC</td>
        <td>2014-06-10</td>
        <td>Justin</td>
        <td>$500.67</td>
    </tr>
    <tr>
        <td>MV-14JS123</td>
        <td>The Palace, 1234 University Pl, Surrey, BC</td>
        <td>2014-06-10</td>
        <td>Justin</td>
        <td>$500.67</td>
    </tr>
    <tr>
        <td>MV-14JS123</td>
        <td>The Palace, 1234 University Pl, Surrey, BC</td>
        <td>2014-06-10</td>
        <td>Justin</td>
        <td>$500.67</td>
    </tr>
    <tr>
        <td>MV-14JS123</td>
        <td>The Palace, 1234 University Pl, Surrey, BC</td>
        <td>2014-06-10</td>
        <td>Justin</td>
        <td>$500.67</td>
    </tr>
    <tr>
        <td>MV-14JS123</td>
        <td>The Palace, 1234 University Pl, Surrey, BC</td>
        <td>2014-06-10</td>
        <td>Justin</td>
        <td>$500.67</td>
    </tr>

</table>