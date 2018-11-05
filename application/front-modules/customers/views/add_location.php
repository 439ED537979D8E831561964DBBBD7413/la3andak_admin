<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div id="location" class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo ($location['loc_id'] != '') ? 'Edit' : 'Add'; ?> Location</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="location_form" method="post" action="<?php echo $this->config->item('site_url') . 'customers/location_action' ?>" class="form-horizontal form-label-left input_mask">
                    <input type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>"/>
                    <input type="hidden" name="loc_id" value="<?php echo $location['loc_id']; ?>"/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="fullname" name="fullname" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['fullname'] != '') ? $location['fullname'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="loc_type" name="loc_type" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['loc_type'] != '') ? $location['loc_type'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Street<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="street" name="street" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['street'] != '') ? $location['street'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="unit" name="unit" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['unit'] != '') ? $location['unit'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="city" name="city" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['city'] != '') ? $location['city'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="state" name="state" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['state'] != '') ? $location['state'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Zipcode<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input required="required" id="zipcode" name="zipcode" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['zipcode'] != '') ? $location['zipcode'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                            <input type="submit" class="btn btn-success">
                            <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
