<?php include APPPATH . '/front-modules/views/top.php'; ?>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/customer.js"></script>
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/bootstrap.min.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/lib/google-code-prettify/prettify.css" />
<link href="<?php echo $this->config->item('js_url'); ?>/multiselectjqui/css/style.css" />
<link href="<?php echo base_url();?>js/datetimeboot/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url();?>js/datetimeboot/moment-with-locales.js"></script>
<script src="<?php echo base_url();?>js/datetimeboot/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$(function () {
    $('#events_date').datetimepicker({ format: 'YYYY-MM-DD'});
});


$(function () {
    $('#events_date1').datetimepicker({ format: 'YYYY-MM-DD'});
});
</script>
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
           <header class="panel-heading">
                <h2>Revenue Report</h2>
            </header>
        </div>

    </div>
    <div class="x_panel">
        <div class="x_content">
                  <form id="customer_form" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo $this->config->item("site_url") . "payment/payment_report_action" ?>">
                    <div class="col-md-6">
                       <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Daily Report<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 custom-select">
                                <input type="radio" name="range" value="weekly"> <label class="control-label">Weekly</label>
                                <input type="radio" name="range" value="monthly" style="margin-left:15px"> <label class="control-label">Monthly</label>
                                <input type="radio" name="range" value="quaterly" style="margin-left:15px"> <label class="control-label">Quaterly</label>
                            </div>
                        </div>


                         <div class="form-group" id="date_pickers">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Range<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="width:35%">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" placeholder="Date Range From" name="events_date" id="events_date" class="form-control" value="" style="margin-top:-13px; ">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 custom-select" style="margin-top:-13px;width: 35%">
                                <div class="input-icon right">
                                    <i class="fa"></i>
                                    <input type="text" placeholder="Date Range To" name="events_date1" id="events_date1" class="form-control" value="">
                                </div>
                            </div>
                        </div>





                    <div class="col-md-6">
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                            <input type="submit" class="btn btn-success">
                            <a href="javascript:void(0)" class="btn btn-primary cancelbtn">Cancel</a>
                        </div>
                    </div></div>
                </form>

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
