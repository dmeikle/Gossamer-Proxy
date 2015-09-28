
<form method="post">
    <table class="table">
        <tr>
            <td>Name</td>
            <td><input type="text" name="WidgetPage[name]" value="<?php echo $name;?>" /></td>
        </tr>
        <tr>
            <td>Description</td>  
            <td><input type="text" name="WidgetPage[description]" value="<?php echo $description;?>"  /></td>
        </tr>
        <tr>  
            <td>YML Key</td>
            <td><input type="text" name="WidgetPage[ymlKey]" value="<?php echo $ymlKey;?>"  /></td>
        </tr>
        <tr>
            <td>Active</td>
            <td><input type="checkbox" name="WidgetPage[isActive]" value="1" checked="<?php echo ($isActive) ? 'checked' : '' ;?>"  /></td>
        </tr>
        <tr>
            <td>System</td>
            <td><input type="checkbox" name="WidgetPage[isSystemPage]" value="1" checked="<?php echo ($isSystemPage) ? 'checked' : '' ;?>" /></td>
        </tr>
        <tr>
            <td>Action</td>
            <td><input type="submit" value="submit" /></td>
        </tr>
        <tr>
    </table>
</form>