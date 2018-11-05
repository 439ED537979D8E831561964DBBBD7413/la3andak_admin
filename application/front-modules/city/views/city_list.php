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
        <div class="col-md-6"><h2>City List</h2></div>
        <div class="col-md-6">

            <a style="float: right; background-color:#2f3a54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'city/city_add'; ?>">Add New City</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr >

                        <th>ID</th>

                        <th>City Name</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($city as $key => $value) { ?>

                        <tr class="">

                            <td><?php echo $value['iCity_id']; ?></td>

                            <td><?php echo $value['vCity_name']; ?></td>



                            <td><?php if($value['bActive_status']==1){?>

                                <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                <span class="buttonbg" style="background: red">Inactive</span>

                                <?php }?></td>

                            <td>

                            <a href="<?php echo $this->config->item("site_url")."edit_city?iCity_id=".urlencode($this->general->encryptData($value["iCity_id"])) ; ?>" title="Edit Brand"><i class="fa fa-pencil"></i></a>



                             <a class="delete_city" href="<?php echo $this->config->item("site_url")."delete_city?iCity_id=".urlencode($this->general->encryptData($value["iCity_id"])) ; ?>" style="margin-left: 5px" title="Delete Brand"><i class="fa fa-trash-o"></i></a>

                            <!-- <a class="view" href="<?php echo $this->config->item("site_url")."view_order?iCity_id=".urlencode($this->general->encryptData($value["iCity_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-eye"></i></a> -->

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





<script type="text/javascript">



    jQuery(".delete_city").click(function(){

        if(confirm("If you are delete City than also remove all area of that Particular City...Are you /sure you want to delete???"))

        {        return true;

        }

       else {

           return false;     }  })

</script>



<?php

include APPPATH . '/front-modules/views/footer.php';



