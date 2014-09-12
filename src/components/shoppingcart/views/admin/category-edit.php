
<!--- javascript start --->
    @components/shoppingcart/includes/js/admin-category.js
    @components/shoppingcart/includes/js/bootstrap-wysiwyg.js
    @components/shoppingcart/includes/js/jquery.hotkeys.js
<!--- javascript end --->

<!--- css start --->

    components/shoppingcart/includes/css/new1.css

<!--- css end --->



<?php
$category = current($Category);

?>
<form method="post">
    <table class="tab-content">
        <tr>
            <td colspan="2"><h3><?php echo $this->getString('LABEL_ADD_EDIT_CATEGORY');?></h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <ul class="nav nav-tabs" role="tablist">
                <?php
                foreach($Locales as $locale) {
                    
                    if($locale['isDefault']) {
                        echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                    } else {
                        echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                    }
                }
                ?>
            </ul>
            </td>
        </tr>
        <tr>
            <td><?php echo $this->getString('LABEL_PARENT');?>:</td>
            <td>
                <select class="form-control" name="category[parentId]">
                    <option value="0"><?php echo $this->getString('OPTION_PARENT_CATEGORY');?></option>
                    <?php

                    foreach($categories as $key => $parent) {
                        echo "<option value=\"" . $key."\"";
                        if($category['parentId'] == $key) {
                            echo " selected";
                        }
                        echo ">$parent</option>\r\n";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><?php echo $this->getString('LABEL_CATEGORY');?>:</td>
            <td>
               <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    reset($Locales);
                    foreach($Locales as $locale) {

                       $categoryName = "";
                       if(array_key_exists($locale['locale'], $category['locales'])) {
                           //need to check for key in case it's a new category or new locale
                           $categoryName = $category['locales'][$locale['locale']]['category'];
                       }

                        ?>
                    <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active':'';?>" id="<?php echo $locale['locale'];?>">                   
                        <input class="form-control" type="text" name="category[locale][<?php echo $locale['locale']; ?>][category]" value="<?php echo $categoryName;?>"/>
                    </div>
                   <?php
                    }
                   ?>
                </div>  
            </td>
        </tr>

        <tr>
            <td><?php echo $this->getString('LABEL_PICTURE');?></td>
            <td><select class="form-control" name="category[thumbnail]">
                    <?php

                    foreach($thumbnails as $file){
                        echo $file['name'];
                        if(!strpos ($file['name'],"thumbnails")){
                            echo '<option value="'.$file["name"].'"';
                            if ($file["name"] == $category['thumbnail'])
                                echo " selected";
                            echo '>'.$file["name"].'</option>';
                        }
                    }

                    ?>
                </select>    </td>
        </tr>
        <tr>
            <td colspan="2">
                <input name="Submit" type="submit" id="Submit" value="<?php echo $this->getString('BUTTON_SAVE');?>">
                <button type="button" class="cancel"><?php echo $this->getString('BUTTON_CANCEL');?></button>
            </td>   
        </tr>
    </table>

</form>
<?php

?>