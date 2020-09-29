<?php $this->load->view('comman/header'); ?>
    <?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="POST" action="" class="form-horizontal">
                                    <div class="card-header card-header-text" data-background-color="rose">
                                        <h4 class="card-title">Update Restaurant</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" class="form-control" placeholder="Capital O" name="name" 
                                                    value="<?php if(!empty($restaurant) && isset($restaurant[0]->name)) { echo $restaurant[0]->name; }?>"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="email" class="form-control" placeholder="xyz@gmail.com" name="email" 
                                                    value="<?php if(!empty($restaurant) && isset($restaurant[0]->email)) { echo $restaurant[0]->email; }?>"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">New Password</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" class="form-control" placeholder="New Password" name="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-2 col-sm-2 label-on-left">Online Pay</label>
                                            <div class="col-md-10 col-sm-10">
                                                <div class="form-group label-floating togglebutton">
                                                    <label>
                                                        <input type="checkbox" name="online_pay" <?php if($restaurant[0]->online_pay_status == "on"){ echo "checked"; } ?> />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" placeholder="" name="rest_id" 
                                        value="<?php if(!empty($restaurant) && isset($restaurant[0]->rest_id)) { echo $restaurant[0]->rest_id; }?>"
                                        >
                                        <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>jQuery(document).ready(function() {
<?php if($this->session->flashdata('Email Error')) { ?>
    swal({
        text: "<?= $this->session->flashdata('Email Error') ?>",
        buttonsStyling: false,
        confirmButtonClass: "btn btn-danger",
        type: "error"
    });
<?php } ?>
});</script>