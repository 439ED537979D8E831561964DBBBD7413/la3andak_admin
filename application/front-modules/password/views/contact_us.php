<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form id="category_form" method="post" action="<?php echo $this->config->item("site_url") . "content/contact_us_action" ?>"class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                    <input type="hidden" name="cid" id="cid" value="<?php echo ($all['iCategoryId'] != '') ? $all['iCategoryId'] : ''; ?>"/>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="mobile" name="mobile" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $mobile[0]['tContent']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" name="email" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $email[0]['tContent']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="add" class="form-control col-md-7 col-xs-12"><?php echo $add[0]['tContent']; ?></textarea>
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


<?php
include APPPATH . '/front-modules/views/footer.php';
