<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Edit Area</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

             
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "area/area_action_edit" ?>">      
                    <input type="hidden" name="id" value="<?php echo ($area[0]['iArea_id'] != '') ? $area[0]['iArea_id'] : ''; ?>">    
                    <div class="col-md-6">
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <?php echo '<select class="form-control" name="city" id="city" onchange="myFunction(this.value)">';

                                                        ?>
                                                    <?php   for($i=0;$i<count($city);$i++)
                                                        {
                                                             if(($city[$i]['iCity_id'])==$area[0]['iCity_id'])
                                                             { ?>
                                                                
                                                                    <option selected="" value="<?php echo $city[$i]['iCity_id']; ?>"><?php echo $city[$i]['vCity_name']; ?></option>
                                                                
                                                            <?php }
                                                            else
                                                            { ?>city
                                                                    <option value="<?php echo $city[$i]['iCity_id']; ?>"><?php echo $city[$i]['vCity_name']; ?></option>
                                                            <?php }
                                                        }
                                            echo "</select>"; ?>
                            </div>
                        </div>               
                        
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Area Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="area_name" name="area_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($area[0]['vArea_name'] != '') ? $area[0]['vArea_name'] : ''; ?>"required>
                            </div>
                        </div>                      

                        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if($area[0]['status']==1) 
                                { ?>
                                <select class="form-control" name="status">                                
                                    <option value="1" selected="">Active</option>
                                    <option value="0">Deactive</option>                
                                </select>
                                <?php } ?>

                                <?php if($area[0]['status']==0) 
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

          url : '<?php echo base_url(); ?>area/removeImage',

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


