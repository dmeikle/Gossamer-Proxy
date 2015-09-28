
<!--- javascript start --->
@components/events/includes/js/jquery.ptTimeSelect.js

<!--- javascript end --->

<!--- css start --->
@components/events/includes/css/jquery.ptTimeSelect.css

<!--- css end --->



<h2>Add/Edit Event</h2>

<form method="post">
    <table>       
        <tr>
          <td>Name:</td>
          <td><?php echo $form['name']; ?></td>
        </tr>
        <tr>
          <td>Telephone:</td>
          <td><?php echo $form['telephone']; ?></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><?php echo $form['email']; ?></td>
        </tr>
        <tr>
          <td>Company:</td>
          <td><?php echo $form['company']; ?></td>
        </tr>
        <tr>
          <td>Active:</td>
          <td><?php echo $form['isActive']; ?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <?php echo $form['cancel']; ?> 
          <?php echo $form['save']; ?>
          </td>
        </tr>
      </table>
</form>