<h3>Edit Customer Info</h3>
<form method="post">
    <table class="table">
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
        <tr>
            <td>

            </td>
            <td>
                <?php echo $form['submit']; ?>
                <?php echo $form['cancel']; ?>

            </td>
        </tr>
    </table>
</form>