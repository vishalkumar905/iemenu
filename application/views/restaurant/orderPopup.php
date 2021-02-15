<?php $ci=get_instance(); ?>
<style>
    .box{
        color: #fff;
        padding: 20px;
        display: none;
        margin-top: 20px;
    }
    .percentOff{ background: #D1E6F0; }
    .amountOff{ background: #D1E6F0; }
  
</style>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
	<h5 class="modal-title" id="myModalLabel"><b>Order #<?= $order->order_id ?></b></h5>
</div>




                <?php $this->session->unset_userdata('finalDiscAmount'); ?>
                <?php $this->session->unset_userdata('finalFlatOffAmount');?>
                <?php $this->session->unset_userdata('totalAmt');?>
                <?php $this->session->unset_userdata('discPercent');?>
                <?php $this->session->unset_userdata('flatAmountPrice');?>
                
        

<div class="modal-body">
    <div class="instruction">
	    <div class="row">
			<div class="col-md-12">
			    <h5  class="modal-title"><?= ($order->table_id) ? (($ci->getTableDetail($order->table_id)) ? $ci->getTableDetail($order->table_id)->table_name : '-') : '-'; ?></h5>
			</div>
	    </div>
	</div>
    <div class="instruction">
		<div class="row">
			<div class="col-md-8">
				<p><strong>Last Update : </strong><?= $order->updated_at ?></p>
				<p><strong>Created : </strong><?= $order->created_at ?></p>
				<p><strong>Payment Method : </strong><?= $paymentMethodName; ?></td></p>
				<p><strong>Transaction ID : </strong><?= ($order->payment_mode=='1') ? '-' : $order->txn_id ; ?></td></p>
			</div>
			<div class="col-md-4">
			    <?php $CartLists=json_decode($order->item_details, true); ?>
				<p><strong>Total Amount : </strong>₹ <?= $ci->cartTotal($CartLists) ?></p>
				<p><strong>Total Billed : </strong>₹ <?= $ci->cartTotal($CartLists,'yes',$order->res_id) ?></p>
				
				<?php if($order->order_status == 1 || $order->order_status == 2) { ?>
				    <?php if(!empty($order->discount_coupon_percent)){ ?>
    				<p><strong>Disount % : </strong> <?= $order->discount_coupon_percent; ?> %</p>
    				<?php } ?>
    				<?php if(!empty($order->flat_amount_discount)){?>
    				    <p><strong>Flat Amount Off : </strong>₹ <?= $order->flat_amount_discount; ?></p>
    				<?php } ?>

					<?php 
						if (floatval($order->delivery_charge) > 0) {
							echo "<p><strong>Delivery Charge : </strong>₹ " . $order->delivery_charge . "</p>";
						}

						if (floatval($order->container_charge) > 0) {
							echo "<p><strong>Container Charge : </strong>₹ " . $order->container_charge . "</p>";
						}
					?>

                    <p><strong>Amount Paid : </strong>₹ <?= $order->total; ?></p>
				<?php } ?>
				
			

				<!-- total_amount -->
				
				<?php if($order->order_status == 0) { ?>
				<?php $this->session->set_userdata('totalAmt', $ci->cartTotal($CartLists));?>
				
				<div>
					<strong>Add Discount : </strong>
					<span>
								<input class="radio-btn" type="radio" name="discount_type" id="percent" value="percentOff">
								<label for="" class="pr-10 pl-5 radio-label">Percent Off</label>

								<!--<input class="radio-btn" type="radio" name="discount_type" id="amount" value="amountOff">-->
								<!--<label for="" class="pr-10 pl-5 radio-label">Amount</label></span>-->

				</div>				

				<!-- percent off dropdown -->
				<div class="percentOff box">
					<?php if(!empty($percentOff)) { ?> 
							<label style="color:black" for="discPercent">Select Coupon For % Off : </label>								
									<select style="color:black" name="discPercent" id="discPercent" value="">
										<option value="">None Selected</option>
										<?php foreach($percentOff as $percent) { ?>
											<option style="color:black" value="<?= $percent->discount_percent;?>"><?= $percent->discount_name;?></option>
										<?php } ?>
									</select>						
									<br>
									<div id="DiscMsg"></div>
					<?php } else {?>
						<b style="color: red;"> No offers Availaible!</b>
					<?php } ?>		
				</div>

				

				<!-- amount off text box -->
				<div class="amountOff box">					
					<b style="color:black">Flat Amount Off: ₹ </b><input name="amountOff" id="amountOff" style="color:black" type="number" value="">
					<div id="AmountOffMsg"></div>
					<button type="submit" name="add_discount" id="add_discount" class="btn btn-xs btn-danger">Add Discount</button>
				</div>
				<?php } ?>
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
								<th class="text-center"></th>
								<th><b>Item</b></th>
								<th><b>Quantity</b></th>
								<th><b>Discount</b></th>
								<th><b>Price</b></th>
								<th><b>Sent</b></th>
								<th class="text-right"><b>Actions</b></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($CartLists as $itemId => $itemArray) : 
						    foreach($itemArray as $itemDataId => $itemDataArray) :
						    ?>
							<tr>
								<td>
									<div class="img-container" style="position: relative;">
										<img src="<?= base_url($itemDataArray['itemImage']) ?>" alt="Item Image">
										<?php if(isset($itemDataArray['itemFoodType'])) { ?>
										<img src="<?= base_url('assets/img/').$itemDataArray['itemFoodType'].'.png' ?>" alt="<?= $itemDataArray['itemFoodType']; ?>" style="width: 15px;position: absolute;top: 5px;left: 5px;">
										<?php } ?>
									</div>
								</td>
								<td>
									<b><?= $itemDataArray['itemName'] ?></b> &nbsp; <?= $itemDataId ?>
								</td>
								<td>
									<?= $itemDataArray['itemCount'] ?>
								</td>
								<td>
									<?php $itemDiscountAmount = $itemDataArray['itemDiscountAmount'] ?? 0; ?>
									₹ <?= $itemDiscountAmount ?>
								</td>
								<td>
									₹ <?= isset($itemDataArray['itemTotalAmount']) ? $itemDataArray['itemTotalAmount'] : $itemDataArray['itemCount'] * $itemDataArray['itemPrice']  ?>
								</td>
								<td>
									<?= $order->created_at ?>
								</td>
								<td class="td-actions text-right">
								<?php if($order->order_status == 0) { ?>
									<button type="button" rel="tooltip" data-placement="left" title="Remove item" class="btn btn-simple" onclick="removeCart('<?= $order->order_id ?>','<?= $itemId ?>','<?= $itemDataId ?>')">
										<i class="material-icons">close</i>
									</button>
								<?php } else { echo '-'; } ?>
								</td>
							</tr>
					    <?php endforeach;
					    endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div id="billSummary">
	
	</div>

	<div class="text-right">

					

	<?php if($order->order_status == 0) { ?>
		<button type="button" class="btn btn-primary btn-round" onclick="updateOrder('<?= $order->order_id ?>','1')">Confirm Order</button>
	<?php //} elseif($order->order_status == 2) { $path=base_url("Restaurant/printInvoice/").$order->order_id; ?>
	<?php } elseif($order->order_status == 1 || $order->order_status == 3) { $path=base_url("Restaurant/printInvoice2/").$order->order_id; $path2=base_url("Restaurant/printInvoice3/").$order->order_id; ?>
	    <button type="button" class="btn btn-primary btn-round" id="customerCopy">Customer Copy</button>

		<?php if (empty($kotPrintBtns)) { ?>
		    <button type="button" class="btn btn-primary btn-round" onclick="window.open('<?= $path ?>','_blank')">KOT Print</button>
		<?php } else { ?>		
		    <button type="button" class="btn btn-primary btn-round kotPrintBtn">KOT Print</button>
		<?php } ?>
	<?php } ?>
		<button type="button" class="btn btn-default btn-round" data-dismiss="modal">Cancel</button>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.5.0/print.min.js" integrity="sha512-lzGE9ZqdrztBEk1wtq4O60N3WbsTlIvvm6ULCxWRt+CwpRD4WUbgC5aatbtourCUC15PJpqcpZk3VLs12vpNoA==" crossorigin="anonymous"></script>
<script>

var CUSTOMER_INVOICE_PRINT_PATH = "<?=base_url("Restaurant/printInvoice3/").$order->order_id?>";

$(document).ready(function(){

	$("#customerCopy").click(function() {
		$("#billSummary").html(`<embed type="application/pdf" style="width: 100%;height: 300px;" id="doc" class="doc" src="${CUSTOMER_INVOICE_PRINT_PATH}"></embed>`);
		printJS(CUSTOMER_INVOICE_PRINT_PATH);
	});
	
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });

	// offer discount coupon
	$("#discPercent").change(function(e) {
		var discPercentValue = $("#discPercent").val();
	
		$('#DiscMsg').hide();
		if (discPercentValue == null || discPercentValue == "") {
			$('#DiscMsg').show();
			$("#DiscMsg").html("Please select offer coupon").css("color", "red");
		} else {
			// alert(discPercentValue);
			$.ajax({			
				type: "POST",
				url: "<?php echo base_url('restaurant/check_offer_coupon_and_apply/');?>", 
				data: $('#discPercent').serialize(),
				dataType: "html",
				cache: false,
				success: function(msg) {
					$('#DiscMsg').show();
					$("#DiscMsg").html(msg);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#DiscMsg').show();
					$("#DiscMsg").html(textStatus + " " + errorThrown);
				}
			});
		}
	});


	// offer flat rupees off
	$("#add_discount").on("click", function(e) {		
		let amountOff = $('#amountOff').val();
		$('#AmountOffMsg').hide();
		if (amountOff == null || amountOff == "") {
			$('#AmountOffMsg').show();
			$("#AmountOffMsg").html("Please add amount").css("color", "red");
		} else {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('restaurant/apply_flat_amount_off/');?>", 
				data: $('#amountOff').serialize(),
				dataType: "html",
				cache: false,
				success: function(msgs) {
					$('#AmountOffMsg').show();
					$("#AmountOffMsg").html(msgs);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#AmountOffMsg').show();
					$("#AmountOffMsg").html(textStatus + " " + errorThrown);
				}
			});
		}
	});

	$(".kotPrintBtn").click(function() {
		let url = "<?=base_url('Restaurant/getKotBtns/')?>" + "<?=$order->order_id?>";
		$.get(url, function(resp) {
			if (resp.kotPrintBtns)
			{
				$("#noticeModal").modal('hide');
				$("#kotPrintModalBody").html(resp.kotPrintBtns);
				$("#kotPrintModal").modal('show');
			}
		}, 'json');
	});
});
	
// diable radio button on select
// document.getElementById('amount').onclick = function() {
//     document.getElementById('percent').disabled = true;
// }

// document.getElementById('percent').onclick = function() {
//     document.getElementById('amount').disabled = true;
// }


</script>