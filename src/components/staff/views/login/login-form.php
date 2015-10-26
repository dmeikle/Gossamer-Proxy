

<!--- css start --->


<!--- css end --->



<div style="max-width:400px; padding-left: auto; padding-right: auto">
    <h2><?php echo $this->getString('LOGIN_FORM'); ?></h2>
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
            <a href="/admin/login/reset"><?php echo $this->getString('LOGIN_LOST_PASSWORD'); ?></a>
            <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
        </div>
    </form>

</div>