<div id="templateMcomment" class="hidden">
    <div>
        <div class="commented-block notelist">
            <p><span class="tagline">posted a comment</span></p>
            <div class="commented_statbox">
                <div class="porf_pic"> <img src="http://localhost/mehcrm/public/images/prof_person.png" alt=""> </div>
                <div class="Comment_Right_block">
                    <div class="Feed_content_title"> <a class="feed_owner" href="javascript:void(0)"></a><a href="javascript:void(0)" class="owner_comment"></a> <small class="delete_link_main"><a href="javascript:void(0)" class="deletelinkmain">Delete</a></small></div>
                    <span class="feed_date"></span>
                    <div class="feeds_content_main">
                        <div class="Feed_fromcontent"></div>
                        <div class="Feed_fromcontent">
                            <p></p>
                            <span></span> </div>
                    </div>
                    

                    <ul class="feed_comment_show">


                    </ul>
                    <div class="post-comment-block_bottom">
                        <div class="add-comment">
                            <textarea placeholder="Write a Comment" class="CommentClick"></textarea>
                        </div>
                        <div class="text_container hidden">
                            <div class="attachment_file"> 
<!--                                <input type='file' onchange="readURL(this);" />
                                <img  class="imgviewer" src="#" alt="your image" />-->
                                <?php // include APPPATH . '/front-modules/views/uploadfile.php'; ?>
                                <!--<a href="javascript:void(0)" class="attach_file">Attach File-->
                                    <!--<input type="file" class="input_none" placeholder="Attach File">-->
                                <!--</a>-->
                            </div>
                            <div class="submit-close-btn">
                                <input type="button" value="Submit" onclick="addScomment(this)" class="subcommsubmitbtn"/>
                            </div>
                            <a class="Close">Cancel</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="templateScomment" class="hidden">
    <div id="tmpscomm">
        <li class="feed_last">
            <div class="porf_pic_inner"> <img src="http://localhost/mehcrm/public/images/prof_person.png" alt=""> </div>
            <div class="Feed_content_title_main">
                <p><a class="feed_owner_new" href="javascript:void(0)"></a></p>
                <span class="feed_date_new"><small class="delete_link"><a href="javascript:void(0)" class="deletelink">Delete</a></small></span> </div>
        </li>
    </div>
</div>