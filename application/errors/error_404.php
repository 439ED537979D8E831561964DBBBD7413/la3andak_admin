<?php
include APPPATH . '/config/config.php';
//include 'system/libraries/Session.php';

$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
$base_url .= '://' . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$site_url = str_replace('admin/', '', $base_url);
?>
<!DOCTYPE html>
<html>
    <head>
<!--        <title><?php // echo $config['SITE_TITLE'];           ?></title>-->
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400" rel="stylesheet" />        
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="shortcut icon" href="<?php echo $config['images_url']; ?>favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo $config['css_url']; ?>font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo $config['css_url']; ?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $config['css_url']; ?>AdminLTE.min.css"/>        
    </head>
    <body>
        <div>
            <div class="container-fluid white_bg">
                <!--<div class="logo"> <a href="<?php echo $config['site_url']; ?>" title="M.Zahid"><img src="<?php echo $config['images_url']; ?>logo.png" alt="" /></a> </div>-->
            </div>
            <div class="container-fluid">    	
                <section class="content">
                    <div class="error-page">
                        <h2 class="headline text-yellow"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                            <p>
                                We could not find the page you were looking for.
                                Meanwhile, you may <a href="<?php
                                if ($config['is_admin'] == 0) {
                                    echo $base_url . 'dashboard';
                                } else {
                                    echo $base_url . 'dash';
                                }
                                ?>"class="link_home">Home Page</a> or go back to <a href="javascript:history.go(-1);" class="link_home">Back to the Page</a> 
                            </p>
                            <!--                            <form class="search-form">
                                                            <div class="input-group">
                                                                <input type="text" name="search" class="form-control" placeholder="Search">
                                                                <div class="input-group-btn">
                                                                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                                                                </div>
                                                            </div> /.input-group 
                                                        </form>-->
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->
                </section>
            </div>       
        </div>
    </body>
</html>