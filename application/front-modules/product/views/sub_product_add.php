<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sub Add Product</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "product/sub_product_action" ?>">     




                    <input type="hidden" name="product_id" value="<?php echo ($product[0]['product_id'] != '') ? $product[0]['product_id'] : ''; ?>"">
                    <input type="hidden" name="category_id" value="<?php echo ($product[0]['product_category'] != '') ? $product[0]['product_category'] : ''; ?>"">
                    <input type="hidden" name="sub_category_id" value="<?php echo ($product[0]['product_bunch'] != '') ? $product[0]['product_bunch'] : ''; ?>"">
                    <input type="hidden" name="brand_id" value="<?php echo ($product[0]['product_brand_id'] != '') ? $product[0]['product_brand_id'] : ''; ?>"">
                     <!-- <input type="hidden" name="unit_type" value="<?php echo ($product[0]['unit_type'] != '') ? $product[0]['unit_type'] : ''; ?>""> -->

                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Product Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="product_name" name="product_name" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>                  

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Type<span class="required">
                                    * </span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <div class="input-icon right">
                                    <?php
                                    if (count($unit_type) > 0) {
                                        // Fetch product type IDS from DB..............................
                                        $can_perform_array = array();
                                        ?>
                                        <select name="unit_type" class="form-control" >

                                            <?php
                                            foreach ($unit_type as $row1) {
                                                $type_id = $row1['unit_id'];
                                                $type_name = $row1['unit_name'];
                                                $selected = '';
                                                if (isset($can_perform_array) && count($can_perform_array) > 0) {
                                                    if (in_array($type_id, $can_perform_array)) {
                                                        $selected = 'selected=selected';
                                                    }
                                                } else {
                                                    $selected = '';
                                                }
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $type_id; ?>"><?Php echo $type_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit value<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="unit_value" name="unit_value" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="">*</span>
                            </label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <textarea name="desc" id="desc" class="ckeditor" rows = "4"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Price<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="mrp" name="mrp" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Percentage<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="discount_per" name="discount_per" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Starting Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="offer_start_date" name="offer_start_date" value="" class="form-control col-md-7 col-xs-12" type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount End Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="offer_end_date" name="offer_end_date" value="" class="form-control col-md-7 col-xs-12" type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="quantity" name="quantity" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Max Product Quantity Limit<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="max_product" name="max_product" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Product Image<span class="">*</span>
                            </label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="status">                                
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>                
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">                        
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                                <input type="submit" class="btn btn-success">
                                <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                            </div>
                        </div></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#form_add_item').submit(function () {
            if ($("#category_id").val() == 0) {
                alert("Please Select Category");
                return false;
            }
            if ($("#sub_category_id").val() == 0) {
                alert("Please Select SubCategory");
                return false;
            }
        });
    });
    function get_sub_category_ajax(category)
    {



        if (category) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>product/get_sub_category/" + category,
                data: "cid=" + category,
                beforeSend: function () {
                    $("#product_bunch").html("<option></option>");
                },

                success: function (response) {
                    jQuery("#productAjax").html(response);
                    jQuery("#productAjax").show();
                }
            });
        }
        ;
    }


    $('#unit_value').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

    $('#mrp').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

    $('#discount_per').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

    $('#quantity').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

    $('#max_product').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });
</script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
