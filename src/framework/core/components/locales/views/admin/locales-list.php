    <!--- css start --->
    @components/shoppingcart/includes/css/admin-list.css
    <!--- css end --->

    <!--- javascript start --->
    
    <!--- javascript end --->
  
    
 <h3><?php echo $this->getString('LABEL_LANGUAGES_LIST');?></h3>
    <button data-id="0" type="button" class="edit"><?php echo $this->getString('BUTTON_NEW');?></button>
<div class="panel panel-default">
   
<table class="table table-striped">
    <tr>
        <td>
            <?php echo $this->getString('LABEL_LANGUAGE');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_ACTION');?>
        </td>
    </tr>
            <?php


            foreach($Locales as $locale) {

                ?>
                <tr>
                    <td>
                        <?php
                    if(strlen($locale['icon']) > 0) {?>
                        <img src="/images/flags/<?php echo $locale['icon'];?>.gif">
                    <?php
                    }
                    echo $locale['languageName'];
                    ?>
                    </td>
                    <td>
                        <button data-id="<?php echo $locale['id'];?>" type="button" class="edit"><?php echo $this->getString('BUTTON_EDIT');?></button>
                        <button data-id="<?php echo $locale['id'];?>" type="button" class="delete"><?php echo $this->getString('BUTTON_DELETE');?></button>
                    </td>

                    

                </tr>
            <?php
            }
            ?>

</table>
    </div>