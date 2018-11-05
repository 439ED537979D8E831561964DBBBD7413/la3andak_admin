<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
              <div class="x_title">
                <h2>Contact Us</h2>
                <div class="clearfix"></div>
            </div>
                <br />
                <form id="category_form" method="post" action="<?php echo $this->config->item("site_url") . "content/contact_us_action" ?>" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="cid" id="cid" value="<?php echo ($all['iCategoryId'] != '') ? $all['iCategoryId'] : ''; ?>"/> -->


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" name="name" class="form-control col-md-7 col-xs-12" required="" type="text" value="<?php echo $contact_us[0]['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile<span class="required">*</span>
                        </label>
                        <div  class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="text" name="main_code" value="+961" readonly="" class="form-control" style="width:10%;float: left;">
                                <select name="area_code" class="form-control" style="width:10%;float: left;">
                                    <?php
                                            if ($contact_us[0]['area_code']==03)
                                            { ?>
                                                <option selected="">03</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>03</option>
                                      <?php   }

                                     ?>
                                     <?php
                                            if ($contact_us[0]['area_code']==70)
                                            { ?>
                                                <option selected="">70</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>70</option>
                                      <?php   }

                                     ?>
                                      <?php
                                            if ($contact_us[0]['area_code']==71)
                                            { ?>
                                                <option selected="">71</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>71</option>
                                      <?php   }

                                     ?>
                                     <?php
                                            if ($contact_us[0]['area_code']==76)
                                            { ?>
                                                <option selected="">76</option>
                                         <?php   }
                                         else
                                         { ?>
                                                <option>76</option>
                                      <?php   }

                                     ?>

                                </select>
                                <input type="text"  class="form-control"  name="cno" id="cno" minlength="6" maxlength="7"  value="<?php echo ($contact_us[0]['ucontactno'] != '') ? $contact_us[0]['ucontactno'] : ''; ?>" placeholder="Contact No" required  style="width:46%;float: left;">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" name="email" class="form-control col-md-7 col-xs-12" type="email" value="<?php echo $contact_us[0]['email']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Facebook URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="fb_url" required="" name="fb_url" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $contact_us[0]['fb_url']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Twitter URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="twitter_url" required="" name="twitter_url" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $contact_us[0]['twitter_url']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Insta URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="insta_url" required="" name="insta_url" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $contact_us[0]['insta_url']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Google Play Store URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="play_store_url" required="" name="play_store_url" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $contact_us[0]['play_store_url']; ?>">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">IPhone App Store URL<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="app_store_url" required="" name="app_store_url" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $contact_us[0]['app_store_url']; ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="add" rows="5" required="" class="form-control col-md-7 col-xs-12"><?php echo $contact_us[0]['address']; ?></textarea>
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
