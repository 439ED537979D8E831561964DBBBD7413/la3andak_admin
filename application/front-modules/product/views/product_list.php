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

          <div class="col-md-6">


                <h2>Product  List</h2>



          </div>

        <div class="col-md-6">

            <a style="float: right; background-color:#2a3f54 ;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'product/product_add'; ?>">Add New Product</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th>Product ID</th>

                        <th>Product Icon</th>

                         <th>Product Name</th>

                        <th>Sub Category Name</th>

                        <th>Category Name</th>

                        <th>Price</th>
                        <th>Quantity </th>

                        <th>Status</th>

                        <th>Actions</th>

                        <th>Sub Product Add</th>

                        <th>Sub Product List</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($product as $key => $value)

                    { ?>

                        <tr class="">

                            <td><?php echo $value['product_id']; ?></td>

                            <td>

                                <img src="<?php  echo TABLE_PRODUCT_UPLOAD.$value['product_image']; ?>" width="50px" height="50px">

                            </td>

                            <td><?php echo $value['product_english_name']; ?></td>

                             <td><?php



                                     foreach ($sub_category as $key2 => $value2)

                                        {

                                           if($value2['product_bunch_id']==$value['product_bunch'])

                                           {

                                            echo $value2['productbunch_english_name'];

                                           }

                                        }







                             ?></td>

                            <td><?php

                                        foreach ($category as $key1 => $value1)

                                        {

                                           if($value1['category_id']==$value['product_category'])

                                           {

                                            echo $value1['category_english_name'];

                                           }

                                        }

                                 ?></td>



                            <td><?php echo $value['discounted_price']; ?></td>
                            <td><?php echo $value['quantity']; ?></td>


                            <td><?php if($value['product_status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">Inactive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."product_edit?product_id=".urlencode($this->general->encryptData($value["product_id"])) ; ?>" title="Edit Product"><i class="fa fa-pencil"></i></a>



                             <a class="Delete" href="<?php echo $this->config->item("site_url")."product_delete?product_id=".urlencode($this->general->encryptData($value["product_id"])) ; ?>" style="margin-left: 5px" title="Delete Product"><i class="fa fa-trash-o"></i></a>

                            </td>

                            <td><span class='tools pull-center'><a class="btn btn-primary" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%" href= "<?php echo $this->config->item("site_url")."product_sub_product_add?product_id=".urlencode($this->general->encryptData($value["product_id"])) ; ?>">Add</a></span></td>

                            <td><span class='tools pull-center'><a class="btn btn-primary" style="background: #2a3f54;text-align:center;width: 103%;margin-top: 5%" href="<?php echo $this->config->item("site_url")."sub_product_list?product_id=".urlencode($this->general->encryptData($value["product_id"])) ; ?>">List</a></span></td>

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

