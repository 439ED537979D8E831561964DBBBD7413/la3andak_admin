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
