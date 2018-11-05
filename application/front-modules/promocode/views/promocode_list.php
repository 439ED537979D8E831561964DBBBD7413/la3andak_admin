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
    <div class="col-md-6"><h2>Promocode List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2a3f54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'promocode/add_promocode'; ?>">Add New Promocode</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr >

                       <th>ID</th>

                        <th>Coupon Code Icon</th>

                        <th>Coupon Code Name</th>

                        <th>Coupon Code</th>

                        <th>Offer Type</th>

                        <th>Discount</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($promocode as $key => $value) { ?>

                        <tr class="">

                            <td><?php echo $value['promocode_id']; ?></td>

                            <td><img src="<?php  echo TABLE_PROMOCODE_UPLOAD.$value['promocode_image']; ?>" width="50px" height="50px"></td>

                            <td><?php echo $value['promocode_name']; ?></td>

                            <td><?php echo $value['promocode']; ?></td>

                            <td><?php echo $value['offers_type']; ?></td>

                            <td><?php
                            if ($value['offers_type'] == "PERCENTAGE")
                            {
                                 echo $value['offer_value']."%";
                            }
                            else
                            {
                                echo $value['offer_value']." ".CURRENCY_CONSTANT;
                            }
                             ?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."promocode_edit?promocode_id=".urlencode($this->general->encryptData($value["promocode_id"])) ; ?>" title="Edit Promocode"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_promocode?promocode_id=".urlencode($this->general->encryptData($value["promocode_id"])) ; ?>" style="margin-left: 5px" title="Delete Promocode"><i class="fa fa-trash-o"></i></a>

                            <!-- <a class="view" href="<?php echo $this->config->item("site_url")."view_order?brand_id=".urlencode($this->general->encryptData($value["brand_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-eye"></i></a> -->

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

