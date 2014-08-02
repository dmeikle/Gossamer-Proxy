<!--- css start --->
@components/shoppingcart/includes/css/products-list.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/basket.js
@components/shoppingcart/includes/js/jquery.confirm.min.js
<!--- javascript end --->

<?php
$basket = $this->data['Basket'];
?>
<div class="panel panel-default">
    <div class="panel-heading">Shopping Cart Contents: <span class="badge"><?php echo $basket->getCount();?></span></div>
  <div class="panel-body">
<table class="table">
    <tr>
        <td>Item</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Action</td>         
    </tr>

<?php
$items = $basket->items();
if(count($items) == 0) {
    ?>
    <tr>
        <td align="center" colspan="4">There are no items in your cart</td>  
</tr>
    
    
 <?php   
} else {
    foreach($items as $item) {
    ?>
        <tr>
            <td><?php echo $item->getTitle($locale);?></td>
            <td><?php echo $item->getQuantity();?></td>
            <td><?php echo $item->getSubtotal();?></td>
            <td><button class="confirm" type="button" data-key="<?php echo $item->getKey();?>">remove</button></td>  
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
    <td colspan="2" align="right">Subtotal:</td>
    <td>$<?php echo number_format($basket->getSubtotal(), 2);?></td>
    <td></td>
</tr>
</table>
      <a href="/cart/" >&lt;&lt; Continue Shopping</a> 
      <a href="/cart/checkout" >Continue To Checkout &gt;&gt;</a>
  </div>
  <form method="post" action="/cart/remove" id="removeItemForm">
      <input type="hidden" id="productKey" name="product[key]" />
  </form>