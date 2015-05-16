<form method="post">
    <table class="table">
        <tr>
            <td>Name:</td>
            <td><?php echo $form['name'];?></td>
        </tr>
        <tr>
            <td>Product Code:</td>
            <td><?php echo $form['productCode'];?></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><?php echo $form['description'];?></td>
        </tr>
        <tr>
            <td>Min Quantity:</td>
            <td><?php echo $form['minOrderQuantity'];?>
            * this is to trigger notifications to re-order</td>
        </tr>
        <tr>
            <td>Max Quantity:</td>
            <td><?php echo $form['maxQuantity'];?></td>
        </tr>
        <tr>
            <td>Package Type:</td>
            <td><?php echo $form['PackageTypes_id'];?></td>
        </tr>
        <tr>
            <td>Inventory Type:</td>
            <td><?php echo $form['InventoryTypes_id'];?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo $form['cancel'];?> <?php echo $form['submit'];?></td>
        </tr>
    </table>
</form>
