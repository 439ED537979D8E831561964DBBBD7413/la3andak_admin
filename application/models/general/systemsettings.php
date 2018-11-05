<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of systemsettings
 *
 * @author nilay
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SystemSettings extends CI_Model {

    protected $_settings_array = Array();

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//        $this->getSettingsFromDB();
        $this->getUserData();
//        $this->getLanguageSettings();
    }

    private function getSettingsFromDB() {
        $result = $this->db->get('setting')->result_array();
        for ($i = 0; $i < count($result); $i++) {
            $this->_settings_array[$result[$i]['vName']] = $result[$i]['vValue'];
            $this->config->set_item($result[$i]['vName'], $result[$i]['vValue']);
        }
    }

    private function getUserData() {
        $userid = $this->session->userdata('iAdminId');        
        $this->db->select('concat(vFirstName," ",vLastName) as name,vEmail as email,vImage as image', false);
        $this->db->where('iAdminId', $userid);
        $result = $this->db->get('admin_master')->result_array();


        if (is_array($result) && count($result) > 0) {
            foreach ($result[0] as $key => $value) {
                $this->config->set_item(strtoupper('admin_' . $key), $value);
            }
        }
    }

    private function getLanguageSettings() {
        
    }

    public function getSettings($var_name) {

        if (array_key_exists($var_name, $this->_settings_array)) {
            return $this->_settings_array[$var_name];
        } else {
            return false;
        }
    }

    public function getAllSettings() {

        return $this->_settings_array;
    }

    function getSettingsMaster($eConfigType = "", $assoc_value = false, $fields = "") {
        if ($fields == '')
            $fields = '*';
        $this->db->select($fields);
        $this->db->from("setting");
        $this->db->where("setting.eStatus", "Active");
        if ($eConfigType != '') {
            $this->db->where("setting.eConfigType", $eConfigType);
        }
        $this->db->order_by("setting.iOrderBy, setting.eConfigType ASC");

        if ($assoc_value != false) {
            $sql = $this->db->_compile_select();
            $list_data = $this->db->select_assoc($sql, $assoc_value);
        } else {
            $list_data = $this->db->get()->result_array();
        }
        return $list_data;
    }

    function getQueryResult() {
        return $this->db->query($query);
    }

    function save_setting($updateArr, $field_name, $vValue) {
        $sess_setting = $this->session->userdata('sess_setting');
        $sql_update = "UPDATE setting SET " . @implode(", ", $updateArr) . " WHERE vName = '" . $field_name . "'";
        $db_update = $this->db->query($sql_update);
        return $db_update;
    }

}
