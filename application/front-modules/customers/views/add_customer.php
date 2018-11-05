<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo ($all['cust_id'] != '') ? 'Edit' : 'Add'; ?> Customer</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="customer_form" method="post" action="<?php echo $this->config->item("site_url") . "customers/customer_action" ?>"class="form-horizontal form-label-left input_mask">
                    <input type="hidden" name="cust_id" value="<?php echo ($all['cust_id'] != '') ? $all['cust_id'] : ''; ?>"/>
                    <input type="hidden" id="chnagepassval" name="chnagepass" value="0"/>
                    <input type="hidden" id="mode" value="<?php echo ($all['cust_id'] != '') ? 'edit' : 'add'; ?>"/>
                    <input type="hidden" id="checkp" value="<?php //echo $all['ePeriod'] ?>"/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input id="fullname" name="fullname" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['fullname'] != '') ? $all['fullname'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="email" name="email" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['email'] != '') ? $all['email'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group" id="changpassbtndiv">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">                                
                                <button type="button" class="btn btn-sm btn-success" id="changpassbtn" name="changpassbtn"><i class="fa fa-floppy-o"></i> Change Password</button>
                                <button type="button" class="btn btn-sm btn-success" id="cancelpassbtn" name="cancelpassbtn"><i class="fa fa-floppy-o"></i> Cancel</button>
                            </div>
                        </div>
                        <div id="passdiv">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="password" name="password" class="required form-control col-md-7 col-xs-12" type="password" minlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="pass" name="pass" class="required form-control col-md-7 col-xs-12" type="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="phone" name="phone" Minlength="10" onkeypress="return isNumberKey(event)" class="required form-control col-md-7 col-xs-12" type="text" value="<?php echo ($all['cust_id'] != '') ? $all['phone'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="status">
                                
                                    <option value="0" <?php echo ( $all['status']==0 ? 'Selected' : '');?> >Active</option>
                                    <option value="1" <?php echo ( $all['status']==1 ? 'Selected' : '');?> >Deactive</option>                          
                                </select>
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
<script type="text/javascript">
   /* function validatePhoneNumber(elementValue){  
    var phoneNumberPattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;  

    var jjj= phoneNumberPattern.test(elementValue);  
    
    }
*/
$( document ).ready(function() {
    //console.log( "ready!" );
    $('#phone').keyup(function(){         
        //$(this).val( $(this).val().replace(/\(?(\d{3})\)?(\d{3})\-?(\d{4})/,'($1) $2-$3') );
        var mobile=$(this).val();
        //replace(/\(?(\d{3})\)?(\d{3})\-?(\d{4})/,'($1) $2-$3');
        var pattern = /^\d{10}$/;
        //$(this).val($(this).val().replace(/\(?(\d{3})\)?(\d{3})\-?(\d{4})/,'($1) $2-$3'));
        if(pattern.test(mobile)){            
            $(this).val($(this).val().replace(/\(?(\d{3})\)?(\d{3})\-?(\d{4})/,'($1) $2-$3'));
            //return true;
        }
        var myLength = $(this).val().length;
        if(myLength>14)
            return false;


    });

   

});
 function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;    
    return true;
  }
</script>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
