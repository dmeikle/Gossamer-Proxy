
<script src="https://cdn.ckeditor.com/4.4.5.1/standard/ckeditor.js"></script>


<form method="post">

    <table class="table">
        <tr>
            <td>Message Type:</td>
            <td><select name="template[MessageTypes_id]" class="form-control" id="template_messageTypesId">

                </select></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" class="form-control" name="template[name]" /></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea class="form-control" name="template[description]"></textarea></td>
        </tr>
        <tr>
            <td>Content:</td>
            <td>
                <textarea name="template[template]" id="template_template" rows="10" cols="80" placeholder="insert page content here"><?php //echo $template['template']        ?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('template_template');
                </script>

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button class="btn btn-primary">Save</button>
                <input type="button" value="Cancel" id="cancel" />
            </td>
        </tr>
    </table>

</form>