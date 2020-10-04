<?php $ci=get_instance(); ?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
	<h5 class="modal-title" id="myModalLabel"><b>Order #<?= $order->order_id ?></b></h5>
</div>
<div class="modal-body">
    <div class="instruction">
	    <div class="row">
			<div class="col-md-12">
			    <h5  class="modal-title"><?= ($order->table_id) ? ($ci->getTableDetail($order->table_id)) ? $ci->getTableDetail($order->table_id)->table_name : '-' : '-'; ?></h5>
			</div>
	    </div>
	</div>
    <div class="instruction">
		<div class="row">
			<div class="col-md-8">
				<p><strong>Last Update : </strong><?= $order->updated_at ?></p>
				<p><strong>Created : </strong><?= $order->created_at ?></p>
				<p><strong>Payment Method : </strong><?= ($order->payment_mode=='1') ? 'CASH' : 'ONLINE' ; ?></td></p>
				<p><strong>Transaction ID : </strong><?= ($order->payment_mode=='1') ? '-' : $order->txn_id ; ?></td></p>
			</div>
			<div class="col-md-4">
			    <?php $CartLists=json_decode($order->item_details, true); ?>
				<p><strong>Total Amount : </strong>₹ <?= $ci->cartTotal($CartLists) ?></p>
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
								<th class="text-center"></th>
								<th><b>Item</b></th>
								<th><b>Quantity</b></th>
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
									<b><?= $itemDataArray['itemName'] ?></b> &nbsp; (<?= $itemDataId ?>)
								</td>
								<td>
									<?= $itemDataArray['itemCount'] ?>
								</td>
								<td>
									₹ <?= $itemDataArray['itemCount'] * $itemDataArray['itemPrice'] ?>
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
	<div class="text-right">
	<?php if($order->order_status == 0) { ?>
		<button type="button" class="btn btn-primary btn-round" onclick="updateOrder('<?= $order->order_id ?>','1')">Confirm Order</button>
	<?php //} elseif($order->order_status == 2) { $path=base_url("Restaurant/printInvoice/").$order->order_id; ?>
	<?php } elseif($order->order_status == 1) { $path=base_url("Restaurant/printInvoice2/").$order->order_id; $path2=base_url("Restaurant/printInvoice3/").$order->order_id; ?>
	    <button type="button" class="btn btn-primary btn-round" onclick="window.open('<?= $path2 ?>','_blank')">Customer Copy</button>
	    <button type="button" class="btn btn-primary btn-round" onclick="window.open('<?= $path ?>','_blank')">KOT Print</button>
	<?php } ?>
		<button type="button" class="btn btn-default btn-round" data-dismiss="modal">Cancel</button>
	</div>
</div>