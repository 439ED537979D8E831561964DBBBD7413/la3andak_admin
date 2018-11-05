<link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>select2.min.css"/>
<script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>select2.full.js"></script>

<div class="form-group">
    <label class="control-label col-md-2 col-sm-3 col-xs-12">Select User From </label>
    <div class="col-md-9 col-sm-9 col-xs-12" id="">
        <select class="select2_multiple form-control" name="user[]" multiple="multiple">
            <!--<option>select seller</option>-->
            <?php
            foreach ($user as $key => $value) {
                echo '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".select2_multiple").select2({
            placeholder: "select user",
            allowClear: true
        });
        
    });
</script>