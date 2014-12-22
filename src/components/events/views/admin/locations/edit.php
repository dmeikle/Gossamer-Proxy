
<h2>
    Add/Edit Event Location
</h2>
<form method="post">
    <table class="table">
        <tr>
          <td>Name:</td>
          <td><?php echo $form['name']; ?></td>
        </tr>
        <tr>
          <td>Room:</td>
          <td><?php echo $form['room']; ?></td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><?php echo $form['address']; ?></td>
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
          <td>Map URL:</td>
          <td><?php echo $form['mapUrl']; ?>
          might not need this with the geocoder library - could be auto lookup
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <?php echo $form['save']; ?>
          <?php echo $form['cancel']; ?>
          </td>
        </tr>
      </table>
</form>