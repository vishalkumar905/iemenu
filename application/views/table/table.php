<?php $this->load->view('comman/header'); ?>
	<?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
				<div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
						<?php if($this->session->flashdata('SUCCESSMSG')) { ?>
							<div role="alert" class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
									<?php echo $this->session->flashdata('SUCCESSMSG')?>
							</div>
						<?php } ?>
						<?php if($this->session->flashdata('FailMSG')) { ?>
							<div role="alert" class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
									<?php echo $this->session->flashdata('FailMSG')?>
							</div>
						<?php } ?>
						</div>
				</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">fact_check</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Tables</h4>
                                    
                                    
                                    <div class="toolbar">
                                         
                                        <input type="button" name="DeleteTable" class="btn btn-danger pull-right" value="Delete" style="display:none;">
                                        <input type="button" name="multiQrGen" class="btn btn-primary pull-right" value="Generate QR" style="display:none;">
                                        <!--<input type="button" name="SelfOrder" class="btn btn-success pull-right" value="Self Order" style="display:none;">-->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="all_check form-control"></th>
                                                    <th>Si.No.</th>
                                                    <th>Table Name</th>
                                                    <th>Table Type</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" class="all_check form-control"></th>
                                                    <th>Si.No.</th>
                                                    <th>Table Name</th>
                                                    <th>Table Type</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
											<?php 
											if(!empty($tables)){
											$i=0;
											foreach($tables as $table){
												$i++;
											?>
                                                <tr>
                                                    <td><input type="checkbox" name="multiDel[]" class="checkBoxClass form-control" value="<?php echo $table->table_id; ?>"></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $table->table_name; ?></td>
                                                    <td><?php if($table->table_type=='1') echo 'Restaurant'; elseif($table->table_type=='2') echo 'Room'; elseif($table->table_type=='3') echo 'Pool'; else echo 'Beach'; ?></td>
                                                    <td class="text-right">
                                                        <!--a href="datatables.net.html#" class="btn btn-simple btn-info btn-icon like"><i class="material-icons">favorite</i></a-->
                                                        <a href="<?php echo base_url('table/updateTable/').$table->table_id; ?>" title="Update" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">create</i></a>
                                                        <a href="javascript:void(0);" data-id="<?php echo $table->table_id; ?>" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
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
                            <!--  end card  -->
                            <button style="display:none;" class="btn btn-raised btn-round btn-info qr-modal" data-toggle="modal" data-target="#noticeModal">Notice modal</button>
							<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-notice">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
											<h5 class="modal-title" id="myModalLabel">QR Code</h5>
										</div>
										<div class="modal-body">
											<div class="instruction">
												<div class="row" id="printQr">
												</div>
											</div>
										</div>
										<div class="modal-footer text-right">
											<button type="button" id="printAction" class="btn btn-info btn-round" data-dismiss="modal">Print</button>
											<button type="button" class="btn btn-danger btn-round" class="close" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <style>
            .qr-img-conf {
                text-align: center;
                padding: 15px 0;
                border: 2px solid #cbb252;
                border-radius: 5px;
                margin: 15px 0;
            }
            .qr-img-conf img.qr-logo {
                width: 100px;
            }
            </style>
<?php $this->load->view('comman/footer'); ?>
<script type="text/javascript">
    $(document).ready(function() {

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


        var table = $('#datatables').DataTable();

        // Edit record
        /*table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });*/

        // Delete a record
        table.on('click', '.remove', function(e) {
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				var id = $(this).attr("data-id");
				$.ajax({
				   url: '<?php echo base_url('table/deleteTable/') ?>'+id,
				   type: 'DELETE',
				   error: function() {
					  alert('Something is wrong');
				   },
				   success: function(data) { 
					swal("Record has been deleted!", {
					  icon: "success",
					})
					.then((value) => {
					  location.reload();
					});
				   }
				});
			  } 
			});
        });

        $('.all_check').on('click', function(){
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            if($(".checkBoxClass:checked").length > 0) 
            {
                $('input[name="multiQrGen"]').show();
                $('input[name="DeleteTable"]').show();
                $('input[name="SelfOrder"]').show();
                
            }
            else{
                $('input[name="multiQrGen"]').hide();
                $('input[name="DeleteTable"]').hide();
                $('input[name="SelfOrder"]').hide();
            }
		});
		$('.checkBoxClass').on('click', function(){
            if($(".checkBoxClass:checked").length > 0) 
            {
                $('input[name="multiQrGen"]').show();
                $('input[name="DeleteTable"]').show();
                $('input[name="SelfOrder"]').show();
            }
            else{
                $('input[name="multiQrGen"]').hide();
                $('input[name="DeleteTable"]').hide();
                $('input[name="SelfOrder"]').hide();
            }
		});
		
		$('input[name="DeleteTable"]').on('click', function(){
		    swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				$.ajax({
				   url: '<?php echo base_url('table/multiDeleteTable/') ?>',
				   data: $('.checkBoxClass:checked').serialize(),
				   type: 'POST',
				   error: function() {
					  alert('Something is wrong');
				   },
				   success: function(data) { 
					swal("Record(s) has been deleted!", {
					  icon: "success",
					})
					.then((value) => {
					  location.reload();
					});
				   }
				});
			  } 
			});
		});
		$('input[name="multiQrGen"]').on('click', function(){
			$.ajax({
			   url: '<?php echo base_url('QrController/multiQrGen/') ?>',
			   data: $('.checkBoxClass:checked').serialize(),
			   type: 'POST',
			   error: function() {
				  alert('Something is wrong');
			   },
			   success: function(data) {
			    $('.qr-modal').trigger('click');
			   }
			});
		});
		
// 		$('input[name="SelfOrder"]').on('click', function(){
// 			$.ajax({
// 			   url: '<?php echo base_url('QrController/selfOrder/') ?>',
// 			   data: $('.checkBoxClass:checked').serialize(),
// 			   type: 'POST',
// 			   error: function() {
// 				  alert('Something is wrong');
// 			   },
// 			   success: function(data) {
// 			    $('.qr-modal').trigger('click');
			    
			    
			    
			    
// 			   }
// 			});
// 		});
		
		$('.qr-modal').on('click', function(){
			$.ajax({
			   url: '<?php echo base_url('QrController/printMultiQr/') ?>',
			   data: $('.checkBoxClass:checked').serialize(),
			   type: 'POST',
			   error: function() {
				  alert('Something is wrong');
			   },
			   success: function(data) { 
				$('#printQr').html(data);
			   }
			});
		});
		
		$('#printAction').on('click', function(){
			$.ajax({
			   url: '<?php echo base_url('QrController/save_pdf/') ?>',
			   data: $('.checkBoxClass:checked').serialize(),
			   type: 'POST',
			   error: function() {
				  alert('Something is wrong');
			   },
			   success: function(data) { 
			    var pdf_path = '<?php echo base_url(); ?>'+data;
			    window.open(pdf_path, "_blank"); 
				//location.href = '<?php echo base_url(); ?>'+data;
			   }
			});
		});

        $('.card .material-datatables label').addClass('form-group');
    });
</script>