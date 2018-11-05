<?php

class Emailer extends CI_Model {

    public $ids_arr = array();
    public $num_totrec = "";
    protected $module_array = array();
    public $main_table = "";
    public $primary_key = "";

    public function __construct() {
        parent::__construct();
        $this->load->helper('listing');
        $this->main_table = "system_email";
    }

    public function getEmailContent($vEmailCode = 'MEMBER_REGISTER') {
        $this->db->select('iEmailTemplateId,vEmailCode,vEmailTitle,vFromName,vFromEmail,vBccEmail,eEmailFormat,vEmailSubject,tEmailMessage,vEmailFooter,eStatus');
        $this->db->from($this->main_table);
        $this->db->where("vEmailCode", $vEmailCode);
        $emailData = $this->db->get()->result_array();
        return $emailData;
    }

    function send_mail($data, $type = "") {        
        $emailData = $this->getEmailContent($type);
        $tEmailMessage = $emailData[0]['tEmailMessage'];
        $vEmailSubject = $emailData[0]['vEmailSubject'];
        switch ($type) {
            case "FORGOT_PASSWORD":
                $url = $this->config->item('site_url').'reset_password?reader='.$this->general->encryptData($data["id"]).'&t='.  $this->general->encryptData(date("Y-m-d H:i:s"));
                $logo=$this->config->item("images_url").'navneeticon.png';
                $findarray = array("#COMPANY_NAME#","#LOGO#" ,"#NAME#",'#SITE_URL#', "#COPY_RIGHTS#");
                $replacearray = array($this->config->item("COMPANY_NAME"),$logo, $data['name'], $url, $this->config->item("COPYRIGHTED_TEXT"));               
                break;
            default :
                $findarray = array();
                $replacearray = array();
                $tEmailMessage = $data['tEmailMessage'];
                $vEmailSubject = $data['vEmailSubject'];
        }

        $vBody = str_replace($findarray, $replacearray, $tEmailMessage);
        $subject = str_replace($findarray, $replacearray, $vEmailSubject);
        $this->load->library('email');
        $this->email->from($emailData[0]['vFromEmail'], 'Navneet');
        $this->email->to($data['vEmail']);
        $this->email->subject($subject);
        $this->email->message($vBody);        
        $success = $this->email->send();
        return $success;
    }

}
