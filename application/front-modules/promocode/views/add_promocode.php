<?php include APPPATH . '/front-modules/views/top.php'; ?>


<!--=== Container Part ===-->

<base href="http://crlcu.github.io/multiselect/" />
<link rel="icon" type="image/x-icon" href="https://github.com/favicon.ico" />
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>multiselect/lib/google-code-prettify/prettify.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>multiselect/css/style.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>multiselect/dist/js/multiselect.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>



<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-39934286-1', 'github.com');
    ga('send', 'pageview');
</script>

<script type="text/javascript">
    $(document).ready(function () {
        // make code pretty
        window.prettyPrint && prettyPrint();

        // hack for iPhone 7.0.3 multiselects bug
        if (navigator.userAgent.match(/iPhone/i)) {
            $('select[multiple]').each(function () {
                var select = $(this).on({
                    "focusout": function () {
                        var values = select.val() || [];
                        setTimeout(function () {
                            select.val(values.length ? values : ['']).change();
                        }, 1000);
                    }
                });
                var firstOption = '<option value="" disabled="disabled"';
                firstOption += (select.val() || []).length > 0 ? '' : ' selected="selected"';
                firstOption += '>Select ' + (select.attr('title') || 'Options') + '';
                firstOption += '</option>';
                select.prepend(firstOption);
            });
        }

        $('#multiselect1').multiselect();
        $('#multiselect2').multiselect();
    });

    $(document).ready(function ()
    {
        $('#category_main').hide();
    });
    $(document).ready(function ()
    {
        $('#sub_category_main').hide();
    });
    $(document).ready(function ()
    {
        $('#product_wise_main').hide();
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#events_date").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            onSelect: function (date) {
                var dt2 = $('#datepicker1');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                dt2.datepicker('option', 'maxDate', startDate);
                dt2.datepicker('option', 'minDate', minDate);
                //$(this).datepicker('option', 'minDate', minDate);
            }
        }).on('change', function () {
            $(this).valid();
        });

        $("#datepicker1").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: 0,
        });


        $("#always_available").change(function () {
            $("#events_date").val('');
            $("#events_date1").val('');
        });
    });

