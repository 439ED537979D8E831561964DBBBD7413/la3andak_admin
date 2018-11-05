<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->load->model('model_support');
        $this->load->library('session');
        $this->load->library('image_lib');
    }

    public function index() {
//        $this->load->view("dashboard");
        redirect('login');
    }

    public function edit_profile_api() {

        $name = ($_GET['name']);
        $uemail = ($_GET['email']);
        $ucontactno = ($_GET['ucontactno']);
        $id = ($_GET['user_id']);

        $image_name = ($_GET['image_name']);
        $image_path = ($_GET['image_path']);

        $val['ufname'] = $full_name;
        $val['ucontactno'] = $ucontactno;
        $val['uemail'] = $uemail;

        if (!is_dir(TABLE_USER_UPLOAD)) {
            echo "error in dir";
            exit;
        } else {
            // echo "Folder get it";
            // exit();
            var_dump(TABLE_USER_UPLOAD);
            exit();
        }



        if ($image_path != "") {
            $name1 = strtotime(date('Y-m-d H:i')) . $image_name;
            $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
            $file_name_array = explode('.', $file_name);
            $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
            $name1 = strtotime(date('Y-m-d H:i')) . $image_name;

            if (move_uploaded_file($image_path, TABLE_USER_UPLOAD . $name1)) {
                $image = $name_thumb;
                $config['image_library'] = 'gd2';
                $config['source_image'] = TABLE_USER_UPLOAD . $name1;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = IMG_MAX_WIDTH;
                $config['height'] = IMG_MAX_HEIGHT;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            } else {
                var_dump("not success");
            }
        }




        exit();
    }

    public function invoice_mail() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->view('invoice_mail');
    }

    public function login() {
        $this->load->view('login');
    }

    public function login_action() {
        $postvar = $this->input->post();
        $rply = $this->model_support->authenticate($postvar['email'], md5($postvar['password']));
        if ($rply['errorCode'] == 1) {
            $this->session->set_flashdata('success', 'Welcome to LA3ANDAK');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('login');
        }
    }

    public function deleivery_charges() {
        $id = 'delivery_charge';
        $fields = "*";
        $ext_cond = 'seeting_uniq_name ="' . $id . '"';
        $data['charges'] = $this->model_support->getData("settings", $fields, array(), $ext_cond);

        $id = 'delivery_amount';
        $fields = "*";
        $ext_cond = 'seeting_uniq_name ="' . $id . '"';
        $data['amount'] = $this->model_support->getData("settings", $fields, array(), $ext_cond);


        $this->load->view("deleivery_charges", $data);
    }

    public function deleivery_action() {
        $postvar = $this->input->post();

        $camount = $postvar['camount'];
        $charge = $postvar['charge'];


        $val['setting_value'] = $camount;
        $this->model_support->update("settings", $val, "seeting_uniq_name='delivery_amount'");


        $val['setting_value'] = $charge;
        $this->model_support->update("settings", $val, "seeting_uniq_name='delivery_charge'");

        $this->session->set_flashdata('success', 'Delivery Charges Updated successfully');

        redirect('deleivery_charges');
    }

    public function dashboard() {
        if ($this->session->userdata('iAdminId') == '') {
            redirect('login');
        }

        $data = array();

        $orders = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.bRecordDelete=0 ORDER BY order_date DESC LImit 5");
        $order_array = $orders->result_array();
        $data['orders'] = $order_array;


        $fields = "*";
        $ext_cond = 'bIsdelete =0';
        $data['user_number'] = $this->model_support->getData("users", $fields, array(), $ext_cond);


        $fields = "*";
        $ext_cond = '';
        $data['order_number'] = $this->model_support->getData("order", $fields, array(), $ext_cond);

        $fields = "*";
        $ext_cond = 'bIsdelete =0';
        $data['category_number'] = $this->model_support->getData("category", $fields, array(), $ext_cond);

        $fields = "*";
        $ext_cond = 'bIsdelete =0';
        $data['brand_number'] = $this->model_support->getData("brand", $fields, array(), $ext_cond);



        $this->load->view("dashboard", $data);
    }

    public function profile() {
        $id = $this->session->userdata("iAdminId");



        $rply = $this->model_support->getData("seller", "*", "seller_id=" . $id);
        // echo "<pre>"; var_dump($rply);exit();

        $data['all'] = $rply[0];
        $this->load->view("profile", $data);
    }

    public function profile_action() {
        $postvar = $this->input->post();

        $id = $postvar['aid'];
        $ImageFile = $_FILES['image'];
        $val['seller_english_name'] = $postvar['firstname'];
        // $val['vLastName'] = $postvar['lastname'];
        $val['seller_username'] = $postvar['email'];

        if ($postvar['chnagepass'] == "1") {

            $val['seller_password'] = md5($postvar['password']);
        }
        $this->model_support->update("seller", $val, "seller_id=" . $id);

        if ($ImageFile['name'] != '') {

            // var_dump("expression");
            // exit();
            $this->load->library('upload');
            $temp_folder_path = TABLE_ADMIN_PROFILE;
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
                $postimg['seller_logo'] = $uploadedFile;

                // $ext_cond = 'del_id ="' . $del_id . '"';
                $this->model_support->update("seller", $postimg, "seller_id=" . $id);
            } else {
                echo $this->upload->display_errors();
                //exit;
            }
        }


        // $val['seller_logo'] = $logo;




        $this->session->set_flashdata('success', 'Profile updated successfully');

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

    //Feedback List

    public function feedback_list() {
        $this->db->select('*');
        $this->db->from("feedback");

        $result = $this->db->get();
        $record = $result->result_array();
        $data['feedback'] = $record;

        $this->load->view("feedback_list", $data);
    }

    public function content_management() {

        $this->db->select('*');
        $this->db->from("content_management");
        $result = $this->db->get();
        $record = $result->result_array();

        $data['about'] = $record[0]['about_us'];
        $data['terms'] = $record[0]['terms_conditions'];
        $data['faqs'] = $record[0]['faq'];


        $this->load->view("content_management", $data);
    }

    public function content_action() {
        $postvar = $this->input->post();


        $about['about_us'] = $postvar['about'];
        $about['terms_conditions'] = $postvar['terms'];
        $about['faq'] = $postvar['about_app'];

        $this->model_support->update("content_management", $about, "content_management_id='1'");

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

        $update['password'] = $password;
        $this->model_support->update("users", $update, "user_id=" . $id);
        $this->load->view("reset_password_success");
    }

    public function driver_reset_password() {
        $getvar = $this->input->get();

        $id = $this->general->decryptData($getvar['del_id']);
        $type = $this->general->decryptData($getvar['utype']);
        $data['id'] = $id;
        $this->load->view("driver_reset_password", $data);
    }

    public function driver_reset_password_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];

        $password = md5($postvar['password']);
        $update['password'] = $password;
        $this->model_support->update("delivery_users", $update, "del_id=" . $id);
        $this->load->view("reset_password_success");
    }

    public function contact_us() {
        $this->db->select('*');
        $this->db->from("contact_us");
        $result = $this->db->get();
        $record['contact_us'] = $result->result_array();


        $rest = substr($record['contact_us'][0]['mobile_no'], 0, 4);
        $rest1 = substr($record['contact_us'][0]['mobile_no'], 4, 2);
        $rest2 = substr($record['contact_us'][0]['mobile_no'], 6, 6);

        $record['contact_us'][0]['main_code'] = $rest;
        $record['contact_us'][0]['area_code'] = $rest1;
        $record['contact_us'][0]['ucontactno'] = $rest2;

        //var_dump($record);die;
        $this->load->view("contact_us", $record);
    }

    public function contact_us_action() {
        $postvar = $this->input->post();
        $contact['name'] = $postvar['name'];
        $main_code = $_POST['main_code'];
        $area_code = $_POST['area_code'];
        $cno = $_POST['cno'];
        $number = $main_code . $area_code . $cno;
        $contact['email'] = $postvar['email'];
        $contact['address'] = $postvar['add'];

        $contact['fb_url'] = $postvar['fb_url'];
        $contact['twitter_url'] = $postvar['twitter_url'];
        $contact['insta_url'] = $postvar['insta_url'];
        $contact['play_store_url'] = $postvar['play_store_url'];
        $contact['app_store_url'] = $postvar['app_store_url'];


        $contact['mobile_no'] = $number;
        $this->model_support->update("contact_us", $contact, "id='1'");

        redirect("contact_us");
    }

    public function logout() {
        //$this->load->model('tools/loghistory');
        //$query = "(select max(iLogId) as iLogId from log_history where iUserId = '" . $this->session->userdata("iAdminId") . "' AND eUserType = 'Admin')";
        //$getval = $this->loghistory->query($query);
        //$id = $getval[0]['iLogId'];
        //  $ext_con = "iLogId = '" . $id . "'";
        //$data['dtLogoutDate'] = date('Y-m-d H:i:s');
        //$this->loghistory->update($data, $ext_con);
        //PublisherUser lastaccess query
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'logout successfully');

        redirect($this->config->item('site_url') . 'login');
    }

}
