<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_support');
        $this->load->library('session');
    }

    public function index() {
//        $this->load->view("dashboard");
        redirect('login');
    }

    public function login() {
//        $this->load->view('dashboard');

        if ($this->session->userdata('iAdminId') != '') {
            redirect('dashboard');
        } else {
            $cookiedata = $this->cookie->read('userarray');
            $data['emailid'] = $cookiedata['user_emailid'];
            $data['password'] = $cookiedata['user_password'];
            $data['remember'] = '';

            if (is_array($cookiedata) && $cookiedata['nspl_username'] != '') {
                $data['emailid'] = $cookiedata['nspl_username'];
                $data['password'] = $cookiedata['nspl_password'];
                $data['remember'] = 'On';
            }
            $this->load->view('login', $data);
        }
    }

    public function login_action() {
        $postvar = $this->input->post();

//        $this->general->checkSession();
        $this->load->library('cookie');

        if ($postarr['remember'] == 'on') {
            $cookiedata = array(
                'user_emailid' => $postarr['email'],
                'user_password' => $postarr['password']
            );
            $this->cookie->write('userarray', $cookiedata);
        } else {
            $cookiedata = array(
                'nspl_username' => '',
                'nspl_password' => ''
            );
            $this->cookie->write('userarray', $cookiedata);
        }

        $rply = $this->model_support->authenticate($postvar['email'], md5($postvar['password']));

        if ($rply['errorCode'] == 1) {
            $this->session->set_flashdata('success', 'Welcome to Product');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('login');
        }
    }

    public function dashboard() {
        if ($this->session->userdata('iAdminId') == '') {
            redirect('login');
        }
        $user=$this->model_support->getData("user_master", "count(iUserId) as user", array(),"isDelete!='1'");
        $taluka=$this->model_support->getData("taluka_master", "count(iTalukaId) as taluka", array(), "isDelete!='1'");
        $product=$this->model_support->getData("product_master", "count(iProductId) as product", array(), "eProduct='Accepted' and isDelete!='1'");
        $village=$this->model_support->getData("village_master", "count(iVillageId) as village", array(), "isDelete!='1'");
        $district=$this->model_support->getData("district_master", "count(iDistrictId) as district", array(), "isDelete!='1'");
        $state=$this->model_support->getData("state_master", "count(iStateId) as state", array(), "eStatus='Active' and isDelete!='1'");
        
        $data['user']=$user[0]['user'];
        $data['taluka']=$taluka[0]['taluka'];
        $data['product']=$product[0]['product'];
        $data['village']=$village[0]['village'];
        $data['district']=$district[0]['district'];
        $data['state']=$state[0]['state'];
        $this->load->view("dashboard", $data);
    }

    public function profile() {
        $id = $this->session->userdata("iAdminId");
        $rply = $this->model_support->getData("admin_master", "*", "iAdminId=" . $id);
        $data['all'] = $rply[0];
        $this->load->view("profile", $data);
    }

    public function profile_action() {
        $postvar = $this->input->post();

        $id = $postvar['aid'];
        $ImageFile = $_FILES['image'];
        $val['vFirstName'] = $postvar['firstname'];
        $val['vLastName'] = $postvar['lastname'];
        $val['vEmail'] = $postvar['email'];
        if ($postvar['chnagepass'] == "1") {

            $val['vPassword'] = md5($postvar['password']);
        }

        $this->model_support->update("admin_master", $val, "iAdminId=" . $id);

        if ($ImageFile['name'] != '') {

            $redirectUrl = 'profile';
            if ($id != '') {
                $redirectUrl .= '?id=' . urlencode($this->general->encryptData($id));
            }
            $vrsRes = $this->general->checkVirus($ImageFile, $redirectUrl);
            $this->load->library('upload');
            $temp_folder_path = $this->config->item('upload_path') . 'admin' . '/' . $id;
            $this->general->createfolder($temp_folder_path);

            $file_name = $ImageFile['name'];

            $upload_config = array(
                'upload_path' => $temp_folder_path,
                'allowed_types' => "jpg|jpeg|gif|png", //*
                'max_size' => 1028 * 1028 * 2,
                'file_name' => $file_name,
                'remove_space' => TRUE,
                'overwrite' => True
            );

            $this->upload->initialize($upload_config);

            if ($this->upload->do_upload('image')) {
                $file_info = $this->upload->data();
                $uploadedFile = $file_info['file_name'];
                $postimg['vImage'] = $uploadedFile;

                $ext_cond = 'iAdminId ="' . $id . '"';
                $this->model_support->update("admin_master", $postimg, $ext_cond);
            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        $this->session->set_flashdata('success', 'profile updated successfully');

        redirect("profile");
    }

    public function profile_image_delete() {
        $postvar = $this->input->post();

        $id = $postvar['id'];
        $fields = "vImage,iAdminId";
        $ext_cond = 'iAdminId ="' . $id . '"';
        $reply = $this->model_support->getData("admin_master", $fields, array(), $ext_cond);

        $image = $reply[0]['vImage'];

        if ($image != '') {
            $img = 'admin/' . $reply[0]['iAdminId'] . '/' . $image;
            $img_path = $this->config->item('upload_path') . $img;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }
        $data['vImage'] = '';
        $this->model_support->update("admin_master", $data, array(), $ext_cond);
    }

    public function content_management() {

        $about = $this->model_support->getData("content_master", "tContent", array(), "vCode='ABOUT_US'");
        $contact = $this->model_support->getData("content_master", "tContent", array(), "vCode='CONTACT_US'");
        $terms = $this->model_support->getData("content_master", "tContent", array(), "vCode='TERMS'");
        $app = $this->model_support->getData("content_master", "tContent", array(), "vCode='ABOUT_APP'");

        $data['about'] = $about[0]['tContent'];
        $data['contact'] = $contact[0]['tContent'];
        $data['terms'] = $terms[0]['tContent'];
        $data['about_app'] = $app[0]['tContent'];

//        pr($data);exit;
        $this->load->view("content_management", $data);
    }

    public function content_action() {
        $postvar = $this->input->post();
//        pr($postvar);exit;

        $about['tContent'] = $postvar['about'];
        $about['dtModifyDate'] = date("Y-m-d H:i:s");
        $terms['tContent'] = $postvar['terms'];
        $terms['dtModifyDate'] = date("Y-m-d H:i:s");
        $app['tContent'] = $postvar['about_app'];
        $app['dtModifyDate'] = date("Y-m-d H:i:s");
        $this->model_support->update("content_master", $about, "vCode='ABOUT_US'");

        $this->model_support->update("content_master", $terms, "vCode='TERMS'");
        $this->model_support->update("content_master", $app, "vCode='ABOUT_APP'");

        redirect("content_management");
    }

    public function reset_password() {
        $getvar = $this->input->get();

        $id = $this->general->decryptData($getvar['uid']);
        $type = $this->general->decryptData($getvar['utype']);
        $data['id'] = $id;
        $this->load->view("reset_password", $data);
    }

    public function reset_password_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];

        $password = md5($postvar['password']);
        $update['vPassword'] = $password;
        $this->model_support->update("user_master", $update, "iUserId=" . $id);
        $this->load->view("reset_password_success");
    }

    public function contact_us() {
        $data['mobile'] = $this->model_support->getData("content_master", "tContent",array(), "vCode='MOBILE'");
        $data['email'] = $this->model_support->getData("content_master", "tContent",array(), "vCode='EMAIL'");
        $data['add'] = $this->model_support->getData("content_master", "tContent",array(), "vCode='CONTACT_US'");
        

        $this->load->view("contact_us", $data);
    }

    public function contact_us_action() {
        $postvar = $this->input->post();
        $mobile['tContent'] = $postvar['mobile'];
        $mobile['dtModifyDate'] = date("Y-m-d H:i:s");
        $email['tContent'] = $postvar['email'];
        $email['dtModifyDate'] = date("Y-m-d H:i:s");
        $add['tContent'] = $postvar['add'];
        $add['dtModifyDate'] = date("Y-m-d H:i:s");
        $this->model_support->update("content_master", $mobile, "vCode='MOBILE'");
        $this->model_support->update("content_master", $email, "vCode='EMAIL'");
        $this->model_support->update("content_master", $add, "vCode='CONTACT_US'");

        redirect("contact_us");
    }

    public function logout() {
        $this->load->model('tools/loghistory');
        $query = "(select max(iLogId) as iLogId from log_history where iUserId = '" . $this->session->userdata("iAdminId") . "' AND eUserType = 'Admin')";
        $getval = $this->loghistory->query($query);
        $id = $getval[0]['iLogId'];
        $ext_con = "iLogId = '" . $id . "'";
        $data['dtLogoutDate'] = date('Y-m-d H:i:s');
        $this->loghistory->update($data, $ext_con);

        //PublisherUser lastaccess query
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'logout successfully');

        redirect($this->config->item('site_url') . 'login');
    }

}
