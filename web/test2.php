<!-- list -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>|title|</title>
                    <link rel="stylesheet" href="/css/core.min.css">
                        <link href="/css/components/staff/dist/css/staff.min.css" rel="stylesheet">
                            </head>
                            <body>
                                <div id="container">
                                    <!---header--->
                                    <div id="lower">
                                        <div style="max-width:400px; padding-left: auto; padding-right: auto">
                                            <h2>login form</h2>
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
                                        <div id="payload">
                                            <!---payload--->
                                        </div>
                                    </div>
                                    <div id="footer">  <!---section5---> </div>
                                </div>
                            </body>
                            </html>