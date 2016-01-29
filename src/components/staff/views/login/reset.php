

<div class="center-block padding-vertical login-form">
    <img class="login-logo" src="/images/logos/logo.png">
    <div class="card login-card">
        <h1><?php echo $this->getString('LOGIN_RESET_FORM'); ?></h1>
        <form role="form" method="post">
            <div class="form-group">
                <label for="email"><?php echo $this->getString('LOGIN_ENTER_USERNAME'); ?></label>
                <?php echo $form['username']; ?>
            </div>
            <div style="text-align:right">
                <a href="/admin/login" class="padding"><?php echo $this->getString('LOGIN_CANCEL'); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SUBMIT'); ?></button>
            </div>
        </form>
    </div>
</div>