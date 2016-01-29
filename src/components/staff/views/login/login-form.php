

<!--- css start --->


<!--- css end --->
<!--<div>this is a test</div>
<div permission-key="true">this is a regular div</div>
<div permission-key="water">this should be removed</div>
<div permission-key="accounting">this is the accounting element</div>-->


<div class="center-block padding-vertical login-form">
    <img class="login-logo" src="/images/logos/logo.png">
    <div class="card login-card">
        <h1><?php echo $this->getString('LOGIN_STAFF'); ?></h1>
        <form role="form" method="post">
            <div class="form-group">
                <label for="email"><?php echo $this->getString('LOGIN_EMAIL'); ?></label>
                <?php echo $form['email']; ?>
            </div>
            <div class="form-group">
                <label for="password"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
                <?php echo $form['password']; ?>
            </div>
            <div style="text-align:right">
                <a class="padding" href="/admin/login/reset"><?php echo $this->getString('LOGIN_LOST_PASSWORD'); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
            </div>
        </form>
    </div>

</div>