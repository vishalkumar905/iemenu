<?php $this->load->view('comman/header'); ?>
    <?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">List Restaurant</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Manager Password</th>
                                                    <th>Status</th>
                                                    <th class="disabled-sorting text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Manager Password</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $i=0; if(!empty($restaurants)){
											foreach($restaurants as $restaurant){
											?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><?php echo $restaurant->name; ?></td>
                                                    <td><?php echo $restaurant->email; ?></td>
                                                    <td><?php echo $restaurant->manager_password; ?></td>
                                                    <td><?php if($restaurant->varified=='1') echo 'Verified'; else echo 'Not Verified'; ?></td>
                                                    <td class="text-right">
                                                        <!--a href="datatables.net.html#" class="btn btn-simple btn-info btn-icon like"><i class="material-icons">favorite</i></a-->
                                                        <a href="update/<?php echo $restaurant->rest_id; ?>" title="Update" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">create</i></a>
                                                        <a href="delete/<?php echo $restaurant->rest_id; ?>" data-id="<?php echo $restaurant->rest_id; ?>" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
                                                    </td>
                                                </tr>
											<?php } }else{
												echo "NO Records Avilable Now";
											} ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>
    jQuery(document).ready(function() {
        <?php if($this->session->flashdata('Success MSG')) { ?>
            swal({
                text: "<?= $this->session->flashdata('Success MSG') ?>",
                confirmButtonClass: "btn btn-success",
                type: "success"
            });
        <?php } ?>
        
        <?php if($this->session->flashdata('Fail MSG')) { ?>
            swal({
                text: "<?= $this->session->flashdata('Fail MSG') ?>",
                confirmButtonClass: "btn btn-danger",
                type: "error"
            });
        <?php } ?>


        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();

        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        // Delete a record
        /*var table = $('#datatables').DataTable();
        table.on('click', '.remove', function(e) {
			var id = $(this).attr("data-id");
			if(confirm('Are you sure to remove this record ?'))
			{
				$.ajax({
				   url: 'delete/'+id,
				   type: 'DELETE',
				   error: function() {
					  alert('Something is wrong');
				   },
				   success: function(data) { 
					location.reload();
				   }
				});
			}
        });*/


        $('.card .material-datatables label').addClass('form-group');
    });
</script>