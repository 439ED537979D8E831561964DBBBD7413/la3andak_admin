<div class="col-md-3 left_col newclass" style="height: 100%;background: #2A3F54">
    <div class="left_col scroll-view" style="background: #2A3F54">
        <div  style="border: 0;height: auto;">
            <?php $image_url = $this->config->item("upload_url"); ?>
            <a href="javascript:void(0)" class="site_title">
                <img src="<?php echo $image_url; ?>/images/admin_logo.png" height="40px;" style="margin-left:7%;"></a>
        </div>
        <div class="clearfix"></div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu custom_bg">
            <div class="menu_section" style="background: #2A3F54">
                <!-- <h3>Navigation</h3> -->
                <ul class="nav side-menu">
                    <?php
                    $db = $this->load->database();
                    $acc = $this->db->query("select * from menu where status=1 and submenu_id = 0");
                    $result = $acc->result_array();
                    ?>
                    <?php
                    for ($i = 0; $i < count($result); $i++) {
                        ?>
                        <?php if ($i == 0) {
                            ?>
                            <li><a href="<?php echo $this->config->item("site_url") ?>dashboard"><i class="fa fa-home"></i><font style="font-size: 15px;"> Dashboard </font></a></li>
                        <?php } ?>
                        <li>
                            <a><i class="<?php echo $result[$i]['icon']; ?>"></i><font size="3"> <?php echo $result[$i]['menu_name'] ?> </font><span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <?php
                                $new = $this->db->query("select * from menu where submenu_id='" . $result[$i]['menu_id'] . "' and status=1 ORDER BY sortby");
                                $result1 = $new->result_array();
                                for ($j = 0; $j < count($result1); $j++) {
                                    ?>
                                    <li><a href="<?php echo $this->config->item("site_url") . $result1[$j]['menu_url'] ?>"><?php echo $result1[$j]['menu_name'] ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>