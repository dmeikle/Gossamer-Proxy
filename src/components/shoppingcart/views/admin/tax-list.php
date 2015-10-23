
<form method="post" class="form-horizontal" role="form">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>State</th><th>Tax Amount</th>
            </tr>
        </thead>

        <?php
        $stateList = $stateList;

        foreach ($stateList as $key => $state) {
            ?>
            <tr>
                <td><?php echo $state; ?></td><td><input type="text" name="taxes[<?php echo $key; ?>]" value="<?php echo ((array_key_exists($key, $TaxRates)) ? $TaxRates[$key] : ''); ?>"/></td>
                <?php
            }
            ?>
        <tr>
            <td>

            </td>
            <td>
                <input name="Submit" type="submit" id="Submit" value="Submit">
            </td>
        </tr>
    </table>
</form>