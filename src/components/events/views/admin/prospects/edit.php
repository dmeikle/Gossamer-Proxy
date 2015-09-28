

<h3>Edit Prospect</h3>
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
            <td>Home:</td>
            <td><?php echo $form['home']; ?></td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td><?php echo $form['mobile']; ?></td>
        </tr>
        <tr>
            <td>Office:</td>
            <td><?php echo $form['office']; ?></td>
        </tr>
        <tr>
            <td>Extension:</td>
            <td><?php echo $form['extension']; ?></td>
        </tr>
        <tr>
            <td>Company:</td>
            <td><?php echo $form['company']; ?></td>
        </tr>
        <tr>
            <td>Comments:</td>
            <td><?php echo $form['prospectNotes']; ?></td>
        </tr>
        <tr>
            <td>Responded By:</td>
            <td>staff name</td>
        </tr>
        <tr>
            <td>Response Date:</td>
            <td><?php echo $form['respondedToDate']; ?></td>
        </tr>
        <tr>
            <td>Event:</td>
            <td>event</td>
        </tr>
        <tr>
            <td>Staff Notes:</td>
            <td><?php echo $form['staffNotes']; ?></td>
        </tr>
        <tr>
            <td>Merged:</td>
            <td><?php echo $form['merged']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo $form['save']; ?> <?php echo $form['cancel']; ?></td>
        </tr>
    </table>
</form>