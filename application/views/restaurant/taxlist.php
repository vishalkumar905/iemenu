<?php $this->load->view('comman/header'); ?>
    <?php $this->load->view('comman/sidebar'); ?>
        <div class="main-panel">
            <?php $this->load->view('comman/headNav'); ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">List Tax</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Tax</th>
                                                    <th class="disabled-sorting text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Tax</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $i=0; if(!empty($taxs)){
											foreach($taxs as $tax){
											?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><?php echo $tax->tax_type; ?></td>
                                                    <td><?php echo $tax->tax_percent." %"; ?></td>
                                                    <td class="text-right">
                                                        <a href="deleteTax/<?php echo $tax->tax_id; ?>" data-id="<?php echo $tax->tax_id; ?>" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
                                                    </td>
                                                </tr>
											<?php } }else{
												echo "NO Records Avilable Now";
											} ?>    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('comman/footer'); ?>
<script>
    jQuery(document).ready(function() {
        <?php if($this->session->flashdata('Success MSG')) { ?>
            swal({
                text: "<?= $this->session->flashdata('Success MSG') ?>",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            });
        <?php } ?>
        
        <?php if($this->session->flashdata('Fail MSG')) { ?>
            swal({
                text: "<?= $this->session->flashdata('Fail MSG') ?>",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            });
        <?php } ?>


        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();

        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>