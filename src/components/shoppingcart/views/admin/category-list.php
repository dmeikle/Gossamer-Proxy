    <!--- css start --->
    @components/shoppingcart/includes/css/admin-list.css
    <!--- css end --->

    <!--- javascript start --->
    @components/shoppingcart/includes/js/category-list.js
    <!--- javascript end --->

    <button data-id="0" type="button" class="edit"><?php echo $this->getString('BUTTON_NEW');?></button>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_CATEGORIES_LIST');?>
    </div>
<table class="table table-striped">

            <?php


            foreach($Categorys as $category) {

                ?>
                <tr>
                    <td>
                        <?php
                    if(strlen($category['thumbnail']) > 0) {?>
                        <img width="50" src="/images/cart/categories/thumbnails/<?php echo $category['thumbnail'];?>">
                    <?php
                    }
                    echo $category['category'];
                    ?>
                    </td>
                    <td>
                        <button data-id="<?php echo $category['id'];?>" type="button" class="edit"><?php echo $this->getString('BUTTON_EDIT');?></button>
                        <button data-id="<?php echo $category['id'];?>" type="button" class="delete"><?php echo $this->getString('BUTTON_DELETE');?></button>
                    </td>

                    

                </tr>
            <?php
            }
            ?>

</table>
    </div>