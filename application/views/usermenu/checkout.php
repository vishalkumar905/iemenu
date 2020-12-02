<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>E-Menu</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/fonts/beyond_the_mountains-webfont.css" type="text/css" />

	<!-- Stylesheets -->
	<link href="<?= base_url('assets/front_end/'); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/front_end/'); ?>css/fonts/ionicons.css" rel="stylesheet">
	<link href="<?= base_url('assets/front_end/'); ?>css/styles.css" rel="stylesheet">
	<link href="<?= base_url('assets/front_end/'); ?>css/custom.css" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.theme.default.min.css">


	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">

</head>

<body>
	<section class="pt-25">
		<div class="container">
			<div class="heading">
				<h2 class="sub-heading">Checkout</h2>
			</div>
			<div class="row">
				<div class="col-md-6">
					<?php $ci = &get_instance();
					if ($this->session->userdata('CartList')) {
						$CartLists = json_decode($this->session->userdata('CartList'), true);

						foreach ($CartLists as $itemId => $itemArray) : ?>
							<div class="added-item">
								<?php $itemDetail = $ci->manageCartList($itemArray) ?>
								<h6>
									<b><?= $itemDetail['itemName'] ?></b>
									<p class="color-primary float-right">₹<span class="actual-price-<?= $itemId ?>"><?= $itemDetail['itemNetPrice'] ?></span></p>
								</h6>
								<div class="sided-90x">
									<div class="s-left"><img class="br-3" src="<?= base_url($itemDetail['itemImage']) ?>" alt="Item Image"></div><img src="<?= base_url('assets/img/') . $itemDetail['itemFoodType'] . '.png' ?>" alt="<?= $itemDetail['itemFoodType']; ?>" style="width: 15px;position: absolute;top: 5px;left: 5px;" />
									<div class="s-right">
										<?php foreach ($itemArray as $itemDataId => $itemDataArray) : ?>
											<p style="font-size:13px; margin-top:5px;">₹<span><?= $itemDataArray['itemPrice'] ?></span> X <span><?= $itemDataArray['itemCount'] ?></span></p>
											<p style="line-height:14px;"><small>Quantity: <?= $itemDataArray['itemType'] ?></small></p>
											<?php if (!empty($itemDataArray['itemTaxes'])) {?> 
												<p style="line-height:14px;">
													<small>Tax: 
													<?php 
														$itemTaxData = [];
														foreach($itemDataArray['itemTaxes'] as $itemTaxRow)
														{
															$itemTaxData[] = $itemTaxRow['taxName'] . '('. $itemTaxRow['taxPercentage'] .'%)';
														}

														echo implode(', ', $itemTaxData);
													?>
													</small>
												</p>	
											<?php } ?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<img src="<?php echo base_url('assets/img/border.png'); ?>" />
					<?php
						endforeach;
					}
					?>

					<div class="cart-total mb-30">
						<h5 class="mtb-20">
							<b>Total</b>
							<?php $total = 0;
							if ($this->session->userdata('CartList')) {
								$CartLists = json_decode($this->session->userdata('CartList'), true);
								$total = $ci->cartTotal($CartLists, 'yes', $rest_id);
							}
							?>
							<p class="float-right"><b>₹<span class="total-price"><?= $total ?></span></b></p>
						</h5>
						<!--<img src="<?php //echo base_url('assets/img/border.png'); 
										?>"/>-->
					</div>
				</div>
				<div class="col-md-6">

					<div class="heading">
						<h2 class="sub-heading">Details</h2>
					</div>
					<div class="row">
						<div class="form-style-1 placeholder-1 col-md-6">
							<input class="mb-20" type="text" name="name" placeholder="Name" required form="paycash-form">
							<input class="mb-20" type="email" name="email" placeholder="E-mail (Optional)" form="paycash-form">
							<input class="mb-20" type="tel" name="phone" placeholder="Phone Number" required form="paycash-form">

							<h5 class="mb-10">Order Type</h5>

							<span><input class="radio-btn" type="radio" name="order_type" checked="" value="Dine-in" form="paycash-form">
								<label for="dine-in" class="pr-10 pl-5 radio-label">Dine-in</label>

								<input class="radio-btn" type="radio" name="order_type" value="Take Away" form="paycash-form">
								<label for="take-away" class="pr-10 pl-5 radio-label">Take Away</label></span>


						</div>
						<?php
						if ($this->session->userdata('CartList')) {
							$conf = $ci->getPaymentInfo($rest_id);
							$userConf = $ci->getUserInfo($rest_id);
						}
						?>

						<div class="col-md-6">
							<h5 class="mb-10">Payment Method</h5>
							<span><input class="radio-btn" id="cash-label" type="radio" name="pay_method" value="Cash" checked="" form="paycash-form"><label for="cash-label" class="pr-10 pl-5 radio-label">Cash / UPI</label></span>
                            <span><input class="radio-btn" id="upi-label" type="radio" name="pay_method" value="UPI QR Scan" form="paycash-form"><label for="upi-label" class="pr-10 pl-5 radio-label">UPI QR Scan</label></span>
                            <span><input class="radio-btn" id="card-label" type="radio" name="pay_method" value="Card Swipe" form="paycash-form"><label for="card-label" class="pr-10 pl-5 radio-label">Card Swipe</label></span>
							<span><input class="radio-btn" id="btc-label" type="radio" name="pay_method" value="BTC" form="paycash-form"><label for="btc-label" class="pr-10 pl-5 radio-label">BTC</label></span>

							
							
							
							<?php
							if (!empty($conf) && !empty($userConf)) {
								if ($conf->status == 'on' && $userConf[0]->online_pay_status == 'on') {
							?>
									<span><input class="radio-btn" id="online-label" type="radio" name="pay_method" value="Pay Online" form="paycash-form"><label for="online-label" class="pr-10 pl-5 radio-label">Debit / Credit Card</label></span>
							<?php
								}
							}
							?>
						</div>

						<div class="col-md-6 mtb-20" id="card-pay" style="display:none;">
                            <h5 class="mb-10">Transaction Id (If swiped by card)</h5>
                            <input class="mb-20" type="text" name="card_transaction_id" placeholder="Enter by cashier" form="paycash-form">  
						</div>

						<div class="col-md-6 mtb-20" id="pay-later">
							<form class="form-style-1 placeholder-1" action="<?php echo base_url('UserMenu/checkoutPlaceOrder/') . $tableToken; ?>" method="post" id="paycash-form">
								<input type="hidden" name="rest_id" value="<?= $rest_id; ?>">
								<input type="hidden" name="table_id" value="<?= $table_id; ?>">
								<button type="submit" value="Place Order" class="btn btn-info checkout-btn">Place Order</button>
							</form>
						</div>
						<?php
						if (!empty($conf) && !empty($userConf)) {
							if ($conf->status == 'on' && $userConf[0]->online_pay_status == 'on') {
						?>
								<div class="col-md-6 mtb-20" id="pay-now">
									<form class="form-style-1 placeholder-1" action="<?php echo base_url('UserMenu/checkoutPlaceOrder/') . $tableToken; ?>" method="post" id="payonline-form">
										<input type="hidden" name="rest_id" value="<?= $rest_id; ?>">
										<input type="hidden" name="table_id" value="<?= $table_id; ?>">
										<div class="card">
											<div class="card-body bg-light">
												<div class="form-row">
													<h5 class="card-element text-center">
														Credit or Debit card
													</h5>
													<div id="card-element" class="mtb-20 mlr-5">
														<!-- A Stripe Element will be inserted here. -->

													</div>

													<!-- Used to display form errors. -->
													<div id="card-errors" role="alert"></div>
												</div>
												<button class="btn btn-info checkout-btn">Pay Now</button>
											</div>
										</div>
									</form>
								</div>
						<?php
							}
						}
						?>
					</div>

				</div>
			</div>
		</div><!-- container -->
	</section>

	<!-- SCIPTS -->
	<script src="<?= base_url('assets/front_end/'); ?>js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/scripts.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/owl.carousel.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[type=radio][name=pay_method]').change(function() {
				if (this.value == 'Cash') {
					$("#pay-later").show();
					$("#pay-now").hide();
					$("#card-pay").hide();
					$('input[form^="pay"]').attr('form', 'paycash-form');
				} else if(this.value == 'UPI QR Scan'){
				    $("#pay-now").hide();
					$("#pay-later").show();
					$("#card-pay").hide();
				    $('input[form^="pay"]').attr('form', 'paycash-form');
				} else if(this.value == 'Card Swipe') {
				    $("#pay-now").hide();
					$("#pay-later").show();
					$("#card-pay").show();
					$('input[form^="pay"]').attr('form', 'paycash-form');
				} else if(this.value == 'BTC') {
				    $("#pay-later").show();
					$("#pay-now").hide();
					$("#card-pay").hide();
					$('input[form^="pay"]').attr('form', 'paycash-form');
				} else {
					$("#pay-now").show();
					$("#pay-later").hide();
					$("#card-pay").hide();
					$('input[form^="pay"]').attr('form', 'payonline-form');
				}
			});
		});
	</script>
	<script type="text/javascript">
		<?php
		if (!empty($conf)) {
		?>
			// Create a Stripe client.
			var stripe = Stripe('<?php echo $conf->pub_key; ?>'); // pass stripe api

		<?php
		}
		?>

		// Create an instance of Elements.
		var elements = stripe.elements();

		// Custom styling can be passed to options when creating an Element.
		// (Note that this demo uses a wider set of styles than the guide below.)
		var style = {
			base: {
				color: '#32325d',
				fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
				fontSmoothing: 'antialiased',
				fontSize: '16px',
				'::placeholder': {
					color: '#aab7c4'
				}
			},
			invalid: {
				color: '#fa755a',
				iconColor: '#fa755a'
			}
		};

		// Create an instance of the card Element.
		var card = elements.create('card', {
			style: style
		});

		// Add an instance of the card Element into the `card-element` <div>.
		card.mount('#card-element');

		// Handle real-time validation errors from the card Element.
		card.on('change', function(event) {
			var displayError = document.getElementById('card-errors');
			if (event.error) {
				displayError.textContent = event.error.message;
			} else {
				displayError.textContent = '';
			}
		});

		// Handle form submission.
		var form = document.getElementById('payonline-form');
		form.addEventListener('submit', function(event) {
			event.preventDefault();

			stripe.createToken(card).then(function(result) {
				if (result.error) {
					// Inform the user if there was an error.
					var errorElement = document.getElementById('card-errors');
					errorElement.textContent = result.error.message;
				} else {
					// Send the token to your server.
					stripeTokenHandler(result.token);
				}
			});
		});

		// Submit the form with the token ID.
		function stripeTokenHandler(token) {
			// Insert the token ID into the form so it gets submitted to the server
			var form = document.getElementById('payonline-form');
			var hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'stripeToken');
			hiddenInput.setAttribute('value', token.id);
			form.appendChild(hiddenInput);

			// Submit the form
			form.submit();
		}
	</script>
</body>

</html>