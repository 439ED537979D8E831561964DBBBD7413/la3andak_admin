<?php

class Model_csv extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;

    public function __construct() {
        parent::__construct();
        $this->main_table = "brand";
        $this->primary_key = "brand_id";
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

     public function get_total_counts($table_name, $condion=array()) {
        $this->db->select('COUNT(*) As counts');
        if (isset($condion) && is_array($condion) && !empty($condion) && count($condion) > 0) {
            foreach ($condion as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        $query = $this->db->get($table_name);
        if ($query->num_rows() >= 1) {
            $row=$query->row();
            return $row->counts;
        }
        else{
            return 0;
        }
    }

      //-- Get single key as return value from any table condional array -----
    public function getsinglecolumevalue_array($tableName,$whileCondition,$returnkey){
        $this->db->select($returnkey);
        $query = $this->db->get_where($tableName, $whileCondition);
        $row=$query->row();
        if (is_array($row)) {
           return 0;
        } 
        else{
           return $row->$returnkey;
        }
    }

}
