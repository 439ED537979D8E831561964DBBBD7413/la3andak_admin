<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LA3ANDAK</title>
         <link rel="shortcut icon" href="<?php echo $this->config->item('images_url'); ?>favicon.ico" type="image/x-icon" />
        <?php include APPPATH . '/front-modules/views/common_files.php'; ?>
    </head>
    <body class="nav-md">

        <div class="container body">


            <div class="main_container">
                <?php include APPPATH . '/front-modules/views/side.php'; ?>

                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="margin-right:18px;">
                                        <!-- <img src="<?php echo $this->config->item("upload_url") . 'admin/' . $this->session->userdata("iAdminId") . '/' . $this->config->item("ADMIN_IMAGE") ?>" alt=""><?php echo $this->config->item("ADMIN_NAME") ?> -->
                                       LA3ANDAK <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo $this->config->item("site_url")."profile" ?>">  Profile</a>
                                        </li>
                                         <li><a href="<?php echo $this->config->item("site_url")."deleivery_charges" ?>">Delivery Charge</a>
                                        </li>
                                        <li><a href="<?php echo $this->config->item("site_url")."logout" ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>

                </div>


                <!--        <div class="overlay navneetloader" style="">
                                <div class="loader_wrap">
                                    <img src="<?php echo $this->config->item('images_url'); ?>loader_128.gif" class="fa">
                                </div>
                            </div>-->
                <?php include APPPATH . '/front-modules/views/notification_message.php'; //footer file     ?>

                <div class="right_col" role="main">
