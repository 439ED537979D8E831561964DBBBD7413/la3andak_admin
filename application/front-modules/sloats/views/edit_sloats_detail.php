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
        <div class="col-md-6 col-xs-12">
           <header class="panel-heading">
                <h2>Edit Sloats Detail</h2>                      
            </header>
        </div>
    </div>
    <div class="x_panel">        
        <div class="x_content">            
            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Slot ID</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Slot Time</th>
                        <th>Prefix</th>
                        <th>Status</th>
                        <th>Order Limit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sloats as $key => $value) { ?>
                        <tr class="">
                           <td><?php echo $value['slot_id']; ?></td>
                            <td><?php echo $value['start_time']; ?></td>
                            <td><?php echo $value['start_end']; ?></td>
                            <td><?php echo $value['slot_time']; ?></td>
                            <td><?php echo $value['prefix']; ?></td>     
                            <td>
                           <a href="javascript:void(0);" class="btn btn-default get" onClick="ChangeSlotStatus('<?php echo strip_tags($value['status']); ?>','<?php echo strip_tags($value['slot_id']); ?>');"><?php if ($value['status']==1){echo "Deactive";}else{echo "Active";}?></a>
                        </td>
                        <td><input type="text" calss="form-control " name="order_limit" id="<?php echo $value['slot_id']; ?>" value="<?php echo $value['order_limit']; ?>" onblur="getValue(this)" /></td>
                            </tr>                   
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

    function ChangeSlotStatus(status,slot_id) 
    {

            if(confirm("Are you sure that you really want to change this item?"))
            {
                $('#AjaxLoaderDiv').fadeIn('slow');
                    $.ajax({
                     type: "POST",
                     url : '<?php echo base_url(); ?>sloats/ChangeSlotStatus',    
                    data: {'status' : status,
                          'slot_id': slot_id
                          },                
                  success: function(data){
                    $('#AjaxLoaderDiv').fadeOut('fast');
                    location.reload();
                  },
                  error: function (e){
                    alert (e)
                  }
                })      
            }
            return false;
        }

        function getValue(obj)
        {


             $('#AjaxLoaderDiv').fadeIn('slow');
                    $.ajax({
                     type: "POST",
                    url : '<?php echo base_url(); ?>sloats/Slots_order_limit',   
                     data: {'id' : obj.id,
                          'order_limit': obj.value
                          },             
                  success: function(data){
                    $('#AjaxLoaderDiv').fadeOut('fast');
                    location.reload();
                  },
                  error: function (e){
                    alert (e)
                  }
                })     
        
        }
       
   
    
</script>




<?php
include APPPATH . '/front-modules/views/footer.php';
