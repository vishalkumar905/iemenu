<?php $this->load->view('self-billing/style'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="card " style="margin-top: 0px;">
			<form class="form-horizontal">
				<div class="card-header">
					
					<h4 class="card-title"><?= intval($this->input->get('id')) > 0 ? 'Add Items To Order' : 'Self Billing'?></h4>
				</div>
				<div class="card-content">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group label-floating">
								<label class="control-label">Customer Name</label>
									<input type="text" class="form-control" value="" name="customerName" id="customerName">
								<div id="nameError" class="text-danger displaynone" role="alert">
									<span aria-hidden="true"></span> Please enter customer name
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group label-floating">
								<label class="control-label">Mobile No</label>
									<input type="text" class="form-control" value="" name="mobieNumber" id="mobieNumber">
								<div id="mobileErr" class="text-danger displaynone" role="alert">
									<span aria-hidden="true"></span> Please enter mobile number
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group label-floating">
								<label class="control-label">Address</label>
								<input type="text" class="form-control" value="" name="address" id="address">
							</div>
						</div>
					</div>

					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="orderType" value="Delivery" checked="checked">Delivery
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="orderType" value="Take Away">Take Away
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="orderType" value="Dine-in">Dine In
									</label>
								</div>
							</div>
						</div>
					</div>
					

					</br></br>
					<table class="table" style="border: 1px solid #ccc;">
						<thead>
							<tr>
								<th colspan="7">
									<input type="text" style="width:100%"  id="item" placeholder="Search Items"/>
									<ul class= "list-group" id="suggestion"></ul>
								</th>
							</tr>
						</thead>
					</table>
					<div class="tableFixHead table-responsive customTableHead">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 5% !important;">#</th>
									<th>Item</th>
									<th>Item Type</th>
									<th>Special Note</th>
									<th>Qty.</th>
									<th>Price</th>
									<th style='width:200px !important;'>Discount</th>
									<th>Discount Amount</th>
									<th>Tax</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody id="menuItems">
								<div id="itemErr" class="text-danger displaynone" role="alert">
									<span aria-hidden="true"></span> Please select some item
								</div>
							</tbody>
						</table>
					</div>
					<div class="table-responsive customTableHead">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td colspan="3" class="text-right" >Total Qty.</td>
									<td class="text-right"><span id="totalQty">0</span></td>
									<td class="text-right">Sub Total</td>
									<td><span id="subTotal"></span></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">
										<div id="discountBox">
											<div>
												<label class='pr-10 pl-5 radio-label' style="color:#3C4858">Add Discount: </label>
												<label class='pr-10 pl-5 radio-label'><input type="radio" name="discount" value="percent" />Percent Off </label>
												<label class='pr-10 pl-5 radio-label'><input type="radio" name="discount" value="flat" />Amount </label>
											</div>
	
											<div class='displaynone' id="amountDiscountDiv">
												<label>Flat Amount Off: ₹</label>
												<input type="number" min="0" name="amountDiscount" id="amountDiscount" />
											</div>
	
											<div class='displaynone' id="percentDiscountDiv">
												<label>Select Coupon For % Off: ₹</label>
												<select name="percentDiscount" id="percentDiscount">
													<option value="">None Selected</option>
													<?php if (!empty($discountCoupons)) {
														foreach($discountCoupons as $discountCoupon)
														{
															echo sprintf('<option discount="%s" value="%s">%s</option>', $discountCoupon->discount_percent, $discountCoupon->discount_id, $discountCoupon->discount_name);
														}
													} ?>
												</select>
											</div>
											
											<div><button type="button" class='btn btn-sm btn-danger displaynone' id="addDiscount">Add Discount</button></div>
										</div>
										<div id="discountAppliedMessage"></div>
									</td>
									<td><span id="discountAmount"></span></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Total(&#x20B9;)</td>
									<td class="col-md-3"><span id="total"></span></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Delivery Charge</td>
									<td class="col-md-3"><input type="number" class="width60" min="0" value="0" id="deliveryCharge"></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Container Charge</td>
									<td class="col-md-3"><input type="number" class="width60" min="0"  value="0" id="containerCharge"></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Round off</td>
									<td class="col-md-3"><span id="roundOff"></span></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Grand Total (&#x20B9;)</td>
									<td class="col-md-3"><span id="grandTotal"></span></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Customer Paid</td>
									<td class="col-md-3"><input type="number" id="customerPaid" min="0" class="width60"></td>
								</tr>
								<tr>
									<td colspan="5" class="text-right">Return to Customer</td>
									<td class="col-md-3"><span id="customerReturn"></span></td>
								</tr>
								
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="partialPaymentMethods">
								</br>
								<div><b>Payment Pending: ₹<span id="pendingPaymentAmount">0</span></b></div>
								<div><b>Payment Collected: ₹<span id="collectedPaymentAmount">0</span></b></div>
								</br></br>
	

								<ul class="partialPaymentMethods">
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_CASH?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_CASH?>" class="partialPaymentMethodName">Cash</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_UPI?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_UPI?>" class="partialPaymentMethodName">UPI QR Scan</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_CARD?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_CARD?>" class="partialPaymentMethodName">Card Swipe</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_BTC?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_BTC?>" class="partialPaymentMethodName">BTC</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_SWIGGY?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_SWIGGY?>" class="partialPaymentMethodName">Swiggy</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_ZOMATO?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_ZOMATO?>" class="partialPaymentMethodName">Zomato</span>
									</li>
									<li>
										<span id="partialPaymentMethodAmount-<?=PAYEMENT_MODE_MAGIC_PIN?>" class="partialPaymentMethodAmount">0</span>
										<span data-value="<?=PAYEMENT_MODE_MAGIC_PIN?>" class="partialPaymentMethodName">Magic Pin</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="partialPaymentMethodsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-body">
			<h4 id="headTitle" class="mb-10"></h4>
			<input type="hidden" id="partialPaymentMethodType" />
			<div class="row mb-10">
				<div class="col-md-6">
					<div class="form-group">
						<label>Payment Collected</label>
						<label type="number" class="form-control" name="partialPaymentTotalCollected" id="partialPaymentTotalCollected">0</label>
					</div>
				</div>			
				<div class="col-md-6">
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control numericonly" name="partialPaymentAmount" id="partialPaymentAmount" min="0"/>
					</div>
				</div>
			</div>

			<div id="dynamicHtml"></div>

			<div class="row">
				<div class="col-md-12 mb-10">
					<button type="button" class="btn btn-success displaynone" id="addSplitPaymentBtn">Add</button>
					<button type="button" id="selfbilling" name="selfbilling" class="btn btn-rose">Confirm Order</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('/assets/js/jquery-3.1.1.min.js'); ?>" type="text/javascript"></script>

<script>
	var selectedMenuItems = {};
	var baseUrl = "<?= base_url()?>";
	var orderDiscountPercentage = 0;
	var orderFlatDiscount = 0;
	var orderDiscountDetail = {};
	var isDiscountApplied = false;
	var discountAppliedType = '', discountAppliedAmount = 0;
	var discountAmount = 0;
	var orderTotal = 0;
	var alreadyAppliedDiscount = <?=json_encode($discountAdded)?>;
	var updateId = <?=$updateId?>;
	var partialPaymentShowing = false;
	var partialPaymentMethodData = {};
	var collectedPaymentAmount = 0;

	let getMenuItems = function(searchText) {
		$.ajax({
			url: baseUrl + 'Selfbilling/getMenuItems',
			type: 'GET',
			data: {'search': searchText},
			success: function(response) 
			{
				let items = response.items;
				let data = [];

				for(i=0; i < items.length; i++)
				{
					data.push('<li class="list-group-item" id="items-'+ items[i].item_id +'" data-price="'+ items[i].price +'" data-menuid="'+ items[i].menu_id +'" data-itemType="'+ items[i].price_desc +'" data-tax=\''+ JSON.stringify(items[i].taxes) + '\' data-name="'+ items[i].name +'" >'+ items[i].name +'</li>');
				}
				$("#suggestion").html(data).show();

				$("#suggestion > li").click(addItem); 
			}
		})
	}

	$("#item").keyup(function(){
		let itemText = $("#item").val();
		if (itemText) 
		{
			getMenuItems(itemText);
		}
		else
		{
			$("#suggestion").hide();
		}
	});

	let addItem = function() {
		let id = $(this).attr("id").split("-");
			id= id[1];
		let itemName = $(this).attr("data-name");
		let price = $(this).attr("data-price");
		let menuId = $(this).attr("data-menuid");
		let taxes = $(this).attr("data-tax");
		let itemType = $(this).attr("data-itemType");
		let itemArray = itemType ? itemType.split(",") : [];
		let priceArray = price.split(",");
		let taxAmount = 0;
		let itemAmount = Number(priceArray[0]);
		let itemTotalAmount = itemAmount;
		let specialNote = $("input[name='item[note][" + id + "]']").val();
		let itemDiscountAmount = 0;

		if(selectedMenuItems[id]) 
		{
			return false;
		}

		selectedMenuItems[id] = {
			itemId: id,
			itemName: itemName,
			itemPrice: itemAmount,
			itemType: itemArray ? itemArray[0] : '',
			itemTax: taxAmount,
			itemQty: 1,
			itemTaxDetails:null,
			itemTotalAmount: itemTotalAmount,
			specialNote: specialNote,
			itemDiscountAmount,
			itemTotalDiscountAmount: 0,
			itemSubTotalAmount: itemTotalAmount
		}

		if(taxes != ("null" || ""))
		{
			let tax = JSON.parse(taxes);
			let itemTaxTotal = calculateItemTax(tax, itemAmount);
			
			taxAmount = itemTaxTotal;
			itemTotalAmount += itemTaxTotal;

			selectedMenuItems[id].itemTaxDetails = tax;
			selectedMenuItems[id].itemTax = itemTaxTotal;
			selectedMenuItems[id].itemTotalAmount = itemTotalAmount;
		}
		
		// mj input text value
		//  $("#item").val(itemName);
		$("#item").val('');
		$("#suggestion").hide();
		
		let selectBox = '';

		if (itemArray && itemArray.length > 0)
		{
			selectBox = "<select id='itemType' name='item[itemType]["+ id +"]'>"; 
			for(i=0; i < itemArray.length; i++) 
			{
				selectBox += "<option price='"+ priceArray[i] +"' itemid = '"+ id +"' value='"+ itemArray[i] +"'>"+ itemArray[i] +"</option>";
			}
			selectBox += "</select>";
		}

		let itemData = "";
			itemData += "<tr id='itemRow-"+ id +"'>";
			itemData += "<td class='width5'><span class='pointer' itemid='"+ id +"' id='removeItem-"+ id +"'><i class='material-icons cursor-pointer'>clear</i></span></td>";
			itemData += "<td>"+ itemName +" </td>";
			itemData += "<td>"+ selectBox +" </td>";
			itemData += "<td><input itemid='"+ id +"' type='text' style='width:100%'  name='item[note]["+ id +"]' placeholder='Special Note'/></td>";
			itemData += "<td><input type='number' min='1' value='1' itemid='"+ id +"' class='width60' name='item[qty]["+ id +"]'> </td>";
			itemData += "<td><span itemid='"+ id +"' id='item[price]["+ id +"]'> "+ priceArray[0] +" </span></td>";
			itemData += "<td style='width:200px !important;'>"+  itemDiscountInputFields(id) +"</td>";
			itemData += "<td><span itemid='"+ id +"' id='item[itemDiscountAmount]["+ id +"]'> "+ itemDiscountAmount +" </span></td>";
			itemData += "<td><span itemid='"+ id +"' id='item[tax]["+ id +"]'> "+ taxAmount +" </span></td>";
			itemData += "<td><span itemid='"+ id +"' id='item[totalPrice]["+ id +"]'> "+ itemTotalAmount +" </span></td>";
			itemData += "</tr>";

		$("#menuItems").append(itemData);
		
		calculateOrderTotal();

		if (isDiscountApplied)
		{
			calculateInvoiceDiscount();
			calculateItemDiscount(id);
		}

		$("select[name^='item[itemType]']").change(function() {
			
			let itemType = $(this).val();
			let selectedItem = $(this).find(':selected');
			let itemId = selectedItem.attr('itemid');
			let itemPrice = selectedItem.attr('price');
			let itemQty = $("input[name='item[qty]["+ itemId +"]']").val();
			let totalAmount = itemPrice * itemQty;

			$("span[id='item[price]["+ itemId +"]']").text(itemPrice);
			$("span[id='item[totalPrice]["+ itemId +"]']").text(totalAmount);

			selectedMenuItems[itemId].itemPrice = itemPrice;
			selectedMenuItems[itemId].itemType = itemType;
			selectedMenuItems[itemId].itemTotalAmount = totalAmount;

			calculateInvoiceDiscount();
			calculateItemDiscount(itemId);
			calculateOrderTotal();
		});

		$("input[name^='item[qty]']").on('keyup change', function() {
			let itemId = $(this).attr('itemid');
			let qty = $(this).val();
			let selectedItem = $("select[name='item[itemType]["+ itemId +"]']").find(':selected');
			let price = selectedItem.attr('price');
			let totalAmount = price * qty;
			
			$("span[id='item[totalPrice]["+ itemId +"]']").text(totalAmount);

			selectedMenuItems[itemId].itemQty = qty;
			selectedMenuItems[itemId].itemTotalAmount = totalAmount;
			
			calculateInvoiceDiscount();
			calculateItemDiscount(itemId);
			calculateOrderTotal();
		});

		$("input[name^='item[note]']").keyup(function() {
			let itemId = $(this).attr('itemid');
			selectedMenuItems[itemId].specialNote = $(this).val();
		});

		$("span[id^='removeItem-']").click(function() {
			let itemId = Number($(this).attr('itemid'));
			if (selectedMenuItems[itemId])
			{
				delete selectedMenuItems[itemId];
				calculateInvoiceDiscount();
				reCalculateInvoiceDiscountAndUpdateItemTotalDiscount();
				calculateOrderTotal();
				$("#itemRow-" + itemId).remove();
			}
		});

		$("select[name^='item[itemDiscountType]']").on('change', calculateItemDiscount);
		$("input[name^='item[itemDiscountValue]']").on('keyup change', calculateItemDiscount);
	};

	var calculateItemDiscount = function(itemId = null) 
	{
		if (itemId.target)
		{
			itemId = Number($(this).attr('itemid'));
		}
		else
		{
			itemId = Number(itemId);
		}

		if (itemId > 0)
		{
			let itemDiscountType = $("select[name='item[itemDiscountType]["+itemId+"]']").val();
			let itemDiscountValue = parseFloat($("input[name='item[itemDiscountValue]["+itemId+"]']").val()) || 0;
			let itemWiseDiscountApplied = selectedMenuItems[itemId].itemWiseDiscountApplied || false;
			let invoiceDiscount = selectedMenuItems[itemId].invoiceDiscount || false;
			let menuItemPriceDetail = getMenuItemPrice(itemId, true);
			let totalMenuItemPrice = menuItemPriceDetail.totalMenuItemPrice;
			let itemDiscountAmount = 0;

			if (itemDiscountValue > 0)
			{
				if (itemDiscountType == 'flat')
				{
					itemDiscountAmount = itemDiscountValue;
				}
				else if (itemDiscountType == 'percentage')
				{
					itemDiscountAmount = convertToDecimalIfNotAWholeNumber((totalMenuItemPrice * itemDiscountValue) / 100);
				}
				else
				{
					return false;
				}
	
				if (itemDiscountAmount > totalMenuItemPrice)
				{
					alert('Item price can not be in negative.');
					return false;
				}

				let itemTotalDiscountAmount = itemDiscountAmount;
				if (selectedMenuItems[itemId].invoiceDiscount)
				{
					itemTotalDiscountAmount += selectedMenuItems[itemId].invoiceDiscount.invoiceDiscountAmount;
					itemTotalDiscountAmount = convertToDecimalIfNotAWholeNumber(itemTotalDiscountAmount);
				}

				selectedMenuItems[itemId].itemWiseDiscountApplied = true;
				selectedMenuItems[itemId].itemDiscountType = itemDiscountType;
				selectedMenuItems[itemId].itemDiscountValue = itemDiscountValue;
				selectedMenuItems[itemId].itemDiscountAmount = itemDiscountAmount;
				selectedMenuItems[itemId].itemTotalDiscountAmount = itemTotalDiscountAmount;
				selectedMenuItems[itemId].itemTotalAmountWithoutDiscount = totalMenuItemPrice;

				let itemPriceAfterDiscount = totalMenuItemPrice - itemTotalDiscountAmount;
				let itemTaxAfterDiscount = convertToDecimalIfNotAWholeNumber(calculateItemTax(selectedMenuItems[itemId].itemTaxDetails, itemPriceAfterDiscount));

				selectedMenuItems[itemId].itemTotalAmount = convertToDecimalIfNotAWholeNumber(itemPriceAfterDiscount + itemTaxAfterDiscount);

				$("span[id='item[itemDiscountAmount]["+itemId+"]']").html(itemTotalDiscountAmount);
				$("span[id='item[totalPrice]["+itemId+"]']").html(selectedMenuItems[itemId].itemTotalAmount);

				calculateOrderTotal();
			}
			else if ((itemWiseDiscountApplied || (invoiceDiscount || invoiceDiscount == false)) && itemDiscountValue == 0)
			{
				delete selectedMenuItems[itemId].itemDiscountType;
				delete selectedMenuItems[itemId].itemDiscountValue;

				let itemTotalDiscountAmount = 0;
				
				if (invoiceDiscount)
				{
					itemTotalDiscountAmount = convertToDecimalIfNotAWholeNumber(invoiceDiscount.invoiceDiscountAmount);
				}

				selectedMenuItems[itemId].itemDiscountAmount = 0;
				selectedMenuItems[itemId].itemWiseDiscountApplied = false;
				selectedMenuItems[itemId].itemTotalDiscountAmount = itemTotalDiscountAmount;
				selectedMenuItems[itemId].itemTotalAmount = menuItemPriceDetail.itemTotalAmount;
	
				$("span[id='item[itemDiscountAmount]["+itemId+"]']").html(itemTotalDiscountAmount);
				$("span[id='item[totalPrice]["+itemId+"]']").html(selectedMenuItems[itemId].itemTotalAmount);

				calculateOrderTotal();
			}
		}
	};

	var itemDiscountInputFields = function(itemId)
	{
		return `<div>
			<select class='pt-3 pb-3' itemid="${itemId}" name="item[itemDiscountType][${itemId}]">
				<option value="">Select Discount</option>
				<option value="flat">Flat</option>
				<option value="percentage">Percentage</option>
			</select>
			<input type='number' min='0' class='width30' itemid="${itemId}" name='item[itemDiscountValue][${itemId}]' value='0'/>
		</div>`;
	};

	var calculateItemTax = function(taxes, itemPrice) {
		let taxAmount = 0;
		if(taxes && typeof taxes == 'object')
		{
			taxes.forEach(function(tax) {
				taxAmount += ((Number(tax.taxPercentage) * Number(itemPrice)) / 100);  
			});    
		}

		taxAmount = convertToDecimalIfNotAWholeNumber(taxAmount);
		
		return taxAmount;
	};

	var getTotalItemPrice = function() {
		let totalItemsPrice = 0;

		for(let itemId in selectedMenuItems)
		{
			totalItemsPrice += getMenuItemPrice(itemId);
		}

		return convertToDecimalIfNotAWholeNumber(totalItemsPrice);
	};
	
	var getAllItemAmountSum = function() {

		let itemSubTotalAmount = 0, totalMenuItemPrice = 0, menuItemTax = 0, menuItemTotalPrice = 0, itemSubTotalAmountAfterItemWiseDiscount = 0;

		for(let itemId in selectedMenuItems)
		{
			let menuItemPriceDetail = getMenuItemPrice(itemId, true);

			menuItemTax += menuItemPriceDetail.menuItemTax;
			itemSubTotalAmount += menuItemPriceDetail.itemSubTotalAmount;
			totalMenuItemPrice += menuItemPriceDetail.totalMenuItemPrice;
			menuItemTotalPrice += menuItemPriceDetail.menuItemTotalPrice;
			itemSubTotalAmountAfterItemWiseDiscount += menuItemPriceDetail.itemSubTotalAmountAfterItemWiseDiscount;
		}

		return {
			menuItemTax: convertToDecimalIfNotAWholeNumber(menuItemTax),
			itemSubTotalAmount: convertToDecimalIfNotAWholeNumber(itemSubTotalAmount),
			totalMenuItemPrice: convertToDecimalIfNotAWholeNumber(totalMenuItemPrice),
			menuItemTotalPrice: convertToDecimalIfNotAWholeNumber(menuItemTotalPrice),
			itemSubTotalAmountAfterItemWiseDiscount: convertToDecimalIfNotAWholeNumber(itemSubTotalAmountAfterItemWiseDiscount),
		};
	};
	

	var getMenuItemPrice = function(itemId, itemDetail = false) 
	{
		let itemPrice = 0;

		let menuItem = selectedMenuItems[itemId];
		if (menuItem.invoiceDiscount && !isDiscountApplied)
		{
			delete selectedMenuItems[itemId].invoiceDiscount;
		}

		let menuItemPrice = parseFloat(menuItem.itemPrice);
		let menuItemQty = Number(menuItem.itemQty);
		let totalMenuItemPrice = parseFloat(menuItemPrice * menuItemQty);
		let itemSubTotalAmountAfterItemWiseDiscount = convertToDecimalIfNotAWholeNumber(totalMenuItemPrice - menuItem.itemDiscountAmount);
		let menuItemPriceAfterDiscount = convertToDecimalIfNotAWholeNumber(totalMenuItemPrice - menuItem.itemTotalDiscountAmount);
		let menuItemTax = convertToDecimalIfNotAWholeNumber(calculateItemTax(menuItem.itemTaxDetails, menuItemPriceAfterDiscount));
		let menuItemTotalPrice = menuItemTax + menuItemPriceAfterDiscount;

		selectedMenuItems[itemId].itemSubTotalAmount = menuItemPriceAfterDiscount;

		if (itemDetail)
		{
			return {
				menuItemPrice,
				totalMenuItemPrice,
				menuItemTax,
				menuItemTotalPrice,
				menuItemQty,
				itemSubTotalAmountAfterItemWiseDiscount,
				itemSubTotalAmount: menuItemPriceAfterDiscount,
			};
		}

		return menuItemTotalPrice;
	};

	var calculateOrderTotal = function() {
		let totalQty = 0;
		let totalTax = 0;
		let deliveryCharge = Number($("#deliveryCharge").val());
		let containerCharge = Number($("#containerCharge").val());
		let customerPaid = Number($("#customerPaid").val());
		
		for(let item in selectedMenuItems)
		{
			let menuItem = selectedMenuItems[item];
			let menuItemPriceData = getMenuItemPrice(item, true);
			let menuItemTax = menuItemPriceData.menuItemTax;
			let menuItemTotalPrice = convertToDecimalIfNotAWholeNumber(menuItemPriceData.menuItemTotalPrice);
			
			$("span[id='item[tax]["+ menuItem.itemId +"]']").text(menuItemPriceData.menuItemTax);
			$("span[id='item[totalPrice]["+ menuItem.itemId +"]']").text(menuItemTotalPrice);
			
			selectedMenuItems[menuItem.itemId].itemTax = menuItemTax;
			selectedMenuItems[menuItem.itemId].itemTotalAmount = menuItemTotalPrice;

			totalQty = totalQty + Number(menuItem.itemQty);
		}
		
		let totalItemsPrice = getTotalItemPrice();
		let subTotal = totalItemsPrice;
		let totalOrder = totalItemsPrice;
		let totalOrderAmount = (totalItemsPrice + deliveryCharge + containerCharge);

		if (isDiscountApplied)
		{
			let totalDiscount = convertToDecimalIfNotAWholeNumber(calculateDiscount(discountAppliedType, discountAppliedAmount));

			if (totalDiscount > 0)
			{
				showDiscountApplied();

				$("#discountAmount").text(totalDiscount);
			}

			// totalOrder = convertToDecimalIfNotAWholeNumber(totalOrder - totalDiscount);
			// totalOrderAmount = totalOrderAmount - totalDiscount;			
		}

		orderTotal = totalOrderAmount;

		let roundOff = Math.round(totalOrderAmount);

		if(customerPaid != "")
		{
			let returnToCustomer = customerPaid - roundOff;
			$("#customerReturn").text(returnToCustomer);
		}
		else 
		{
			$("#customerReturn").text("");
		}


		$("#subTotal").text(subTotal);
		$("#total").text(totalOrder);
		$("#totalQty").text(totalQty);
		$("#roundOff").text(roundOff);
		$("#grandTotal, #pendingPaymentAmount").text(roundOff);
	};

	$("#deliveryCharge").on('keyup, change', calculateOrderTotal);
	$("#containerCharge").on('keyup, change', calculateOrderTotal);

	$("#customerPaid").keyup(calculateOrderTotal); 

	$('input:radio[name="discount"]').change(function() {
		let discountType = $(this).val();

		$("#percentDiscountDiv, #amountDiscountDiv").hide();

		if (discountType == 'percent')
		{
			$("#percentDiscountDiv").show();
		}

		if (discountType == 'flat')
		{
			$("#amountDiscountDiv").show();
		}

		$("#addDiscount").show();
	});

	var calculateInvoiceDiscount = function()
	{	
		if (isDiscountApplied)
		{
			let orderTotal = getAllItemAmountSum().itemSubTotalAmount;
			let orderDiscountPercentage = 0; 
			let orderDiscountAmount = discountAppliedAmount;
	
			if (!isNaN(orderDiscountAmount) && orderDiscountAmount > 0)
			{
				if (discountAppliedType == 'flat')
				{
					orderDiscountPercentage = convertToDecimalIfNotAWholeNumber((orderDiscountAmount * 100) / orderTotal); 
				}
				else
				{
					let totalDiscount = convertToDecimalIfNotAWholeNumber(calculateDiscount(discountAppliedType, discountAppliedAmount));

					orderDiscountPercentage = convertToDecimalIfNotAWholeNumber((totalDiscount * 100) / orderTotal); 
				}
			}

			if (orderDiscountPercentage > 0)
			{
				for(let itemId in selectedMenuItems)
				{
					let itemSubTotalAmount = selectedMenuItems[itemId].itemSubTotalAmount;
					let invoiceDiscountAmount = convertToDecimalIfNotAWholeNumber((itemSubTotalAmount * orderDiscountPercentage) / 100);
					let itemSubTotalAmountAfterInvoiceDiscount = convertToDecimalIfNotAWholeNumber(itemSubTotalAmount - invoiceDiscountAmount);
					let itemTaxAfterInvoiceDiscount = calculateItemTax(selectedMenuItems[itemId].itemTaxDetails , itemSubTotalAmountAfterInvoiceDiscount);
	
					let invoiceDiscount = {
						invoiceDiscountAmount,
						invoiceDiscountType: discountAppliedType,
						invoiceDiscountPercentage: orderDiscountPercentage,
						itemTaxAfterInvoiceDiscount,
						itemSubTotalAmountAfterInvoiceDiscount,
					};
	
					selectedMenuItems[itemId].invoiceDiscount = invoiceDiscount;

					calculateItemDiscount(itemId);
				}
			}
		}
	}

	var setDiscountOnUpdate = function() {
		if (updateId > 0 && alreadyAppliedDiscount.isApplied)
		{
			isDiscountApplied = true;

			if (alreadyAppliedDiscount.discountPercentage > 0)
			{
				discountAppliedType = 'percent';
				discountAppliedAmount = parseFloat(alreadyAppliedDiscount.discountPercentage);   
			}
			else if (alreadyAppliedDiscount.flatDiscount > 0)
			{
				discountAppliedType = 'flat';
				discountAppliedAmount = parseFloat(alreadyAppliedDiscount.flatDiscount); 
			}
		}
	};

	setDiscountOnUpdate();

	$("#addDiscount").click(function() {
		let selectedDiscountType = $('input:radio[name="discount"]:checked').val();
		let discountPercentage = parseFloat($("#percentDiscount option:selected").attr('discount'));
		let flatDiscount = parseFloat($("#amountDiscount").val()); 

		discountAppliedType = selectedDiscountType;
		discountAppliedAmount = (selectedDiscountType == 'percent') ? discountPercentage : flatDiscount;
		isDiscountApplied = true;

		calculateInvoiceDiscount();
		reCalculateInvoiceDiscountAndUpdateItemTotalDiscount();
		calculateOrderTotal();
	});

	var reCalculateInvoiceDiscountAndUpdateItemTotalDiscount = function()
	{
		for(let itemId in selectedMenuItems)
		{
			calculateItemDiscount(itemId);
		}
	}

	var calculateDiscount = function(discountType, discountAmount) {
		let subTotalAmount = getAllItemAmountSum().itemSubTotalAmountAfterItemWiseDiscount;

		if (isNaN(subTotalAmount) || subTotalAmount == 0)
		{
			return 0;
		}

		if (!isNaN(discountAmount) && discountAmount > 0)
		{
			if (discountType == 'percent')
			{
				return (subTotalAmount * discountAmount) / 100;
			}
			else if (discountType == 'flat')
			{
				return discountAmount;
			}
		}

		return 0;
	}

	var showDiscountApplied = function()
	{
		if (isDiscountApplied)
		{
			$("#discountBox").hide();

			let discountAppliedHtml = '<span>Discount Applied: </span><span id="removeDiscount" style="cursor:pointer;text-decoration:underline;color:blue;">Remove Discount</span>';

			$("#discountAppliedMessage").html(discountAppliedHtml);

			$("#removeDiscount").click(function() {
				// While updating items to order : Remove discount is not allowed.
				if (updateId == 0)
				{
					$("#discountBox").show();
					
					resetDiscountData();
					
					for(let itemId in selectedMenuItems)
					{
						if (selectedMenuItems[itemId].invoiceDiscount)
						{
							delete selectedMenuItems[itemId].invoiceDiscount;
						}

						calculateItemDiscount(itemId);
					}

					calculateOrderTotal();
				}
			});
		}
	}

	var resetDiscountData = function()
	{
		$('input:radio[name=discount]').each(function () { $(this).prop('checked', false); });
		$("#amountDiscount").val('');
		$("#percentDiscount").val('');
		$("#discountAmount").text('');
		$("#discountAppliedMessage").html('');
		$("#amountDiscountDiv, #percentDiscountDiv, #addDiscount").hide();
		$("#discountBox").show();

		discountAppliedType = '',
		discountAppliedAmount = 0,
		orderDiscountDetail = {};
		isDiscountApplied = false;
		discountAmount = 0;
	}

	$('input:radio[name="paymentType"]').change(function(){
		$("#TransictionIdField").hide();
		
		if (this.value == '1') 
		{
			$("#customerPaid").attr('disabled', false);
		}
		else
		{
			
		}

		if (this.checked && this.value == '4') {
			$("#TransictionIdField").show();
		}
	});

	var placeOrder = function() {
		let queryString = window.location.search;
		let urlParams = new URLSearchParams(queryString);
		let orderId = urlParams.get('id');

		let customerName = $("#customerName").val();
		let address = $("#address").val();
		let mobieNumber = $("#mobieNumber").val();
		let orderType = $("input[name='orderType']:checked").val();
		let paymentType = $("input[name='paymentType']:checked").val();
		let transactionId = $("#transactionId").val();
		let grandTotal = $("#grandTotal").text();
		let deliveryCharge = $("#deliveryCharge").val();
		let containerCharge = $("#containerCharge").val();
		let customerPaid = $("#customerPaid").val();

		$("#nameError, #addressErr, #mobileErr, #itemErr, #paymentError").hide();

		if(customerName == "")
		{
			$("#nameError").show();
			return;
		}

		if(mobieNumber == "")
		{
			$("#mobileErr").show();
			return;
		}

		if(jQuery.isEmptyObject(selectedMenuItems))
		{
			$("#itemErr").show();
			return;
		}
		
		if(paymentType == "4" && transactionId == "")
		{
			$("#paymentError").show();
			return;
		}

		// Check full payment amount is applied
		if (getTotalSplitedPaymentMethodAppliedAmount() != grandTotal)
		{
			alert('Please add total collected amount');
			return false;
		}

		let data = {
			id: orderId,
			customerName: customerName,
			address: address,
			mobile: mobieNumber,
			orderType: orderType,
			paymentType: paymentType,
			grandTotal: grandTotal,
			orderTotal: orderTotal,
			transactionId: transactionId,
			selectedItem: selectedMenuItems,
			deliveryCharge,
			containerCharge,
			customerPaid,
			discountAppliedType,
			discountAppliedAmount,
			orderDiscountDetail,
			isDiscountApplied,
			partialPaymentMethodData,
			isPartialPaymentMethodSelected: true,
		};

		$("#selfbilling").attr('disabled', true);

		let apiUrl = baseUrl + (parseInt(orderId) > 0 ? 'Selfbilling/updateSelfBilling' : 'Selfbilling/saveSelfBilling'); 

		$.ajax({
			url: apiUrl,
			type: "POST",
			data: data,
			cache: false,
			success: function(response) {
				$("#selfbilling").attr('disabled', false);

				if(response.status == "success")
				{
					swal(response.msg, {
						icon: "success",
					}).then((value) => {
						resetFormData();
					});

					$("#partialPaymentMethodsModal").modal("hide");
					$('#datatables').DataTable().ajax.reload();

					if (parseInt(orderId) > 0) 
					{
						window.location.href = baseUrl + 'Restaurant/orderlist';
					}
				}
			}
		});
	};
	
	var resetFormData = function() 
	{
		let inputFieldElementIds = ["#customerName", "#address", "#mobieNumber"];

		inputFieldElementIds.forEach(function(row) {
			let element = $(row);
			if (element.length > 0 && element.parent().hasClass('form-group'))
			{
				element.parent().addClass('form-group label-floating is-empty');
				element.val('');
			}
		});

		$("#transactionId").val('');
		$("#subTotal").text('');
		$("#roundOff").text('');
		$("#total").text('');
		$("#totalQty").text(0);
		$("#grandTotal").text(0);
		$("#pendingPaymentAmount").text(0);
		$("#deliveryCharge").val(0);
		$("#containerCharge").val(0);
		$("#customerPaid").val('');
		$("#menuItems").html('');
		$("#item").val('');
		$("#specialNote").val('');
		$("#customerReturn").text('');

		resetDiscountData();
		resetPartialPaymentMethod();
		selectedMenuItems = {};
	};

	var convertToDecimalIfNotAWholeNumber = function(num)
	{
		return Number(num % 1 != 0 ? num.toFixed(2) : num);
	}
	
	let queryParams = 'id';
	let url = window.location.href;
	if(url.indexOf('?' + queryParams + '=') != -1)
	{
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		const id = urlParams.get('id');
		
		$.ajax({
			url: "<?= base_url('Selfbilling/getOrderId/')?>" + id,
			type: 'GET',
			data: {'id':id},
			dataType: 'json',
			success: function(data) {
				$("#customerName").val(data[0].buyer_name);
				$("#mobieNumber").val(data[0].buyer_phone_number);
				$("#address").val(data[0].buyer_address);
				$('input[name="orderType"][value="' + data[0].order_type + '"]').prop('checked', true);
			}     
		})
		
	}

	$("#cancelBilling").click(function() {
		window.location = "<?= base_url('Restaurant/orderlist')?>"
	});


	// Partial Payments
	
	var orderTotalAmount = parseFloat($("#grandTotal").text()), totalSplitPaymentCollectedAmount = 0;
	var PAYEMENT_MODE_CASH = "<?=PAYEMENT_MODE_CASH?>";
	var PAYEMENT_MODE_ONLINE = "<?=PAYEMENT_MODE_ONLINE?>";
	var PAYEMENT_MODE_UPI = "<?=PAYEMENT_MODE_UPI?>";
	var PAYEMENT_MODE_CARD = "<?=PAYEMENT_MODE_CARD?>";
	var PAYEMENT_MODE_BTC = "<?=PAYEMENT_MODE_BTC?>";
	var PAYEMENT_MODE_SWIGGY = "<?=PAYEMENT_MODE_SWIGGY?>";
	var PAYEMENT_MODE_ZOMATO = "<?=PAYEMENT_MODE_ZOMATO?>";
	var PAYEMENT_MODE_MAGIC_PIN = "<?=PAYEMENT_MODE_MAGIC_PIN?>";

	var allPaymentMethodList = [
		PAYEMENT_MODE_CASH,
		PAYEMENT_MODE_ONLINE,
		PAYEMENT_MODE_UPI,
		PAYEMENT_MODE_CARD,
		PAYEMENT_MODE_BTC,
		PAYEMENT_MODE_ZOMATO,
		PAYEMENT_MODE_SWIGGY,
		PAYEMENT_MODE_MAGIC_PIN,
	];

	$("ul.partialPaymentMethods li .partialPaymentMethodName").click(function() {
		orderTotalAmount = parseFloat($("#grandTotal").text());

		if (isNaN(orderTotalAmount))
		{
			return false;
		}

		let selectedMethodValue = parseInt($(this).attr("data-value"));
		let totalCollectedPaymentAmount = getTotalSplitedPaymentMethodAppliedAmount();

		$("#dynamicHtml").html('');
		$("#partialPaymentMethodType").val(selectedMethodValue);
		$("#partialPaymentTotalCollected, #collectedPaymentAmount").text(getTotalSplitedPaymentMethodAppliedAmount());

		let pendingPaymentAmount = orderTotalAmount - collectedPaymentAmount;

		$("#partialPaymentAmount").val(pendingPaymentAmount);

		if (selectedMethodValue == PAYEMENT_MODE_CARD)
		{
			$("#dynamicHtml").html(`<div class="row mb-10">
				<div class="col-md-6">
					<div class="form-group">
						<label>Transaction Id</label>
						<input type="text" class="form-control" name="partialPaymentTransactionId" id="partialPaymentTransactionId"/>
					</div>
				</div>
			</div>`);
		}

		if (partialPaymentMethodData[selectedMethodValue])
		{
			if (selectedMethodValue == PAYEMENT_MODE_CARD && partialPaymentMethodData[selectedMethodValue].partialPaymentTransactionId)
			{
				$("#partialPaymentTransactionId").val(partialPaymentMethodData[selectedMethodValue].partialPaymentTransactionId);
			}
			
			$("#partialPaymentAmount").val(partialPaymentMethodData[selectedMethodValue].partialPaymentAmount);
		}

		$("#addSplitPaymentBtn").hide();
		$("#selfbilling").show();

		$("#partialPaymentMethodsModal #headTitle").text($(this).text());
		$("#partialPaymentMethodsModal").modal('show');
	});

	var addPartialPaymentForOrder = function() {
		let partialPaymentAmount = parseFloat($("#partialPaymentAmount").val());
		let partialPaymentMethodType = $("#partialPaymentMethodType").val();
		let partialPaymentMethodTypeName = $("#partialPaymentMethodsModal #headTitle").text();
		let partialPaymentTransactionId = $("#partialPaymentTransactionId").val() ?? '';

		if (partialPaymentAmount > 0)
		{
			let partialPaymentMethodObject = {
				partialPaymentMethodType,
				partialPaymentMethodTypeName,
				partialPaymentAmount
			}

			if (partialPaymentTransactionId)
			{
				partialPaymentMethodObject.partialPaymentTransactionId = partialPaymentTransactionId; 
			}
			else if (partialPaymentMethodType == PAYEMENT_MODE_CARD)
			{
				alert('Please enter transaction id.');
				return false;
			}

			partialPaymentMethodData[partialPaymentMethodType] = partialPaymentMethodObject;

			collectedPaymentAmount = getTotalSplitedPaymentMethodAppliedAmount();
			$("#partialPaymentTotalCollected, #totalOrderAmount, #collectedPaymentAmount").text(getTotalSplitedPaymentMethodAppliedAmount());
			$("#partialPaymentMethodsModal").modal("hide");
			$("#partialPaymentMethodSummary").html(getSplitPaymentMethodSummary());
			showSpitPaymentMethodSummary();
		}
	};

	$("#addSplitPaymentBtn").click(addPartialPaymentForOrder);

	$("#partialPaymentAmount").keyup(function() {

		let partialedPaymentMethodTotalAmount = getTotalSplitedPaymentMethodAppliedAmount();
		let partialPaymentAmount = parseFloat($(this).val()) || 0;
		let partialPaymentAmountMax = orderTotalAmount - partialedPaymentMethodTotalAmount;
		let partialPaymentMethodType = parseInt($("#partialPaymentMethodType").val());

		if (partialPaymentMethodData[partialPaymentMethodType])
		{
			partialPaymentAmountMax = partialPaymentAmountMax - partialPaymentMethodData[partialPaymentMethodType].partialPaymentAmount
		}

		let showConfirmOrderBtn = false;

		if ((partialedPaymentMethodTotalAmount + partialPaymentAmount) > orderTotalAmount)
		{
			$("#partialPaymentAmount").val(partialPaymentAmountMax);
			showConfirmOrderBtn = true;
		}

		if (showConfirmOrderBtn)
		{
			$("#addSplitPaymentBtn").hide();
			$("#selfbilling").show();
		}
		else
		{
			if (partialPaymentAmountMax > partialPaymentAmount)
			{
				$("#addSplitPaymentBtn").show();
				$("#selfbilling").hide();
			}
			else if (partialPaymentAmountMax == partialPaymentAmount)
			{
				$("#addSplitPaymentBtn").hide();
				$("#selfbilling").show();
			}
		}
	});

	$(function() { // let all dom elements are loaded
		$('#partialPaymentMethodsModal').on('hidden.bs.modal', function (e) {
			$("#partialPaymentAmount").val('');
		});
	});

	let getTotalSplitedPaymentMethodAppliedAmount = function() {

		let totalAmount = 0;

		if (partialPaymentMethodData)
		{
			for(i in partialPaymentMethodData)
			{
				totalAmount += partialPaymentMethodData[i].partialPaymentAmount;
			}
		}

		return totalAmount;
	};

	let getSplitPaymentMethodSummary = function() {
		let html = '';

		if (partialPaymentMethodData)
		{
			let singlePaymentSummary = '';

			for (i in partialPaymentMethodData)
			{
				let row = partialPaymentMethodData[i];
				singlePaymentSummary += `<li>₹${row.partialPaymentAmount} ${row.partialPaymentMethodTypeName} <span class='removeSplitPaymentMethod' data-partialPaymentMethodType="${i}">X</span></li>`
			}


			if (singlePaymentSummary)
			{
				html = `<ul>${singlePaymentSummary}</ul>`;
			}
		}
		return html;
	};

	let showSpitPaymentMethodSummary = function() {

		if (partialPaymentMethodData)
		{
			for (i in partialPaymentMethodData)
			{
				let row = partialPaymentMethodData[i];
				let partialPaymentMethodAmountHtml = row.partialPaymentAmount > 0 ? `${row.partialPaymentAmount} <span class='removeSplitPaymentMethod' data-partialPaymentMethodType="${i}">X</span>` : 0;
				
				$("#partialPaymentMethodAmount-" + row.partialPaymentMethodType).html(partialPaymentMethodAmountHtml);
			}
		}
	};

	let updatePaymentCollected = function() {
		$("#partialPaymentTotalCollected, #collectedPaymentAmount").text(getTotalSplitedPaymentMethodAppliedAmount());
		collectedPaymentAmount = getTotalSplitedPaymentMethodAppliedAmount();
	};

	$("ul.partialPaymentMethods").on("click", ".removeSplitPaymentMethod", function() {
		let partialPaymentMethodType = parseInt($(this).attr('data-partialPaymentMethodType'));
		
		if (partialPaymentMethodData[partialPaymentMethodType])
		{
			delete partialPaymentMethodData[partialPaymentMethodType];
			$("#partialPaymentMethodAmount-" + partialPaymentMethodType).text(0);
		}

		showSpitPaymentMethodSummary();
		updatePaymentCollected();
	});

	$("#viewPartialPaymentMethods").click(function() {
		$("#singlePaymentMethods").hide();
		$("#partialPaymentMethods").show();
	});

	$("#showSinglePaymentMethod").click(function() {
		$("#singlePaymentMethods").show();
		$("#partialPaymentMethods").hide();
		partialPaymentMethodData = {};
		$("#totalOrderAmount").text(0);
		$("#partialPaymentMethodSummary").html('');
	});

	var getSelectedPaymentMethod = function() {
		if (!$("#singlePaymentMethods").is(":hidden"))
		{
			return 'singlePaymentMethod';
		}
		else if (!$("#partialPaymentMethods").is(":hidden"))
		{
			return 'partialPaymentMethod';
		}

		return '';
	}

	var resetPartialPaymentMethod = function() {
		partialPaymentMethodData = {};
		collectedPaymentAmount = 0;

		$("#totalOrderAmount, #collectedPaymentAmount").text(0);
		$("#partialPaymentMethodSummary").html('');

		resetSpitPaymentMethodSummary();
		showSpitPaymentMethodSummary();
	}

	var resetSpitPaymentMethodSummary = function() {
		allPaymentMethodList.forEach(function(partialPaymentMethodType) {
			$("#partialPaymentMethodAmount-" + partialPaymentMethodType).text(0);
		});
	};

	$("#selfbilling").click(function() {
		addPartialPaymentForOrder();
		placeOrder();
	});

</script>
