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
						<div class="col-md-6 col-md-offset-3">
							<div class="card">
								<form id="RegisterValidation" action="<?php echo base_url('dashboard/addUser'); ?>" method="post">
									<div class="card-header card-header-icon" data-background-color="rose">
										<i class="material-icons">person_add</i>
									</div>
									<div class="card-content">
										<h4 class="card-title">Register User</h4>
										<div class="form-group label-floating">
											<label class="control-label">
												Name
												<small>*</small>
											</label>
											<input class="form-control" name="name" type="text" required="true" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Email Address
												<small>*</small>
											</label>
											<input class="form-control" name="email" type="email" required="true" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Mobile
												<small>*</small>
											</label>
											<input class="form-control" name="phone" type="text" required="true" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Address
												<small>*</small>
											</label>
											<input class="form-control" name="address" type="text" required="true" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Password
												<small>*</small>
											</label>
											<input class="form-control" name="password" id="registerPassword" type="password" required="true" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Confirm Password
												<small>*</small>
											</label>
											<input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalTo="#registerPassword" />
										</div>
										<div class="form-group label-floating">
											<label class="control-label">
												Role
												<small>*</small>
											</label>
											<select class="form-control" name="role">
											<option selected> Select Option </option>
											<option value="2">Faculty</option>
											<option value="3">Staff</option>
											<option value="4">Student</option>
											<option value="5">Parent</option>
											</select>
										</div>
										<div class="category form-category">
											<small>*</small> Required fields</div>
										<div class="form-footer text-right">
										<input type="hidden" name="school_id" value="<?php echo $this->session->schoolid; ?>">
											<input type="submit" class="btn btn-rose btn-fill" name="reguser" value="Register">
										</div>
									</div>
								</form>
							</div>
						</div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>