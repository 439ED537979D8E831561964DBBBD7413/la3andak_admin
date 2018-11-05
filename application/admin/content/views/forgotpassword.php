<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo $this->config->item('images_url'); ?>favicon.ico" type="image/x-icon" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>AdminLTE.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>blue.css"/>
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo"> <b>Forgot Password</b> </div>
            <div class="login-box-body">
                <form action="<?php echo $this->config->item('site_url'); ?>content/forgotpassword_action" method="post" id='forgotpassword_form'>
                    <div class="form-group has-feedback"> 
                        <input type="email" class="form-control" name="emailid" id='emailid' placeholder="Email"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <a href="<?php echo $this->config->item('site_url'); ?>login" style="text-decoration: underline">Back</a><br>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>                        
                        </div>
                    </div>
                </form>                
            </div>
        </div>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jQuery-2.1.4.min.js"></script>        
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>     
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/forgotpassword.js"></script>
        <!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->
        <?php include APPPATH . '/front-modules/views/notification_message.php'; //footer file     ?>
    </body>
</html>