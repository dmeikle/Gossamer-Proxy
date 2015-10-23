
<h3>Add/Edit Project Address</h3>
<form method="post" role="form">
    <table class="table">
        <tr>
            <td>Building Name:</th>
            <td><?php echo $form['buildingName']; ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $form['address1']; ?><br />
                <?php echo $form['address2']; ?></td>
        </tr>
        <tr>
            <td>City:</td>
            <td><?php echo $form['city']; ?></td>
        </tr>
        <tr>
            <td>Province:</td>
            <td><?php echo $form['Provinces_id']; ?></td>
        </tr>
        <tr>
            <td>Postal Code:</td>
            <td><?php echo $form['postalCode']; ?></td>
        </tr>
        <tr>
            <td>Building Year:</td>
            <td><?php echo $form['buildingAge']; ?></td>
        </tr>
        <tr>
            <td>Notes:</td>
            <td><?php echo $form['notes']; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $form['submit']; ?></td>
        </tr>
    </table>
</form>