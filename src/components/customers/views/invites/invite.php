
<h3>Invite Someone - need text here</h3>
<table class="table">
    <tr>
        <td>Firstname:</td>
        <td><?php echo $form['firstname']; ?></td>
    </tr>
    <tr>
        <td>Lastname:</td>
        <td><?php echo $form['lastname']; ?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><?php echo $form['username']; ?></td>
    </tr>
    <tr>
        <td>Password:</td>
        <td><?php echo $form['password']; ?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><?php echo $form['submit']; ?> <?php echo $form['cancel']; ?></td>
    </tr>
</table>
this page needs to check first that the email does not exist as a contact and if it does offer to send a contact request to that user instead