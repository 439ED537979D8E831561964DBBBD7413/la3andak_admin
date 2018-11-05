<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/bootstrap.min.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/lib/google-code-prettify/prettify.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/style.css" />
<link href="<?php echo base_url();?>js/datetimeboot/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/datetimeboot/moment-with-locales.js"></script>
<script src="<?php echo base_url();?>js/datetimeboot/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$(function () {
    $('#events_date').datetimepicker({ format: 'YYYY-MM-DD'});
});


$(function () {
    $('#events_date1').datetimepicker({ format: 'YYYY-MM-DD'});
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
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "promocode/location_action_edit" ?>">

                <input type="hidden" name="id" value="<?php echo ($promocode[0]['promocode_id'] != '') ? $promocode[0]['promocode_id'] : ''; ?>">        
                    <div class="col-md-8">
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Promocode<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="text" name="promocode" class="form-control" id="promocode" placeholder="Promocode" value="<?php echo ($promocode[0]['promocode'] != '') ? $promocode[0]['promocode'] : ''; ?>" required data-validate-length-range="2,6" readonly="">
                                 <!-- <br><button type="button" name="newpromocode" id="newpromocode" class="btn btn-sm btn-default">Generate PromoCode</button> -->
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
                                <?php if($promocode[0]['offers_type']=='FLAT') 
                                { ?>
                                <select class="form-control" name="status">                                
                                    <option value="FLAT" selected="">FLAT</option>
                                    <option value="PERCENTAGE">PERCENTAGE</option>                
                                </select>
                                <?php } ?>

                                <?php if($promocode[0]['offers_type']=='PERCENTAGE') 
                                { ?>
                                <select class="form-control" name="status">                                
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
                                        if ($promocode[0]['always_available']=='YES') {
                                          echo '<input type="checkbox" checked id="always_available" name="always_available" value="YES" />Allow For All Days';
                                        }
                                        else{
                                          echo '<input type="checkbox" id="always_available" name="always_available" value="YES" />Allow For All Days';
                                        }
                                        ?>
                                   </div>
                        </div>

                        <div class="form-group" id="always_available_div" >
                                   <label for="default_banner" class="control-label col-md-3 col-sm-3 col-xs-12">Add to Banner</label>
                                   <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                    <?php
                                        if ($promocode[0]['default_banner']==1) {
                                            echo '<input type="checkbox" checked id="default_banner" name="default_banner" value="1" />  Add to Banner ';
                                        }
                                        else{
                                            echo '<input type="checkbox" id="default_banner" name="default_banner" value="1" />  Add to Banner ';
                                        }
                                    ?>
                                      
                                   </div>
                        </div>

                        <div class="form-group" id="always_available_div" >
                                   <label for="multiple" class="control-label col-md-3 col-sm-3 col-xs-12">Add to Multiple time use</label>
                                   <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                    <?php
                                        if ($promocode[0]['multiple']==1) {
                                            echo '<input type="checkbox" checked id="multiple" name="multiple" value="1" /> Add to Multiple time use  ';
                                        }
                                        else{
                                            echo '<input type="checkbox" id="multiple" name="multiple" value="1" /> Add to Multiple time use ';
                                        }
                                    ?>
                                      
                                   </div>
                        </div>

                        <div class="form-group " id="date_pickers">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Range</label>
                                    <div class="col-md-4 col-sm-4 col-xs-12 custom-select">
                                        <input class="form-control default-date-picker col-md-4"  id="date" name="date"  type="text" readonly required value="" />
                                    </div>
                                    <div class="col-md-1">To</div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 custom-select">
                                            <input class="form-control default-date-picker"  id="date1" name="date1"  type="text" readonly value="" />
                                        </div>
                        </div>
                                <?php
                                $promocode_start_date=$row['promocode_start_date'];
                                $promocode_end_date=$row['promocode_end_date'];

                                ?>
                    
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
<<script type="text/javascript">
    // working on propmocode
$.extend({
  randompromocode: function (length, special) {
    var iteration = 0;
    var randompromocode = "";
    var randomNumber;
    if(special == undefined){
        var special = false;
    }
    while(iteration < length){
        randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
        if(!special){
            if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
            if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
            if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
            if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
        }
        iteration++;
        randompromocode += String.fromCharCode(randomNumber);
    }
    return randompromocode.toUpperCase();
  }
});

  $('#newpromocode').click(function(e){
      randompromocode = $.randompromocode(6,false);
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
date time picker

 jQuery('#date').datepicker({changeMonth: true,
changeYear: true,
/*showOtherMonths: true,*/
dateFormat: 'dd-mm-yy',
/*selectOtherMonths: true*/

  });
     
jQuery('#date1').datepicker({changeMonth: true,
changeYear: true,
/*showOtherMonths: true,*/
dateFormat: 'dd-mm-yy',
/*selectOtherMonths: true
*/
  });

//for listing
    if($('#add_into_comman').is(":checked")) {
        $('#listing_div').removeClass('activeclass');
        $('#listing_div').addClass('inactiveclass');
    }
    $('#add_into_comman').on('click', function() {
        if ($(this).prop('checked')==true){
            $('#listing_div').removeClass('activeclass');
            $('#listing_div').addClass('inactiveclass');
        }
        else{
            $('#listing_div').removeClass('inactiveclass');
            $('#listing_div').addClass('activeclass');
        }
    });
 $('#always_available').change(function() {
    if($(this).is(":checked")) {
      // $('#threshold_quantity_div').removeClass('activeclass');
      $('#date_pickers').addClass('inactiveclass');
    }
    else{
      // $('#threshold_quantity_div').addClass('activeclass');
      $('#date_pickers').removeClass('inactiveclass');
    }
  });
$(document).ready(function() {
  // make code pretty
  window.prettyPrint && prettyPrint();
  
  if ( window.location.hash ) {
    scrollTo(window.location.hash);
  }
  
  $('.nav').on('click', 'a', function(e) {
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

    moveToRight: function(Multiselect, options, event, silent, skipStack) {
      var button = $(event.currentTarget).attr('id');

      if (button == 'multi_d_rightSelected') {
        var left_options = Multiselect.left.find('option:selected');
        Multiselect.right.eq(0).append(left_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
        }
      } else if (button == 'multi_d_rightAll') {
        var left_options = Multiselect.left.find('option');
        Multiselect.right.eq(0).append(left_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
        }
      } else if (button == 'multi_d_rightSelected_2') {
        var left_options = Multiselect.left.find('option:selected');
        Multiselect.right.eq(1).append(left_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.right.eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
        }
      } else if (button == 'multi_d_rightAll_2') {
        var left_options = Multiselect.left.find('option');
        Multiselect.right.eq(1).append(left_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.right.eq(1).eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
        }
      }
    },

    moveToLeft: function(Multiselect, options, event, silent, skipStack) {
      var button = $(event.currentTarget).attr('id');

      if (button == 'multi_d_leftSelected') {
        var right_options = Multiselect.right.eq(0).find('option:selected');
        Multiselect.left.append(right_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
        }
      } else if (button == 'multi_d_leftAll') {
        var right_options = Multiselect.right.eq(0).find('option');
        Multiselect.left.append(right_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
        }
      } else if (button == 'multi_d_leftSelected_2') {
        var right_options = Multiselect.right.eq(1).find('option:selected');
        Multiselect.left.append(right_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
        }
      } else if (button == 'multi_d_leftAll_2') {
        var right_options = Multiselect.right.eq(1).find('option');
        Multiselect.left.append(right_options);

        if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
          Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
        }
      }
    }
  });
});
function scrollTo( id ) {
  if ( $(id).length ) {
    $('html,body').animate({scrollTop: $(id).offset().top - 40},'slow');
  }
}

/* Form Validation */
$(document).ready(function(){
        $("#offer_value,  #min_cost, #threshold_quantity" ).keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
   
        });
       });
       </script>
</body>
</html>
<script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
