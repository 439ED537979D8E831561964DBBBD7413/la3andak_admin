<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class category extends MX_Controller {



    public function __construct() {

        parent::__construct();

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->load->model('model_category');

        $this->load->library('session');

          $this->load->library('image_lib');

    }



      public function category_list()

     {

       $fields="*";

        $cond="bIsdelete = 0";

        $order_by="category_id desc";

        $brands = $this->model_category->getData("category",$fields,$cond,$join,$order_by);



         $data['brands'] = $brands;



         $this->load->view("category_list", $data);

     }



    public function category_add()

    {

        $this->load->view("add_category");

    }



    public function category_action()

    {
        
        
        $postvar = $this->input->post();

        $val['category_english_name'] = $postvar['category_name'];

        $val['category_status'] = $postvar['status'];





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

                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_CATEGORY_UPLOAD.$name1)) {



                                        $val['category_icon'] = $name_thumb;

                                        $config['image_library'] = 'gd2';

                                        $config['source_image'] = TABLE_CATEGORY_UPLOAD.$name1;

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
                            if ($_FILES['banner_image']['tmp_name'] != "")

                            {

                                foreach ($_FILES['banner_image']['name'] as $f => $name) {

                                    if ($_FILES['banner_image']['error'][$f] == 4) {

                                        continue;

                                    }



                                    $name1=strtotime(date('Y-m-d H:i')).$name;

                                    $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");

                                    $file_name_array = explode('.',$file_name);

                                    $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];

                                    $name1="banner_".strtotime(date('Y-m-d H:i')).$name;

                                    if(move_uploaded_file($_FILES["banner_image"]["tmp_name"][$f],TABLE_CATEGORY_UPLOAD.$name1)) {



                                        $val['category_banner_img'] = "banner_".$name_thumb;

                                        $config['image_library'] = 'gd2';

                                        $config['source_image'] = TABLE_CATEGORY_UPLOAD.$name1;

                                        $config['create_thumb'] = TRUE;

                                        $config['maintain_ratio'] = TRUE;

                                        $config['width']     = CAT_BANNER_IMG_MAX_WIDTH;

                                        $config['height']   = CAT_BANNER_IMG_MAX_HEIGHT;

                                        $this->image_lib->clear();

                                        $this->image_lib->initialize($config);

                                        $this->image_lib->resize();

                                    }

                                    else{



                                        $this->session->set_flashdata('error', 'Unable to Upload Banner Image');



                                        $this->session->set_userdata($session_data);

                                    }



                                }



                            }

                             if($_FILES['image']['type'][0] == "")

                            {

                                $val['category_icon'] = "no_image.png";

                            }
                             if($_FILES['banner_image']['type'][0] == "")

                            {

                                $val['category_banner_img'] = "";

                            }



          $id = $this->model_category->insert("category", $val);



             $this->session->set_flashdata('success', 'Category Added successfully');



           redirect("category_list");



    }





    public function category_action_edit()

    {

          $postvar = $this->input->post();

          $id = $postvar['id'];

        $val['category_english_name'] = $postvar['category_name'];

        $val['category_status'] = $postvar['status'];







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

                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_CATEGORY_UPLOAD.$name1)) {



                                        $val['category_icon'] = $name_thumb;

                                        $config['image_library'] = 'gd2';

                                        $config['source_image'] = TABLE_CATEGORY_UPLOAD.$name1;

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
                            
                            else

                            {

                                $val['category_icon'] = "no_image.jpg";

                            }

                                if ($_FILES['banner_image']['tmp_name'] != "")

                            {

                                foreach ($_FILES['banner_image']['name'] as $f => $name) {

                                    if ($_FILES['banner_image']['error'][$f] == 4) {

                                        continue;

                                    }



                                    $name1=strtotime(date('Y-m-d H:i')).$name;

                                    $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");

                                    $file_name_array = explode('.',$file_name);

                                    $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];

                                    $name1="banner_".strtotime(date('Y-m-d H:i')).$name;

                                    if(move_uploaded_file($_FILES["banner_image"]["tmp_name"][$f],TABLE_CATEGORY_UPLOAD.$name1)) {



                                        $val['category_banner_img'] = "banner_".$name_thumb;

                                        $config['image_library'] = 'gd2';

                                        $config['source_image'] = TABLE_CATEGORY_UPLOAD.$name1;

                                        $config['create_thumb'] = TRUE;

                                        $config['maintain_ratio'] = TRUE;

                                        $config['width']     = IMG_MAX_WIDTH;

                                        $config['height']   = IMG_MAX_HEIGHT;

                                        $this->image_lib->clear();

                                        $this->image_lib->initialize($config);

                                        $this->image_lib->resize();

                                    }

                                    else{



                                        $this->session->set_flashdata('error', 'Unable to Upload Category Banner Image');



                                        $this->session->set_userdata($session_data);

                                    }



                                }



                            }



                            else

                            {

                                $val['category_banner_img'] = "no_image.jpg";

                            }





          // $id = $this->model_category->insert("category", $val);



           $this->model_category->update("category", $val, "category_id=" . $id);



             $this->session->set_flashdata('success', 'Category Updated successfully');



           redirect("category_list");

    }







    public function category_edit()

    {



        $getvar = $this->input->get();

        $category_id = urldecode($this->general->decryptData($getvar['category_id']));

        if (!empty($category_id))

        {

            $fields="*";

            $cond="category_id=".$category_id;



            $category = $this->model_category->getData("category", $fields, $cond, $join);

            //get order package



            $data['category'] = $category;

        }

        // echo "<pre>";print_r($data);echo "</pre>";die();

        $this->load->view("edit_category", $data);

    }





      function removeImage()

      {



           $id = $this->input->post('id');
           $type = $this->input->post('type');

           if ($id > 0) {
               if($type == "category_banner"){
                     $update['category_banner_img'] = "";
               }else{
                     $update['category_icon'] = "no_image.png";
               }
               

                $this->model_category->update("category", $update, "category_id=" . $id);

                       }

           return true;

     }

     function delete_category()

     {

         $getvar = $this->input->get();

        $id = urldecode($this->general->decryptData($getvar['category_id']));

        if ($id != '')

         {



                 // $fields="*";

                 //    $cond="brand_id=".$id;



                 //    $category = $this->model_category->getData("category", $fields, $cond, $join);



                 //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);



                $update['bIsdelete'] = "1";

                $this->model_category->update("category", $update, "category_id=" . $id);



              $this->session->set_flashdata('success', 'Category Deleted successfully');



              redirect("category_list");

        }

     }















}

