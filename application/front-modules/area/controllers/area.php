<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class area extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_area');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function area_list()
     {
          $fields="*";       
          $cond="bIsdelete = 0";
          $order_by="iCity_id";
          $city = $this->model_area->getData("city",$fields,$cond,$join,$order_by); 
          $data['city'] = $city;



        $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="iArea_id desc";
        $area = $this->model_area->getData("area_master",$fields,$cond,$join,$order_by);

         $data['area'] = $area;

          
         

         $this->load->view("area_list", $data);
     }

    public function add_area() 
    { 

        $fields="*";       
        $cond="bIsdelete = 0 and bActive_status = 1";
        $order_by="vCity_name";
        $city = $this->model_area->getData("city",$fields,$cond,$join,$order_by);
 
         $data['city'] = $city;

        $this->load->view("add_area",$data);
    }
   
    public function area_action() 
    {
        $postvar = $this->input->post();    

        $val['vArea_name'] = $postvar['area_name'];       
        $val['iCity_id'] = $postvar['city'];
        $val['status'] = $postvar['status'];        

          $id = $this->model_area->insert("area_master", $val);

          $this->session->set_flashdata('success', 'Area Added successfully');

           redirect("area_list");  
 
    } 


    public function area_action_edit()
    {
          
       $postvar = $this->input->post();    
        $id = $postvar['id'];   
        $val['vArea_name'] = $postvar['area_name'];       
        $val['iCity_id'] = $postvar['city'];
        $val['status'] = $postvar['status'];        

               

          // $id = $this->model_area->insert("category", $val);

           $this->model_area->update("area_master", $val, "iArea_id=" . $id);

             $this->session->set_flashdata('success', 'Area Updated successfully');

           redirect("area_list");  
 
    }


   
    public function edit_area()
    {

        $getvar = $this->input->get();
        $iArea_id = urldecode($this->general->decryptData($getvar['iArea_id']));
        if (!empty($iArea_id)) 
        {
            $fields="*";
            $cond="iArea_id=".$iArea_id;
            
            $area = $this->model_area->getData("area_master", $fields, $cond, $join);            
            $data['area'] = $area;



          $fields="*";       
          $cond="bIsdelete = 0 and bActive_status = 1";
          $order_by="";
          $city = $this->model_area->getData("city",$fields,$cond,$join,$order_by); 
         $data['city'] = $city;

        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_area", $data);
    }


     function delete_area()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['iArea_id']));       
        if ($id != '')
         {      

                 // $fields="*";
                 //    $cond="brand_id=".$id;
                    
                 //    $category = $this->model_area->getData("category", $fields, $cond, $join);

                 //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);                                     
          
                $update['bIsdelete'] = "1";              
                $this->model_area->update("area_master", $update, "iArea_id=" . $id);

              $this->session->set_flashdata('success', 'Area Deleted successfully');

              redirect("area_list");  
        }
     }
   
    

 
    
 
  
}
