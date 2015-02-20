

<table class="table">
  <tr>
    <th scope="col">Name</th>
    <th scope="col">Telephone</th>
    <th scope="col">Mobile</th>
    <th scope="col">Work Telephone</th>
    <th scope="col">Email</th>
    <th scope="col">Relation</th>
    <th scope="col">Action</th>
  </tr>

<?php

foreach($EmergencyContacts as $contact) {
    if(count($contact) == 0) {
        continue;
    }
    ?>
  <tr>
    <td><?php echo $contact['lastname'] . ', ' . $contact['firstname'];?></td>
    <td><?php echo $contact['telephone'];?></td>
    <td><?php echo $contact['mobile'];?></td>
    <td><?php echo $contact['workTelephone'];?></td>
    <td><?php echo $contact['email'];?></td>
    <td><?php echo $contact['relation'];?></td>
    <td>buttons go here</td>
  </tr>

<?php }?>
</table>

<form method="post">
    <table class="table">
  <tr>
    <td>Firstname:</td>
    <td><?php echo $form['firstname'];?></td>
  </tr>
  <tr>
    <td>Lastname:</td>
    <td><?php echo $form['lastname'];?></td>
  </tr>
  <tr>
    <td>Work Telephone:</td>
    <td><?php echo $form['workTelephone'];?></td>
  </tr>
  <tr>
    <td>Home Telephone:</td>
    <td><?php echo $form['telephone'];?></td>
  </tr>
  <tr>
    <td>Mobile:</td>
    <td><?php echo $form['mobile'];?></td>
  </tr>
  <tr>
    <td>Email:</td>
    <td><?php echo $form['email'];?></td>
  </tr>
  <tr>
    <td>Relation:</td>
    <td><?php echo $form['relation'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo $form['submit'];?> <?php echo $form['cancel'];?></td>
  </tr>
</table>

</form>
