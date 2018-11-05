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
          <div class="col-md-6"><h2>Sub Category List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2a3f54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'sub_category/sub_category_add'; ?>">Add New Sub Category</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th>Sub Category ID</th>

                        <th>Sub Category Icon</th>



                        <th>Category Name</th>



                        <th>Sub Category Name</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($sub_category as $key => $value)

                    { ?>

                        <tr class="">

                            <td><?php echo $value['product_bunch_id']; ?></td>

                            <td>

                                <img src="<?php  echo TABLE_SUB_CATEGORY_UPLOAD.$value['product_image']; ?>" width="50px" height="50px">

                            </td>



                            <td><?php

                                        foreach ($category as $key1 => $value1)

                                        {

                                           if($value1['category_id']==$value['product_category'])

                                           {

                                            echo $value1['category_english_name'];

                                           }

                                        }

                                 ?></td>



                            <td><?php echo $value['productbunch_english_name']; ?></td>



                            <td><?php if($value['product_status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">Inactive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."sub_category_edit?product_bunch_id=".urlencode($this->general->encryptData($value["product_bunch_id"])) ; ?>" title="Edit sub Category"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_sub_category?product_bunch_id=".urlencode($this->general->encryptData($value["product_bunch_id"])) ; ?>" style="margin-left: 5px" title="Delete Sub Category"><i class="fa fa-trash-o"></i></a>

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

