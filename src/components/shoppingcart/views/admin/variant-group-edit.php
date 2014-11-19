

<?php
$variantGroup = current($VariantGroup);
?>


<form method="post">
    <table class="tab-content">
        <tr>
            <td colspan="2"><h3><?php echo $this->getString('LABEL_ADD_EDIT_VARIANT_OPTION');?></h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <ul class="nav nav-tabs" role="tablist">
                <?php
                foreach($SystemLocalesList as $locale) {
                    
                    if($locale['isDefault']) {
                        echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                    } else {
                        echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['locale']}</a></li>\r\n";
                    }
                }
                ?>
            </ul>
               <!-- Tab panes -->
                <div class="tab-content">
                    <?php
                    reset($SystemLocalesList);
                    foreach($SystemLocalesList as $locale) {?>
                        <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active':'';?>" id="<?php echo $locale['locale'];?>">
                            <table width="100%">
                                <tr>
                                    <td width="120"><?php echo $this->getString('LABEL_VARIANT');?>:</td>
                                    <td><input class="form-control" type="text" name="variantGroup[locale][<?php echo $locale['locale']; ?>][groupName]" value="<?php echo htmlspecialchars($variantGroup['locales'][$locale['locale']]['groupName'], ENT_NOQUOTES, 'UTF-8');?>"/></td>
                                </tr>
                            </table>
                        </div>
                   <?php
                    }
                   ?>
                </div>  
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input name="Submit" type="submit" id="Submit" value="<?php echo $this->getString('BUTTON_SAVE');?>">
                <button type="button" class="cancel"><?php echo $this->getString('BUTTON_CANCEL');?></button>
            </td>   
        </tr>
    </table>

</form>