<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo ($all['pkg_id'] != '') ? 'Edit' : 'Add'; ?> Package</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="package_form" method="post" action="<?php echo $this->config->item("site_url") . "packages/package_action" ?>"class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                    <input type="hidden" name="pkg_id" id="pkg_id" value="<?php echo ($all['pkg_id'] != '') ? $all['pkg_id'] : ''; ?>"/>
                    <input type="hidden" id="mode" value="<?php echo ($all['pkg_id'] != '') ? 'edit' : 'add'; ?>"/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="title" name="title" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['title'] != '') ? $all['title'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea rows="3" class="form-control" name="description"><?php if ($all['description'] != '') echo $all['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sedan Price<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="price" name="sedan_price" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['sedan_price'] != '') ? $all['sedan_price'] : ''; ?>">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Suv Price<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="suv_price" name="suv_price" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['suv_price'] != '') ? $all['suv_price'] : ''; ?>">
                            </div>
                        </div>                        
                        <?php if ($all['pkg_id'] == '') { ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="file" class="filestyle form-control col-md-7 col-xs-12" id="image" name="image" data-buttonText="Find file">
                                </div>
                            </div>        
                        <?php } else { ?>
                            <div class="form-group">                                        
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="columns-text">Image : </label>                                        
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <?php
                                    $img_url = '';

                                    if ($all['image'] != '') {
                                        $img = 'packages/' . $all['pkg_id'] . '/' . $all['image'];
                                        $img_path = $this->config->item('upload_path') . $img;
                                        if (file_exists($img_path)) {
                                            $img_url = $this->config->item('upload_url') . $img;
                                        }
                                    }
                                    ?>
                                    <input type="file" id="image" name="image" class="form-control"  style="<?php echo ($img_url != '') ? 'display:none' : ''; ?>" accept=".jpg,.jpeg">
                                    <button type="button" id="cancel" class="btn btn-danger" style="display:none; margin-top: 0.3em;"><i class="fa fa-times"></i></button>
                                    <?php if ($img_url != '') { ?>
                                    <div class="avatar-view" title="" id="vProfileImg">
                                        <img src="<?php echo $this->config->item('upload_url') . 'packages/' . $all['pkg_id'] . '/' . $all['image']; ?>"  alt="photo" class="img-responsive" style="height: 150px;"/>
                                            <button type="button" id="change" class="btn btn-success"><i class="fa fa-repeat"></i></button>
                                            <button type="button" id="Deleteimg" title="Delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                            <!--// Gallery item END--> 
                                        </div>
                                    <?php } ?>
                                </div>                                       
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="col-md-6">                        
                    </div>
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
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/product.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
