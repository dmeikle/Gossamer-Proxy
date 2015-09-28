<!--- css start --->
@components/shoppingcart/includes/css/admin-list.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/product-list.js
<!--- javascript end --->

<button data-id="0" type="button" class="edit"><?php echo $this->getString('BUTTON_CREATE_NEW');?></button>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_PRODUCT_LIST');?>
    </div>
<table class="table table-striped">
<?php


foreach($CartProducts as $product) {

    ?>
   <tr>
       <td>
           <?php if(strlen($product['thumbnail']) > 0) {?>
           <img width="50" src="/images/cart/thumbnails/<?php echo $product['thumbnail'];?>">
     <?php
      }
           echo $product['title'];?></td>
       <td>
           <button data-id="<?php echo $product['id'];?>" type="button" class="edit"><?php echo $this->getString('BUTTON_EDIT');?></button>
           <button data-id="<?php echo $product['id'];?>" type="button" class="delete"><?php echo $this->getString('BUTTON_DELETE');?></button>
           <button data-id="<?php echo $product['id'];?>" type="button" class="discount"><?php echo $this->getString('BUTTON_VOLUME_DISCOUNT');?></button>
           <button data-id="<?php echo $product['id'];?>" type="button" class="variants"><?php echo $this->getString('BUTTON_VARIANT_OPTIONS');?></button>
       </td>
   </tr>
<?php
}
?>
</table>    
</div>
<?php echo $pagination; ?>