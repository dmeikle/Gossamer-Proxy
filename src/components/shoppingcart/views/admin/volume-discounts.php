<!--- css start --->
@components/shoppingcart/includes/css/admin-list.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/volume-discounts.js
<!--- javascript end --->

<button data-id="0" type="button" class="edit"><?php echo $this->getString('BUTTON_CREATE_NEW');?></button>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->getString('LABEL_VOLUME_DISCOUNTS');?>
    </div>
    <form method="post">
        <table class="table">
            <tr>
                <td><?php echo $this->getString('LABEL_QUANTITY');?></td>
                <td><?php echo $this->getString('LABEL_DISCOUNT_PRICE');?>
                <input type="button" id="addRow" value="<?php echo $this->getString('BUTTON_ADD_ROW');?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table id="fields" width="100%">
                        <tr>
                            <td><input type="text" name="volumeDiscount[1][quantity]" /></td>
                            <td><input type="text" name="volumeDiscount[1][price]" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" class="cancel" value="<?php echo $this->getString('BUTTON_CANCEL');?>" />
                    <input type="submit" class="save" value="<?php echo $this->getString('BUTTON_SAVE');?>" />
                </td>
            </tr>
        </table>
        <input type="hidden" id="numDiscounts" value="1"/>
    </form>
</div>