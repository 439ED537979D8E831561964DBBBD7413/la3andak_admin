<?php include APPPATH . '/front-modules/views/top.php'; ?>

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



        <div class="col-md-6"><h2>Consumer List</h2></div>

        <div class="col-md-6">



            <a style="float: right; background-color:#2A3f54;" class="btn btn-primary" href="<?php echo $this->config->item("site_url") . 'consumer/consumer_add'; ?>">Add New Consumer</a>

        </div>



    </div>

    <div class="x_panel">

        <div class="x_content">

            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th>User ID</th>

                        <th>Name</th>

                        <th>Contact No</th>

                        <th>Email</th>

                        <th>User Type</th>

                        <th>Address</th>

                        <th>Join Date</th>

                        <th>Status</th>

                    <!-- <th>Vollate</th> -->

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($consumer as $key => $row) { ?>

                        <tr class="">

                            <td><?php echo $row['user_id']; ?></td>

                            <td><?php echo $row['ufname'] . " " . $row['ulname']; ?></td>

                            <td><?php
                                $rest = substr($row['ucontactno'], 0, 4);
                                $rest1 = substr($row['ucontactno'], 4, 2);
                                $rest2 = substr($row['ucontactno'], 6, 3);
                                $rest3 = substr($row['ucontactno'], 9, 4);
                                echo $rest . " " . $rest1 . " " . $rest2 . " " . $rest3;
                                ?></td>

                            <td><?php echo $row['uemail']; ?></td>
                            <td>
                                <?php
                                if ($row['vmod'] == 3) {
                                    echo "Web";
                                } else if ($row['vmod'] == 1) {
                                    echo "Android";
                                } else {
                                    echo "iOS";
                                }
                                ?>
                            </td>

                            <?php echo $row['vmod'] == "1" ? "Android" : "iOS"; ?></td>
                            <td><?php
                                $id = $row['user_id'];

                                $address = $this->db->query("select * from addressbook where consumer_id = $id");

                                $result_array = $address->result_array();



                                if ($result_array) {

                                    echo $result_array[0]['address_type'] . " " . $result_array[0]['address_line'] . "<br>" . $result_array[0]['address_line'] . "<br>" . $result_array[0]['area'] . " " . $result_array[0]['city'];
                                } else {

                                    echo "No address Added till now";
                                }
                                ?></td>

                            <td><?php echo date('D, j M Y g:i A', strtotime($row['timestamp'])); ?></td>



                            <td><?php if ($row['ustatus'] == 1) { ?>

                                    <span class="buttonbg" style="background: green">Active</span>

                                <?php } else { ?>

                                    <span class="buttonbg" style="background: red">Inactive</span>

                                <?php } ?></td>



                                                                   <!--  <td><span class="tools pull-center"><a href="consumer_add_vollate.php?uid=<?php echo $row['user_id']; ?>"  ><span><?php echo round($row['vollate'], 2); ?> INR</span></a></span> </td> -->

                            <td>

                                <a href="<?php echo $this->config->item("site_url") . "consumer_edit?user_id=" . urlencode($this->general->encryptData($row["user_id"])); ?>" title="Edit Consumer"><i class="fa fa-pencil"></i></a>



                                <a class="Delete" href="<?php echo $this->config->item("site_url") . "delete_consumer?user_id=" . urlencode($this->general->encryptData($row["user_id"])); ?>" style="margin-left: 5px" title="Delete Consumer"><i class="fa fa-trash-o"></i></a>



                                <a href="<?php echo $this->config->item("site_url") . "address_list?user_id=" . urlencode($this->general->encryptData($row["user_id"])); ?>" style="margin-left: 5px" title="Address List"><i class="fa fa-eye"></i></a>

                                                                    <!-- <a class="view" href="<?php echo $this->config->item("site_url") . "view_order?user_id=" . urlencode($this->general->encryptData($value["user_id"])); ?>" style="margin-left: 5px"><i class="fa fa-eye"></i></a> -->

                            </td>

                        </tr>

                    <?php }
                    ?>



                </tbody>

            </table>



        </div>

    </div>

</div>



<script>

    $(document).ready(function () {

        $("#list").DataTable({

            "order": [[0, "desc"]]

        }

        );



    });



</script>









<?php
include APPPATH . '/front-modules/views/footer.php';

