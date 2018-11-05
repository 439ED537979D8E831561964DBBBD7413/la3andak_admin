<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Deleivery Charges</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="profile_form" method="post" action="<?php echo $this->config->item("site_url") . "content/deleivery_action" ?>"class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                  
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Delivery Charge<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="charge" name="charge" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($charges[0]['setting_value'] != '') ? $charges[0]['setting_value'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Minimum Cart Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="camount" name="camount" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($amount[0]['setting_value'] != '') ? $amount[0]['setting_value'] : ''; ?>">
                        </div>
                    </div>
                    
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                    <input type="submit" class="btn btn-success">
                    <button class="btn btn-primary">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/profile.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
