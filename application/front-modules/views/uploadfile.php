
<form id="newdata" action="<?php echo $this->config->item('site_url')?>public/" method="POST" enctype="multipart/form-data">
         <!--Redirect browsers with JavaScript disabled to the origin page--> 
<!--        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>-->
         <!--The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload--> 
        <div class="row fileupload-buttonbar">
            <div class="col-lg-8">
                 <!--The fileinput-button span is used to style the file input field as button--> 
                <span class="btn fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                 <!--The global file processing state--> 
                <span class="fileupload-process"></span>
            </div>
             <!--The global progress state--> 
            <div class="col-lg-4 fileupload-progress fade">
                 <!--The global progress bar--> 
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                 <!--The extended global progress state--> 
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
         <!--The table listing the files available for upload/download--> 
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>