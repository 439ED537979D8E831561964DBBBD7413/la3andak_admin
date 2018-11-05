</div>
</div>
<?php include APPPATH . '/front-modules/views/footer.php'; //footer file  ?>

</div>
</div>
<!-- // Section END -->
<a id="viewformlink" href="#viewform" data-toggle="modal" class="btn btn-primary" style="display: none"><i class="fa fa-fw fa-plus"></i></a>
<!-- Modal -->
<div class="modal fade" id="viewform">
    <div class="modal-dialog" style="height: auto;width: 75%;">
        <div class="modal-content" >
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" id="formClose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" ><span id="viewformtitle"></span></h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <div id="viewformiframe" style="width: 100%;"></div>
                </div>
            </div>

            <!-- // Modal body END -->
        </div> 
    </div>
</div>

<a id="viewboxlink" href="#viewbox" data-toggle="modal" class="btn btn-primary popupelement" style="display: none"><i class="fa fa-fw fa-user"></i> </a>
<!-- Modal -->
<div class="modal fade" id="viewbox">
    <div class="modal-dialog" id="modaltooldiv" style="height: auto;width: 75%;">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="widgetClose">&times;</button>
                <h3 class="modal-title" ><span id="viewboxtitle"></span></h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <iframe id="viewboxiframe" src="" width="100%" height="500px"></iframe> 
                </div>
                <div id="spamcheckdiv"></div>
            </div>

            <!-- // Modal body END -->
        </div> 
    </div>
</div>
<a id="alertboxlink" href="#alertboxdiv" data-toggle="modal" class="btn btn-primary popupelement" style="display: none"><i class="fa fa-fw fa-user"></i> </a>

<div class="modal fade" id="alertboxdiv">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" ><span id="viewboxtitle"></span>Confirm Delete</h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <h4>Are you sure you want to delete this?</h4>
                </div>
            </div>            
            <!-- // Modal body END -->
            <div class="modal-bottom">
                <a href="javascript:void(0)" class="btn btn-default col-md-offset-5" id="cancelbtn" aria-hidden="true" data-dismiss="modal">Cancel</a>
                <a id="confirmbtn" href="javascript:void(0)" class="btn btn-primary">Confirm</a>
            </div>

        </div>
    </div>
</div>
<a id="confirmbtnlink" href="#confirmboxdiv" data-toggle="modal" class="btn btn-primary popupelement" style="display: none"><i class="fa fa-fw fa-user"></i> </a>
<!-- Modal -->
<div class="modal fade" id="confirmboxdiv">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" ><span id="viewboxtitle"></span>Confirm</h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerLR">
                    <h4><span id="confirmmsg">Are you sure you want to delete this?</span></h4>
                </div>
            </div>            
            <!-- // Modal body END -->
            <div class="modal-bottom">
                <a href="javascript:void(0)" class="btn btn-default col-md-offset-4" id="cancelbtn4all" aria-hidden="true" data-dismiss="modal">Cancel</a>
                <a id="confirmbtn4all" href="javascript:void(0)" class="btn btn-primary">Confirm</a>
            </div>

        </div>
    </div>
</div>

<div class="Content-main-new">
    <div class="panel_new">
        <h4><strong>TODO</strong></h4>
        <ul class="product-list" id="todolist">
        </ul>
    </div>
    <div class="panel-tab_new" data-toggle="tooltip" data-placement="left" title="Todo"> <i class="fa fa-clock-o fa-2x"></i> </div>
</div>
<link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>dev_style.css"/>
</body>
</html>