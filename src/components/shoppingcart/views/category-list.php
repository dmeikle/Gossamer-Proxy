list page
<?php
foreach($CartCategorys as $category) {
    ?>
   <div class="category">
       <?php 
       if(strlen($category['thumbnail']) > 0) {?>
           <img src="/images/cart/thumbnails/<?php echo $category['thumbnail'];?>">
     <?php
      }
       ?>
  
   <a href="/cart/<?php echo $category['category'];?>/">
        <?php echo $category['category'];?>
   </a>
   </div>
<?php
}
?>
