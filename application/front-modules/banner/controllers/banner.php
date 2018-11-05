<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class banner extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_banner');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function banner_list()
     {

        $fields="*";
        $cond="bIsdelete = 0";
        $order_by="id desc";
        $banner = $this->model_banner->getData("banner_list",$fields,$cond,$join,$order_by);

         $data['banner'] = $banner;

         $this->load->view("banner_list", $data);
     }

    public function add_banner()
    {
        $this->load->view("add_banner");
    }

    public function banner_action()
    {
        $postvar = $this->input->post();

        $val['vDesc'] = $postvar['desc'];
        $val['status'] = $postvar['status'];
        // $val['status'] = $postvar['status'];

        if ($_FILES['image']['tmp_name'] != "")
        {
            foreach ($_FILES['image']['name'] as $f => $name) {
                if ($_FILES['image']['error'][$f] == 4) {
                    continue;
                }

                $name1=strtotime(date('Y-m-d H:i')).$name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.',$file_name);
                $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];
                $name1=strtotime(date('Y-m-d H:i')).$name;
                if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_BANNER_UPLOAD.$name1)) {

                    $val['vImage'] = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_BANNER_UPLOAD.$name1;
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = IMG_MAX_WIDTH;
                    $config['height']   = IMG_MAX_HEIGHT;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                else{

                    $this->session->set_flashdata('error', 'Unable to Upload Image');

                    $this->session->set_userdata($session_data);
                }

            }

        }



        if($_FILES['image']['type'][0] == "")
        {
            $val['vImage'] = "no_image.png";
        }

          $id = $this->model_banner->insert("banner_list", $val);

          $this->session->set_flashdata('success', 'Banner Added successfully');

           redirect("banner_list");

    }


    public function banner_action_edit()
    {

       $postvar = $this->input->post();
        $id = $postvar['id'];

        $val['vDesc'] = $postvar['desc'];
        $val['status'] = $postvar['status'];
        // $val['status'] = $postvar['status'];

        if ($_FILES['image']['tmp_name'] != "")
        {
            foreach ($_FILES['image']['name'] as $f => $name) {
                if ($_FILES['image']['error'][$f] == 4) {
                    continue;
                }

                $name1=strtotime(date('Y-m-d H:i')).$name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.',$file_name);
                $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];
                $name1=strtotime(date('Y-m-d H:i')).$name;
                if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_BANNER_UPLOAD.$name1)) {

                    $val['vImage'] = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_BANNER_UPLOAD.$name1;
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = IMG_MAX_WIDTH;
                    $config['height']   = IMG_MAX_HEIGHT;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
                else{

                    $this->session->set_flashdata('error', 'Unable to Upload Image');

                    $this->session->set_userdata($session_data);
                }

            }

        }

           $this->model_banner->update("banner_list", $val, "id=" . $id);

             $this->session->set_flashdata('success', 'Banner Updated successfully');

           redirect("banner_list");

    }



    public function edit_banner()
    {

        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['id']));

        if (!empty($id))
        {

         $fields="*";
        $cond="id='".$id."'";
         $order_by="";
         $banner_list = $this->model_banner->getData("banner_list",$fields,$cond,$join,$order_by);
         $data['banner_list'] = $banner_list;

        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_banner", $data);
    }


     function delete_banner()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['id']));
        if ($id != '')
         {

                 // $fields="*";
                 //    $cond="brand_id=".$id;

                 //    $category = $this->model_banner->getData("category", $fields, $cond, $join);

                 //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);

                $update['bIsdelete'] = "1";
                $this->model_banner->update("banner_list", $update, "id=" . $id);

              $this->session->set_flashdata('success', 'Banner Deleted successfully');

              redirect("banner_list");
        }
     }
     function removeImage()
      {

           $id = $this->input->post('id');
           if ($id > 0) {
                 $update['vImage'] = "no_image.png";
                $this->model_banner->update("banner_list", $update, "id=" . $id);
                       }
           return true;
     }







}
