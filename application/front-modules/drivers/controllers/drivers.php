<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drivers extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_drivers');
    }

    public function manage_drivers() {
        
        $field = "";
        $drivers = $this->model_drivers->getData("delivery_users",$field);
        $data['drivers'] = $drivers;       
        $this->load->view("driver_list", $data);
    }

    public function driver_action() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];
        $email = $postvar['email'];

        $val['fullname'] = $postvar['fullname'];
        $val['phone'] = $postvar['phone'];
        $val['status'] = $postvar['status'];    
        $val['email'] = $postvar['email'];    
        
 
        if ($postvar['chnagepass'] == '1' || $id == '') {
            $val['password'] = md5($postvar['password']);
        }

        $rply = $this->model_drivers->getData("driver", "*", "email ='" . $email . "'");
        $driver = $rply[0];
        if(!empty($driver) && empty($id)){
           $data['all']=$val;
           $data['error']='';
           $this->load->view("add_driver", $data);   
        }else{

            if ($id != '') {
                //$val['dtModifyDate'] = date("Y-m-d H:i:s");
                $this->model_drivers->update("driver", $val, "cust_id ='" . $id . "'");
            } else {
                $val['created_on'] = date("Y-m-d H:i:s");
                $this->model_drivers->insert("driver", $val);
            }
                redirect("manage_drivers");
        }
    } 
   

    public function delete_driver() {
        $getvar = $this->input->get();                
        $del_id = urldecode($this->general->decryptData($getvar['del_id']));
        $where="del_id =".$del_id;
        $result = $this->model_drivers->delete("delivery_users",$where);   
        redirect("manage_drivers");
    }
    

    public function add_driver() {
        $postvar = $this->input->post();       
        $del_id = $postvar['del_id'];
        $val['fullname'] = $postvar['fullname'];
        $val['email'] = $postvar['email'];
        $val['password'] = $postvar['password'];    
        $val['phone'] = $postvar['phone'];    
        $val['status'] =2;
        $ImageFile = $_FILES['image'];

        
  
        
        if (!empty($del_id)) {
            $this->model_drivers->update("delivery_users", $val, "del_id ='" . $del_id . "'");
            $data['message']="User updated successfully.";
            $data['status']=1;
            //die(json_encode($data)); 
        } else {
           $del_id=$this->model_drivers->insert("delivery_users", $val);
            $data['message']="User added successfully.";
            $data['status']=1;
            
        }
        if ($ImageFile['name'] != '') 
        {

            /*$redirectUrl = 'manage_package';
            if ($id != '') {
                $redirectUrl .= '?pkg_id=' . urlencode($this->general->encryptData($id));
            }
            $vrsRes = $this->general->checkVirus($ImageFile, $redirectUrl);*/
            $this->load->library('upload');
            $temp_folder_path = $this->config->item('upload_path') . 'drivers' . '/' . $del_id;
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
                $postimg['image'] = $uploadedFile;

                $ext_cond = 'del_id ="' . $del_id . '"';
                $this->model_drivers->update("delivery_users", $postimg, $ext_cond);
            } else {
                echo $this->upload->display_errors();
                //exit;
            }
        }

        die(json_encode($data)); 

        /*$data['message']="Somethinng went wrong. Please try again later.";
        $data['status']=0;
        die(json_encode($data)); */
        
    }
    public function get_driver() {
        $postvar = $this->input->post();        
        $del_id = urldecode($this->general->decryptData($postvar['del_id']));
        $driver = $this->model_drivers->getData("delivery_users", "*", "del_id ='" . $del_id . "'");
        if(!empty($driver)){            
            $data['message']="Payment method found.";
            $data['status']=1;
            $data['driver'] = $driver[0];
            die(json_encode($data)); 
        }else{
            $data['message']="Somethinng went wrong. Please try again later.";
            $data['status']=0;
            $data['driver'] = '';
            die(json_encode($data)); 
        }
    }
    
    
    
    
}
