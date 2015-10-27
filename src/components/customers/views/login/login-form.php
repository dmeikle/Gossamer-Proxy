

<!--- css start --->


<!--- css end --->


<div style="width:400px; margin-left: auto; margin-right: auto">
    <h2><?php echo $this->getString('LOGIN_FORM'); ?></h2>
    <form role="form" method="post">
        <div class="form-group">
            <label for="email"><?php echo $this->getString('LOGIN_USERNAME'); ?></label>
            <?php echo $form['email']; ?>
        </div>
        <div class="form-group">
            <label for="password"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
            <?php echo $form['password']; ?>
        </div>
        <div style="text-align:right">
            <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
        </div>
    </form>
</div>

this is the section for people invited by portal users:<br>
(this might be on a separate login entrance)
<a href="/portal/Customer/invite/login">click here to view login separately</a>

<div style="width:400px; margin-left: auto; margin-right: auto">
    <h2><?php echo $this->getString('LOGIN_INVITE_FORM'); ?></h2>
    <form role="form" method="post" action="/portal/Customer/invite/login">
        <div class="form-group">
            <label for="email"><?php echo $this->getString('LOGIN_INVITE_EMAIL'); ?></label>
            <?php echo $form['email']; ?>
        </div>
        <div class="form-group">
            <label for="password"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
            <?php echo $form['password']; ?>
        </div>
        <div style="text-align:right">
            <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
        </div>
    </form>
</div>