<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <form id="product_form" method="post" action="<?php echo $this->config->item("site_url") . "content/content_action" ?>"class="form-horizontal form-label-left input_mask">
            <div class="x_content">

                <div data-example-id="togglable-tabs" role="tabpanel" class="">
                    <ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
                        <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="about" href="#tab_content1">About Us</a>
                        </li>
                        <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" role="tab" id="aboutApp" href="#tab_content4">About App</a>
                        </li>
                        <li class="" role="presentation"><a aria-expanded="false" data-toggle="tab" id="terms" role="tab" href="#tab_content3">Terms</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="about" id="tab_content1" class="tab-pane fade active in" role="tabpanel">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">About Us</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="about" id="about" class="ckeditor" rows = "4"><?php echo $about; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div aria-labelledby="aboutApp" id="tab_content4" class="tab-pane fade in" role="tabpanel">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">About App</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="about_app" id="about_app" class="ckeditor" rows = "4"><?php echo $about_app; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div aria-labelledby="terms" id="tab_content3" class="tab-pane fade" role="tabpanel">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Terms&Conditions</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="terms" id="terms" class="ckeditor" rows = "4"><?php echo $terms; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                            <input type="submit" class="btn btn-success">
                            <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <?php
    include APPPATH . '/front-modules/views/footer.php';
    