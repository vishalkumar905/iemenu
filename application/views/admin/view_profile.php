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
                        <div class="col-md-4 col-md-offset-4">
                            <div class="card card-profile">
                                <div class="card-avatar">
                                    <a href="user.html#pablo">
                                        <img class="img" src="<?php echo base_url().'/'.$profile[0]->userimg; ?>" style="width: 160px;height: 160px;object-fit: cover;"/>
                                    </a>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title"><span>Role : </span><span><?php if($profile[0]->role == "1"){ echo "ADMIN";}elseif($profile[0]->role == "2"){ echo "Faculty";}elseif($profile[0]->role == "3"){ echo "STAFF";}elseif($profile[0]->role == "4"){ echo "STUDENT";}elseif($profile[0]->role == "5"){ echo "PARENT";} ?></span></h4>
                                    <h5 class="category text-gray"><?php echo $profile[0]->name; ?></h5>
                                    <p class="description"><?php echo $profile[0]->email; ?></p>
                                    <div class="description">
									<p>
									<span>Phone : </span><span><?php echo $profile[0]->phone; ?></span>
									</p>
                                     </div>
									 <div class="description">
									<span>Address : </span><span><?php echo $profile[0]->address; ?></span>
                                     </div>
                                    <a href="<?php echo base_url('dashboard/editProfile'); ?>" class="btn btn-rose btn-round">Edit Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>