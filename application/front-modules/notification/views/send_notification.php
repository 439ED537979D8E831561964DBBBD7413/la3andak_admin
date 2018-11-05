<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>ckeditor/styles.js"></script>
<div>
<center>
<b>
<font size="+2">
Send Notification
</font>
</b>
</center>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form id="notification_form" method="post" action="<?php echo $this->config->item("site_url") . "notification/notification_action" ?>"class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
                <!--  <!––    <input type="hidden" name="cid" id="cid" value="<?php echo ($all['iCategory_Id'] != '') ? $all['iCategory_Id'] : ''; ?>"/>
                    
                    <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-12"> City</label>
                    <div class="col-md-9 col-sm-9 col-xs-12" id="">
                            <select class="form-control" name="ucity" id="ucity" >
                            <option value="All">All</option>
                            <?php
                            foreach ($city as $cityrow)
                            {

                            
                            ?>
                            <option value="<?php echo $cityrow['iLocation_Id'];?>"><?php echo $cityrow['vlocation_Name'];?></option>
                            <?php
                             }
                        ?>
                           
                        </select>
                        </div>
                    </div> ––> -->
                   

                    <?php if ($all['iCategory_Id'] == '') { ?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12"> Image</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" class="form-control col-md-7 col-xs-12" id="image" name="image" data-buttonText="Find file">
                            </div>
                        </div>        
                    <?php } else { ?>
                        <div class="form-group">                                        
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="columns-text">Image : </label>                                        
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php
                                $img_url = '';

                                if ($all['vCategory_Image'] != '') {
                                    $img = 'category/' . $all['iCategory_Id'] . '/' . $all['vCategory_Image'];
                                    $img_path = $this->config->item('upload_path') . $img;
                                    if (file_exists($img_path)) {
                                        $img_url = $this->config->item('upload_url') . $img;
                                    }
                                }
                                ?>
                                <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12"  style="<?php echo ($img_url != '') ? 'display:none' : ''; ?>" >
                                <button type="button" id="cancel" class="btn btn-danger" style="display:none; margin-top: 0.3em;"><i class="fa fa-times"></i></button>
                                <?php if ($img_url != '') { ?>
                                    <div class="avatar-view" title="" id="vProfileImg">

                                        <img src="<?php echo $this->config->item('upload_url') . 'category/' . $all['iCategory_Id'] . '/' . $all['vCategory_Image']; ?>"  alt="photo" class="img-responsive" style="height: 150px"></a>
                                        <button type="button" id="change" class="btn btn-success"><i class="fa fa-repeat"></i></button>
                                        <button type="button" id="Deleteimg" title="Delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        <!--// Gallery item END--> 
                                    </div>
                                <?php } ?>
                            </div>                                       
                        </div>
                    <?php } ?> 
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Message</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea name="text" id="text" class="ckeditor" rows = "4"></textarea>
                        <script>
			                CKEDITOR.replace( 'text' );
                        </script>
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
<
<script >
    $(document).ready(function() {


    $("#Deleteimg").click(function() {
        if (confirm('Are you sure you want to delete this ?')) {

            $.ajax({
                type: "POST",
                url: site_url + "category/deleteImg",
                data: {id: $("#cid").val()},
                success: function() {
                    $('#image').show();
                    $('#vProfileImg').hide();
                    $('#hiddenval').val('0')
                    $('#cancelbtn4all').trigger('click');
                    $('#confirmbtn4all').html('Confirm');
                    $('#confirmbtn4all').attr('disabled', false);
                }
            });
        }
    });


    $("#category_form").validate({
        rules: {
            cat: {
                required: true
            }
        },
        messages: {
            cat: {
                required: "please enter Category",
//                remote: "Book Title and Published year are already exits"
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
        errorPlacement: function(error, e) {
            error.css('color', 'red');
            error.css('font-size', '13px');
            error.css('font-weight', 'normal');
            if (e.parents().hasClass('custom-select')) {
                e.after(error);
            } else {
                e.after(error);
            }
        },
        highlight: function(e) {
            $(e).closest('.validate').removeClass('has-success has-error').addClass('has-error');
        }
    });


});
</script>
<script >
    
    $('#change').click(function() {
        $('#image').show();
        $('#vProfileImg').hide();
        $('#cancel').show();
        $('#change').hide();
        $('#hiddenval').val('0');
    });

    $('#cancel').click(function() {
        $('#image').hide();
        $('#vProfileImg').show();
        $('#cancel').hide();
        $('#change').show();
        $('#hiddenval').val('1');
    });
</script>
<?php
include APPPATH . '/front-modules/views/footer.php';
