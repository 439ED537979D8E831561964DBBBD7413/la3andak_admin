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

        <div class="col-md-4"><h2><?php echo $consumer[0]['ufname'] ?>  Delivery Address List</h2></div>

        <div class="col-md-4"><h2></h2></div>

        <div class="col-md-4">

            <?php $id  = $consumer[0]['user_id'];

                $name =$consumer[0]['ufname'];

            ?>



            <a href="<?php echo $this->config->item("site_url")."consumer/ExportCSV?name=$name&&user_id=".urlencode($this->general->encryptData($id)) ; ?>" title="Export address" style="float: right; background-color:#2A3f54;" class="btn btn-primary">Export Address</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                  <tr>

                    <th>Address Id</th>

                    <th>Address Type</th>

                    <!-- <th>Address</th> -->

                    <th>LandMark</th>

                    <th>Address Line</th>

                    <th>Area</th>

                    <th>City</th>

                    <th>Default Address ( 1 = Default , 0 = Not Default  )</th>

                   <!-- <th>Action</th> -->

                </tr>

                </thead>

                <tbody>

                    <?php foreach ($address as $key => $row) { ?>

                        <tr class="">

                        <td><?php echo $row['address_id']; ?></td>

                        <td><?php echo $row['address_type']; ?></td>

                        <td><?php echo $row['landmarks']; ?></td>

                        <td><?php echo $row['address_line']; ?></td>

                        <td><?php echo $row['area']; ?></td>

                         <td><?php echo $row['city']; ?></td>

                         <td><?php echo $row['default_address']; ?></td>



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

