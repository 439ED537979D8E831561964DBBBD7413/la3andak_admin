<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sub_category extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_sub_category');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function sub_category_list()
     {
          $fields="*";       
          $cond="bIsdelete = 0";
          $order_by="category_english_name";
          $category = $this->model_sub_category->getData("category",$fields,$cond,$join,$order_by);
 
         $data['category'] = $category;



       $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="product_status desc";
        $sub_category = $this->model_sub_category->getData("product_bunch",$fields,$cond,$join,$order_by);

         $data['sub_category'] = $sub_category;

          
         

         $this->load->view("sub_category_list", $data);
     }

    public function sub_category_add() 
    { 

        $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="category_english_name";
        $category = $this->model_sub_category->getData("category",$fields,$cond,$join,$order_by);
 
         $data['category'] = $category;

        $this->load->view("add_sub_category",$data);
    }
   
    public function sub_category_action() 
    {
        $postvar = $this->input->post();    

        $val['productbunch_english_name'] = $postvar['category_name'];       
        $val['product_category'] = $postvar['category'];    
          $val['product_description'] = $postvar['desc'];
         $val['product_status'] = $postvar['status'];


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
                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_SUB_CATEGORY_UPLOAD.$name1)) {

                                        $val['product_image'] = $name_thumb;  
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = TABLE_SUB_CATEGORY_UPLOAD.$name1;
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
                             if(($_FILES['image']["type"][0])=="")                              
                            {                                
                               $val['product_image'] = "no_image.png";
                            } 



          $id = $this->model_sub_category->insert("product_bunch", $val);

             $this->session->set_flashdata('success', 'Sub Category Added successfully');

           redirect("sub_category_list");  
 
    } 


    public function sub_category_action_edit()
    {
          
       $postvar = $this->input->post();    
        $id = $postvar['id'];   
        $val['productbunch_english_name'] = $postvar['category_name'];       
        $val['product_category'] = $postvar['category'];    
          $val['product_description'] = $postvar['desc'];
         $val['product_status'] = $postvar['status'];

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
                                    if(move_uploaded_file($_FILES["image"]["tmp_name"][$f],TABLE_SUB_CATEGORY_UPLOAD.$name1)) {

                                        $val['product_image'] = $name_thumb;  
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = TABLE_SUB_CATEGORY_UPLOAD.$name1;
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
                            
 
        
                              

          // $id = $this->model_sub_category->insert("category", $val);

           $this->model_sub_category->update("product_bunch", $val, "product_bunch_id=" . $id);

             $this->session->set_flashdata('success', 'Sub Category Updated successfully');

           redirect("sub_category_list");  
 
    }


   
    public function sub_category_edit()
    {

        $getvar = $this->input->get();
        $product_bunch_id = urldecode($this->general->decryptData($getvar['product_bunch_id']));
        if (!empty($product_bunch_id)) 
        {
            $fields="*";
            $cond="product_bunch_id=".$product_bunch_id;
            
            $sub_category = $this->model_sub_category->getData("product_bunch", $fields, $cond, $join);            
            $data['sub_category'] = $sub_category;



          $fields="*";       
          $cond="bIsdelete = 0";
          $order_by="category_english_name";
          $category = $this->model_sub_category->getData("category",$fields,$cond,$join,$order_by); 
         $data['category'] = $category;





        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_sub_category", $data);
    }


      function removeImage() 
      {

           $id = $this->input->post('id');           
           if ($id > 0) {
                 $update['product_image'] = "no_image.png";              
                $this->model_sub_category->update("product_bunch", $update, "product_bunch_id=" . $id);
                       }
           return true;
     }
     function delete_sub_category()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['product_bunch_id']));       
        if ($id != '')
         {      

                 // $fields="*";
                 //    $cond="brand_id=".$id;
                    
                 //    $category = $this->model_sub_category->getData("category", $fields, $cond, $join);

                 //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);                                     
          
                $update['bIsdelete'] = "1";              
                $this->model_sub_category->update("product_bunch", $update, "product_bunch_id=" . $id);

              $this->session->set_flashdata('success', 'Sub Category Deleted successfully');

              redirect("sub_category_list");  
        }
     }
   
    

 
    
 
  
}
