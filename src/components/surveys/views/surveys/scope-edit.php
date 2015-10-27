
<script language="javascript">

    $(document).ready(function () {
        $('.edit-question').click(function () {
            window.location = '/admin/surveys/sheetquestions/' + $(this).data('id');
        })

    });

</script>

<table class="table table-striped table-hover">
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="button" value="Set Active" class="btn btn-primary" />
            <input type="submit" value="Set Inactive" class="btn btn-primary" /></td>
        <td>Action</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" class="form-control" name="textfield" id="textfield" /></td>
        <td><span class="success">
                <input type="submit" value="Add Category" class="btn btn-primary" />
            </span></td>
    </tr>
    <tr class="success">
        <td>&nbsp;</td>
        <td>Drywall &amp; Paint</td>
        <td><input type="submit" value="Edit" class="btn btn-primary edit-category" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>S/I Insulation to Walls</td>
        <td><input type="submit" value="Edit" class="btn btn-primary edit-question" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>S/I Insulation to Ceiling</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>S/I 6mil Vapour Barrier to</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Plumbing &amp; Cabinetry</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr class="success">
        <td>&nbsp;</td>
        <td>Toilet and All Related Plumbing</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Washer &amp; Dryer</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Hot Water Tank</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Tub</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Mirror from Wall</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>Re-use Doors / Drawers and Hardware to Upper Cabinets &amp; Lower Cabinets</td>
        <td><input type="submit" value="Edit" class="btn btn-primary" />
            <input type="submit" value="Delete" class="btn btn-primary" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
