<!DOCTYPE HTML>
<html lang="en">
<head>
        <title>E-Menu</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/fonts/beyond_the_mountains-webfont.css" type="text/css"/>

		<!-- Stylesheets -->
		<link href="<?= base_url('assets/front_end/'); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/fonts/ionicons.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/styles.css" rel="stylesheet">
		<link href="<?= base_url('assets/front_end/'); ?>css/custom.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		
		<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?= base_url('assets/front_end/'); ?>css/owl.theme.default.min.css">
		<style>.added-notification { display: none; } .menuItem.active { -moz-box-shadow: inset 5px 5px 20px #fff;-webkit-box-shadow: inset 5px 5px 20px #fff;box-shadow: inset 5px 5px 20px #fff; } </style>
</head>
<body>
	<?php $bg_url=''; $logo_url=FALSE;
    if(!empty($qr_menu) ) {
        if($qr_menu[0]->bg_status == 1)
            $bg_url=$qr_menu[0]->bg_img;
            
        if($qr_menu[0]->logo_status == 1)
            $logo_url=TRUE;
    }   
    ?>
<div class="landing" style="background:#fff url('<?= base_url($bg_url) ?>') no-repeat; background-size:cover;">
	<div class="heading">
		<?php if($logo_url): ?>
		<?php if(!empty($rest_data) && $rest_data[0]->userimg !=""): ?>
		<img class="heading-img2" src="<?= base_url().'/'.$rest_data[0]->userimg ?>" alt="">
		<?php else: ?>
		<img class="heading-img" src="<?= base_url('assets/front_end/') ?>images/heading_logo.png" alt="">
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<h5><a href="javascript:void(0)" class="btn-primaryc plr-25" onclick="$(this).parents('div').hide();"><b>SEE TODAYS MENU</b></a></h5>
</div>
<section class="pt-25">
        <div class="container">
            <div class="slide-header">
                <div class="heading mb-10">
                        <!--img class="heading-img" src="images/heading_logo.png" alt=""-->
                        <h2>Our Menu</h2>
                </div>

                <div class="row">
                        <div class="col-sm-12">
								<div class="owl-carousel owl-theme selecton">
									<?php $ci=&get_instance(); $menuLists=$ci->get_user_menus($rest_id); 
									  if(!empty($menuLists)) { $i=0;
										foreach($menuLists as $menuList) :
									?>
										<div onclick="scrollOn(this)" rel="<?= str_replace(' ', '_', $menuList->title); ?>" class="item menuItem" style="background: #000000a8 url('<?= base_url($menuList->image) ?> ') no-repeat; background-size:cover; cursor: pointer;">
											<div rel="<?= $menuList->title ?>">
												<h4><?= $menuList->title ?></h4>
											</div>
										</div>
									<?php endforeach; } ?>
								</div>
                        </div><!--col-sm-12-->
                </div><!--row-->
            </div>
            <div class="menu-content">
				<?php $ci=&get_instance(); $menuLists=$ci->get_user_menus($rest_id); 
                  if(!empty($menuLists)) { $i=0;
                    foreach($menuLists as $menuList) :
                ?>
                <div class="row">
						<div class="col-md-12">
							<div id="<?= str_replace(' ', '_', $menuList->title) ?>" class="heading"><h2 class="sub-heading"><?= $menuList->title ?></h2></div>
                        </div>
                        
                        <?php $itemLists=$ci->get_user_items($menuList->menu_id); 
                          if(!empty($itemLists)) { $j=0;
                            foreach($itemLists as $itemList) :
                                $price=json_decode($itemList->price, true);
                                $taxes=unserialize($itemList->taxes);
                                $price_desc=json_decode($itemList->price_desc, true);

                                $price = $controller->addTaxInPrice($price, $taxes);
                        ?>
                        <div class="col-md-6">
                                <div class="sided-90x mb-30 menu-card">
                                        <div class="s-left">
                                            <img class="br-3" src="<?= base_url($itemList->image) ?>" alt="Menu Image">
                                        </div><!--s-left-->
                                        <img src="<?= base_url('assets/img/').$itemList->food_type.'.png' ?>" alt="<?= $itemList->food_type; ?>" class="veg-ico"/>
                                        <div class="s-right">
                                                <h5>
													<p style="width:125px;display:inline-block;"><b><?= $itemList->name ?></b></p>
													<p class="float-right right-text">
        												<input class="item-count-<?= $itemList->item_id ?>" type="number" min="1" max="100" value="1" /><br />
        												<button class="btn-brdr-primary" onclick="cartitems('<?= $itemList->item_id ?>')"><b>ADD</b></button>
        											</p>
												</h5>
												<p><b class="color-primary">₹<span class="actual-price-<?= $itemList->item_id ?>"><?= max($price) ?></span></b></p>
                                                <p class="mt-10">
                                                <?php for($k=0;$k<count($price);$k++) : ?>
													<span>
													    <!--<input class="radio-btn" id="<?= $price_desc[$k].$itemList->item_id ?>" type="radio" name="pricetype_<?= $itemList->item_id ?>" value="<?= $price_desc[$k] ?>" data-name="<?= $itemList->name ?>" data-price="<?= $price[$k] ?>" data-itemid="<?= $itemList->item_id ?>" data-itemimg="<?= $itemList->image ?>" data-itemtype="<?= $itemList->food_type ?>" <?= ($k==0)?'checked':'' ?>>-->
													    <input class="radio-btn" id="<?= $price_desc[$k].$itemList->item_id ?>" type="radio" name="pricetype_<?= $itemList->item_id ?>" value="<?= $price_desc[$k] ?>" data-name="<?= $itemList->name ?>" data-price="<?= $price[$k] ?>" data-itemid="<?= $itemList->item_id ?>" data-itemimg="<?= $itemList->image ?>" data-itemtype="<?= $itemList->food_type ?>" <?= (max($price)==$price[$k])?'checked':'' ?>>
													    <label class="pr-10 pl-5 radio-label" for="<?= $price_desc[$k].$itemList->item_id ?>"><?= $price_desc[$k] ?></label>
													</span>
												<?php endfor; ?>
												    <!--<span><input class="radio-btn" type="radio" name="custom" value="half" data-price="6"><label class="pr-10 pl-5 radio-label">Half</label></span>
													<span><input class="radio-btn" type="radio" name="custom" value="quarter" data-price="3"><label class="pr-10 pl-5 radio-label">Quarter</label></span>
													<span><input class="radio-btn" type="radio" name="custom" value="quarter" data-price="3"><label class="pr-10 pl-5 radio-label">Quarter</label></span>-->
												</p>
                                        </div><!--s-right-->
                                </div><!-- sided-90x -->
                        </div><!-- food-menu -->
						<?php endforeach; } ?>
                </div><!-- row -->
				<?php endforeach; } ?>
            </div>
        </div><!-- container -->
        <div class="ptb-5 added-notification color-white center-text brdr-primary-2">
    		<div class="abs-tblr bg-primary opacty-6 z--1"></div>
    		<p class="font-9 color-white"><b>Item added to cart</b></p>
        </div>
        <div class="cart-added-items plr-20 ptb-10" data-toggle="modal" data-target="#myModal">
            <?php $cart_added_items_total = 0;
            if($this->session->userdata('CartList')) {
                $CartLists=json_decode($this->session->userdata('CartList'), true);
                $cart_added_items_total=$ci->cartTotal($CartLists);
            }
            ?>
            <h5>
                <b>Sub-Total: ₹<span class="total-price"><?= $cart_added_items_total ?></span></b>
                <p class="float-right"><b>View Cart <i class="fa fa-chevron-right"></i></b></p>
            </h5>
            <p><small><?= (!empty($CartLists)) ? count($CartLists) : '0' ?> item(s) added</small></p>
        </div>
        <!-- The Modal -->
          <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Cart</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="added-item">
                    <?php
                    if($this->session->userdata('CartList')) {
                        $CartLists=json_decode($this->session->userdata('CartList'), true);
                        
                        foreach($CartLists as $itemId => $itemArray) : ?>
                        <h6>
                            <?php $itemDetail=$ci->manageCartList($itemArray) ?>
                            <b><?= $itemDetail['itemName'] ?></b>
                            <p class="color-primary float-right">₹<span class="actual-price-<?= $itemId ?>"><?= $itemDetail['itemNetPrice'] ?></span></p>
                        </h6>
                        <?php foreach($itemArray as $itemDataId => $itemDataArray) : ?>
                        <div class="bg-lite-blue">
                            <p style="font-size:13px; margin-top:5px;">₹<span><?= $itemDataArray['itemPrice'] ?></span> X <span><?= $itemDataArray['itemCount'] ?></span><small class="color-white bg-primary float-right remove-item" onclick="removeCart('<?= $itemId ?>','<?= $itemDataId ?>')" style="cursor: pointer;">REMOVE</small></p>
                            <p style="line-height:14px;"><small>Quantity: <?= $itemDataArray['itemType'] ?></small></p>
                        </div>
                        <?php endforeach; ?>
                        <img src="<?php echo base_url('assets/img/border.png'); ?>"/>
                    <?php       
                        endforeach;
                    }
                    ?>
                    <div class="cart-total">
                        <h5 class="mt-10 mb-10">
                            <b>Total</b>
                            <?php $total = 0;
                            if($this->session->userdata('CartList')) {
                                $CartLists=json_decode($this->session->userdata('CartList'), true);
                                $total=$ci->cartTotal($CartLists);
                            }
                            ?>
                            <p class="float-right"><b>₹<span class="total-price"><?= $total ?></span></b></p>
                        </h5>
                    </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Add More</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal" onclick="location.href=<?= "'".base_url('UserMenu/checkout/').$tableToken. "'" ?>">Checkout</button>
                </div>
                
              </div>
            </div>
          </div>
</section>
	<!-- SCIPTS -->
	<script src="<?= base_url('assets/front_end/'); ?>js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/scripts.js"></script>
	<script src="<?= base_url('assets/front_end/'); ?>js/owl.carousel.js"></script>
<script>
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({
			loop:false,
			margin:10,
			nav:false,
			dots:false,
			responsive:{
				0:{
					items:3
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		});
		$('.radio-btn').on('change', function(){
			if ($(this).is(':checked') && $(this).val()) {
				var price_val = $(this).attr('data-price');
				var itemid_val = $(this).attr('data-itemid');
				$('.actual-price-'+itemid_val).html(price_val);
			}
		});
		
		$('input[type=number]').spinner();
	});
	(function($) {
		$.fn.spinner = function() {
			this.each(function() {
				var el = $(this);

				// add elements
				el.wrap('<span class="spinner"></span>');     
				el.before('<span class="sub">-</span>');
				el.after('<span class="add">+</span>');

				// substract
				el.parent().on('click', '.sub', function () {
					if (el.val() > parseInt(el.attr('min')))
						el.val( function(i, oldval) { return --oldval; });
				});

				// increment
				el.parent().on('click', '.add', function () {
					if (el.val() < parseInt(el.attr('max')))
						el.val( function(i, oldval) { return ++oldval; });
				});
			});
		};
	})(jQuery);

	function cartitems(itemid=0)
	{
	    var itemArray = {}; var itemIndex = {};
	    if(itemid!==0) {
	        var itemName = $("input[name='pricetype_"+itemid+"']:checked").attr('data-name');
	        var itemPrice = $("input[name='pricetype_"+itemid+"']:checked").attr('data-price');
	        var itemImage = $("input[name='pricetype_"+itemid+"']:checked").attr('data-itemimg');
	        var itemFoodType = $("input[name='pricetype_"+itemid+"']:checked").attr('data-itemtype');
	        var itemType = $("input[name='pricetype_"+itemid+"']:checked").val();
	        var itemCount = $('.item-count-'+itemid).val();
	        itemArray['itemName'] = itemName;
	        itemArray['itemPrice'] = parseInt(itemPrice);
	        itemArray['itemImage'] = itemImage;
	        itemArray['itemType'] = itemType;
	        itemArray['itemFoodType'] = itemFoodType;
	        itemArray['itemCount'] = itemCount;
	        
	        itemIndex[itemid] = itemArray
	        
	        createCartList(itemIndex);
	        
	       // $('#myModal').modal('show');
	    }
	    console.log(itemIndex);
	}
	
	function createCartList(cartList={})
	{
	    $.ajax({
	        type : "POST",
	        url  : "<?= base_url('UserMenu/cartList') ?>",
	        data : {'cartList' : cartList }
	    })
	    .done(function(response){
	        console.log(response);
	        $('.added-notification').show();
	        resp = JSON.parse(response);
	        $('.added-item').html(resp[0]);
	        $('.cart-added-items').html(resp[1]);
	        setTimeout(function() { $('.added-notification').hide(); }, 2000);
	    })
	}
	
	function removeCart(itemid=0,itemtype=null)
	{
	    if(itemid!==0 && itemtype!==null) {
	        $.ajax({
    	        type : "POST",
    	        url  : "<?= base_url('UserMenu/cartRemove') ?>",
    	        data : {'itemID' : itemid, 'itemType' : itemtype }
    	    })
    	    .done(function(response){
    	        console.log(response);
    	        resp = JSON.parse(response);
    	        $('.added-item').html(resp[0]);
    	        $('.cart-added-items').html(resp[1]);
    	    })
	    }
	}
	
	function scrollOn(obj){
        var target = $('#'+$(obj).attr('rel'));
        $('.menuItem').removeClass('active');
        $(obj).addClass('active');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - 180
            }, 'slow');
            return false;
        }
	}
</script>
</body>
</html>