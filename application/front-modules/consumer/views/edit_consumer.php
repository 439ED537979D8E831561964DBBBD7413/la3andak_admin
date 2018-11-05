<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit consumer</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <?php //var_dump($consumer[0]['user_id']);
               // exit(); ?>

                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "consumer/consumer_action_edit" ?>">
                    <input type="hidden" name="id" value="<?php echo ($consumer[0]['user_id'] != '') ? $consumer[0]['user_id'] : ''; ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="consumer_name" name="consumer_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($consumer[0]['ufname'] != '') ? $consumer[0]['ufname'] : ''; ?>" required placeholder="Consumer Name">
                            </div>
                        </div>
                       <!--  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <textarea rows="3"  name="address" class="form-control" placeholder="Address"><?php echo ($consumer[0]['uaddress'] != '') ? $consumer[0]['uaddress'] : ''; ?></textarea>
                                        </div>
                        </div>
                        <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Postalcode</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <input type="text"  class="form-control" name="postalcode" maxlength="6" id="postalcode" placeholder="Postalcode" value="<?php echo ($consumer[0]['postalcode'] != '') ? $consumer[0]['postalcode'] : ''; ?>" required>
                                        </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Contact No</label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                               <input type="text" name="main_code" value="+961" readonly="" class="form-control" style="width:20%;float: left;">

                               <input type="text" name="area_code" minlength="2" maxlength="2" class="form-control" value="<?php echo $consumer[0]['area_code'] ?>" style="width:20%;float: left;">
                                <!-- <select name="area_code" class="form-control"  style="width:20%;float: left;">
                                    <?php
                                            if ($consumer[0]['area_code']==03)
                                            { ?>
                                                <option selected="">03</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>03</option>
                                      <?php   }

                                     ?>
                                     <?php
                                            if ($consumer[0]['area_code']==70)
                                            { ?>
                                                <option selected="">70</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>70</option>
                                      <?php   }

                                     ?>
                                      <?php
                                            if ($consumer[0]['area_code']==71)
                                            { ?>
                                                <option selected="">71</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>71</option>
                                      <?php   }

                                     ?>

                                </select> -->
                                <input type="text"  class="form-control" name="cno" id="cno" minlength="6" value="<?php echo ($consumer[0]['ucontactno'] != '') ? $consumer[0]['ucontactno'] : ''; ?>" minlenght="6" maxlength="7" placeholder="Contact No" required  style="width:60%;float: left;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="email" class="form-control" name="email" value="<?php echo ($consumer[0]['uemail'] != '') ? $consumer[0]['uemail'] : ''; ?>" id="inputEmail1" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Image<span class="">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <input id="icon" name="icon" class="required form-control col-md-7 col-xs-12" type="file" > -->
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                           </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px">
                                 <?php
                                if($consumer[0]['image']!="")
                                {
                                    if($consumer[0]['image']!="no_image.png")
                                    {

                                        $imageWithPath = base_url()."ws/".TABLE_USER_UPLOAD2.$consumer[0]['image'];

                                        $imageHTML = $this->general_function->showImage($consumer[0]['image'],$imageWithPath,$consumer[0]['user_id']);
                                        echo $imageHTML;
                                    }
                                    elseif ($consumer[0]['image']=="no_image.png")
                                    {
                                       $imageWithPath = base_url()."ws/".TABLE_USER_UPLOAD2.$consumer[0]['image'];
                                        $imageHTML = $this->general_function->showImage1($consumer[0]['image'],$imageWithPath,$consumer[0]['user_id']);
                                        echo $imageHTML;
                                    }

                                }
                                else
                                    {
                                        $imageWithPath = base_url()."ws/".TABLE_USER_UPLOAD2.'no_image.png';


                                        $imageHTML = $this->general_function->showImage1($consumer[0]['image'],$imageWithPath,$consumer[0]['user_id']);
                                        echo $imageHTML;
                                    }

                                    ?>
                            </div>
                        </div>




                     <div class="form-group">
                                        <label for="shoprgno" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <input type="password" value="<?php echo ($consumer['consumer_name'] != '') ? $consumer['consumer_name'] : ''; ?>" name="password" class="form-control" id="password" minlength="8" placeholder="Password" >
                                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if($consumer[0]['ustatus']==1)
                                { ?>
                                <select class="form-control" name="status">
                                    <option value="1" selected="">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php } ?>

                                <?php if($consumer[0]['ustatus']==0)
                                { ?>
                                <select class="form-control" name="status">
                                    <option value="1" >Active</option>
                                    <option value="0" selected="">Deactive</option>
                                </select>
                                <?php } ?>
                            </div>
                        </div>
                   <!--  <div class="col-md-6">
                    </div> -->
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
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

          url : '<?php echo base_url(); ?>consumer/removeImage',

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

});

     $('#cno').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});
 $('#postalcode').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});





</script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';


