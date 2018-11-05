<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class brand extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_brand');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function manage_brand()
     {
       $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="brand_id desc";
        $brands = $this->model_brand->getData("brand",$fields,$cond,$join,$order_by);

         $data['brands'] = $brands;

         $this->load->view("brand_list", $data);
     }

    public function brand_add() 
    {
        $this->load->view("add_brand");
    }
   
    public function brand_action() 
    {
        $postvar = $this->input->post();
        $val['brand_name'] = $postvar['brand_name'];       
        $val['brand_status'] = $postvar['status'];    
        

        
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
                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_BRAND_UPLOAD.$name1)) {

                                        $val['brand_icon'] = $name_thumb;  
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = TABLE_BRAND_UPLOAD.$name1;
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
                                $val['brand_icon'] = "no_image.png";
                            }
                           

          $id = $this->model_brand->insert("brand", $val);

             $this->session->set_flashdata('success', 'Brand Added successfully');

           redirect("manage_brand");  
 
    } 


    public function brand_action_edit()
    {
          $postvar = $this->input->post();
          $id = $postvar['id'];   
        $val['brand_name'] = $postvar['brand_name'];       
        $val['brand_status'] = $postvar['status'];    
      
        
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
                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_BRAND_UPLOAD.$name1)) {

                                        $val['brand_icon'] = $name_thumb;  
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = TABLE_BRAND_UPLOAD.$name1;
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
                                $val['brand_icon'] = "no_image.png";
                            }

          // $id = $this->model_brand->insert("brand", $val);

           $this->model_brand->update("brand", $val, "brand_id=" . $id);

             $this->session->set_flashdata('success', 'Brand Updated successfully');

           redirect("manage_brand");  
    }


    public function delete_location() {
        $getvar = $this->input->get();        
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));

        $where="loc_id =".$loc_id." AND cust_id=".$id;
        $result = $this->model_brand->delete("location",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("location_customer?cust_id=".$cust_id);

    }
    public function brand_edit()
    {

        $getvar = $this->input->get();
        $brand_id = urldecode($this->general->decryptData($getvar['brand_id']));
        if (!empty($brand_id)) 
        {
            $fields="*";
            $cond="brand_id=".$brand_id;
            
            $brand = $this->model_brand->getData("brand", $fields, $cond, $join);
            //get order package
           
            $data['brand'] = $brand;
        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_brand", $data);
    }


      function removeImage() 
      {

           $id = $this->input->post('id');           
           if ($id > 0) {
                 $update['brand_icon'] = "no_image.png";              
                $this->model_brand->update("brand", $update, "brand_id=" . $id);
                       }
           return true;
     }
     function delete_brand()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['brand_id']));       
        if ($id != '')
         {      

                 // $fields="*";
                 //    $cond="brand_id=".$id;
                    
                 //    $brand = $this->model_brand->getData("brand", $fields, $cond, $join);

                 //     unlink(TABLE_BRAND_UPLOAD.$brand[0]['brand_icon']);                                     
          
                $update['bIsdelete'] = "1";              
                $this->model_brand->update("brand", $update, "brand_id=" . $id);

              $this->session->set_flashdata('success', 'Brand Deleted successfully');

              redirect("manage_brand");  
        }
     }
   
    

 
    
 
  
}
