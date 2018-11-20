<?php include APPPATH . '/front-modules/views/top.php'; ?>
<style type="text/css">
    .buttonbg{
        width:100%;color:#ffffff;padding:5px;
        border: 0;
        margin: 0px !important;
        border-radius:5px;
    }

    .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span> Latest Activity</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href="<?php echo $this->config->item("site_url") ?>neworderlist" class="btn btn-primary btn-lg" role="button" style="width: 24%;height: 94px;"><span class="fa fa-shopping-cart"></span><br/><p> Total Order </p> <?php echo count($order_number); ?></a>

                        <a href="<?php echo $this->config->item("site_url") ?>consumer_list" class="btn btn-warning btn-lg" role="button" style="width: 24.3%;height: 94px;"><span class="fa fa-user"></span> <br/><p> Total Users </p> <?php echo count($user_number); ?></a>

                        <a href="<?php echo $this->config->item("site_url") ?>manage_brand" class="btn btn-primary btn-lg" role="button" style="width: 24%;height: 94px;"><span class="fa fa-apple"></span> <br/><p> Total Brand </p> <?php echo count($brand_number); ?></a>

                        <a href="<?php echo $this->config->item("site_url") ?>category_list" class="btn btn-danger btn-lg" role="button" style="width: 24.3%;height: 94px;"><span class="fa fa-cube"></span> <br/><p> Total Category </p> <?php echo count($category_number); ?></a>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h2>Recent Orders</h2>
        </div>
        <div class="x_panel">
            <div class="x_content">
                <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead><tr>
                            <th>Order No</th>
                            <th>Order Code</th>
                            <th>Customer Name</th>
                            <th>Customer Contact</th>
                            <th>Customer Address</th>
                            <!-- <th>Shop Name</th> -->

                            <th>Order Price (in <?php echo CURRENCY_CONSTANT; ?>)</th>
                            <!-- <th>Order Date</th> -->
                            <th>Time Slots</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Edit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        foreach ($orders as $key => $value) {
                            ?>


                            <tr>
                                <td><?php echo $value['order_id']; ?></td>
                                <td><?php echo $value['order_code']; ?></td>
                                <td><?php echo $value['ufname'] . " " . $value['ulname']; ?></td>
                                <td><?php
                                    $rest = substr($value['ucontactno'], 0, 4);
                                    $rest1 = substr($value['ucontactno'], 4, 2);
                                    $rest2 = substr($value['ucontactno'], 6, 3);
                                    $rest3 = substr($value['ucontactno'], 9, 4);
                                    echo $rest . " " . $rest1 . " " . $rest2 . " " . $rest3;
                                    ?></td>
                                <td><?php echo $value['shipping_address']; ?></td>
                                <td><?php echo $value['grant_total']; ?></td>
                                <td> <?php
                                    if ($value['delivery_time_slot'] == 'Instant Delivery') {
                                        echo $value['delivery_time_slot'];
                                    } else {
                                        echo date('D, j M Y', strtotime($value['delivery_date'])) . "<br>" . $value['delivery_time_slot'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $value['checkout_comment']; ?></td> 
                                <td>
                                    <a href="#myModal" data-toggle="modal" class="btn btn-default get" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" onClick="Load_Contents_From_DB_by_Vasplus_Blog('<?php echo $value['order_id']; ?>');"><font color="white">View</font></a>
                                    <a href="invoice?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" class="btn btn-default get" target="_blank" ><font color="white">Print</a>
                                </td>
                                <td>
                                    <?php if ($value['order_status'] == 0): ?>
                                        <a href="javascript:void(0);" class="btn btn-default get" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" onClick="MarkAsPending('<?php echo strip_tags($value['order_id']); ?>');"><font color="white">Pending</a>
                                        <a href="edit_order?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" class="btn btn-default get" target="_blank"><font color="white">Edit</a>
                                    <?php elseif ($value['order_status'] == 2): ?>
                                        <a href="javascript:void(0);" class="btn btn-default get" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" onClick="MarkAsUnderPreparation('<?php echo strip_tags($value['order_id']); ?>');"><font color="white">Under Preparation</a>
                                        <a href="edit_order?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" class="btn btn-default get" target="_blank"><font color="white">Edit</a>
                                    <?php elseif ($value['order_status'] == 3): ?>
                                        <a href="javascript:void(0);" class="btn btn-default get" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" onClick="MarkAsEnRoute('<?php echo strip_tags($value['order_id']); ?>');"><font color="white">En route</a>
                                        <a href="edit_order?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" class="btn btn-default get" target="_blank"><font color="white">Edit</a>
                                    <?php elseif ($value['order_status'] == 6): ?>
                                        <a href="javascript:void(0);" class="btn btn-default get" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" onClick="MarkAsDeliver('<?php echo strip_tags($value['order_id']); ?>');"><font color="white">Delivered</a>
                                        <a href="edit_order?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%;" class="btn btn-default get" target="_blank"><font color="white">Edit</a>
                                    <?php endif; ?>


                                </td>
                                <td><?php
                                    if ($value['order_status'] == 1) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#1479b8;">New</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 0) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#1479b8">New</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 2) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#F5A623">Pending</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 3) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#1479b8">Under Preparation</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 4) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#ed1c24">Canceled</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 5) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#8dd13d">Delivered</button>
                                        <?php
                                    }
                                    if ($value['order_status'] == 6) {
                                        ?>
                                        <button disabled class="buttonbg" style="background-color:#ed1c24">En route</button>
                                        <?php
                                    }
                                    ?></td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#list").DataTable({
            "order": [[0, "desc"]]
        }
        );

    });

