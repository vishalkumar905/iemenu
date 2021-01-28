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
                <div style="text-align:center; font-size: 13px;">
            	    <strong><?= ($order->res_id) ? (($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->name : '-') : '-'; ?></strong>
            	</div>
            	<div style="padding-bottom:10px; text-align:center; font-size: 10px;">
            	    <b><?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->tagline : '-' : '-'; ?></b>
            	</div>
            	
                <div>
                    <b>Order #<?= $order->order_id ?></b>&nbsp;(<?= ($order->table_id) ? ($ci->getTableDetail($order->table_id)) ? $ci->getTableDetail($order->table_id)->table_name : '-' : '-'; ?>) <?php if ($order->order_status == ORDER_STATUS_VOID_BILL) { ?>
						<b>VOID BILL</b> <?php } ?> <br/>
                    <b>Date : </b><?= date('d-m-Y h:i:s a'); ?> <br/>
				    <strong>Payment Method : </strong><?= $paymentMethodName ?> <br/>
				    <strong><?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->tax_name : '-' : '-'; ?> : 
				    </strong><?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id)) ? $ci->getRestaurantDetail($order->res_id)[0]->rest_reg_no : '-' : '-'; ?>
            	</div>
            	<hr class="new">
            	<?php $CartLists=json_decode($order->item_details, true); ?>
				<div style="width:100%;">
				    <div>
						<div style="width:60%; float:left;"><b>Items</b></div>
						<div style="width:13%; float:left; text-align:center;"><b>Qty</b></div>
						<div style="width:25%; float:left; text-align:right;"><b>Price</b></div>
				    </div>
				    <hr class="new">
				    <div style="padding-bottom:10px; font-size: 13px;">
						<?php $i=0; $subTotalAmount = 0; $totalQuantity = 0;
						foreach($CartLists as $itemId => $itemArray) : 
							foreach($itemArray as $itemDataId => $itemDataArray) :
								$taxName = [];
								$totalTaxPercentage = 0;
								if (!empty($itemDataArray['itemTaxes']))
								{
									foreach ($itemDataArray['itemTaxes'] as $itemTax)
									{
										$taxName[] = sprintf('%s (%s%s)',  $itemTax['taxName'],  $itemTax['taxPercentage'], '%');
										$totalTaxPercentage += $itemTax['taxPercentage'];
									}
								}

								$itemDiscountAmount = $itemDataArray['itemDiscountAmount'] ?? 0;

								$subTotalAmount += $itemDataArray['itemTotalAmount'];
								$totalQuantity += $itemDataArray['itemCount'];
								
								$itemTaxText = !empty($taxName) ? sprintf('<span style="font-size:9px;">%s ₹%s, </span>', implode(', ', $taxName), $itemDataArray['itemTotalTax']) : '';
								$itemDiscountText = $itemDiscountAmount > 0 ? sprintf('<span style="font-size:9px;">₹%s Off</span>', $itemDiscountAmount) : '';

								$itemNameWithDetails = sprintf('%s<br>%s%s', $itemDataArray['itemName'], $itemTaxText, $itemDiscountText);

						?>
    				        <div style="width:60%; float:left;"><?=$itemNameWithDetails?></div>
							<div style="width:13%; float:left; text-align:center;"><?=$itemDataArray['itemCount']?></div>
							<div style="width:25%; float:left; text-align:right;">₹ <?=$itemDataArray['itemTotalAmount']?></div>
						<?php  endforeach;
					    endforeach; ?>
				    </div>
				</div>
				<hr class="new">
				<div style="width:100%; font-size:13px;">
				    <div>
				        <div style="width:60%; float:left; text-align:left;"><strong>Total Qty: </strong></div>
				        <div style="width:13%; float:left; text-align:center;"><?= $totalQuantity ?></div>
				        <div style="width:25%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				    </div>
				</div>
				<div style="width:100%;font-size:13px;">
				    <div>
				        <div style="width:60%; float:left; text-align:left;"><strong>SubTotal: </strong></div>
				        <div style="width:13%; float:left; text-align:center;">&nbsp;&nbsp;</div>
				        <div style="width:25%; float:left; text-align:right;">₹ <?= $subTotalAmount ?></div>
				    </div>
				</div>
				<?php 
					if ($showTaxColumn)
					{ 
				?>
				<hr class="new">
				<div style="width:100%;">
					<?php foreach ($orderTaxes as $taxRow) {
						$taxAmount = round(($subTotalAmount * $taxRow['taxPercentage']) / 100, 2);
						$subTotalAmount += $taxAmount; 
					?>
				    <div>
				        <div style="width:60%; float:left; text-align:left;"><strong><?=sprintf("%s : %s%%", $taxRow['taxName'], $taxRow['taxPercentage'])?></strong></div>
				        <div style="width:13%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:25%; float:left; text-align:right;">₹ <?= $taxAmount ?></div>
					</div>
					<?php } ?>
				</div>
				<?php
					} 
				?>
				<hr class="new">
				<div style="width:100%;">
				    <div>
				        <div style="width:60%; float:left; text-align:right;"><strong>Total Amount : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:30%; float:left; text-align:right;">₹ <?= number_format($subTotalAmount, 2, '.', '') ?></div>
				    </div>
				    
				    <?php if(!empty($order->discount_coupon_percent)) {?>
				    <div>
				        <div style="width:60%; float:left; text-align:right;"><strong>Special Discount : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:30%; float:left; text-align:right;"> <?= $order->discount_coupon_percent;?> % </div>
				    </div>
				    <?php } ?>
				    
				    <?php if(!empty($order->flat_amount_discount)) {?>
				    <div>
				        <div style="width:60%; float:left; text-align:right;"><strong>Special Discount Flat Off: </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:30%; float:left; text-align:right;"> ₹ <?= $order->flat_amount_discount;?> </div>
				    </div>
				    <?php } ?>
				    
				    <div>
				        <div style="width:60%; float:left; text-align:right;"><strong>Total Billed : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:30%; float:left; text-align:right;">₹ <?= $order->total ?></div>
				    </div>
				</div>
				<?php /* ?>
				<br>
            	
            	<div style="padding-top:5px; text-align:center; font-size: 10px;">
					Customer Copy<br>
					*All PRICES ARE INCLUDING TAXES
				</div>
				<br>
				<br>
            	<div style="padding-top:3px; text-align:center;">
            	    <strong>Thank You, visit again!</strong>
            	</div>
            	<div style="padding-top:3px; text-align:center; font-size: 10px;">
            	    Powered by Fligobeam Networks
				</div>
				<?php */ ?>
				    <br>
					<div style="padding-bottom:10px; text-align:center; font-size: 10px;">
            	    <b>Customer Care Number : <?= ($order->res_id) ? ($ci->getRestaurantDetail($order->res_id) ? $ci->getRestaurantDetail($order->res_id)[0]->customer_care_number : '-') : '-'; ?></b>
            	</div>
            </div>
        </div>
        
    </div>
</body>
</html>


