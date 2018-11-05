<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class payment extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_payment');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function payment_list()
     {
       $fields="*";
        $cond="bIsdelete = 0";
        $order_by="";
        $users = $this->model_payment->getData("users",$fields,$cond,$join,$order_by);

         $data['users'] = $users;

         $this->load->view("payment_list", $data);
     }
     public function daily_payment()
     {
        $this->load->view("daily_payment_list_main", $data);
     }

      public function payment_report_action()
     {
         $postvar = $this->input->post();

         $range=$postvar['range'];
         $events_date=date('Y-m-d', strtotime($postvar['events_date']));
         $events_date1=date('Y-m-d', strtotime($postvar['events_date1']));

         // var_dump($events_date1);
         // exit();

             if($range)
             {
                if($range == "weekly")
                {
                    $fields="*";
                    $date2 = date("Y-m-d H:i:s");
                    $day = 7;
                    $date1 =   (date('Y-m-d H:i:s', strtotime(-$day." days")));

                    // var_dump($date);
                    // var_dump($date1);
                    // exit();

                    $cond="order_date >= '".$date1."' AND  order_date <= '".$date2."' and order_status = 5";
                    $order_by="";
                    $order = $this->model_payment->getData("order",$fields,$cond,$join,$order_by);
                      if(count($order)==0)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("No any Deliver Order Found");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }
                    $data['order'] = $order;
                    $data['start_date'] = $date1;
                    $data['end_date'] = $date2;

                    $this->load->view("daily_payment_list_main", $data);
                }
                elseif ($range == "monthly")
                {
                    $fields="*";
                    $date2 = date("Y-m-d H:i:s");
                    $day = 30;
                    $date1 =   (date('Y-m-d H:i:s', strtotime(-$day." days")));


                    $cond="order_date >= '".$date1."' AND  order_date <= '".$date2."' and order_status = 5";
                    $order_by="";
                    $order = $this->model_payment->getData("order",$fields,$cond,$join,$order_by);
                      if(count($order)==0)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("No any Deliver Order Found");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }
                    $data['order'] = $order;
                    $data['start_date'] = $date1;
                    $data['end_date'] = $date2;
                    $this->load->view("daily_payment_list_main", $data);
                }
                elseif ($range == "quaterly")
                {
                    $fields="*";
                    $date2 = date("Y-m-d H:i:s");
                    $day = 90;
                    $date1 =   (date('Y-m-d H:i:s', strtotime(-$day." days")));


                    $cond="order_date >= '".$date1."' AND  order_date <= '".$date2."' and order_status = 5";
                    $order_by="";
                    $order = $this->model_payment->getData("order",$fields,$cond,$join,$order_by);
                      if(count($order)==0)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("No any Deliver Order Found");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }
                    $data['order'] = $order;

                    $data['start_date'] = $date1;
                    $data['end_date'] = $date2;
                    $this->load->view("daily_payment_list_main", $data);
                }
             }
            else
             {
                $fields="*";
                $date1 = $events_date." "."00:00:00";
                $date2 = $events_date1." "."23:59:59";


                $cond="order_date >= '".$date1."' AND  order_date <= '".$date2."' and order_status = 5";
                $order_by="";
                $order = $this->model_payment->getData("order",$fields,$cond,$join,$order_by);

                // var_dump(count($order));
                // exit();

                if(count($order)==0)
                  {
                    echo '<script type="text/javascript">';
                    echo 'alert("No any Deliver Order Found");';
                    echo "history.go(-1)";
                    echo '</script>';
                    exit();
                  }


                 $data['order'] = $order;
                 $data['start_date'] = $events_date;
                 $data['end_date'] = $events_date1;
                $this->load->view("daily_payment_list_main", $data);
             }

        }


    public function payment_history()
    {

        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['user_id']));

        $fields="*";
        $cond="user_id = $id";
        $order_by="order_id desc";
        $order = $this->model_payment->getData("order",$fields,$cond,$join,$order_by);

        $fields="*";
        $cond="user_id = $id and bIsdelete = 0";
        $order_by="";
        $users = $this->model_payment->getData("users",$fields,$cond,$join,$order_by);

         $data['users'] = $users;

          $data['order'] = $order;

         $this->load->view("payment_history", $data);
    }


    public function brand_edit()
    {

        $getvar = $this->input->get();
        $brand_id = urldecode($this->general->decryptData($getvar['brand_id']));
        if (!empty($brand_id))
        {
            $fields="*";
            $cond="brand_id=".$brand_id;

            $brand = $this->model_payment->getData("brand", $fields, $cond, $join);
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
                $this->model_payment->update("brand", $update, "brand_id=" . $id);
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

                 //    $brand = $this->model_payment->getData("brand", $fields, $cond, $join);

                 //     unlink(TABLE_BRAND_UPLOAD.$brand[0]['brand_icon']);

                $update['bIsdelete'] = "1";
                $this->model_payment->update("brand", $update, "brand_id=" . $id);

              $this->session->set_flashdata('success', 'Brand Deleted successfully');

              redirect("manage_brand");
        }
     }







}
