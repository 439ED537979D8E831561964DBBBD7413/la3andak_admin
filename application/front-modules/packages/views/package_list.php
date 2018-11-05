<?php include APPPATH . '/front-modules/views/top.php'; ?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-9">
                <a class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'packages/add_package'; ?>">
                 Add New Package</a>
        </div>
    </div>
    <div class="x_panel">

        <div class="x_content">

            <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Sedan Price</th> 
                        <th>Suv Price</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $key => $value) { ?>
                        <tr>
                            <td>
                                <img src="<?php echo $value['image']; ?>" alt="photo" class="img-responsive" width="50"/>
                            </td>
                            <td><?php echo $value['title']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                            <td><?php echo $value['sedan_price']; ?></td>                                                        
                            <td><?php echo $value['suv_price']; ?></td>                                                        
                            <td><a href="<?php echo $this->config->item("site_url") . "edit_package?pkg_id=" . urlencode($this->general->encryptData($value["pkg_id"])); ?>"><i class="fa fa-pencil"></i></a><a class="Delete" href="<?php echo $this->config->item("site_url") . "delete_package?pkg_id=" . urlencode($this->general->encryptData($value["pkg_id"])); ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a></td>                            
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
        $("#list").DataTable();
    })
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
