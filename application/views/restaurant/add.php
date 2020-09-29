<?php $this->load->view('comman/header'); ?>
    <?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <script> 
                                    function checkPassword(form) { 
                                        password1 = form.password.value; 
                                        password2 = form.confirmpassword.value; 
                          
                                        // If password not entered 
                                        if (password1 == '') {
                                            alert ("Please enter Password"); 
                                        }
                                              
                                        // If confirm password not entered 
                                        else if (password2 == '') {
                                            alert ("Please enter confirm password"); 
                                        }
                                              
                                        // If Not same return False.     
                                        else if (password1 != password2) { 
                                            swal({
                                                text: "\nPassword did not match: Please try again...",
                                                buttonsStyling: false,
                                                confirmButtonClass: "btn btn-danger",
                                                type: "error"
                                            });
                                            return false; 
                                        } 
                          
                                        // If same return True. 
                                        else{ 
                                            return true; 
                                        } 
                                    } 
                                    
                                </script>
                                <form method="POST" action="" class="form-horizontal" onsubmit="return checkPassword(this)">
                                    <div class="card-header card-header-text" data-background-color="rose">
                                        <h4 class="card-title">Add Restaurant</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="text" class="form-control" placeholder="Capital O" name="name">
                                                    <span class="help-block">A block of help text that breaks onto a new line.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="email" class="form-control" placeholder="xyz@gmail.com" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Password</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" class="form-control" placeholder="" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 label-on-left">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <input type="password" class="form-control" placeholder="" name="confirmpassword">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="publish" class="col-md-2 col-sm-2 lableModal label-on-left">Online Pay</label>
                                            <div class="col-md-10 col-sm-10">
                                                <div class="form-group label-floating togglebutton ">
                                                    <label>
                                                        <input type="checkbox" name="online_pay" class="form-control" checked="" />
                                                    </label>
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