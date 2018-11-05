<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Offer </title>

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
<?php include APPPATH . '/front-modules/views/notification_message.php'; //footer file     ?>

        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <form id="login_form" action="<?php echo $this->config->item("site_url")."content/login_action"; ?>" method="post" >
                            <h1>Coming Soon</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="email" id="email" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default submit" value="Log In" />
                                <a class="reset_pass" href="javascript:void(0);">Lost your password?</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

<!--                                <p class="change_link">New to site?
                                    <a href="#toregister" class="to_register"> Create Account </a>
                                </p>
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                    <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                                </div>-->
                            </div>
                        </form>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>
            
            </div>
        </div>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/login.js"></script>

    </body>
</html>
 