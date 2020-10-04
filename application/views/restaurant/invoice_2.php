<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
</head>
<body>
    <div class="wrapper">
        <?php $ci=get_instance(); ?>
        <div class="">
            <div class="">
                <div style="padding-bottom:10px; text-align:center; font-size: 13px;">
            	    <strong><?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->name : '-' : '-'; ?></strong>
            	</div>
                <div>
                    <b>Order #<?= $order->order_id ?></b>&nbsp;(<?= ($order->table_id) ? ($ci->getTableDetail($order->table_id)) ? $ci->getTableDetail($order->table_id)->table_name : '-' : '-'; ?>) <br/>
                    <b>Date : </b><?= date('d-m-Y h:i:s a'); ?> <br/>
				    <strong>Payment Method : </strong><?= ($order->payment_mode=='1') ? 'CASH' : 'ONLINE' ; ?> <br/>
				    <strong>GSTIN : </strong>07AASFV8263C1ZQ
            	</div>
            	<hr class="new">
            	<?php $CartLists=json_decode($order->item_details, true); ?>
				<div style="width:100%;">
				    <div>
						<?php if ($showTaxColumn) { ?>
				        <div style="width:75%; float:left;"><b>Items</b></div>
						<div style="width:20%; float:left; text-align:center;"><b>Qty</b></div>
						<?php /*?>
				        <div style="width:13%; float:left; text-align:center;"><b>Tax</b></div>
						<div style="width:25%; float:left; text-align:right;"><b>Price</b></div>
						<?php */?>
						<?php }else { ?>
						<div style="width:75%; float:left;"><b>Items</b></div>
						<div style="width:20%; float:left; text-align:center;"><b>Qty</b></div>
						<?php /*?>
						<div style="width:25%; float:left; text-align:right;"><b>Price</b></div>
						<?php */?>
						<?php } ?>
				    </div>
				    <hr class="new">
				    <div>
				        <?php $i=0; foreach($CartLists as $itemId => $itemArray) : 
						    foreach($itemArray as $itemDataId => $itemDataArray) :
								if ($showTaxColumn) { 
									$taxName = [];
									$totalTaxPercentage = 0;
									if (!empty($itemDataArray['itemTaxes']))
									{
										foreach ($itemDataArray['itemTaxes'] as $itemTax)
										{
											$taxName[] = $itemTax['taxName'];
											$totalTaxPercentage += $itemTax['taxPercentage'];
										}
									}
						?>
    				        <div style="width:75%; float:left;">
								<?= $itemDataArray['itemName'] ?> (<?= $itemDataId ?>)
								<?php if(!empty($taxName)) {
									$tax = implode(', ', $taxName);
									// echo "<br><span style='font-size:10px;'>Tax: $tax </span>"; 
								}  ?>
							</div>
    				        <div style="width:20%; float:left; text-align:center;">
								<?= $itemDataArray['itemCount'] ?>
							</div>
    				        <?php /*?>
							<div style="width:13%; float:left; text-align:center;">
								<?=$totalTaxPercentage > 0 ? $totalTaxPercentage.'%' : '--' ?>
							</div>
    				        <div style="width:25%; float:left; text-align:right;">
								₹ <?= $itemDataArray['itemCount'] * $itemDataArray['itemPrice'] ?>
							</div>
							<?php */?>
    				    <?php } else { ?>
							<div style="width:75%; float:left;">
								<?= $itemDataArray['itemName'] ?> (<?= $itemDataId ?>)
							</div>
							<div style="width:20%; float:left; text-align:center;">
								<?= $itemDataArray['itemCount'] ?>
							</div>
							<?php /*?>
							<div style="width:25%; float:left; text-align:right;">
							₹ <?= $itemDataArray['itemCount'] * $itemDataArray['itemPrice'] ?>
							</div>
							<?php */?>
						<?php } endforeach;
					    endforeach; ?>
				    </div>
				</div>
            </div>
        </div>
        
    </div>
</body>
</html>