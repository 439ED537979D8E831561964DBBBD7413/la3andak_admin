<div class="col-sm-3 col-md-2 resp_mer_top">
<!--    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle bg_green" data-toggle="dropdown"> Mail <span class="caret"></span> </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#">Mail</a></li>
            <li><a href="#">Contacts</a></li>
            <li><a href="#">Tasks</a></li>
        </ul>
    </div>-->
    <div class="">
        <a href="<?php echo $this->config->item('site_url'); ?>compose_mail" class="btn btn-danger btn-sm btn-block bg_orange" role="button"><i class="glyphicon glyphicon-edit"></i> Compose</a>
        <hr>
        <ul class="nav nav-pills nav-stacked">
            <li <?php echo $inbox; ?>><a href="<?php echo $this->config->item('site_url'); ?>messages"><span class="badge pull-right" id="countunread"><?php echo ($count > 0) ? $count : ''; ?></span> Inbox </a> </li>
            <li <?php echo $starred; ?>><a href="<?php echo $this->config->item('site_url') ?>messages_starred">Starred</a></li>
<!--            <li <?php echo $important; ?>><a href="<?php echo $this->config->item('site_url') ?>messages_important">Important</a></li>            -->
            <li <?php echo $sent; ?>><a href="<?php echo $this->config->item('site_url') ?>messages_sent">Sent Mail</a></li>
            <li <?php echo $drafts; ?>><a href="<?php echo $this->config->item('site_url'); ?>messages_draft"><span class="badge pull-right"><?php echo ($countdraft > 0) ? $countdraft : ''; ?></span> Drafts </a> </li>            
        </ul>
    </div>
</div>