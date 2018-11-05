<style type="text/css">

	.logo{

		width: 25%;

		float: left;

	}

	.logo img{

		width: 100%;

	}

	.hedding{

		float: left;

		margin-left: 3%;

	}

	.marrgin-top{

		margin-top: 1%;

	}

	.heading-container{

		/*border: 1px solid red;*/

		width: 100%;

		float: left;

	}

	.body-part{

		clear: both;

		width: 100%;

		padding-top: 1%;

	}

	.footter{

		clear: both;

		width: 100%;

		padding-top: 3%;

	}

	.footer-link{



	}

	td

	{

		font-size: 12px;

		font-weight: 600;

	}





</style>





<html dir="ltr" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<meta charset="UTF-8">

		<title>Invoice </title>

		  <!-- <meta charset="utf-8"> -->

		  <meta name="viewport" content="width=device-width, initial-scale=1">

		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>



	<?php  ?>



		<body>

		<?php  if(isset($_GET['order_code']) && !empty($_GET['order_code']) )

		 {

			// $cDB = new cDatabase();

			$query =$this->db->query("SELECT o.*,s.seller_english_name,s.seller_address,s.seller_contactno,u.ucontactno,u.ufname,u.ulname,u.uemail,u.ucity FROM `order` o LEFT JOIN seller s ON (s.seller_id=o.seller_id) LEFT JOIN users u ON (o.user_id=u.user_id)  WHERE o.order_code='".$_GET['order_code']."'");

				// $row = mysql_fetch_assoc($query);

			$row = $query->result_array();



			?>

			<div style="background-color:#f5f5f5;height:100% ;position: relative;">

			<div style="background:#ffffff;width: 45vw;margin-left: 29%;">

			<div style="width:45vw;">

		    	<?php $image_url= $this->config->item("upload_url") ;?>

            <a href="javascript:void(0)" class="site_title">

            <img src="<?php echo $image_url; ?>/images/header.jpg" style="height: 75px;width:100%;"></a>

		    </div>

		<div class="container" style="width:45vw">

		    <div style="page-break-after: always;" class="marrgin-top">



			    <div class="heading-container">

				    		<div>

				    	<h2 style="text-align: center;font-size: 22px;font-family: HelveticaNeue">DELIVERY INVOICE</h2>

				    	 <div style="float: left;">

				    	<b>Order No : </b><?php echo $row[0]['order_id'];?><br>



				    	<b>Order Code : </b><?php echo $row[0]['order_code'];?><br><br>

				    	</div>

				    	<div style="float: right;text-align: right;">

				    	<b>Requested On : </b><br><?php echo date('D, j M Y g:i A',strtotime($row[0]['order_date']));?><br>



				    	<b>Payment Mode : </b><br><?php if($row[0]['payment_mode']==1){echo "Cash On Delivery";}elseif($row[0]['payment_mode']==2){echo "PayUMoney";}elseif($row[0]['payment_mode']==3){echo "MobiKwik";}elseif($row[0]['payment_mode']==4){echo "Paytm";}?>

				    	</div><br><br><br><br><br>



				    	<div style="float: left;margin-top:-7%;">

				    		<b><?php echo $row[0]['ufname']." ".$row[0]['ulname'];?></b><br>

				    		<?php echo $row[0]['shipping_address'];?><br>

				    		<b>Contact No. : </b><?php $rest = substr($row[0]['ucontactno'],0,4);
                                    $rest1 = substr($row[0]['ucontactno'],4,2);
                                    $rest2 = substr($row[0]['ucontactno'],6,3);
                                    $rest3 = substr($row[0]['ucontactno'],9,4);

                                    echo $rest." ".$rest1." ".$rest2." ".$rest3;?><br>

				    		<b>Email : </b><?php echo $row[0]['uemail'];?><br>

				    	</div>



				    	<div style="float: right;margin-top:-2%;">

				    		<b style="float: right;">Delivery Time Slot : </b><br>

				    		<?php if($row[0]['delivery_time_slot'] == 'Instant Delivery')
				    				{ ?>
				    				<div style="float: right;"><?php echo $row[0]['delivery_time_slot'];?></div>
				    			<?php	}

				    			else
				    			{	?>
				    		<div style="float: right;"><?php echo date('D, j M Y',strtotime($row[0]['delivery_date']))." ".$row[0]['delivery_time_slot'];?></div>
				    		<?php	}

				    		 ?>



				    	</div>



				    </div>

			    </div>

			    <div class="body-part">

					<?php

					$query1=$this->db->query("SELECT o.*, oh.*,oh.product_quantity*oh.product_price as product_total_price,p.product_english_name FROM `order` o LEFT JOIN order_history oh ON (o.order_code=oh.order_code) LEFT JOIN product p ON (oh.product_id=p.product_id)  LEFT JOIN unit_type u ON (u.unit_id=p.unit_type)  WHERE o.order_code = '".$_GET['order_code']."'");

					$row1 = $query1->result_array();







				$sql=$this->db->query('SELECT Sum(oh.product_quantity) as product_quantity, Sum(oh.product_price) as product_price, Sum(product_quantity*product_price) as product_total_price FROM order_history oh WHERE oh.order_code = "'.$_GET['order_code'].'"');

					$tmp = $sql->result_array();

					// $product_total_price = mysql_fetch_assoc($tmp);

					/*var_dump($product_total_price['product_total_price']);

					echo $sql;*/

					$count = count($query);

					if($count > 0){ ?>

					    <table class="table-condensed"  width="100%;" border="1"   style="outline: thin solid black;">

				      		<thead>

						        <tr class="text-center">

						          	<td><b>Sr No.</b></td>

						          	<td><b>Item</b></td>

						          	<td><b>Per Unit Price (in <?php echo CURRENCY_CONSTANT ?>)</b></td>

						          	<td><b>Quantity</b></td>

						          	<td><b>Price (in <?php echo CURRENCY_CONSTANT ?>)</b></td>

						        </tr>

					      	</thead>

					      	<tbody>

							  	<?php

								if($query1){

									$counter=0;



									// echo "<pre>";

									// var_dump($row1[0]['discount']);

									// exit();

										for($i=0;$i<count($row1);$i++)

									{

										$counter++;

										?>

						                <tr class="text-center">

								          	<td ><?php echo $counter; ?></td>

								          	<td><?php echo $row1[$i]['product_english_name'].' - '.$row1[$i]['seller_price_type']; ?></td>

								          	<td><?php echo $row1[$i]['product_price']?></td>

								          	<td><?php echo $row1[$i]['product_quantity']; ?> </td>

								          	<!-- <td class="text-right"><?php echo round($content['product_quantity']*$content['product_price'],2); ?></td> -->

								          	<td><?php echo round($row1[$i]['product_total_price'],2); ?></td>

								          </tr>

										<?php

									}

									?>

		                            <tr>

							          <td colspan="4"><b>Sub-Total</b></td>

							          <td class="text-center"><?php echo CURRENCY_CONSTANT."  ".round($tmp[0]['product_total_price'],2); ?></td>

							        </tr>

									<tr>

							        <!--  <td class="text-right" colspan="9"><b>eVoucher <i><?php echo $row['promocode'];?></i> redemntion</b></td> -->

 									<td  colspan="4"><b> Coupon Discount</b></td>

							          <td class="text-center"><?php echo "- ". CURRENCY_CONSTANT."  ".round($row[0]['discount'],2); ?></td>

							        </tr>

							        <tr>

							        <tr>

							          <td  colspan="4"><b>Flat Shipping Rate</b></td>

							          <td class="text-center"><?php echo CURRENCY_CONSTANT."  ".round($row[0]['delivery_charge'],2); ?></td>

							        </tr>

							        <tr style="background: black">

							          <td  colspan="4"><b><font color="white">Total</font></b></td>

							          <td class="text-center"><font color="white"><?php echo CURRENCY_CONSTANT."  ".round($row[0]['grant_total'],2); ?></font></td>

							        </tr>

									<!-- <tr>

                                      <td class="text-right" colspan="10"style="text-align: -webkit-left;"><b>Vat No.</b>27191150215V   <b>CST No.</b>27191150215C</td>

							          </tr> -->

										<!-- <tr>

							          <td class="text-right" colspan="10" style="text-align: -webkit-left;">I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax Act. 2002 is in force on the date on which the sale of  the goods specified in this " Tax Invoice"  is made by me/us and that the transaction of sales covered by this "Tax Invoice has been effected by me/us and it shall be accounted  for in  the turn over of sales while filing return and due tax, if any payable on the sales has been paid shall be paid.</td>

										</tr> -->

									<?php

								}

								?>

							</tbody>

					    </table>



					    <!-- <div class="line" style=" width:43.5%;height: 47px;border-bottom: 1px solid black;position: absolute;margin-top: -1.5%;"></div> -->

						<?php

						 $image_url= $this->config->item("upload_url") ;





					}

					?>

		      	</div>

		       	<div class="footter" style="margin-top:5%;">



		      		<div  class="text-center">

		      			<p style="font-family: HelveticaNeue;font-size: 16px;color: #4A4A4A; margin-bottom:25px;">

                If you have any questions,<br/>contact one of our representatives: <strong><?php echo NUMBER_CONSTANT; ?></strong><br/>or send us an email <strong><?php echo EMAIL_CONSTANT; ?></strong></p>

		      		</div>

		      		</div>

		      		</div></div></div>



		<?php } ?>

	</body>

</html>

