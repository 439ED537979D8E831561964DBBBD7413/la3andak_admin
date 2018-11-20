<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V1 extends MX_Controller {

    private $code;
    private $message;

    public function __construct() {
        parent::__construct();
        error_reporting();
        $this->load->model('model_support');
        $this->load->library('general');
        date_default_timezone_set('Asia/Beirut');
        $image_url = $this->config->item("upload_url");
    }

    public function displaytime() {
        $date = date("Y-m-d H:i:s");
        var_dump($date);
    }

    public function set_notification() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];
        $status = $postvar['status'];

        if ($consumer_id == "" || $status == "") {
            $data = array();
            $msg = "All Data Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $this->db->query("UPDATE users set isNotification = " . $status . " WHERE user_id=" . $consumer_id);
        $data = array();
        $msg = "Notification status update successfully";
        $success = true;
        $this->json_code($msg, $data, $success);
    }

    public function get_location() {
        $postvar = $this->input->get();

        $fields1 = "iCity_id as City_id ,vCity_name as City_name";
        $where = "bIsdelete = 0 and bActive_status=1";
        $city = $this->model_support->getData("city", $fields1, $where);

        // var_dump($city);
        // exit();

        for ($i = 0; $i < count($city); $i++) {
            $fields2 = "iArea_id as Area_id , vArea_name as Area_name , iCity_id as City_id";
            $where = "bIsdelete = 0 and status = 1 and iCity_id = '" . $city[$i]['City_id'] . "'";
            $area = $this->model_support->getData("area_master", $fields2, $where);

            $city[$i]['area'] = $area;
        }

        $msg = "City and Area";
        $success = true;
        $this->json_code($msg, $city, $success);
    }

    public function add_address() {
        $postvar = $this->input->post();


        $consumer_id = $postvar['consumer_id'];
        $consumer_pre_name = $postvar['consumer_pre_name'];
        $address_type = $postvar['address_type'];
        $address_line = $postvar['address_line'];
        $consumer_name = $postvar['consumer_name'];
        $area_name = $postvar['area_name'];
        $city_name = $postvar['city_name'];
        $area_id = $postvar['area_id'];
        $city_id = $postvar['city_id'];
        $landmarks = $postvar['landmarks'];
        $default_address = $postvar['default_address'];
        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($consumer_pre_name == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($address_type == "") {
            $data = array();
            $msg = "Address Type is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($address_line == "") {
            $data = array();
            $msg = "Address Line is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($area_name == "") {
            $data = array();
            $msg = "Area name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($city_name == "") {
            $data = array();
            $msg = "City Name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($city_id == "") {
            $data = array();
            $msg = "City Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($area_id == "") {
            $data = array();
            $msg = "Area Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($landmarks == "") {
            $data = array();
            $msg = "Landmarks Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($consumer_name == "") {
            $data = array();
            $msg = "consumer name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        if (!empty($default_address)) {
            $this->db->query("UPDATE addressbook set default_address=0 WHERE consumer_id=" . $consumer_id);
            $default_address = 1;
        } else {
            $default_address = 0;
        }

        $val['consumer_id'] = $consumer_id;
        $val['consumer_pre'] = $consumer_pre_name;
        $val['address_type'] = $address_type;
        $val['landmarks'] = $landmarks;
        $val['area'] = $area_name;
        $val['area_id'] = $area_id;
        $val['city'] = $city_name;
        $val['city_id'] = $city_id;
        $val['consumer_name'] = $consumer_name;
        $val['address_line'] = $address_line;
        $val['default_address'] = $default_address;

        $id = $this->model_support->insert("addressbook", $val);

        $fields1 = "*";
        $where = "consumer_id = $consumer_id and bIsdelete = 0";
        $address = $this->model_support->getData("addressbook", $fields, $where);

        $msg = "Address added successfully";
        $success = true;
        $this->json_code($msg, $address, $success);
    }

    public function update_address() {
        $postvar = $this->input->post();

        $address_id = $postvar['address_id'];
        $consumer_id = $postvar['consumer_id'];
        $consumer_pre_name = $postvar['consumer_pre_name'];
        $address_type = $postvar['address_type'];
        $address_line = $postvar['address_line'];
        $area_name = $postvar['area_name'];
        $city_name = $postvar['city_name'];
        $area_id = $postvar['area_id'];
        $city_id = $postvar['city_id'];
        $landmarks = $postvar['landmarks'];
        $default_address = $postvar['default_address'];
        $consumer_name = $postvar['consumer_name'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($address_id == "") {
            $data = array();
            $msg = "Address Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($consumer_pre_name == "") {
            $data = array();
            $msg = "Consumer Pre name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($address_type == "") {
            $data = array();
            $msg = "Address Type is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($address_line == "") {
            $data = array();
            $msg = "Address Line is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($area_name == "") {
            $data = array();
            $msg = "Area name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($city_name == "") {
            $data = array();
            $msg = "City Name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($city_id == "") {
            $data = array();
            $msg = "City Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($area_id == "") {
            $data = array();
            $msg = "Area Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($landmarks == "") {
            $data = array();
            $msg = "Landmarks Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($consumer_name == "") {
            $data = array();
            $msg = "consumer name Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        if (!empty($default_address)) {
            $this->db->query("UPDATE addressbook set default_address=0 WHERE consumer_id=" . $consumer_id);
            $default_address = 1;
        } else {
            $default_address = 0;
        }

        $val['consumer_id'] = $consumer_id;
        $val['consumer_pre'] = $consumer_pre_name;
        $val['address_type'] = $address_type;
        $val['landmarks'] = $landmarks;
        $val['area'] = $area_name;
        $val['area_id'] = $area_id;
        $val['city'] = $city_name;
        $val['city_id'] = $city_id;
        $val['consumer_name'] = $consumer_name;
        $val['address_line'] = $address_line;
        $val['default_address'] = $default_address;

        $id = $address_id;
        $where = "address_id =" . $id;
        $id = $this->model_support->update("addressbook", $val, $where);

        if ($id) {
            $fields1 = "*";
            $where = "consumer_id = $consumer_id and bIsdelete = 0";
            $address = $this->model_support->getData("addressbook", $fields, $where);
            $msg = "Address is updated successfully";
            $success = true;
            $this->json_code($msg, $address, $success);
        } else {
            $data = array();
            $msg = "Something Went to Wrong";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function delete_address() {
        $postvar = $this->input->post();

        $address_id = $postvar['address_id'];
        if ($address_id == "") {
            $data = array();
            $msg = "Address Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $val['bIsdelete'] = 1;
        $id = $address_id;
        $where = "address_id =" . $id;
        $id = $this->model_support->update("addressbook", $val, $where);

        if ($id) {
            $address = array();
            $msg = "Address is deleted successfully";
            $success = true;
            $this->json_code($msg, $address, $success);
        } else {
            $data = array();
            $msg = "Something Went to Wrong";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function get_address() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];
        if ($consumer_id == "") {
            $data = array();
            $msg = "User Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields = "*";
        $where = "consumer_id = '" . $consumer_id . "' and bIsdelete = 0";
        $data = $this->model_support->getData("addressbook", $fields, $where);

        if ($data) {
            $msg = "Your Address listing";
            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $data = array();
            $msg = "You have not added a address yet, please add one to place order";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_registration() {
        $postvar = $this->input->post();

        $full_name = $postvar['full_name'];
        $ucontactno = $postvar['ucontactno'];
        $uemail = $postvar['uemail'];
        $password = $postvar['password'];
        $fcm_id = $postvar['fcm_id'];
        $mode = $postvar['mode'];
        if ($full_name == "") {
            $data = array();
            $msg = "Name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($password == "") {
            $data = array();
            $msg = "Password is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($ucontactno == "") {
            $data = array();
            $msg = "Mobile Number is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($uemail == "") {
            $data = array();
            $msg = "Email is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields = "*";
        $where = "bIsdelete = 0 and votp = 1 and ucontactno='" . trim($ucontactno) . "'";
        $users = $this->model_support->getData("users", $fields, $where);

        $fields1 = "*";
        $where1 = "bIsdelete = 0 and votp = 1 and uemail='" . trim($uemail) . "'";
        $users1 = $this->model_support->getData("users", $fields1, $where1);

        if ($users) {
            $data = array();
            $msg = "Mobile Number is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($users1) {
            $data = array();
            $msg = "Email is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields1 = "*";
        $where1 = "bIsdelete = 0 and ucontactno='" . trim($ucontactno) . "' and votp = 0";
        $user_check = $this->model_support->getData("users", $fields1, $where1);

        $fields1 = "*";
        $where3 = "bIsdelete = 0 and uemail='" . trim($uemail) . "' and votp = 0";
        $user_check_email = $this->model_support->getData("users", $fields1, $where3);

        $val['ufname'] = $full_name;
        $val['ucontactno'] = $ucontactno;
        $val['uemail'] = $uemail;
        $val['ustatus'] = 0;
        $val['password'] = md5($password);
        $val['votp'] = 0;
        $val['uniq_user_id'] = $postvar['uniq_user_id'];
        $val['fcm_id'] = $fcm_id;
        $val['vmod'] = $mode;
        $val['timestamp'] = date("Y-m-d H:i:s");

        if ($user_check) {
            $id = $user_check[0]['user_id'];
            $where = "user_id =" . $id;
            $id_updated = $this->model_support->update("users", $val, $where);
        } else if ($user_check_email) {
            $id = $user_check_email[0]['user_id'];
            $where = "user_id =" . $id;
            $id_updated = $this->model_support->update("users", $val, $where);
        } else {
            $id = $this->model_support->insert("users", $val);
        }


        $image_url = $this->config->item("upload_url");




        if (isset($_REQUEST['image']) && !empty($_REQUEST['image'])) {
            if (!empty($_REQUEST['image'])) {
                $name1 = $id . time() . '.png';
                $url = $_REQUEST['image'];
                $path = TABLE_USER_UPLOAD2 . $name1;

                $img = $_POST['image'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);


                if ($url != NULL) {
                    $a = file_put_contents($path, $data);



                    $this->db->query('UPDATE users SET image="' . $name1 . '" WHERE user_id="' . $id . '"');
                }
                // else
                // {
                //     $returnStatus = 0;
                //     $flag = 0;
                //     $msg = "Image Can't Upload.";
                //     $data ='' ;
                //     $response = array(
                //         'status' => $returnStatus,
                //         'msg' => $msg,
                //         'data' => $data
                //     );
                //   echo json_encode($response);exit();
                // }
            }
        }





        // if (isset($postvar['image']) && !empty($postvar['image']))
        // {
        //   if (!empty($postvar['image']))
        //    {
        //       $name1=$postvar['uniq_user_id'].time().'.jpg';
        //       $path = base_url().TABLE_USER_UPLOAD2;
        //       $url = $postvar['image'];
        //       // var_dump($url);
        //       // var_dump($name1);
        //       //exit();
        //       if(file_put_contents($path, file_get_contents($url)))
        //       {
        //          $this->db->query('UPDATE users SET image="'.$name1.'" WHERE user_id="'.$id.'"');
        //          var_dump("expression");
        //          exit();
        //       }
        //       else
        //       {
        //           var_dump("Not Success");
        //           exit();
        //       }
        //   }
        // }
        $fields2 = "*";
        $where2 = "user_id =" . $id;
        $user_Data = $this->model_support->getData("users", $fields2, $where2);

        $image_url = $this->config->item("upload_url");
        $user_Data[0]['image'] = base_url() . TABLE_USER_UPLOAD2 . $user_Data[0]['image'];



        $msg = "Please Verify Otp";
        $success = true;
        $this->json_code($msg, $user_Data, $success);
    }

    // public function verify_otp()
    // {
    //    $postvar = $this->input->post();
    //    $consumer_id = $postvar['consumer_id'];
    //   $fields1 = "*";
    //   $where1  = "bIsdelete = 0 and user_id='".trim($consumer_id)."'";
    //   $user_check = $this->model_support->getData("users", $fields1, $where1);
    //   if($user_check)
    //   {
    //       $val['ustatus'] = 1;
    //       $val['votp'] = 1;
    //       $id =$user_check[0]['user_id'];
    //       $where="user_id =".$id;
    //       $id_updated = $this->model_support->update("users", $val,$where);
    //       $fields1 = "*";
    //       $where1  = "bIsdelete = 0 and user_id='".$id."'";
    //       $user_data = $this->model_support->getData("users", $fields1, $where1);
    //   }
    //   else
    //   {
    //     $data =  array();
    //     $msg = "User is not valid";
    //     $success = false;
    //     $this->json_code($msg,$data,$success);
    //   }
    // }

    public function verify_otp() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];

        $fields1 = "*";
        $where1 = "bIsdelete = 0 and user_id='" . trim($consumer_id) . "'";
        $user_check = $this->model_support->getData("users", $fields1, $where1);

        if ($user_check) {
            $val['ustatus'] = 1;
            $val['votp'] = 1;
            $id = $user_check[0]['user_id'];
            $where = "user_id =" . $id;
            $id_updated = $this->model_support->update("users", $val, $where);

            $fields1 = "*";
            $where1 = "bIsdelete = 0 and user_id='" . $id . "'";
            $user_data = $this->model_support->getData("users", $fields1, $where1);

            $sql = $this->db->query("select * from promocodes where  common = 'YES' AND (always_available='YES' OR promocode_end_date >= '" . date('Y-m-d') . "' )");
            $result = $sql->result_array();

            for ($i = 0; $i < count($result); $i++) {
                $val1['consumer_id'] = $consumer_id;
                $val1['promocode_id'] = $result[$i]['promocode_id'];
                $val1['offers_added_date'] = date('Y-m-d', strtotime(date('Y-m-d')));

                $query123 = $this->model_support->insert("offers", $val1);
            }


            $fields2 = "*";
            $where2 = "user_id =" . $id;
            $user_Data = $this->model_support->getData("users", $fields2, $where2);

            $image_url = $this->config->item("upload_url");
            $user_Data[0]['image'] = base_url() . TABLE_USER_UPLOAD2 . $user_Data[0]['image'];
            // $user_Data[0]['image'] =$image_url."user_images/".$user_Data[0]['image'];


            $email = $user_Data[0]['uemail'];

            $this->load->library('email');
            $this->email->from("support@la3andak.com", "LA3ANDAK");
            $this->email->to($email);
            $this->email->subject("LA3ANDAK Welcome Message");

            $image_url = $this->config->item("upload_url");


            $mail_link_data = $this->model_support->getData("contact_us", "*", "");

            $html = '<table align="center" style="background-color:#f5f5f5;">';
            $html .= '<tr style="background-color:black; width:575px;height:70px">';
            $html .= '<td width="575" align="center"><img src="' . $image_url . '/images/white.png"  height="30px">';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $message . '</h3>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center">
                            <p style="font-family: HelveticaNeue;font-size:25px;color: #4A4A4A;letter-spacing: 0;line-height: 25px;">
                          <b>Hello ' . $user_Data[0]['ufname'] . '<br>Welcome to  LA3ANDAK</b><br/> <br/></p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '    <p style="margin-top:5px;line-height:25px;font-size:20px;">We are excited to have you as a new member.<br>Explore our products, place an order and     <br>
                       enjoy shopping.
                            </p>';


            // $html.='<p style="font-family: SFNSText-Bold;font-size: 18px;color: #4A4A4A;letter-spacing: 0;"><strong>Order Total<br>'.CURRENCY_CONSTANT.'  '.$product_query[0]['grant_total'].'</strong></p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p style="font-family: HelveticaNeue;font-size: 16px;color: #4A4A4A; margin-bottom:25px;margin-top:25px;">
                    If you have any questions,<br/>contact one of our representatives: <strong>' . NUMBER_CONSTANT . '</strong><br/>or send us an email <strong>' . EMAIL_CONSTANT . '</strong></p>';
            $html .= '</td>';
            $html .= '</tr>';

            $html .= '</table>';
            $html .= '<table style="margin-top:25px;" align="center">';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p><a href="' . $mail_link_data[0]['app_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_apple_store.png" width="120px" height="36px"></a>
                        <a href="' . $mail_link_data[0]['play_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_google_play.png" width="120px" height="36px"></a></p>
                        <p style="color:#C1C7CA"><img src="' . $image_url . '/images/2.png" width=80px></p>
                        <p><a href="' . $mail_link_data[0]['fb_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_facebook_White.png"></a>
                            <a href="' . $mail_link_data[0]['insta_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_instagram_White.png"></a>
                            <a href="' . $mail_link_data[0]['twitter_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_twitter_White.png"></a>
                            </p>';
            $html .= '</td>';
            $html .= '</tr></table>';


            $this->email->message($html);



            $success = $this->email->send();

            $msg = "Welcome To La3andak, Enjoy Shopping :)";
            $success = true;
            $this->json_code($msg, $user_data, $success);
        } else {
            $data = array();
            $msg = "User is not valid";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_login() {
        $postvar = $this->input->post();

        $user_name = $postvar['user_name'];
        $password = $postvar['password'];
        $fcm_id = $postvar['fcm_id'];
        $mode = $postvar['mode'];
        $uniq_user_id = $postvar['uniq_user_id'];


        if ($user_name == "") {
            $data = array();
            $msg = "Username is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($uniq_user_id == NULL) {
            $fields2 = "*";
            $where2 = "ustatus=1 AND bIsdelete = 0 AND votp = 1 AND (uemail='" . $user_name . "' OR ucontactno='" . $user_name . "')";
            $check_user_or_not = $this->model_support->getData("users", $fields2, $where2);


            if ($check_user_or_not) {
                $fields2 = "*";
                $where2 = "password='" . md5($password) . "' AND ustatus=1 AND votp = 1 AND bIsdelete = 0 AND (uemail='" . $user_name . "' OR ucontactno='" . $user_name . "')";
                $user_Data = $this->model_support->getData("users", $fields2, $where2);
            } else {
                $data = array();
                $msg = "Please Register First.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        }
        if ($uniq_user_id != NULL) {
            $fields2 = "*";
            $where2 = "ustatus=1 AND bIsdelete = 0 AND uemail='" . $user_name . "'";
            $check_user_or_not = $this->model_support->getData("users", $fields2, $where2);

            if ($check_user_or_not) {
                $fields2 = "*";
                $where2 = "ustatus=1 AND votp = 1 AND bIsdelete = 0 AND uemail='" . $user_name . "'";
                $user_Data = $this->model_support->getData("users", $fields2, $where2);
            } else {
                $data = array();
                $msg = "Please Register First.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        }


        $image_url = $this->config->item("upload_url");

        // var_dump($image_url."user_images/");
        // exit();

        if ($user_Data) {
            $id = $user_Data[0]['user_id'];
            $where = "user_id =" . $id;
            $val['vmod'] = $mode;
            $val['fcm_id'] = $fcm_id;
            $id_updated = $this->model_support->update("users", $val, $where);
            $user_Data[0]['image'] = base_url() . TABLE_USER_UPLOAD2 . $user_Data[0]['image'];
            // $user_Data[0]['image'] = $image_url."user_images/".$user_Data[0]['image'];
            $msg = "Login successfully";
            $success = true;
            $this->json_code($msg, $user_Data, $success);
        } else {
            $data = array();
            $msg = "Invalid Credential";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function customer_forgot_password() {
        $postvar = $this->input->post();
        $email = $postvar['email'];

        if ($email == "") {
            $data = array();
            $msg = "Email is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $rply = $this->model_support->getData("users", "*", "uemail='" . $email . "' and bIsdelete = 0 and ustatus =1 ");

        if ($rply) {
            $id = $rply[0]['user_id'];

            // var_dump($id);


            $encid = $this->general->encryptData($id);
            $config = Array('mailtype' => 'html');

            $this->load->library('email');
            $this->email->from("support@la3andak.com", "LA3ANDAK");
            $this->email->to($email);
            $this->email->subject("LA3ANDAK Reset Password");




            $url = $this->config->item("site_url") . "content/reset_password/?uid=" . $encid;

            /* $msg = '<center><h2>Need to reset your password?</h2><p>We have received a request to reset your password. You can
              change your password by hitting the button below.</p></br> <a href="'.$url.'">Reset Password</a><>' ;
             */
            //  $msg = 'Need to reset your password?We have received a request to reset your password. You can

            $mail_link_data = $this->model_support->getData("contact_us", "*", "");

            //    change your password by hitting the button below.</br>'.$url ;
            $image_url = $this->config->item("upload_url");
            $message = "Need to reset your password?";
            $content = "We have received a request to reset your password. You can <br> change your password by hitting the button below.";
            //header
            $html = '<table align="center" style="background-color:#f5f5f5;">';
            $html .= '<tr style="background-color:black; width:100%;height:70px">';
            $html .= '<td width="575" align="center"><img src="' . $image_url . '/images/white.png"  height="30px">';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $message . '</h3>';
            $html .= '</td>';
            $html .= '</tr>';
            //content
            $html .= '<tr>';
            $html .= '<td align="center"><p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;
            letter-spacing: -0.13px;line-height: 30px;">' . $content . '<br><br>
            <a href="' . $url . '"><img src="' . $image_url . '/images/btn_reset_password.png"  height="55px" width="330px;"></a></p>';
            $html .= '</td>';
            $html .= '</tr>';



            // footer
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p style="font-family: HelveticaNeue;font-size: 16px;color: #4A4A4A; margin-bottom:25px;">
                    If you have any questions,<br/>contact one of our representatives: <strong>' . NUMBER_CONSTANT . '</strong><br/>or send us an email <strong>' . EMAIL_CONSTANT . '</strong></p>';
            $html .= '</td>';
            $html .= '</tr>';


            $html .= '</table>';
            $html .= '<table style="margin-top:25px;" align="center">';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p><a href="' . $mail_link_data[0]['app_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_apple_store.png" width="120px" height="36px"></a>
                        <a href="' . $mail_link_data[0]['play_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_google_play.png" width="120px" height="36px"></a></p>
                        <p style="color:#C1C7CA"><img src="' . $image_url . '/images/2.png" width=80px></p>
                        <p><a href="' . $mail_link_data[0]['fb_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_facebook_White.png"></a>
                            <a href="' . $mail_link_data[0]['insta_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_instagram_White.png"></a>
                            <a href="' . $mail_link_data[0]['twitter_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_twitter_White.png"></a>
                            </p>';
            $html .= '</td>';
            $html .= '</tr></table>';




            $this->email->message($html);

            $success = $this->email->send();
            if ($success) {
                $data = array();
                $msg = "Please Check Your Mail We sent a Link in your mail";
                $success = true;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Email is Not Found";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function shopbycat_get_cat() {
        $postvar = $this->input->post();
        $brand_flag = $postvar['brand_flag'];
        if ($brand_flag == "") {
            $data = array();
            $msg = "Brand Flag is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        //0 for Category

        if ($brand_flag == 0) {
            $fields = "*";
            $where = "bIsdelete = 0 and category_status = 1";
            $data = $this->model_support->getData("category", $fields, $where);


            $image_url = $this->config->item("upload_url");


            if ($data) {
                $main_data = array();

                for ($i = 0; $i < count($data); $i++) {

                    $count = 0;

                    $fields = "*";
                    $where = "bIsdelete = 0 and product_status = 1 and subproduct_id = 0 and product_category='" . $data[$i]['category_id'] . "'";
                    $main_cat_count = $this->model_support->getData("product", $fields, $where);

                    $count = (count($main_cat_count));


                    $category[$i]['category_id'] = $data[$i]['category_id'];
                    $category[$i]['category_name'] = $data[$i]['category_english_name'];
                    $category[$i]['category_icon'] = $data[$i]['category_icon'];
                    $category[$i]['category_icon_path'] = $image_url . "category_images/" . $data[$i]['category_icon'];
                    $category[$i]['product_count'] = $count;


                    // var_dump($category);
                    // exit();


                    $fields = "*";
                    $where = "bIsdelete = 0 and product_category=" . $category[$i]['category_id'] . " and product_status = 1";
                    $sub_cat = $this->model_support->getData("product_bunch", $fields, $where);


                    $subcat = array();

                    for ($j = 0; $j < count($sub_cat); $j++) {
                        $tmp['sub_cat_id'] = $sub_cat[$j]['product_bunch_id'];
                        $tmp['sub_cat_name'] = $sub_cat[$j]['productbunch_english_name'];
                        $tmp['cat_id'] = $sub_cat[$j]['product_category'];
                        $tmp['sub_cat_description'] = mb_convert_encoding($sub_cat[$j]['product_description'], 'utf-8');
                        $tmp['sub_cat_image'] = $image_url . "sub_category_images/" . $sub_cat[$j]['product_image'];
                        array_push($subcat, $tmp);
                    }


                    $category[$i]['sub_cat'] = $subcat;

                    array_push($main_data, $category[$i]);
                }

                $msg = "Category Available!";
                $success = true;
                $this->json_code($msg, $main_data, $success);
            } else {
                $data = array();
                $msg = "Category not available!";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        }
        //1 for Brand

        if ($brand_flag == 1) {
            $fields = "brand_id as category_id,brand_name as category_name ,brand_icon as category_icon";
            $where = "bIsdelete = 0 and brand_status = 1";
            $data = $this->model_support->getData("brand", $fields, $where);

            $image_url = $this->config->item("upload_url");

            if ($data) {
                $main_data = array();
                for ($i = 0; $i < count($data); $i++) {
                    $count = 0;
                    $fields = "*";
                    $where = "bIsdelete = 0 and product_status = 1 and  subproduct_id = 0 and product_brand_id='" . $data[$i]['category_id'] . "'";
                    $main_cat_count = $this->model_support->getData("product", $fields, $where);

                    $count = (count($main_cat_count));


                    $category['category_id'] = $data[$i]['category_id'];
                    $category['category_name'] = $data[$i]['category_name'];
                    $category['category_icon'] = $data[$i]['category_icon'];
                    $category['category_icon_path'] = $image_url . "brand_images/" . $data[$i]['category_icon'];
                    $category['product_count'] = $count;

                    $subcat = array();

                    $tmp['sub_cat_id'] = $category['category_id'];
                    $tmp['sub_cat_name'] = $category['category_name'];
                    $tmp['cat_id'] = $category['category_id'];
                    $tmp['sub_cat_description'] = $category['category_name'];
                    ;
                    $tmp['sub_cat_image'] = $image_url . "brand_images/" . $category['category_icon'];
                    array_push($subcat, $tmp);

                    $category['sub_cat'] = $subcat;

                    array_push($main_data, $category);
                }

                $msg = "Brand Available!";
                $success = true;
                $this->json_code($msg, $main_data, $success);
            } else {
                $data = array();
                $msg = "Brand Not Listing!";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Brand Flag is Wrong!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function shopebycategory_get_product_by_sub_category_id() {
        $postvar = $this->input->post();
        $seller_id = $postvar['seller_id'];
        $brand_flag = $postvar['brand_flag'];
        $brand_id = $postvar['brand_id'];
        $sub_cat_id = $postvar['sub_cat_id'];
        $popularity = $postvar['popularity'];
        $brand_ids = $postvar['brand_ids'];
        $discount_id = $postvar['discount_id'];

        if ($seller_id == "") {
            $data = array();
            $msg = "Seller Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($brand_flag == "") {
            $data = array();
            $msg = "Brand Flag is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($brand_flag == 0) {
            if (empty($sub_cat_id)) {
                $data = array();
                $msg = "sub category id is required.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        } else if ($brand_flag == 1) {
            if (empty($brand_id)) {
                $data = array();
                $msg = "Brand id is required.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Someething Went Wrong";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if (isset($seller_id) && !empty($seller_id) && isset($brand_flag)) {
            if (!empty($seller_id) && !empty($sub_cat_id) && $brand_flag == 0) {
                $msg = "Product Listing.";
                $success = true;

                $fields = "product_bunch_id,productbunch_english_name,product_category";
                $where = "bIsdelete = 0 and product_status = 1 and product_bunch_id = '" . $sub_cat_id . "'";
                $sub_cat = $this->model_support->getData("product_bunch", $fields, $where);

                if ($sub_cat) {
                    if (isset($brand_ids) && !empty($brand_ids)) {
                        $brand_ids = explode(',', $brand_ids);
                        $brand_ids = array_unique($brand_ids);
                        $filter_brand = ' AND ( ';
                        $filter_brand_count = 0;
                        foreach ($brand_ids as $brand_ids_key => $brand_ids_value) {
                            if ($filter_brand_count == 0) {
                                $filter_brand .= 'b.brand_id=' . $brand_ids_value . ' ';
                                $filter_brand_count += 1;
                            } else {
                                $filter_brand .= ' OR b.brand_id=' . $brand_ids_value;
                                $filter_brand_count += 1;
                            }
                        }
                        $filter_brand .= ' )';
                    }
                    if (isset($filter_brand) && !empty($filter_brand)) {
                        $filter_where .= $filter_brand;
                    }
                    if (isset($popularity) && !empty($popularity)) {
                        if ($popularity == 1) {
                            $orderby = ' ORDER BY product_order ASC';
                        } else {
                            $orderby = ' ORDER BY product_order DESC';
                        }
                    } else {
                        $orderby = ' ORDER BY p.timestamp DESC';
                    }

                    if (isset($discount_id) && !empty($discount_id)) {
                        $fields = " discount_min,discount_max";
                        $where = "discount_status=1 and discount_id = '" . $discount_id . "'";
                        $discounts = $this->model_support->getData("discounts", $fields, $where);

                        if ($discounts) {
                            $discount_row = mysql_fetch_assoc($discount);
                            $_REQUEST['discount_min'] = $discounts[0]['discount_min'];
                            $_REQUEST['discount_max'] = $discounts[0]['discount_max'];
                        } else {
                            $_REQUEST['discount_min'] = 1;
                            $_REQUEST['discount_max'] = 10;
                        }
                        if (empty($_REQUEST['discount_min'])) {

                            $_REQUEST['discount_min'] = 0;
                        }
                        if (isset($filter_where) && strlen($filter_where) > 1) {

                            $filter_where .= ' AND p.discount_percentage >= ' . $_REQUEST['discount_min'] . ' AND p.discount_percentage <= ' . $_REQUEST['discount_max'];
                        } else {

                            $filter_where = ' AND p.discount_percentage >= ' . $_REQUEST['discount_min'] . ' AND p.discount_percentage <= ' . $_REQUEST['discount_max'];
                        }
                    }



                    $product_sql = $this->db->query("SELECT p.product_id,p.quantity,p.mrp,p.product_english_name as product_name,p.product_description,p.product_image,p.subproduct_id,p.unit_type,p.unit_value,p.max_sale_qty,p.discounted_price,b.brand_name,b.brand_id,u.unit_id,u.display_name FROM product AS p LEFT JOIN brand b ON  (p.product_brand_id=b.brand_id)  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE p.product_bunch=" . $sub_cat_id . " AND p.bIsdelete=0 AND p.subproduct_id=0 AND p.product_status=1  " . $filter_where . "  GROUP BY p.product_id " . $orderby);

                    $image_url = $this->config->item("upload_url");
                    $result = $product_sql->result_array();


                    // if($result==NULL)
                    //   {
                    //        $data = array();
                    //        $msg = "No Product Found";
                    //        $success = true;
                    //        $this->json_code($msg,$data,$success);
                    //   }


                    $main_product = array();
                    for ($i = 0; $i < count($result); $i++) {
                        $product_data['product_id'] = $result[$i]['product_id'];
                        $product_data['quantity'] = $result[$i]['quantity'];
                        $product_data['mrp'] = $result[$i]['mrp'];
                        $product_data['product_name'] = $result[$i]['product_name'];
                        $product_data['product_description'] = $result[$i]['product_description'];
                        $product_data['product_image'] = $image_url . "product_images/" . $result[$i]['product_image'];
                        $product_data['subproduct_id'] = $result[$i]['product_id'];
                        $product_data['unit_type'] = $result[$i]['unit_type'];
                        $product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                        $product_data['discounted_price'] = $result[$i]['discounted_price'];
                        $product_data['brand_name'] = $result[$i]['brand_name'];
                        $product_data['brand_id'] = $result[$i]['brand_id'];
                        $product_data['display_name'] = $result[$i]['display_name'];
                        // $product_data['unit_id']=$result[$i]['unit_id'];

                        $product_data['seller_product_id'] = $result[$i]['product_id'];
                        $product_data['seller_id'] = 1;
                        $product_data['seller_quantity'] = $result[$i]['unit_value'];
                        $product_data['product_price'] = $result[$i]['mrp'];
                        $product_data['actual_price'] = $result[$i]['discounted_price'];
                        $product_data['count_price'] = "";
                        $product_data['count_quantity'] = "";

                        $sub_product_sql = $this->db->query("SELECT  p.product_id as subproduct_id, p.subproduct_id as main_product_id,p.discounted_price as product_price,p.mrp,p.quantity,p.unit_value ,u.display_name  FROM product AS p  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE p.bIsdelete=0 AND p.product_status=1 AND p.subproduct_id=" . $product_data['product_id']);

                        $result1 = $sub_product_sql->result_array();

                        $sub_product = array();
                        if (count($result1) > 0) {
                            $sub_product_data['product_id'] = $result[$i]['product_id'];
                            $sub_product_data['quantity'] = $result[$i]['quantity'];
                            $sub_product_data['mrp'] = $result[$i]['mrp'];
                            $sub_product_data['discounted_price'] = $result[$i]['discounted_price'];
                            $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                            $sub_product_data['subproduct_id'] = $result[$i]['product_id'];
                            $sub_product_data['display_name'] = $result[$i]['display_name'];
                            $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                            $sub_product_data['seller_id'] = 1;
                            $sub_product_data['product_price'] = $result[$i]['mrp'];
                            $sub_product_data['actual_price'] = $result[$i]['discounted_price'];
                            $sub_product_data['seller_quantity'] = $result[$i]['unit_value'];

                            array_push($sub_product, $sub_product_data);

                            for ($j = 0; $j < count($result1); $j++) {
                                $sub_product_data['product_id'] = $result1[$j]['subproduct_id'];
                                $sub_product_data['quantity'] = $result1[$j]['quantity'];
                                $sub_product_data['mrp'] = $result1[$j]['mrp'];
                                $sub_product_data['discounted_price'] = $result1[$j]['product_price'];
                                $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                                $sub_product_data['subproduct_id'] = $result1[$j]['main_product_id'];
                                $sub_product_data['display_name'] = $result1[$j]['display_name'];
                                $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                                $sub_product_data['seller_id'] = 1;
                                $sub_product_data['product_price'] = $result1[$j]['mrp'];
                                $sub_product_data['actual_price'] = $result1[$j]['mrp'];
                                $sub_product_data['seller_quantity'] = $result1[$j]['unit_value'];

                                array_push($sub_product, $sub_product_data);
                            }
                        }

                        if ($sub_product) {
                            $product_data['sub_product_flag'] = true;
                        } else {
                            $product_data['sub_product_flag'] = false;
                        }


                        $product_data['sub_product'] = $sub_product;

                        array_push($main_product, $product_data);
                    }
                    $data['sub_cat_id'] = $sub_cat[0]['product_bunch_id'];
                    $data['sub_cat_name'] = $sub_cat[0]['productbunch_english_name'];
                    $data['cat_id'] = $sub_cat[0]['product_category'];
                    $data['product_info'] = $main_product;


                    $msg = "Category Listing.";
                    $success = true;
                    $this->json_code($msg, $data, $success);
                }
            } else {
                $msg = "Product Listing.";
                $success = true;

                $fields = "brand_id as product_bunch_id,brand_name as productbunch_english_name";
                $where = "bIsdelete = 0 and brand_id = '" . $brand_id . "'";
                $sub_cat = $this->model_support->getData("brand", $fields, $where);

                if ($sub_cat) {
                    $filter_where = '';
                    if (isset($popularity) && !empty($popularity)) {
                        if ($popularity == 1) {
                            $orderby = ' ORDER BY product_order ASC';
                        } else {
                            $orderby = ' ORDER BY product_order DESC';
                        }
                    } else {
                        $orderby = ' ORDER BY p.product_id ASC';
                    }

                    if (isset($discount_id) && !empty($discount_id)) {
                        $fields = " discount_min,discount_max";
                        $where = "discount_status=1 and discount_id = '" . $discount_id . "'";
                        $discounts = $this->model_support->getData("discounts", $fields, $where);

                        if ($discounts) {
                            $discount_row = mysql_fetch_assoc($discount);
                            $_REQUEST['discount_min'] = $discounts[0]['discount_min'];
                            $_REQUEST['discount_max'] = $discounts[0]['discount_max'];
                        } else {
                            $_REQUEST['discount_min'] = 1;
                            $_REQUEST['discount_max'] = 10;
                        }
                        if (empty($_REQUEST['discount_min'])) {

                            $_REQUEST['discount_min'] = 0;
                        }
                        if (isset($filter_where) && strlen($filter_where) > 1) {

                            $filter_where .= ' AND p.discount_percentage >= ' . $_REQUEST['discount_min'] . ' AND p.discount_percentage <= ' . $_REQUEST['discount_max'];
                        } else {

                            $filter_where = ' AND p.discount_percentage >= ' . $_REQUEST['discount_min'] . ' AND p.discount_percentage <= ' . $_REQUEST['discount_max'];
                        }
                    }


                    $product_sql = $this->db->query("SELECT p.product_id,p.quantity,p.mrp,p.product_english_name as product_name,p.product_description,p.product_image,p.subproduct_id,p.unit_type,p.unit_value,p.max_sale_qty,p.discounted_price,b.brand_name,b.brand_id,u.unit_id,u.display_name FROM product AS p LEFT JOIN brand b ON  (p.product_brand_id=b.brand_id)  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE p.product_brand_id=" . $brand_id . " AND p.bIsdelete=0 AND p.subproduct_id=0 AND p.product_status=1 " . $filter_where . " GROUP BY p.product_id " . $orderby);
                    $result = $product_sql->result_array();

                    if ($result == NULL) {
                        $main_product = array();
                        $msg = "No Product Found";
                        $success = true;
                        $data['sub_cat_id'] = $sub_cat[0]['product_bunch_id'];
                        $data['sub_cat_name'] = $sub_cat[0]['productbunch_english_name'];
                        $data['cat_id'] = 0;
                        $data['product_info'] = $main_product;
                        $this->json_code($msg, $data, $success);
                    }


                    $image_url = $this->config->item("upload_url");
                    $main_product = array();
                    for ($i = 0; $i < count($result); $i++) {
                        $product_data['product_id'] = $result[$i]['product_id'];
                        $product_data['quantity'] = $result[$i]['quantity'];
                        $product_data['mrp'] = $result[$i]['mrp'];
                        $product_data['product_name'] = $result[$i]['product_name'];
                        $product_data['product_description'] = $result[$i]['product_description'];
                        $product_data['product_image'] = $image_url . "product_images/" . $result[$i]['product_image'];
                        $product_data['subproduct_id'] = $result[$i]['product_id'];
                        $product_data['unit_type'] = $result[$i]['unit_type'];
                        $product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                        $product_data['discounted_price'] = $result[$i]['discounted_price'];
                        $product_data['brand_name'] = $result[$i]['brand_name'];
                        $product_data['brand_id'] = $result[$i]['brand_id'];
                        $product_data['display_name'] = $result[$i]['display_name'];
                        // $product_data['unit_id']=$result[$i]['unit_id'];

                        $product_data['seller_product_id'] = $result[$i]['product_id'];
                        $product_data['seller_id'] = 1;
                        $product_data['seller_quantity'] = $result[$i]['unit_value'];
                        $product_data['product_price'] = $result[$i]['mrp'];
                        $product_data['actual_price'] = $result[$i]['discounted_price'];
                        $product_data['count_price'] = "";
                        $product_data['count_quantity'] = "";

                        $sub_product_sql = $this->db->query("SELECT  p.product_id as subproduct_id, p.subproduct_id as main_product_id,p.discounted_price as product_price,p.mrp,p.quantity ,u.display_name,p.unit_value  FROM product AS p  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE  p.subproduct_id=" . $product_data['product_id']);

                        $result1 = $sub_product_sql->result_array();

                        $sub_product = array();
                        if (count($result1) > 0) {
                            $sub_product_data['product_id'] = $result[$i]['product_id'];
                            $sub_product_data['quantity'] = $result[$i]['quantity'];
                            $sub_product_data['mrp'] = $result[$i]['mrp'];
                            $sub_product_data['discounted_price'] = $result[$i]['discounted_price'];
                            $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                            $sub_product_data['subproduct_id'] = $result[$i]['product_id'];
                            $sub_product_data['display_name'] = $result[$i]['display_name'];
                            $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                            $sub_product_data['seller_id'] = 1;
                            $sub_product_data['product_price'] = $result[$i]['mrp'];
                            $sub_product_data['actual_price'] = $result[$i]['discounted_price'];
                            $sub_product_data['seller_quantity'] = $result[$i]['unit_value'];

                            array_push($sub_product, $sub_product_data);

                            for ($j = 0; $j < count($result1); $j++) {
                                $sub_product_data['product_id'] = $result1[$j]['subproduct_id'];
                                $sub_product_data['quantity'] = $result1[$j]['quantity'];
                                $sub_product_data['mrp'] = $result1[$j]['mrp'];
                                $sub_product_data['discounted_price'] = $result1[$j]['product_price'];
                                $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                                $sub_product_data['subproduct_id'] = $result1[$j]['main_product_id'];
                                $sub_product_data['display_name'] = $result1[$j]['display_name'];
                                $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                                $sub_product_data['seller_id'] = 1;
                                $sub_product_data['product_price'] = $result1[$j]['product_price'];
                                $sub_product_data['actual_price'] = $result1[$j]['mrp'];
                                $sub_product_data['seller_quantity'] = $result1[$j]['unit_value'];
                                array_push($sub_product, $sub_product_data);
                            }
                        }
                        if ($sub_product) {
                            $product_data['sub_product_flag'] = true;
                        } else {
                            $product_data['sub_product_flag'] = false;
                        }


                        $product_data['sub_product'] = $sub_product;

                        array_push($main_product, $product_data);


                        $data = array();

                        $data['sub_cat_id'] = $sub_cat[0]['product_bunch_id'];
                        $data['sub_cat_name'] = $sub_cat[0]['productbunch_english_name'];
                        $data['cat_id'] = 0;
                        $data['product_info'] = $main_product;
                    }
                    $msg = "Category Listing By Brand.";
                    $success = true;
                    $this->json_code($msg, $data, $success);
                }
            }
        }
    }

    public function get_banners() {

        $fields = "*";
        $where = "bIsdelete = 0 AND default_banner=1 AND (promocode_end_date>='" . date('Y-m-d') . "' OR always_available='YES')";
        $data = $this->model_support->getData("promocodes", $fields, $where);

        $image_url = $this->config->item("upload_url");



        if ($data) {
            $msg = "Banners List!";
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['promocode_image'] = $image_url . "promocode_images/" . $data[$i]['promocode_image'];
            }


            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $msg = "Banners are not Available!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function banner_list() {
        $fields = "*";
        $where = "bIsdelete = 0 AND status=1";
        $data = $this->model_support->getData("banner_list", $fields, $where);

        $image_url = $this->config->item("upload_url");

        if ($data) {
            $msg = "Banners List!";
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['vImage'] = $image_url . "banner_images/" . $data[$i]['vImage'];
            }


            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $msg = "Banners are not Available!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function contact_us() {

        $fields = "*";
        $where = "";
        $data = $this->model_support->getData("contact_us", $fields, $where);


        if ($data) {
            $msg = "Your Contact Detail!";
            $success = true;
            $this->json_code($msg, $data[0], $success);
        } else {
            $msg = "Something Wrong While retriving Data From Database!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function content_management() {

        $fields = "*";
        $where = "";
        $data = $this->model_support->getData("content_management", $fields, $where);


        if ($data) {

            $data1['about_us'] = ($data[0]['about_us']);
            $data1['terms_conditions'] = ($data[0]['terms_conditions']);
            $data1['faq'] = ($data[0]['faq']);

            $msg = "Content Management Detail!";
            $success = true;
            $this->json_code($msg, $data1, $success);
        } else {
            $msg = "Something Wrong While retriving Data From Database!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function get_deleivery_charges($from = "") {

        $fields = "*";
        $where = "seeting_uniq_name='delivery_charge'";
        $data = $this->model_support->getData("settings", $fields, $where);

        $fields = "*";
        $where = "seeting_uniq_name='delivery_amount'";
        $data1 = $this->model_support->getData("settings", $fields, $where);


        if ($data && $data1) {
            $data2['delivery_charge'] = $data[0]['setting_value'];
            $data2['delivery_amount'] = $data1[0]['setting_value'];
            if (!empty($from)) {
                $response = array(
                    'success' => $success,
                    'message' => $msg,
                    'data' => $data2
                );
                return json_encode($response);
            }
            $msg = "Offers for you are!";
            $success = true;
            $this->json_code($msg, $data2, $success);
        } else {
            $msg = "Something Wrong While retriving Data From Database!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function get_my_offers() {
        $postvar = $this->input->post();

        $consumer_id = $postvar['consumer_id'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $query = $this->db->query("SELECT of.*,pc.* FROM  offers of LEFT JOIN promocodes pc ON(pc.promocode_id=of.promocode_id) WHERE pc.bIsdelete = 0 AND (pc.always_available='YES' OR pc.promocode_end_date>= '" . date('Y-m-d') . "' ) AND of.offer_availability=0 AND of.consumer_id= '$consumer_id' Order by pc.timestamp DESC");

        $result = $query->result_array();

        // var_dump($result);
        // exit();

        $image_url = $this->config->item("upload_url");

        if ($result) {
            //$result[0]['promocode_image'] = $image_url."promocode_images/".$result[0]['promocode_image'];
            // var_dump($result);die();
            $msg = "Offers for you are!";
            $success = true;
            $this->json_code($msg, $result, $success);
        } else {
            $data = array();
            $msg = "No offers are available for you right now";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_change_password() {
        $postvar = $this->input->post();
        $old_password = $postvar['old_password'];
        $user_id = $postvar['user_id'];
        $new_password = $postvar['new_password'];

        if ($old_password == "") {
            $data = array();
            $msg = "Old Password is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($user_id == "") {
            $data = array();
            $msg = "User Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($new_password == "") {
            $data = array();
            $msg = "New Password is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields = "*";
        $where = "user_id='" . $user_id . "' and password='" . md5($old_password) . "'";
        $data = $this->model_support->getData("users", $fields, $where);

        if ($data) {
            $val['password'] = md5($new_password);

            $where = "user_id='" . $user_id . "'";
            $result = $this->model_support->update("users", $val, $where);

            if ($result) {
                $where_user = "user_id = '" . $user_id . "'";
                $data = $this->model_support->getData("users", $fields, $where_user);
                $data[0]['password'] = "";
                $msg = "Your password has beem changed successfully";
                $success = true;
                $this->json_code($msg, $data, $success);
            } else {
                $data = array();
                $msg = "Some Error Occured....";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Your old password is worng";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function add_review() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];
        $seller_id = $postvar['seller_id'];
        $order_id = $postvar['order_id'];
        $rating = $postvar['rating'];
        $comments = $postvar['comments'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($seller_id == "") {
            $data = array();
            $msg = "Seller Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($order_id == "") {
            $data = array();
            $msg = "Order Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($rating == "") {
            $data = array();
            $msg = "Rating is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields = "*";
        $where = "consumer_id='" . $consumer_id . "' and seller_id='" . $seller_id . "' and order_id='" . $order_id . "'";
        $data1 = $this->model_support->getData("reviews_ratings", $fields, $where);

        if (count($data1) > 0) {
            $val['rating'] = $rating;
            $val['comments'] = $comments;

            $where = "consumer_id='" . $consumer_id . "' and seller_id='" . $seller_id . "' and order_id='" . $order_id . "'";
            $result = $this->model_support->update("reviews_ratings", $val, $where);

            $data = array();
            $msg = "Rating Updated successfully";
            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $val['rating'] = $rating;
            $val['comments'] = $comments;
            $val['consumer_id'] = $consumer_id;
            $val['seller_id'] = $seller_id;
            $val['order_id'] = $order_id;

            $result = $this->model_support->insert("reviews_ratings", $val);

            $data = array();
            $msg = "Rating added successfully";
            $success = true;
            $this->json_code($msg, $data, $success);
        }
        exit();
    }

    public function check_promocode_availability() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];
        $promocode = $postvar['promocode'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($promocode == "") {
            $data = array();
            $msg = "Promocode is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $sql = $this->db->query("SELECT of.*,pc.* FROM  offers of LEFT JOIN promocodes pc ON(pc.promocode_id=of.promocode_id) (pc.always_available='YES' OR pc.bIsdelete='0' OR pc.promocode_end_date >= '" . date('Y-m-d') . "' ) AND consumer_id=" . $consumer_id . " AND promocode='" . strtoupper($promocode) . "'");
        $result = $sql->result_array();

        if ($result) {
            if ($result[0]['offer_availability'] == 1) {
                $data = array();
                $msg = "You have already used this coupon code.";
                $success = false;
                $this->json_code($msg, $data, $success);
            } else {
                $data = $result;
                $msg = "Coupon Code has been applied.";
                $success = true;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Oops this Coupon code is wrong or this Coupon code is not assigned to you";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function promocode_calculate() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];
        $promocode = $postvar['promocode'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($promocode == "") {
            $data = array();
            $msg = "Promocode is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $sql = $this->db->query("SELECT of.*,pc.* FROM  offers of LEFT JOIN promocodes pc ON(pc.promocode_id=of.promocode_id) WHERE (pc.always_available='YES' OR pc.promocode_end_date >= '" . date('Y-m-d') . "' ) AND consumer_id=" . $consumer_id . " AND promocode='" . strtoupper($promocode) . "'");
        $result = $sql->result_array();

        if ($result) {
            if ($result[0]['offer_availability'] == 1) {
                $data = array();
                $msg = "You have already used this coupon code.";
                $success = false;
                $this->json_code($msg, $data, $success);
            } else {
                $product_ids = $postvar['product_ids'];
                $discounted_prices = $postvar['discounted_prices'];
                $quantity = $postvar['quantity'];

                $product_id_array = (explode(',', $product_ids));

                $discounted_prices_array = (explode(',', $discounted_prices));

                $quantity_array = (explode(',', $quantity));

                if ($result[0]['promocode_type'] == 'Product') {

                    $product_ids = $result[0]['product_ids'];

                    $product_ids_array = (explode(',', $product_ids));

                    $total1 = 0;
                    $total2 = 0;

                    $discounts_main = array();
                    $quantity_main = array();

                    for ($i = 0; $i < count($product_id_array); $i++) {

                        for ($j = 0; $j < count($product_ids_array); $j++) {
                            if ($product_ids_array[$j] == $product_id_array[$i]) {
                                array_push($discounts_main, $discounted_prices_array[$i]);
                                array_push($quantity_main, $quantity_array[$i]);
                            }
                        }
                    }
                    if (count($quantity_main) == 0) {
                        $data = array();
                        $msg = "No any product found for this promo code.";
                        $success = false;
                        $this->json_code($msg, $data, $success);
                    }
                    $price_get = $this->calculation($discounts_main, $quantity_main, $result);
                } elseif ($result[0]['promocode_type'] == 'Category') {
                    $category = array();

                    for ($i = 0; $i < count($product_id_array); $i++) {

                        $fields = "product_category";
                        $where = "product_id='" . $product_id_array[$i] . "' and bIsdelete = 0";
                        $data1 = $this->model_support->getData("product", $fields, $where);

                        array_push($category, $data1);
                    }

                    $category_ids = $result[0]['category_ids'];

                    $category_ids_array = (explode(',', $category_ids));

                    $total1 = 0;
                    $total2 = 0;

                    $discounts_main = array();

                    $quantity_main = array();

                    for ($i = 0; $i < count($category); $i++) {

                        for ($j = 0; $j < count($category_ids_array); $j++) {
                            if ($category_ids_array[$j] == $category[$i][0]['product_category']) {
                                array_push($discounts_main, $discounted_prices_array[$i]);
                                array_push($quantity_main, $quantity_array[$i]);
                            }
                        }
                    }
                    if (count($quantity_main) == 0) {
                        $data = array();
                        $msg = "No any product found for this promo code.";
                        $success = false;
                        $this->json_code($msg, $data, $success);
                    }
                    $price_get = $this->calculation($discounts_main, $quantity_main, $result);

                    // var_dump($price_get);
                    // exit();
                } elseif ($result[0]['promocode_type'] == 'Sub Category') {
                    $product_bunch = array();

                    for ($i = 0; $i < count($product_id_array); $i++) {

                        $fields = "product_bunch";
                        $where = "product_id='" . $product_id_array[$i] . "' and bIsdelete = 0";
                        $data1 = $this->model_support->getData("product", $fields, $where);

                        array_push($product_bunch, $data1);
                    }

                    $sub_category_ids = $result[0]['sub_category_ids'];

                    $sub_category_ids_array = (explode(',', $sub_category_ids));
                    // var_dump($sub_category_ids);
                    // exit();
                    $total1 = 0;
                    $total2 = 0;

                    $discounts_main = array();

                    $quantity_main = array();



                    for ($i = 0; $i < count($product_bunch); $i++) {

                        for ($j = 0; $j < count($sub_category_ids_array); $j++) {
                            if ($sub_category_ids_array[$j] == $product_bunch[$i][0]['product_bunch']) {
                                array_push($discounts_main, $discounted_prices_array[$i]);
                                array_push($quantity_main, $quantity_array[$i]);
                            }
                        }
                    }

                    if (count($quantity_main) == 0) {
                        $data = array();
                        $msg = "No any product found for this promo code.";
                        $success = false;
                        $this->json_code($msg, $data, $success);
                    }

                    $price_get = $this->calculation($discounts_main, $quantity_main, $result);

                    // var_dump($price_get);
                    // exit();
                } elseif ($result[0]['promocode_type'] == 'Normal') {
                    $price = 0;

                    for ($i = 0; $i < count($discounted_prices_array); $i++) {
                        $price = $price + $discounted_prices_array[$i] * $quantity_array[$i];
                    }


                    if ($result[0]['offers_type'] == 'PERCENTAGE') {
                        $price = ($price * $result[0]['offer_value']) / 100;
                        $data['Discounts'] = (float) ($price);
                        $data['Promocode_discount_value'] = $result[0]['offer_value'];
                        $data['Min_cost'] = $result[0]['min_cost'];
                        $data['Promocode_type'] = $result[0]['offers_type'];
                    } else {
                        $data['Discounts'] = $result[0]['offer_value'];
                        $data['Promocode_discount_value'] = $result[0]['offer_value'];
                        $data['Min_cost'] = $result[0]['min_cost'];
                        $data['Promocode_type'] = $result[0]['offers_type'];
                        // return $data;
                    }

                    $price_get = $data;
                }




                $data = $price_get;
                $msg = "Coupon Code has been applied.";
                $success = true;
                $this->json_code($msg, $data, $success);
            }
        } else {
            $data = array();
            $msg = "Oops this Coupon code is wrong or this Coupon code is not assigned to you";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function calculation($discounts_price, $quantity, $result) {
        $total = 0;



        for ($i = 0; $i < count($discounts_price); $i++) {
            $total = $total + $discounts_price[$i] * $quantity[$i];
        }




        if ($result[0]['offers_type'] == 'PERCENTAGE') {

            $price = ($total * $result[0]['offer_value']) / 100;

            $data['Discounts'] = (float) ($price);
            $data['Promocode_discount_value'] = $result[0]['offer_value'];
            $data['Min_cost'] = $result[0]['min_cost'];
            $data['Promocode_type'] = $result[0]['offers_type'];

            return $data;
        } else {
            $main_discount = 0;
            for ($i = 0; $i < count($quantity); $i++) {
                $main_discount = $main_discount + ($quantity[$i]);
            }
            $data['Discounts'] = (float) ($main_discount * $result[0]['offer_value']);
            $data['Promocode_discount_value'] = $result[0]['offer_value'];
            $data['Min_cost'] = $result[0]['min_cost'];
            $data['Promocode_type'] = $result[0]['offers_type'];
            return $data;
        }
    }

    public function promocode_listing() {
        $postvar = $this->input->post();
        $consumer_id = $postvar['consumer_id'];

        if ($consumer_id == "") {
            $data = array();
            $msg = "Consumer Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $sql = $this->db->query("SELECT of.*,pc.* FROM  offers of LEFT JOIN promocodes pc ON(pc.promocode_id=of.promocode_id) WHERE (pc.always_available='YES' OR pc.promocode_end_date >= '" . date('Y-m-d') . "' ) AND offer_availability = 0 AND consumer_id=" . $consumer_id);
        $result = $sql->result_array();

        if ($result) {
            $data = $result;
            $msg = "Coupon Code Listing.";
            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $data = array();
            $msg = "You don't have any Promocodes.....";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_update_profile() {
        $postvar = $this->input->post();
        $user_id = $postvar['user_id'];
        $full_name = $postvar['full_name'];
        $ucontactno = $postvar['ucontactno'];
        $uemail = $postvar['uemail'];
        // $ImageFile = $_FILES['image'];

        if ($user_id == "") {
            $data = array();
            $msg = "User Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($full_name == "") {
            $data = array();
            $msg = "Name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($ucontactno == "") {
            $data = array();
            $msg = "Mobile Number is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($uemail == "") {
            $data = array();
            $msg = "Email is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }



        $fields = "*";
        $where = "bIsdelete = 0 and ustatus = 1 and ucontactno='" . trim($ucontactno) . "' and user_id != '" . $user_id . "'";
        $users = $this->model_support->getData("users", $fields, $where);

        $fields1 = "*";
        $where1 = "bIsdelete = 0 and ustatus = 1 and uemail='" . trim($uemail) . "' and user_id != '" . $user_id . "'";
        $users1 = $this->model_support->getData("users", $fields1, $where1);

        $fields3 = "*";
        $where3 = "bIsdelete = 0 and ustatus = 1 and user_id = '" . $user_id . "'";
        $users3 = $this->model_support->getData("users", $fields3, $where3);

        if ($users3[0]['ucontactno'] != $ucontactno) {
            $data = array();
            $msg = "Please Verify OTP";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        // exit();

        if ($users) {
            $data = array();
            $msg = "Mobile Number is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($users1) {
            $data = array();
            $msg = "Email is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        $val['ufname'] = $full_name;
        $val['ucontactno'] = $ucontactno;
        $val['uemail'] = $uemail;

        $image_url = $this->config->item("upload_url");

        if ($_FILES) {
            $image_name = $_FILES['image']['name'];

            if ($_FILES['image']['tmp_name']) { // is the file uploaded yet?
                $name1 = strtotime(date('Y-m-d H:i')) . $image_name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.', $file_name);
                $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
                $name1 = strtotime(date('Y-m-d H:i')) . $image_name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], TABLE_USER_UPLOAD2 . $name1)) {
                    $val['image'] = $name1;
                }
            }
        }

        $where = "user_id='" . $user_id . "'";
        $result = $this->model_support->update("users", $val, $where);

        if ($result) {
            $fields = "*";
            $where = "bIsdelete = 0 and ustatus = 1 and user_id = '" . $user_id . "'";
            $users = $this->model_support->getData("users", $fields, $where);

            $users[0]['image'] = base_url() . TABLE_USER_UPLOAD2 . $users[0]['image'];
            $msg = "Profile Updated successfully";
            $success = true;
            $this->json_code($msg, $users, $success);
        }
    }

    public function consumer_edit_profile() {
        $postvar = $this->input->post();
        $user_id = $postvar['user_id'];
        $full_name = $postvar['full_name'];
        $ucontactno = $postvar['ucontactno'];
        $uemail = $postvar['uemail'];
        // $ImageFile = $_FILES['image'];

        if ($user_id == "") {
            $data = array();
            $msg = "User Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($full_name == "") {
            $data = array();
            $msg = "Name is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($ucontactno == "") {
            $data = array();
            $msg = "Mobile Number is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($uemail == "") {
            $data = array();
            $msg = "Email is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }



        $fields = "*";
        $where = "bIsdelete = 0 and ustatus = 1 and ucontactno='" . trim($ucontactno) . "' and user_id != '" . $user_id . "'";
        $users = $this->model_support->getData("users", $fields, $where);

        $fields1 = "*";
        $where1 = "bIsdelete = 0 and ustatus = 1 and uemail='" . trim($uemail) . "' and user_id != '" . $user_id . "'";
        $users1 = $this->model_support->getData("users", $fields1, $where1);



        if ($users) {
            $data = array();
            $msg = "Mobile Number is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($users1) {
            $data = array();
            $msg = "Email is already exist";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        $val['ufname'] = $full_name;
        $val['ucontactno'] = $ucontactno;
        $val['uemail'] = $uemail;

        $image_url = $this->config->item("upload_url");

        if ($_FILES) {
            $image_name = $_FILES['image']['name'];

            if ($_FILES['image']['tmp_name']) { // is the file uploaded yet?
                $name1 = strtotime(date('Y-m-d H:i')) . $image_name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.', $file_name);
                $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
                $name1 = strtotime(date('Y-m-d H:i')) . $image_name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], TABLE_USER_UPLOAD2 . $name1)) {
                    $val['image'] = $name1;
                }
            }
        }

        $where = "user_id='" . $user_id . "'";
        $result = $this->model_support->update("users", $val, $where);

        if ($result) {
            $fields = "*";
            $where = "bIsdelete = 0 and ustatus = 1 and user_id = '" . $user_id . "'";
            $users = $this->model_support->getData("users", $fields, $where);

            $users[0]['image'] = base_url() . TABLE_USER_UPLOAD2 . $users[0]['image'];
            $msg = "Profile Updated successfully";
            $success = true;
            $this->json_code($msg, $users, $success);
        }
    }

    public function get_slots_by_vendor_id() {
        $postvar = $this->input->post();
        $date = $postvar['date'];
        $current_time = $postvar['current_time'];

        if ($date == "") {
            $data = array();
            $msg = "Date is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($current_time == "") {
            $data = array();
            $msg = "Time is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $fields = "*";
        $where = "status =1";
        $slots = $this->model_support->getData("slots", $fields, $where);
        if ($slots) {
            $today = date('Y-m-d', strtotime($date));
            $slots_array = array();
            $slots_array1 = array();
            $slots_array2 = array();
            $lastSlotEndTime = "";
            for ($i = 0; $i < count($slots); $i++) {
                $slots[$i]['date'] = date('Y-m-d', strtotime($today));
                if (strtotime($current_time) >= strtotime($slots[$i]['start_end'])) {
                    $slots[$i]['status'] = 0;
                } else if (strtotime($current_time) >= strtotime($slots[$i]['start_time']) && strtotime($current_time) <= strtotime($slots[$i]['start_end'])) {
                    $slots[$i]['status'] = 0;
                }

                array_push($slots_array1, $slots[$i]);
                $slots[$i]['date'] = date('Y-m-d', strtotime($slots[$i]['date'] . ' +1 day'));
                $slots[$i]['prefix'] = 'tomorrow';
                $slots[$i]['status'] = 1;
                array_push($slots_array2, $slots[$i]);
                $lastSlotEndTime = $slots[$i]['start_end'];
            }
            if (strtotime($current_time) < strtotime($lastSlotEndTime)) {
                $slots_array = array_merge($slots_array1, $slots_array2);
            } else {
                $slots_array = $slots_array2;
            }
            $msg = "Sloat Found";
            $success = true;
            $this->json_code($msg, $slots_array, $success);
        } else {
            $data = array();
            $msg = "There is no sloat Found";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function get_filter() {
        $postvar = $this->input->post();
        $category_id = $postvar['category_id'];
        $sub_cat_id = $postvar['sub_cat_id'];

        if (isset($category_id) && !empty($category_id)) {
            $category_id = $category_id;
            if (isset($sub_cat_id) && !empty($sub_cat_id)) {
                $sub_cat_id = $sub_cat_id;
            } else {
                $sub_cat_id = 0;
            }
        }

        $main_data = array();
        // var_dump($category_id);
        // var_dump($sub_cat_id);
        // exit();
        if ($category_id == "0" && $sub_cat_id = "0") {
            $fields = "brand_id,brand_name";
            $where = "bIsdelete = 0 and brand_status = 1";
            $order_by = 'brand_name asc';
            $brand = $this->model_support->getData("brand", $fields, $where, '', $order_by);
            $main_data['brand'] = $brand;



            $fields = "discount_id,discount_name";
            $where = "discount_status=1";
            $discounts = $this->model_support->getData("discounts", $fields, $where);
            $main_data['discounts'] = $discounts;

            $success = true;
            $msg = "Your filter's listing.";

            $this->json_code($msg, $main_data, $success);
        } elseif (!empty($category_id)) {
            if (empty($sub_cat_id)) {
                $fields = "DISTINCT(product_brand_id)";
                $order_by = 'product_english_name asc';
                $where = "bIsdelete = 0 and product_category ='" . $category_id . "'";
                $product = $this->model_support->getData("product", $fields, $where, '', $order_by);



                if ($product) {
                    $brand_ids_array = array();
                    for ($i = 0; $i < count($product); $i++) {
                        $brand_id = $product[$i]['product_brand_id'];

                        array_push($brand_ids_array, $brand_id);
                    }
                    $whereClause = implode(' OR brand_id= ', $brand_ids_array);
                    $fields = "brand_id,brand_name";
                    $where = "bIsdelete = 0 and brand_status=1 and ( brand_id= " . $whereClause . " )";
                    $brand = $this->model_support->getData("brand", $fields, $where);
                    $main_data['brand'] = $brand;
                } else {
                    $main_data['brand'] = "";
                }

                $fields = "discount_id,discount_name";
                $where = "discount_status=1";
                $discounts = $this->model_support->getData("discounts", $fields, $where);
                $main_data['discounts'] = $discounts;


                $msg = "Filter Listing";
                $success = true;
                $this->json_code($msg, $main_data, $success);
            } else {
                $fields = "DISTINCT product_brand_id";
                $where = "bIsdelete = 0 and product_category ='" . $category_id . "'";
                $order_by = 'product_english_name asc';
                $product = $this->model_support->getData("product", $fields, $where, '', $order_by);




                if ($product) {
                    $brand_ids_array = array();
                    for ($i = 0; $i < count($product); $i++) {
                        $brand_id = $product[$i]['product_brand_id'];

                        array_push($brand_ids_array, $brand_id);
                    }

                    $fields = "DISTINCT(product_brand_id)";
                    $order_by = 'product_english_name asc';
                    $where = "bIsdelete = 0 and product_bunch ='" . $sub_cat_id . "'";
                    $product_sub = $this->model_support->getData("product", $fields, $where, '', $order_by);



                    if ($product_sub) {
                        $sub_cat_brand_ids_array = array();
                        $brand1 = array();
                        $brand2 = array();

                        for ($i = 0; $i < count($product_sub); $i++) {
                            $brand_id = $product_sub[$i]['product_brand_id'];

                            array_push($sub_cat_brand_ids_array, $brand_id);
                        }
                        $whereClause = implode(' OR brand_id= ', $brand_ids_array);

                        $fields = "brand_id,brand_name";
                        $order_by = 'brand_name asc';
                        $where = "bIsdelete = 0 and brand_status=1 and ( brand_id= " . $whereClause . " )";
                        $brand = $this->model_support->getData("brand", $fields, $where, '', $order_by);

                        for ($i = 0; $i < count($brand); $i++) {
                            if (in_array($brand[$i]['brand_id'], $sub_cat_brand_ids_array)) {
                                array_push($brand1, $brand[$i]);
                            } else {
                                array_push($brand2, $brand[$i]);
                            }
                        }
                        $main_data['brand'] = array_merge($brand1, $brand2);
                        // $main_data['brand'] = $brand;
                        // var_dump("expression");
                        // exit();
                    } else {
                        $brand_ids_array = array();
                        for ($i = 0; $i < count($product); $i++) {
                            $brand_id = $product[$i]['product_brand_id'];

                            array_push($brand_ids_array, $brand_id);
                        }
                        $whereClause = implode(' OR brand_id= ', $brand_ids_array);
                        $fields = "brand_id,brand_name";
                        $where = "bIsdelete = 0 and brand_status=1 and ( brand_id= " . $whereClause . " )";
                        $order_by = 'brand_name asc';
                        $brand = $this->model_support->getData("brand", $fields, $where, '', $order_by);
                        $main_data['brand'] = $brand;
                    }
                }


                $fields = "discount_id,discount_name";
                $where = "discount_status=1";
                $discounts = $this->model_support->getData("discounts", $fields, $where);
                $main_data['discounts'] = $discounts;
                $msg = "Filter Listing";
                $success = true;
                $this->json_code($msg, $main_data, $success);
            }
        } else {
            $fields = "brand_id,brand_name";
            $where = "bIsdelete = 0 and brand_status = 1";
            $order_by = 'brand_name asc';
            $brand = $this->model_support->getData("brand", $fields, $where, '', $order_by);
            $main_data['brand'] = $brand;

            $fields = "discount_id,discount_name";
            $where = "discount_status=1";
            $discounts = $this->model_support->getData("discounts", $fields, $where);
            $main_data['discounts'] = $discounts;

            $success = true;
            $msg = "Your filter's listing.";

            $this->json_code($msg, $main_data, $success);
        }
    }

    public function search_product() {
        $postvar = $this->input->post();
        $search_words = $postvar['search_words'];

        $product_sql = $this->db->query("SELECT p.product_id,p.quantity,p.mrp,p.product_english_name as product_name,p.product_description,p.product_image,p.subproduct_id,p.unit_type,p.max_sale_qty,p.discounted_price,p.unit_Value,b.brand_name,b.brand_id,u.unit_id,u.display_name FROM product AS p LEFT JOIN brand b ON  (p.product_brand_id=b.brand_id)  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE (p.product_english_name LIKE '%" . $search_words . "%' OR b.brand_name  LIKE '%" . $search_words . "%') AND p.bIsdelete=0 AND p.subproduct_id=0 AND p.product_status=1 ");
        $result = $product_sql->result_array();



        if ($result) {
            $image_url = $this->config->item("upload_url");
            $main_product = array();
            for ($i = 0; $i < count($result); $i++) {
                $product_data['product_id'] = $result[$i]['product_id'];
                $product_data['quantity'] = $result[$i]['quantity'];
                $product_data['mrp'] = $result[$i]['mrp'];
                $product_data['product_name'] = $result[$i]['product_name'];
                $product_data['product_description'] = $result[$i]['product_description'];
                $product_data['product_image'] = $image_url . "product_images/" . $result[$i]['product_image'];
                $product_data['subproduct_id'] = $result[$i]['product_id'];
                $product_data['unit_type'] = $result[$i]['unit_type'];
                $product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                $product_data['discounted_price'] = $result[$i]['discounted_price'];
                $product_data['brand_name'] = $result[$i]['brand_name'];
                $product_data['brand_id'] = $result[$i]['brand_id'];
                $product_data['display_name'] = $result[$i]['display_name'];
                // $product_data['unit_id']=$result[$i]['unit_id'];

                $product_data['seller_product_id'] = $result[$i]['product_id'];
                $product_data['seller_id'] = 1;
                $product_data['seller_quantity'] = $result[$i]['unit_Value'];
                $product_data['product_price'] = $result[$i]['mrp'];
                $product_data['actual_price'] = $result[$i]['discounted_price'];
                $product_data['count_price'] = "";
                $product_data['count_quantity'] = "";

                $sub_product_sql = $this->db->query("SELECT  p.product_id as subproduct_id, p.subproduct_id as main_product_id,p.discounted_price as product_price,p.mrp,p.quantity,p.unit_Value ,u.display_name  FROM product AS p  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE p.bIsdelete=0 AND p.product_status=1 AND  p.subproduct_id=" . $product_data['product_id']);

                $result1 = $sub_product_sql->result_array();

                $sub_product = array();
                if (count($result1) > 0) {
                    $sub_product_data['product_id'] = $result[$i]['product_id'];
                    $sub_product_data['quantity'] = $result[$i]['quantity'];
                    $sub_product_data['mrp'] = $result[$i]['mrp'];
                    $sub_product_data['discounted_price'] = $result[$i]['discounted_price'];
                    $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                    $sub_product_data['subproduct_id'] = $result[$i]['product_id'];
                    $sub_product_data['display_name'] = $result[$i]['display_name'];
                    $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                    $sub_product_data['seller_id'] = 1;
                    $sub_product_data['product_price'] = $result[$i]['mrp'];
                    $sub_product_data['actual_price'] = $result[$i]['discounted_price'];
                    $sub_product_data['seller_quantity'] = $result[$i]['unit_Value'];

                    array_push($sub_product, $sub_product_data);

                    for ($j = 0; $j < count($result1); $j++) {
                        $sub_product_data['product_id'] = $result1[$j]['subproduct_id'];
                        $sub_product_data['quantity'] = $result1[$j]['quantity'];
                        $sub_product_data['mrp'] = $result1[$j]['mrp'];
                        $sub_product_data['discounted_price'] = $result1[$j]['product_price'];
                        $sub_product_data['max_sale_qty'] = $result[$i]['max_sale_qty'];
                        $sub_product_data['subproduct_id'] = $result1[$j]['main_product_id'];
                        $sub_product_data['display_name'] = $result1[$j]['display_name'];
                        $sub_product_data['seller_product_id'] = $result[$i]['product_id'];
                        $sub_product_data['seller_id'] = 1;
                        $sub_product_data['product_price'] = $result1[$j]['mrp'];
                        $sub_product_data['actual_price'] = $result1[$j]['mrp'];
                        $sub_product_data['seller_quantity'] = $result1[$j]['unit_Value'];

                        array_push($sub_product, $sub_product_data);
                    }
                }

                if ($sub_product) {
                    $product_data['sub_product_flag'] = true;
                } else {
                    $product_data['sub_product_flag'] = false;
                }


                $product_data['sub_product'] = $sub_product;

                array_push($main_product, $product_data);
            }
            $msg = "Product Listing";
            $success = true;
            $this->json_code($msg, $main_product, $success);
        } else {
            $data = array();
            $msg = "No such as Product Found";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function order_add() {
        $postvar = $this->input->post();

        /*   $data =  array();
          $msg = "LA3ANDAK IS CLOSED DUE TO HOLIDAY AND WILL BE RESUMING OUR SERVICE ON TOMMORROW
          ENJOY THE HOLIDAY";
          $success = false;
          $this->json_code($msg,$data,$success);
          return; */

        $slot_id = $postvar['slot_id'];
        $delivery_date = $postvar['delivery_date'];

        $flag = $postvar['flag'];
        if ($flag == "") {
            $data = array();
            $msg = "Flag is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        # current time is grater then 9pm and less then 9Am then dont' place instant order
        if (time() > strtotime('21:00:00') || time() < strtotime('9:00:00')) {
            if ($flag == 1) {
                $this->break_order();
            }
        }


        if ($flag == 0) {
            if ($slot_id == "") {
                $data = array();
                $msg = "Sloat id Required";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
            if ($delivery_date = "") {

                $delivery_date = date('Y-m-d');
            } else {

                $delivery_date = date('Y-m-d', strtotime($postvar['delivery_date']));
                //var_dump($delivery_date);die();
            }

            $slot_counter = $this->db->query("SELECT COUNT('o.*') as slot_counter,s.order_limit FROM `order` as o LEFT JOIN slots s ON (s.slot_id=o.slot_id) WHERE DATE(o.delivery_date) = '" . date('Y-m-d', strtotime($delivery_date)) . "' AND  s.slot_id= " . $slot_id);

            $sloat_array = $slot_counter->result_array();

            $order_limit = $sloat_array[0]['order_limit'];
            $slot_counter = $sloat_array[0]['slot_counter'];

            if (empty($order_limit)) {
                $slot_detail = $this->db->query("SELECT s.order_limit FROM slots as s  WHERE s.slot_id= " . $slot_id);
                $slot_detail_array = $slot_detail->result_array();

                $order_limit = $slot_detail_array[0]['order_limit'];
            }

            if ($order_limit <= $slot_counter) {
                $data = array();
                $msg = "Oops limit of order for this time slots is over.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }

            $delivery_time_slot = $postvar['delivery_time_slot'];
            if ($delivery_time_slot == "") {
                $data = array();
                $msg = "delivery time slot is requierd.";
                $success = false;
                $this->json_code($msg, $data, $success);
            }
        }

        $product_id = $postvar['product_id'];
        if ($product_id == "") {
            $data = array();
            $msg = "Product Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $seller_id = $postvar['seller_id'];
        if ($seller_id == "") {
            $data = array();
            $msg = "Seller Id is Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $product_quantity = $postvar['product_quantity'];
        if ($product_quantity == "") {
            $data = array();
            $msg = "Product quantity is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $seller_price = $postvar['seller_price'];
        if ($seller_price == "") {
            $data = array();
            $msg = "Seller Price is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $product_price = $postvar['product_price'];
        if ($product_price == "") {
            $data = array();
            $msg = "Product Price is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $address_id = $postvar['address_id'];
        if ($address_id == "") {
            $data = array();
            $msg = "shipping address is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        $total_price = $postvar['total_price'];
        if ($total_price == "") {
            $data = array();
            $msg = "Total Price is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $grant_total = $postvar['grant_total'];
        if ($grant_total == "") {
            $data = array();
            $msg = "Grand Total is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $user_id = $postvar['user_id'];
        if ($user_id == "") {
            $data = array();
            $msg = "User Id is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        $payment_mode = $postvar['payment_mode'];
        if ($payment_mode == "") {
            $data = array();
            $msg = "payment mode is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $payment_mode = $postvar['payment_mode'];
        if ($payment_mode == "") {
            $data = array();
            $msg = "payment mode is requierd.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        if ($flag == 1) {
            $delivery_time_slot = "Instant Delivery";
            $slot_id = 0;
        }

        $user_data = $this->model_support->getData("users", "*", 'user_id="' . $user_id . '"');


        if ($user_data[0]['ustatus'] == 0) {
            $data = array();
            $msg = "You are block by admin.Please do contact Admin";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        $delivery_charges = $postvar['delivery_charges'];

        if (empty($delivery_charges) || $delivery_charges == 0) {
            $dCharge = $this->get_deleivery_charges("From Order");
            $json = json_decode($dCharge, true);

            if ((int) $json['data']["delivery_amount"] >= (int) $total_price) {
                $delivery_charges = $json['data']["delivery_charge"];
            } else {
                $delivery_charges = 0;
            }
        }

        $promocode = $postvar['promocode'];
        $consumer_number = $postvar['consumer_number'];
        $eg_transaction_id = $postvar['eg_transaction_id'];


        if (empty($promocode)) {
            $promocode = '';
        } else {
            $promocode = $promocode;
        }
        if (empty($consumer_number)) {
            $consumer_number = '';
        } else {
            $consumer_number = $consumer_number;
        }
        if (empty($eg_transaction_id)) {
            $eg_transaction_id = 0;
        } else {
            $eg_transaction_id = $eg_transaction_id;
        }

        if ($payment_mode == 2 && empty($eg_transaction_id)) {
            $data = array();
            $msg = "Please make sure your payment is done successfully or not???.";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $address = $postvar['address'];
        $discount = $postvar['discount'];


        $token1 = substr(md5(uniqid(rand(), true)), 0, 6);
        $order_code = ORDER_CODE_PREFIX . strtoupper($token1);
        $startdate = date("Y-m-d H:i:s");


        // var_dump($delivery_date);
        // exit;

        $val['order_code'] = $order_code;
        $val['delivery_date'] = $delivery_date;
        $val['shipping_address'] = $address;
        $val['total_price'] = $total_price;
        $val['delivery_charge'] = $delivery_charges;
        $val['grant_total'] = $grant_total;
        $val['order_date'] = $startdate;
        $val['payment_mode'] = $payment_mode;
        $val['user_id'] = $user_id;
        $val['order_status'] = 0;
        $val['seller_id'] = $seller_id;
        $val['consumer_number'] = $consumer_number;
        $val['delivery_time_slot'] = $delivery_time_slot;
        $val['promocode'] = $promocode;
        $val['flag'] = $flag;
        $val['address_id'] = $address_id;
        $val['discount'] = $discount;
        $val['slot_id'] = $slot_id;
        $val['eg_transaction_id'] = $eg_transaction_id;
        $val['checkout_comment'] = $postvar['comment'];
        $result = $this->model_support->insert("order", $val);

        if (!empty($promocode)) {
            $rply = $this->model_support->getData("promocodes", "promocode,promocode_id,multiple", 'promocode="' . $promocode . '"');

            if ($rply) {
                if ($rply[0]['multiple'] == 1) {
                    $id = $rply[0]['promocode_id'];
                    $this->db->query('UPDATE offers SET offer_availability=0 WHERE promocode_id="' . $id . '" and consumer_id = "' . $user_id . '"');
                } else {
                    $id = $rply[0]['promocode_id'];
                    $this->db->query('UPDATE offers SET offer_availability=1 WHERE promocode_id="' . $id . '" and consumer_id = "' . $user_id . '"');
                }
            }
        }
        $seller_price_type = $postvar['seller_price_type'];

        $array = (explode(',', $product_id));
        $array1 = (explode(',', $product_quantity));
        $array2 = (explode(',', $seller_price));
        $array3 = (explode(',', $product_price));
        $array4 = (explode(',', $seller_price_type));
        $fetch = array();
        for ($i = 0; $i < count($array); $i++) {
            $fetch[] = array(
                'product_id' => $array[$i],
                'quantity' => $array1[$i],
                'seller_price' => $array2[$i],
                'price' => $array3[$i],
                'seller_price_type' => $array4[$i],
            );
        }
        $info = array();

        foreach ($fetch as $fet) {
            $order['order_code'] = $order_code;
            $order['product_id'] = $fet['product_id'];
            $order['seller_price'] = $fet['seller_price'];
            $order['product_quantity'] = $fet['quantity'];
            $order['product_price'] = $fet['price'];
            $order['seller_price_type'] = $fet['seller_price_type'];

            $order_result = $this->model_support->insert("order_history", $order);

            $product_query = $this->model_support->getData("product", "product_english_name", 'product_id="' . $product_id . '"');

            $main = $this->db->query("UPDATE product SET quantity=quantity-" . $fet['quantity'] . ",product_order=product_order+1 WHERE product_id=" . $fet['product_id']);
            if ($product_query) {

                $product_name = $product_query[0]['product_english_name'];
            } else {
                $product_name = ' ';
            }
            array_push($info, array('product_price' => $fet['price'], 'quantity' => $fet['quantity'], 'product_id' => $fet['product_id'], 'product_name' => $product_name));
        }

        //Mail Part of mail...

        $this->send_email_to_consumer($order_code, $user_id);


        if ($result) {
            $data = array(
                'date' => $delivery_date,
                'order_code' => $order_code,
            );
            $msg = "Your Order Sucessfully Placed";
            $success = true;
            $this->json_code($msg, $data, $success);
        }
    }

    public function break_order() {
        $data = array();
        $msg = "You can not place instant order after 9:00 PM.";
        $success = false;
        $this->json_code($msg, $data, $success);
        return;
    }

    public function send_email_to_consumer($order_code, $user_id) {
        $user_info = $this->model_support->getData("users", "*", 'user_id="' . $user_id . '"');



        $to = $user_info[0]['uemail'];
        $subject = "Your Order Placed successfully \r\n";

        $message = file_get_contents('http://la3andak.com/grocery/content/invoice_mail?order_code=' . $order_code);

        // send  invoice to user
        $this->load->library('email');
        $this->email->from("support@la3andak.com", "LA3ANDAK");
        $this->email->to($to);
        $this->email->subject("New Order Is Placed By User");
        $this->email->message($message);
        $this->email->send();

        // send an invoice to Admin
        $list = array('Bibilama@gmail.com', 'Waelkaakani@live.com', 'Karim.kaakani@gmail.com', 'jadkaakani1@gmail.com');
        $this->load->library('email');
        $this->email->from("support@la3andak.com", "LA3ANDAK");
        $this->email->to($list);
        $this->email->subject("New Order Is Placed By User");
        $this->email->message($message);
        $success = $this->email->send();
    }

    public function cancel_order() {
        $postvar = $this->input->post();

        $user_id = $postvar['user_id'];
        $order_id = $postvar['order_id'];


        if ($user_id == "") {
            $data = array();
            $msg = "User id Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($order_id == "") {
            $data = array();
            $msg = "Order id Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $product_query = $this->model_support->getData("order", "*", "user_id = '" . $user_id . "' AND order_id='" . $order_id . "' AND order_status!=4");
        if ($product_query) {

            if ($product_query[0]['order_status'] == 2) {
                $data = array();
                $msg = "Order is Pending by Admin";
                $success = false;
                $this->json_code($msg, $data, $success);
            }

            if ($product_query[0]['order_status'] == 5) {
                $data = array();
                $msg = "Order is Delivered by Admin";
                $success = false;
                $this->json_code($msg, $data, $success);
            }


            $this->db->query("UPDATE `order`  SET order_status=4, cancel_date='" . date('Y-m-d H:i:s') . "' WHERE user_id=" . $user_id . " AND order_id='" . $order_id . "'");

            $user_data = $this->model_support->getData("users", "*", "user_id = '" . $product_query[0]['user_id'] . "'");


            // $product_query = $this->model_support->getData("order", "*", "user_id = '".$user_id."' AND order_id='".$order_id."'");
            $email = $user_data[0]['uemail'];

            $this->load->library('email');
            $this->email->from("support@la3andak.com", "LA3ANDAK");
            $this->email->to($email);
            $this->email->subject("LA3ANDAK Cancel Order");

            $image_url = $this->config->item("upload_url");

            $order_date = date('M d, Y h:i a', strtotime($product_query[0]['order_date'])); //'January 5, 2017 at 5:00 pm';
            // var_dump($product_query[0]['cancel_date']);
            // exit();
            $mail_link_data = $this->model_support->getData("contact_us", "*", "");

            $html = '<table align="center" style="background-color:#f5f5f5;">';
            $html .= '<tr style="background-color:black; width:575px;height:70px">';
            $html .= '<td width="575" align="center"><img src="' . $image_url . '/images/white.png"  height="30px">';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $message . '</h3>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center">
                            <p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: 0;line-height: 25px;">
                           ' . $user_data[0]['ufname'] . ' ,  Your order for<br/>
                <strong>' . $order_date . '</strong><br/>
                has been Canceled</p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center" style="border-top: 1px solid #E8E8E8;border-bottom: 1px solid #E8E8E8;">';
            $html .= '    <p style="margin-top:15px;">
                            ORDER CODE  :  ' . $product_query[0]['order_code'] . '</p>';


            $html .= '<p style="font-family: SFNSText-Bold;font-size: 18px;color: #4A4A4A;letter-spacing: 0;"><strong>Order Total<br>' . CURRENCY_CONSTANT . '  ' . $product_query[0]['grant_total'] . '</strong></p>';
            $html .= '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p style="font-family: HelveticaNeue;font-size: 16px;color: #4A4A4A; margin-bottom:25px;">
                    If you have any questions,<br/>contact one of our representatives: <strong>' . NUMBER_CONSTANT . '</strong><br/>or send us an email <strong>' . EMAIL_CONSTANT . '</strong></p>';
            $html .= '</td>';
            $html .= '</tr>';

            $html .= '</table>';
            $html .= '<table style="margin-top:25px;" align="center">';
            $html .= '<tr>';
            $html .= '<td align="center">';
            $html .= '<p><a href="' . $mail_link_data[0]['app_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_apple_store.png" width="120px" height="36px"></a>
                        <a href="' . $mail_link_data[0]['play_store_url'] . '" target="_blank"><img src="' . $image_url . '/images/btn_google_play.png" width="120px" height="36px"></a></p>
                        <p style="color:#C1C7CA"><img src="' . $image_url . '/images/2.png" width=80px></p>
                        <p><a href="' . $mail_link_data[0]['fb_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_facebook_White.png"></a>
                            <a href="' . $mail_link_data[0]['insta_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_instagram_White.png"></a>
                            <a href="' . $mail_link_data[0]['twitter_url'] . '" target="_blank"><img src="' . $image_url . '/images/icon_twitter_White.png"></a>
                            </p>';
            $html .= '</td>';
            $html .= '</tr></table>';

            // var_dump($html);
            // exit();
            $this->email->message($html);



            $success = $this->email->send();



            $data = array();
            $msg = "Your Order is canceled successfully.";
            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $data = array();
            $msg = "No such as Order Found";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_last_order_list() {
        $postvar = $this->input->post();

        $user_id = $postvar['user_id'];
        if ($user_id == "") {
            $data = array();
            $msg = "User id Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        $order_list = $this->db->query("SELECT o.*,u.ucontactno,u.ufname,u.ulname,u.ucity,s.* FROM `order` o LEFT JOIN users u ON (o.user_id=u.user_id) LEFT JOIN seller s ON (o.seller_id=s.seller_id) WHERE o.user_id = '" . $user_id . "' AND o.bRecordDelete=0 ORDER BY o.order_date DESC LIMIT 3");
        $order_list_array = $order_list->result_array();

        if ($order_list_array) {
            $now = date('h:i:s', time() - 5);
            $order_info = array();
            for ($i = 0; $i < count($order_list_array); $i++) {
                $rating_sql = $this->db->query("SELECT * FROM reviews_ratings WHERE order_id=" . $order_list_array[$i]['order_id'] . " AND seller_id=" . $order_list_array[$i]['seller_id'] . " AND consumer_id=" . $user_id);

                $rating_sql_array = $rating_sql->result_array();
                if ($rating_sql_array) {
                    $order_info_tmp['review_rating'] = $rating_sql_array[0];
                    $order_info_tmp['flag'] = true;
                } else {
                    $order_info_tmp['review_rating'] = new stdClass();
                    $order_info_tmp['flag'] = false;
                }
                $image_url = $this->config->item("upload_url");

                $order_info_tmp['order_id'] = $order_list_array[$i]['order_id'];
                $order_info_tmp['seller_name'] = $order_list_array[$i]['seller_english_name'];
                $order_info_tmp['seller_shop_name'] = $order_list_array[$i]['seller_shop_name'];
                $order_info_tmp['order_code'] = $order_list_array[$i]['order_code'];
                $order_info_tmp['shipping_address'] = $order_list_array[$i]['shipping_address'];
                $order_info_tmp['billing_address'] = '';
                $order_info_tmp['total_price'] = $order_list_array[$i]['total_price'];
                $order_info_tmp['grant_total'] = $order_list_array[$i]['grant_total'];
                $order_info_tmp['paid'] = $order_list_array[$i]['paid'];
                $order_info_tmp['seller_logo'] = $image_url . "admin_profile/" . $order_list_array[$i]['seller_logo'];
                $order_info_tmp['payment_mode'] = $order_list_array[$i]['payment_mode'];
                $order_info_tmp['order_date'] = $order_list_array[$i]['order_date'];
                $order_info_tmp['order_time'] = date('H:s:i', strtotime($order_list_array[$i]['order_date']));
                $order_info_tmp['pending_date'] = $order_list_array[$i]['pending_date'];
                $order_info_tmp['cancel_date'] = $order_list_array[$i]['cancel_date'];
                $order_info_tmp['confirm_date'] = $order_list_array[$i]['confirm_date'];
                $order_info_tmp['delivered_date'] = $order_list_array[$i]['delivered_date'];
                $order_info_tmp['order_status'] = $order_list_array[$i]['order_status'];
                $order_info_tmp['user_id'] = $order_list_array[$i]['user_id'];
                $order_info_tmp['seller_id'] = $order_list_array[$i]['seller_id'];
                $order_info_tmp['order_place_by'] = $order_list_array[$i]['order_place_by'];
                $order_info_tmp['rating'] = $order_list_array[$i]['rating'];
                $order_info_tmp['comment'] = $order_list_array[$i]['comment'];
                $order_info_tmp['bRecordDelete'] = $order_list_array[$i]['bRecordDelete'];
                $order_info_tmp['ucontactno'] = $order_list_array[$i]['ucontactno'];
                $order_info_tmp['customer_name'] = $order_list_array[$i]['ufname'] . " " . $order_list_array[$i]['ulname'];
                $order_info_tmp['ucity'] = $order_list_array[$i]['ucity'];
                $order_info_tmp['order_edit_status'] = $order_list_array[$i]['order_edit_status'];

                $sql1 = $this->db->query("SELECT oh.*, p.* FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id)  WHERE o.order_code = '" . $order_list_array[$i]['order_code'] . "'");

                $sql1_array = $sql1->result_array();
                $order_info_tmp_history = array();

                for ($j = 0; $j < count($sql1_array); $j++) {
                    $order_info_tmp_history_tmp['order_history_id'] = $sql1_array[$j]['order_history_id'];
                    $order_info_tmp_history_tmp['seller_price_type'] = $sql1_array[$j]['seller_price_type'];
                    $order_info_tmp_history_tmp['seller_price'] = $sql1_array[$j]['seller_price'];
                    $order_info_tmp_history_tmp['product_quantity'] = $sql1_array[$j]['product_quantity'];
                    $order_info_tmp_history_tmp['product_price'] = $sql1_array[$j]['product_price'];
                    $total_quantity += (int) $sql1_array[$j]['product_quantity'];
                    $order_info_tmp_history_tmp['product_english_name'] = $sql1_array[$j]['product_english_name'];
                    $order_info_tmp_history_tmp['product_image'] = $image_url . "product_images/" . $sql1_array[$j]['product_image'];
                    array_push($order_info_tmp_history, $order_info_tmp_history_tmp);
                }

                $order_info_tmp['order_info_tmp_history'] = $order_info_tmp_history;
                $order_info_tmp['total_quantity'] = $total_quantity;

                if ($order_list_array[$i]['order_status'] == 0) {
                    $order_info_tmp['status'] = 'New';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 1) {
                    $order_info_tmp['status'] = 'Confirm';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 2) {
                    $order_info_tmp['status'] = 'On The Way';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 3) {
                    $order_info_tmp['status'] = 'Inprocess';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 4) {
                    $order_info_tmp['status'] = 'Canceled';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 5) {
                    $order_info_tmp['status'] = 'Delivered';
                    array_push($order_info, $order_info_tmp);
                }
            }
            $msg = "New Order Available!";
            $success = true;
            $this->json_code($msg, $order_info, $success);
        } else {
            $data = array();
            $msg = "No New Order Available!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function consumer_order_list() {
        $postvar = $this->input->post();

        $user_id = $postvar['user_id'];
        if ($user_id == "") {
            $data = array();
            $msg = "User id Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }


        $order_list = $this->db->query("SELECT o.*,u.ucontactno,u.ufname,u.ulname,u.ucity,s.* FROM `order` o LEFT JOIN users u ON (o.user_id=u.user_id) LEFT JOIN seller s ON (o.seller_id=s.seller_id) WHERE o.user_id = '" . $user_id . "' AND o.bRecordDelete=0 ORDER BY o.order_date DESC");
        $order_list_array = $order_list->result_array();

        if ($order_list_array) {
            $now = date('h:i:s', time() - 5);
            $order_info = array();
            for ($i = 0; $i < count($order_list_array); $i++) {
                $rating_sql = $this->db->query("SELECT * FROM reviews_ratings WHERE order_id=" . $order_list_array[$i]['order_id'] . " AND seller_id=" . $order_list_array[$i]['seller_id'] . " AND consumer_id=" . $user_id);

                $rating_sql_array = $rating_sql->result_array();

                if ($rating_sql_array) {
                    $order_info_tmp['review_rating'] = $rating_sql_array[0];
                    $order_info_tmp['flag'] = true;
                } else {
                    $order_info_tmp['review_rating'] = new stdClass();
                    $order_info_tmp['flag'] = false;
                }

                $image_url = $this->config->item("upload_url");

                $order_info_tmp['order_id'] = $order_list_array[$i]['order_id'];
                $order_info_tmp['seller_name'] = $order_list_array[$i]['seller_english_name'];
                $order_info_tmp['seller_shop_name'] = $order_list_array[$i]['seller_shop_name'];
                $order_info_tmp['order_code'] = $order_list_array[$i]['order_code'];
                $order_info_tmp['shipping_address'] = $order_list_array[$i]['shipping_address'];
                $order_info_tmp['billing_address'] = '';
                $order_info_tmp['total_price'] = $order_list_array[$i]['total_price'];
                $order_info_tmp['grant_total'] = $order_list_array[$i]['grant_total'];
                $order_info_tmp['delivery_charge'] = $order_list_array[$i]['delivery_charge'];
                $order_info_tmp['paid'] = $order_list_array[$i]['paid'];
                $order_info_tmp['seller_logo'] = $image_url . "admin_profile/" . $order_list_array[$i]['seller_logo'];
                $order_info_tmp['payment_mode'] = $order_list_array[$i]['payment_mode'];
                $order_info_tmp['order_date'] = $order_list_array[$i]['order_date'];
                $order_info_tmp['order_time'] = date('H:s:i', strtotime($order_list_array[$i]['order_date']));
                $order_info_tmp['pending_date'] = $order_list_array[$i]['pending_date'];
                $order_info_tmp['cancel_date'] = $order_list_array[$i]['cancel_date'];
                $order_info_tmp['confirm_date'] = $order_list_array[$i]['confirm_date'];
                $order_info_tmp['delivered_date'] = $order_list_array[$i]['delivered_date'];
                $order_info_tmp['order_status'] = $order_list_array[$i]['order_status'];
                $order_info_tmp['user_id'] = $order_list_array[$i]['user_id'];
                $order_info_tmp['seller_id'] = $order_list_array[$i]['seller_id'];
                $order_info_tmp['order_place_by'] = $order_list_array[$i]['order_place_by'];
                $order_info_tmp['rating'] = $order_list_array[$i]['rating'];
                $order_info_tmp['comment'] = $order_list_array[$i]['comment'];
                $order_info_tmp['bRecordDelete'] = $order_list_array[$i]['bRecordDelete'];
                $order_info_tmp['ucontactno'] = $order_list_array[$i]['ucontactno'];
                $order_info_tmp['customer_name'] = $order_list_array[$i]['ufname'] . " " . $order_list_array[$i]['ulname'];
                $order_info_tmp['ucity'] = $order_list_array[$i]['ucity'];
                $order_info_tmp['order_edit_status'] = $order_list_array[$i]['order_edit_status'];

                $sql1 = $this->db->query("SELECT oh.*, p.* FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id)  WHERE o.order_code = '" . $order_list_array[$i]['order_code'] . "'");

                $sql1_array = $sql1->result_array();
                $order_info_tmp_history = array();

                for ($j = 0; $j < count($sql1_array); $j++) {
                    $order_info_tmp_history_tmp['order_history_id'] = $sql1_array[$j]['order_history_id'];
                    $order_info_tmp_history_tmp['seller_price_type'] = $sql1_array[$j]['seller_price_type'];
                    $order_info_tmp_history_tmp['seller_price'] = $sql1_array[$j]['seller_price'];
                    $order_info_tmp_history_tmp['product_quantity'] = $sql1_array[$j]['product_quantity'];
                    $order_info_tmp_history_tmp['product_price'] = $sql1_array[$j]['product_price'];
                    $total_quantity += (int) $sql1_array[$j]['product_quantity'];
                    $order_info_tmp_history_tmp['product_english_name'] = $sql1_array[$j]['product_english_name'];
                    $order_info_tmp_history_tmp['product_image'] = $image_url . "product_images/" . $sql1_array[$j]['product_image'];
                    array_push($order_info_tmp_history, $order_info_tmp_history_tmp);
                }

                $order_info_tmp['order_info_tmp_history'] = $order_info_tmp_history;
                $order_info_tmp['total_quantity'] = $total_quantity;

                if ($order_list_array[$i]['order_status'] == 0) {
                    $order_info_tmp['status'] = 'New';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 1) {
                    $order_info_tmp['status'] = 'Confirm';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 2) {
                    $order_info_tmp['status'] = 'On The Way';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 3) {
                    $order_info_tmp['status'] = 'Inprocess';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 4) {
                    $order_info_tmp['status'] = 'Canceled';
                    array_push($order_info, $order_info_tmp);
                } else if ($order_list_array[$i]['order_status'] == 5) {
                    $order_info_tmp['status'] = 'Delivered';
                    array_push($order_info, $order_info_tmp);
                }
            }
            $msg = "New Order Available!";
            $success = true;
            $this->json_code($msg, $order_info, $success);
        } else {
            $data = array();
            $msg = "No New Order Available!";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function feedback() {
        $postvar = $this->input->post();
        $contact_no = $postvar['contact_no'];
        $message = $postvar['message'];
        $full_name = $postvar['full_name'];
        $email = $postvar['email'];
        $subject_title = $postvar['subject_title'];


        if ($contact_no == "") {
            $data = array();
            $msg = "Contact Number is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($message == "") {
            $data = array();
            $msg = "Message is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($full_name == "") {
            $data = array();
            $msg = "Full name is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $val['contact_no'] = $contact_no;
        $val['message'] = $message;
        $val['full_name'] = $full_name;
        $val['email'] = $email;
        $val['subject_title'] = $subject_title;
        $val['date_added'] = date('Y-m-d');

        $id = $this->model_support->insert("feedback", $val);

        if ($id) {
            $data = array();
            $msg = "your request is successfully done";
            $success = true;
            $this->json_code($msg, $data, $success);
        } else {
            $data = array();
            $msg = "Something is Wrong";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function add_order_to_cart_by_order_code() {
        $postvar = $this->input->post();
        $order_id = $postvar['order_id'];
        $order_code = $postvar['order_code'];

        if ($order_id == "") {
            $data = array();
            $msg = "Order Id is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        if ($order_code == "") {
            $data = array();
            $msg = "Order Code is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }

        $rply = $this->model_support->getData("order", "*", "order_code='" . $order_code . "' and order_id='" . $order_id . "'");

        if ($rply) {
            $product_info = array();

            $sql_product = $this->db->query("SELECT DISTINCT(p.product_id),p.subproduct_id,p.product_english_name as product_name,p.quantity,p.mrp,p.product_description,p.product_image,p.max_sale_qty,p.discount_percentage,p.mrp,p.unit_value,p.discounted_price,b.brand_name,b.brand_id,u.unit_id,u.display_name,oh.product_quantity FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id) LEFT JOIN brand b ON  (p.product_brand_id=b.brand_id)  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE o.order_code = '" . $order_code . "' GROUP BY p.product_id");
            $product_row = $sql_product->result_array();



            if ($product_row) {
                for ($i = 0; $i < count($product_row); $i++) {
                    $image_url = $this->config->item("upload_url");

                    $product_row[$i]['product_image'] = $image_url . "product_images/" . $product_row[$i]['product_image'];
                    if ($product_row[$i]['quantity'] < $product_row[$i]['max_sale_qty']) {
                        $product_row[$i]['max_sale_qty'] = $product_row[$i]['quantity'];
                    }
                    $product_row[$i]['selected_position'] = 0;
                    $product_row[$i]['quantity'] = $product_row[$i]['product_quantity'];


                    // var_dump($product_row[$i]['subproduct_id']);
                    // exit();

                    if ($product_row[$i]['subproduct_id'] > 0) {
                        // var_dump($product_row[$i]['subproduct_id']);
                        // exit();

                        $sub_product_count = $this->db->query("SELECT COUNT(*) AS sub_counter FROM product WHERE subproduct_id = '" . $product_row[$i]['subproduct_id'] . "'");

                        $sub_product_count_result = $sub_product_count->result_array();
                    } else {
                        $sub_product_count = $this->db->query("SELECT COUNT(*) AS sub_counter FROM product WHERE subproduct_id = '" . $product_row[$i]['product_id'] . "' ");
                        $sub_product_count_result = $sub_product_count->result_array();
                    }

                    if ($sub_product_count_result[0]['sub_counter'] <= 0) {
                        $product_row[$i]['sub_product_flag'] = false;
                    } else {
                        if ($product_row[$i]['subproduct_id'] <= 0) {
                            $aql_id = $product_row[$i]['product_id'];
                        } else {
                            $aql_id = $product_row[$i]['subproduct_id'];
                        }

                        $main_p = $this->db->query("select p.*,u.* from product as p left join unit_type u ON  (p.unit_type=u.unit_id) WHERE  p.product_id='" . $aql_id . "'");

                        $main_p_result = $main_p->result_array();

                        // var_dump($main_p_result);
                        //  var_dump($aql_id);
                        // exit();

                        $sub_product_sql = $this->db->query("SELECT  p.product_id as subproduct_id, p.subproduct_id as main_product_id,p.discounted_price as product_price,p.mrp,p.quantity ,p.unit_value,u.display_name  FROM product AS p  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE  p.subproduct_id='" . $aql_id . "'");

                        $result1 = $sub_product_sql->result_array();





                        $sub_product = array();
                        if (count($result1) > 0) {
                            if ($product_row[$i]['subproduct_id'] <= 0) {
                                $product_row[$i]['subproduct_id'] = $product_row[$i]['product_id'];
                            }

                            $tmp_product_row_sql = $this->db->query("SELECT p.*,b.brand_name,b.brand_id,u.unit_id,u.display_name FROM product AS p LEFT JOIN brand b ON  (p.product_brand_id=b.brand_id)  LEFT JOIN unit_type u ON  (p.unit_type=u.unit_id) WHERE p.product_id='" . $product_row[$i]['subproduct_id'] . "'");
                            $result11 = $tmp_product_row_sql->result_array();

                            // var_dump($product_row);
                            // exit();

                            $result11['product_image'] = $image_url . "product_images/" . $main_p_result[0]['product_image'];
                            $result11['quantity'] = $main_p_result[$i]['quantity'];
                            $tmpproduct['product_id'] = $main_p_result[0]['product_id'];
                            $tmpproduct['quantity'] = $main_p_result[0]['quantity'];
                            $tmpproduct['max_sale_qty'] = $main_p_result[0]['max_sale_qty'];
                            $tmpproduct['mrp'] = $main_p_result[0]['mrp'];
                            $tmpproduct['discounted_price'] = $main_p_result[0]['discounted_price'];
                            $tmpproduct['subproduct_id'] = $main_p_result[0]['product_id'];
                            $tmpproduct['display_name'] = $main_p_result[0]['display_name'];
                            $tmpproduct['seller_product_id'] = $main_p_result[0]['product_id'];
                            $tmpproduct['seller_id'] = 1;
                            $tmpproduct['product_price'] = $main_p_result[0]['discounted_price'];
                            $tmpproduct['actual_price'] = $main_p_result[0]['mrp'];
                            $tmpproduct['seller_quantity'] = $main_p_result[$i]['unit_value'];
                            array_push($sub_product, $tmpproduct);
                            $tmp_counter = 0;




                            $tmp_counter = 0;
                            for ($j = 0; $j < count($result1); $j++) {
                                $sub_product_data['product_id'] = $result1[$j]['subproduct_id'];
                                $sub_product_data['quantity'] = $result1[$j]['quantity'];
                                $sub_product_data['mrp'] = $result1[$j]['mrp'];
                                $sub_product_data['discounted_price'] = $result1[$j]['product_price'];
                                $sub_product_data['max_sale_qty'] = $result1[$j]['quantity'];
                                $sub_product_data['subproduct_id'] = $result1[$j]['main_product_id'];
                                $sub_product_data['display_name'] = $result1[$j]['display_name'];
                                $sub_product_data['seller_product_id'] = $result1[$j]['subproduct_id'];
                                $sub_product_data['seller_id'] = 1;
                                $sub_product_data['product_price'] = $result1[$j]['mrp'];
                                $sub_product_data['actual_price'] = $result1[$j]['product_price'];
                                $sub_product_data['seller_quantity'] = $result1[$j]['unit_value'];

                                array_push($sub_product, $sub_product_data);
                                $tmp_counter++;
                                if ($product_row['product_id'] == $sub_product_data['product_id']) {
                                    $counter = $tmp_counter;
                                }

                                // var_dump($result1[$i]['unit_value']);
                            }
                            // exit();
                            if (!isset($counter)) {
                                $counter = 0;
                            }
                            $product_row[$i]['sub_product_flag'] = true;
                            $product_row[$i]['selected_position'] = $counter;
                            $product_row[$i]['sub_product'] = $sub_product;
                        }


                        // $product_row[$i]['sub_product']=$tmp_product_row;
                        // $sub_product_data['actual_price'] = $result1[$i]['product_price'];
                    }

                    // var_dump($product_row);
                    //     exit();


                    $product_row[$i]['unit_type'] = $product_row[$i]['unit_id'];
                    $product_row[$i]['seller_product_id'] = $product_row[$i]['product_id'];
                    $product_row[$i]['seller_product_id'] = 1;
                    $product_row[$i]['seller_quantity'] = $product_row[$i]['unit_value'];
                    $product_row[$i]['actual_price'] = $product_row[$i]['mrp'];
                    $product_row[$i]['product_price'] = $product_row[$i]['mrp'];
                    array_push($product_info, $product_row[$i]);
                }



                $msg = "order details are.";
                $success = true;
                $this->json_code($msg, $product_info, $success);
            }
        } else {
            $data = array();
            $msg = "No Such as Order Found";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
    }

    public function get_notfication() {
        $postvar = $this->input->post();
        $user_id = $postvar['user_id'];

        if ($user_id == "") {
            $data = array();
            $msg = "user id is  Required";
            $success = false;
            $this->json_code($msg, $data, $success);
        }
        $id = $this->input->post('user_id');

        $notifications = $this->model_support->get_notification_by_id($id);
        if (!empty($notifications)) {
            for ($i = 0; $i < count($notifications); $i++) {
                $notifications[$i]['payload'] = json_decode($notifications[$i]['payload']);
            }
            $re_data['success'] = 'true';
            $re_data['message'] = "Notification Lists are";
            $re_data['data'] = $notifications;
        } else {
            $re_data['success'] = 'false';
            $re_data['message'] = "No notification found";
            $re_data['data'] = array();
        }
        echo json_encode($re_data);
    }

    public function json_code($msg, $data = "", $success) {
        $response = array(
            'success' => $success,
            'message' => $msg,
            'data' => $data
        );
        echo json_encode($response);
        exit;
    }

}
