<?php include APPPATH . '/front-modules/views/top.php'; ?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_panel">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo $this->config->item("site_url") . "customers/manage_customers" ?>"><i class="fa fa-arrow-left"></i> Back</a>                
                </div>
                <div class="col-md-6">
                    <div class="inner">
                        <a class="newbtn" style="background-color:#669BFF;color:#ffffff" href="<?php echo $this->config->item("site_url")."add_customer"; ?>">Add New Customer</a>                
                    </div>                    
                </div>
            </div>
        </div>      
        
        <div class="x_content">            
            <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Contact</th>                        
                        <th>Status</th>
                        <!-- <th>Location</th>
                        <th>Payment Methods</th>
                        <th>Vehicles</th> -->
                        <th>Action</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $key => $value) { ?>
                        <tr id='<?php echo urlencode($this->general->encryptData($value["cust_id"])); ?>'>
                            <td><?php echo $value['fullname']; ?></td>                            
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['phone']; ?></td>                                    
                            <td><?php echo ($value['status']=="0")?"Active":"Deactive"; ?></td>
                            <!-- <td><a href="<?php //echo $this->config->item("site_url")."location_customer?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>">Location</a>                                
                            </td>
                            <td>
                                <a href="<?php //echo $this->config->item("site_url")."payment_customer?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>">Payment Methods</a>
                            </td>                   
                            <td>
                                <a href="<?php //echo $this->config->item("site_url")."vehicles_customer?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>">Vehicles</a>
                            </td>                    -->
                            <td><a href="<?php echo $this->config->item("site_url")."edit_customer?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="Delete" href="<?php echo $this->config->item("site_url")."manage_customers?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a>
                            <a class="view" href="<?php echo $this->config->item("site_url")."view_customer?cust_id=".urlencode($this->general->encryptData($value["cust_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-eye"></i></a>
                            </td>                            
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#list").DataTable();
    });
    $('#list tbody').on( 'click', 'tr', function () {
        var cust_id= $(this).attr("id");
        $(this).css("background-color","#acbad4");
        var url="<?php echo $this->config->item("site_url")."view_customer?cust_id=" ; ?>"+cust_id
        window.location.href = url;;

        //alert("herer="+url);
    } );
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
