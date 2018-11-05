<?php include APPPATH . '/front-modules/views/top.php'; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="row">
                <div class="col-md-6">
                        <a href="<?php echo $this->config->item("site_url") . "customers/manage_customers" ?>"><i class="fa fa-arrow-left"></i> Back to Customers</a>                
                </div>
                <div class="col-md-6">
                    <div class="inner">
                        <a class="newbtn" href="<?php echo $this->config->item("site_url")."edit_customer?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ; ?>">Edit Customer</a>                
                    </div>
                    <div class="inner" style="margin-right: 5px;">
                        <a class="newbtn" href="<?php echo $this->config->item("site_url")."vehicles_customer?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ; ?>">Vehicles</a>
                    </div>
                    <div class="inner" style="margin-right: 5px;">
                        <a class="newbtn" href="<?php echo $this->config->item("site_url")."location_customer?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ; ?>">Location</a>
                    </div>                
                    <div class="inner" style="margin-right: 5px;">
                        <a class="newbtn" href="<?php echo $this->config->item("site_url")."payment_customer?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ; ?>">Payments</a>
                    </div>
                </div>
            </div>
        </div>      
        <form id="customer_form" method="post" action="<?php echo $this->config->item("site_url") . "customers/customer_action" ?>"class="form-horizontal form-label-left input_mask">
            <input type="hidden" name="cust_id" value="<?php echo ($customer['cust_id'] != '') ? $customer['cust_id'] : ''; ?>"/>

            <div class="col-md-6">
                <div class="form-group">
                    <h2><?php echo $customer['fullname']; ?></h2>
                    <div class="clearfix"></div>
                 </div>
                <div class="x_panel"> 
                    <div class="x_content">                
                         <div class="x_title">
                            <h2><?php echo $customer['fullname']; ?></h2>
                            <div class="clearfix"></div>
                         </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <label class=""><?php echo $customer['fullname']; ?></label>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <label class=""><?php echo $customer['email']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-3 col-sm-3 col-xs-12">Phone</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <label class=""><?php echo $customer['phone']; ?></label>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <h2>Order History</h2>
                    <div class="clearfix"></div>
                 </div>
                <div class="x_panel"> 
                    <div class="x_content">                
                         <!-- <div class="x_title">
                            <h2><?php //echo $customer['fullname']; ?></h2>
                            <div class="clearfix"></div>
                         </div> -->
                         <?php /* foreach($orders as $order){?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $order['order_id'];?></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                    <label class="control-label"><?php echo date('m/d/Y',strtotime($order['created_on']));?></label>                                
                                </div>
                            </div>
                         <?php } */ ?>
                         <table id="list" class="table table-striped  dt-responsive nowrap" cellspacing="0" width="100%">
                             <tbody>
                                 <?php 
                                 if(!empty($orders)){

                                     foreach ($orders as $key => $value) { ?>
                                         <tr>
                                             <td ><?php echo $value['order_id']; ?></td>                            
                                             <td><?php echo date('M d,Y h:i a',strtotime($value['created_on']) );?></td>       
                                         </tr>
                                     <?php }
                                 } ?>
                             </tbody>
                         </table>                                
                    </div>
                </div>
            </div>                    
        </form>            
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/buyer.js"></script>

<?php
include APPPATH . '/front-modules/views/footer.php';
