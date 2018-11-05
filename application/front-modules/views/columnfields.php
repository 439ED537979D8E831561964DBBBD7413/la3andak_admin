<?php if ($import_export == "Yes") { ?>

    <div class="btn-group btn-group-sm">
        <a href="<?php echo $this->config->item('site_url') . 'imports?cs='; ?>" class="btn btn-default importbtn" data-toggle="tooltip" data-placement="bottom" title="Import Data" data-original-title="Import Data"><i class="fa fa-fw fa-download"></i> Import</a>
        <div class="btn-group btn-group-sm">
            <a href="javascript:void(0)" class="btn btn-default dropdown-toggle exportdata" data-toggle="dropdown" data-toggle="tooltip" data-placement="bottom" title="Export Data" data-original-title="Export Data"><i class="fa fa-fw fa-upload"></i> Export</a>

            <a href="javascript:void(0)" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </a>

            <ul class="dropdown-menu">
                <li><a href="<?php echo $this->config->item('site_url'); ?>exportFile?t=csv&c=" class="col-md-12 liexport"><i class="fa fa-list"></i> CSV</a>
                </li>
                <li><a href="<?php echo $this->config->item('site_url'); ?>exportPDF?t=pdf&c=" class="col-md-12 liexport"><i class="fa fa-file-text"></i> PDF</a>
                </li>
                <li class="divider"></li>
            </ul>
        </div>

    </div>
<?php } ?>
<div class="btn-group btn-group-sm selectcolumn">
    <select id="columnsname" class="btn btn-default columnsname showcolumngrid" multiple="">
        <option value="none" >--None--</option>
    </select>
</div>
<div class="btn-group btn-group-sm">
    <a href="javascript:$('#refreshbtn').trigger('click');void(0);" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Show All" id="showallcol"><i class="fa fa-fw fa-refresh"></i>Reset</a>
</div>