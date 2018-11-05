<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/driver.js"></script>
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
 .buttonbg{
	width:100%;color:#ffffff;padding:5px;
    border: 0;
    margin: 0px !important;
border-radius:5px;
}

</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">        
        <div class="col-md-3">          
                <a id="viewformlink" href="#driver" data-toggle="modal" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add New Driver</a>          
        </div>
        
    </div>    
    <div class="x_panel">        
        <div class="x_content">            
            <table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>  
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Phone</th>                        
                        <th>Status</th>                        
                        <th>Action</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($drivers)){

                        foreach ($drivers as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['del_id']; ?></td>
                                <td><?php echo $value['fullname']; ?></td>                            
                                <td><?php echo $value['email']; ?></td>                            
                                <td><?php echo $value['phone']; ?> </td>
                                <td><?php //echo $value['status'];
                             
                                        if($value['status']==1)
                                        {
                                          echo " <button disabled class='buttonbg' style='background-color:#8DD13D'>Available</button>";
                                        }
                                         if($value['status']==2)
                                         {
                                          echo " <button disabled class='buttonbg' style='background-color:#C4C4C4'>Offline</button>";
                                            
                                        }
                                         if($value['status']==3){
                                         echo " <button disabled class='buttonbg' style='background-color:#F5A623'>Pending</button>";
                                            
                                        }
                                         if($value['status']==4){
                                         echo " <button disabled class='buttonbg' style='background-color:#669BFF'>In Process</button>";
                                            
                                        }
                                        
                                     ?></td>                             
                                <td>                                    
                                    <a href="javascript:void(0)" onclick="getDriver('<?php echo urlencode($this->general->encryptData($value["del_id"])) ; ?>');" ><i class="fa fa-pencil"></i></a>
                                    <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_driver?del_id=".urlencode($this->general->encryptData($value["del_id"])); ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="driver" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" >Driver<span id="viewformtitle"></span></h3>
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
                                    <form id="driver_form" method="post" action="" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
                                        <input id="del_id" type="hidden" name="del_id" value=""/>
                                        <input type="hidden" id="chnagepassval" name="chnagepass" value="0"/>
                                        <input type="hidden" id="mode" value="" name="mode" />
                                        <input type="hidden" id="checkp" name="checkp" value=""/>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input id="fullname" name="fullname" class="required form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input id="email" name="email" class="required form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>                                            
                                            <div id="passdiv">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input id="password" name="password" class="required form-control col-md-7 col-xs-12" type="password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input id="password" name="password" class="required form-control col-md-7 col-xs-12" type="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <input id="phone" name="phone" class="required form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                       
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Image<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">                                                    
                                                     <input type="file" id="ImageBrowse" hidden="hidden" name="image" size="30"/>
                                                </div>
                                            </div>
                                        </div> 
                                       
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                                                 <!-- <button type="button"  onclick="addDriver()">Save</button> -->
                                                 <input type="submit" class="btn btn-primary" name="upload" value="Save" />
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
$('#driver').modal({
    backdrop: 'static',    
    keyboard: false,  // to prevent closing with Esc button (if you want this too)
    show:false
});
$(document).ready(function (e) {
    /*$('#driver').on('hidden', function () {
            $("#fullname").val("");
            $("#email").val("");
            $("#password").val("");
            $("#phone").val("");
    });*/
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    $('#driver_form').on('submit',(function(e) {
        e.preventDefault();
        var fullname = $("#fullname").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var phone=$("#phone").val();
        if(fullname=="" || email=="" || password=="" || phone==""){
            return;
        }else{

            var formData = new FormData(this);
            var url='<?php echo $this->config->item("site_url")."add_driver"; ?>';
            $.ajax({
                type:'POST',
                url: url,
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    var res=JSON.parse(data);        
                    if(res.status==1){
                        $("#driver").modal("hide");
                        $("#fullname").val("");
                        $("#email").val("");
                        $("#password").val("");
                        $("#phone").val("");
                        //$("#status").val("");            
                        window.location = window.location.href;
                    }else{
                        alert(res.message);           
                    }
                },
                error: function(data){
                     var res=JSON.parse(data);   
                     alert(res.message); 
                }
            });
        }
    }));

    $("#ImageBrowse").on("change", function() {
        $("#imageUploadForm").submit();
    });
});

// Add Record
function addDriver() {
    // get values
    

    var fullname = $("#fullname").val();
    var del_id = $("#del_id").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var status = 1;    
    var url='<?php echo $this->config->item("site_url")."add_driver"; ?>';
    
    // Add record
    $.post(url, {        
        del_id: del_id,
        fullname: fullname,
        email: email,
        password: password,
        phone: phone,
        status: status,        
        
    }, function (data, status) {        
        var res=JSON.parse(data);        
        if(res.status==1){
            $("#driver").modal("hide");
            $("#fullname").val("");
            $("#email").val("");
            $("#password").val("");
            $("#phone").val("");
            //$("#status").val("");            
            window.location = window.location.href;
        }else{
            alert(res.message);           
        }
        

    });
}

function getDriver(del_id){

   var url='<?php echo $this->config->item("site_url")."get_driver"; ?>';
        
    $.post(url, {
        del_id: del_id,        
    }, function (data, status) {        
        var res=JSON.parse(data);        
        if(res.status==1){
            var driver=res.driver;
            //console.log("location"+location.fullname);
            $("#driver").modal("show");
            $("#fullname").val(driver.fullname);
            $("#email").val(driver.email);
            $("#password").val("");
            $("#phone").val(driver.phone);
            $("#status").val(driver.status);            
            $("#del_id").val(driver.del_id);        
            //window.location = window.location.href;
        }else{
            alert(res.message);           
        }
        //console.log("fdsf"+data);
        //window.location = window.location.href;

    });

}

$(document).ready(function() {
    $("#list").DataTable();
});
</script>



<?php
include APPPATH . '/front-modules/views/footer.php';
