
<!--- javascript start --->
@components/shoppingcart/includes/js/bootstrap-wysiwyg.js
@components/shoppingcart/includes/js/jquery.hotkeys.js
<!--- javascript end --->

<!--- css start --->

@components/shoppingcart/includes/css/product-view.css

<!--- css end --->

<?php
$product = current($Product);

?>
<div id="product">
   
    <img src="/images/cart/<?php echo $product['picture'];?>" />
    <form method="post" class="form-horizontal" role="form" id="stats" action="/cart/view">
         <h3><?php echo $product['locales']['en_US']['title'];?></h3>
        <div id="briefDescription"><?php echo $product['locales']['en_US']['briefDescription'];?></div>
        <div>Product Code: <?php echo $product['product_code'];?></div>
        <div>Price: 
            <?php 
            if($product['isOnSale']) {
                echo '<span class="strikethrough">$'. number_format($product['priceUSD'], 2).'</span> ';
                echo '$' . number_format($product['salePriceUSD'], 2) ;
            }else {
                echo number_format($product['priceUSD'], 2);
            }
            ?>
            
            
            </div>
        <div>Custom Text:
            <?php
            if($product['hasCustomText']) {
            ?>
                <textarea class="form-control" name="product[<?php echo $product['id'];?>][customText]" rows="5" cols="20"></textarea>
            <?php
            }
            ?>
        </div>
        <div>Quantity: 
            <?php
            if($product['minOrderQuantity'] > 0) {
                echo "<select name=\"product[" . $product['id'] . "][quantity]\">";
                for($i = $product['minOrderQuantity']; $i < ($product['minOrderQuantity'] * 100); $i++) {
                    echo "<option>$i</option>\r\n";
                }
                echo "</select>";
            }elseif(($product['numPerBox']) > 1) {
                echo "<select name=\"product[" . $product['id'] . "][quantity]\">";
                for($i = $product['numPerBox']; $i < ($product['numPerBox'] * 100); $i += $product['numPerBox']) {
                    echo "<option>$i</option>\r\n";
                }
                echo "</select>";
            }else{
            ?>
                <input type="input" name="product[<?php echo $product['id'];?>][quantity]" />
            <?php
            }
            ?>
           
        </div>
        <input name="Submit" type="submit" id="Submit" value="Add To Cart">
    </form>

    <div id="productFooter">
         <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>
            <li><a href="#shipping" role="tab" data-toggle="tab">Shipping</a></li>
            <li><a href="#feedback" role="tab" data-toggle="tab">Feedback</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="description"><?php echo $product['locales']['en_US']['description'];?></div>
            <div class="tab-pane" id="shipping"><?php echo $product['deliveryTime'];?></div>
            <div class="tab-pane" id="feedback">this is feedback</div>
        </div>
    </div>
   
    <?php
    pr($product);
    ?>
</div>