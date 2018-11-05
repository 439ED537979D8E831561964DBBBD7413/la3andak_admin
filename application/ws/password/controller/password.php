<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Password extends MX_Controller {

    private $code;
    private $message;

    public function __construct() {
        parent::__construct();
        error_reporting();
        $this->load->model('model_support');
        $this->load->library('general');
    }

    public function resetpassword() {
        $postvar = $this->input->get();
        die("hello");
        $this->load->view("category_list", $data);
        
    }
    public function customer_register() {
        $postvar = $this->input->post();
        $email = $postvar['email'];        
        $password = $postvar['password'];
        $fullname = $postvar['fullname'];
        if ($email == "" || $password == "")
            $this->setOutput(422, "Please check your parameters.");

        $check = $this->model_support->checkEmail($email);

        if ($check[0]['user'] != 0) {

            $this->setOutput(423, "email already exists.");
        }
       
        $val['fullname'] = '';        
        $val['email'] = $postvar['email'];
        $val['password'] = md5($password);
        $val['verification_code '] = '';
        $val['created_on'] = date("Y-m-d H:i:s");
        $val['last_login'] = '';
        $val['status'] = '';
        $val['phone'] = '';
        $val['device_id'] = '';

        $id = $this->model_support->insert("customer", $val);

        $field = "fullname as name,email as email,verification_code as verification_code";

        $val = $this->model_support->getData("customer", $field, "cust_id=" . $id);

        /*$datalog['iUserId'] = $id;
        $datalog['vSessionId'] = $this->general->encryptData($mobile . "User" . date('Y-m-d h:i:s'));
        $datalog['eUserType'] = ucfirst("user");
        $datalog['dtLoginDate'] = date('Y-m-d H:i:s');
        $this->load->model('tools/loghistory');
        $this->loghistory->insert($datalog);
        $result[0]['sessionId'] = $datalog['vSessionId'];*/
        
        $data->cust_id = $id;
        $data->email = $val[0]['email'];
        $data->name = $val[0]['name'];
        $data->verification_code = $val[0]['verification_code'];

        

        $this->code = 200;
        $this->message = "success";
        $this->setOutput($this->code, $this->message, $data);
    }

    public function customer_login() {
        $postvar = $this->input->post();
        $email = $postvar['email'];
        $password = $postvar['password'];
        //$deviceToken = $postvar['deviceToken'];

        if ($email == "" || $password == "")
            $this->setOutput(422, "Please check your parameters.");

        $result = $this->model_support->authenticateCustomer($email, md5($password));
        //echo "<pre>";print_r($result[0]['cust_id']);echo "</pre>";
        if (!empty($result[0]['cust_id'])) {
            $this->code = 200;
            $data->cust_id = $result[0]['cust_id'];
            $data->email = $result[0]['email'];
            $data->name = $result[0]['name'];
            $data->verification_code = $result[0]['verification_code'];
            
        } else {
            $this->code = 423;
            $this->message = "email or password is incorrect";
            $data['code'] = $this->code;
            $data['message'] = $this->message;
        }

        $this->setOutput($this->code, $this->message, $data);
    }

    public function customer_forgot_password() {
        $postvar = $this->ws_input();
        $email = $postvar['email'];
        if ($email == '')
            $this->setOutput(422, "Please check your parameter");

        $rply = $this->model_support->getData("customer", "cust_id", "email='" . $email . "'");
        if (count($rply) > 0) {
            $id = $rply[0]['cust_id'];
            $encid = $this->general->encryptData($id);

            $this->load->library('email');
            $this->email->from("testnirav68@gmail.com", "adite");
            $this->email->to($email);
            $this->email->subject("Reset Password");

            $url = $this->config->item("site_url") . "password/resetpassword/uid/" . $encid;

            $msg = "Please click below link to reset your password <br> " . $url;

            $this->email->message($msg);

            $success = $this->email->send();

            if ($success == "1") {
                $data['code'] = 200;
                $data['message'] = "mail sent successfully";
                $this->setOutput(200, "mail sent successfully", $data);
            } else {
                $data['code'] = 423;
                $data['message'] = "mail sent fail please try again later";
                $this->setOutput(423, "mail sent fail please try again later", $data);
            }
        } else {
            $data['code'] = 423;
            $data['message'] = "email address not found";
            $this->setOutput(423, "email address not found", $data);
        }
    }
    public function register() {
        $postvar = $this->input->post();
        $mobile = $postvar['mobile'];
        $password = $postvar['password'];

        if ($mobile == "" || $password == "")
            $this->setOutput(422, "Please check your parameters.");

        $check = $this->model_support->checkMobile($mobile);

        if ($check[0]['user'] != 0) {

            $this->setOutput(423, "mobile already exists.");
        }

        $dob = date('Y-m-d', strtotime($postvar['dob']));
        $val['vName'] = $postvar['name'];
        $val['vMobile'] = $postvar['mobile'];
        $val['vEmail'] = $postvar['email'];
        $val['vPassword'] = md5($password);
        $val['dtBirthDate'] = $dob;
        $val['eGender'] = $postvar['gender'];
        $val['vPincode'] = $postvar['pin'];
        $val['iCountryId'] = $postvar['countryId'];
        $val['iStateId'] = $postvar['stateId'];
        $val['iDistrictId'] = $postvar['districtId'];
        $val['iTalukaId'] = $postvar['talukaId'];
        $val['iVillageId'] = $postvar['villageId'];
        $val['vPincode'] = $postvar['pincode'];
        $val['vAddress'] = $postvar['address'];
        $val['vDeviceToken'] = $postvar['deviceToken'];
        $val['dtCreatedDate'] = date("Y-m-d H:i:s");
        $val['dtModifyDate'] = date("Y-m-d H:i:s");
        $val['eStatus'] = "Active";

        $id = $this->model_support->insert("user_master", $val);
        $digits = 5;
        $code_val = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $message = 'Your OTP is ' . $code_val . ' for authentication, please do not share with anyone.';
        $message = str_replace(' ', '%20', $message);
        $code = $message;


        $field = "vName as name,dtBirthDate as dob,eGender as gender,iCountryId as countryId,iStateId as stateId,iVillageId as villageId,iDistrictId as districtId,iTalukaId as talukaId,(SELECT vCountry FROM country_master WHERE country_master.iCountryId=user_master.iCountryId) as country,(SELECT vState FROM state_master WHERE state_master.iStateId=user_master.iStateId) as state,(SELECT vDistrict FROM district_master WHERE district_master.iDistrictId=user_master.iDistrictId) as district,(SELECT vTaluka FROM taluka_master WHERE taluka_master.iTalukaId=user_master.iTalukaId) as taluka,(SELECT vVillage FROM village_master WHERE village_master.iVillageId=user_master.iVillageId) as village,vPincode as pincode,vAddress as address";
        $val = $this->model_support->getData("user_master", $field, "iUserId=" . $id);

        $datalog['iUserId'] = $id;
        $datalog['vSessionId'] = $this->general->encryptData($mobile . "User" . date('Y-m-d h:i:s'));
        $datalog['eUserType'] = ucfirst("user");
        $datalog['dtLoginDate'] = date('Y-m-d H:i:s');
        $this->load->model('tools/loghistory');
        $this->loghistory->insert($datalog);
        $result[0]['sessionId'] = $datalog['vSessionId'];
        $data->userId = $id;
        $data->mobile = $mobile;
        $data->sessionId = $result[0]['sessionId'];
        $data->name = $val[0]['name'];
        $data->dob = $val[0]['dob'];
        $data->gender = $val[0]['gender'];
        $data->state = $val[0]['state'];
        $data->district = $val[0]['district'];
        $data->taluka = $val[0]['taluka'];
        $data->village = $val[0]['village'];
        $data->pincode = $val[0]['pincode'];
        $data->address = $val[0]['address'];
        $data->countryId = $val[0]['countryId'];
        $data->stateId = $val[0]['stateId'];
        $data->talukaId = $val[0]['talukaId'];
        $data->villageId = $val[0]['villageId'];
        $data->districtId = $val[0]['districtId'];
        $this->code = 200;
        $this->message = "success";
        $this->setOutput($this->code, $this->message, $data);
    }
   
    

    public function getAds() {
        $postvar = $this->input->get();
        $id = $postvar['userId'];
        $sessionId = $postvar['sessionId'];

        if ($id == "" || $sessionId == "")
            $this->setOutput(422, "Please check your parameters.");

        $image = $this->config->item("upload_url") . "ads/";

        $field = "iAdId as adId,vTitle as title,vDescription as description,if(vImage is null,'',concat('" . $image . "',iAdId,'/',vImage))  as image,vUrl as url";

        $cond = 'eStatus="Active" and isDelete!="1" and ("' . date('Y-m-d') . '" BETWEEN dtFromDate AND dtToDate)';

        $val = $this->model_support->getData("ads_master", $field, $cond);
        $app = $this->model_support->getData("content_master", "tContent", "vCode='ABOUT_APP'");
        $data->ads = $val;
        $data->aboutApp = strip_tags($app[0]['tContent']);
        $this->code = 200;
        $this->message = "success";

        $this->setOutput($this->code, $this->message, $data);
    }

    public function login() {
        $postvar = $this->input->post();
        $mobile = $postvar['mobile'];
        $password = $postvar['password'];
        $deviceToken = $postvar['deviceToken'];

        if ($mobile == "" || $password == "" || $deviceToken == '')
            $this->setOutput(422, "Please check your parameters.");

        $result = $this->model_support->authenticate($mobile, md5($password));

        if ($result[0]['userId'] != '') {
            $this->userCheck($result[0]['userId']);

            $update['vDeviceToken'] = $postvar['deviceToken'];
            $this->model_support->update("user_master", $update, "iUserId=" . $result[0]['userId']);

            $field = "vName as name,dtBirthDate as dob,eGender as gender,iCountryId as countryId,iStateId as stateId,iVillageId as villageId,iDistrictId as districtId,iTalukaId as talukaId,(SELECT vCountry FROM country_master WHERE country_master.iCountryId=user_master.iCountryId) as country,(SELECT vState FROM state_master WHERE state_master.iStateId=user_master.iStateId) as state,(SELECT vDistrict FROM district_master WHERE district_master.iDistrictId=user_master.iDistrictId) as district,(SELECT vTaluka FROM taluka_master WHERE taluka_master.iTalukaId=user_master.iTalukaId) as taluka,(SELECT vVillage FROM village_master WHERE village_master.iVillageId=user_master.iVillageId) as village,vPincode as pincode,vAddress as address";
            $val = $this->model_support->getData("user_master", $field, "iUserId=" . $result[0]['userId']);

            $datalog['iUserId'] = $result[0]['userId'];
            $datalog['vSessionId'] = $this->general->encryptData($mobile . "User" . date('Y-m-d h:i:s'));
            $datalog['eUserType'] = ucfirst("user");
            $datalog['dtLoginDate'] = date('Y-m-d H:i:s');
            $this->load->model('tools/loghistory');
            $this->loghistory->insert($datalog);
            $result[0]['sessionId'] = $datalog['vSessionId'];
            $data->userId = $result[0]['userId'];
            $data->mobile = $mobile;
            $data->sessionId = $result[0]['sessionId'];
            $data->name = $val[0]['name'];
            $data->dob = $val[0]['dob'];
            $data->gender = $val[0]['gender'];
            $data->state = $val[0]['state'];
            $data->district = $val[0]['district'];
            $data->taluka = $val[0]['taluka'];
            $data->village = $val[0]['village'];
            $data->pincode = $val[0]['pincode'];
            $data->address = $val[0]['address'];
            $data->countryId = $val[0]['countryId'];
            $data->stateId = $val[0]['stateId'];
            $data->talukaId = $val[0]['talukaId'];
            $data->villageId = $val[0]['villageId'];
            $data->districtId = $val[0]['districtId'];
            $this->code = 200;
            $this->message = "success";
        } else {
            $this->code = 423;
            $this->message = "mobile or password is incorrect";
            $data['code'] = $this->code;
            $data['message'] = $this->message;
        }

        $this->setOutput($this->code, $this->message, $data);
    }

  
   
   
   
    public function getContent() {
        $about = $this->model_support->getData("content_master", "tContent", "vCode='ABOUT_US'");
        $contact = $this->model_support->getData("content_master", "tContent", "vCode='CONTACT_US'");
        $terms = $this->model_support->getData("content_master", "tContent", "vCode='TERMS'");

        $data->about = strip_tags($about[0]['tContent']);
        $data->contact = strip_tags($contact[0]['tContent']);
        $data->terms = strip_tags($terms[0]['tContent']);

        $this->setOutput(200, "success", $data);
    }

    public function contactUs() {

        $mobile = $this->model_support->getData("content_master", "tContent", "vCode='MOBILE'");
        $email = $this->model_support->getData("content_master", "tContent", "vCode='EMAIL'");
        $add = $this->model_support->getData("content_master", "tContent", "vCode='CONTACT_US'");

        $data->email = $email[0]['tContent'];
        $data->mobile = $mobile[0]['tContent'];
        $data->address = $add[0]['tContent'];

        $this->setOutput(200, "success", $data);
    }

    public function logout() {
        $postvar = $this->input->get();
        $session_id = $postvar['sessionId'];
        $id = $postvar['userId'];

        $logout = $this->model_support->logout($session_id, $id);

        $data['code'] = "200";
        $data['message'] = 'Logout successfully.';
        $this->setOutput(200, 'Logout successfully.', $data);
    }

    private function session_check($session_id) {
        $session_exist = $this->model_support->session_check($session_id);
        if ($session_exist > 0) {
            return true;
        }
        $this->setOutput(421, "Session not exist");
    }

    public function version_validator() {
        $header = apache_request_headers();
        $version = $header["app-version"];
        $device = $header["device"];

        if ($version == '' || $device == '')
            $this->setOutput(422, "Please check your parameter");

        $cond = "vVersionCode='" . $version . "' and eAppType='" . $device . "'";
        $versiondata = $this->model_support->getData('app_version', 'eStatus', $cond);

        if ($versiondata[0]['eStatus'] != 'Active')
            $this->setOutput(403, "Please update your app to latest version");
    }

    public function userCheck($id) {

        $tbl = "user_master";
        $cond = "user_master.iUserId=" . $id;

        $user = $this->model_support->getData($tbl, 'eStatus,isDelete', $cond);

        if ($user[0]['eStatus'] != 'Active' || $user[0]['isDelete'] == '1')
            $this->setOutput(423, "User is blocked or account is deleted");
    }

    private function setOutput($code, $message, $data = '') {
        $this->code = $code;
        $this->message = $message;
        $this->ws_ouput($data);
    }

    private function ws_input() {
        $get_arr = is_array($this->input->get(null, true)) ? $this->input->get(null, true) : array();
        $post_arr = is_array($this->input->post(null, true)) ? $this->input->post(null, true) : array();
        $raw_arr = is_array(json_decode(trim(file_get_contents('php://input')), true)) ? json_decode(trim(file_get_contents('php://input')), true) : array();
        return $request_arr = array_merge($get_arr, $post_arr, $raw_arr);
    }

    private function ws_ouput($data) {
        $this->output->set_status_header($this->code, $this->message);
        if ($this->code != 200) {
            $data->code = $this->code;
            $data->message = $this->message;
        }
        $this->output->set_header('Access-Control-Allow-Origin: *');
        $ret = json_encode($data);
        $this->output->set_header('Content-type: application/json');
        echo $ret;
        exit;
    }

    public function forgotPassword() {
        $postvar = $this->ws_input();
        $email = $postvar['email'];
        if ($email == '')
            $this->setOutput(422, "Please check your parameter");

        $rply = $this->model_support->getData("user_master", "iUserId", "vEmail='" . $email . "'");
        if (count($rply) > 0) {
            $id = $rply[0]['iUserId'];
            $encid = $this->general->encryptData($id);

            $this->load->library('email');
            $this->email->from("testnirav68@gmail.com", "adite");
            $this->email->to($email);
            $this->email->subject("Reset Password");

            $url = $this->config->item("site_url") . "reset_password?uid=" . $encid;

            $msg = "Please click below link to reset your password <br> " . $url;

            $this->email->message($msg);

            $success = $this->email->send();

            if ($success == "1") {
                $data['code'] = 200;
                $data['message'] = "mail sent successfully";
                $this->setOutput(200, "mail sent successfully", $data);
            } else {
                $data['code'] = 423;
                $data['message'] = "mail sent fail please try again later";
                $this->setOutput(423, "mail sent fail please try again later", $data);
            }
        } else {
            $data['code'] = 423;
            $data['message'] = "email address not found";
            $this->setOutput(423, "email address not found", $data);
        }
    }

}
