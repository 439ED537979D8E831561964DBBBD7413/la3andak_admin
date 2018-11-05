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

            <h2>Edit Order</h2>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_value">

        <form class="form-horizontal" role="form"  enctype="multipart/form-data" action="order/order_action_edit" method="post" id="myform">

                <div class="form-group">

                        <label for="order_code" class="col-lg-2 col-sm-2 control-label">Order Code</label>

                        <div class="col-lg-4">

                            <input type="text" name="order_code" class="form-control" id="order_code" placeholder="Order Code" value="<?php echo $order[0]['order_code']; ?>" required readonly>

                            <input type="hidden" name="order_id" value="<?php echo $order[0]['order_id']; ?>">

                        </div>

                    </div>

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                  <tr>

                    <td class="text-center"><b>Sr No.</b></td>

                    <td class="text-center" colspan="7"><b>Item</b></td>

                    <td class="text-center"><b>Pack Size</b></td>

                    <td class="text-center"><b>Quantity</b></td>

                    <td class="text-center"><b>Price (in <?php echo CURRENCY_CONSTANT ?>)</b></td>

                    <td class="text-center"><b>Total Price (in <?php echo CURRENCY_CONSTANT ?>)</b></td>

                    <td class="text-center"><b>Delete</b></td>

                </tr>

                </thead>

                <tbody>

                <?php $counter= 0; ?>

                    <?php foreach ($order_detail_array as $key => $value)

                       {

                       $counter++;

                      ?>

                         <tr id="<?php echo 'tr_'.$value['product_id'];?>" style="text-align: center;">

                        <td class="text-center"><?php echo $counter; ?>

                        <input type="hidden" name="<?php echo 'product_id['.$value['product_id'].']'?>" value="<?php echo $value['product_id'];?>" />

                        </td>

                        <td colspan="7"><?php echo $value['product_english_name']; ?></td>

                        <td class="text-right"><?php echo $value['qty']; ?>

                        <input type="hidden" name="<?php echo 'seller_price_type['.$value['product_id'].']'?>" value="<?php echo $value['qty'];?>" />

                        </td>

                        <td class="text-right">

                        <input type="text" name="<?php echo 'p_q_['.$value['product_id'].']';?>" class="form-control" id="<?php echo 'p_q_'.$value['product_id'];?>" placeholder="Quantity" value="<?php echo $value['product_quantity']; ?>"  style="text-align: center;" required onChange="change_qty(this)">

                        </td>

                        <td class="text-right">

                        <input type="hidden" name="<?php echo 'p_p_['.$value['product_id'].']'; ?>" id="<?php echo 'p_p_'.$value['product_id']; ?>" value="<?php echo round($value['product_price'],2); ?>" data-info="<?php echo round($value['product_price'],2); ?>">

                        <?php echo round($value['product_price'],2); ?>

                        </td>

                        <td class="text-right"><span name="<?php echo 'p_pt_'.$value['product_id']; ?>" id="<?php echo 'p_pt_'.$value['product_id']; ?>"><?php echo round($value['product_total_price'],2); ?></span></td>

                        <td class="text-center"><a href="javascript:;" class="delete_user" onclick='newwin(this)' id="<?php echo 'tr_'.$value['product_id'];?>" ><span style="font-size: 200%;"><i class="fa fa-times-circle-o"></i></span></a></td>

                      </tr>

                    <?php }

                    ?>



                </tbody>

            </table>

            <div class="form-group">

                <div class="col-lg-offset-5 col-lg-10">

                    <button type="submit" name="btnsave" class="btn btn-primary" style="margin-top: 25px">Submit</button>

                </div>

            </div>



        <form>



        </div>

    </div>

</div>



<script>

    $(document).ready(function() {

        $("#list").DataTable({

            "order": [[ 0, "desc" ]]

        }

        );



    });



</script>



<script>

function change_qty(obj) {

    var id=obj.id;

    var qty=obj.value;

    // alert(qty)

    array = id.split('_');

    id=array[2];

    product_price_id='p_p_'+id;

    product_price_span_id='p_pt_'+id;

    product_price=$('#'+product_price_id).attr('data-info');

    product_total_price=Math.round(product_price*qty * 100) / 100;

    $("#"+product_price_span_id).html(product_total_price);

}



function newwin(obj) {



         jQuery(".delete_user").click(function(){

        if(confirm("Are you sure you want to delete this Product From this Order?"))

        {



            $('#'+obj.id).remove();

        }

        else

        {

            return false;

        }

        })

}

</script>









<?php

include APPPATH . '/front-modules/views/footer.php';

