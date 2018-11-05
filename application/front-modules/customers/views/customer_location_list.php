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
<?php $state_list=array(
"Alabama",
"Alaska",
"Arizona",
"Arkansas",
"California",
"Colorado",
"Connecticut",
"Delaware",
"Florida",
"Georgia",
"Hawaii",
"Idaho",
"Illinois",
"Indiana",
"Iowa",
"Kansas",
"Kentucky",
"Louisiana",
"Maine",
"Maryland",
"Massachusetts",
"Michigan",
"Minnesota",
"Mississippi",
"Missouri",
"Montana",
"Nebraska",
"Nevada",
"New Hampshire",
"New Jersey",
"New Mexico",
"New York",
"North Carolina",
"North Dakota",
"Ohio",
"Oklahoma",
"Oregon",
"Pennsylvania",
"Rhode Island",
"South Carolina",
"South Dakota",
"Tennessee",
"Texas",
"Utah",
"Vermont",
"Virginia",
"Washington",
"West Virginia",
"Wisconsin",
"Wyoming");
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="row">
	    <div class="col-md-9">
	            <a href="<?php echo $this->config->item("site_url") . 'customers/view_customer?cust_id='.urlencode($this->general->encryptData($customer["cust_id"])); ?>"><i class="fa fa-arrow-left"></i> Back</a>                

	    </div>
	    <div class="col-md-3">	    	
	    	    <a id="viewformlink" href="#location" data-toggle="modal" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add New Location</a>	    	
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
                        <th>Full name</th>
                        <th>Type</th>
                        <th>Street</th>                        
                        <th>Unit</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zipcode</th>
                        <th>Action</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($location)){

                        foreach ($location as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['fullname']; ?></td>                            
                                <td><?php echo $value['loc_type']; ?></td>
                                <td><?php echo $value['street']; ?></td>                            
                                <td><?php echo $value['unit']; ?> </td>
                                <td><?php echo $value['city']; ?> </td>
                                <td><?php echo $value['state']; ?> </td>
                                <td><?php echo $value['zipcode']; ?> </td>
                                <td>
                                     
                                    <a href="javascript:void(0)" onclick="getLocation('<?php echo urlencode($this->general->encryptData($value["loc_id"])) ; ?>');" ><i class="fa fa-pencil"></i></a>

                                    <!-- <a href="<?php //echo $this->config->item("site_url")."edit_location?cust_id=".urlencode($this->general->encryptData($value["cust_id"]))."&loc_id=".urlencode($this->general->encryptData($value["loc_id"])) ; ?>"><i class="fa fa-pencil"></i></a> -->
                                    
                                    <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_location?cust_id=".urlencode($this->general->encryptData($value["cust_id"]))."&loc_id=".urlencode($this->general->encryptData($value["loc_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="location" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" ><?php echo ($location['loc_id'] != '') ? 'Edit' : 'Add'; ?> Location<span id="viewformtitle"></span></h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <div class="row" id="viewformiframe">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">                                
                                <div class="x_content">
                                    <br/>
                                    <form id="location_form" method="post" action="<?php echo $this->config->item('site_url') . 'customers/location_action' ?>" class="form-horizontal form-label-left input_mask">
                                        <input id="cust_id" type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>"/>
                                        <input id="loc_id" type="hidden" name="loc_id" value=""/>
                                        <input type="hidden" name="loc_id" value="<?php echo $location['loc_id']; ?>"/>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="fullname" name="fullname" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['fullname'] != '') ? $location['fullname'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <!-- <input required="required" id="loc_type" name="loc_type" class="form-control col-md-7 col-xs-12" type="text" value="<?php //echo ($location['loc_type'] != '') ? $location['loc_type'] : ''; ?>"> -->
                                                    
                                                    <select name="loc_type" id="loc_type" class="form-control col-md-7 col-xs-12">
                                                          <option value="Home" <?php if($location['loc_type']=='Home'){ echo " selected";} ?> >Home</option>
                                                          <option value="Apartment" <?php if($location['loc_type']=='Apartment'){ echo " selected";} ?>>Apartment</option>
                                                          <option value="Office" <?php if($location['loc_type']=='Office'){ echo " selected";} ?>>Office</option>
                                                          <option value="Building" <?php if($location['loc_type']=='Building'){ echo " selected";} ?>>Building</option>                                                          
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Street<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="street" name="street" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['street'] != '') ? $location['street'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="unit" name="unit" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['unit'] != '') ? $location['unit'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">City<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="city" name="city" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['city'] != '') ? $location['city'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">State<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <!-- <input required="required" id="state" name="state" class="form-control col-md-7 col-xs-12" type="text" value="<?php //echo ($location['state'] != '') ? $location['state'] : ''; ?>"> -->
                                                    <select name="state" id="state" class="form-control col-md-7 col-xs-12">
                                                    <option value="">Please select state</option>
                                                    <?php foreach($state_list as $state){ ?>
                                                        <option value="<?php echo trim($state); ?>" <?php if($location['loc_type']==$state){ echo " selected";} ?> >
                                                            <?php echo $state; ?>
                                                        </option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Zipcode<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="zipcode" maxlength="5" name="zipcode" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['zipcode'] != '') ? $location['zipcode'] : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Instruction <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="instruction" name="instruction" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo ($location['instruction '] != '') ? $location['instruction '] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">                                           
                                                <button type="button" class="btn btn-primary" onclick="addRecord()">Save</button>
                                                <button type="button" class="btn btn-primary" id="formCancel" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                                <!-- <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a> -->
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
$('#location').modal({
    backdrop: 'static',    
    keyboard: false,  // to prevent closing with Esc button (if you want this too)
    show:false
});
$('#location').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});
// Add Record
function addRecord() {
    // get values
    var cust_id = $("#cust_id").val();
    var loc_id = $("#loc_id").val();
    var fullname = $("#fullname").val();

    //var loc_type = $("#loc_type").val();

    var loc_type = $( "#loc_type option:selected" ).text();
    var street = $("#street").val();
    var unit = $("#unit").val();
    var city = $("#city").val();
    //var state = $("#state").val();
    var state = $( "#state option:selected" ).text();

    var zipcode = $("#zipcode").val();
    var instruction = $("#instruction").val();
     

    var address=$address = street+","+unit+", "+city+", "+state+", "+zipcode; 
    
    /*var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        alert(latitude);
      } 
    }); 
    alert(address);
    return;*/

    

    var url='<?php echo $this->config->item("site_url")."location_add?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        cust_id: cust_id,
        loc_id: loc_id,
        fullname: fullname,
        loc_type: loc_type,
        street: street,
        unit: unit,
        city: city,
        state: state,
        zipcode: zipcode,
        instruction:instruction,
    }, function (data, status) {
        //alert("status="+status);
        // close the popup
        var res=JSON.parse(data);
        //console.log("fdsf"+res);
        if(res.status==1){
            $("#location").modal("hide");
            $("#fullname").val("");
            //$("#loc_type").val("");
            $("#street").val("");
            $("#unit").val("");
            $("#city").val("");
            //$("#state").val("");
            $("#zipcode").val(""); 
            $("#instruction").val("");
            window.location = window.location.href;
        }else{
            alert(res.message);           
        }
        //console.log("fdsf"+data);
        //window.location = window.location.href;

    });
}

