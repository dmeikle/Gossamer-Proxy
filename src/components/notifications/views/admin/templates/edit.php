
<form method="post">
    <table class="table">
      <tr>
        <td>Type:</td>
        <td><?php echo $form['MessagingTypes_id'];?></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><?php echo $form['name'];?></td>
      </tr>
      <tr>
        <td>Description:</td>
        <td><?php echo $form['description'];?></td>
      </tr>
      <tr>
        <td>Template:</td>
        <td><?php echo $form['template'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><?php echo $form['cancel'];?> <?php echo $form['save'];?></td>
      </tr>
    </table>
</form>