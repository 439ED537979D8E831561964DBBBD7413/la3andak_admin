<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class location extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_location');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function location_list()
     {
       $fields="*";       
        $cond="bIsdelete = 0";
        $order_by="location_id desc";
        $locations = $this->model_location->getData("locations",$fields,$cond,$join,$order_by);

         $data['locations'] = $locations;

         $this->load->view("location_list", $data);
     }

    public function location_add() 
    {
        $this->load->view("add_location");
    }
   
    public function location_action() 
    {
        $postvar = $this->input->post();
        // $val['postal_code'] = $postvar['postal_code'];       
        $val['area_name'] = $postvar['area_name'];    
        $val['city_name'] = $postvar['city_name'];       
        $val['state_name'] = $postvar['state_name'];    
        $val['country_name'] = $postvar['country_name'];       
        $val['status'] = $postvar['status'];       


    //     $latitude=0;
    //   $longitude=0;
    //   $prepAddr = str_replace(' ','+',$val['area_name'].", ".$val['city_name'].", ".$val['state_name'].", ".$val['country_name']." - ".$val['postal_code'] );
    // $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyDsYSp0GbeO21wimTZ4NeSRMtCdki0EKlw');
    // $output= json_decode($geocode);
    // if ($output->status=='ZERO_RESULTS')
    //  {
    //   $prepAddr1 = str_replace(' ','+', $val['city_name'].", ".$val['state_name'].", ".$val['country_name']." - ".$val['postal_code'] );
    //   $geocode1=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyDsYSp0GbeO21wimTZ4NeSRMtCdki0EKlw');
    //   $output1= json_decode($geocode1);
    //   if ($output1->status== 'OK')
    //    {
    //     $latitude = $output1->results[0]->geometry->location->lat;
    //     $longitude = $output1->results[0]->geometry->location->lng;
    //   }
    //   else{
    //     $latitude=0;
    //     $longitude=0;
    //   }
    // }
    // else if ($output->status== 'OK') {
    //   $latitude = $output->results[0]->geometry->location->lat;
    //   $longitude = $output->results[0]->geometry->location->lng;
    // }
    // else{
    //   $latitude=0;
    //   $longitude=0;
    // }
    //     $val['latitude'] = $latitude;       
    //     $val['longitude'] = $longitude;  
                          
          $id = $this->model_location->insert("locations", $val);

             $this->session->set_flashdata('success', 'Locations Added successfully');

           redirect("location_list");  
 
    } 


    public function location_action_edit()
    {
          $postvar = $this->input->post();
          $id = $postvar['id']; 

          // $val['postal_code'] = $postvar['postal_code'];       
          $val['area_name'] = $postvar['area_name'];    
          $val['city_name'] = $postvar['city_name'];       
          $val['state_name'] = $postvar['state_name'];    
          $val['country_name'] = $postvar['country_name'];       
          $val['status'] = $postvar['status'];     

    //   $latitude=0;
    //   $longitude=0;
    //   $prepAddr = str_replace(' ','+',$val['area_name'].", ".$val['city_name'].", ".$val['state_name'].", ".$val['country_name']." - ".$val['postal_code'] );
    // $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyDsYSp0GbeO21wimTZ4NeSRMtCdki0EKlw');
    // $output= json_decode($geocode);
    // if ($output->status=='ZERO_RESULTS')
    //  {
    //   $prepAddr1 = str_replace(' ','+', $val['city_name'].", ".$val['state_name'].", ".$val['country_name']." - ".$val['postal_code'] );
    //   $geocode1=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=AIzaSyDsYSp0GbeO21wimTZ4NeSRMtCdki0EKlw');
    //   $output1= json_decode($geocode1);
    //   if ($output1->status== 'OK')
    //    {
    //     $latitude = $output1->results[0]->geometry->location->lat;
    //     $longitude = $output1->results[0]->geometry->location->lng;
    //   }
    //   else{
    //     $latitude=0;
    //     $longitude=0;
    //   }
    // }
    // else if ($output->status== 'OK') {
    //   $latitude = $output->results[0]->geometry->location->lat;
    //   $longitude = $output->results[0]->geometry->location->lng;
    // }
    // else{
    //   $latitude=0;
    //   $longitude=0;
    // }
    //     $val['latitude'] = $latitude;       
    //     $val['longitude'] = $longitude;  

        // var_dump($id);
        // var_dump($val);
        // exit();

           $this->model_location->update("locations", $val, "location_id=" . $id);

             $this->session->set_flashdata('success', 'Location Updated successfully');

           redirect("location_list");  
    }


   
    public function location_edit()
    {

        $getvar = $this->input->get();
        $location_id = urldecode($this->general->decryptData($getvar['location_id']));
        if (!empty($location_id)) 
        {
            $fields="*";
            $cond="location_id=".$location_id;
            
            $locations = $this->model_location->getData("locations", $fields, $cond, $join);
            //get order package
           
            $data['location'] = $locations;
        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_location", $data);
    }

    
     function delete_location()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['location_id']));       
        if ($id != '')
         {      

                 // $fields="*";
                 //    $cond="brand_id=".$id;
                    
                 //    $locations = $this->model_location->getData("locations", $fields, $cond, $join);

                 //     unlink(TABLE_CATEGORY_UPLOAD.$locations[0]['brand_icon']);                                     
          
                $update['bIsdelete'] = "1";              
                $this->model_location->update("locations", $update, "location_id=" . $id);

              $this->session->set_flashdata('success', 'Locations Deleted successfully');

              redirect("location_list");  
        }
     }
   
    

 
    
 
  
}
