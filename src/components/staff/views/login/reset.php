


<div style="max-width:400px; padding-left: auto; padding-right: auto">
<h2><?php echo $this->getString('LOGIN_RESET_FORM');?></h2>
<form role="form" method="post">
  <div class="form-group">
    <label for="email"><?php echo $this->getString('LOGIN_ENTER_USERNAME');?></label>
    <?php echo $form['username'];?>
  </div>
    <div style="text-align:right">
        <a href="/admin/login"><?php echo $this->getString('LOGIN_CANCEL');?></a> 
  <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SUBMIT');?></button>
    </div>
</form>

</div>