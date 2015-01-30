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
            <?php echo $this->getString('LABEL_SUBTOTAL');?>
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
            <?php echo $purchase['Purchases_id'];?>
        </td> 
        <td>
            <?php echo $purchase['firstname'];?> <?php echo $purchase['lastname'];?>
        </td> 
        <td>
            $<?php echo number_format($purchase['subtotal'], 2);?>
        </td>        
        <td>
            <?php echo $purchase['orderDate'];?>
        </td>
        <td>
            <?php echo $purchase['status'];?>
        </td>
        <td>
            <button class="view-sale" type="button" data-id="<?php echo $purchase['Purchases_id'];?>"><?php echo $this->getString('BUTTON_VIEW');?></button>
            <button class="confirm" type="button" data-id="<?php echo $purchase['Purchases_id'];?>"><?php echo $this->getString('BUTTON_DELETE');?></button>
        </td>
        
    </tr>
    
<?php
}
?>      
</table>
</div>

<div>
    <select class="pagination" id="resultsPerPage">
    <option>10</option>
    <option>25</option>
    <option>50</option>
    <option>100</option>    
</select>
<ul class="pagination">
    <?php $firstPagination = current($pagination);?>
    <?php $lastPagination = end($pagination);?>
  <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/cart/sales" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
  <?php foreach($pagination as $index => $page) { ?>
  <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/cart/sales" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
  <?php } ?>
  <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/cart/sales" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
</ul>

</div>
<form method="post" action="/admin/cart/sales/remove" id="removeItemForm">
    <input type="hidden" id="purchaseId" name="id" />
</form>
