<?php include APPPATH . '/front-modules/views/top.php'; ?>
<style type="text/css">
	div#list_wrapper {
    margin-top: 3%;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-12">
           <header class="panel-heading">
                <h2>Feedback List</h2>
            </header>
        </div>
        <div class="x_panel">
            <div class="x_content">
            <table id="list"  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr >
                        <th>ID</th>
						<th>Name</th>
						<th>Contact Number</th>
						<th>Email</th>
						<th>Query Type</th>
						<th>Message</th>
						<th>Date added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedback as $key => $value) { ?>
                        <tr class="">
                            <td><?php echo $value['contact_id']; ?></td>
                             <td><?php echo $value['full_name']; ?></td>
                              <td><?php
                                    $rest  = substr($value['contact_no'],0,4);
                                    $rest1 = substr($value['contact_no'],4,2);
                                    $rest2 = substr($value['contact_no'],6,3);
                                    $rest3 = substr($value['contact_no'],9,4);
                                    echo $rest." ".$rest1." ".$rest2." ".$rest3;
                                     //echo $value['contact_no']; ?></td>
                               <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['subject_title']; ?></td>
                                <td><?php echo $value['message']; ?></td>
                                <td><?php echo date('D, j M Y g:i A',strtotime($value['timestamp']));
                                // echo $value['date_added']; ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
            </div>
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