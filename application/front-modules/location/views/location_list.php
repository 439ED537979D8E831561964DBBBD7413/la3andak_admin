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
            <a style="float: right; background-color:#669BFF;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'location/location_add'; ?>">Add New Location</a>
        </div>        
        
    </div>
    <div class="x_panel">        
        <div class="x_content">            
            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr >
                       <th>ID</th>
                        <th>Postal Code</th>
                        <th>Location Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                                                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($locations as $key => $value) { ?>
                        <tr class="">
                            <td><?php echo $value['location_id']; ?></td>
                            <td><?php echo $value['postal_code']; ?></td>
                            <td><?php echo $value['area_name']; ?></td>
                            <td><?php echo $value['city_name']; ?></td>
                            <td><?php echo $value['state_name']; ?></td>
                            <td><?php echo $value['country_name']; ?></td>
                            <td><?php if($value['status']==1){?>
                                <span class="buttonbg" style="background: green">Active</span>
                                <?php } else { ?>
                                <span class="buttonbg" style="background: red">InActive</span>
                                <?php }?></td>                          
                            <td>
                            <a href="<?php echo $this->config->item("site_url")."location_edit?location_id=".urlencode($this->general->encryptData($value["location_id"])) ; ?>" title="Edit Location"><i class="fa fa-pencil"></i></a>

                             <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_location?location_id=".urlencode($this->general->encryptData($value["location_id"])) ; ?>" style="margin-left: 5px" title="Delete Location"><i class="fa fa-trash-o"></i></a>                         
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
