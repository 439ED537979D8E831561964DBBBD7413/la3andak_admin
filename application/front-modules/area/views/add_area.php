<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Area</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "area/area_action" ?>">          
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <select class="form-control" name="city" id="city" onchange="myFunction(this.value)">
                                         
                                    <?php
                                 foreach($city as $row)
                                { ?>
                                <option value="<?php echo ($row['iCity_id']) ?>"><?php echo ($row['vCity_name']) ?></option>
                               <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Area Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="area_name" name="area_name" class="required form-control col-md-7 col-xs-12" type="text" required>
                            </div>
                        </div>          
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="status">                                
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>                
                                </select>
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
    function myFunction(val)
     {
        
        if (val==0) 
        {
            alert("Please Select  Category");
            return false;
        }
        else{
            return true;
        }
}
</script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
