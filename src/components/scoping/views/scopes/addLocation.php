
<script language="javascript">

    $(document).ready(function () {

        $('.add-room').click(function (e) {
            window.location = '/admin/scoping/location/rooms/' + $(this).data('id') + '/0';
        });

    });
</script>

<table class="table">
    <tr>
        <td>Unit:</td>
        <td><label for="textfield"></label>
            <input name="textfield" type="text" class="form-control" id="textfield" /></td>
    </tr>
    <tr>
        <td>Name:</td>
        <td><input name="textfield2" type="text" class="form-control" id="textfield2" /></td>
    </tr>
    <tr>
        <td>Telephone:</td>
        <td><input name="textfield3" type="text" class="form-control" id="textfield3" /></td>
    </tr>
    <tr>
        <td>Areas Affected:</td>
        <td>Bedroom 1, Kitchen, Living Room <button data-id="1" class="btn add-room btn-primary" >Add Room</button></td>
    </tr>
    <tr>
        <td>Time:</td>
        <td><input name="textfield5" type="text" class="form-control" id="textfield5" /></td>
    </tr>
    <tr>
        <td>Notes:</td>
        <td><input name="textfield6" type="text" class="form-control" id="textfield6" /></td>
    </tr>
    <tr>
        <td></td>
        <td><button class="btn btn-primary" >Save</button></td>
    </tr>
</table>