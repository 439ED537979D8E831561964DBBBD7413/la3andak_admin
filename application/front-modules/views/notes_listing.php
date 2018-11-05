<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="post-comment-block">
                <div class="add-comment">
                    <textarea id="addcommenttext" placeholder="Add your Comment" class="CommentClick"></textarea>
                </div>
                <div class="text_container hidden text-right">
                    <div class="attachment_file"> 
                         <!--<input id="input-24" type="file" multiple="true">-->
                        <div id="deleteFileUpload">Attach files</div>
                    </div>
                    <div class="submit-close-btn">
                        <input id="postcommentbtn" type="button" value="Post" onclick="addMcomment(this)"/>
                    </div>
                    <a class="Close">Cancel</a> </div>
            </div>
            <div id="allcommnets"></div>
            <input type="hidden" id="hiddentrigger" value="">
            <div id="hideupload" class="hidden"></div>
        </div>
    </div>
</div>