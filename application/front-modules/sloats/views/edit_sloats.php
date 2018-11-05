<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit SLoat</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

             
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "sloats/sloats_action_edit" ?>">      

                    <div class="col-md-8">  

                           
                        <?php  
                                $starray=explode(':',$seller[0]['slot_start_time']);
                                    $sthours=$starray[0];
                                    $stmin=$starray[1];

                                    $etarray=explode(':',$seller[0]['slot_end_time']);
                                    $endhours=$etarray[0];
                                    $endmin=$etarray[1];

                                    $break_st_array=explode(':', $seller[0]['break_start_time']);
                                    $break_st_hours=$break_st_array[0];
                                    $break_st_min=$break_st_array[1];

                                    $break_et_array=explode(':',$seller[0]['break_end_time']);
                                    $break_end_hours=$break_et_array[0];
                                    $break_end_min=$break_et_array[1];

                                   $order_limit=$order[0]['setting_value'];

                                  // var_dump($order_limit);

                         ?>
                         <input type="hidden" name="seller_id" value="1">
                         <input type="hidden" name="order_limit" value="<?php echo $order_limit;?>">

                         <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Opening Time</label>                            
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                            <p style="float: left;"> Hours</p> 
                                        <select class="form-control " name="sthours" id="sthours">
                                        <?php
                                        for ($i=1; $i <24 ; $i++) {
                                            if ((int)$sthours==$i) {
                                                $selected_sth="selected";
                                            }
                                            else{
                                                $selected_sth="";
                                            }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $i);?>" <?php echo $selected_sth;?>><?php echo sprintf("%02d", $i);?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                      <p style="float: left;">Minute</p>
                                        <select class="form-control " name="stmin" id="stmin">
                                        <?php
                                        for ($j=0; $j <60 ; $j++) {
                                            if ($j%5==0) {
                                                if ((int)$stmin==$j) {
                                                    $selected_stm="selected";
                                                }
                                                else{
                                                    $selected_stm="";
                                                }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $j);?>" <?php echo $selected_stm;?>><?php echo sprintf("%02d", $j);?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                         </div>


                         <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Break Start Time</label>                            
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                            <p style="float: left;"> Hours</p> 
                                       <select class="form-control " name="bthours" id="bthours">
                                        <?php
                                        for ($i=1; $i <=23; $i++) {
                                            if ($i==$break_st_hours) {
                                                    $selected_bsth="selected";
                                                }
                                                else{
                                                    $selected_bsth="";
                                                }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $i);?>" <?php echo $selected_bsth; ?>><?php echo sprintf("%02d", $i);?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                      <p style="float: left;">Minute</p>
                                       <select class="form-control " name="btmin" id="btmin">
                                        <?php
                                        for ($j=0; $j < 60 ; $j++) {
                                            if ($j==$break_end_min) {
                                                $selected_bendmin="selected";
                                            }
                                            else{
                                                $selected_bendmin="";
                                            }
                                            if ($j%5==0) {                                              
                                            ?>
                                            <option <?php echo $selected_bendmin;?>value="<?php echo sprintf("%02d", $j);?>"><?php echo sprintf("%02d", $j);?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                         </div>




                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Break End Time</label>                            
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                            <p style="float: left;"> Hours</p> 
                                      <select class="form-control " name="bendhours" id="bendhours">
                                        <?php
                                        for ($i=1; $i <=23 ; $i++) {
                                            if ($i==$break_end_hours) {
                                                    $selected_bendh="selected";
                                                }
                                                else{
                                                    $selected_bendh="";
                                                }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $i);?>" <?php echo $selected_bendh;?>><?php echo sprintf("%02d", $i);?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                      <p style="float: left;">Minute</p>
                                      <select class="form-control " name="bendmin" id="bendmin">
                                        <?php
                                        for ($j=0; $j < 60 ; $j++) {
                                            if ($j%5==0) {
                                                if ($j==$break_end_min) {
                                                    $selected_bstmin="selected";
                                                }
                                                else{
                                                    $selected_bstmin="";
                                                }
                                                
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $j);?>" <?php echo $selected_bstmin;?>><?php echo sprintf("%02d", $j);?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                         </div>




                                                  <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Closing Time</label>                            
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                            <p style="float: left;"> Hours</p> 
                                       <select class="form-control " name="endhours" id="endhours">
                                        <?php
                                        for ($i=1; $i < 24 ; $i++) {
                                            if ((int)$endhours==$i) {
                                                    $selected_eth="selected";
                                                }
                                                else{
                                                    $selected_eth="";
                                                }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $i);?>" <?php echo $selected_eth;?> ><?php echo sprintf("%02d", $i);?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="control-label col-md-5 col-sm-5 col-xs-6">
                                      <p style="float: left;">Minute</p>
                                        <select class="form-control " name="endmin" id="endmin">
                                        <?php
                                        for ($j=0; $j < 60 ; $j++) 
                                        {
                                            if ($j%5==0) {
                                                if ((int)$endmin==$j) {
                                                    $selected_etm="selected";
                                                }
                                                else{
                                                    $selected_etm="";
                                                }
                                            ?>
                                            <option value="<?php echo sprintf("%02d", $j);?>" <?php echo $selected_etm;?> ><?php echo sprintf("%02d", $j);?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                         </div>



                            <div class="form-group">
                                <label for="shoprgno" class="control-label col-md-3 col-sm-3 col-xs-12">Interval Minute</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                    <?php                                    
                                            $counter=0;
                                              

                                              for ($i=0; $i<count($interval_tab); $i++) 
                                            { 
                                               if ($seller[0]['interval_min']==$interval_tab[$i]['interval_hour']) 
                                                {
                                                    $checked='checked';
                                                }
                                                else
                                                {
                                                    $checked='';
                                                }
                                                $counter++;
                                            

                                            ?>
                                             <input type="radio" name="interval_min" value="<?php echo $interval_tab[$i]['interval_hour'];?>" <?php echo $checked;?>>
                                                <span style="margin-right: 6px;padding-left: 3px;" ><?php echo $interval_tab[$i]['interval_hour'].' - Hours';?></span>
                                                <?php if ($counter%3==0 && $counter>0): ?>
                                                    </br>
                                                    </br>
                                                <?php endif;

                                               }

                                                ?>

                                                </div>                                    
                                </div>










                    </div>                    
                    <div class="col-md-4">                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                            <input type="submit" class="btn btn-success">
                            <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".remove_image").click(function(){

 id=this.id;


    if(confirm("Are you sure? You want to delete this image?"))

    {

        $('#AjaxLoaderDiv').fadeIn('slow');

        $.ajax({

          type: 'post',

          url : '<?php echo base_url(); ?>brand/removeImage',

          data: {'id' : id},

          success: function(data){

            $('#AjaxLoaderDiv').fadeOut('fast');

            location.reload();

          },

          error: function (e){

            alert (e)

          }

        })

    }

})





</script>
<script type="text/javascript">
    $( document ).ready(function() {
        // start time hours condions
        $("#sthours").change(function(){
            var minvalue = $(this).val();
            flag=true;
            for (var i = 1; i <= 23 ; i++)
            {
                if (i< minvalue) {
                    $("#bthours option[value='"+("0" + i).slice(-2)+"'], #bendhours option[value='"+("0" + i).slice(-2)+"'], #endhours option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag) {
                        if ($('#bthours').val()<i) {
                            $("#bthours").val(("0" + i).slice(-2));
                        };
                        if ($('#bendhours').val()<i) {
                            $("#bendhours").val(("0" + i).slice(-2));
                        };
                        if ($('#endhours').val()<i) {
                            $("#endhours").val(("0" + i).slice(-2));
                        };
                        // $("#bthours, #bendhours, #endhours").val(("0" + i).slice(-2));
                        flag=false;
                    };
                    $("#bthours option[value='"+("0" + i).slice(-2)+"'], #bendhours option[value='"+("0" + i).slice(-2)+"'], #endhours option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });
        // break start time hours contions
        $("#bthours").change(function(){
            var minvalue = $(this).val();
            flag=true;
            for (var i = 1; i <= 23 ; i++)
            {
                if (i<minvalue) {
                    $("#bendhours option[value='"+("0" + i).slice(-2)+"'], #endhours option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag) {
                        if ($('#bendhours').val()<i) {
                            $("#bendhours").val(("0" + i).slice(-2));
                        };
                        if ($('#endhours').val()<i) {
                            $("#endhours").val(("0" + i).slice(-2));
                        };
                        //$("#bendhours, #endhours").val(("0" + i).slice(-2));
                        flag=false;
                    };
                    $("#bendhours option[value='"+("0" + i).slice(-2)+"'], #endhours option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });
        // break end time hours contions
        $("#bendhours").change(function(){
            var minvalue = $(this).val();
            flag=true;
            for (var i = 1; i <= 23 ; i++)
            {
                if (i<minvalue) {
                    $("#endhours option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag) {
                        if ($('#endhours').val()<i) {
                            $("#endhours").val(("0" + i).slice(-2));
                        };
                        //$("#endhours").val(("0" + i).slice(-2));
                        flag=false;
                    };
                    $("#endhours option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });

        // start time Minute condions
        $("#stmin").change(function(){
            var minvalue = $(this).val();
            flag=true;
            flag1=true;
            flag2=true;
            for (var i = 0; i <= 59 ; i++)
            {
                // start break time
                if (i < minvalue && $('#sthours').val() == $('#bthours').val()) {
                    $("#btmin option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag && $('#sthours').val() == $('#bthours').val() ) {
                        if ($('#btmin').val()<i) {
                            $("#btmin").val(("0" + i).slice(-2));
                        };
                        flag=false;
                    };
                    $("#btmin option[value='"+("0" + i).slice(-2)+"']").show();
                }
                // end break time 
                if (i < minvalue && $('#sthours').val() == $('#bendhours').val()) {
                    $("#bendmin option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag1 && $('#sthours').val() == $('#bendhours').val() ) {
                        if ($('#bendmin').val()<i) {
                            $("#bendmin").val(("0" + i).slice(-2));
                        };
                        flag1=false;
                    };
                    $("#bendmin option[value='"+("0" + i).slice(-2)+"']").show();
                }
                // end closing time 
                if (i < minvalue && $('#sthours').val() == $('#endhours').val()) {
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag2 && $('#sthours').val() == $('#endhours').val() ) {
                        if ($('#endmin').val()<i) {
                            $("#endmin").val(("0" + i).slice(-2));
                        };
                        flag2=false;
                    };
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });

        // break start time with break end & closing end time Minute condions
        $("#btmin").change(function(){
            var minvalue = $(this).val();
            flag=true;
            flag1=true;
            for (var i = 0; i <= 59 ; i++)
            {
                // end break time 
                if (i < minvalue && $('#bthours').val() == $('#bendhours').val()) {
                    $("#bendmin option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag && $('#bthours').val() == $('#bendhours').val() ) {
                        if ($('#bendmin').val()<i) {
                            $("#bendmin").val(("0" + i).slice(-2));
                        };
                        flag=false;
                    };
                    $("#bendmin option[value='"+("0" + i).slice(-2)+"']").show();
                }

                // end closing time 
                if (i < minvalue && $('#bthours').val() == $('#endhours').val()) {
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").hide();
                    console.log('darshan')
                }
                else{
                    if (flag1 && $('#bthours').val() == $('#endhours').val() ) {
                        if ($('#endmin').val()<i) {
                            $("#endmin").val(("0" + i).slice(-2));
                        };
                        flag1=false;
                    };
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });

        // break end time with closing end time Minute condions
        $("#bendmin").change(function(){
            var minvalue = $(this).val();
            flag=true;
            for (var i = 0; i <= 59 ; i++)
            {
                // end closing time 
                if (i < minvalue && $('#bendhours').val() == $('#endhours').val()) {
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").hide();
                }
                else{
                    if (flag && $('#bendhours').val() == $('#endhours').val() ) {
                        if ($('#endmin').val()<i) {
                            $("#endmin").val(("0" + i).slice(-2));
                        };
                        flag=false;
                    };
                    $("#endmin option[value='"+("0" + i).slice(-2)+"']").show();
                }
            }
        });
    });
</script>


<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';


