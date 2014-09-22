<!--- javascript start --->
@components/shoppingcart/includes/js/variant-groups.js
@components/shoppingcart/includes/js/dragdrop.js
<!--- javascript end --->
<table class="table">
     <?php

            foreach($ProductVariants as $variant) {
             ?>
    <tr class="striped-row">
        <td>
            <a href="/admin/cart/variants/<?php echo $variant['VariantGroups_id'];?>" ><?php echo $variant['groupName']; ?></a>
        </td>
    </tr>
 <?php  }
          ?>
</table>