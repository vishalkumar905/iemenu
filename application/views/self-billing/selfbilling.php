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
					<div class="table-container">
						<table>
							<thead>
								<tr>
									<th colspan="7">
										<input type="text" style="width:100%"  id="item" placeholder="Search Items"/>
										<ul class= "list-group" id="suggestion"></ul>
									</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th style="width: 5% !important;">#</th>
									<th>Item</th>
									<th>Item Type</th>
									<th>Special Note</th>
									<th>Qty.</th>
									<th>Price</th>
									<th>Tax</th>
									<th style='width:200px !important;'>Discount</th>
									<th>Discount Amount</th>
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
												<!--<label class='pr-10 pl-5 radio-label'><input type="radio" name="discount" value="flat" />Amount </label>-->
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
						<div class="col-md-6">
							<div class="form-group">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="paymentType" value="1" checked="checked">Cash 
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="paymentType" value="3">UPI QR Scan
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="paymentType" value="4">Card Swipe
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="paymentType" value="5">BTC
									</label>
								</div>
								<div class="displaynone" id="TransictionIdField">
									<p>Transaction Id (If swiped by card)</p>
									<input type="text" id="transictionId" placeholder="Enter by cashier" class="form-control">
								</div>
							</div>
							<div id="paymentError" class="text-danger displaynone" role="alert">
								<span aria-hidden="true"></span> Please input transiction id
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group label-floating">
								<?php
									if(isset($_GET['id']))
									{
										echo '<button type="button" id="cancelBilling" name="cancelBilling" class="btn btn-warning pull-right">Cancel</button>';
										echo '<button type="button" id="updateBilling" name="updateBilling" class="btn btn-rose pull-right">Update Order</button>';

									}
									else
									{
										echo '<button type="button" id="selfbilling" name="selfbilling" class="btn btn-rose pull-right">Confirm Order</button>';
									}                
								?>
							</div>
						</div>
					</div>
				</div>
			</form>
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
			itemDiscountAmount
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
			itemData += "<td><span itemid='"+ id +"' id='item[tax]["+ id +"]'> "+ taxAmount +" </span></td>";
			itemData += "<td style='width:200px !important;'>"+  itemDiscountInputFields(id) +"</td>";
			itemData += "<td><span itemid='"+ id +"' id='item[itemDiscountAmount]["+ id +"]'> "+ itemDiscountAmount +" </span></td>";
			itemData += "<td><span itemid='"+ id +"' id='item[totalPrice]["+ id +"]'> "+ itemTotalAmount +" </span></td>";
			itemData += "</tr>";

		$("#menuItems").append(itemData);
		
		calculateOrderTotal();

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
				calculateOrderTotal();
				$("#itemRow-" + itemId).remove();
			}
		});

		$("select[name^='item[itemDiscountType]']").on('change', calculateItemDiscount);
		$("input[name^='item[itemDiscountValue]']").on('keyup change', calculateItemDiscount);
	};

	var calculateItemDiscount = function() 
	{
		let itemId = Number($(this).attr('itemid'));
		if (itemId > 0)
		{
			let itemDiscountType = $("select[name='item[itemDiscountType]["+itemId+"]']").val();
			let itemDiscountValue = parseFloat($("input[name='item[itemDiscountValue]["+itemId+"]']").val()) || 0;
			let itemDiscountApplied = selectedMenuItems[itemId].itemDiscountApplied || false;
			let itemTotalAmount = itemDiscountApplied ? selectedMenuItems[itemId].itemTotalAmountWithoutDiscount : selectedMenuItems[itemId].itemTotalAmount;
			let itemDiscountAmount = 0;

			if (itemDiscountValue > 0)
			{
				if (itemDiscountType == 'flat')
				{
					itemDiscountAmount = itemDiscountValue;
				}
				else if (itemDiscountType == 'percentage')
				{
					itemDiscountAmount = convertToDecimalIfNotAWholeNumber((itemTotalAmount * itemDiscountValue) / 100);
				}
				else
				{
					return false;
				}
	
				if (itemDiscountAmount > itemTotalAmount)
				{
					alert('Item price can not be in negative.');
					return false;
				}

				selectedMenuItems[itemId].itemDiscountApplied = true;
				selectedMenuItems[itemId].itemDiscountType = itemDiscountType;
				selectedMenuItems[itemId].itemDiscountValue = itemDiscountValue;
				selectedMenuItems[itemId].itemDiscountAmount = itemDiscountAmount;
				selectedMenuItems[itemId].itemTotalAmountWithoutDiscount = itemTotalAmount;
				selectedMenuItems[itemId].itemTotalAmount = convertToDecimalIfNotAWholeNumber(itemTotalAmount - itemDiscountAmount);
	
				$("span[id='item[itemDiscountAmount]["+itemId+"]']").html(itemDiscountAmount);
				$("span[id='item[totalPrice]["+itemId+"]']").html(selectedMenuItems[itemId].itemTotalAmount);

				calculateOrderTotal();
			}
			else if (itemDiscountApplied && itemDiscountValue == 0)
			{
				delete selectedMenuItems[itemId].itemDiscountType;
				delete selectedMenuItems[itemId].itemDiscountValue;
				
				selectedMenuItems[itemId].itemDiscountAmount = 0;
				selectedMenuItems[itemId].itemTotalAmount = itemTotalAmount;
	
				$("span[id='item[itemDiscountAmount]["+itemId+"]']").html(0);
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

		for(let item in selectedMenuItems)
		{
			let menuItem = selectedMenuItems[item];
			let menuItemTax = Number(menuItem.itemQty) * calculateItemTax(menuItem.itemTaxDetails, Number(menuItem.itemPrice));
			let menuItemTotalPrice = menuItemTax + (Number(menuItem.itemQty) * Number(menuItem.itemPrice));
			
			menuItemTax = convertToDecimalIfNotAWholeNumber(menuItemTax);
			menuItemTotalPrice = convertToDecimalIfNotAWholeNumber(menuItemTotalPrice);
			
			totalItemsPrice = totalItemsPrice + menuItemTotalPrice;
			
			totalItemsPrice = convertToDecimalIfNotAWholeNumber(totalItemsPrice);
		}

		return totalItemsPrice;
	};

	var calculateOrderTotal = function() {
		let totalItemsPrice = 0;
		let totalQty = 0;
		let totalTax = 0;
		let deliveryCharge = Number($("#deliveryCharge").val());
		let containerCharge = Number($("#containerCharge").val());
		let customerPaid = Number($("#customerPaid").val());

		for(let item in selectedMenuItems)
		{
			let menuItem = selectedMenuItems[item];
			let menuItemTax = Number(menuItem.itemQty) * calculateItemTax(menuItem.itemTaxDetails, Number(menuItem.itemPrice));
			let menuItemTotalPrice = menuItemTax + (Number(menuItem.itemQty) * Number(menuItem.itemPrice));
			
			menuItemTax = convertToDecimalIfNotAWholeNumber(menuItemTax);
			menuItemTotalPrice = convertToDecimalIfNotAWholeNumber(menuItemTotalPrice) - menuItem.itemDiscountAmount;
			
			totalItemsPrice = totalItemsPrice + menuItemTotalPrice;
			totalQty = totalQty + Number(menuItem.itemQty);
			
			totalItemsPrice = convertToDecimalIfNotAWholeNumber(totalItemsPrice);

			$("span[id='item[tax]["+ menuItem.itemId +"]']").text(menuItemTax);
			$("span[id='item[totalPrice]["+ menuItem.itemId +"]']").text(menuItemTotalPrice);

			selectedMenuItems[menuItem.itemId].itemTax = calculateItemTax(menuItem.itemTaxDetails, Number(menuItem.itemPrice));
			selectedMenuItems[menuItem.itemId].itemTotalAmount = menuItemTotalPrice;
		}

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

			totalOrder = convertToDecimalIfNotAWholeNumber(totalOrder - totalDiscount);
			totalOrderAmount = totalOrderAmount - totalDiscount;
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
		$("#grandTotal").text(roundOff);
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

		if (discountType == 'amount')
		{
			$("#amountDiscountDiv").show();
		}

		$("#addDiscount").show();
	});


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

		calculateOrderTotal();
	});

	var calculateDiscount = function(discountType, discountAmount) {
		let totalItemsPrice = getTotalItemPrice();

		if (isNaN(totalItemsPrice) || totalItemsPrice == 0)
		{
			return 0;
		}

		if (!isNaN(discountAmount) && discountAmount > 0)
		{
			if (discountType == 'percent')
			{
				return (totalItemsPrice * discountAmount) / 100;
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

	$("#selfbilling").click(function() {
		let customerName = $("#customerName").val();
		let address = $("#address").val();
		let mobieNumber = $("#mobieNumber").val();
		let orderType = $("input[name='orderType']:checked").val();
		let paymentType = $("input[name='paymentType']:checked").val();
		let transictionId = $("#transictionId").val();
		let grandTotal = $("#grandTotal").text();
		let deliveryCharge = $("#deliveryCharge").val();
		let containerCharge = $("#containerCharge").val();
		let customerPaid = $("#customerPaid").val();

		$("#nameError").hide();
		$("#addressErr").hide();
		$("#mobileErr").hide();
		$("#itemErr").hide();
		$("#paymentError").hide();

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
		
		if(paymentType == "4" && transictionId == "")
		{
			$("#paymentError").show();
			return;
		}

		let data = {
			customerName: customerName,
			address: address,
			mobile: mobieNumber,
			orderType: orderType,
			paymentType: paymentType,
			grandTotal: grandTotal,
			orderTotal: orderTotal,
			transictionId: transictionId,
			selectedItem: selectedMenuItems,
			deliveryCharge,
			containerCharge,
			customerPaid,
			discountAppliedType,
			discountAppliedAmount,
			orderDiscountDetail,
			isDiscountApplied
		};

		$(this).attr('disabled', 'true');
		$.ajax({
			url: baseUrl + 'Selfbilling/saveSelfBilling',
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
					
					$('#datatables').DataTable().ajax.reload();
				}
			}
		})
	});

	$("#updateBilling").click(function() {
		let queryString = window.location.search;
		let urlParams = new URLSearchParams(queryString);
		let id = urlParams.get('id');
		let customerName = $("#customerName").val();
		let address = $("#address").val();
		let mobieNumber = $("#mobieNumber").val();
		let orderType = $("input[name='orderType']:checked").val();
		let paymentType = $("input[name='paymentType']:checked").val();
		let transictionId = $("#transictionId").val();
		let grandTotal = $("#grandTotal").text();
		let deliveryCharge = $("#deliveryCharge").val();
		let containerCharge = $("#containerCharge").val();
		let customerPaid = $("#customerPaid").val();
		
		$("#nameError").hide();
		$("#addressErr").hide();
		$("#mobileErr").hide();
		$("#itemErr").hide();
		$("#paymentError").hide();

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
		
		if(paymentType == "4" && transictionId == "")
		{
			$("#paymentError").show();
			return;
		}

		let data = {
			id: id,
			customerName: customerName,
			address: address,
			mobile: mobieNumber,
			orderType: orderType,
			paymentType: paymentType,
			grandTotal: grandTotal,
			orderTotal: orderTotal,
			transictionId: transictionId,
			selectedItem: selectedMenuItems,
			deliveryCharge,
			containerCharge,
			customerPaid,
			discountAppliedType,
			discountAppliedAmount,
			orderDiscountDetail,
			isDiscountApplied
		};

		$(this).attr('disabled', 'true');
		$.ajax({
			url: baseUrl + 'Selfbilling/updateSelfBilling',
			type: "POST",
			data: data,
			cache: false,
			success: function(response) {
				$("#updateBilling").attr('disabled', false);

				if(response.status == "success")
				{
					swal(response.msg, {
						icon: "success",
					}).then((value) => {
						resetFormData();
					});
					
					$('#datatables').DataTable().ajax.reload();
					window.location.href = baseUrl + 'Restaurant/orderlist';
				}
			}
		})
	});
	
	var resetFormData = function() 
	{
		$("#customerName").val('');
		$("#address").val('');
		$("#mobieNumber").val('');
		$("#transictionId").val('');
		$("#subTotal").text('');
		$("#roundOff").text('');
		$("#total").text('');
		$("#totalQty").text(0);
		$("#grandTotal").text(0);
		$("#deliveryCharge").val(0);
		$("#containerCharge").val(0);
		$("#customerPaid").val('');
		$("#menuItems").html('');
		$("#item").val('');
		$("#specialNote").val('');
		$("#customerReturn").text('');

		resetDiscountData();

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
</script>
