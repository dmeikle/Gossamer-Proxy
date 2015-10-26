
<form method="post" id="building-form">
    <?php echo $form['projectAddressId']; ?>
    <table class="table table-responsive">
        <tr>
            <td><span class="fa fa-building"></span></td>
            <td colspan="2"><h3>Add/Edit Building</h3></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><span  class="fa fa-bookmark">vip</span> <span class="fa fa-paperclip"></span> <span class="fa fa-history">history</span></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Name:</td>
            <td colspan="3"><?php echo $form['buildingName']; ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td colspan="3"><?php echo $form['address1']; ?></td>
        </tr>
        <tr>
            <td>City:</td>
            <td><?php echo $form['city']; ?></td>
            <td>PostalCode:</td>
            <td><?php echo $form['postalCode']; ?></td>
        </tr>
        <tr>
            <td>Neighborhood:</td>
            <td colspan="3"><?php echo $form['neighborhood']; ?></td>
        </tr>
        <tr>
            <td>Year:</td>
            <td><?php echo $form['buildingYear']; ?></td>
            <td>Units:</td>
            <td><?php echo $form['numUnits']; ?></td>
        </tr>
        <tr>
            <td>Strata:</td>
            <td><?php echo $form['strata']; ?></td>
            <td>Floors:</td>
            <td><?php echo $form['numFloors']; ?></td>
        </tr>
        <tr>
            <td>Management:</td>
            <td colspan="3"><?php echo $form['management']; ?></td>
        </tr>
        <tr>
            <td><span class="fa fa-phone">Telephone:</span></td>
            <td><?php echo $form['telephone']; ?></td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
            <td colspan="2">Preferred Trades:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Special Instructions:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Previous Claims:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3"><?php echo $form['cancel']; ?> <?php echo $form['save']; ?></td>
        </tr>
    </table>
</form>