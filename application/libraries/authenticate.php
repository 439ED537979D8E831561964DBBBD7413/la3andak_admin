<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Authenticate {

    protected $CI;

    function __construct() {
        $this->CI = &get_instance();
        $this->authenticate();
    }

    protected function authenticate() {
        $front_allow_arrray = array('index', 'logout', 'login', 'signup_action', 'signin', 'signin_action', 'userEmail', 'forgot_password', 'forgot_password_action', 'verification', 'signout', 'staticpage', 'search', 'forgotEmailExist', 'reset_pass', 'resetpass_action', 'serviceAuth', 'getMailbox');
        $admin_allow_arrray = array('index', 'login', 'login_action', 'logout', 'forgotpassword', 'forgotpassword_action', 'verification', 'verification_denied', 'setlatlong', 'cron_update_task_status');
        $class_allow_arrray = array('content', 'v1');
        $current_class = $this->CI->router->fetch_class();
        $current_method = $this->CI->router->fetch_method();
        $current_module = $this->CI->router->fetch_module();
//        var_dump($this->CI->session->userdata('beforeurl'));
//        echo $this->CI->session->userdata('iAdminId');exit;
        if (!in_array($current_method, $admin_allow_arrray) && !in_array($current_class, $class_allow_arrray)) {
            if (!$this->checkValidAuth('Admin')) {
                //redirect(site_url('login'));
                echo "<script>location.href='" . site_url('login') . "'</script>";
                exit;
            }
        }
    }

    function checkValidAuth($eType) {
        $flag = false;
        if ($eType == 'Admin') {
            if ($this->CI->session->userdata('iAdminId') > 0) {
                $flag = true;
            }
        } elseif ($eType == 'Member') {
            if ($this->CI->session->userdata('iPublisherUserId') > 0) {
                $flag = true;
            }
        }
        return $flag;
    }

}
