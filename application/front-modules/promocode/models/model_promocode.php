<?php

class Model_promocode extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;

    public function __construct() {
        parent::__construct();
        $this->main_table = "locations";
        $this->primary_key = "location_id";
    }

    function insert($tbl = '', $data = array()) {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }

        $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();
        return $insert_id;
    }

    function update($tbl = '', $data = array(), $where = '') {
        if ($tbl == '') {
            $tbl = $this->main_table;
        }
        $this->db->where($where, false, false);
        $res = $this->db->update($tbl, $data);
        $rs = $this->db->affected_rows();
        //echo $this->db->last_query();
        return $rs;
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
        //echo $this->db->last_query();exit;
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

public function ios_push($msg,$msg1,$im,$type,$fcm_ids,$users)
      {
       
       
        $num  = count($fcm_ids);
        // $registatoin_ids=array();
        // $user_ids=array();
        // foreach($users as $row)
        // {
        //     $gcmid= $row['fcm_id'];
        //     array_push($registatoin_ids,$gcmid);
        //     array_push($user_ids,$row['user_id']);
        // }
       // var_dump($users);die();
        $passphrase = 'adite123$$';
        $print=false; 
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        stream_context_set_option($ctx, 'ssl', 'local_cert', $_SERVER["DOCUMENT_ROOT"].'/grocery/application/front-modules/promocode/models/certi_distri.pem');
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
        exit("Failed to connect: $err $errstr" . PHP_EOL);
        if($print==true)
        {
          //echo 'Connected to APNS' . PHP_EOL;
        }
        $message1=array('title'=>'','type'=>"2",'body'=>$msg);
        $body['aps'] = array(
            'alert' =>array('title'=>'' ,'type'=>"2",'body'=> $msg),
            'message' => $msg,
            'sound' => 'default.mp3',
            'mutable-content'=>1,
            'content-available'=>1,
            'badge'=>1,
            'priority'=>'high',
            'image'=>$im,
            'category'=>"newCategory",
            'color' => "#000000"
       
        );
        $payload = json_encode($body);        
        foreach($fcm_ids as $token)
        {
		        $msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
		        $result = fwrite($fp, $msg, strlen($msg));
		        if (!$result)
		        {
		            if($print==true)
		            {
		                echo 'Message not delivered' . PHP_EOL;
		            }
		        }
		        else
		        {
		            if($print==true)
		            {
		                echo 'Message successfully delivered' . PHP_EOL;
		            }
		        }

		 
        }
        // $body['aps'] = array(
        //     'alert' =>array('title'=>'' ,'type'=>"2",'body'=> $msg1),
        //     'message' => $msg1,
        //     'sound' => 'default.mp3',
        //     'mutable-content'=>1,
        //     'content-available'=>1,
        //     'badge'=>1,
        //     'priority'=>'high',
        //     'image'=>$im,
        //     'category'=>"newCategory",
        //     'color' => "#000000"
       
        // );
        // $insert_payload = json_encode($body);  

        // foreach ($users as $key => $value)
        //  {
        // 	# code...
        //    $db=$this->load->database();
        //    $time = date("Y-m-d H:i:s");
        //    $sql = "INSERT INTO notification_history ".
        //        "(user_id,payload, utimestamp) "."VALUES ".
        //        "('$value','$insert_payload','$time')";
        //    $a=$this->db->query($sql);
           
        //  }
   //   var_dump($result);die();
        fclose($fp);
    }
    public function send($msg,$im,$type,$fcm_ids,$users)
    {
        $num= count($fcm_ids);
        $message;
        $idarray=array();
        $number_queries = round($num / 100);
        $limit = 0;
        $i=$number_queries;
        for($j=0;$j<=$i;$j++)
        {
            // $db=$this->load->database();
            // $query = "SELECT * FROM  users where bIsdelete=0 and ustatus=1 and vmod = 1 and isNotification = 1 LIMIT ".$limit.", 1000";
            // $a=$this->db->query($query);
            foreach($fcm_ids as $token)
            {
                array_push($idarray, $token);
            }

             $url = 'https://fcm.googleapis.com/fcm/send';
             $message=array('message'=>$msg,'type'=>2,'image'=>$im);
             $fields = array('registration_ids' =>$idarray,'data' => $message);
             //var_dump($fields);die();
             $headers = array('Authorization: key=AIzaSyCP0-rCIVoC45x2dffvp4eZRkxwcVsNUbs','Content-Type: application/json');
             $ch = curl_init();
             // Set the url, number of POST vars, POST data
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             // Disabling SSL Certificate support temporarly
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
             // Execute post
             $result = curl_exec($ch);
             if ($result === FALSE)
             {
                 die('Curl failed: ' . curl_error($ch));
             }
             // Close connection
               curl_close($ch);
               $limit=$limit+1000;
               $idarray=array();
           }
        // $insert_payload = json_encode($message);  

        // foreach ($users as $key => $value)
        //  {
        //     # code...
        //    $db=$this->load->database();
        //    $time = date("Y-m-d H:i:s");
        //    $sql = "INSERT INTO notification_history ".
        //        "(user_id,payload, utimestamp) "."VALUES ".
        //        "('$value','$insert_payload','$time')";
        //    $a=$this->db->query($sql);
           
        //  }
        
         // redirect("send_notification");
   }

}
