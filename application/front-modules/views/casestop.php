<!doctype html>
<html lang="en">
    <head>
        <title><?php echo $this->config->item('SITE_TITLE'); ?></title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="<?php echo ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https' : 'http'; ?>://fonts.googleapis.com/css?family=Roboto:500,400italic,700italic,700,500italic,400" rel="stylesheet" />-->
        <title><?php echo $this->config->item('SITE_TITLE'); ?></title>
        <link href='http://fonts.googleapis.com/css?family=Roboto:500,400italic,700italic,700,500italic,400' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo $this->config->item('images_url'); ?>favicon.ico" type="image/x-icon" />
        <link href="<?php echo $this->config->item('css_url'); ?>font-awesome.min.css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>bootstrap-theme.min.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>responsive.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>tabs.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>font_editor.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>popup.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('bootstrap_url'); ?>bootstrap-datepicker/assets/lib/css/bootstrap-datepicker.css"/>
        <link href="<?php echo $this->config->item('css_url'); ?>cases.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('bootstrap_url'); ?>select2/assets/lib/css/select2.css"/>
        <link href="<?php echo $this->config->item('css_url'); ?>dev_style.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo $this->config->item('css_url'); ?>uploadfile.css" rel="stylesheet">

        <!-- popup css -->
        <script>
	    var site_url = "<?php echo $this->config->item('site_url'); ?>";
	    var parent_url = (parseInt('<?php echo $this->session->userdata('iParentId'); ?>') > 0) ? true : false;
	    var currentTimezone = "<?php echo $this->config->item('LBU_USER_TIME_ZONE'); ?>";
	    var companyid = "<?php echo $this->config->item('CRM_USER_COMPANY_ID'); ?>";
	    var rootPath = "<?php echo $this->config->item('site_url'); ?>";
	    var commonPath = '<?php echo $this->config->item('js_url'); ?>';
	    var componentsPath = '<?php echo $this->config->item('js_url'); ?>';
	    var fb_appid = '<?php echo $this->config->item('fb_appid'); ?>';
	    var curdatetime = '<?php echo $this->general->getCurrentDateTime(); ?>';
	    var curdate = '<?php echo $this->general->getCurrentDateTime('Y-m-d'); ?>';
	    var curdatetime_ms = '<?php echo strtotime($this->general->getCurrentDateTime('Y-m-d H:i')) * 1000; ?>';
	    var curdate_ms = '<?php echo strtotime($this->general->getCurrentDateTime('Y-m-d')) * 1000; ?>';
	    var prevdate_ms = '<?php echo strtotime($this->general->getDate(date('Y-m-d', strtotime("-1 days")))) * 1000; ?>';
	    var timeout = '<?php echo $this->config->item('SESSION_TIMEOUT'); ?>';
	    var ownname = '<?php echo trim($this->config->item('CRM_USER_NAME')); ?>';
	    var userid = '<?php echo $this->session->userdata('iUserId') ?>';
	    var profimage = '<?php echo $this->session->userdata('vProfileImage') ?>';
	    var profimagepath = rootPath + '/public/upload/users/' + companyid + '/' + userid + '/' + profimage;
	    var fullimagepath = rootPath + '/public/upload/users/' + companyid + '/' + userid + '/';
        </script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.sticky.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.SimpleCropper.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('bootstrap_url'); ?>select2/assets/lib/js/select2.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('bootstrap_url'); ?>bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('bootstrap_url'); ?>bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js"></script>
        <!-- upload file js -->        
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/jquery.uploadfile.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/cases.js"></script>
    </head>

    <body>
        <div class="container-fluid white_bg">
            <?php
            $logo_url = $this->config->item('images_url') . 'logo.png';

            if ($this->config->item('CRM_USER_COMPANY_LOGO') != '') {

                $img = 'companies/' . $this->config->item('CRM_USER_COMPANY_ID') . '/' . $this->config->item('CRM_USER_COMPANY_LOGO');
                $img_path = $this->config->item('upload_path') . $img;

                if (file_exists($img_path)) {
                    $logo_url = $this->config->item('upload_url') . $img;
                }
            }
            ?>
            <div class="logo"> <a href="javascript:voide(0)" title="<?php echo $this->config->item('CRM_USER_COMPANY_NAME'); ?>"><img src="<?php echo $logo_url; ?>" alt="" /></a> </div>
