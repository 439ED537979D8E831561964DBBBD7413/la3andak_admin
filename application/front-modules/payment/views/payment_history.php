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

        <div class="col-md-6 col-xs-12">

           <header class="panel-heading">

                <h2><b><?php echo $users[0]['ufname'] ?> </b>Payments History</h2>

            </header>

        </div>

        <div class="col-md-6 col-xs-12">

           <header class="panel-heading">

                <h2 style="float: right;"></h2>

            </header>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr >

                   <th>Order No</th>

                    <th>Order Code</th>

                    <th>Order Amount (in <?php echo CURRENCY_CONSTANT; ?>)</th>

                    <th>Requested on Date</th>

                    <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($order as $key => $value) { ?>

                        <tr class="">

                           <td><?php echo $value['order_id']?></td>

                            <td><?php echo $value['order_code']; ?></td>

                            <td><?php echo $value['grant_total']; ?></td>

                            <td><?php echo date('D, j M Y g:i A',strtotime($value['order_date']));?></td>

                            <td><?php if($value['order_status']==1)
                                        {
                                            ?>
                                            <button disabled class="buttonbg" style="background-color:#8DD13D">NEW</button>
                                      <?php
                                        }
                                        if($value['order_status']==0)
                                        {
                                          ?>
                                            <button disabled class="buttonbg" style="background-color:#8DD13D">NEW</button>
                                      <?php  }
                                        if($value['order_status']==2)
                                        {
                                             ?>
                                            <button disabled class="buttonbg" style="background-color:#F5A623">PENDING</button>
                                      <?php
                                        }
                                        if($value['order_status']==3)
                                        {
                                            ?>
                                            <button disabled class="buttonbg" style="background-color:#8DD13D">NEW</button>
                                      <?php
                                        }
                                        if($value['order_status']==4)
                                        {
                                             ?>
                                            <button disabled class="buttonbg" style="background-color:#ed1c24">CANCEL</button>
                                      <?php
                                        }
                                         if($value['order_status']==5)
                                        {
                                            ?>
                                            <button disabled class="buttonbg" style="background-color:#C4C4C4">DELIVER</button>
                                      <?php
                                        } ?></td>

                            </tr>

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

