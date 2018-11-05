<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class product extends MX_Controller {

    public function __construct() {

        parent::__construct();

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->load->model('model_product');

        $this->load->library('session');

        $this->load->library('image_lib');
    }

    public function product_list() {

        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "category_english_name";

        $category = $this->model_product->getData("category", $fields, $cond, $join, $order_by);

        $data['category'] = $category;







        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "productbunch_english_name desc";

        $sub_category = $this->model_product->getData("product_bunch", $fields, $cond, $join, $order_by);

        $data['sub_category'] = $sub_category;





        $fields = "*";

        $cond = "bIsdelete = 0 and subproduct_id = 0";

        $order_by = "product_id desc";

        $product = $this->model_product->getData("product", $fields, $cond, $join, $order_by);



        // var_dump($product);
        // exit();



        $data['product'] = $product;









        $this->load->view("product_list", $data);
    }

    public function sub_product_list() {

        $getvar = $this->input->get();

        $id = urldecode($this->general->decryptData($getvar['product_id']));





        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "category_english_name";

        $category = $this->model_product->getData("category", $fields, $cond, $join, $order_by);

        $data['category'] = $category;







        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "productbunch_english_name desc";

        $sub_category = $this->model_product->getData("product_bunch", $fields, $cond, $join, $order_by);

        $data['sub_category'] = $sub_category;





        $fields = "*";

        $cond = "bIsdelete = 0 and subproduct_id = '" . $id . "'";

        $order_by = "product_id desc";

        $product = $this->model_product->getData("product", $fields, $cond, $join, $order_by);

        $data['product'] = $product;









        $this->load->view("sub_product_list", $data);
    }

    public function product_add() {



        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "brand_name";

        $brand = $this->model_product->getData("brand", $fields, $cond, $join, $order_by);

        $data['brand'] = $brand;



        $fields = "*";

        $cond = "";

        $order_by = "unit_name";

        $unit_type = $this->model_product->getData("unit_type", $fields, $cond, $join, $order_by);

        $data['unit_type'] = $unit_type;





        $fields = "*";

        $cond = "bIsdelete = 0";

        $order_by = "category_english_name";

        $category = $this->model_product->getData("category", $fields, $cond, $join, $order_by);



        $data['category'] = $category;



        $this->load->view("add_product", $data);
    }

    //---------Get Clean String

    public function clean($string) {

        return $string = str_replace(',', '--', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9 .\-]/', '', $string); // Removes special chars.
    }

    public function product_action() {

        $postvar = $this->input->post();

        $val['product_english_name'] = $postvar['product_name'];

        $val['product_brand_id'] = $postvar['brand_id'];

        $val['product_category'] = $postvar['category_id'];

        $val['product_bunch'] = $postvar['sub_category_id'];

        $val['unit_type'] = $postvar['unit_type'];

        $val['unit_value'] = $postvar['unit_value'];

        $val['product_description'] = ($postvar['desc']);

        $val['mrp'] = $postvar['mrp'];

        $val['discount_percentage'] = $postvar['discount_per'];

        $val['quantity'] = $postvar['quantity'];

        $val['max_sale_qty'] = $postvar['max_product'];

        $val['product_status'] = $postvar['status'];
        $val['offer_end_date'] = $postvar['offer_end_date'];
        $val['offer_start_date'] = $postvar['offer_start_date'];

        $val['subproduct_id'] = 0;

        $val['discounted_price'] = floatval($postvar['mrp']) - ((floatval($postvar['discount_per'] * floatval($postvar['mrp'])) / 100));



        // $val['product_description'] =$this->clean($val['product_description']);





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

                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PRODUCT_UPLOAD . $name1)) {



                    $val['product_image'] = $name_thumb;

                    $config['image_library'] = 'gd2';

                    $config['source_image'] = TABLE_PRODUCT_UPLOAD . $name1;

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

        if (($_FILES['image']["type"][0]) == "") {

            $val['product_image'] = "no_image.png";
        }





        $id = $this->model_product->insert("product", $val);



        $this->session->set_flashdata('success', 'Product Added successfully');



        redirect("product_list");
    }

    public function product_action_edit() {



        $postvar = $this->input->post();

        $id = $postvar['id'];



        $val['product_english_name'] = $postvar['product_name'];

        $val['product_brand_id'] = $postvar['brand_id'];

        $val['product_category'] = $postvar['category_id'];

        $val['product_bunch'] = $postvar['sub_category_id'];

        $val['unit_type'] = $postvar['unit_type'];

        $val['unit_value'] = $postvar['unit_value'];

        $val['product_description'] = ($postvar['desc']);

        $val['mrp'] = $postvar['mrp'];

        $val['discount_percentage'] = $postvar['discount_per'];

        $val['quantity'] = $postvar['quantity'];

        $val['max_sale_qty'] = $postvar['max_product'];

        $val['product_status'] = $postvar['status'];
        $val['offer_end_date'] = $postvar['offer_end_date'];
        $val['offer_start_date'] = $postvar['offer_start_date'];

        $val['subproduct_id'] = 0;

        $val['discounted_price'] = floatval($postvar['mrp']) - ((floatval($postvar['discount_per'] * floatval($postvar['mrp'])) / 100));





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

                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PRODUCT_UPLOAD . $name1)) {



                    $val['product_image'] = $name_thumb;

                    $config['image_library'] = 'gd2';

                    $config['source_image'] = TABLE_PRODUCT_UPLOAD . $name1;

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




        // $id = $this->model_product->insert("category", $val);



        $this->model_product->update("product", $val, "product_id=" . $id);



        $this->session->set_flashdata('success', 'Product Updated successfully');



        redirect("product_list");
    }

    public function sub_product_action() {

        $postvar = $this->input->post();

        $val['product_english_name'] = $postvar['product_name'];

        $val['product_brand_id'] = $postvar['brand_id'];

        $val['product_category'] = $postvar['category_id'];

        $val['product_bunch'] = $postvar['sub_category_id'];

        $val['unit_type'] = $postvar['unit_type'];

        $val['unit_value'] = $postvar['unit_value'];

        $val['product_description'] = $postvar['desc'];

        $val['mrp'] = $postvar['mrp'];

        $val['discount_percentage'] = $postvar['discount_per'];

        $val['quantity'] = $postvar['quantity'];

        $val['max_sale_qty'] = $postvar['max_product'];

        $val['product_status'] = $postvar['status'];

        $val['subproduct_id'] = $postvar['product_id'];
        $val['offer_end_date'] = $postvar['offer_end_date'];
        $val['offer_start_date'] = $postvar['offer_start_date'];

        $val['discounted_price'] = floatval($postvar['mrp']) - ((floatval($postvar['discount_per'] * floatval($postvar['mrp'])) / 100));



        // echo "<pre>";
        // var_dump($val);
        // exit();





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

                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PRODUCT_UPLOAD . $name1)) {



                    $val['product_image'] = $name_thumb;

                    $config['image_library'] = 'gd2';

                    $config['source_image'] = TABLE_PRODUCT_UPLOAD . $name1;

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

        if (($_FILES['image']["type"][0]) == "") {

            $val['product_image'] = "no_image.png";
        }





        $id = $this->model_product->insert("product", $val);



        $this->session->set_flashdata('success', 'Sub Product Added successfully');



        // redirect("sub_product_list");



        redirect($this->config->item("site_url") . "sub_product_list?product_id=" . urlencode($this->general->encryptData($postvar['product_id'])));
    }

    public function sub_product_action_edit() {

        $postvar = $this->input->post();



        $id = $postvar['product_id'];





        $val['subproduct_id'] = $postvar['subproduct_id'];

        $val['product_english_name'] = $postvar['product_name'];

        $val['product_brand_id'] = $postvar['brand_id'];

        $val['product_category'] = $postvar['category_id'];

        $val['product_bunch'] = $postvar['sub_category_id'];

        $val['unit_type'] = $postvar['unit_type'];

        $val['unit_value'] = $postvar['unit_value'];

        $val['product_description'] = $postvar['desc'];

        $val['mrp'] = $postvar['mrp'];

        $val['discount_percentage'] = $postvar['discount_per'];

        $val['quantity'] = $postvar['quantity'];

        $val['max_sale_qty'] = $postvar['max_product'];

        $val['product_status'] = $postvar['status'];
        $val['offer_end_date'] = $postvar['offer_end_date'];
        $val['offer_start_date'] = $postvar['offer_start_date'];


        $val['discounted_price'] = floatval($postvar['mrp']) - ((floatval($postvar['discount_per'] * floatval($postvar['mrp'])) / 100));



        // echo "<pre>";
        // var_dump($val);
        // exit();





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

                if (move_uploaded_file($_FILES["image"]["tmp_name"][$f], TABLE_PRODUCT_UPLOAD . $name1)) {



                    $val['product_image'] = $name_thumb;

                    $config['image_library'] = 'gd2';

                    $config['source_image'] = TABLE_PRODUCT_UPLOAD . $name1;

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







        $this->model_product->update("product", $val, "product_id=" . $id);



        $this->session->set_flashdata('success', 'Sub Product Updated successfully');







        redirect($this->config->item("site_url") . "sub_product_list?product_id=" . urlencode($this->general->encryptData($postvar['subproduct_id'])));
    }

    public function product_edit() {



        $getvar = $this->input->get();

        $product_id = urldecode($this->general->decryptData($getvar['product_id']));

        if (!empty($product_id)) {

            $fields = "*";

            $cond = "bIsdelete = 0";

            $order_by = "brand_name";

            $brand = $this->model_product->getData("brand", $fields, $cond, $join, $order_by);

            $data['brand'] = $brand;



            $fields2 = "*";

            $cond2 = "";

            $order_by2 = "unit_name";

            $unit_type = $this->model_product->getData("unit_type", $fields2, $cond2, $join2, $order_by2);

            $data['unit_type'] = $unit_type;





            $fields1 = "*";

            $cond1 = "bIsdelete = 0";

            $order_by1 = "category_english_name";

            $category = $this->model_product->getData("category", $fields1, $cond1, $join1, $order_by1);

            $data['category'] = $category;





            $fields5 = "*";

            $cond5 = "bIsdelete = 0";

            $order_by5 = "";

            $sub_category = $this->model_product->getData("product_bunch", $fields5, $cond5, $join5, $order_by5);

            $data['sub_category'] = $sub_category;





            $fields3 = "*";

            $cond3 = "product_id=" . $product_id;

            $product = $this->model_product->getData("product", $fields3, $cond3, $join3, $order_by3);

            $data['product'] = $product;
        }

        // echo "<pre>";print_r($data);echo "</pre>";die();

        $this->load->view("edit_product", $data);
    }

    public function sub_product_edit() {



        $getvar = $this->input->get();

        $product_id = urldecode($this->general->decryptData($getvar['product_id']));



        if (!empty($product_id)) {



            $fields3 = "*";

            $cond3 = "product_id=" . $product_id;

            $product = $this->model_product->getData("product", $fields3, $cond3, $join3, $order_by3);

            $data['product'] = $product;



            $fields = "*";

            $cond = "";

            $order_by = "unit_name";

            $unit_type = $this->model_product->getData("unit_type", $fields, $cond, $join, $order_by);

            $data['unit_type'] = $unit_type;
        }

        // echo "<pre>";print_r($data);echo "</pre>";die();

        $this->load->view("edit_sub_product", $data);
    }

    function product_sub_product_add() {

        $getvar = $this->input->get();

        $id = urldecode($this->general->decryptData($getvar['product_id']));

        if ($id != '') {

            $fields3 = "*";

            $cond3 = "product_id=" . $id;

            $product = $this->model_product->getData("product", $fields3, $cond3, $join3, $order_by3);

            $data['product'] = $product;
        }



        $fields = "*";

        $cond = "";

        $order_by = "unit_name";

        $unit_type = $this->model_product->getData("unit_type", $fields, $cond, $join, $order_by);

        $data['unit_type'] = $unit_type;



        $this->load->view("sub_product_add", $data);
    }

    function removeImage() {



        $id = $this->input->post('id');

        if ($id > 0) {

            $update['product_image'] = "no_image.png";

            $this->model_product->update("product", $update, "product_id=" . $id);
        }

        return true;
    }

    function product_delete() {

        $getvar = $this->input->get();

        $id = urldecode($this->general->decryptData($getvar['product_id']));

        if ($id != '') {



            // $fields="*";
            //    $cond="brand_id=".$id;
            //    $category = $this->model_product->getData("category", $fields, $cond, $join);
            //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);



            $update['bIsdelete'] = "1";

            $this->model_product->update("product", $update, "product_id=" . $id);



            $this->session->set_flashdata('success', 'Product Deleted successfully');



            redirect("product_list");
        }
    }

    function sub_product_delete() {

        $getvar = $this->input->get();

        $id = urldecode($this->general->decryptData($getvar['product_id']));

        $id1 = $getvar['p1'];



        // var_dump($id1);
        // exit();





        if ($id != '') {



            // $fields="*";
            //    $cond="brand_id=".$id;
            //    $category = $this->model_product->getData("category", $fields, $cond, $join);
            //     unlink(TABLE_CATEGORY_UPLOAD.$category[0]['brand_icon']);



            $update['bIsdelete'] = "1";

            $this->model_product->update("product", $update, "product_id=" . $id);



            $this->session->set_flashdata('success', 'Sub Product Deleted successfully');



            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function get_sub_category($id) {



        $sub_cat = $this->model_product->getlisting("product_bunch", array('product_category' => $id, 'bIsdelete' => 0));
        ?>



        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category Name<span class="required">

                * </span>

        </label>

        <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

            <div class="input-icon right">

                <i class="fa"></i>

        <?php
        if (count($sub_cat) > 0) {

            // Fetch product type IDS from DB..............................

            $can_perform_array = array();
            ?>

                    <select name="sub_category_id" id="sub_category_id" class="form-control" style="margin-top:-12px;">

                        <!-- <option value="0">Select Category</option> -->

            <?php
            foreach ($sub_cat as $row) {

                $product_bunch_id = $row['product_bunch_id'];

                $productbunch_english_name = $row['productbunch_english_name'];

                $category_id = $row['category_id'];

                $selected = '';

                if (isset($can_perform_array) && count($can_perform_array) > 0) {

                    if (in_array($product_bunch_id, $can_perform_array)) {

                        $selected = 'selected=selected';
                    }
                } else {

                    $selected = '';
                }
                ?>

                            <option <?php echo $selected; ?> data-cat="<?php echo $category_id; ?>"value="<?php echo $product_bunch_id; ?>"><?Php echo $productbunch_english_name; ?></option>

            <?php } ?>

                    </select>

        <?php } ?>

            </div>

        </div>

        <?php
    }

}
