<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/bootstrap.min.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/lib/google-code-prettify/prettify.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/style.css" />
<link href="<?php echo base_url(); ?>js/datetimeboot/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/datetimeboot/moment-with-locales.js"></script>
<script src="<?php echo base_url(); ?>js/datetimeboot/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#events_date').datetimepicker({format: 'YYYY-MM-DD'});
    });


    $(function () {
        $('#events_date1').datetimepicker({format: 'YYYY-MM-DD'});
    });
</script>
<style type="text/css">
    .activeclass{
        display: block; 
    }
    .inactiveclass{
        display: none;
    }
    .listing_div{
        margin-left: 7%;
    }
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Promocode</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" onsubmit="form_submit()" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "promocode/promocode_edit_action" ?>">  
                    <input type="hidden" name="id" value="<?php echo ($promocode[0]['promocode_id'] != '') ? $promocode[0]['promocode_id'] : ''; ?>">      
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="text" name="promocode" class="form-control" id="promocode" placeholder="Promocode" value="<?php echo ($promocode[0]['promocode'] != '') ? $promocode[0]['promocode'] : ''; ?>" required data-validate-length-range="2,6">
                                <br><button type="button" name="newpromocode" id="newpromocode" class="btn btn-sm btn-default">Generate PromoCode</button>
                            </div>
                        </div>         

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="promocode_name" name="promocode_name" class="required form-control col-md-7 col-xs-12" placeholder="Promocode Name" type="text" value="<?php echo ($promocode[0]['promocode_name'] != '') ? $promocode[0]['promocode_name'] : ''; ?>" required>
                            </div>
                        </div>              


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode Description<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <textarea name="promocode_description" class="form-control" id="promocode_description" placeholder="Promocode Description" required><?php echo ($promocode[0]['promocode_description'] != '') ? $promocode[0]['promocode_description'] : ''; ?></textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Minimum Amount of order<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="min_cost" name="min_cost" class="required form-control col-md-7 col-xs-12" placeholder="Thresold Amount of order" type="text"  value="<?php echo ($promocode[0]['min_cost'] != '') ? $promocode[0]['min_cost'] : ''; ?>" required>
                            </div>
                        </div>  


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Offers Type<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if ($promocode[0]['offers_type'] == 'FLAT') {
                                    ?>
                                    <select class="form-control" name="offers_type">                                
                                        <option value="FLAT" selected="">FLAT</option>
                                        <option value="PERCENTAGE">PERCENTAGE</option>                
                                    </select>
                                <?php } ?>

                                <?php if ($promocode[0]['offers_type'] == 'PERCENTAGE') {
                                    ?>
                                    <select class="form-control" name="offers_type">                                
                                        <option value="PERCENTAGE">PERCENTAGE</option>
                                        <option value="FLAT" selected="">FLAT</option>                
                                    </select>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group" id="always_available_div" >
                            <label for="always_available" class="control-label col-md-3 col-sm-3 col-xs-12">Mark For Always</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <?php
                                if ($promocode[0]['always_available'] == 'YES') {
                                    echo '<input type="checkbox" checked id="always_available" name="always_available" value="YES" />Allow For All Days';
                                } else {
                                    echo '<input type="checkbox" id="always_available" name="always_available" value="YES" />Allow For All Days';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group" id="always_available_div" >
                            <label for="default_banner" class="control-label col-md-3 col-sm-3 col-xs-12">Add to Banner</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <?php
                                if ($promocode[0]['default_banner'] == 1) {
                                    echo '<input type="checkbox" checked id="default_banner" name="default_banner" value="1" />  Add to Banner ';
                                } else {
                                    echo '<input type="checkbox" id="default_banner" name="default_banner" value="1" />  Add to Banner ';
                                }
                                ?>

                            </div>
                        </div>

                        <div class="form-group" id="always_available_div" >
                            <label for="multiple" class="control-label col-md-3 col-sm-3 col-xs-12">Add to Multiple time use</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
<?php
if ($promocode[0]['multiple'] == 1) {
    echo '<input type="checkbox" checked id="multiple" name="multiple" value="1" /> Add to Multiple time use  ';
} else {
    echo '<input type="checkbox" id="multiple" name="multiple" value="1" /> Add to Multiple time use ';
}
?>

                            </div>
                        </div>


                        <div class="form-group" id="date_picker">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" style="padding-left:10px;">Date Range<span class="required">
                                    * </span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="margin-top:-13px;margin-left: 60px; ">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" placeholder="Date Range From" name="date" id="events_date" class="form-control" value="<?php echo ($promocode[0]['promocode_start_date'] != '') ? $promocode[0]['promocode_start_date'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="margin-top:-13px;margin-left:20px; ">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" placeholder="Date Range To" name="date1" id="events_date1" class="form-control" value="<?php echo ($promocode[0]['promocode_end_date'] != '') ? $promocode[0]['promocode_end_date'] : ''; ?>">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Offer Value<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="offer_value" name="offer_value" class="required form-control col-md-7 col-xs-12" placeholder="Offer Value" type="text" value="<?php echo ($promocode[0]['offer_value'] != '') ? $promocode[0]['offer_value'] : ''; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Offer Image<span class="">*</span>
                            </label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                                <b> For Better Resolution Fix Upload Promocode Image Size to 480 × 360 </b>
                            </div>
                        </div> 
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px">
<?php
if ($promocode[0]['promocode_image'] != "") {
    if ($promocode[0]['promocode_image'] != "no_image.png") {

        $imageWithPath = base_url() . TABLE_PROMOCODE_UPLOAD . $promocode[0]['promocode_image'];
        $imageHTML = $this->general_function->showImage($brand[0]['promocode_image'], $imageWithPath, $promocode[0]['promocode_id']);
        echo $imageHTML;
    } elseif ($promocode[0]['promocode_image'] == "no_image.png") {
        $imageWithPath = base_url() . TABLE_PROMOCODE_UPLOAD . $promocode[0]['promocode_image'];
        $imageHTML = $this->general_function->showImage1($promocode[0]['promocode_image'], $imageWithPath, $promocode[0]['promocode_id']);
        echo $imageHTML;
    }
}
?>
                        </div>

                        <div class="form-group" id="add_into_comman_div">
                            <label for="multiple" class="control-label col-md-3 col-sm-3 col-xs-12">Mark For all</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                            <?php
                            if ($promocode[0]['common'] == 'YES') {
                                echo '<input type="checkbox" checked id="add_into_comman" name="add_into_comman" value="YES" /> Mark for all  ';
                            } else {
                                echo '<input type="checkbox" id="add_into_comman" name="add_into_comman" value="NO"/> Mark for all';
                            }
                            ?>

                            </div>
                        </div>





                        <div class="form-group" style="width: 140%;">
                            <div id="listing_div" >
                                <div id="demo" class="form-group">
                                    <label for="shopname">Consumer List</label>

                                </div>
                                <div  class="form-group" id="consumer_list">
                                    <!-- <h4 id="demo-undo-redo"></h4> -->
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <select name="from" id="undo_redo" class="form-control" size="13" multiple="multiple">
<?php
$promocode_id = $promocode[0]['promocode_id'];
$sql = "SELECT * FROM  users where bIsdelete = 0";
$query = $this->db->query($sql);
$consumer_list = $query->result_array();

$sql1 = "SELECT * FROM offers WHERE promocode_id=" . $promocode_id;
$query1 = $this->db->query($sql1);
$consumeradded1 = $query1->result_array();

$consumeridarra = array();
for ($i = 0; $i < count($consumeradded1); $i++) {
    array_push($consumeridarra, $consumeradded1[$i]['consumer_id']);
}

for ($i = 0; $i < count($consumer_list); $i++) {
    $res = $this->db->query("SELECT COUNT(*) AS counts FROM offers WHERE promocode_id=" . $promocode_id . " AND consumer_id=" . $consumer_list[$i]['user_id']);
    $sub_product = $res->result_array();

    // echo "<option>"; var_dump($sub_product[0]['counts']); echo "</option>";
    if ($sub_product[0]['counts'] == 0) {
        ?>
                                                        <option value="<?php echo $consumer_list[$i]['user_id']; ?>"><?php echo $consumer_list[$i]['ufname'] . ' ' . $consumer_list[$i]['ulname']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>
<!--                                            <button type="button" id="undo_redo_rightAll" class="btn btn-default btn-block"> >> </button>-->
                                            <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block"> > </button>
                                            <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block"> < </button>
<!--                                            <button type="button" id="undo_redo_leftAll" class="btn btn-default btn-block"> << </button>-->
                                            <button type="button" id="undo_redo_redo" class="btn btn-primary btn-block">redo</button>
                                        </div>

                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <select name="to[]" id="undo_redo_to" class="form-control" size="13" multiple="multiple">
                                                <?php
                                                $promocode_id = $promocode[0]['promocode_id'];
                                                $sql = "SELECT * FROM  users where bIsdelete = 0";
                                                $query = $this->db->query($sql);
                                                $consumer_list = $query->result_array();

                                                $sql1 = "SELECT * FROM offers WHERE promocode_id=" . $promocode_id;
                                                $query1 = $this->db->query($sql1);
                                                $consumeradded1 = $query1->result_array();

                                                $consumeridarra = array();
                                                for ($i = 0; $i < count($consumeradded1); $i++) {
                                                    array_push($consumeridarra, $consumeradded1[$i]['consumer_id']);
                                                }

                                                for ($i = 0; $i < count($consumer_list); $i++) {
                                                    $res = $this->db->query("SELECT COUNT(*) AS counts FROM offers WHERE promocode_id=" . $promocode_id . " AND consumer_id=" . $consumer_list[$i]['user_id']);
                                                    $sub_product = $res->result_array();

                                                    // echo "<option>"; var_dump($sub_product[0]['counts']); echo "</option>";
                                                    if ($sub_product[0]['counts'] == 1) {
                                                        ?>
                                                        <option value="<?php echo $consumer_list[$i]['user_id']; ?>"><?php echo $consumer_list[$i]['ufname'] . ' ' . $consumer_list[$i]['ulname']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">

                                        </div>
                                    </div>
                                </div>

                            </div></div>
                        <!--                         <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <select class="form-control" name="status">                                
                                                            <option value="1">Active</option>
                                                            <option value="0">Deactive</option>                
                                                        </select>
                                                    </div>
                                                </div>
                        -->
                        <div class="col-md-6">                        
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
    // working on propmocode
    $.extend({
        randompromocode: function (length, special) {
            var iteration = 0;
            var randompromocode = "";
            var randomNumber;
            if (special == undefined) {
                var special = false;
            }
            while (iteration < length) {
                randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
                if (!special) {
                    if ((randomNumber >= 33) && (randomNumber <= 47)) {
                        continue;
                    }
                    if ((randomNumber >= 58) && (randomNumber <= 64)) {
                        continue;
                    }
                    if ((randomNumber >= 91) && (randomNumber <= 96)) {
                        continue;
                    }
                    if ((randomNumber >= 123) && (randomNumber <= 126)) {
                        continue;
                    }
                }
                iteration++;
                randompromocode += String.fromCharCode(randomNumber);
            }
            return randompromocode.toUpperCase();
        }
    });

    $('#newpromocode').click(function (e) {
        randompromocode = $.randompromocode(6, false);
        $('#promocode').val(randompromocode);
        e.preventDefault();
    });

</script>


<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/js/prettify.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/js/multiselect.min.js"></script>
<script>
    /* Form Validation */
    // $(document).ready(function(){
    //   $('#myform').submit(function(){
    //     if($("#always_available").prop('checked') != true){
    //       if ($("#date").val()=='' || $("#date1").val()=='') {
    //           alert("Please Select date");
    //           return false;
    //       }
    //     }
    //   });
    // });
//date time picker

//  jQuery('#date').datepicker({changeMonth: true,
// changeYear: true,
// /*showOtherMonths: true,*/
// dateFormat: 'dd-mm-yy',
// /*selectOtherMonths: true*/

//   });

// jQuery('#date1').datepicker({changeMonth: true,
// changeYear: true,
// /*showOtherMonths: true,*/
// dateFormat: 'dd-mm-yy',
// /*selectOtherMonths: true
// */
//   });

//for listing
    if ($('#add_into_comman').is(":checked")) {
        $('#listing_div').removeClass('activeclass');
        $('#listing_div').addClass('inactiveclass');
    }
    $('#add_into_comman').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('#listing_div').removeClass('activeclass');
            $('#listing_div').addClass('inactiveclass');
        } else {
            $('#listing_div').removeClass('inactiveclass');
            $('#listing_div').addClass('activeclass');
        }
    });
    $('#always_available').change(function () {
        if ($(this).is(":checked")) {
            // $('#threshold_quantity_div').removeClass('activeclass');
            $('#date_pickers').addClass('inactiveclass');
        } else {
            // $('#threshold_quantity_div').addClass('activeclass');
            $('#date_pickers').removeClass('inactiveclass');
        }
    });
    $(document).ready(function () {
        // make code pretty
        window.prettyPrint && prettyPrint();

        if (window.location.hash) {
            scrollTo(window.location.hash);
        }

        $('.nav').on('click', 'a', function (e) {
            scrollTo($(this).attr('href'));
        });

        $('#multiselect').multiselect();
        $('.multiselect').multiselect();
        $('.js-multiselect').multiselect({
            right: '#js_multiselect_to_1',
            rightAll: '#js_right_All_1',
            rightSelected: '#js_right_Selected_1',
            leftSelected: '#js_left_Selected_1',
            leftAll: '#js_left_All_1'
        });

        $('#keepRenderingSort').multiselect({
            keepRenderingSort: true
        });

        $('#undo_redo').multiselect();

        $('#multi_d').multiselect({
            right: '#multi_d_to, #multi_d_to_2',
            rightSelected: '#multi_d_rightSelected, #multi_d_rightSelected_2',
            leftSelected: '#multi_d_leftSelected, #multi_d_leftSelected_2',
            rightAll: '#multi_d_rightAll, #multi_d_rightAll_2',
            leftAll: '#multi_d_leftAll, #multi_d_leftAll_2',

            moveToRight: function (Multiselect, options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');

                if (button == 'multi_d_rightSelected') {
                    var left_options = Multiselect.left.find('option:selected');
                    Multiselect.right.eq(0).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                    }
                } else if (button == 'multi_d_rightAll') {
                    var left_options = Multiselect.left.find('option');
                    Multiselect.right.eq(0).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                    }
                } else if (button == 'multi_d_rightSelected_2') {
                    var left_options = Multiselect.left.find('option:selected');
                    Multiselect.right.eq(1).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                    }
                } else if (button == 'multi_d_rightAll_2') {
                    var left_options = Multiselect.left.find('option');
                    Multiselect.right.eq(1).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(1).eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                    }
                }
            },

            moveToLeft: function (Multiselect, options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');

                if (button == 'multi_d_leftSelected') {
                    var right_options = Multiselect.right.eq(0).find('option:selected');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftAll') {
                    var right_options = Multiselect.right.eq(0).find('option');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftSelected_2') {
                    var right_options = Multiselect.right.eq(1).find('option:selected');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftAll_2') {
                    var right_options = Multiselect.right.eq(1).find('option');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                }
            }
        });
    });
    function scrollTo(id) {
        if ($(id).length) {
            $('html,body').animate({scrollTop: $(id).offset().top - 40}, 'slow');
        }
    }

    /* Form Validation */
    $(document).ready(function () {
        $("#offer_value,  #min_cost, #threshold_quantity").keydown(function (event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
                    // Allow: Ctrl+A
                            (event.keyCode == 65 && event.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (event.keyCode >= 35 && event.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    } else {
                        // Ensure that it is a number and stop the keypress
                        if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                    }

                });
    });
</script>
</body>
</html>
<script>

    $('#promocode_management').addClass('nav-active');
    $('#add_promocode').addClass('active');
</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#image1").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function form_submit() {
        $("#undo_redo").attr("disabled", true);
    }

</script>
<?php
include APPPATH . '/front-modules/views/footer.php';
