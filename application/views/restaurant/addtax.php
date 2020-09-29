<?php $this->load->view('comman/header'); ?>
    <?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="POST" action="" class="form-horizontal" onsubmit="return checkPassword(this)">
                                    <div class="card-header card-header-text" data-background-color="rose">
                                        <h4 class="card-title">Add Tax</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Tax Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" class="form-control" placeholder="Tax Name" name="taxname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Tax</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="number" class="form-control" placeholder="Tax ( percentage )" name="tax">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>jQuery(document).ready(function(){
<?php if($this->session->flashdata('Email Error')) { ?>
    swal({
        text: "<?= $this->session->flashdata('Email Error') ?>",
        buttonsStyling: false,
        confirmButtonClass: "btn btn-danger",
        type: "error"
    });
<?php } ?>
});</script>