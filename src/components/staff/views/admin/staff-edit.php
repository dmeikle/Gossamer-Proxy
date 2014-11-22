
      <h2 class="form-signin-heading">Add/Edit Staff - NameGoesHere</h2>
       <form class="form-standard" role="form" method="post" >
        <table width="100%">
          <tr>
            <td valign="top">
              <h3> Details</h3>
              <table class="table" style="max-width:700 !important">
                <tr>
                  <td>Firstname:</td>
                  <td><?php echo $form['firstname']; ?></td>
                </tr>
                <tr>
                  <td>Lastname:</td>
                  <td><?php echo $form['lastname']; ?></td>
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
                  <td>Address:</td>
                  <td><?php echo $form['address1']; ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td><?php echo $form['address2']; ?></td>
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
                  <td> </td>
                  <td><?php echo $form['submit']; ?></td>
                </tr>
              </table>
              
                	
              </form>

      