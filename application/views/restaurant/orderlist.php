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
                                    <h4 class="card-title">List Order</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                        
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
                                                    <th class="disabled-sorting text-right">Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    
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
            .label { border-radius: 0px; }
            @media (min-width: 768px){
                .modal-dialog {
                    width: 900px;
                }
            }
            .table.table-shopping thead {
                background: #dddddd;
            }
            </style>
            
            <div id="audios" style="display:none;">We are audios!</div>
            
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
        demo.initDashboardPageCharts();

        demo.initVectorMap();

        $('#datatables').DataTable({
            'processing'    : true,
            'ajax'          : {
                'url'  : '<?= base_url() . "Restaurant/ajaxorderlist/order" ?>'
            },
            'columns'        : [
                { 'data' : 0 },
                { 'data' : 1 },
                { 'data' : 2 },
                { 'data' : 3 },
                { 'data' : 4 },
                { 'data' : 5 },
                { 'data' : 6 },
                { 'data' : 7 },
                { 'data' : 8 }
                
            ],
            "pagingType": "full_numbers",
            "lengthMenu"    : [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pageLength"    : 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        $('.card .material-datatables label').addClass('form-group');
        
        setInterval(function(){ $('#datatables').DataTable().ajax.reload();  }, 15000);
        
        
        
    });
    
    // function checkUpdate()
    // {
    //     $.post("<?= base_url('Restaurant/ajaxorderlist/order') ?>", function(data, status)
    //     {   
    //         //  alert("Data: " + data + "\nStatus: " + status);
    //         // alert(data.toString()=="true");
    //       if (data.toString()=="true")
    //       {
    //           playSound();
    //       }
    //     });
    // }
    
    // function playSound()
    // {
    //     var audio = new Audio('https://iemenu.in/MDB/assets/order_alert.mp3');
    //     audio.play();
    // }
    
    function getOrderView(orderID=0)
    {
        $.ajax({
            url: "<?= base_url('Restaurant/getOrderView') ?>",
		    type: 'POST',
		    data: {'orderID':orderID}
        })
    	.done(function(response){
			$('.modal-content').html(response);
			$('#noticeModal').modal('show');
			// console.log(response);
        })
    }
    function updateOrder(orderID=0,status=null)
    {
        $.ajax({
            url: "<?= base_url('Restaurant/updateOrderStatus') ?>",
		    type: 'POST',
		    data: {'orderID':orderID,'status':status}
        })
    	.done(function(response){
			location.reload();
			// console.log(response);
        })
    }
    function removeCart(orderID=0,itemid=0,itemtype=null)
	{
	    if(orderID!==0 && itemid!==0 && itemtype!==null) {
	        $.ajax({
    	        type : "POST",
    	        url  : "<?= base_url('Restaurant/cartRemove') ?>",
    	        data : { 'orderID': orderID, 'itemID' : itemid, 'itemType' : itemtype }
    	    })
    	    .done(function(response){
    	       // console.log(response);
    	        $('.modal-content').html(response);
    	    })
	    }
	}
</script>