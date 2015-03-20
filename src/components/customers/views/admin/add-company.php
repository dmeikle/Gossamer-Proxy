
<form method="post">
    <table class="table">
        <tr valign="top">
          <td>Customer Type:</td>
                  <td><select name="Customer[contactType]" id="contact-type" class="form-control">
                          <?php echo $CustomerTypes; ?>
              </select></td>
        </tr>
        <tr valign="top" id="companyRow">
          <td>Company:</td>
          <td><input type="text" name="Customer[Companies_id]" id="company"  class="form-control"/></td>
        </tr>
        <tr valign="top">
          <td>Firstname:</td>
          <td><?php echo $form['firstname']; ?></td>
        </tr>

        <tr valign="top">
          <td>Lastname:</td>
          <td><?php echo $form['lastname']; ?></td>
        </tr>
        <tr valign="top">
          <td>Email:</td>
          <td><?php echo $form['email']; ?></td>
        </tr>
        <tr valign="top">
          <td>Mobile:</td>
          <td><?php echo $form['mobile']; ?></td>
        </tr>
        <tr valign="top">
          <td>Home:</td>
          <td><?php echo $form['home']; ?></td>
        </tr>
        <tr valign="top">
          <td>Office:</td>
          <td><?php echo $form['office']; ?></td>
        </tr>
        <tr valign="top">
          <td>Extension:</td>
          <td><?php echo $form['extension']; ?></td>
        </tr>
        <tr valign="top">
          <td>Notes:</td>
          <td><label for="select"></label>
          <?php echo $form['notes']; ?></td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                 <?php echo $form['submit']; ?>
                 <?php echo $form['cancel']; ?>
                
            </td>
        </tr>
      </table>
    
   