</script>

<script>
    function MarkAsEnRoute(id_to_delete)
    {
        if (confirm("Are you sure you really want to move this order to En route order list?"))
        {
            if (id_to_delete != "")
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>order/enroute',
                    data: {'id_to_delete': id_to_delete},
                    cache: false,
                    success: function (data)
                    {
                        if (data == 'True')
                        {
                            window.location.reload();
                        } else
                        {
                            alert("Unable to process order.")
                            window.location.reload();

                        }
                    }
                });
            } else
            {
                alert("Sorry, we could not verify the identity of the post you have just clicked. Please try again or contact the site admin if this problem persist. Thanks...");
            }
        }
        return false;
    }
    function MarkAsUnderPreparation(id_to_delete)
    {
        // alert(id_to_delete);
        if (confirm("Are you sure you really want to move this order to Under Preparation order list?"))
        {


            if (id_to_delete != "")
            {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>order/UnderPreparation',
                    data: {'id_to_delete': id_to_delete},
                    cache: false,
                    success: function (data)
                    {
                        if (data == 'True')
                        {
                            window.location.reload();
                        } else
                        {
                            alert("Unable to process order.")
                            window.location.reload();

                        }
                    }
                });
            } else
            {
                alert("Sorry, we could not verify the identity of the post you have just clicked. Please try again or contact the site admin if this problem persist. Thanks...");
            }
        }
        return false;
    }
    function Load_Contents_From_DB_by_Vasplus_Blog(order_id)
    {
        //alert(order_id);
        if (order_id == "")
        {
            alert("The Order ID must not be empty please.");
        } else
        {
            $('#AjaxLoaderDiv').fadeIn('slow');
            $.ajax(
                    {
                        type: "POST",
                        url: '<?php echo base_url(); ?>order/oreder_detail',
                        data: {'order_id': order_id
                        },
                        beforeSend: function ()
                        {
                            $("#myModal").html('<br clear="all"><div style="padding-left:650px;padding-top:200px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;"></font></div><br clear="all">');
                        },
                        success: function (response)
                        {
                            $("#myModal").hide().fadeIn(100).html(response);
                        }
                    })
        }
    }



    function MarkAsPending(id_to_delete)
    {
        // alert(id_to_delete);
        if (confirm("Are you sure that you really want to Move to Pending Order List?"))
        {


            if (id_to_delete != "")
            {
                // var dataString = "&id=" + id_to_delete + "&Action=MarkAsDeliver";

                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>order/pending_order_send',
                    data: {'id_to_delete': id_to_delete},
                    cache: false,
                    success: function (data)
                    {
                        if (data == 'True')
                        {
                            window.location.reload();
                        } else
                        {
                            alert("Order is already cancel by user")
                            window.location.reload();

                        }
                    }
                });
            } else
            {
                alert("Sorry, we could not verify the identity of the post you have just clicked. Please try again or contact the site admin if this problem persist. Thanks...");
            }
        }
        return false;
    }
    function MarkAsDeliver(id_to_delete)
    {
        // alert(id_to_delete);
        if (confirm("Are you sure that you really want to Move to Delivered Order List?"))
        {


            if (id_to_delete != "")
            {
                // var dataString = "&id=" + id_to_delete + "&Action=MarkAsDeliver";

                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>order/deleiver_order',
                    data: {'id_to_delete': id_to_delete},
                    cache: false,
                    success: function (data)
                    {
                        if (data == 'True')
                        {
                            window.location.reload();
                        } else
                        {
                            alert("Order is already cancel by user")
                            window.location.reload();

                        }
                    }
                });
            } else
            {
                alert("Sorry, we could not verify the identity of the post you have just clicked. Please try again or contact the site admin if this problem persist. Thanks...");
            }
        }
        return false;
    }

</script>
<style type="text/css">
    .buttonbg{
        width:100%;color:#ffffff;padding:5px;
        border: 0;
        margin: 0px !important;
        border-radius:5px;
    }
</style>
<?php
include APPPATH . '/front-modules/views/footer.php';
