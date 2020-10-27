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
											<div class="modal-content" id="noticeModalData">
											</div>
										</div>
									</div>
                                    <!--Modal Code End-->
                                    
                                     <!-- 11-10-2020 -->
                                    <!-- this is void bill modal popup -->
                                    <div class="modal fade" id="voidBillModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
										<div class="modal-dialog modal-notice">
											<div class="modal-content">
											</div>
										</div>
									</div>
                                    <!--Modal Code End-->
                                    
                                    <!-- this is void bill modal popup -->
                            <div class="modal fade" id="voidBillModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                <div class="modal-dialog modal-notice">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                            <h5 class="modal-title" id="myModalLabel4">
                                                <b>Void Bill For Order #<span id="currentOrderId"></span></b>
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card">
                                                <form id="managerPass" method="POST">
                                                    <div class="card-header card-header-icon" data-background-color="rose">
                                                        <i class="material-icons">contacts</i>
                                                    </div>
                                                    <div class="card-content">
                                                        <h4 class="card-title">Please Enter Manager Password</h4>

                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Password
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control managerPassword" name="manager_password" id="managerPassword" type="password" required="true" />                                                       
                                                        </div>        
                                                        <div id="managerPasswordErrorMessage"></div>
                                                        
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Reason</label>
                                                            <input class="form-control managerPassword" name="reason" id="reason" type="text" required="true" />                                      
                                                        </div>
                                                        <div id="reasonErrorMessage"></div>
                                                        

                                                        <div class="text-right">
                                                            
                                                            <button type="button" class="btn btn-primary btn-round" name="verify_pass" id="verifyPassBtn">VOID BILL</button>
                                                            
                                                            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Code End-->
                            
                            
                            
                            <!-- nck verification popup -->
                             
                             <div class="modal fade" id="nckBillVerifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                <div class="modal-dialog modal-notice">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                            <h5 class="modal-title" id="myModalLabel4">
                                                <b>Nck Bill For Order #<span id="currentOrderId"></span></b>
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <div class="card">
                                                <form id="managerPassForNck" method="POST">
                                                    <div class="card-header card-header-icon" data-background-color="rose">
                                                        <i class="material-icons">contacts</i>
                                                    </div>
                                                    <div class="card-content">
                                                        <h4 class="card-title">Please Enter Manager Password</h4>

                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Password
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control managerPasswordForNck" name="manager_password" id="managerPasswordForNck" type="password" required="true" />                                                       
                                                        </div>
                                                        <div id="managerPasswordForNckErrorMessage"></div>
                                                        
                                                        
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Reason
                                                                
                                                            </label>
                                                            <input class="form-control managerPasswordForNck" name="reasonForNck" id="reasonForNck" type="text" required="true" />                                                       
                                                        </div>
                                                        <div id="reasonErrorMessageForNck"></div>
                                                        

                                                        <div class="text-right">
                                                            
                                                            <button type="button" class="btn btn-primary btn-round" name="verify_nck_pass" id="verifyNckPassBtn">NCK BILL</button>
                                                            
                                                            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Code End-->


                                    
                                    <!-- 13-10-2020 -->
                                     <!-- this is void bill modal popup -->
                                     <div class="modal fade" id="nckBillModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
										<div class="modal-dialog modal-notice">
											<div class="modal-content" id="nckModalData">
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
			$('#noticeModalData').html(response);
			$('#noticeModal').modal('show');
			// console.log(response);
        })
    }
    
     // 13-10-2020
    function getNckBill(orderID=0)
    {
        $.ajax({
            url: "<?= base_url('Restaurant/getNckBill') ?>",
		    type: 'POST',
		    data: {'orderID':orderID}
        })
    	.done(function(response){
			$('#nckModalData').html(response);
			$('#nckBillModal').modal('show');
			console.log(response);
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
	
	  // void bill manager password verification  
	$(document).on("click", "div[id^=voidBillBtn-]", function(e) {

        let msg = $(this).attr('id');  
        let custom_id= msg.replace(/voidBillBtn-/g, "");    
        
        $('[id=currentOrderId]').text(custom_id);


        $('#voidBillModal1').modal('show');
    });


	$("#verifyPassBtn").click(function(e) {

        //order id fetch for each order and check 
        e.preventDefault();

        let orderId = document.getElementById("currentOrderId").innerHTML;

		$('#managerPasswordErrorMessage').hide();

		let managerPassword = $("#managerPassword").val(); 
		let reason = $("#reason").val();
        let orderID = orderId;
        
         
        
       
		if (managerPassword == null || managerPassword == "" ) {
			$('#managerPasswordErrorMessage').show();
			$("#managerPasswordErrorMessage").html("Please enter password").css("color", "red");
		} else if (reason == null || reason == "" ) {
			$('#reasonErrorMessage').show();
			$("#reasonErrorMessage").html("Please enter a reason").css("color", "red");
		}
		else {
			let postData = {
				'managerPassword' : managerPassword,
				'reason' : reason,
                'orderID': orderID                             
			}
            
		    $('#managerPasswordErrorMessage').hide();

			$.ajax({
				type: "POST",
				url: "<?= base_url('/Restaurant/verifyMangerPassword/') ?>",
				data: postData,
				cache: false,
				success: function(msg) {

                    if(msg == "correct"){
                       
                        swal("Success!", "added to void orders successfully", "success");
                       
                        $('#voidBillModal1').modal('hide');  
                    } else {
                        swal("Incorrect Password!", "Please enter a valid password", "error");
                    }

					$('#managerPasswordErrorMessage').val('');
                    $('#voidBillModal1').val(0);

				}
               
			});
		}
	});
	
	
// 	nck manager password

    $(document).on("click", "div[id^=nckBillBtn-]", function(e) {

        var msg = $(this).attr('id');  
        
        var custom_id= msg.replace(/nckBillBtn-/g, "");    
        
        $('[id=currentOrderId]').text(custom_id);

        $('#nckBillVerifyModal').modal('show');
    });


	$("#verifyNckPassBtn").click(function(e) {

        //order id fetch for each order and check 

        e.preventDefault();

        var orderId = document.getElementById("currentOrderId").innerHTML;

		$('#managerPasswordForNckErrorMessage').hide();

		let managerPasswordForNck = $("#managerPasswordForNck").val(); 
        let reasonForNck = $("#reasonForNck").val();
        let orderID = orderId;
       
        
		if (managerPasswordForNck == null || managerPasswordForNck == "") {
			$('#managerPasswordForNckErrorMessage').show();
			$("#managerPasswordForNckErrorMessage").html("Please enter password").css("color", "red");
		} else if (reasonForNck == null || reasonForNck == "" ) {
			$('#reasonErrorMessageForNck').show();
			$("#reasonErrorMessageForNck").html("Please enter a reason").css("color", "red");
		} else {
			let postData = {
				'managerPasswordForNck' : managerPasswordForNck,
				'reasonForNck' : reasonForNck,
                'orderID': orderID                             
			}
            
		    $('#managerPasswordForNckErrorMessage').hide();

			$.ajax({
				type: "POST",
				url: "<?= base_url('/Restaurant/verifyMangerPasswordForNck/') ?>",
				data: postData,
				// dataType: "html",
				cache: false,
				success: function(msg) {
                    if(msg == "correct"){
                        swal("Success!", "added to nck orders successfully", "success");
                        $('#nckBillVerifyModal').modal('hide');  
                    } else {
                        swal("Incorrect Password!", "Please enter a valid password", "error");
                    }

					$('#managerPasswordForNck').val('');
                    $('#nckBillVerifyModal').val(0);
				}
			});
		}
	});
</script>