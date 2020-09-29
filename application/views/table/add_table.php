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
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">fact_check</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Add Table -
                                        <small class="category">Add the table specification</small>
                                    </h4>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group label-floating">
												<label class="control-label">Type</label>
												<select name="table_type" class="form-control" id="insert-type">
													<option value="1"> Individual </option>
													<option value="2"> Group </option>
												</select>
											</div>
										</div>
									</div>
									<form id="individual-table" action="<?php echo base_url('table/addTable'); ?>" method="post" >
                                        <input type="hidden" name="table_type" value="1" class="form-control">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <select name="table_loc" class="form-control">
														<option value="1"> Restaurant </option>
														<option value="2"> Room </option>
														<option value="3"> Pool </option>
														<option value="4"> Beach </option>
													</select>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group label-floating">
													<label class="control-label">Name</label>
													<input type="text" required name="table_name" value="" class="form-control">
												</div>
											</div>
										</div>
                                        <input type="submit" name="addSingleTable" class="btn btn-rose pull-right" value="Add Table">
                                        <div class="clearfix"></div>
                                    </form>
                                    <form id= "group-table" action="<?php echo base_url('table/addTable'); ?>" method="post" >
                                        <input type="hidden" name="table_type" value="2" class="form-control">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location</label>
                                                    <select name="table_loc" class="form-control">
														<option value="1"> Restaurant </option>
														<option value="2"> Room </option>
														<option value="3"> Pool </option>
														<option value="4"> Beach </option>
													</select>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Prefix</label>
													<input type="text" name="table_prefix" value="" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Sufix</label>
													<input type="text" name="table_suffix" value="" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Range from</label>
													<input type="number" required name="table_range_from" value="" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group label-floating">
													<label class="control-label">Range To</label>
													<input type="number" required name="table_range_to" value="" class="form-control">
												</div>
											</div>
										</div>
                                        <input type="submit" name="addGroupTable" class="btn btn-rose pull-right" value="Add Table">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>
	$(document).ready(function(){
		$('#group-table').hide();
		$('#insert-type').on('change', function(){
			if($(this).val()=='1'){$('#group-table').hide();$('#individual-table').show();}
			else{$('#individual-table').hide();$('#group-table').show();}
		});
	});
</script>