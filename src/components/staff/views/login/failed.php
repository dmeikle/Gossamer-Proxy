<div class="center-block padding-vertical login-message">
    <img class="login-logo" src="/images/logos/logo.png">

    <div class="card">
        <h1><?php echo $this->getString('LOGIN_ERROR_HEADER') ?></h1>

        <p><?php echo $this->getString('LOGIN_ERROR_TEXT') ?></p>

        <div class="messagefooter">
            <div class="pull-right">
                <a href="/admin/login" class="btn btn-primary"><?php echo $this->getString('LOGIN_RETURN') ?></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>