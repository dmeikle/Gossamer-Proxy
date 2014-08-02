<!--- javascript start --->
@components/shoppingcart/includes/js/admin-purchases.js
@components/shoppingcart/includes/js/jquery.confirm.min.js
<!--- javascript end --->
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_SALES_LIST');?>
    </div>
<table class="table table-striped">
    <tr>
        <td>
            <?php echo $this->getString('LABEL_PURCHASE_ID');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_CUSTOMER_NAME');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_EMAIL');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_PURCHASE_DATE');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_STATUS');?>
        </td>
        <td>
            <?php echo $this->getString('LABEL_ACTION');?>
        </td>
    </tr>
  <?php

foreach($Purchases as $purchase) {
   
    ?>
    <tr>
        <td>
            <?php echo $purchase['id'];?>
        </td> 
        <td>
            <?php echo $purchase['firstname'];?> <?php echo $purchase['lastname'];?>
        </td> 
        <td>
            <?php echo $purchase['email'];?>
        </td>        
        <td>
            <?php echo $purchase['orderDate'];?>
        </td>
        <td>
            <?php echo $purchase['status'];?>
        </td>
        <td>
            <button class="view-sale" type="button" data-id="<?php echo $purchase['id'];?>"><?php echo $this->getString('BUTTON_VIEW');?></button>
            <button class="confirm" type="button" data-id="<?php echo $purchase['id'];?>"><?php echo $this->getString('BUTTON_DELETE');?></button>
        </td>
        
    </tr>
    
<?php
}
?>  
    
</table>
</div>
<form method="post" action="/admin/cart/sales/remove" id="removeItemForm">
    <input type="hidden" id="purchaseId" name="id" />
</form>
