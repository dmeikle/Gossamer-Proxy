<h3>Credentials</h3>
<form method="post" role="form" id="credentials-form" action="/admin/staff/ajaxcredentials/">
    <table class="table" style="max-width: 700 !important">
        <tr>
            <td>Username:</td>
            <td><?php echo $form['username']; ?></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><?php echo $form['password']; ?></td>
        </tr>
        <tr>
            <td>Confirm:</td>
            <td><?php echo $form['passwordConfirm']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo $form['cancel']; ?> <?php echo $form['submit']; ?></td>
        </tr>
    </table>
</form>