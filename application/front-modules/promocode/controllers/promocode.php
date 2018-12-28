<?php

ini_set('max_input_vars', '5000');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class promocode extends MX_Controller {

    public function __construct() {

        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_promocode');
        $this->load->library('session');
        $this->load->library('image_lib');
    }

    public function promocode_list() {
        $fields = "*";
        $cond = "bIsdelete = 0";
        $order_by = "promocode_id desc";
        $promocode = $this->model_promocode->getData("promocodes", $fields, $cond, $join, $order_by);
        $data['promocode'] = $promocode;
        $this->load->view("promocode_list", $data);
    }

    public function add_promocode() {

        $fields = "*";
        $cond = "bIsdelete = 0 and category_status = 1";
        $category = $this->model_promocode->getData("category", $fields, $cond);

        $fields1 = "*";
        $cond1 = "bIsdelete = 0 and product_status = 1";
        $sub_category = $this->model_promocode->getData("product_bunch", $fields1, $cond1);


        $join_ary = array(
            array("table" => "category",
                "condition" => "category.category_id=product.product_category",
                "jointype" => "inner"),
            array("table" => "product_bunch",
                "condition" => "product_bunch.product_bunch_id=product.product_bunch",
                "jointype" => "inner")
        );

        $fields2 = "product.*";
        $cond2 = "product.bIsdelete = 0 and product.product_status = 1";
        $product = $this->model_promocode->getData("product", $fields2, $cond2, $join_ary);

        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['product'] = $product;

        $this->load->view("add_promocode", $data);
    }

    public function promocode_action() {
        $postvar = $this->input->post();

        if ($postvar['main_type'] == 'Category') {
            $string = implode(',', $postvar['category_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Category");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = $string;
            $val['sub_category_ids'] = "";
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Normal') {
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = "";
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Sub Category') {
            $string = implode(',', $postvar['sub_category_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Sub Category");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = $string;
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Product') {
            $string = implode(',', $postvar['product_wise_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Product]");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = "";
            $val['product_ids'] = $string;
        } else if ($postvar['main_type'] == '0') {
            echo '<script type="text/javascript">';
            echo 'alert("Please Select Promocode type");';
            echo "history.go(-1)";
            echo '</script>';
            exit();
        }


//        $name1 = "";
//        if ($_FILES['image']['tmp_name'] != "") {
//            foreach ($_FILES['image']['name'] as $f => $name) {
//                if ($_FILES['image']['error'][$f] == 4) {
//                    continue;
//                }
//
//                $name1 = time();
//                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
//                $file_name_array = explode('.', $file_name);
//                $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
//                $name1 = strtotime(date('Y-m-d H:i')) . $name1;
//                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PROMOCODE_UPLOAD . $name1)) {
//                    $image_promo = $name_thumb;
//                    $config['image_library'] = 'gd2';
//                    $config['source_image'] = TABLE_PROMOCODE_UPLOAD . $name1;
//                    $config['create_thumb'] = TRUE;
//                    $config['maintain_ratio'] = TRUE;
//                    $config['width'] = IMG_MAX_WIDTH;
//                    $config['height'] = IMG_MAX_HEIGHT;
//                    $this->image_lib->clear();
//                    $this->image_lib->initialize($config);
//                    $this->image_lib->resize();
//                } else {
//                    $this->session->set_flashdata('error', 'Unable to Upload Image');
//                    $this->session->set_userdata($session_data);
//                }
//            }
//        }
//        
        $name1 = $promocode_image = "";

        if ($_FILES['image']['tmp_name'] != "") {
            foreach ($_FILES['image']['name'] as $f => $name) {
                if ($_FILES['image']['error'][$f] == 4) {
                    continue;
                }

                $name1 = strtotime(date('Y-m-d H:i')) . $name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.', $file_name);
                $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
                $name1 = strtotime(date('Y-m-d H:i')) . $name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PROMOCODE_UPLOAD . $name1)) {
                    $promocode_image = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_PROMOCODE_UPLOAD . $name1;
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = IMG_MAX_WIDTH;
                    $config['height'] = IMG_MAX_HEIGHT;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                } else {
                    $this->session->set_flashdata('error', 'Unable to Upload Image');
                    $this->session->set_userdata($session_data);
                }
            }
        }






        if ($promocode_image == "") {
            $image_promo = "no_image.png";
        }

        $startdate = date("Y-m-d H:i:s");
        if (!isset($postvar['add_into_comman'])) {
            $postvar['add_into_comman'] = 'NO';
        }

        if (!isset($postvar['always_available'])) {
            $postvar['always_available'] = 'NO';
            $val['promocode_start_date'] = date('Y-m-d', strtotime($postvar['events_date']));
            $val['promocode_end_date'] = date('Y-m-d', strtotime($postvar['events_date1']));
        } elseif (!empty($postvar['events_date']) && !empty($postvar['events_date1']) && !isset($postvar['always_available'])) {

            $val['promocode_start_date'] = date('Y-m-d', strtotime($postvar['events_date']));
            $val['promocode_end_date'] = date('Y-m-d', strtotime($postvar['events_date1']));
        } else {
            $val['promocode_start_date'] = "0000-00-00";
            $val['promocode_end_date'] = "0000-00-00";
        }

        if (!isset($postvar['default_banner'])) {
            $postvar['default_banner'] = "NO";
        }
        if (isset($postvar['multiple'])) {
            $multiple = $postvar['multiple'];
        } else {
            $multiple = 0;
        }


        $descrption = $this->encodeEmoji($postvar['promocode_description']);

        $val['promocode'] = $postvar['promocode'];
        $val['promocode_name'] = $postvar['promocode_name'];
        $val['promocode_description'] = $descrption;
        $val['common'] = $postvar['add_into_comman'];
        $val['offers_type'] = $postvar['offers_type'];
        $val['always_available'] = $postvar['always_available'];

        $val['offer_value'] = $postvar['offer_value'];
        $val['promocode_image'] = $promocode_image;
        $val['min_cost'] = $postvar['min_cost'];
        $val['default_banner'] = $postvar['default_banner'];
        $val['multiple'] = $multiple;

        $insertedid = $this->model_promocode->insert("promocodes", $val);
        if (isset($postvar['to']) && !empty($postvar['to'])) {

            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $insertedid);
            foreach ($postvar['to'] as $key => $value) {
                $val1['consumer_id'] = $value;
                $val1['promocode_id'] = $insertedid;
                $val1['offers_added_date'] = date('Y-m-d', strtotime($postvar['date']));

                $query12 = $this->model_promocode->insert("offers", $val1);
            }
            // send notification to selected user
            if ($postvar['add_into_notification'] == 'YES') {
                $ios_registatoin_ids = array();
                $android_registatoin_ids = array();
                foreach ($postvar['to'] as $key => $offer_value) {
                    $type = $this->db->query("SELECT * FROM users WHERE user_id=" . $offer_value);
                    $result = $type->result_array();
                    //   var_dump($result);die();
                    foreach ($result as $key => $value) {
                        // 
                        if ($value['vmod'] == "2") {
                            // user is iOS
                            $gcmid = $value['fcm_id'];
                            array_push($ios_registatoin_ids, $gcmid);
                        } else {
                            // user is android
                            $gcmid = $value['fcm_id'];
                            array_push($android_registatoin_ids, $gcmid);
                        }
                    }
                }
                //  var_dump($ios_registatoin_ids);die();
                $this->model_promocode->ios_push($postvar['promocode_description'], $descrption, $name1, '1', $ios_registatoin_ids, $postvar['to']);
                $this->model_promocode->send($postvar['promocode_description'], $name1, '1', $android_registatoin_ids, $postvar['to']);
            }
        } else if (($postvar['add_into_comman']) == 'YES') {
            // send notification to all user
            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $insertedid);
            $consumer_list = $this->db->query("SELECT * FROM users where bIsdelete = 0");
            $result = $consumer_list->result_array();
            $ios_registatoin_ids = array();
            $android_registatoin_ids = array();
            $users = array();
            for ($i = 0; $i < count($result); $i++) {
                $val12['consumer_id'] = $result[$i]['user_id'];
                $val12['promocode_id'] = $insertedid;
                $val12['offers_added_date'] = date('Y-m-d', strtotime($postvar['date']));
                $query123 = $this->model_promocode->insert("offers", $val12);
                array_push($users, $val12['consumer_id']);
                // 
                if ($result[$i]['vmod'] == "2") {
                    // user is iOS
                    $gcmid = $result[$i]['fcm_id'];
                    array_push($ios_registatoin_ids, $gcmid);
                } else {
                    // user is android
                    $gcmid = $result[$i]['fcm_id'];
                    array_push($android_registatoin_ids, $gcmid);
                }
            }
            // send notification to selected user

            if ($postvar['add_into_notification'] == 'YES') {
                // var_dump($ios_registatoin_ids);die();
                $this->model_promocode->ios_push($postvar['promocode_description'], $descrption, $name1, '1', $ios_registatoin_ids, $users);
                $this->model_promocode->send($postvar['promocode_description'], $name1, '1', $android_registatoin_ids, $postvar['to']);
            }
        } else {
            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $insertedid);
        }
        $this->session->set_flashdata('success', 'Promocodes Added successfully');
        redirect("promocode_list");
    }

    public function promocode_edit_action() {

        $postvar = $this->input->post();
        if ($postvar['main_type'] == 'Category') {

            $string = implode(',', $postvar['category_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Category");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = $string;
            $val['sub_category_ids'] = "";
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Normal') {
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = "";
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Sub Category') {
            $string = implode(',', $postvar['sub_category_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Sub Category");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = $string;
            $val['product_ids'] = "";
        } else if ($postvar['main_type'] == 'Product') {
            $string = implode(',', $postvar['product_wise_main']);
            if ($string == NULL) {
                echo '<script type="text/javascript">';
                echo 'alert("Please Select Product");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }
            $val['promocode_type'] = $postvar['main_type'];
            $val['category_ids'] = "";
            $val['sub_category_ids'] = "";
            $val['product_ids'] = $string;
        } else if ($postvar['main_type'] == '0') {
            echo '<script type="text/javascript">';
            echo 'alert("Please Select Promocode type");';
            echo "history.go(-1)";
            echo '</script>';
            exit();
        }


        $id = $postvar['id'];




        $startdate = date("Y-m-d H:i:s");
        if (!isset($postvar['add_into_comman'])) {
            $postvar['add_into_comman'] = 'NO';
        }

        if (!isset($postvar['always_available'])) {
            $postvar['always_available'] = 'NO';
            $postvar['date'] = date('Y-m-d', strtotime($postvar['date']));
            $postvar['date1'] = date('Y-m-d', strtotime($postvar['date1']));
            $val['promocode_start_date'] = date('Y-m-d', strtotime($postvar['date']));
            $val['promocode_end_date'] = date('Y-m-d', strtotime($postvar['date1']));
        } elseif (!empty($postvar['date']) && !empty($postvar['date1']) && !isset($postvar['always_available'])) {
            $postvar['date'] = date('Y-m-d', strtotime($postvar['date']));
            $postvar['date1'] = date('Y-m-d', strtotime($postvar['date1']));
            $val['promocode_start_date'] = date('Y-m-d', strtotime($postvar['date']));
            $val['promocode_end_date'] = date('Y-m-d', strtotime($postvar['date1']));
        } else {
            $val['promocode_start_date'] = "0000-00-00";
            $val['promocode_end_date'] = "0000-00-00";
        }



        if (!isset($postvar['default_banner'])) {
            $postvar['default_banner'] = "NO";
        }
        if (isset($postvar['multiple'])) {
            $multiple = $postvar['multiple'];
        } else {
            $multiple = 0;
        }
        $val['promocode'] = $postvar['promocode'];
        $val['promocode_name'] = $postvar['promocode_name'];
        $val['promocode_description'] = $postvar['promocode_description'];
        $val['common'] = $postvar['add_into_comman'];
        $val['offers_type'] = $postvar['offers_type'];
        $val['always_available'] = $postvar['always_available'];

        $val['offer_value'] = $postvar['offer_value'];

        $val['min_cost'] = $postvar['min_cost'];
        $val['default_banner'] = $postvar['default_banner'];
        $val['multiple'] = $multiple;

        // echo "<pre>";
        // var_dump($val);
        // exit();
        $name1 = "";

        if ($_FILES['image']['tmp_name'] != "") {
            foreach ($_FILES['image']['name'] as $f => $name) {
                if ($_FILES['image']['error'][$f] == 4) {
                    continue;
                }

                $name1 = strtotime(date('Y-m-d H:i')) . $name;
                $file_name = trim(basename(stripslashes($name1)), ".\x00..\x20");
                $file_name_array = explode('.', $file_name);
                $name_thumb = $file_name_array[0] . "_thumb." . $file_name_array[1];
                $name1 = strtotime(date('Y-m-d H:i')) . $name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PROMOCODE_UPLOAD . $name1)) {

                    $val['promocode_image'] = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_PROMOCODE_UPLOAD . $name1;
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = IMG_MAX_WIDTH;
                    $config['height'] = IMG_MAX_HEIGHT;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                } else {
                    $this->session->set_flashdata('error', 'Unable to Upload Image');
                    $this->session->set_userdata($session_data);
                }
            }
        }

        $this->model_promocode->update("promocodes", $val, "promocode_id=" . $id);
        if (isset($postvar['add_into_comman']) && $postvar['add_into_comman'] != "NO") {
            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $id);
            $consumer_list = $this->db->query("SELECT * FROM users where bIsdelete = 0");
            $result = $consumer_list->result_array();

            for ($i = 0; $i < count($result); $i++) {
                $val12['consumer_id'] = $result[$i]['user_id'];
                $val12['promocode_id'] = $id;
                $val12['offers_added_date'] = date('Y-m-d', strtotime($postvar['date']));
                $query123 = $this->model_promocode->insert("offers", $val12);
            }
        } else if (isset($postvar['to']) && !empty($postvar['to'])) {
            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $id);
            foreach ($postvar['to'] as $key => $value) {
                $val1['consumer_id'] = $value;
                $val1['promocode_id'] = $id;
                $val1['offers_added_date'] = date('Y-m-d', strtotime($postvar['date']));

                $query12 = $this->model_promocode->insert("offers", $val1);
            }
            // send notification to selected user
            if ($postvar['add_into_notification'] == 'YES') {
                $ios_registatoin_ids = array();
                $android_registatoin_ids = array();
                foreach ($postvar['to'] as $key => $offer_value) {
                    $type = $this->db->query("SELECT * FROM users WHERE user_id=" . $value);
                    $result = $type->result_array();

                    foreach ($result as $key => $value) {
                        // 
                        if ($value['vmod'] == "2") {
                            // user is iOS
                            $gcmid = $value['fcm_id'];
                            array_push($ios_registatoin_ids, $gcmid);
                        } else {
                            // user is android
                            $gcmid = $value['fcm_id'];
                            array_push($android_registatoin_ids, $gcmid);
                        }
                    }
                }
                $this->model_promocode->ios_push($postvar['promocode_description'], $postvar['promocode_description'], $name1, '1', $ios_registatoin_ids, $postvar['to']);
            }
        } else if ($postvar['to'] == NULL) {
            $this->db->query("DELETE FROM offers WHERE promocode_id=" . $id);
        }
        $this->session->set_flashdata('success', 'Promocode Updated successfully');
        redirect("promocode_list");
    }

    public function promocode_edit() {

        $getvar = $this->input->get();
        $promocode_id = urldecode($this->general->decryptData($getvar['promocode_id']));
        if (!empty($promocode_id)) {
            $fields = "*";
            $cond = "promocode_id=" . $promocode_id;

            $promocode = $this->model_promocode->getData("promocodes", $fields, $cond, $join);
            //get order package

            $data['promocode'] = $promocode;
        }
        $fields = "*";
        $cond = "bIsdelete = 0 and category_status = 1";
        $category = $this->model_promocode->getData("category", $fields, $cond);

        $fields1 = "*";
        $cond1 = "bIsdelete = 0 and product_status = 1";
        $sub_category = $this->model_promocode->getData("product_bunch", $fields1, $cond1);

        $fields2 = "*";
        $cond2 = "bIsdelete = 0 and product_status = 1";
        $product = $this->model_promocode->getData("product", $fields2, $cond2);

        $data['category'] = $category;
        $data['sub_category'] = $sub_category;
        $data['product'] = $product;
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_promocode2", $data);
    }

    function delete_promocode() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['promocode_id']));
        if ($id != '') {

            // $fields="*";
            //    $cond="brand_id=".$id;
            //    $promocode = $this->model_promocode->getData("promocode", $fields, $cond, $join);
            //     unlink(TABLE_CATEGORY_UPLOAD.$promocode[0]['brand_icon']);

            $update['bIsdelete'] = "1";
            $this->model_promocode->update("promocodes", $update, "promocode_id=" . $id);

            $this->session->set_flashdata('success', 'Promocode Deleted successfully');

            redirect("promocode_list");
        }
    }

    function removeImage() {

        $id = $this->input->post('id');
        if ($id > 0) {
            $update['promocode_image'] = "no_image.png";
            $this->model_promocode->update("promocodes", $update, "promocode_id=" . $id);
        }
        return true;
    }

    /**
     * Decode emoji in text
     * @param string $text text to decode
     */
    public static function Decode($text) {
        return self::convertEmoji($text, "DECODE");
    }

    private static function convertEmoji($text, $op) {
        if ($op == "ENCODE") {
            return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u', array('self', "encodeEmoji"), $text);
        } else {
            return preg_replace_callback('/(\\\u[0-9a-f]{4})+/', array('self', "decodeEmoji"), $text);
        }
    }

    private static function encodeEmoji($match) {
        return str_replace(array('[', ']', '"'), '', json_encode($match));
    }

    private static function decodeEmoji($text) {
        if (!$text)
            return '';
        $text = $text[0];
        $decode = json_decode($text, true);
        if ($decode)
            return $decode;
        $text = '["' . $text . '"]';
        $decode = json_decode($text);
        if (count($decode) == 1) {
            return $decode[0];
        }
        return $text;
    }

}
