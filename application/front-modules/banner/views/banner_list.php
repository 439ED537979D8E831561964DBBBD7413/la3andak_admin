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
    <div class="col-md-6"><h2>Banner List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2f3a54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'banner/add_banner'; ?>">Add New Banner</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr>



                        <th>Banner ID</th>

                        <th>Banner Icon</th>

                        <th>Banner URL</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($banner as $key => $value)

                    { ?>

                        <tr class="">

                            <td><?php echo $value['id']; ?></td>

                             <td><img src="<?php  echo TABLE_BANNER_UPLOAD.$value['vImage']; ?>" width="50px" height="50px"></td>

                            <td><a href="<?php echo $value['vDesc']; ?>"><?php echo $value['vDesc']; ?></td>




                            <td><?php if($value['status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">Inactive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."edit_banner?id=".urlencode($this->general->encryptData($value["id"])) ; ?>" title="Edit Banner"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_banner?id=".urlencode($this->general->encryptData($value["id"])) ; ?>" style="margin-left: 5px" title="Delete Banner"><i class="fa fa-trash-o"></i></a>

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

