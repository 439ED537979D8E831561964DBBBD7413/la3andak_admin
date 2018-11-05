<?php include APPPATH . '/front-modules/views/top.php'; ?>

<style>
.dsdsbtn {
    display: block;
    /*width: 115px;
    height: 25px;*/
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-md-9">
                <a href="<?php echo $this->config->item("site_url") . 'customers/view_customer?cust_id='.urlencode($this->general->encryptData($customer["cust_id"])); ?>"><i class="fa fa-arrow-left"></i> Back</a>                

        </div>
        <div class="col-md-3">          
                <a id="viewformlink" href="#vehicle" data-toggle="modal" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add New Vehicle</a>          
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-9"><p><?php echo $customer['fullname'];?></p></div>        
    </div>
    <div class="x_panel">        
        <div class="x_content">            
            <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Model Year</th>
                        <th>Make</th>                        
                        <th>Model</th>
                        <th>Color</th>
                        <th>License Plate No</th> 
                        <th>Action</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($vehicles)){

                        foreach ($vehicles as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['type']; ?></td>                            
                                <td><?php echo $value['model_year']; ?></td>
                                <td><?php echo $value['make']; ?></td>                            
                                <td><?php echo $value['model']; ?> </td>
                                <td><?php echo $value['color']; ?> </td>
                                <td><?php echo $value['license_plate_no']; ?> </td>                                
                                <td>
                                    <a href="javascript:void(0)" onclick="getVehicle('<?php echo urlencode($this->general->encryptData($value["veh_id"])) ; ?>');" ><i class="fa fa-pencil"></i></a>
                                    <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_vehicle?cust_id=".urlencode($this->general->encryptData($value["cust_id"]))."&veh_id=".urlencode($this->general->encryptData($value["veh_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a>
                                </td>                            
                            </tr>
                        <?php }
                    } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="vehicle" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" > Vehicle<span id="viewformtitle"></span></h3>
            </div>            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <div class="row" id="viewformiframe">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">                                
                                <div class="x_content">
                                    <br/>
                                    <form id="location_form" method="post" action="" class="form-horizontal form-label-left input_mask">
                                        <input id="cust_id" type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>"/>
                                        <input id="veh_id" type="hidden" name="veh_id" value=""/>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="type" name="type" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Model Year<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="model_year" name="model_year" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Make<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="make" name="make" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Model<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="model" name="model" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="color" name="color" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">License Plate No<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="license_plate_no" name="license_plate_no" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>                                            
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">                                           
                                                <button type="button" class="btn btn-primary" onclick="addVehicle()">Save</button>
                                                <button type="button" class="btn btn-primary" id="formCancel" data-dismiss="modal" aria-hidden="true">Cancel</button>                                               
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Modal body END -->
        </div> 
    </div>
</div>


<script>
//JS script
$('#vehicle').modal({
    backdrop: 'static',    
    keyboard: false,  // to prevent closing with Esc button (if you want this too)
    show:false
});
// Add Record
function addVehicle() {
    // get values
    var cust_id = $("#cust_id").val();
    var veh_id = $("#veh_id").val();
    var type = $("#type").val();

    var model_year = $("#model_year").val();
    var make = $("#make").val();
    var model = $("#model").val();
    var color = $("#color").val();
    var license_plate_no = $("#license_plate_no").val();
    
    var url='<?php echo $this->config->item("site_url")."vehicle_add?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        cust_id: cust_id,
        veh_id: veh_id,
        type: type,
        model_year: model_year,
        make: make,
        model: model,
        color: color,
        license_plate_no: license_plate_no,
        
    }, function (data, status) {
        
        var res=JSON.parse(data);
        
        if(res.status==1){
            $("#vehicle").modal("hide");
            $("#type").val("");
            $("#model_year").val("");
            $("#make").val("");
            $("#model").val("");
            $("#color").val("");
            $("#license_plate_no").val("");            
            window.location = window.location.href;
        }else{
            alert(res.message);           
        }
    });
}

function getVehicle(veh_id){
    
   var url='<?php echo $this->config->item("site_url")."get_vehicle?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        veh_id: veh_id,        
    }, function (data, status) {
        
        var res=JSON.parse(data);        
        if(res.status==1){
            var vehicle=res.vehicle;
            //console.log("location"+location.fullname);
            $("#vehicle").modal("show");
            $("#type").val(vehicle.type);
            $("#model_year").val(vehicle.model_year);
            $("#make").val(vehicle.make);
            $("#model").val(vehicle.model);
            $("#color").val(vehicle.color);
            $("#license_plate_no").val(vehicle.license_plate_no);            
            $("#veh_id").val(vehicle.veh_id);        
            
        }else{
            alert(res.message);           
        }
        
    });

}

$(document).ready(function() {
    $("#list").DataTable();
});
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
