<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class consumer extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_consumer');
        $this->load->library('session');
          $this->load->library('image_lib');
    }

      public function consumer_list()
     {
        $fields="*";
        $cond="bIsdelete = 0";
        $order_by="user_id desc";
        $consumer = $this->model_consumer->getData("users",$fields,$cond,$join,$order_by);
         $data['consumer'] = $consumer;

         $this->load->view("consumer_list", $data);
     }



    public function consumer_add()
    {
        $this->load->view("add_consumer");
    }

    public function consumer_action()
    {

                        if($_FILES)
                          {
                                $image_name = $_FILES['image']['name'][0];


                                if ($_FILES['image']['tmp_name'][0]) // is the file uploaded yet?
                                {
                                         $name1=strtotime(date('Y-m-d H:i')).$image_name;
                                        $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                                        $file_name_array = explode('.',$file_name);
                                        $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];
                                        $name1=strtotime(date('Y-m-d H:i')).$image_name;



                                      if (move_uploaded_file($_FILES['image']['tmp_name'][0],"ws/".TABLE_USER_UPLOAD2 .$name1 ) )
                                      {
                                        $val['image'] = $name1;
                                      }
                                }
                            }
                            else
                            {
                              $val['image'] = 'no_image.png';
                            }


                            $passEncoded  = md5($_POST['password']);

                               $main_code =$_POST['main_code'];
                               $area_code =$_POST['area_code'];
                               $cno =$_POST['cno'];

                               $number = $main_code.$area_code.$cno;

                      $fields="*";
                      $cond="bIsdelete = 0 and ucontactno = '".$number."'";
                      $consumer_exist = $this->model_consumer->getData("users",$fields,$cond,$join,$order_by);

                      if($consumer_exist)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("Mobile Number Already Exist");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }

                       $fields="*";
                      $cond="bIsdelete = 0 and uemail = '".$_POST['email']."'";
                      $consumer_exist = $this->model_consumer->getData("users",$fields,$cond,$join,$order_by);

                      if($consumer_exist)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("Email Id is Already Exist");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }





        $val['ufname'] =addslashes($_POST['consumer_name']);
        // $val['uaddress'] = addslashes($_POST['address']);



       $val['ucontactno'] =$number;
       $val['password'] = $passEncoded;
       $val['votp'] = 1;
       $val['vmod'] = 3;
       $val['uemail'] = $_POST['email'];
         // $val['postalcode'] =$_POST['postalcode'];
        $val['ustatus'] = $_POST['status'];


          $id = $this->model_consumer->insert("users", $val);

             $this->session->set_flashdata('success', 'Consumer Added successfully');

           redirect("consumer_list");

    }


    public function consumer_action_edit()
    {
          $postvar = $this->input->post();
          $id = $postvar['id'];


                    if($_FILES)
                    {
                          $image_name = $_FILES['image']['name'][0];


                          if ($_FILES['image']['tmp_name'][0]) // is the file uploaded yet?
                          {
                                   $name1=strtotime(date('Y-m-d H:i')).$image_name;
                                  $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                                  $file_name_array = explode('.',$file_name);
                                  $name_thumb =$file_name_array[0]."_thumb.".$file_name_array[1];
                                  $name1=strtotime(date('Y-m-d H:i')).$image_name;



                                if (move_uploaded_file($_FILES['image']['tmp_name'][0],"ws/".TABLE_USER_UPLOAD2 .$name1 ) )
                                {
                                  $val['image'] = $name1;
                                }
                          }
                      }

                       $main_code =$_POST['main_code'];
                       $area_code =$_POST['area_code'];
                       $cno =$_POST['cno'];

                       $number = $main_code.$area_code.$cno;

                      $fields="*";
                      $cond="bIsdelete = 0 and user_id!= '".$id."' and ucontactno = '".$number."'";
                      $consumer_exist = $this->model_consumer->getData("users",$fields,$cond,$join,$order_by);

                      if($consumer_exist)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("Mobile Number Already Exist");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }

                       $fields="*";
                      $cond="bIsdelete = 0 and user_id!= '".$id."' and uemail = '".$_POST['email']."'";
                      $consumer_exist = $this->model_consumer->getData("users",$fields,$cond,$join,$order_by);

                      if($consumer_exist)
                      {
                        echo '<script type="text/javascript">';
                        echo 'alert("Email Id is Already Exist");';
                        echo "history.go(-1)";
                        echo '</script>';
                        exit();
                      }

                            // $passEncoded  = md5($_POST['password']);



        $val['ufname'] =addslashes($_POST['consumer_name']);
        // $val['uaddress'] = addslashes($_POST['address']);


         $val['ucontactno'] = $number;
        // $val['password'] = $passEncoded;

        $val['uemail'] = $_POST['email'];
         // $val['postalcode'] =$_POST['postalcode'];
        $val['ustatus'] = $_POST['status'];
        $val['votp'] = 1;
       $val['vmod'] = 3;
          // $id = $this->model_consumer->insert("brand", $val);

           $this->model_consumer->update("users", $val, "user_id=" . $id);

             $this->session->set_flashdata('success', 'Consumer Updated successfully');

           redirect("consumer_list");
    }


    public function delete_location() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));

        $where="loc_id =".$loc_id." AND cust_id=".$id;
        $result = $this->model_consumer->delete("location",$where);

        $cust_id=urlencode( $this->general->encryptData($id) );
        redirect("location_customer?cust_id=".$cust_id);

    }
    public function consumer_edit()
    {

        $getvar = $this->input->get();
        $user_id = urldecode($this->general->decryptData($getvar['user_id']));



        if (!empty($user_id))
        {
            $fields="*";
            $cond="user_id=".$user_id;

            $consumer = $this->model_consumer->getData("users", $fields, $cond, $join);

            // echo "<pre>";

            $rest = substr($consumer[0]['ucontactno'],0,4);
            $rest1 = substr($consumer[0]['ucontactno'],4,2);
            $rest2 = substr($consumer[0]['ucontactno'],6,6);
            // var_dump($rest);
            // var_dump($rest1);
            // var_dump($rest2);
            // exit();

            $consumer[0]['main_code'] = $rest;
            $consumer[0]['area_code'] = $rest1;
            $consumer[0]['ucontactno'] = $rest2;
            //get order package

            $data['consumer'] = $consumer;

        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_consumer", $data);
    }

     function address_list()
     {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['user_id']));

        if($id)
        {
            $fields="*";
            $cond="user_id=".$id;
            $consumer = $this->model_consumer->getData("users", $fields, $cond, $join);
            $data['consumer'] = $consumer;

            $fields="*";
            $cond="consumer_id=".$id;
            $address = $this->model_consumer->getData("addressbook", $fields, $cond, $join);
            $data['address'] = $address;

          $this->load->view("address_list", $data);

        }

     }

      function ExportCSV()
      {
           $getvar = $this->input->get();
           $id = urldecode($this->general->decryptData($getvar['user_id']));

           $name = $getvar['name'];

              $this->load->dbutil();
              $this->load->helper('file');
              $this->load->helper('download');
              $delimiter = ",";
              $newline = "\r\n";
              $filename = $id.$name."address.csv";
              $query = "SELECT address_id,consumer_id,address_type,landmarks,address_line,area,city FROM addressbook WHERE consumer_id ='".$id."'";
              $result = $this->db->query($query);

              $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);

              force_download($filename, $data);
      }


     function removeImage()
      {

           $id = $this->input->post('id');
           if ($id > 0) {
                 $update['image'] = "no_image.png";
                $this->model_consumer->update("users", $update, "user_id=" . $id);
                       }
           return true;
     }


     function delete_consumer()
     {
         $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['user_id']));
        if ($id != '')
         {

                 // $fields="*";
                 //    $cond="brand_id=".$id;

                 //    $brand = $this->model_consumer->getData("brand", $fields, $cond, $join);

                 //     unlink(TABLE_BRAND_UPLOAD.$brand[0]['brand_icon']);

                $update['bIsdelete'] = "1";
                $this->model_consumer->update("users", $update, "user_id=" . $id);

              $this->session->set_flashdata('success', 'Consumer Deleted successfully');

              redirect("consumer_list");
        }
     }







}
