<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Grocery Shop</title>

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
    <body style=" background-image:url(<?= base_url() . "public/upload/" . 'bg2.jpg' ?>);background-size: cover;height: 100vh;overflow: hidden;">
        <?php include APPPATH . '/front-modules/views/notification_message.php'; //footer file     ?>

        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div >
                <?php $image_url = $this->config->item("upload_url"); ?>
                <a href="javascript:void(0)">
                    <img src="<?php echo $image_url; ?>/images/logo.png" width="245px;" height="245px;" style="margin-top:15.5%;
                         margin-left: 23%;"></a>
            </div>

            <div id="wrapper" style="margin-top: -20.5%; margin-left: 45%">

                <div id="login" class="animate form">
                    <section class="login_content" style="margin-top:3%;">

                        <form id="login_form" action="<?php echo base_url("content/login_action"); ?>" method="post" >
                            <h1 style="color: white;text-align: left;font-size: 34px;">Login</h1>
                            <div style="margin-top: 5%">
                                <input type="text" class="form-control" value="admin@admin.com" placeholder="Username" name="email" id="email" />
                            </div>
                            <div>
                                <input type="password" value="123456" class="form-control" placeholder="Password" name="password" id="password" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default submit" value="SIGN IN" style="margin-top: -1.5%" />
                                <!-- <a class="reset_pass" href="javascript:void(0);">Forget Password</a> -->
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

                                    <p>©2016 Myst Technologies</p>
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
