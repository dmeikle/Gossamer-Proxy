<form method="post">
    
<div style="width:400px; margin-left: auto; margin-right: auto">
    <h2><?php echo $this->getString('LOGIN_INVITE_FORM');?></h2>
    <form role="form" method="post" action="/portal/contacts/invite/login">
        <div class="form-group">
            <label for="email"><?php echo $this->getString('LOGIN_INVITE_EMAIL');?></label>
            <?php echo $form['email'];?>
        </div>
        <div class="form-group">
            <label for="password"><?php echo $this->getString('LOGIN_PASSWORD');?></label>
            <?php echo $form['password'];?>
        </div>
        <div style="text-align:right">
            <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN');?></button>
        </div>
    </form>
</div>
</form>