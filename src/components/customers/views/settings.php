
<div class="panel panel-default">
    <div class="panel-heading">
        Profile Information<br/>
        Edit Profile Details
    </div>
    <table class="table">
        <tr>
            <td>
                Customer Information<br />
                <a href="/portal/Customer/edit">Update your contact information</a><br/>
                Choose how Phoenix notifies you
                <br />
                Notification settings</td>
            <td>
                Email: <?php echo $form['email']; ?>
                <br />
                Home: <?php echo $form['home']; ?><br />
                Mobile: <?php echo $form['mobile']; ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Sign-In and Security
    </div>
    <table class="table">
        <tr>
            <td>

                <a href="/portal/Customer/credentials">Change your password</a><br />
                Update password reset info<br /></td>
            <td>

            </td>
        </tr>

    </table>
</div>