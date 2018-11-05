<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class city extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_city');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function city_list()
     {
       $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="iCity_id desc";
        $city = $this->model_city->getData("city",$fields,$cond,$join,$order_by);

         $data['city'] = $city;

         $this->load->view("city_list", $data);
     }

    public function city_add() 
    {
        $this->load->view("add_city");
    }
   
    public function city_action() 
    {
        $postvar = $this->input->post();
        $val['vCity_name'] = $postvar['city_name'];       
        $val['bActive_status'] = $postvar['status'];                          

          $id = $this->model_city->insert("city", $val);

          $this->session->set_flashdata('success', 'City Added successfully');
          redirect("city_list"); 
 
    } 


    public function city_action_edit()
    {
          $postvar = $this->input->post();
          $id = $postvar['id'];   
          $val['vCity_name'] = $postvar['city_name'];       
          $val['bActive_status'] = $postvar['status'];          
 
           $this->model_city->update("city", $val, "iCity_id=" . $id);

             $this->session->set_flashdata('success', 'City Updated successfully');

           redirect("city_list");  
    }


    public function delete_location() {
        $getvar = $this->input->get();        
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));

        $where="loc_id =".$loc_id." AND cust_id=".$id;
        $result = $this->model_city->delete("location",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("location_customer?cust_id=".$cust_id);

    }
    public function city_edit()
    {

        $getvar = $this->input->get();
        $city_id = urldecode($this->general->decryptData($getvar['iCity_id']));
        if (!empty($city_id)) 
        {
            $fields="*";
            $cond="iCity_id=".$city_id;
            
            $city = $this->model_city->getData("city", $fields, $cond, $join);
            //get order package
           
            $data['city'] = $city;
        }
         // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_city", $data);
    }


      function removeImage() 
      {

           $id = $this->input->post('id');           
           if ($id > 0) {
                 $update['city_icon'] = "no_image.png";              
                $this->model_city->update("city", $update, "city_id=" . $id);
                       }
           return true;
     }
     function delete_city()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['iCity_id']));       
        if ($id != '')
         {      

                 // $fields="*";
                 //    $cond="city_id=".$id;
                    
                 //    $city = $this->model_city->getData("city", $fields, $cond, $join);

                 //     unlink(TABLE_city_UPLOAD.$city[0]['city_icon']);  

                // var_dump($id);
                // exit();
          
                  $update['bIsdelete'] = "1";              
                  $this->model_city->update("city", $update, "iCity_id=" . $id);


                  $update1['bIsdelete'] = "1";              
                  $this->model_city->update("area_master", $update1, "iCity_id=" . $id);

                  $this->session->set_flashdata('success', 'City Deleted successfully');
              
              redirect("city_list");  
        }
     }
   
    

 
    
 
  
}
