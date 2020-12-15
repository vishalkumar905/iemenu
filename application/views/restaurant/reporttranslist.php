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
                                    <h4 class="card-title">List Transactions</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order Id</th>
                                                    <th>Tnx Id</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Card Type</th>
                                                    <!--<th>Items</th>
                                                    <th>paid amount</th>
                                                    <th>Receipt url</th>
                                                    <th>Payment Status</th>-->
                                                    <th>Created At</th>
                                                    <!--<th class="disabled-sorting text-right">Actions</th>-->
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order Id</th>
                                                    <th>Tnx Id</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Card Type</th>
                                                    <!--<th>Items</th>
                                                    <th>paid amount</th>
                                                    <th>Receipt url</th>
                                                    <th>Payment Status</th>-->
                                                    <th>Created At</th>
                                                    <!--<th class="disabled-sorting text-right">Actions</th>-->
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php $i=0; $ci=get_instance(); if(!empty($transactions)){
											foreach($transactions as $trans){
											?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><?php echo (!empty($ci->getOrderDetailByTnx($trans->txn_id))) ? $ci->getOrderDetailByTnx($trans->txn_id)[0]->order_id : '-'; ?></td>
                                                    <td><?php echo $trans->txn_id; ?></td>
                                                    <td><?php echo $trans->name; ?></td>
                                                    <td><?php echo $trans->email; ?></td>
                                                    <td><?php echo $trans->card_type; ?></td>
                                                    <!--<td><?php //echo $trans->item_number; ?></td>
                                                    <td><?php //echo $trans->paid_amount." Rs"; ?></td>
                                                    <td><a href='<?php //echo $trans->receipt_url; ?>'>Click here</a></td>
                                                    <td><?php //echo $trans->payment_status; ?></td>-->
                                                    <td><?php echo $trans->created; ?></td>
                                                    <!--<td class="text-right">
                                                        <a href="update/<?php //echo $trans->id; ?>" title="Update" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">create</i></a>
                                                        <a href="delete/<?php //echo $trans->id; ?>" data-id="<?php echo $trans->id; ?>" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
                                                    </td>-->
                                                </tr>
											<?php } } ?>    
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
                confirmButtonClass: "btn btn-success",
                type: "success"
            });
        <?php } ?>
        
        <?php if($this->session->flashdata('Fail MSG')) { ?>
            swal({
                text: "<?= $this->session->flashdata('Fail MSG') ?>",
                confirmButtonClass: "btn btn-danger",
                type: "error"
            });
        <?php } ?>


        // Javascript method's body can be found in assets/js/demos.js
        

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