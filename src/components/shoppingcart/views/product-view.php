
<!--- javascript start --->
@components/shoppingcart/includes/js/bootstrap-wysiwyg.js
@components/shoppingcart/includes/js/jquery.hotkeys.js
<!--- javascript end --->

<!--- css start --->

@components/shoppingcart/includes/css/product-view.css

<!--- css end --->

<?php
$product = current($Product);

$locale = $this->getDefaultLocale();
?>
<div id="product">
   
    <img src="/images/cart/<?php echo $product['picture'];?>" />
    <form method="post" class="form-horizontal" role="form" id="stats" action="/cart/view">
         <h3><?php echo $product['locales'][$locale['locale']]['title'];?></h3>
        <div id="briefDescription"><?php echo $product['locales'][$locale['locale']]['briefDescription'];?></div>
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
                echo "<select class=\"form-control\" name=\"product[" . $product['id'] . "][quantity]\">";
                for($i = $product['minOrderQuantity']; $i < ($product['minOrderQuantity'] * 100); $i++) {
                    echo "<option>$i</option>\r\n";
                }
                echo "</select>";
            }elseif(($product['numPerBox']) > 1) {
                echo "<select class=\"form-control\" name=\"product[" . $product['id'] . "][quantity]\">";
                for($i = $product['numPerBox']; $i < ($product['numPerBox'] * 100); $i += $product['numPerBox']) {
                    echo "<option>$i</option>\r\n";
                }
                echo "</select>";
            }else{
            ?>
                <input type="input" name="product[<?php echo $product['id'];?>][quantity]" />
            <?php
            }?>
        </div>
        
            <?php
            if(is_array($ProductVariantList)) {
                foreach($ProductVariantList as $key => $variant) {?>
                <div><?php echo $key;?>
                <select class="form-control" name="product[variants][<?php echo $key;?>]">
                    <?php foreach($variant as $itemKey => $item) {?>
                    <option value='<?php echo $itemKey;?>'><?php echo $item['variant'];?><?php echo ((0 < $item['surcharge'])? ' + $' . $item['surcharge'] : '');?></option>
                    <?php                    
                    }?>
                </select>
                </div>
                    
               <?php }
            }
            ?>
           
        <input name="Submit" type="submit" id="Submit" value="<?php echo $this->getString('BTN_ADD_TO_CART'); ?>">
    </form>
    <?php
   
    if(array_key_exists('VolumeDiscount', $product) && count($product['VolumeDiscount']) > 0) { ?>
    <div class="panel">
    <div class="panel-heading">
        <?php echo $this->getString('VOLUME_DISCOUNTS');?>
    </div>
    <table class="table-striped table-bordered" width="250">
        
        <tr>
            <td>Quantity</td>
            <td>Price</td>
        </tr>
        <?php
        foreach($product['VolumeDiscount'] as $discount) {
            echo '<tr><td>' . $discount['quantity'] . '</td><td>' . $discount['price'] .'</td></tr>';
        }
        ?>
    </table>
    </div>
   <?php  } ?>
    

    <div id="productFooter">
         <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>
            <li><a href="#shipping" role="tab" data-toggle="tab">Shipping</a></li>
            <li><a href="#feedback" role="tab" data-toggle="tab">Feedback</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="description"><?php echo $product['locales'][$locale['locale']]['description'];?></div>
            <div class="tab-pane" id="shipping"><?php echo $product['deliveryTime'];?></div>
            <div class="tab-pane" id="feedback">this is feedback</div>
        </div>
    </div>
   
    <?php
    pr($product);
    ?>
</div>