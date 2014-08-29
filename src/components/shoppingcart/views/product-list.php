<!--- css start --->
@components/shoppingcart/includes/css/products-list.css
<!--- css end --->

<?php

foreach($Products as $product) {

    ?>
   <div class="product">
       <div class="product-description">
          <p><?php echo $product['title'];?>: <?php echo $product['briefDescription'];?></p>
          <p><?php echo $product['product_code'];?></p>
        </div>
        <div class="product-image">
        <?php 
        if(strlen($product['thumbnail']) > 0) {?>
            <a href="<?php echo $product['id'];?>/<?php echo $product['title'];?>/">
               <img class="item" src="/images/cart/thumbnails/<?php echo $product['thumbnail'];?>"/>
            </a>
         <?php
          }
           ?>
        </div>       
   </div>
<?php
}
?>
