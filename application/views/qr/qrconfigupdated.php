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
                                    <i class="material-icons">qr_code</i>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">QR Config</h3>
									
									   <form action="<?php echo base_url('QrController/qrConfigSave'); ?>" method="post" enctype="multipart/form-data">
									   
										<div class="row">
											<div class="col-md-6">
										<h4>QR Settings</h4>
												<div class="col-md-6">
													<div>
														<b>Client Logo</b>
													</div>
												</div>
												<div class="col-md-6">
													<div class="togglebutton">
														<label>
															<input type="checkbox" name="display_logo" <?php if($config->	logo_status){ echo "checked"; } ?>> 
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<div>
														<b>Table Name</b>
													</div>
												</div>
												<div class="col-md-6">
													<div class="togglebutton">
														<label>
															<input type="checkbox" name="display_table" <?php if($config->table_name_status){ echo "checked"; } ?>> 
														</label>
													</div>
												</div>
												<div class="col-md-6">
													<div>
														<b>Venue Name</b>
													</div>
												</div>
												<div class="col-md-6">
													<div class="togglebutton">
														<label>
															<input type="checkbox" name="display_venue" <?php if($config->venue_name_staus){ echo "checked"; } ?>> 
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-6">
										<h4>QR Design</h4>
												<div class="row">
													<div class="col-md-6">
														<div>
															<b>Display Image for Web page background</b>
														</div>
													</div>
													<div class="col-md-6">
														<div class="togglebutton">
															<label>
																<input type="checkbox" name="display_bg" <?php if($config->bg_status){ echo "checked"; } ?>> 
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														Home Page Background Image
													</div>
													<div class="col-md-6">
														<div class="fileinput fileinput-new text-center" data-provides="fileinput">
															<div class="fileinput-new thumbnail">
																<img src="<?php echo base_url().'/'.$config->bg_img; ?>" alt="...">
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"></div>
															<div>
																<span class="btn btn-rose btn-round btn-file">
																	<span class="fileinput-new">Select image</span>
																	<span class="fileinput-exists">Change</span>
																	<input type="file" name="bg_img">
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
                                        </div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label class="control-label">Welcome message</label>
												<input type="text" name="wlcm" class="form-control" value="<?php echo $config->welcome_msg; ?>">
												<span class="material-input"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
												<label class="control-label">Custom message</label>
												<input type="text" name="custom_msg" value="<?php echo $config->custom_msg; ?>" class="form-control">
												<span class="material-input"></span>
												</div>
											</div>
                                        </div>
                                        <div class="row">
                                        </div>
                                        <input type="submit" name="saveconfig" class="btn btn-rose pull-right" value="Save Config">
                                        <div class="clearfix"></div>
                                    </form>
                                
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
<?php $this->load->view('comman/footer'); ?>