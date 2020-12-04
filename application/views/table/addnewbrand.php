<?php $this->load->view('comman/header'); ?>
<?php $this->load->view('comman/sidebar'); ?>
<div class="main-panel">
<?php $this->load->view('comman/headNav'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="get" action="http://demos.creative-tim.com/" class="form-horizontal">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Create New Brand</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Name of company</label>
                                            <input type="text" class="form-control" value="" name="companyName" id="companyName">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Owner</label>
                                            <input type="text" class="form-control" value="" name="ownerName" id="ownerName">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">GSTIN</label>
                                        <input type="text" class="form-control" value="" name="gstNumber" id="gstNumber">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">State</label>
                                            <input type="text" class="form-control" value="" name="stateName" id="stateName">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label class="col-sm-3 label-on-left">With inventory</label>
                                    <div class="col-sm-4">
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">Yes
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-sm-4 label-on-left">Online gateway</label>
                                    <div class="col-sm-5">
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">Yes
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-inline">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Number of branches</label>
                                            <input type="text" class="form-control" value="" name="numberOfBranches" id="numberOfBranches">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <button type="button" class="btn btn-rose btn-fill" id="addBtn">Branch (+)</button>
                                </div>
                            </div>
                            <div id="addFields" class="row">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('comman/footer'); ?>

<script>
    let x = 1;
    let fieldHtml = '<div class="col-md-4"><div class="form-group label-floating">';
    fieldHtml  += '<label class="control-label">Branch Name</label><input type="text" class="form-control" value="" name="branchName[]"></div></div>';
    fieldHtml += '<div class="col-md-4"><div class="form-group label-floating">';
    fieldHtml += '<label class="control-label">Branch address</label><input type="text" class="form-control" value="" name="branchAddress[]"></div></div>';
    fieldHtml += '<div class="col-md-4"><div class="form-group label-floating">';
    fieldHtml += '<label class="control-label">Branch state</label><input type="text" class="form-control" value="" name="branchState[]"></div></div>';
                        
    $("#addBtn").click(function() {
        x++;
        $("#addFields").append(fieldHtml);
    });


</script>