

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
            <td><?php echo $item->getSubtotal();?></td>            
        </tr>               
<?php
        if(strlen($item->getCustomText()) > 0) {
 ?>
        <tr>
            <td colspan="2">Options: 
                <?php echo $item->getCustomText();?>
            </td>
            <td>
                
            </td>
            <td></td>
        </tr>
<?php        
        }
    }
}
?>
<tr>
    <td colspan="2" align="right"><?php echo $this->getString('LABEL_SUBTOTAL');?>:</td>
    <td>$<?php echo number_format($basket->getSubtotal(), 2);?></td>
    <td></td>
</tr>
</table> 

      
  </div>
 