<!--- javascript start --->
@components/shoppingcart/includes/js/variant-groups.js
@components/shoppingcart/includes/js/dragdrop.js
<!--- javascript end --->
<table class="table">
     <?php

            foreach($CartProductVariants as $variant) {
             ?>
    <tr class="striped-row">
        <td>
            <a href="/admin/cart/variant/<?php echo $variant['VariantGroups_id'];?>" ><?php echo $variant['groupName']; ?></a>
        </td>
         <td>
            <button class="view-variantGroup" type="button" data-id="<?php echo $variant['VariantGroups_id'];?>"><?php echo $this->getString('BUTTON_VIEW');?></button>
            <button class="confirm" type="button" data-id="<?php echo $variant['VariantGroups_id'];?>"><?php echo $this->getString('BUTTON_DELETE');?></button>
        </td>
    </tr>
 <?php  }
          ?>
</table>