<?php $this->load->view('comman/header'); ?>
<div id = 'mymodel' class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="background: #fff;">
    <div class="modal-head">
	<?php
        $uid = $this->session->userid;
        $dashboardModel = new dashboardModel();
        $resval = $dashboardModel->getUsersInfo($uid);
        ?>
      <img class="text-center" alt="logo" src="<?php echo base_url().$resval[0]->userimg; ?>" style="width: 100%;height: 50px;object-fit: contain;"/>
	</div>
    <div class="modal-content">
    </div>
  </div>
</div>
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
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="all_check form-control"></th>
                                                    <th>Si.No.</th>
                                                    <th>Table Name</th>
                                                    <th>Table Type</th>
                                                    <th>Generate QR</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" class="all_check form-control"></th>
                                                    <th>Si.No.</th>
                                                    <th>Table Name</th>
                                                    <th>Table Type</th>
                                                    <th>Generate QR</th>
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
                                                    <td><input type="checkbox" class="check form-control"></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $table->table_name; ?></td>
                                                    <td><?php if($table->table_type=='1') echo 'Restaurant'; elseif($table->table_type=='2') echo 'Room'; elseif($table->table_type=='3') echo 'Pool'; else echo 'Beach'; ?></td>
													<td><button type="button" class="btn btn-primary" onclick='generateQr(<?php echo $table->table_id; ?>)'>Generate QR</button></td>
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
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
<!-- Small modal -->
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
			
		});

        $('.card .material-datatables label').addClass('form-group');
    });
	
	function generateQr(qrid){
		$.ajax({
			url : '<?php echo base_url('QrController/singleQrGen') ?>',
			type: 'POST',
			dataType: 'json',
			data : { tableid:qrid },
			success: function (data) {
				var responseData = jQuery.parseJSON(JSON.stringify(data));
				//console.log(responseData.table_qr);
				var path = '<?php echo base_url('') ?>';
				var html = "<div class='text-center'><img src="+ path + responseData.table_qr +" width='200'></div><h2 class='text-center'>"+ responseData.table_name +"</h2>";
				$('.modal-content').html(html);
				$('#mymodel').modal('show');
			},
			error: function ( data ) {
				console.log('error');
			}
		});
	}
	
	
</script>