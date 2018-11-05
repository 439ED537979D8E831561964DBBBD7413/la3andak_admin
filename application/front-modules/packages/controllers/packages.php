<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packages extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_packages');
    }

    public function manage_package() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['pkg_id']));

        if ($id != '') {
            $update['isDelete'] = "1";
            $update['dtModifyDate'] = date("Y-m-d H:i:s");
            $this->model_packages->update("packages", $update, "pkg_id=" . $id);
            redirect("manage_package");
        }
        $image = $this->config->item("upload_url") . "packages/";
        $field = 'pkg_id,title,description,sedan_price,suv_price,if(packages.image is null,"",concat("' . $image . '",packages.pkg_id,"/",packages.image)) as image';
        $rply = $this->model_packages->getData("packages", $field, "","","pkg_id");
        

        $data['all'] = $rply;
        $this->load->view("package_list", $data);
    }

    public function add_package() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['pkg_id']));        
        if ($id != '') {
            $rply = $this->model_packages->getData("packages", "*", "pkg_id ='" . $id . "'");
            $data['all'] = $rply[0];
        }

        $this->load->view("add_package", $data);
    }

    public function package_action() {
        $postvar = $this->input->post();
        $id = $postvar['pkg_id'];
        $ImageFile = $_FILES['image'];

        $val['title'] = $postvar['title'];
        $val['description'] = $postvar['description'];    
        $val['sedan_price'] = $postvar['sedan_price'];    
        $val['suv_price'] = $postvar['suv_price'];    

        if ($id != '') {
            $this->model_packages->update("packages", $val, "pkg_id ='" . $id . "'");
        } else {
            $val['created_on'] = date("Y-m-d H:i:s");
            $id = $this->model_packages->insert("packages", $val);
        }

        if ($ImageFile['name'] != '') {

            $redirectUrl = 'manage_package';
            if ($id != '') {
                $redirectUrl .= '?pkg_id=' . urlencode($this->general->encryptData($id));
            }
            $vrsRes = $this->general->checkVirus($ImageFile, $redirectUrl);
            $this->load->library('upload');
            $temp_folder_path = $this->config->item('upload_path') . 'packages' . '/' . $id;
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

                $ext_cond = 'pkg_id ="' . $id . '"';
                $this->model_packages->update("packages", $postimg, $ext_cond);
            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        redirect("manage_package");
    }

    public function delete_package(){
        $getvar = $this->input->get();        
        //$id = $getvar['pkg_id'];
        $id = urldecode($this->general->decryptData($getvar['pkg_id']));
        $fields = "image,pkg_id";
        $ext_cond = 'pkg_id ="' . $id . '"';
        $reply = $this->model_packages->getData("packages", $fields,$ext_cond);        
        $image = $reply[0]['image'];

        if ($image != '') {
            $img = 'packages/' . $reply[0]['pkg_id'] . '/' . $image;
            $img_path = $this->config->item('upload_path') . $img;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }
        //$where='pkg_id ='.$id;
        $where = 'pkg_id ="' . $id . '"';
        $delete = $this->model_packages->delete("packages",$where);
        redirect("manage_package");
    }
    public function package_image_delete() {
        $postvar = $this->input->post();
        
        $id = $postvar['pkg_id'];
        $fields = "image,pkg_id";
        $ext_cond = 'pkg_id ="' . $id . '"';
        $reply = $this->model_packages->getData("packages", $fields,$ext_cond);
        
        $image = $reply[0]['image'];

        if ($image != '') {
            $img = 'packages/' . $reply[0]['pkg_id'] . '/' . $image;
            $img_path = $this->config->item('upload_path') . $img;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }
        $data['image'] = '';
        $this->model_packages->update("packages", $data, $ext_cond);
    }

}
