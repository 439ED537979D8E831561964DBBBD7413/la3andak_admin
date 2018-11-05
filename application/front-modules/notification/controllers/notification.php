<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_notification');
        $this->load->library('session');
    }

    public function notification_list() {

        $rply = $this->model_notification->getData("notification_master", "*", "1 order by dtCreatedDate desc");
        $data['all'] = $rply;
        $this->load->view("notification_list", $data);
    }

    public function send_notification() {

   $createdby=$this->session->userdata('iAdminId');
  

     //$city = $this->model_notification->getData("location_master", "*","isDelete=0 and eStatus='Active'");
     //$data['city']=$city;
       $this->config->set_item('fatch', $createdby);
        $this->load->view("send_notification",$data);
    }

    public function notification_action()
     {
            $postvar = $this->input->post();
            $ImageFile = $_FILES["image"];
              
             $type = $postvar['ucity'];
             $registatoin_ids=array();
          //  $user = $postvar['user'];
             $msg = str_replace("&nbsp;", "", strip_tags($postvar['text']));
             $msg1 = trim(preg_replace('/\s\s+/', ' ', $this->encodeEmoji($postvar['text'])));
            if ($ImageFile['name'] != '')
            {

                $id=1;
                $this->load->library('upload');
                $temp_folder_path = $this->config->item('upload_path') . 'notification';
               
                $this->general->createfolder($temp_folder_path);

                $file_name = time();

                $upload_config = array(
                    'upload_path' => $temp_folder_path,
                    'allowed_types' => "jpg|jpeg|gif|png|pdf", //*
                    'max_size' => 1028 * 1028 * 2,
                    'file_name' => time(),
                    'overwrite' => True
                );
               
                $this->upload->initialize($upload_config);

                if ($this->upload->do_upload("image")) 
                {
                    $file_info = $this->upload->data();
                    $uploadedFile = $file_info['file_name'];
                }
               else
                {
                    $uploadedDetails = $this->upload->display_errors();
                    exit;
                }
            }
            
            //for all user;
            //$fileupload = $_POST['image'];
            $im=$uploadedFile;
              $user = $this->model_notification->getData("users", "*","bIsdelete=0 and ustatus=1 and vmod = 1 and isNotification = 1");
              $num= count($user);
              //var_dump($user);die();
          
            
            $this->model_notification->send($num,$msg,$msg1,$im,$type);
            $this->model_notification->ios_push($num,$msg,$msg1,$im,$type);
            
            $this->session->set_flashdata('success', 'Send Notification successfully');
            redirect("send_notification");  
    }

/**
	 * Decode emoji in text
	 * @param string $text text to decode
	 */
	public static function Decode($text) {
		return self::convertEmoji($text,"DECODE");
	}

	private static function convertEmoji($text,$op) {
		if($op=="ENCODE"){
			return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u',array('self',"encodeEmoji"),$text);
		}else{
			return preg_replace_callback('/(\\\u[0-9a-f]{4})+/',array('self',"decodeEmoji"),$text);
		}
	}

	private static function encodeEmoji($match) {
		return str_replace(array('[',']','"'),'',json_encode($match));
	}
	
	private static function decodeEmoji($text) {
		if(!$text) return '';
		$text = $text[0];
		$decode = json_decode($text,true);
		if($decode) return $decode;
		$text = '["' . $text . '"]';
		$decode = json_decode($text);
		if(count($decode) == 1){
		   return $decode[0];
		}
		return $text;
	}
}
