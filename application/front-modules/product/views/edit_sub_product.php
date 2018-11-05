<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Sub Product</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "product/sub_product_action_edit" ?>">    



                    <input type="hidden" name="product_id" value="<?php echo ($product[0]['product_id'] != '') ? $product[0]['product_id'] : ''; ?>"">

                    <input type="hidden" name="subproduct_id" value="<?php echo ($product[0]['subproduct_id'] != '') ? $product[0]['subproduct_id'] : ''; ?>"">

                    <input type="hidden" name="category_id" value="<?php echo ($product[0]['product_category'] != '') ? $product[0]['product_category'] : ''; ?>"">
                    <input type="hidden" name="sub_category_id" value="<?php echo ($product[0]['product_bunch'] != '') ? $product[0]['product_bunch'] : ''; ?>"">
                    <input type="hidden" name="brand_id" value="<?php echo ($product[0]['product_brand_id'] != '') ? $product[0]['product_brand_id'] : ''; ?>"">
                     <!-- <input type="hidden" name="unit_type" value="<?php echo ($product[0]['unit_type'] != '') ? $product[0]['unit_type'] : ''; ?>""> -->

                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Product Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="product_name" name="product_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['product_english_name'] != '') ? $product[0]['product_english_name'] : ''; ?>" required>
                            </div>
                        </div>                  

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Type<span class="required">*</span>
                            </label>                           
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <?php echo '<select class="form-control" name="unit_type" id="unit_type">';
                                ?>
                                <?php
                                for ($i = 0; $i < count($unit_type); $i++) {
                                    if (($unit_type[$i]['unit_id']) == $product[0]['unit_type']) {
                                        ?>

                                        <option selected="" value="<?php echo $unit_type[$i]['unit_id']; ?>"><?php echo $unit_type[$i]['unit_name']; ?></option>

                                    <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $unit_type[$i]['unit_id']; ?>"><?php echo $unit_type[$i]['unit_name']; ?></option>
                                    <?php
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit value<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="unit_value" name="unit_value" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['unit_value'] != '') ? $product[0]['unit_value'] : ''; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="">*</span>
                            </label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <textarea name="desc" id="desc" class="ckeditor" rows = "4"><?php echo ($product[0]['product_description'] != '') ? $product[0]['product_description'] : ''; ?></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Price<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="mrp" name="mrp" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['mrp'] != '') ? $product[0]['mrp'] : ''; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Percentage<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="discount_per" name="discount_per" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['discount_percentage'] != '') ? $product[0]['discount_percentage'] : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount Starting Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="offer_start_date" name="offer_start_date" value="<?php echo ($product[0]['offer_start_date'] != '') ? $product[0]['offer_start_date'] : ''; ?>" class="form-control col-md-7 col-xs-12" type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount End Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="offer_end_date" name="offer_end_date" value="<?php echo ($product[0]['offer_end_date'] != '') ? $product[0]['offer_end_date'] : ''; ?>" class="form-control col-md-7 col-xs-12" type="date">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="quantity" name="quantity" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['quantity'] != '') ? $product[0]['quantity'] : ''; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Max Product Quantity Limit<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="max_product" name="max_product" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($product[0]['max_sale_qty'] != '') ? $product[0]['max_sale_qty'] : ''; ?>" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Product Image<span class="">*</span>
                            </label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px">
                            <?php
                            if ($product[0]['product_image'] != "") {
                                if ($product[0]['product_image'] != "no_image.png") {

                                    $imageWithPath = base_url() . TABLE_PRODUCT_UPLOAD . $product[0]['product_image'];
                                    $imageHTML = $this->general_function->showImage($product[0]['product_image'], $imageWithPath, $product[0]['product_id']);
                                    echo $imageHTML;
                                } elseif ($product[0]['product_image'] == "no_image.png") {
                                    $imageWithPath = base_url() . TABLE_PRODUCT_UPLOAD . $product[0]['product_image'];
                                    $imageHTML = $this->general_function->showImage1($product[0]['product_image'], $imageWithPath, $product[0]['product_id']);
                                    echo $imageHTML;
                                }
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
<?php if ($product[0]['product_status'] == 1) {
    ?>
                                    <select class="form-control" name="status">                                
                                        <option value="1" selected="">Active</option>
                                        <option value="0">Deactive</option>                
                                    </select>
<?php } ?>

<?php if ($product[0]['product_status'] == 0) {
    ?>
                                    <select class="form-control" name="status">                                
                                        <option value="1" >Active</option>
                                        <option value="0" selected="">Deactive</option>                
                                    </select>
<?php } ?>
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
</script>
<script type="text/javascript">
    $(".remove_image").click(function () {

        id = this.id;


        if (confirm("Are you sure? You want to delete this image?"))

        {

            $('#AjaxLoaderDiv').fadeIn('slow');

            $.ajax({

                type: 'post',

                url: '<?php echo base_url(); ?>product/removeImage',

                data: {'id': id},

                success: function (data) {

                    $('#AjaxLoaderDiv').fadeOut('fast');

                    location.reload();

                },

                error: function (e) {

                    alert(e)

                }

            })

        }

    })



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
