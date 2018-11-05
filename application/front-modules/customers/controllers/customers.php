<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customers');
        $this->load->library('session');
    }

           public function manage_customers()
     {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));

        if ($id != '')
         {
            $update['isDelete'] = "1";
           // $update['dtModifyDate'] = date("Y-m-d H:i:s");
            $this->model_customers->update("customer", $update, "cust_id=" . $id);               



         

         $order_deatils = $this->model_customers->getData("customer","","cust_id=" . $id );
        
                $email=$order_deatils[0]['email'];
                //$email="ravijethva88@gmail.com";
                $this->load->library('email');
                $this->email->from("ravijethva88@gmail.com", "Myst");
                $this->email->to($email);
                $this->email->subject("Myst Order");
                  
                  $message='We are sorry to see you go';
                

            $image_url= $this->config->item("upload_url") ;
           

                $html='<table align="center" style="background-color:#ffffff;">';
                $html.='<tr style="background-color:#575CFF; width:575px;height:70px">';
                $html.='<td width="575" align="center"><img src="'.$image_url.'/images/logo.png"  height="30px">';
                $html.='</td>';
                $html.='</tr>';
                $html.='<tr>';
                $html.='<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">'.$message.'</h3>';
                $html.='</td>';
                $html.='</tr>';
               
                
                $html.='<tr>';
                $html.='<td align="center">';
                $html.='<p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: -0.13px;line-height: 30px;">
                    Your acount has been successfully deleted.<br>Please let us know how we can improve our<br>services by replying to this email or sending an email to:<br> <strong>support@mystwash.com</strong><br><br>Best,<br>Myst Wash Team</p>';
                $html.='</td>';
                $html.='</tr>';
                
                $html.='</table>';
                $html.='<table style="margin-top:25px;" align="center">';
                $html.='<tr>';
                $html.='<td align="center">';
                $html.='<p><a href="#"><img src="'.$image_url.'/images/btn_apple_store.png" width="120px" height="40px"></a>
                        <a href="#"><img src="'.$image_url.'/images/btn_google_play.png" width="120px" height="40px"></a></p>
                        <p style="color:#C1C7CA">Myst Technologies, Inc.</p>
                        <p><a href="#"><img src="'.$image_url.'/images/icon_facebook_White.png"></a>
                            <a href="#"><img src="'.$image_url.'/images/icon_instagram_White.png"></a>
                            <a href="#"><img src="'.$image_url.'/images/icon_twitter_White.png"></a>
                            </p>';
                $html.='</td>';
                $html.='</tr></table>';

                $this->email->message($html);

                $success = $this->email->send();
                
                

                if ($success == "1") {                    
                    //send mail
                } else
                 {
                    //not send mail
                } 

            redirect("manage_customers");
        }

        
        $field = "";
        $where="isDelete=0";
        $rply = $this->model_customers->getData("customer",$field,$where);

        $data['all'] = $rply;
        $this->load->view("customer_list", $data);
    }

    public function add_customer() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $status = $this->general->getEnumValues("customer", "");        
        if ($id != '') {
            $rply = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
            $data['all'] = $rply[0];
        }

        $data['status'] = $status;
        $data['verify'] = $verify;
        $this->load->view("add_customer", $data);
    }
    public function view_customer() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));        
        if ($id != '') {
            $customer = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
            $data['customer'] = $customer[0];
            $orders = $this->model_customers->getData("order", "*", "cust_id ='" . $id . "'");
            $data['orders'] = $orders;
        }
        //echo"<pre>";print_r($data['orders']);echo "</pre>";

       $this->load->view("view_customer", $data);
    }
    public function add_location() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));
        
        if ($id != '') {
            $rply = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
            $data['customer'] = $rply[0];
        }
        if ($loc_id != '') {
            $location = $this->model_customers->getData("location", "*", "loc_id ='" . $loc_id . "'");
            $data['location'] = $location[0];
        }
       
        $this->load->view("add_location", $data);
    }
    public function location_customer() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        if ($id != '') {
            $where="cust_id=".$id;
            $rply = $this->model_customers->getData("location", "*", $where);
            $data['location'] = $rply;
        }
        $customer = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
        $data['customer'] = $customer[0];
        $this->load->view("customer_location_list", $data);
    }
    public function payment_customer() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        if ($id != '') {
            $where="cust_id=".$id;
            $rply = $this->model_customers->getData("payment_methods", "*", $where);
            $data['payments'] = $rply;
        }
        $customer = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
        $data['customer'] = $customer[0];
       
        $this->load->view("customer_payment_list", $data);
    }
    public function vehicles_customer() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        if ($id != '') {
            $where="cust_id=".$id;
            $rply = $this->model_customers->getData("vehicles", "*", $where);
            $data['vehicles'] = $rply;
        }
        $customer = $this->model_customers->getData("customer", "*", "cust_id ='" . $id . "'");
        $data['customer'] = $customer[0];
        //echo "<pre>";print_r($data['vehicles']);echo "</pre>";die();
        $this->load->view("customer_vehicles_list", $data);
    }
    public function customer_action() {
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

        $rply = $this->model_customers->getData("customer", "*", "email ='" . $email . "'");
        $customer = $rply[0];
        if(!empty($customer) && empty($id)){
           $data['all']=$val;
           $data['error']='';
           $this->load->view("add_customer", $data);   
        }else{

            if ($id != '') {
                //$val['dtModifyDate'] = date("Y-m-d H:i:s");
                $this->model_customers->update("customer", $val, "cust_id ='" . $id . "'");
            } else {
                $val['created_on'] = date("Y-m-d H:i:s");
                
                $id=$this->model_customers->insert("customer", $val);


               

                

                   $val = $this->model_customers->getData("customer", "*", "cust_id=" . $id);

                 $email= $val[0]['email'];

                 

                //$email="ravijethva88@gmail.com";
                $this->load->library('email');
                $this->email->from("ravijethva88@gmail.com", "Myst");
                $this->email->to($email);
                $this->email->subject("Myst Order");
                  
                  $message='Welcome to Myst Wash';
                

            $image_url= $this->config->item("upload_url") ;
           

                $html='<table align="center" style="background-color:#ffffff;">';
                $html.='<tr style="background-color:#575CFF; width:575px;height:70px">';
                $html.='<td width="575" align="center"><img src="'.$image_url.'/images/logo.png"  height="30px">';
                $html.='</td>';
                $html.='</tr>';
                $html.='<tr>';
                $html.='<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">'.$message.'</h3>';
                $html.='</td>';
                $html.='</tr>';
               
                
                $html.='<tr>';
                $html.='<td align="center">';
                $html.='<p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: -0.13px;line-height: 30px;">
                    We are excited to have you as a new member.<br>Explore our wash packages, place an order, and<br>experience the myst clean.<br><br>If you have any questions,<br>contact one of our representatives:<strong> (818) 858-8158</strong><br>or send us an email <strong>support@mystwash.com</strong></p>';
                $html.='</td>';
                $html.='</tr>';
                
                $html.='</table>';
                $html.='<table style="margin-top:25px;" align="center">';
                $html.='<tr>';
                $html.='<td align="center">';
                $html.='<p><a href="#"><img src="'.$image_url.'/images/btn_apple_store.png" width="120px" height="40px"></a>
                        <a href="#"><img src="'.$image_url.'/images/btn_google_play.png" width="120px" height="40px"></a></p>
                        <p style="color:#C1C7CA">Myst Technologies, Inc.</p>
                        <p><a href="#"><img src="'.$image_url.'/images/icon_facebook_White.png"></a>
                            <a href="#"><img src="'.$image_url.'/images/icon_instagram_White.png"></a>
                            <a href="#"><img src="'.$image_url.'/images/icon_twitter_White.png"></a>
                            </p>';
                $html.='</td>';
                $html.='</tr></table>';

                $this->email->message($html);

                $success = $this->email->send();

                // var_dump($success);
                // exit();

                  if ($success == "1") {                    
                    //send mail
                } else
                 {
                    //not send mail
                } 

            }
                redirect("manage_customers");
        }
    } 
    public function delete_location() {
        $getvar = $this->input->get();        
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));

        $where="loc_id =".$loc_id." AND cust_id=".$id;
        $result = $this->model_customers->delete("location",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("location_customer?cust_id=".$cust_id);

    }
    public function delete_payment() {
        $getvar = $this->input->get();        
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $pay_id = urldecode($this->general->decryptData($getvar['pay_id']));

        $where="pay_id =".$pay_id." AND cust_id=".$id;
        $result = $this->model_customers->delete("payment_methods",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("payment_customer?cust_id=".$cust_id);

    }
    public function delete_vehicle() {
        $getvar = $this->input->get();        
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $veh_id = urldecode($this->general->decryptData($getvar['veh_id']));

        $where="veh_id =".$veh_id." AND cust_id=".$id;
        $result = $this->model_customers->delete("vehicles",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("vehicles_customer?cust_id=".$cust_id);

    }
    

    public function payment_add() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];        
        $val['holder_name'] = $postvar['holder_name'];
        $pay_id = $postvar['pay_id'];
        $val['card_no'] = $postvar['card_no'];
        $val['cvv'] = $postvar['cvv'];    
        $val['exp_year'] = $postvar['exp_year'];            
        $val['cust_id'] = $id;  
        
        if (!empty($pay_id)) {
            $this->model_customers->update("payment_methods", $val, "pay_id ='" . $pay_id . "'");
            $data['message']="Payment menthod updated successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        } else {
            $this->model_customers->insert("payment_methods", $val);
            $data['message']="Payment method added successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        }        
        $data['message']="Somethinng went wrong. Please try again later.";
        $data['status']=1;
        die(json_encode($data)); 
        
    }
    public function get_payment() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];        
        $pay_id = urldecode($this->general->decryptData($postvar['pay_id']));
        $payment = $this->model_customers->getData("payment_methods", "*", "pay_id ='" . $pay_id . "'");
        if(!empty($payment)){            
            $data['message']="Payment method found.";
            $data['status']=1;
            $data['payment'] = $payment[0];
            die(json_encode($data)); 
        }else{
            $data['message']="Somethinng went wrong. Please try again later.";
            $data['status']=0;
            $data['payment'] = '';
            die(json_encode($data)); 
        }
    }
    public function get_vehicle() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];        
        $veh_id = urldecode($this->general->decryptData($postvar['veh_id']));
        $vehicle = $this->model_customers->getData("vehicles", "*", "veh_id ='" . $veh_id . "'");
        if(!empty($vehicle)){            
            $data['message']="Vehicle found.";
            $data['status']=1;
            $data['vehicle'] = $vehicle[0];
            die(json_encode($data)); 
        }else{
            $data['message']="Somethinng went wrong. Please try again later.";
            $data['status']=0;
            $data['vehicle'] = '';
            die(json_encode($data)); 
        }
    }
     public function vehicle_add() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];        
        $val['type'] = $postvar['type'];
        $veh_id = $postvar['veh_id'];
        $val['model_year'] = $postvar['model_year'];
        $val['make'] = $postvar['make'];    
        $val['model'] = $postvar['model'];    
        $val['color'] = $postvar['color'];    
        $val['license_plate_no'] = $postvar['license_plate_no'];        
        $val['cust_id'] = $id;  
       
        
        if (!empty($veh_id)) {
            $this->model_customers->update("vehicles", $val, "veh_id ='" . $veh_id . "'");
            $data['message']="vehicle updated successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        } else {
            $this->model_customers->insert("vehicles", $val);
            $data['message']="vehicle added successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        }
        //$cust_id=urlencode( $this->general->encryptData($id) );
        //redirect("location_customer?cust_id=".$cust_ihd);
        $data['message']="Somethinng went wrong. Please try again later.";
        $data['status']=0;
        die(json_encode($data)); 
        
    }
    public function location_add() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];        
        $val['fullname'] = $postvar['fullname'];
        $loc_id = $postvar['loc_id'];
        $val['loc_type'] = $postvar['loc_type'];
        $val['street'] = $postvar['street'];    
        $val['unit'] = $postvar['unit'];    
        $val['city'] = $postvar['city'];    
        $val['state'] = trim($postvar['state']);            
        $val['zipcode'] = $postvar['zipcode'];
        $val['instruction'] = $postvar['instruction'];
        
        $val['cust_id'] = $id;  
       
        $address = $val['street'].", ".$val['unit'].", ".$val['city'].", ".$val['state'].", ".$val['zipcode'];        
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
        $geo = json_decode($geo, true);        
        if ($geo['status'] = 'OK' && !empty($geo['results'])) {          
          $val['latitude'] = $geo['results'][0]['geometry']['location']['lat'];
          $val['longitude'] = $geo['results'][0]['geometry']['location']['lng'];
        }else{
            $val['latitude'] = '0';  
            $val['longitude'] = '0';  
            /*$data['message']="Please enter valid address.";            
            $data['status']=0;
            die(json_encode($data));*/
        }
        
        
        if (!empty($loc_id)) {
            $this->model_customers->update("location", $val, "loc_id ='" . $loc_id . "'");
            $data['message']="Location updated successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        } else {
            $this->model_customers->insert("location", $val);
            $data['message']="Location added successfully.";
            $data['status']=1;
            die(json_encode($data)); 
        }
        //$cust_id=urlencode( $this->general->encryptData($id) );
        //redirect("location_customer?cust_id=".$cust_ihd);
        $data['message']="Somethinng went wrong. Please try again later.";
        $data['status']=1;
        die(json_encode($data)); 
        
    }
    public function get_location() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];
        //$loc_id = $postvar['loc_id'];
        $loc_id = urldecode($this->general->decryptData($postvar['loc_id']));
        $location = $this->model_customers->getData("location", "*", "loc_id ='" . $loc_id . "'");
        if(!empty($location)){            
            $data['message']="Location found.";
            $data['status']=1;
            $data['location'] = $location[0];
            die(json_encode($data)); 
        }else{
            $data['message']="Somethinng went wrong. Please try again later.";
            $data['status']=0;
            $data['location'] = '';
            die(json_encode($data)); 
        }
    }
    public function location_action() {
        $postvar = $this->input->post();
        $id = $postvar['cust_id'];
        $loc_id = $postvar['loc_id'];
        
        /*$fullname = $postvar['fullname'];
        $loc_type = $postvar['loc_type'];
        $street = $postvar['street'];
        $unit = $postvar['unit'];
        $city = $postvar['city'];
        $state = $postvar['state'];
        $zipcode = $postvar['zipcode'];*/


        $val['fullname'] = $postvar['fullname'];
        $val['loc_type'] = $postvar['loc_type'];
        $val['street'] = $postvar['street'];    
        $val['unit'] = $postvar['unit'];    
        $val['city'] = $postvar['city'];    
        $val['state'] = $postvar['state'];            
        $val['zipcode'] = $postvar['zipcode'];
        $val['cust_id'] = $id;  
       
        $address = $val['street'].", ".$val['unit'].", ".$val['city'].", ".$val['state'].", ".$val['zipcode'];        
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
        $geo = json_decode($geo, true);        
        if ($geo['status'] = 'OK') {          
          $val['latitude'] = $geo['results'][0]['geometry']['location']['lat'];
          $val['longitude'] = $geo['results'][0]['geometry']['location']['lng'];
        }else{
            $val['latitude'] = '';  
            $val['longitude'] = '';  
        }
        

        if ($loc_id != '') {
            $this->model_customers->update("location", $val, "loc_id ='" . $loc_id . "'");
        } else {
            $this->model_customers->insert("location", $val);
        }
        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("location_customer?cust_id=".$cust_ihd);
        
    }   

}
