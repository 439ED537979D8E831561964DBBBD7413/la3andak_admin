<?php

class Model_support extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;

    public function __construct() {
        parent::__construct();
        $this->main_table = "user_master";
        $this->primary_key = "iUserId";
    }



    public function checkEmail($email) {

        $loginquery = 'SELECT count(cust_id) as user from customer where email="' . $email . '"';
        return $this->db->query($loginquery)->result_array();
    } 
     public function drivercheckEmail($email) {

        $loginquery = 'SELECT count(cust_id) as user from delivery_users where email="' . $email . '"';
        return $this->db->query($loginquery)->result_array();
    } 
    public function checkMobile($mobile) {

        $loginquery = 'SELECT count(iUserId) as user from user_master where vMobile="' . $mobile . '" and isDelete!="1"';
        return $this->db->query($loginquery)->result_array();
    }
     public function resendmobile($mobile) {

        $loginquery = 'SELECT *  from user_master where vMobile="' . $mobile . '" and isDelete!="1"';
        return $this->db->query($loginquery)->result_array();
    }
    public function optverify($code)
    {
         $loginquery = 'SELECT *  from user_master where vOTPCode="' . $code . '" and isDelete!="1"';
        return $this->db->query($loginquery)->result_array();

    }
      public function get_notification_by_id($uid){
		$query = "SELECT * FROM notification_history  WHERE user_id= '$uid' ORDER BY utimestamp DESC";
		return $this->db->query($query)->result_array();
	}
    public function resetPassword($email) {

        $loginquery = 'SELECT IF(COUNT(iSellerId) > 0, "2", "") AS userType,IF(COUNT(iSellerId) > 0, iSellerId, "") AS id
 FROM seller_master
        WHERE vEmail =  "' . $email . '"  AND isDelete != "1" HAVING userType != "" 
UNION
SELECT IF(COUNT(iBuyerId) > 0, "1", "") AS userType,IF(COUNT(iBuyerId) > 0, iBuyerId, "") AS id FROM buyer_master
        WHERE vEmail = "' . $email . '" AND  isDelete != "1" HAVING userType != ""';

        return $this->db->query($loginquery)->result_array();
    }

    public function authenticate($mobile, $password) {

        $loginquery = 'SELECT iUserId as userId from user_master where vMobile="' . $mobile . '" and vPassword="' . $password . '"';

        return $this->db->query($loginquery)->result_array();
    }
     public function authenticateCustomer($email, $password) {

        $loginquery = 'SELECT *  from customer where email="' . $email . '" and password="' . $password . '"';

        return $this->db->query($loginquery)->result_array();
    }
    public function authenticateDriver($email, $password) {

        $loginquery = 'SELECT *  from delivery_users where email="' . $email . '" and password="' . $password . '"';

        return $this->db->query($loginquery)->result_array();
    }

    function insert($tbl = '', $data = array()) {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }

        $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($tbl = '', $data = array(), $where = '') {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }
//        foreach ($data as $key => $value) {
//            $this->db->set($key, $value, false);    
//        }
        $this->db->where($where, false, false);
        $res = $this->db->update($tbl, $data);
//        $rs = mysql_affected_rows();
        //echo $this->db->last_query();
        return $res;
    }

    function getData($tbl = '', $fields, $condition = '', $join_ary = array(), $orderby = '', $groupby = '', $having = '', $climit = '', $paging_array = array(), $reply_msgs = '', $like = array()) {

        if ($fields == '') {
            $fields = "*";
        }

        //$this->db->start_cache();
        $this->db->select($fields, FALSE);

        if (is_array($join_ary) && count($join_ary) > 0) {
            foreach ($join_ary as $ky => $vl) {
                $this->db->join($vl['table'], $vl['condition'], $vl['jointype']);
            }
        }

        if (trim($condition) != '') {
            $this->db->where($condition, false, false);
        }
        if (trim($groupby) != '') {
            $this->db->group_by($groupby);
        }
        if (trim($having) != '') {
            $this->db->having($having, FALSE);
        }
        if ($orderby != '' && is_array($paging_array) && count($paging_array) == "0") {
            $this->db->order_by($orderby, FALSE);
        }
        if (trim($climit) != '') {
            $this->db->limit($climit);
        }
        if ($tbl != '') {
            $this->db->from($tbl);
        } else {
            $this->db->from($this->main_table);
        }

        //$this->db->stop_cache();
        $list_data = $this->db->get()->result_array();
        //
      // echo $this->db->last_query();exit;
        //$this->session->set_userdata(array('query' => $this->db->last_query()));
        //$this->db->flush_cache();
        //print_r($list_data);
        return $list_data;
    }

    function delete($tbl = '', $where = '') {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }
        $this->db->where($where);
        $this->db->delete($tbl);
        return 'deleted';
    }

    function getCountryList($id = '') {
        $this->db->select('iCountryId as countryId,vCountry as countryName');
        $this->db->where("isDelete != ", "1");
        $this->db->where("eStatus", "Active");
        if ($id > 0) {
            $this->db->where("iCountryId", "$id");
        }
        $this->db->from("country");
        $country_data = $this->db->get()->result_array();
        return $country_data;
    }

    function session_check($session_id) {
        $ext = 'vSessionId = "' . $session_id . '" and ISNULL(dtLogoutDate)';
        $this->db->select('count(*) as tot', false);
        $this->db->where($ext);
        $result = $this->db->get('log_history');
        $record = $result->result_array();
        $res = $record[0]['tot'];
        return $res;
    }

    public function logout($session_id, $user_id) {
        $this->db->set('dtLogoutDate', date('Y-m-d H:i:s'));
        $this->db->where('iUserId', $user_id);
        $this->db->where('vSessionId', $session_id);
        $id = $this->db->update('log_history');

        return $id;
    }

}
