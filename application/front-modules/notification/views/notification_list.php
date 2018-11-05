<?php include APPPATH . '/front-modules/views/top.php'; ?>

<div>
<center>
<b>
<font size="+2">
District Management
</font>
</b>
</center>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_content">

            <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Notification</th>
                        <th>Type</th>
                        <th>Send To</th>
                        <th>Date</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $key => $value) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td style="width: 35%"><?php echo strip_tags($value['tNotification']); ?></td>
                            <td><?php echo $value['eUserType']; ?></td>
                            <td><?php 
                            if($value['eUserType']=="Seller" && $value['eSendTo']=="Some"){
                                $user=$this->model_notification->getData("seller_master","vContactPerson,vMobile","iSellerId in (".$value['vId'].")");
                                foreach ($user as $k => $v) { ?>
                                <a href="tel:<?php echo $v['vMobile'] ?>"><?php echo $v['vContactPerson'] ?></a>,
                                <?php } 
                            }else if($value['eUserType']=="Buyer" && $value['eSendTo']=="Some"){
                                $user=$this->model_notification->getData("buyer_master","vContactPerson,vMobile","iBuyerId in (".$value['vId'].")");
                                foreach ($user as $k => $v) { ?>
                                <a href="tel:<?php echo $v['vMobile'] ?>"><?php echo $v['vContactPerson'] ?></a>,
                                <?php } 
                                
                            }else{
                                echo 'All';
                            }
                            ?></td>
                            <td><?php echo $value['dtCreatedDate']; ?></td>
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
    })
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
