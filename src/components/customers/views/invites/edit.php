
<form method="post">
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
            <td><?php echo $form['email']; ?></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><?php echo $form['password']; ?></td>
        </tr>
        <tr>
            <td>Invitation Date:</td>
            <td><?php echo $form['invitationDate']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo $form['submit']; ?> <?php echo $form['cancel']; ?> </td>
        </tr>
    </table>
</form>
