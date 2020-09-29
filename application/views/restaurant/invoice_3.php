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
				        <div style="width:60%; float:left;"><b>Items</b></div>
				        <div style="width:13%; float:left;"><b>Qty</b></div>
				        <div style="width:25%; float:left;"><b>Price</b></div>
				    </div>
				    <hr class="new">
				    <div>
				        <?php $i=0; foreach($CartLists as $itemId => $itemArray) : 
						    foreach($itemArray as $itemDataId => $itemDataArray) :
						    ?>
    				        <div style="width:60%; float:left;">
								<?= $itemDataArray['itemName'] ?> (<?= $itemDataId ?>)
							</div>
    				        <div style="width:13%; float:left;">
								<?= $itemDataArray['itemCount'] ?>
							</div>
    				        <div style="width:25%; float:left;">
								₹ <?= $itemDataArray['itemCount'] * $itemDataArray['itemPrice'] ?>
							</div>
    				    <?php endforeach;
					    endforeach; ?>
				    </div>
				</div>
				<hr class="new">
				<div style="width:100%;">
				    <div>
				        <div style="width:63%; float:left; text-align:right;"><strong>Total Amount : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:25%; float:left;">₹ <?= $ci->cartTotal($CartLists) ?></div>
				    </div>
				    <?php $taxLists=$ci->getTaxList($order->res_id); if(!empty($taxLists)) :
        			     foreach($taxLists as $taxList): ?>
				    <div>
				        <div style="width:63%; float:left; text-align:right;"><strong style="padding-left:100px;"><?= $taxList->tax_type ?> &nbsp; (<?= $taxList->tax_percent ?>%) : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:25%; float:left;">₹ <?= $ci->cartTax($CartLists, $taxList->tax_percent) ?></div>
				    </div>
				    <?php endforeach; endif; ?>
				    <div>
				        <div style="width:63%; float:left; text-align:right;"><strong>Total Billed : </strong></div>
				        <div style="width:10%; float:left; text-align:right;">&nbsp;&nbsp;</div>
				        <div style="width:25%; float:left;">₹ <?= $ci->cartTotal($CartLists,'yes',$order->res_id) ?></div>
				    </div>
            	</div>
            	<div style="padding-top:5px; text-align:center; font-size: 10px;">
            	    Customer Copy
            	</div>
            	<div style="padding-top:3px; text-align:center;">
            	    <strong>Thank You, visit again!</strong>
            	</div>
            	<div style="padding-top:3px; text-align:center; font-size: 10px;">
            	    Powered by Fligobeam Networks
            	</div>
            </div>
        </div>
        
    </div>
</body>
</html>