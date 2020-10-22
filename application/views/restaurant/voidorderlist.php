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
                                <h4 class="card-title">List Void Order</h4>
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    <div class="col-md-3">
                                        <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="button" name="csv" id="csv" value="CSV" class="btn btn-info" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="button" name="excel" id="excel" value="Excel" class="btn btn-info" />
                                    </div>
                                </div>
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Status</th>
                                                <th>Order Id</th>
                                                <th>Table Id</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Order Type</th>
                                                <th>Payment Mode</th>
                                                <th>Created Date</th>
                                                <th class="disabled-sorting text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Status</th>
                                                <th>Order Id</th>
                                                <th>Table Id</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Order Type</th>
                                                <th>Payment Mode</th>
                                                <th>Created Date</th>
                                                <th class="disabled-sorting text-right">Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                
                                <!--Modal Code Start-->
                                <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-notice">
                                        <div class="modal-content">
                                        </div>
                                    </div>
                                </div>
                                <!--Modal Code End-->

                            </div>
                            <!-- end content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .label {
                border-radius: 0px;
            }

            @media (min-width: 768px) {
                .modal-dialog {
                    width: 900px;
                }
            }

            .table.table-shopping thead {
                background: #dddddd;
            }
        </style>
        <?php $this->load->view('comman/footer'); ?>
        <script>
            jQuery(document).ready(function() {
                var rid = "<?= $this->session->userid ?>";

                <?php if ($this->session->flashdata('Success MSG')) { ?>
                    swal({
                        text: "<?= $this->session->flashdata('Success MSG') ?>",
                        confirmButtonClass: "btn btn-success",
                        type: "success"
                    });
                <?php } ?>

                <?php if ($this->session->flashdata('Fail MSG')) { ?>
                    swal({
                        text: "<?= $this->session->flashdata('Fail MSG') ?>",
                        confirmButtonClass: "btn btn-danger",
                        type: "error"
                    });
                <?php } ?>


                // Javascript method's body can be found in assets/js/demos.js
                demo.initDashboardPageCharts();

                demo.initVectorMap();

                fetchData('no');

                $('#filter').on('click', function() {
                    var data = {};
                    data.from = $('#from_date').val();
                    data.to = $('#to_date').val();

                    var json = JSON.stringify(data);
                    $('#datatables').DataTable().destroy();
                    fetchData('yes', json);
                });

                $('#csv').on('click', function() {
                    var data = {};
                    var fromdate = '';
                    var todate = '';
                    data.from = $('#from_date').val();
                    data.to = $('#to_date').val();

                    fromdate = Date.parse(data.from) / 1000;
                    todate = Date.parse(data.to) / 1000;

                    window.open('<?= base_url("Restaurant/exportSheetForVoid") ?>' + '/csv/' + rid + '/' + fromdate + '/' + todate, '_blank');
                });

                $('#excel').on('click', function() {
                    var data = {};
                    var fromdate = '';
                    var todate = '';
                    data.from = $('#from_date').val();
                    data.to = $('#to_date').val();

                    fromdate = Date.parse(data.from) / 1000;
                    todate = Date.parse(data.to) / 1000;

                    window.open('<?= base_url("Restaurant/exportSheetForVoid") ?>' + '/excel/' + rid + '/' + fromdate + '/' + todate, '_blank');
                });

                $('.card .material-datatables label').addClass('form-group');

                // setInterval(function(){ $('#datatables').DataTable().ajax.reload(); }, 15000);
            });

            function getOrderView(orderID = 0) {
                $.ajax({
                        url: "<?= base_url('Restaurant/getOrderView') ?>",
                        type: 'POST',
                        data: {
                            'orderID': orderID
                        }
                    })
                    .done(function(response) {
                        $('.modal-content').html(response);
                        $('#noticeModal').modal('show');
                        // console.log(response);
                    })
            }

            function fetchData(isFilter = 'no', data = null) {
                $('#datatables').DataTable({
                    'processing': true,
                    'ajax': {
                        'url': '<?= base_url() . "Restaurant/ajaxorderlist/voidBillReport" ?>',
                        'type': 'POST',
                        'data': {
                            'isFilter': isFilter,
                            'formdata': data
                        }
                    },
                    'columns': [{
                            'data': 0
                        },
                        {
                            'data': 1
                        },
                        {
                            'data': 2
                        },
                        {
                            'data': 3
                        },
                        {
                            'data': 4
                        },
                        {
                            'data': 5
                        },
                        {
                            'data': 6
                        },
                        {
                            'data': 7
                        },
                        {
                            'data': 8
                        },
                        {
                            'data': 9
                        }


                    ],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "pageLength": 10
                });
            }
        </script>

        </script>