</script>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

            <div class="x_title">

                <h2>Add Promocode</h2>

                <div class="clearfix"></div>

            </div>

            <div class="x_content">

                <br />

                <form id="customer_form" method="post" onsubmit="form_submit()" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "promocode/promocode_action" ?>">

                    <div class="col-md-8" style="margin-left:5%">




                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Promocode type<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <select name="main_type" class="form-control" id="main_type" placeholder="Hello" onchange="change_type(this.value)">
                                    <option value="0">--Please Select Promocode Type--</option>
                                    <option>Normal</option>
                                    <option>Category</option>
                                    <option>Sub Category</option>
                                    <option>Product</option>
                                </select>



                            </div>

                        </div>



                        <div class="form-group" id="category_main">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <select name="category_main[]" class="chosen form-control" id="cat_main" multiple="">

                                    <?php
                                    foreach ($category as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_english_name']; ?></option>
                                    <?php }
                                    ?>
                                </select>



                            </div>

                        </div>

                        <div class="form-group" id="sub_category_main">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select sub Category<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <select name="sub_category_main[]" class="chosen form-control" id="main_type" multiple="">
                                    <?php
                                    foreach ($sub_category as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['product_bunch_id']; ?>"><?php echo $value['productbunch_english_name']; ?></option>
                                    <?php }
                                    ?>
                                </select>



                            </div>

                        </div>

                        <div class="form-group" id="product_wise_main">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select product<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <select name="product_wise_main[]" class="chosen form-control" id="main_type" multiple="">
                                    <?php
                                    $query2 = $this->db->query("SELECT p.*,u.* FROM product as p Left join unit_type as u On p.unit_type = u.unit_id WHERE p.bIsdelete = 0");

                                    $result2 = $query2->result_array();


                                    foreach ($result2 as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['product_id']; ?>"><?php echo $value['product_english_name'] . " " . $value['unit_value'] . " " . $value['display_name']; ?></option>
                                    <?php }
                                    ?>
                                </select>



                            </div>

                        </div>










                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input type="text" name="promocode" class="form-control" id="promocode" placeholder="Promocode" value="" required data-validate-length-range="2,6">

                                <br><button type="button" name="newpromocode" id="newpromocode" class="btn btn-sm btn-default">Generate PromoCode</button>

                            </div>

                        </div>






                        <!-- <div>
                          <p>Date: <input type="text" id="datepicker"></p>
                        </div>
                        -->


                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode Name<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input id="promocode_name" name="promocode_name" class="required form-control col-md-7 col-xs-12" placeholder="Promocode Name" type="text" value="<?php echo ($all['promocode_name'] != '') ? $all['promocode_name'] : ''; ?>" required>

                            </div>

                        </div>





                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode Description<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <textarea name="promocode_description" class="form-control" id="promocode_description" placeholder="Promocode Description" required></textarea>

                            </div>

                        </div>



                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Minimum Amount of order<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input id="min_cost" name="min_cost" class="required form-control col-md-7 col-xs-12" placeholder="Thresold Amount of order" type="text" value="<?php echo ($all['min_cost'] != '') ? $all['min_cost'] : ''; ?>" required>

                            </div>

                        </div>



                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Offers Type<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <select class="form-control" name="offers_type">

                                    <option value="FLAT">Flat</option>

                                    <option value="PERCENTAGE">Percentage</option>

                                </select>

                            </div>

                        </div>



                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Offer Value<span class="required">*</span>

                            </label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input id="offer_value" name="offer_value" class="required form-control col-md-7 col-xs-12" placeholder="Offer Value" type="text" value="<?php echo ($all['offer_value'] != '') ? $all['offer_value'] : ''; ?>" required>

                            </div>

                        </div>



                        <div class="form-group" id="always_available_div" >

                            <label for="always_available" class="control-label col-md-3 col-sm-3 col-xs-12">  Mark For Always</label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input type="checkbox" id="always_available" name="always_available" value="YES" />   Allow For All Days

                            </div>

                        </div>

                        <div class="form-group" id="date_pickers" style="margin-left:65px">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date Range

                            </label>

                            <div class="col-md-5 col-sm-5 col-xs-12 custom-select" style="margin-top:-13px;">

                                <div class="input-icon right">

                                    <i class="fa"></i>

                                    <input type="text" placeholder="Date Range From" readonly="" name="events_date" id="events_date" class="form-control" value="">

                                </div>

                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-12 custom-select" style="margin-top:-13px;">

                                <div class="input-icon right">

                                    <i class="fa"></i>

                                    <input type="text" placeholder="Date Range To" readonly="" name="events_date1" id="datepicker1" class="form-control" value="">

                                </div>

                            </div>

                        </div>

                        <!--  <div class="form-group" id="always_available_div" >

                            <label for="default_banner"  class="control-label col-md-3 col-sm-3 col-xs-12">Add to Banner</label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                               <input type="checkbox" id="default_banner" name="default_banner" value="1" />  Add to Banner

                            </div>

                         </div>
                        -->
                        <!--  <div class="form-group" >

                            <label for="multiple"  class="control-label col-md-3 col-sm-3 col-xs-12">Add to multiple time use</label>

                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                               <input type="checkbox" id="multiple" name="multiple" value="1" />  Add to multiple time use

                            </div>

                         </div>
                        -->







                        <div class="form-group">

                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Offer Image<span class="">*</span>

                            </label>

                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/><br><br>

                                <b> For Better Resolution Fix Upload Promocode Image Size to 480 × 360 </b>



                            </div>

                        </div>



                        <div class="form-group" id="add_into_comman_div">

                            <!-- <div class="item form-group" > -->

                            <label for="shopname" class="control-label col-md-3 col-sm-3 col-xs-12">Mark for all </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <input type="checkbox" id="add_into_comman" name="add_into_comman" value="YES" />  Mark for all User

                            </div>

                        </div>


                        <div class="form-group" id="add_into_notification_div">

                            <!-- <div class="item form-group" > -->

                            <label for="notification" class="control-label col-md-3 col-sm-3 col-xs-12">Send Notification </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <input type="checkbox" id="add_into_notification" name="add_into_notification" value="YES" /> Mark for Send Notification

                            </div>

                        </div> 

                        <div class="form-group">

                            <div id="listing_div" style="width: 110%;margin-left: 5%">


                                <div class="col-sm-5">
                                    <select name="from[]" id="multiselect1" class="form-control" size="8" multiple="multiple">
                                        <?php
                                        $sql = "SELECT * FROM  users where bIsdelete = 0";

                                        $query = $this->db->query($sql);

                                        $array = $query->result_array();

                                        for ($i = 0; $i < count($array); $i++) {
                                            ?>

                                            <option value="<?php echo $array[$i]['user_id']; ?>"><?php echo $array[$i]['ufname'] . ' ' . $array[$i]['ulname']; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-2">
      <!--                              <button type="button" id="multiselect1_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
                                    <button type="button" id="multiselect1_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                    <button type="button" id="multiselect1_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
      <!--                              <button type="button" id="multiselect1_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
                                </div>

                                <div class="col-sm-5">
                                    <select name="to[]" id="multiselect1_to" class="form-control" size="8" multiple="multiple"></select>
                                </div>

                            </div></div>

                        <div class="col-md-4">

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
    $(".chosen").chosen();
</script>


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


    $('#add_into_comman').change(function () {
        if (this.checked) {
            $("#multiselect1").attr("disabled", true);
            $("#multiselect1_to").attr("disabled", true);
        } else {
            $("#multiselect1").attr("disabled", false);
            $("#multiselect1_to").attr("disabled", false);
        }
    });



</script>





<script>



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
            $('#date_pickers').addClass('inactiveclass');
        } else {
            $('#date_pickers').removeClass('inactiveclass');
        }
    });

    $('#add_into_notification').change(function ()
    {

        if ($(this).is(":checked"))
        {

        } else
        {

        }

    });



</script>

<script type="text/javascript">
    function change_type(hello)
    {
        if (hello == 'Category')
        {
            $('#category_main').show();
            $('#sub_category_main').hide();
            $('#product_wise_main').hide();
            // document.getElementById(product_main).options.length = 0;
            // document.getElementById(sub_cat_main).options.length = 0;
        }
        if (hello == 'Sub Category')
        {
            $('#category_main').hide();
            $('#sub_category_main').show();
            $('#product_wise_main').hide();
        }
        if (hello == 'Product')
        {
            $('#category_main').hide();
            $('#sub_category_main').hide();
            $('#product_wise_main').show();
        }

        if (hello == 'Normal')
        {
            $('#category_main').hide();
            $('#sub_category_main').hide();
            $('#product_wise_main').hide();
        }
        if (hello == 0)
        {
            $('#category_main').hide();
            $('#sub_category_main').hide();
            $('#product_wise_main').hide();
        }

    }
</script>

<script type="text/javascript">
    $('#min_cost').keypress(function (event) {

        var keycode = event.which;

        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

            event.preventDefault();

        }

    });

    $('#offer_value').keypress(function (event) {

        var keycode = event.which;

        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

            event.preventDefault();

        }
    });
    function form_submit() {
        $("#multiselect1").attr("disabled", true);
    }

</script>

<?php
include APPPATH . '/front-modules/views/footer.php';

