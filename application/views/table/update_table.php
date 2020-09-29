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
                                    <h4 class="card-title">Update Table -
                                        <small class="category">Update the table specification</small>
                                    </h4>
                                    <form action="<?php echo base_url('table/updateTable/').$table->table_id; ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Table Name</label>
                                                    <input type="text" name="table_name" value="<?php echo $table->table_name; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Table Type</label>
													<select name="table_type" class="form-control">
														<option value="1" <?php if($table->table_type==1) echo 'selected' ?>> Restaurant </option>
														<option value="2" <?php if($table->table_type==2) echo 'selected' ?>> Room </option>
														<option value="3" <?php if($table->table_type==3) echo 'selected' ?>> Pool </option>
														<option value="4" <?php if($table->table_type==4) echo 'selected' ?>> Beach </option>
													</select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="updateTable" class="btn btn-rose pull-right" value="Update Table">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>