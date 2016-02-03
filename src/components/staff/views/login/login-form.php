<div class="center-block padding-vertical login-form">
    <img class="login-logo" src="/images/logos/logo.png">
    <div class="card login-card">
        <h1><?php echo $this->getString('LOGIN_STAFF'); ?></h1>
        <form action role="form" method="post">
            <div class="form-group">
                <label for="email"><?php echo $this->getString('LOGIN_USERNAME'); ?></label>
                <input type="text" name="username" class="form-control" id="Staff_username">
            </div>
            <div class="form-group">
                <label for="password"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
                <input type="password" name="password" class="form-control" id="Staff_password">
            </div>
            <div style="text-align:right">
                <a class="padding" href="/admin/login/reset"><?php echo $this->getString('LOGIN_LOST_PASSWORD'); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
            </div>
        </form>
    </div>
</div>