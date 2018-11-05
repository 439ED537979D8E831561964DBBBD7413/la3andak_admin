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
                <a id="viewformlink" href="#payment" data-toggle="modal" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add New Location</a>          
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
                        <th>Holder name</th>
                        <th>Card No</th>
                        <th>CVV</th>                        
                        <th>Exp Year</th>                        
                        <th>Action</th>                              
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($payments)){

                        foreach ($payments as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['holder_name']; ?></td>                            
                                <td><?php echo $value['card_no']; ?></td>
                                <td><?php echo $value['cvv']; ?></td>                            
                                <td><?php echo $value['exp_year']; ?> </td>                                
                                <td>
                                    <a href="javascript:void(0)" onclick="getPayment('<?php echo urlencode($this->general->encryptData($value["pay_id"])) ; ?>');" ><i class="fa fa-pencil"></i></a>
                                    <a class="Delete" href="<?php echo $this->config->item("site_url")."delete_payment?cust_id=".urlencode($this->general->encryptData($value["cust_id"]))."&pay_id=".urlencode($this->general->encryptData($value["pay_id"])) ; ?>" style="margin-left: 5px"><i class="fa fa-trash-o"></i></a>
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
<div class="modal fade" id="payment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" > Payment Method <span id="viewformtitle"></span></h3>
            </div>            
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <div class="row" id="viewformiframe">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">                                
                                <div class="x_content">
                                    <br/>
                                    <form id="payment_form" method="post" action="" class="form-horizontal form-label-left input_mask">
                                        <input id="cust_id" type="hidden" name="cust_id" value="<?php echo $customer['cust_id']; ?>"/>
                                        <input id="pay_id" type="hidden" name="pay_id" value=""/>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Holder Name<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="holder_name" name="holder_name" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Card No<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="card_no" name="card_no" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">CVV<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="cvv" name="cvv" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Expire Year<span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                                    <input required="required" id="exp_year" name="exp_year" class="form-control col-md-7 col-xs-12" type="text" value="">
                                                </div>
                                            </div>
                                            
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">                                           
                                                <button type="button" class="btn btn-primary" onclick="addPayment()">Save</button>
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
$('#payment').modal({
    backdrop: 'static',    
    keyboard: false,  // to prevent closing with Esc button (if you want this too)
    show:false
});
// Add Record
function addPayment() {
    // get values
    var cust_id = $("#cust_id").val();
    var pay_id = $("#pay_id").val();
    var holder_name = $("#holder_name").val();

    var card_no = $("#card_no").val();
    var cvv = $("#cvv").val();
    var exp_year = $("#exp_year").val();

    var url='<?php echo $this->config->item("site_url")."payment_add?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        cust_id: cust_id,
        pay_id: pay_id,
        holder_name: holder_name,
        card_no: card_no,
        cvv: cvv,
        exp_year: exp_year,        
    }, function (data, status) {
        //alert("status="+status);
        // close the popup
        var res=JSON.parse(data);
        //console.log("fdsf"+res);
        if(res.status==1){
            $("#payment").modal("hide");
            $("#holder_name").val("");
            $("#card_no").val("");
            $("#cvv").val("");
            $("#exp_year").val("");            
            window.location = window.location.href;
        }else{
            alert(res.message);           
        }
        //console.log("fdsf"+data);
        //window.location = window.location.href;

    });
}

function getPayment(pay_id){
    
   var url='<?php echo $this->config->item("site_url")."get_payment?cust_id=".urlencode($this->general->encryptData($customer["cust_id"])) ?>';
    
    // Add record
    $.post(url, {
        pay_id: pay_id,        
    }, function (data, status) {
        
        var res=JSON.parse(data);        
        if(res.status==1){
            var payment=res.payment;
            //console.log("location"+location.fullname);
            $("#payment").modal("show");
            $("#holder_name").val(payment.holder_name);
            $("#card_no").val(payment.card_no);
            $("#cvv").val(payment.cvv);
            $("#exp_year").val(payment.exp_year);            
            $("#pay_id").val(payment.pay_id);        
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
