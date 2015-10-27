
<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="block">
            <div class="block-heading">
                <div class="main-text h2">
                    <?php echo $this->getString('LOGIN_FORM'); ?>
                </div>
                <div class="block-controls">
                    <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                    <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
                </div>
            </div>
            <div class="block-content-outer">
                <div class="block-content-inner">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="email"><?php echo $this->getString('LOGIN_EMAIL'); ?></label>
                            <?php echo $form['email']; ?>
                        </div>
                        <div class="form-group">
                            <label for="password"><?php echo $this->getString('LOGIN_PASSWORD'); ?></label>
                            <?php echo $form['password']; ?>
                        </div>

                        <button type="submit" class="btn btn-primary"><?php echo $this->getString('LOGIN_SIGNIN'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>