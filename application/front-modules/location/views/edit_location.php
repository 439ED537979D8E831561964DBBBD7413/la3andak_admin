<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Location</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "location/location_action_edit" ?>">

                <input type="hidden" name="id" value="<?php echo ($location[0]['location_id'] != '') ? $location[0]['location_id'] : ''; ?>">         
                    <div class="col-md-6">
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Postal Code<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="postal_code" name="postal_code" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location[0]['postal_code'] != '') ? $location[0]['postal_code'] : ''; ?>" required>
                            </div>
                        </div>         -->

                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Area Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="area_name" name="area_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location[0]['area_name'] != '') ? $location[0]['area_name'] : ''; ?>" required>
                            </div>
                        </div>         


                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="city_name" name="city_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location[0]['city_name'] != '') ? $location[0]['city_name'] : ''; ?>" required>
                            </div>
                        </div>         
                       


                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="state_name" name="state_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location[0]['state_name'] != '') ? $location[0]['state_name'] : ''; ?>" required>
                            </div>
                        </div>         


                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Country Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="country_name" name="country_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location[0]['country_name'] != '') ? $location[0]['country_name'] : ''; ?>" required>
                            </div>
                        </div>         

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php if($location[0]['status']==1) 
                                { ?>
                                <select class="form-control" name="status">                                
                                    <option value="1" selected="">Active</option>
                                    <option value="0">Deactive</option>                
                                </select>
                                <?php } ?>

                                <?php if($location[0]['status']==0) 
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
  
</script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