function getLocation(loc_id){
    
   var url='<?php echo $this->config->item("site_url")."get_location?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        loc_id: loc_id,        
    }, function (data, status) {
        //alert("status="+status);
        // close the popup
        var res=JSON.parse(data);
        //console.log("fdsf"+res.location);
        //console.log("fdsf"+res);
        if(res.status==1){
            var location=res.location;
            //console.log("location"+location.fullname);
            $("#location").modal("show");
            $("#fullname").val(location.fullname);
            $("#loc_type").val(location.loc_type);
            $("#street").val(location.street);
            $("#unit").val(location.unit);
            $("#city").val(location.city);
            //$("#state").val(location.state);
            //$("#state").val(location.state);
            $('#state option[value='+location.state+']').attr('selected','selected');
            //$( "#state option:selected" ).text(location.state);
            $("#zipcode").val(location.zipcode);
            $("#instruction").val(location.instruction);
            
            $("#loc_id").val(location.loc_id);        
            //window.location = window.location.href;
        }else{
            alert(res.message);           
        }
        //console.log("fdsf"+data);
        //window.location = window.location.href;

    });

}
function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    var loc_id=id;
    var url='<?php echo $this->config->item("site_url")."get_location?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    url+="&loc_id="+loc_id;
    alert(url);
    $.post(url, {
            id: id
        },
        function (data, status) {
            // PARSE json data
            
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_first_name").val(user.first_name);
            $("#update_last_name").val(user.last_name);
            $("#update_email").val(user.email);
        }
    );
    // Open modal popup
    //$("#location").modal("show");
}

    $(document).ready(function() {
        $("#list").DataTable();

        $("#fullname").keypress(function(event){
	        var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
	            event.preventDefault(); 
	        }
	    });
	     $("#instruction").keypress(function(event){
	        var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
	            event.preventDefault(); 
	        }
	    });

    });
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
