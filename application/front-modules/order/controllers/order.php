<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class order extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_order');
        $this->load->library('session');
        $this->load->library('image_lib');
    }

    public function neworderlist() {
        $orders = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.order_status=0 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $orders->result_array();


        $data['orders'] = $order_array;

        // var_dump($data);
        // exit();

        $this->load->view("new_order_list", $data);
    }

    public function oreder_detail() {

        $this->load->view('data_model');
        // redirect('dashboard');
    }

    public function invoice() {
        $this->load->view('invoice');
    }

    public function pending_order_send() {
        $postvar = $this->input->post();
        $id = $postvar['id_to_delete'];
        $cond = "order_id = '$id'";
        $order = $this->model_order->getData("order", $fields, $cond, $join);

        if ($order[0]['order_status'] != 4) {
            $val['order_status'] = 2;
            $val['pending_date'] = date("Y-m-d H:i:s");        // =2
            $this->model_order->update("order", $val, "order_id=" . $id);
            echo "True";
        } else {
            echo "Fail";
        }
    }

    public function cancel_order_send() {
        $postvar = $this->input->post();
        $id = $postvar['id_to_delete'];



        $val['order_status'] = 4;
        $val['cancel_date'] = date("Y-m-d H:i:s");
        // =2

        $this->model_order->update("order", $val, "order_id=" . $id);
    }

    public function deleiver_order() {
        $postvar = $this->input->post();
        $id = $postvar['id_to_delete'];
        $cond = "order_id = '$id'";
        $order = $this->model_order->getData("order", $fields, $cond, $join);

        if ($order[0]['order_status'] != 4) {
            $val['order_status'] = 5;
            $val['delivered_date'] = date("Y-m-d H:i:s");            // =5
            $this->model_order->update("order", $val, "order_id=" . $id);
            echo "True";
        } else {
            echo "Fail";
        }
    }

    public function edit_order() {
        $postvar = $this->input->get();
        $order_code = $postvar['order_code'];

        $fields = "*";
        $cond = "order_code = '$order_code'";
        $order = $this->model_order->getData("order", $fields, $cond, $join);
        $data['order'] = $order;

        $order_detail = $this->db->query("SELECT o.*, oh.*,oh.product_quantity*oh.product_price as product_total_price,oh.seller_price_type AS qty, p.product_english_name FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id)  WHERE o.order_code = '" . $order_code . "'");

        $order_detail_array = $order_detail->result_array();

        $data['order_detail_array'] = $order_detail_array;

        $this->load->view("edit_order", $data);
    }

    public function order_action_edit() {
        $postvar = $this->input->post();
        $order_code = $postvar['order_code'];
        $product_id = $postvar['product_id'];

        if (is_array($product_id) && count($product_id) > 0) {
            $query = $this->db->query("SELECT o.*,pc.offers_type,pc.offer_value,pc.min_cost FROM `order` o LEFT JOIN promocodes pc ON (pc.promocode=o.promocode) WHERE o.order_code='" . $order_code . "'");
            $row = $query->result_array();



            if ($row[0]['order_status'] == 4) {
                echo '<script type="text/javascript">';
                echo 'alert("Order is Cancel By User");';
                echo "history.go(-1)";
                echo '</script>';
                exit();
            }



            $delivery_charge = $this->db->query("SELECT * FROM settings WHERE seeting_uniq_name='delivery_charge'");
            $delivery_charge = $delivery_charge->result_array();
            $delivery_charge = $delivery_charge[0]['setting_value'];

            $delivery_amount = $this->db->query("SELECT * FROM settings WHERE seeting_uniq_name='delivery_amount'");
            $delivery_amount = $delivery_amount->result_array();
            $delivery_amount = $delivery_amount[0]['setting_value'];

            $user_id = $row[0]['user_id'];
            if (!empty($row[0]['promocode'])) {
                $promocode = true;
                if ($row[0]['offers_type'] == 'FLAT') {
                    $offers_type = 1;
                } elseif ($row[0]['offers_type'] == 'PERCENTAGE') {
                    $offers_type = 2;
                } else {
                    $offers_type = 0;
                }
                $offer_value = floatval($row[0]['offer_value']);
                $min_cost = floatval($row[0]['min_cost']);
            } else {
                $promocode = false;
                $offers_type = 0;
                $offer_value = 0;
                $min_cost = 0;
            }
            $cost_total_tmp = 0;
            $order_history_array = array();


            foreach ($_POST['product_id'] as $key => $value) {
                $cost_total_tmp += floatval($_POST['p_p_'][$key]) * intval($_POST['p_q_'][$key]);
                $oh_data_to_store['order_code'] = $order_code;
                $oh_data_to_store['product_id'] = $key;
                $oh_data_to_store['seller_price'] = floatval($_POST['p_p_'][$key]);
                $oh_data_to_store['product_price'] = floatval($_POST['p_p_'][$key]);
                $oh_data_to_store['seller_price_type'] = $_POST['seller_price_type'][$key];
                $oh_data_to_store['product_quantity'] = intval($_POST['p_q_'][$key]);
                if ($oh_data_to_store['product_quantity'] > 0) {
                    array_push($order_history_array, $oh_data_to_store);
                }
            }

            $cost_total = 0;
            if ($promocode) {
                if ($offers_type == 1 && $cost_total_tmp >= $min_cost) {
                    // $cost_total=$cost_total_tmp-$offer_value;
                    $discount = $offer_value;
                }
                if ($offers_type == 2 && $cost_total_tmp >= $min_cost) {
                    $discount = round((($cost_total_tmp * $offer_value) / 100), 2);
                    // $cost_total=$cost_total_tmp-$discount;
                }
            } else {
                $discount = 0;
            }
            $cost_total = $cost_total_tmp - $discount;
            if ($delivery_amount > $cost_total_tmp) {
                $delivery_charge = $delivery_charge;
            } else {
                $delivery_charge = 0;
            }

            $grant_total = $cost_total + $delivery_charge;
            $data_to_store['total_price'] = $cost_total;
            $data_to_store['delivery_charge'] = $delivery_charge;
            $data_to_store['grant_total'] = $grant_total;
            $data_to_store['payment_mode'] = 1;
            $data_to_store['discount'] = $discount;
            $data_to_store['order_code'] = $row[0]['order_code'];
            $data_to_store['order_date'] = $row[0]['order_date'];
            $data_to_store['shipping_address'] = $row[0]['shipping_address'];
            $data_to_store['order_status'] = $row[0]['order_status'];
            $data_to_store['user_id'] = $row[0]['user_id'];
            $data_to_store['seller_id'] = $row[0]['seller_id'];
            $data_to_store['delivery_time_slot'] = $row[0]['delivery_time_slot'];
            $data_to_store['delivery_date'] = $row[0]['delivery_date'];
            $data_to_store['promocode'] = $row[0]['promocode'];
            $data_to_store['slot_id'] = $row[0]['slot_id'];
            $data_to_store['order_edit_status'] = 1;

            $this->db->query("DELETE FROM `order` WHERE order_code='" . $order_code . "'");
            $this->db->query("DELETE FROM order_history WHERE order_code='" . $order_code . "'");

            $id = $this->model_order->insert("order", $data_to_store);

            foreach ($order_history_array as $key => $order_history_array_value) {
                $id_history = $this->model_order->insert("order_history", $order_history_array_value);
            }

            if ($id_history) {
                $this->session->set_flashdata('success', 'order Updated successfully');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->db->query("DELETE FROM `order` WHERE order_code='" . $order_code . "'");
            $this->db->query("DELETE FROM order_history WHERE order_code='" . $order_code . "'");

            $this->session->set_flashdata('success', 'order Updated successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function order_add() {
        $this->load->view("add_order");
    }

    public function order_delivered_list() {

        $order = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id)  WHERE o.order_status=5 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $order->result_array();
        $data['orders'] = $order_array;

        $this->load->view("deliver_order_list", $data);
    }

    public function order_pending_list() {

        $order = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.order_status=2 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $order->result_array();
        $data['orders'] = $order_array;

        $this->load->view("pending_order_list", $data);
    }

    public function under_preparation_order() {
        $order = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.order_status=2 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $order->result_array();
        $data['orders'] = $order_array;

        $this->load->view("under_preperation", $data);
    }

    public function en_route_order() {
        $order = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.order_status=2 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $order->result_array();
        $data['orders'] = $order_array;

        $this->load->view("en_route", $data);
    }

    public function order_cancel_list() {

        $order = $this->db->query("SELECT o.*,s.seller_shop_name,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id) WHERE o.order_status=4 AND o.bRecordDelete=0 ORDER BY order_date DESC");

        $order_array = $order->result_array();
        $data['orders'] = $order_array;

        $this->load->view("cancel_order_list", $data);
    }

    public function order_action() {
        $postvar = $this->input->post();
        $val['order_name'] = $postvar['order_name'];
        $val['order_status'] = $postvar['status'];



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
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_order_UPLOAD . $name1)) {

                    $val['order_icon'] = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_order_UPLOAD . $name1;
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



        if ($_FILES['image']['type'][0] == "") {
            $val['order_icon'] = "no_image.png";
        }


        $id = $this->model_order->insert("order", $val);

        $this->session->set_flashdata('success', 'order Added successfully');

        redirect("manage_order");
    }

    public function order_action_edit123() {
        $postvar = $this->input->post();
        $id = $postvar['id'];
        $val['order_name'] = $postvar['order_name'];
        $val['order_status'] = $postvar['status'];


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
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_order_UPLOAD . $name1)) {

                    $val['order_icon'] = $name_thumb;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = TABLE_order_UPLOAD . $name1;
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
        } else {
            $val['order_icon'] = "no_image.png";
        }

        // $id = $this->model_order->insert("order", $val);

        $this->model_order->update("order", $val, "order_id=" . $id);

        $this->session->set_flashdata('success', 'order Updated successfully');

        redirect("manage_order");
    }

    public function delete_location() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['cust_id']));
        $loc_id = urldecode($this->general->decryptData($getvar['loc_id']));

        $where = "loc_id =" . $loc_id . " AND cust_id=" . $id;
        $result = $this->model_order->delete("location", $where);

        $cust_id = urlencode($this->general->encryptData($id));
        redirect("location_customer?cust_id=" . $cust_id);
    }

    public function order_edit() {

        $getvar = $this->input->get();
        $order_id = urldecode($this->general->decryptData($getvar['order_id']));
        if (!empty($order_id)) {
            $fields = "*";
            $cond = "order_id=" . $order_id;

            $order = $this->model_order->getData("order", $fields, $cond, $join);
            //get order package

            $data['order'] = $order;
        }
        // echo "<pre>";print_r($data);echo "</pre>";die();
        $this->load->view("edit_order", $data);
    }

    function removeImage() {

        $id = $this->input->post('id');
        if ($id > 0) {
            $update['order_icon'] = "no_image.png";
            $this->model_order->update("order", $update, "order_id=" . $id);
        }
        return true;
    }

    function delete_order() {
        $getvar = $this->input->get();
        $id = urldecode($this->general->decryptData($getvar['order_id']));
        if ($id != '') {

            // $fields="*";
            //    $cond="order_id=".$id;
            //    $order = $this->model_order->getData("order", $fields, $cond, $join);
            //     unlink(TABLE_order_UPLOAD.$order[0]['order_icon']);

            $update['bIsdelete'] = "1";
            $this->model_order->update("order", $update, "order_id=" . $id);

            $this->session->set_flashdata('success', 'order Deleted successfully');

            redirect("manage_order");
        }
    }

}
