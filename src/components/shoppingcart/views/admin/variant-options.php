<!--- javascript start --->
@components/shoppingcart/includes/js/variant-options-list.js
<!--- javascript end --->
<h3>Variant Options</h3>
<button data-id="0" type="button" class="variant-option-edit">Create New Option</button>
<table class="table table-striped">
    <tr>
        <th>Option</th>
        <th>Code</th>
        <th>Surcharge</th>
        <th>Action</th>
    </tr>
    <?php
    foreach ($VariantOptions as $option) {
        if (count($option) == 0) {
            continue;
        }
        ?>
        <tr>
            <td><?php echo $option['variant']; ?></td>
            <td><?php echo $option['code']; ?></td>
            <td><?php echo $option['surcharge']; ?></td>
            <td>
                <button data-id="<?php echo $option['id']; ?>" type="button" class="variant-option-edit"><?php echo $this->getString('BUTTON_EDIT'); ?></button>
                <button data-id="<?php echo $option['id']; ?>" type="button" class="variant-option-delete"><?php echo $this->getString('BUTTON_DELETE'); ?></button>
            </td>
        </tr>
        <?php
    }
    ?>
</table>