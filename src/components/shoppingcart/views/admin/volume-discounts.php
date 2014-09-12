<!--- css start --->
@components/shoppingcart/includes/css/admin-list.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/volume-discounts.js
<!--- javascript end --->

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_VOLUME_DISCOUNTS');?>
    </div>
  
    <form method="post">
        <table class="table" width="100%">
            <tr>
                <td width="250"><?php echo $this->getString('LABEL_QUANTITY');?></td>
                <td><?php echo $this->getString('LABEL_DISCOUNT_PRICE');?></td>
                <td>
                    <input type="button" id="addRow" value="<?php echo $this->getString('BUTTON_ADD_ROW');?>" />
                </td>                
            </tr>
            <tr>
                <td colspan="3">
                    <table id="fields" width="100%">
                        <?php 
                        $discounts = current($VolumeDiscounts);
                        foreach($discounts as $key => $discount) { ?>
                        <tr>
                            <td width="240"><input type="text" name="volumeDiscount[<?php echo $key; ?>][quantity]" value="<?php echo $discount['quantity'];?>" /></td>
                            <td colspan="2">$<input type="text" name="volumeDiscount[<?php echo $key; ?>][price]"  value="<?php echo $discount['price'];?>" /></td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td colspan="3">
                    <input type="button" class="cancel" value="<?php echo $this->getString('BUTTON_CANCEL');?>" />
                    <input type="submit" class="save" value="<?php echo $this->getString('BUTTON_SAVE');?>" />
                </td>
            </tr>
        </table>
        <input type="hidden" id="numDiscounts" value="<?php echo count($VolumeDiscounts); ?>"/>
    </form>
</div>