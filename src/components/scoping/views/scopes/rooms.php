<script language="javascript">
    $(function () {

        $('.details').click(function (e) {
            window.location = '/admin/scoping/locations/rooms/' + $('#locationId').val() + '/' + $(this).data('id');
        });

        var availableTags = [
            "Bedroom1",
            "Bedroom2",
            "Bedroom3",
            "Bedroom4",
            "Bedroom5",
            "Bedroom6",
            "Bedroom7",
            "Bedroom8",
            "Bedroom9",
            "Kitchen",
            "LivingRoom",
            "Bathroom1",
            "Bathroom2",
            "Bathroom3",
            "Ensuite",
            "Dining Area",
            "Foyer",
            "Office",
            "Hallway"
        ];
        $("#tags").autocomplete({
            source: availableTags
        });



    });
</script>

<h2 class="form-signin-heading">Rooms</h2>
<form class="form-standard" role="form" method="post">
    <input name="rooms[locationId]" type="hidden" id="locationId" value="1" />
    <table class="table table-striped">
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <button id="create-user">add room type</button>
            </td>
        </tr>
        <tr>
            <td>Kitchen</td>
            <td>10' x 8'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button>
            </td>
        </tr>
        <tr>
            <td>Bathroom 1</td>
            <td>6' x 4'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button></td>
        </tr>
        <tr>
            <td>Living Room</td>
            <td>10' x 12'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button></td>
        </tr>
        <tr>
            <td>Dining Area</td>
            <td>10' x 10'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button></td>
        </tr>
        <tr>
            <td>Bedroom 1</td>
            <td>14' x 12'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button></td>
        </tr>
        <tr>
            <td>Bedroom 2</td>
            <td>14' x 12'</td>
            <td><button data-id="1" type="button" class="details">details</button>
                <button data-id="1" type="button" class="delete">delete</button></td>
        </tr>
        <tr>
            <td><input id="tags" class="form-control" placeholder="Room Name" name="rooms[name]" type="text" />
            </td>
            <td>
                <div class="col-xs-3">
                    <input class="form-control" placeholder="Width" name="rooms[width]" type="text" />
                </div>
                <div class="col-xs-3">
                    <input  class="form-control" placeholder="Length" name="rooms[length]" type="text" />
                    <input placeholder="Length" name="rooms[RoomTypes_id]" type="hidden" />
                </div></td>
            <td><button data-id="0" class="add">Add Room Details</button></td>
        </tr>
    </table>
</form>

