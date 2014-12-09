

<!--- css start --->


<!--- css end --->


<div style="width:400px; margin-left: auto; margin-right: auto">
<h2><?php echo $this->getString('LOGIN_FORM');?></h2>
<form role="form" method="post">
  <div class="form-group">
    <label for="email"><?php echo $this->getString('LOGIN_EMAIL');?></label>
    <input class="form-control" type="email"  id="email" name="email" placeholder="<?php echo $this->getString('LOGIN_EMAIL_PROMPT');?>">
  </div>
  <div class="form-group">
    <label for="password"><?php echo $this->getString('LOGIN_PASSWORD');?></label>
    <input class="form-control" type="password" name="password" id="password" placeholder="<?php echo $this->getString('LOGIN_PASSWORD_PROMPT');?>">
  </div>
    <div style="text-align:right">
  <button type="submit" class="btn btn-default"><?php echo $this->getString('LOGIN_SIGNIN');?></button>
    </div>
</form>

</div>