<!--            <div class="logo"> <a href="#" title="M.Zahid"><img src="<?php echo $this->config->item('images_url'); ?>logo.png" alt="" /></a> </div>-->
            <div class="logo_right text-right">
                <div class="col-md-12 text-right note_padding pad_none" style="display:inline-block; float: right;" >
                    <!--<div class="block_line">
                      <div>Welcome <span class="txt_orange" ><?php echo (trim($this->config->item('CRM_USER_NAME')) != '') ? $this->config->item('CRM_USER_NAME') : 'Update Profile'; ?></span> at <span class="txt_green">M.Zahid Travel Limited</span></div>
                      <div class="txt_red">Your CRM Plus Trial expires in 6 days	</div> 
                    </div>-->
                    <div class="comment_block">
                        <div class="alert_block fl" style="opacity:0">
                            <div class="notification_pad">
                                <div class="dropdown"> <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"> <i class="fa fa-bell fa-2x"></i> </a>
                                    
                                </div>
                            </div>
                            <div class="notification_pad"></div>
                        </div>
                        <div class="profile_drpdwn fl">
                            <ul id="nav">
                                <?php
                                $img_url = $this->config->item('images_url') . 'owner_img.png';

                                if ($this->config->item('CRM_USER_PROFILE_IMAGE') != '') {

                                    $img = 'users/' . $this->config->item('CRM_USER_COMPANY_ID') . '/' . $this->session->userdata('iUserId') . '/' . $this->config->item('CRM_USER_PROFILE_IMAGE');
                                    $img_path = $this->config->item('upload_path') . $img;

                                    if (file_exists($img_path)) {
                                        $img_url = $this->config->item('upload_url') . $img;
                                    }
                                }
                                ?>   
                                <li id="notification_li"> <a href="#" id="notificationLink"> <img class="user_profile_img" src="<?php echo $img_url; ?>" alt=""/>
                                        <h6><?php echo (trim($this->config->item('CRM_USER_NAME')) != '') ? $this->config->item('CRM_USER_NAME') : 'Update Profile'; ?></h6>
                                        <span></span> </a>
                                    <div id="notificationContainer">
                                        <div id="notificationsBody" class="notifications">
                                            <div class="onclick_inner">
                                                <div class="profile_img_left cropme"> 
                                                    <div class="change-photo">Change Photo</div>
                                                    <img class="user_profile_img" src="<?php echo $img_url; ?>" alt=""/>
                                                    <input type="file" placeholder="change photo" class="file_image"  data-idvalue="<?php echo $this->session->userdata('iUserId'); ?>" data-idfield="iUserId" data-field="vProfileImage" data-table="user_master" data-div="profile" /> 
                                                </div>                                                
                                                <div class="profile_cont_right">
                                                    <div class="logout_btn">
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Logout" onclick="window.location = '<?php echo $this->config->item('site_url'); ?>signout'"><i class="fa fa-power-off"></i></a>
                                                    </div>
                                                    <h4><a href="#" data-href="<?php echo $this->config->item('site_url'); ?>case_account?N=Account Details" onclick="showformpage(this)"><?php echo (trim($this->config->item('CRM_USER_NAME')) != '') ? $this->config->item('CRM_USER_NAME') : 'Update Profile'; ?></a></h4>
                                                    <p><?php echo $this->config->item('CRM_USER_EMAIL') ?><br/><?php echo $this->config->item('CRM_USER_ROLE') ?> (<?php echo $this->config->item('CRM_USER_PROFILE') ?>)</p>
                                                    <h4><a href="#" data-href="<?php echo $this->config->item('site_url'); ?>case_account?N=Account Details" onclick="showformpage(this)">Account</a> <a href="javascript:void(0)" style="padding: 0 5px;color: #777!important">|</a> <a href="#" onclick="window.location = '<?php echo $this->config->item('site_url'); ?>signout'">Logout</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include APPPATH . '/front-modules/views/notification_message.php'; //footer file     ?>