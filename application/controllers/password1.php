<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Password extends MX_Controller {

    public function __construct() {  
        die("hello");      
        parent::__construct();
        //error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        error_reporting(1);
        //$this->load->model('support');
        $this->load->library('general');
    }

    public function resetpassword() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['uid']));      
        echo "uid<pre>";print_r($getvar);echo "</pre>";
        die("helloword");

        $data['all'] = "hellofriend";
        $this->load->view("resetpassword", $data);
    }

    

}
