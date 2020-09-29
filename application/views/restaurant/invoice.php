<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('/assets/img/apple-icon.png'); ?>" />
    <link rel="icon" type="image/png" href="<?php echo base_url('/assets/img/favicon.png'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Invoice #<?= $order->order_id ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo base_url('/assets/css/material-dashboard.css'); ?>" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url('/assets/css/demo.css'); ?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css" />
    <style>
        @media print {
          #printPageButton {
            display: none;
          }
          .column1 {
              width: 70%;
              float: left;
          }
          .column2 {
              width: 30%;
              float: left;
          }
        }
        
        body { background-color: #FFFFFF !important; }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php $ci=get_instance(); ?>
        <div class="">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="margin-bottom:20px;text-align: right;margin-top: 50px;"><button id="printPageButton" class="btn btn-primary btn-sm" onclick="window.print()">Print this page</button></p>
                            <div class="instruction" style="margin-bottom:20px; text-align:center;">
                        	    <h2><b><?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->name : '-' : '-'; ?></b></h2>
                        	</div>
                            <h5 class="" id=""><b>Order #<?= $order->order_id ?></b></h5>
                            <div>
                            	<div class="instruction" style="margin-bottom:20px;">
                            	    <div class="row">
                            			<div class="col-md-12">
                            			    <h5  class="modal-title"><?= ($order->table_id) ? ($ci->getTableDetail($order->table_id)) ? $ci->getTableDetail($order->table_id)->table_name : '-' : '-'; ?></h5>
                            			</div>
                            	    </div>
                            	</div>
                                <div class="instruction" style="margin-bottom:20px;">
                            		<div class="row">
                            			<div class="col-md-8 column1">
                            				<p><strong>Last Update : </strong><?= $order->updated_at ?></p>
                            				<p><strong>Created : </strong><?= $order->created_at ?></p>
                            				<p><strong>Payment Method : </strong><?= ($order->payment_mode=='1') ? 'CASH' : 'ONLINE' ; ?></td></p>
                            				<p><strong>Transaction ID : </strong><?= ($order->payment_mode=='1') ? '-' : $order->txn_id ; ?></td></p>
                            			</div>
                            			<div class="col-md-4 column2">
                            			    <?php $CartLists=json_decode($order->item_details, true); ?>
                            				<p><strong>Total Amount : </strong>₹ <?= $ci->cartTotal($CartLists) ?></p>
                            				<?php $taxLists=$ci->getTaxList($order->res_id); if(!empty($taxLists)) :
                                            foreach($taxLists as $taxList): ?>
                            				<p><strong><?= $taxList->tax_type ?> &nbsp; (<?= $taxList->tax_percent ?>%) : </strong>₹ <?= $ci->cartTax($CartLists, $taxList->tax_percent) ?></p>
                            				<?php endforeach; endif; ?>
                            				<p><strong>Total Billed : </strong>₹ <?= $ci->cartTotal($CartLists,'yes',$order->res_id) ?></p>
                            			</div>
                            		</div>
                            	</div>
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="card-content">
                            				<div class="table-responsive">
                            					<table class="table table-shopping">
                            						<thead>
                            							<tr>
                            								<!--<th class="text-center"></th>-->
                            								<th><b>Items</b></th>
                            								<th><b>Quantity</b></th>
                            								<th><b>Price</b></th>
                            								<!--<th><b>Sent</b></th>-->
                            								<!--<th class="text-right"><b>Actions</b></th>-->
                            								<!--<th></th>-->
                            							</tr>
                            						</thead>
                            						<tbody>
                            						<?php $i=0; foreach($CartLists as $itemId => $itemArray) : 
                            						    foreach($itemArray as $itemDataId => $itemDataArray) :
                            						    ?>
                            							<tr>
                            								<!--<td>-->
                            								<!--	<div class="img-container" style="position: relative;">-->
                            								<!--		<img src="<?= base_url($itemDataArray['itemImage']) ?>" alt="Item Image">-->
                            										<?php //if(isset($itemDataArray['itemFoodType'])) { ?>
                            								<!--		<img src="<?= base_url('assets/img/').$itemDataArray['itemFoodType'].'.png' ?>" alt="<?= $itemDataArray['itemFoodType']; ?>" style="width: 15px;position: absolute;top: 5px;left: 5px;">-->
                            										<?php //} ?>
                            								<!--	</div>-->
                            								<!--</td>-->
                            								<td>
                            									<b><?= $itemDataArray['itemName'] ?></b> &nbsp; (<?= $itemDataId ?>)
                            								</td>
                            								<td>
                            									<?= $itemDataArray['itemCount'] ?>
                            								</td>
                            								<td>
                            									₹ <?= $itemDataArray['itemCount'] * $itemDataArray['itemPrice'] ?>
                            								</td>
                            								<!--<td>
                            									<?= $order->created_at ?>
                            								</td>
                            								<td class="td-actions text-right">
                            								<?php //if($order->order_status == 0) { ?>
                            									<button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-simple" onclick="removeCart('<?= $order->order_id ?>','<?= $itemId ?>','<?= $itemDataId ?>')">
                            										<i class="material-icons">close</i>
                            									</button>
                            								<?php //} else { echo '-'; } ?>
                            								</td>-->
                            							</tr>
                            					    <?php endforeach;
                            					    endforeach; ?>
                            						</tbody>
                            					</table>
                            				</div>
                            			</div>
                            		</div>
                            	</div>
                            </div>
                            
                            <!--<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            	<div class="modal-dialog modal-notice">
                            		<div class="modal-content">
                            		    <div class="modal-header">
                                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                    	
                                    </div>
                                    <div class="modal-body">
                                
                            		</div>
                            	</div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!--   Core JS Files   -->
    <script src="<?php echo base_url('/assets/js/jquery-3.1.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/jquery-ui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/material.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.validate.min.js'); ?>"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="<?php echo base_url('/assets/js/moment.min.js'); ?>"></script>
    <!--  Charts Plugin -->
    <script src="<?php echo base_url('/assets/js/chartist.min.js'); ?>"></script>
    <!--  Plugin for the Wizard -->
    <script src="<?php echo base_url('/assets/js/jquery.bootstrap-wizard.js'); ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url('/assets/js/bootstrap-notify.js'); ?>"></script>
    <!--   Sharrre Library    -->
    <script src="<?php echo base_url('/assets/js/jquery.sharrre.js'); ?>"></script>
    <!-- DateTimePicker Plugin -->
    <script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.js'); ?>"></script>
    <!-- Vector Map plugin -->
    <script src="<?php echo base_url('/assets/js/jquery-jvectormap.js'); ?>"></script>
    <!-- Sliders Plugin -->
    <script src="<?php echo base_url('/assets/js/nouislider.min.js'); ?>"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Select Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.select-bootstrap.js'); ?>"></script>
    <!--  DataTables.net Plugin    -->
    <script src="<?php echo base_url('/assets/js/jquery.datatables.js'); ?>"></script>
    <!-- Sweet Alert 2 plugin -->
    <script src="<?php echo base_url('/assets/js/sweetalert2.js'); ?>"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo base_url('/assets/js/jasny-bootstrap.min.js'); ?>"></script>
    <!--  Full Calendar Plugin    -->
    <script src="<?php echo base_url('/assets/js/fullcalendar.min.js'); ?>"></script>
    <!-- TagsInput Plugin -->
    <script src="<?php echo base_url('/assets/js/jquery.tagsinput.js'); ?>"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="<?php echo base_url('/assets/js/material-dashboard.js'); ?>"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url('/assets/js/demo.js'); ?>"></script>
    <script>
    // jQuery(document).ready(function() {
    //     jQuery('#noticeModal').modal('show');
    // });
    </script>
</body>
</html>