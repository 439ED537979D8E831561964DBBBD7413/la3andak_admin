<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class sloats extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_sloats');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function edit_slots()
     {
       $fields="*";       
        $cond="";
        $order_by="";
        $seller = $this->model_sloats->getData("seller",$fields,$cond,$join,$order_by);
         $data['seller'] = $seller;


         $fields1="*";       
        $cond1="seeting_uniq_name='order_limit'";
        $order_by1="";
        $order = $this->model_sloats->getData("settings",$fields1,$cond1,$join,$order_by1);
         $data['order'] = $order;


        $fields2="*";       
        $cond2="interval_status=1";
        $order_by2="";
        $interval_tab = $this->model_sloats->getData("interval_tab",$fields2,$cond2,$join,$order_by2);

         $data['interval_tab'] = $interval_tab;

        // $charg_sql = $cDB->ExecuteReader("SELECT * from settings WHERE seeting_uniq_name='order_limit'");

         $this->load->view("edit_sloats", $data);
     }

     public function edit_slots_detail()
     {

        // "SELECT * from slots u ORDER BY slot_id";

        $fields="*";       
        $cond="";
        $order_by="";
        $sloats = $this->model_sloats->getData("slots",$fields,$cond,$join,$order_by);
         $data['sloats'] = $sloats;

        $this->load->view("edit_sloats_detail", $data);
     }

     public function ChangeSlotStatus()
     {  
              $status = $this->input->post('status');

             $slot_id = $this->input->post('slot_id');

              if($status==1)
              {
                $status=0;
              }
              else
              {
                $status=1;
              }

              $val['status'] = $status;
               $this->model_sloats->update("slots",$val, "slot_id=" . $slot_id);
     }
     public function Slots_order_limit()
     {
         $id = $this->input->post('id');
         $order_limit = $this->input->post('order_limit');

             $val['order_limit'] = $order_limit;
            $this->model_sloats->update("slots",$val, "slot_id=" . $id);
     }

    public function payment_history() 
    {   

         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['user_id']));   

        $fields="*";       
        $cond="user_id = $id";
        $order_by="order_id desc";
        $order = $this->model_sloats->getData("order",$fields,$cond,$join,$order_by);
        
        $fields="*";       
        $cond="user_id = $id and bIsdelete = 0";
        $order_by="";
        $users = $this->model_sloats->getData("users",$fields,$cond,$join,$order_by);

         $data['users'] = $users;

          $data['order'] = $order;

         $this->load->view("payment_history", $data);
    }
   
    
    public function sloats_action_edit()
    {

        $postvar = $this->input->post();


        $date_modified = date("Y-m-d H:i:s");
        $slot_start_time=trim($postvar['sthours'].':'.$postvar['stmin']);
        $slot_end_time=trim($postvar['endhours'].':'.$postvar['endmin']);
        $interval_min=$postvar['interval_min'];

        
        $break_start_time=trim($postvar['bthours'].':'.$postvar['btmin']);
        $break_end_time=trim($postvar['bendhours'].':'.$postvar['bendmin']);
        $to_time = strtotime($break_start_time);
        $from_time = strtotime($break_end_time);
        $break_miniute= round(abs($to_time - $from_time) / 60,2);

        $val['slot_start_time'] = $slot_start_time;
         $val['slot_end_time'] = $slot_end_time;
          $val['interval_min'] =$interval_min;
           $val['date_modified'] = $date_modified;
            $val['break_start_time'] =$break_start_time ;
             $val['break_end_time'] = $break_end_time;

          $this->model_sloats->update("seller",$val, "seller_id=" . $postvar['seller_id']);


        $interval_min=$interval_min*60;
        $time_slots_array=array();
        $today=date('Y-m-d');
        $current_start_time=date('H:i',strtotime($slot_start_time));
        $current_end_time= date('H:i',strtotime($current_start_time."+".$interval_min." min"));
        $current_start_time_ap_pm=date('h:i A', strtotime($current_start_time));
        $current_end_time_am_pm=date('h:i A', strtotime($current_end_time));
        $this->db->query("TRUNCATE TABLE `slots`");
        $counter=0;

        while ((strtotime($slot_end_time)>=strtotime($current_start_time))) 
        {
            // echo("<pre>");
            // echo "----------------------------------------</br>";
            // echo "</br>current_start_time : ".$current_start_time;
            // echo "</br>current_end_time : ".$current_end_time;
            // echo "</br>break_start_time : ".$break_start_time;
            // echo "</br>break_end_time : ".$break_end_time;
            // echo("</pre>");
            
            if ($counter==0) 
            {   
                $sloat_valp['start_time'] = $current_start_time;
                $sloat_valp['start_end'] = $current_end_time;
                $sloat_valp['slot_time'] =$current_start_time_ap_pm." - ".$current_end_time_am_pm ;
                $sloat_valp['status'] = 1;
                $sloat_valp['prefix'] = 'today';           
                $sloat_valp['order_limit'] =$_POST['order_limit'] ;           
            }
            else
            {
                if (strtotime($current_start_time)>=strtotime($break_start_time) && strtotime($current_end_time)<strtotime($break_end_time)) {
                    $current_end_time=date('H:i',strtotime($break_end_time));
                }
                if (strtotime($current_end_time)>strtotime($break_start_time) && strtotime($current_start_time)<=strtotime($break_start_time)) {
                    $current_end_time=date('H:i',strtotime($break_end_time));
                }
                $current_start_time=date('H:i',strtotime($current_end_time));
                $current_start_time_ap_pm=date('h:i A', strtotime($current_start_time));
                $current_end_time= date('H:i',strtotime($current_start_time."+".$interval_min." min"));
                $current_end_time_am_pm=date('h:i A', strtotime($current_end_time));


                $sloat_valp['start_time'] = $current_start_time;
                $sloat_valp['start_end'] = $current_end_time;
                $sloat_valp['slot_time'] =$current_start_time_ap_pm." - ".$current_end_time_am_pm ;
                $sloat_valp['status'] = 1;
                $sloat_valp['prefix'] = 'today';           
                $sloat_valp['order_limit'] =$_POST['order_limit'] ;
              
            }
            if (strtotime($current_end_time)<=strtotime($slot_start_time)) 
            {
                break;
            }
            if (strtotime($current_start_time)<strtotime($slot_start_time)) 
            {
                break;
            }
            if (strtotime($current_end_time)>strtotime($slot_end_time)) 
            {
                break;
            }

            $counter++;
            $query =$this->model_sloats->insert("slots",$sloat_valp);          
        }

         $this->session->set_flashdata('success', 'Sloats Updated successfully');
            redirect('edit_slots');
    }


      function removeImage() 
      {

           $id = $this->input->post('id');           
           if ($id > 0) {
                 $update['brand_icon'] = "no_image.png";              
                $this->model_sloats->update("brand", $update, "brand_id=" . $id);
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
                    
                 //    $brand = $this->model_sloats->getData("brand", $fields, $cond, $join);

                 //     unlink(TABLE_BRAND_UPLOAD.$brand[0]['brand_icon']);                                     
          
                $update['bIsdelete'] = "1";              
                $this->model_sloats->update("brand", $update, "brand_id=" . $id);

              $this->session->set_flashdata('success', 'Brand Deleted successfully');

              redirect("manage_brand");  
        }
     }
   
    

 
    
 
  
}
