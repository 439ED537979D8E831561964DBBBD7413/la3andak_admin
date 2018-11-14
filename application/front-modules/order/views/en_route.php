<?php include APPPATH . '/front-modules/views/top.php'; ?>
<style type="text/css">
    .buttonbg{
        width:100%;color:#ffffff;padding:5px;
        border: 0;
        margin: 0px !important;
        border-radius:5px;
    }
</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="value">
        <div class="col-md-12">
            <h2>En route Order List</h2>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_content">
            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Address</th>
                        <th>Order Price (in <?php echo CURRENCY_CONSTANT; ?>)</th>
                        <th>Requested on Date</th>
                        <th>Time Slots</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $key => $value) {
                        ?>
                        <tr class="">
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
                            <td> <?php echo date('D, j M Y g:i A', strtotime($value['order_date'])); ?></td>
                            <td> <?php
                                if ($value['delivery_time_slot'] == 'Instant Delivery') {
                                    echo $value['delivery_time_slot'];
                                } else {
                                    echo date('D, j M Y', strtotime($value['delivery_date'])) . "<br>" . $value['delivery_time_slot'];
                                }
                                ?></td>
                            <td><?php echo $value['checkout_comment']; ?></td>
                            <td>
                                <a href="#myModal" data-toggle="modal" style="background: #2a3f54;text-align:center;width: 100%;" class="btn btn-default get myModal" onClick="Load_Contents_From_DB_by_Vasplus_Blog('<?php echo $value['order_id']; ?>');"><font color="white">View</font></a>
                                <a href="javascript:void(0);" style="background: #2a3f54;text-align:center;width:100%;" onClick="MarkAsDeliver('<?php echo strip_tags($value['order_id']); ?>');" class="btn btn-default get"><font color="white">Deliver</font></a>
                                <a href="invoice?order_code=<?php echo $value['order_code']; ?>" style="background: #2a3f54;text-align:center;width: 100%;" target="_blank" class="btn btn-default get"><font color="white">Print</font></a>
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
    $(document).ready(function () {
        $("#list").DataTable({
            "order": [[0, "desc"]]
        }
        );

    });

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


    function MarkAsDeliver(id_to_delete)
    {
        // alert(id_to_delete);
        if (confirm("Are you sure you really want to move this order to delivered order list?"))
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
<?php
include APPPATH . '/front-modules/views/footer.php';
