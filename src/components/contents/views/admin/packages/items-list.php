
<script language="javascript">

    $(document).ready(function () {

        $('#add-item').click(function (e) {

            $.post("demo_test.asp",
                    {
                        quantity: $('#quantity').val(),
                        manualName: $('#manual_name').val(),
                        itemName: $('#item_name').val(),
                        notes: $('#notes').val(),
                    },
                    function (data, status) {
                        addRow();

                    }
            );
        });

        function addRow() {
            var table = $('#itemList');
            var i = $('#itemList tr').size() + 1;
            var rnd = Math.floor((Math.random() * 1000) + 1);
            table.append('<tr id="row_' + i + rnd + '"><td>' + $('#item_name').val() + '</td><td>' + $('#quantity').val() +
                    '</td><td>' + $('#notes').val() + '</td><td><button class="remove-item" data-id="' + i + rnd + '">Delete</button></td></tr>');
        }

        $('.remove-item').click(function (e) {
            if (!confirm('Do you want to delete this item?')) {
                return;
            }
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "ajax/close.php",
                data: "id=" + id,
                success: function (html) {

                    $(this).closest('tr').remove();
                }
            });
            $(this).closest('tr').remove();
        });

    });

</script>
<br>
<h3>Add Box Items - PackageNumberHere</h3>


<table class="table table-striped table-bordered" id="itemList">
    <tr>
        <td >Item</td>
        <td >Quantity</td>
        <td width="40%">Notes</td>
        <td>Action</td>
    </tr>
    <tr>
        <td><input type="text" class="form-control input-sm" name="itemName" id="item_name" placeholder="standard auto complete" /><br>
            <input type="text" class="form-control input-sm" name="manual_name" id="manual_name" placeholder="manual entry" /></td>
        <td class="col-xs-1">

            <input type="text" class="form-control" name="quantity" id="quantity" />

        </td>
        <td>
            <textarea class="form-control  input-sm" name="notes" id="notes" ></textarea>
        </td>
        <td><button id="add-item">Add</button></td>
    </tr>
    <tr id="row_3">
        <td>dinner plate</td>
        <td>3</td>
        <td>1 is slightly chipped</td>
        <td><button class="remove-item" data-id="3">Delete</button></td>
    </tr>
    <tr id="row_4">
        <td>soup bowl</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td><button class="remove-item" data-id="4">Delete</button></td>
    </tr>
    <tr id="row_5">
        <td>tea cups</td>
        <td>4</td>
        <td>&nbsp;</td>
        <td><button class="remove-item" data-id="5">Delete</button></td>
    </tr>
</table>
