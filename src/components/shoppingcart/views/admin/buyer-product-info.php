<!--- css start --->
@components/shoppingcart/includes/css/view-cart.css
<!--- css end --->
<div style="clear:both"></div>
<?php

$basket = $this->data['basket'];

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo $this->getString('LABEL_CART_CONTENTS');?>: <span class="badge"><?php echo $basket->getCount();?></span></div>
  <div class="panel-body">
<table class="table">
    <tr>
        <td><?php echo $this->getString('LABEL_ITEM');?></td>
        <td><?php echo $this->getString('LABEL_QUANTITY');?></td>
        <td><?php echo $this->getString('LABEL_PRICE');?></td>  
        <td><?php echo $this->getString('LABEL_SUBTOTAL');?></td>         
    </tr>

<?php

if(count($basket) == 0) {
    ?>
    <tr>
        <td align="center" colspan="4">There are no items in your cart</td>  
</tr>
     
    
 <?php   
} else {
    $items = $basket->items();
    foreach($items as $item) {
     
    ?>
        <tr>
            <td><?php echo $item->getTitle($locale);?></td>
            <td><?php echo $item->getQuantity();?></td>
            <td><?php echo $item->getPrice();?></td>  
            <td><?php echo $item->getSubtotal();?></td>            
        </tr>               
<?php
    $variantList = $item->getVariants();
    
    if(!is_null($variantList)) {
        
?>
        <tr>
            <td align="right">Options:</td><td colspan="2">
            <?php
    foreach($variantList as  $key => $variant) {
     $variantItem = current($variant)
         ?>
                <div class="variantOptionSurcharge">+ $<?php echo $variantItem['surcharge'];?></div>
                <div class="variantOptionKey"><?php echo key($variant);?></div>
        
    <?php
       }?>
            </td>
            <td valign="bottom" align="right">$<?php //echo money_format('%i', $item->getVariantSurcharges());?></td>
            <td></td>
        </tr>
        <?php
    }
        if(strlen($item->getCustomText()) > 0) {
 ?>
        <tr>
            <td colspan="3">Options: 
                <?php echo $item->getCustomText();?>
            </td>
            <td></td>
        </tr>
<?php        
        }
    }
}
?>
<tr>
    <td colspan="3" align="right"><?php echo $this->getString('LABEL_SUBTOTAL');?>:</td>
    <td>$<?php echo number_format($basket->getSubtotal(), 2);?></td>

</tr>
<tr>
    <td colspan="3" align="right"><?php echo $this->getString('LABEL_TAX');?>:</td>
    <td>$<?php echo number_format( $purchase['tax1'], 2);?></td>

</tr>
<tr>
    <td colspan="3" align="right"><?php echo $this->getString('LABEL_TOTAL');?>:</td>
    <td>$<?php echo number_format($purchase['total'], 2);?></td>

</tr>
</table> 

      
  </div>
 