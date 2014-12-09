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


foreach($Products as $product) {

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

<ul class="pagination">
    <?php $firstPagination = current($pagination);?>
    <?php $lastPagination = end($pagination);?>
  <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/cart/products" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>" >&laquo;</a></li>
  <?php foreach($pagination as $index => $page) { ?>
  <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/cart/products" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
  <?php } ?>
  <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/cart/products" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
</ul>