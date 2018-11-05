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

    <div class="row">

        <div class="col-md-12">

           <header class="panel-heading">

                <h2>Consumer Payments List</h2>

            </header>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr >

                    <th>Consumer ID</th>

                    <th>Consumer Name</th>

                    <th>Total Order Amount (in <?php echo CURRENCY_CONSTANT; ?>)</th>

                    <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($users as $key => $value) { ?>

                        <tr class="">

                            <td><?php echo $value['user_id']; ?></td>

                            <td><?php echo $value['ufname']; ?></td>

                            <td>

                              <?php  $result1 = $this->db->query("SELECT SUM(`grant_total` ) AS total_amount FROM  `order` WHERE order_status = 5 and `user_id`=".$value['user_id']);

                                    $total  =$result1->result_array();



                                    // var_dump($total);
                                    // exit;


                                ?>

                                <?php  if (!empty($total[0]['total_amount'])) {

                                        echo round($total[0]['total_amount'],2);

                                    }else{

                                        echo 0.00;

                                        } ?>



                            </td>

                            <td>

                            <a style="background: #2a3f54;text-align:center;width:60%;" class="btn btn-default" href="<?php echo $this->config->item("site_url")."payment_history?user_id=".urlencode($this->general->encryptData($value["user_id"])) ; ?>" title="Payment History"><font color="white">Payment History</font></a>

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

        $("#list").DataTable({

            "order": [[ 0, "desc" ]]

        }

        );



    });



</script>









<?php

include APPPATH . '/front-modules/views/footer.php';

