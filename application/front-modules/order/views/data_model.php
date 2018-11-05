<?php

		$order_id = $_POST['order_id'];



		$order = $this->db->query("SELECT o.*,u.ucontactno,u.ufname,u.ulname,r.* FROM `order` o LEFT JOIN users u ON (o.user_id=u.user_id) LEFT JOIN reviews_ratings r ON (o.user_id = r.consumer_id) WHERE o.order_id = '".$_POST['order_id']."'");

		$order_array = $order->result_array();



		$product_order = $this->db->query("SELECT o.*, oh.*, p.product_english_name,p.product_image FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id)  WHERE o.order_id = '".$_POST['order_id']."'");



		$product_order_array = $product_order->result_array();



 ?>



 <style type="text/css">

.total_area span{

padding-left:200px;

}

#customerd td{

width:300px;

}

.first

{

padding-left:70px;

padding-bottom:10px;

}
.modal-header {

    background: black;
    }

    h5.modal-title {
    color: white;
}

</style>





		<div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h5 class="modal-title">Order Code : <?php echo $order_array[0]['order_code']; ?> <font style="float: right;"> Order Time: <?php  echo  date('D, j M Y g:i A',strtotime($order_array[0]['order_date'])); ?></font></h5>

                    </div>

                    <div class="modal-body">



					   <h2 style="    margin-left: 36%;">Customer Detail</h2>

		<div class="total_area" style="margin-top:25px;">

		<table id="customerd">

		<tr><td class="first"><b>Customer Name</b></td><td><?php echo $order_array[0]['ufname']." ".$order_array[0]['ulname']; ?></td></tr>

		<tr><td class="first"><b>Customer Conatct No</b></td><td><?php  $rest = substr($order_array[0]['ucontactno'],0,4);
                                    $rest1 = substr($order_array[0]['ucontactno'],4,2);
                                    $rest2 = substr($order_array[0]['ucontactno'],6,3);
                                    $rest3 = substr($order_array[0]['ucontactno'],9,4);

                                    echo $rest." ".$rest1." ".$rest2." ".$rest3; ?></td></tr>

		<tr><td class="first"><b>Customer Address</b></td><td><?php echo $order_array[0]['shipping_address']; ?></td></tr>

		<tr><td class="first"><b>Delivery Charge</b></td><td><?php echo CURRENCY_CONSTANT." ".$order_array[0]['delivery_charge']; ?></td></tr>

		<tr><td class="first"><b>Total Amount</b></td><td><?php echo CURRENCY_CONSTANT." ".$order_array[0]['grant_total']; ?></td></tr>

		<?php if($order_array[0]['order_status']==5)

		{ ?>

		<tr><td class="first"><b>Comment</b></td><td><?php echo $order_array[0]['comments']; ?></td></tr>



		<?php } ?>

		<?php /*?><tr><td class="first">Paid Amount</td><td><?php echo $cust['paid']; ?></td></tr>

		<tr><td class="first">Remainnig Amount</td><td><?php echo $cust['remainning']; ?></td></tr><?php */?>

		</table>

						<!--<ul style="list-style-type:none;">

							<li>Customer Name <span><?php echo $cust['uname']; ?></span></li>

							<li>Conatctno <span><?php echo $cust['ucontactno']; ?></span></li>

							<li>Address <span><?php echo $cust['shipping_address']; ?></span></li>

							<li>Total Amount <span><?php echo $cust['total_price']; ?></span></li>

							<li>Paid Amount <span><?php echo $cust['paid']; ?></span></li>

							<li>Remainnig Amount <span><?php echo $cust['remainning']; ?></span></li>

						</ul>-->

					</div>

		<div class="col-sm-11 padding-right" align="center" style="margin-top:40px;">

				<h2 class="title text-center">Order List</h2>

				<div class="table-responsive cart_info" id="msgDsp">

				<table class="table table-condensed">

					<thead>

						<tr class="cart_menu" style="font-weight:bold;">

							<!--<td class="image" style="width:150px;">Order No</td>-->
                                                        <td class="image" style="width:100px;">Product Image</td>
							<td class="name" style="width:100px;">Product Name</td>

							<td class="cnto">Product Price (in <?php echo CURRENCY_CONSTANT ?>)</td>

							<td class="cnto">Product Quantity</td>



							<td class="quantity">Total Price (in <?php echo CURRENCY_CONSTANT ?>)</td>

							<!--<td class="total">Total</td>-->

							<!--<td class="edit">View</td>-->

							<!--<td class="Delete">Delete</td>-->

						</tr>

					</thead>

					<tbody>

						<?php



						// var_dump($product_order_array);

						// exit();



						if($product_order_array)

					 	{

						 // while ($content = mysql_fetch_assoc($query1))

						 // {

						 	for($i = 0;$i <count($product_order_array);$i++)

						 	{

						 	?>



						<tr>
                                                        <td class="product_image" width="50%" height="50%">
                                                                <img src="<?php  echo TABLE_PRODUCT_UPLOAD.$product_order_array[$i]['product_image']; ?>" width="100px" height="100px">
							</td>
							<td class="cart_name" style="width:200px;">
								<h5><?php echo $product_order_array[$i]['product_english_name']." - ".$product_order_array[$i]['seller_price_type']; ?></h5>
							</td>
							<td class="cart_price">
							<h5><?php echo $product_order_array[$i]['product_price']; ?></h5>
							</td>
							<td class="cart_price">
							<h5><?php echo $product_order_array[$i]['product_quantity']; ?> </h5>
							</td>

							<td class="cart_total">
								<h5><?php echo ($product_order_array[$i]['product_quantity'])*($product_order_array[$i]['product_price']); ?></h5>
							</td>
							<?php /*?><td class="cart_edit">
								<!--<a class="cart_quantity_edit" href=""><i class="fa fa-pencil"></i></a>-->
						<input type="button" class="btn btn-default get" id=<?php echo $row['order_code']; ?> value='View' onClick="edit_field(<?php echo $row['order_code']; ?>);">
							</td><?php */?>
							<!--<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>-->
							</tr>

					<?php   }

					} else { ?>

							<tr><td colspan="6" style="text-align:center;"><h5>No Data Available.</h5></td></tr>

					 <?php } ?>

					</tbody>

				</table>

			</div>

				</div>











                    </div>

                    <div class="modal-footer">

                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>

                    </div>

                </div>

            </div>