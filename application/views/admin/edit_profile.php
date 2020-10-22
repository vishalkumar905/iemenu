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
					<?php 
						//print_r($profile); 
							?>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">perm_identity</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Edit Profile -
                                        <small class="category">Complete your profile</small>
                                    </h4>
                                    <form action="<?php echo base_url('dashboard/editProfile'); ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                        <input type="text" name="uname" value="<?php echo $profile[0]->name; ?>" class="form-control">
                                               </div>
                                                
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tagline</label>
                                                       <input type="text" name="tagline" value="<?php echo $profile[0]->tagline; ?>" class="form-control">
                                                </div>
                                                
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tax Name</label>
                                                       <input type="text" name="tax_name" value="<?php echo $profile[0]->tax_name ; ?>" class="form-control">
                                                </div>
                                                
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Registration Number</label>
                                                       <input type="text" name="rest_reg_no" value="<?php echo $profile[0]->rest_reg_no ; ?>" class="form-control">
                                                </div>
                                                
                                                
                                                
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <legend>Regular Image</legend>
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="<?php echo base_url().'/'.$profile[0]->userimg; ?>" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-rose btn-round btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="profileimg">
                                                        </span>
                                                    </div>
                                                </div>
											</div>
                                            <!--<div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email address</label>
                                                    <input type="email" name="uemail" value="<?php echo $profile[0]->email; ?>" class="form-control">
                                                </div>
                                            </div>-->
                                        </div>
                                        <!--<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Mobile No.</label>
                                                    <input type="text" name="mobile" value="<?php echo $profile[0]->phone; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" value="<?php echo $profile[0]->password; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>-->
                                        <!--<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Adress</label>
                                                    <textarea class="form-control" name="address" rows="5"></textarea>
                                                </div>
                                            </div>
											<div class="col-md-4 col-sm-4">
                                                <legend>Regular Image</legend>
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="<?php echo base_url().'/'.$profile[0]->userimg; ?>" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-rose btn-round btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="profileimg">
                                                        </span>
                                                    </div>
                                                </div>
											</div>
                                        </div>-->
                                        <input type="submit" name="updatepro" class="btn btn-rose pull-right" value="Update Profile">
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>