
<?php include APPPATH . '/front-modules/views/top.php'; ?>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
      $(function () {
    $('#customer_form').hide();
});
  $( function() {
    $( "#events_date" ).datepicker();
  } );

  $( function() {
    $( "#events_date1" ).datepicker();
  } );
  $.datepicker.setDefaults({
    dateFormat: 'dd-mm-yy',
    changeMonth: true,
        changeYear: true,
        // minDate: 0,
});

  </script>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-12">
           <header class="panel-heading">
                <h2>Payment Report</h2>
            </header>
        </div>

    </div>
    <div class="x_panel">
        <div class="x_content">
                         <div class="form-group  col-md-offset-2"  style="margin-top:45px;">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Report Type<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                               <select class="form-control" onchange="change(this)" style="width:45%;margin-left: -85px;margin-top: -6px">
                                    <option value="none">--Please select Range--</option>
                                   <option value="weekly_report">Weekly</option>
                                   <option value="date_range">Date Range</option>
                               </select>
                            </div>
                        </div>


                 <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "payment/payment_report_action" ?>">
                    <div class="col-md-6 col-md-offset-2"  style="margin-top:25px;">



                       <div class="form-group" id="weekly_report">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Daily Report<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="radio" name="range" value="weekly"> <label class="control-label">Weekly</label>
                                <input type="radio" name="range" value="monthly" style="margin-left:15px"> <label class="control-label">Monthly</label>
                                <input type="radio" name="range" value="quaterly" style="margin-left:15px"> <label class="control-label">Quaterly</label>
                            </div>
                        </div>


                         <div class="form-group" id="date_pickers" class="date_range">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top:45px;">Date Range<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="width:35%">
                                <div class="input-icon right">
                                    <i class="fa"></i><p>From</p>
                                    <input type="text" placeholder="Date Range From" readonly="" name="events_date" id="events_date" class="form-control" value="" style="margin-top:10px; ">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="width: 35%">
                                <div class="input-icon right">
                                    <i class="fa"></i><p>To</p>
                                    <input type="text" placeholder="Date Range To" readonly="" name="events_date1" id="events_date1" class="form-control" style="margin-top:10px; ">
                                </div>
                            </div>
                        </div>





                    <div class="col-md-4">
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                            <input type="submit" class="btn btn-success">
                            <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div></div>
                </form>
            <!-- <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr >
                    <th>Consumer ID</th>
                    <th>Consumer Name</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $value) { ?>
                        <tr class="">
                            <td><?php echo $value['user_id']; ?></td>
                            <td><?php echo $value['ufname']; ?></td>
                            <td>
                              <?php  $result1 = $this->db->query("SELECT SUM(`grant_total` ) AS total_amount FROM  `order` WHERE  `user_id`=".$value['user_id']);
                                    $total  =$result1->result_array();

                                    //var_dump($total);
                                ?>
                                <?php  if (!empty($total['total_amount'])) {
                                        echo round($total['total_amount'],2);
                                    }else{
                                        echo 0.00;
                                        } ?>

                            </td>
                            <td>
                            <a style="color:blue;" href="<?php echo $this->config->item("site_url")."payment_history?user_id=".urlencode($this->general->encryptData($value["user_id"])) ; ?>" title="Payment History">Payment History</a>
                            </td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
 -->
                <?php if($order)  {?>

            <?php
                    $rupess = 0;
                    for ($i=0; $i < count($order); $i++)
                    {
                       $rupess = $rupess + ($order[$i]['grant_total']);
                    } ?>
                    <h3 style="margin-top: 8%"><font style="margin-left: 34%">Order Summary</font></h3>
                    <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" style="width: 30%;margin-left: 28.5%;margin-top:1.5%">

                        <tbody style="text-align: center;">
                            <tr>
                            <td><b>Total Order</b></td>
                            <td><?php echo count($order); ?></td>
                            </tr>
                            <tr >
                            <td><b>Total Amount</b></td>
                            <td><?php echo ($rupess); ?></td>
                            </tr>
                            <tr >
                            <td><b>Start date</b></td>
                            <td><?php echo date('Y-m-d', strtotime($start_date)); ?></td>
                            </tr>
                            <tr >
                            <td><b>End date</b></td>
                            <td><?php echo date('Y-m-d', strtotime($end_date));?></td>
                            </tr>
                        </tbody>
                    </table>



              <?php }?>
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



<script type="text/javascript">

 function change(obj)
    {
        var selectBox = obj;
        var selected = selectBox.options[selectBox.selectedIndex].value;

        var date_range = document.getElementById("date_range");
        var weekly_report = document.getElementById("weekly_report");
        var customer_form= document.getElementById("customer_form");



        if(selected === 'weekly_report')
        {
             $('#weekly_report').show();
             $('#date_pickers').hide();
             $('#customer_form').show();
        }
        if(selected === 'date_range')
        {
             $('#weekly_report').hide();
             $('#date_pickers').show();
             $('#customer_form').show();
        }
        if(selected === 'none')
        {
            $('#weekly_report').hide();
             $('#date_pickers').hide();
             $('#customer_form').hide();
        }

    }

</script>
<?php
include APPPATH . '/front-modules/views/footer.php';
