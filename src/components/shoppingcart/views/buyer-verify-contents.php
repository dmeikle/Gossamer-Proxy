<!--- css start --->
@components/shoppingcart/includes/css/view-cart.css
<!--- css end --->

<!--- javascript start --->
@components/shoppingcart/includes/js/basket.js
@components/shoppingcart/includes/js/jquery.confirm.min.js
<!--- javascript end --->

<?php
$basket = $this->data['Basket'];
?>
<div class="panel panel-default">
    <div class="panel-heading">Shopping Cart Contents: <span class="badge"><?php echo $basket->getCount(); ?></span></div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <td align="center">Item</td>
                <td align="center">Quantity</td>
                <td align="right">Price</td>
                <td align="right">SubTotal</td>
            </tr>

            <?php
            $items = $basket->items();

            if (count($items) == 0) {
                ?>
                <tr>
                    <td align="center" colspan="4">There are no items in your cart</td>
                </tr>


                <?php
            } else {
                foreach ($items as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item->getTitle($locale); ?></td>
                        <td align="center"><?php echo $item->getQuantity(); ?></td>
                        <td align="right">$<?php echo $item->getPrice(); ?></td>
                        <td align="right">$<?php echo $item->getSubtotal(); ?></td>
                    </tr>
                    <?php
                    $variantList = $item->getVariants();
                    if (!is_null($variantList)) {
                        ?>
                        <tr>
                            <td align="right">Options:</td><td colspan="2">
                                <?php
                                foreach ($variantList as $variant) {

                                    $variantItem = current($variant);
                                    ?>

                                    <div class="variantOptionSurcharge">+ $<?php echo $variantItem['surcharge']; ?></div>
                                    <div class="variantOptionKey"><?php echo key($variant); ?></div>

                                <?php }
                                ?>
                            </td>
                            <td valign="bottom" align="right">$<?php echo money_format('%i', $item->getVariantSurcharges()); ?></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    if (strlen($item->getCustomText()) > 0) {
                        ?>
                        <tr>
                            <td colspan="3">Options:
                                <?php echo $item->getCustomText(); ?>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            <tr>
                <td colspan="3" align="right">Subtotal:</td>
                <td align="right">$<?php echo number_format($basket->getSubtotal(), 2); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="right">Tax:</td>
                <td align="right">$<?php echo number_format($tax, 2); ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="right">Total:</td>
                <td align="right">$<?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        </table>
    </div>
