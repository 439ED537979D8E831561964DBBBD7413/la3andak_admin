<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Edit banner</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />


                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "banner/banner_action_edit" ?>">
                    <input type="hidden" name="id" value="<?php echo ($banner_list[0]['id'] != '') ? $banner_list[0]['id'] : ''; ?>">
                    <div class="col-md-6">

                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Banner URL
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">

                                <textarea rows="4" id="desc" name="desc" class="form-control col-md-7 col-xs-12"><?php echo $banner_list[0]['vDesc']; ?></textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Banner Icon<span class="">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <input id="icon" name="icon" class="required form-control col-md-7 col-xs-12" type="file" > -->
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                                    <b> For Better Resolution Fix Upload Promocode Image Size to 1900 ×700 </b>
                           </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px">
                                 <?php
                                if($banner_list[0]['vImage']!="")
                                {
                                    if($banner_list[0]['vImage']!="no_image.png")
                                    {

                                        $imageWithPath = base_url().TABLE_BANNER_UPLOAD.$banner_list[0]['vImage'];
                                        $imageHTML = $this->general_function->showImage($banner_list[0]['vImage'],$imageWithPath,$banner_list[0]['id']);
                                        echo $imageHTML;
                                    }
                                    elseif ($banner_list[0]['vImage']=="no_image.png")
                                    {
                                       $imageWithPath = base_url().TABLE_BANNER_UPLOAD.$banner_list[0]['vImage'];
                                        $imageHTML = $this->general_function->showImage1($banner_list[0]['vImage'],$imageWithPath,$banner_list[0]['id']);
                                        echo $imageHTML;
                                    }

                                }
                                    ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if($banner_list[0]['status']==1)
                                { ?>
                                <select class="form-control" name="status">
                                    <option value="1" selected="">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php } ?>

                                <?php if($banner_list[0]['status']==0)
                                { ?>
                                <select class="form-control" name="status">
                                    <option value="1" >Active</option>
                                    <option value="0" selected="">Deactive</option>
                                </select>
                                <?php } ?>
                            </div>
                        </div>

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
    $(".remove_image").click(function(){

 id=this.id;


    if(confirm("Are you sure? You want to delete this image?"))

    {

        $('#AjaxLoaderDiv').fadeIn('slow');

        $.ajax({

          type: 'post',

          url : '<?php echo base_url(); ?>banner/removeImage',

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

<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';


