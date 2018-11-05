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
          <div class="col-md-6"><h2>Category List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2a3f54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'category/category_add'; ?>">Add New Category</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr >

                        <th>ID</th>

                        <th>Category Icon</th>

                        <th>Category Name</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($brands as $key => $value) { ?>

                        <tr class="">

                            <td><?php echo $value['category_id']; ?></td>

                            <td>

                                <img src="<?php  echo TABLE_CATEGORY_UPLOAD.$value['category_icon']; ?>" width="50px" height="50px">

                            </td>

                            <td><?php echo $value['category_english_name']; ?></td>



                            <td><?php if($value['category_status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">Inactive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."category_edit?category_id=".urlencode($this->general->encryptData($value["category_id"])) ; ?>" title="Edit Category"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_category?category_id=".urlencode($this->general->encryptData($value["category_id"])) ; ?>" style="margin-left: 5px" title="Delete Category"><i class="fa fa-trash-o"></i></a>

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

