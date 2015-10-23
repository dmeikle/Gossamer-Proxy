


<div style="max-width:400px; padding-left: auto; padding-right: auto">
    <h2><?php echo $this->getString('LOGIN_RESET_FORM'); ?></h2>
    <form role="form" method="post">
        <div class="form-group">
            <label for="email"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
            <?php echo $form['password']; ?>
            <label for="email"><?php echo $this->getString('LOGIN_PASSWORD_CONFIRM'); ?></label>
            <?php echo $form['passwordConfirm']; ?>
        </div>
        <div style="text-align:right">
            <a href="/admin/login"><?php echo $this->getString('LOGIN_CANCEL'); ?></a>
            <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SUBMIT'); ?></button>
        </div>
    </form>

</div>