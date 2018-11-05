<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Live Mandi </title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>animate.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>custom.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>green.css"/>


        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>

    </head>
    <body style="background:#F7F7F7;">
        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="POST" name="resetpass" id="resetpass" action="<?php echo $this->config->item("site_url") . 'content/reset_password_action' ?>"  role="form">      
                        <h1>Reset Password</h1>
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                        <input type="hidden" id="type" name="type" value="<?php echo $type; ?>"/>
                        <div>
                           <div class="alert alert-success" role="alert">Password Changed successfully</div>                    
                        </div>
                        <div class="clearfix"></div>


                    </form>
                </section>
            </div>	

        </div>

    </body>
</html>
