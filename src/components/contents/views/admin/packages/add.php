
<script language="javascript">

    $(document).ready(function () {

        //this will need to change the form action before submitting
        $('#save-add-contents').click(function (e) {
            window.location = '/admin/contents/package/items/locationId/packageId';
        });

    });

</script>


<br />
<table>
    <tr>
        <td>Claim</td>
        <td>label value</td>
    </tr>
    <tr>
        <td>Location</td>
        <td>label ID</td>
    </tr>
    <tr>
        <td>Room</td>
        <td><select class="form-control" name="select2" id="select2">
            </select></td>
    </tr>
    <tr>
        <td>Packed By</td>
        <td><select class="form-control" name="select" id="select">
            </select></td>
    </tr>
    <tr>
        <td>Fragile</td>
        <td><input class="form-control" type="checkbox" name="checkbox" id="checkbox"></td>
    </tr>
    <tr>
        <td>Special Instructions    </td>
        <td><textarea class="form-control" name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
        <td> </td>
        <td>
            <button id="save-new-box" class="btn btn-warning">Save and Add New Box</button>
            <button id="save-add-contents" class="btn btn-primary">Save and Add Contents</button>
        </td>
    </tr>
</table>
