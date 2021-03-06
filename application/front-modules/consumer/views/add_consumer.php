<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Consumer</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "consumer/consumer_action" ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="consumer_name" name="consumer_name" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['consumer_name'] != '') ? $all['consumer_name'] : ''; ?>" required placeholder="Consumer Name">
                            </div>
                        </div>
                       <!--  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <textarea rows="3"  name="address" class="form-control" placeholder="Address"></textarea>
                                        </div>
                        </div>
                        <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Postalcode</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <input type="text"  class="form-control" name="postalcode" maxlength="6" id="postalcode" placeholder="Postalcode" required>
                                        </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Contact No</label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="text" name="main_code" value="+961" readonly="" class="form-control" style="width:20%;float: left;">

                                <input type="text" name="area_code" minlength="2" maxlength="2" class="form-control" style="width:20%;float: left;">
                                <!-- <select name="area_code" class="form-control" style="width:20%;float: left;">
                                    <option>03</option>
                                    <option>70</option>
                                    <option>71</option>
                                </select> -->
                                <input type="text"  class="form-control" name="cno" id="cno" minlength="6" maxlength="7" placeholder="Contact No" required  style="width:60%;float: left;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="email" class="form-control" name="email" id="inputEmail1" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consumer Image<span class="">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <input id="icon" name="icon" class="required form-control col-md-7 col-xs-12" type="file" > -->
                                <input type="file" name="image[]" multiple="multiple" accept="image/*" id="image"  class="form-control col-md-7 col-xs-12"/>
                            </div>
                        </div>



                        <div class="form-group">
                                        <label for="shoprgno" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                            <input type="password" name="password" class="form-control" id="password" minlength="8" placeholder="Password" required >
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
