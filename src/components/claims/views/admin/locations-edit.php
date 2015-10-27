<!--- javascript start --->

@components/claims/includes/js/popbox.js
@components/claims/includes/js/multiupload.js

<!--- javascript end --->



<style>
    .image {
        height: 150px;
        width: 150px;
        margin: 4px;
        display: inline-block;
        float: left;
    }

    .uploadArea {
        min-height: 300px;
        height: auto;
        border: 1px dotted #ccc;
        padding: 10px;
        cursor: move;
        margin-bottom: 10px;
        position: relative;
    }
</style>


<script type="text/javascript">
    var config = {
        support: "image/jpg,image/png,image/bmp,image/jpeg,image/gif", // Valid file formats
        form: "demoFiler", // Form ID
        dragArea: "dragAndDropFiles", // Upload Area ID
        uploadUrl: "/admin/claimlocations/photos/upload/2/23"				// Server side upload url
    }
    $(document).ready(function () {
        initMultiUploader(config);
    });
</script>

<table class="table">
    <tr>
        <td>Unit Number:</td>
        <td><label for="textfield"></label>
            <input name="ClaimsLocations[unitNumber]" type="text" class="form-control" id="unitNumber" /></td>
    </tr>
    <tr>
        <td>Floor Plan:</td>
        <td>
            <select name="ClaimsLocations[ProjectAddressesFloorPlans_id]" class="form-control">
                <option value="1">plan a</option>
                <option value="2">plan b</option>
                <option value="3">plan c</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Current Phase:</td>
        <td>
            <select name="workPhaseId" id="workPhaseId">
                <option value="1">in-progress</option>
                <option value="2">emergency</option>
                <option value="3">completed</option>
            </select>
            click to edit
        </td>
    </tr>
    <tr>
        <td>Work Status:</td>
        <td>on-hold | complete ...?</td>
    </tr>
    <tr>
        <td>Notes:</td>
        <td><input name="textfield5" type="text" class="form-control" id="textfield5" /></td>
    </tr>
    <tr>
        <td>Photos:
            <button>add</button>
        </td>
        <td>


            <div class='image'><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image' ><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image'><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image'><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image'><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image'><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>
            <div class='image' ><img class='image' width="150" src="http://cdn.freshome.com/wp-content/uploads/2011/01/budget_renovation_finished-e1294540652588.jpg" onclick="Pop(this, 50, 'PopBoxImageLarge');" /></div>

            </div>

        </td>
    </tr>
</table>

<div id="dragAndDropFiles" class="uploadArea">
    <h1>Drop Images Here</h1>
</div>
<form name="demoFiler" id="demoFiler" enctype="multipart/form-data">
    <input type="file" name="multiUpload" id="multiUpload" multiple />
    <input type="submit" name="submitHandler" id="submitHandler" value="Upload" class="buttonUpload" />
</form>
<div class="progressBar">
    <div class="status"></div>
</div>