
<!--- javascript start --->
@components/shoppingcart/includes/js/admin-category.js
@components/shoppingcart/includes/js/bootstrap-wysiwyg.js
@components/shoppingcart/includes/js/jquery.hotkeys.js
<!--- javascript end --->

<!--- css start --->

components/shoppingcart/includes/css/new1.css

<!--- css end --->



<?php
$locale = current($Locale);
?>
<form method="post">
    <table class="tab-content">
        <tr>
            <td colspan="2"><h3><?php echo $this->getString('LABEL_ADD_EDIT_LANGUAGE'); ?></h3></td>
        </tr>
        <tr>
            <td><?php echo $this->getString('LABEL_LOCALE'); ?>:</td>
            <td>
                <input type="text" name="locale[locale]" value="<?php echo $locale['locale']; ?>" />
            </td>
        </tr>
        <tr>
            <td><?php echo $this->getString('LABEL_LANGUAGE'); ?>:</td>
            <td>
                <input type="text" name="locale[languageName]" value="<?php echo $locale['languageName']; ?>" />
            </td>
        </tr>

        <tr>
            <td><?php echo $this->getString('LABEL_ICON'); ?></td>
            <td><select id="icon" class="form-control" name="locale[icon]">
                    <?php
                    foreach ($thumbnails as $file) {
                        echo $file['name'];
                        if (!strpos($file['name'], "thumbnails")) {
                            echo '<option value="' . $file["name"] . '"';
                            if ($file["name"] == $locale['icon'])
                                echo " selected";
                            echo '>' . $file["name"] . '</option>';
                        }
                    }
                    ?>
                </select>   <span id="imagePreview" /> </td>
        </tr>
        <tr>
            <td colspan="2">
                <input name="Submit" type="submit" id="Submit" value="<?php echo $this->getString('BUTTON_SAVE'); ?>">
                <button type="button" class="cancel"><?php echo $this->getString('BUTTON_CANCEL'); ?></button>
            </td>
        </tr>
    </table>

</form>
<?php ?>