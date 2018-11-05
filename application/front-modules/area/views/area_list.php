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
    <div class="col-md-6"><h2>Area List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2f3a54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'area/add_area'; ?>">Add New Area</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr>



                        <th>Area ID</th>

                        <th>Area Name</th>

                        <th>City Name</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($area as $key => $value)

                    { ?>

                        <tr class="">

                            <td><?php echo $value['iArea_id']; ?></td>

                            <td><?php echo $value['vArea_name']; ?></td>

                            <td><?php

                                        foreach ($city as $key1 => $value1)

                                        {

                                           if($value1['iCity_id']==$value['iCity_id'])

                                           {

                                            echo $value1['vCity_name'];

                                           }

                                        }

                                 ?></td>







                            <td><?php if($value['status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">InActive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."edit_area?iArea_id=".urlencode($this->general->encryptData($value["iArea_id"])) ; ?>" title="Edit Area"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_area?iArea_id=".urlencode($this->general->encryptData($value["iArea_id"])) ; ?>" style="margin-left: 5px" title="Delete Area"><i class="fa fa-trash-o"></i></a>

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

