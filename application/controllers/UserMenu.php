<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserMenu extends CI_Controller 
{
	public $restaurantTaxes;
	public $restInfo;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('javascript');
        $this->load->library('form_validation');
        $this->load->library('email');
		$this->load->model('login/DashboardModel','dashboardModel');
		
		$this->load->model('login/MenuModel','menuModel');
		$this->load->model('login/MenuItem_Model','menuItem');
		$this->load->model('UserModel','usermodel');
		$this->load->model('restaurant/RestaurantModel','restaurantModel');
		$this->restaurantTaxes = [];
		$this->restInfo = [];
	}
	
	public function menuPage($tableToken=NULL, $restID=NULL)
	{
	    $data=array(); $restInfo=array();
	    if($tableToken!=NULL) 
	    {
	        $restInfo = $this->getResturant($tableToken);
	        $data['tableToken']=$tableToken; 

		    if(!empty($restInfo))
		    {
		        $data['qr_menu']=$this->usermodel->getstyledata($restInfo[0]->rest_id);   
		        $data['rest_data']=$this->usermodel->getResturantbyID($restInfo[0]->rest_id);   
		        $data['rest_id']=$restInfo[0]->rest_id;   
				$data['table_id']=$restInfo[0]->table_id;  
				
				$data['menuLists']=$this->get_user_menus($restInfo[0]->rest_id);

		        $this->restInfo = $restInfo;
		    }
	    }
	    
	    $data['controller'] = $this;
	    
	    $this->load->view('usermenu/menu_page', $data);	
	}
	
	public function addTaxInPrice($itemPrices, $itemTaxes) 
	{
		if (empty($itemTaxes))
		{
			return $itemPrices;
		}
		else
		{
			$result = [];
			foreach ($itemPrices as $itemKey => &$itemPrice) {
				$calculatePrice = 0;
				foreach ($itemTaxes as $taxKey => $taxValue) {
					$taxData = $this->getTaxPercent($taxValue);
					if (!empty($taxData))
					{
						$calculatePrice += ($itemPrice * $taxData['tax_percent']) / 100;
					}
				}
				$itemPrice = ($calculatePrice + $itemPrice);
				if (strpos($itemPrice, '.') != false)
				{
					$itemPrice = number_format($itemPrice, 2, '.', '');	
				}
			}
		}
		
		return $itemPrices;
	}

	public function getTaxPercent($taxId)
	{
		$taxesAll = [];
		$tableToken = $this->uri->segment(3);
		if($tableToken!=NULL) 
	    {
	        $this->restInfo = empty($this->restInfo) ? $this->getResturant($tableToken) : $this->restInfo;
	        $this->restaurantTaxes = empty($this->restaurantTaxes) ? $this->restaurantModel->getTaxList(['rest_id' => $this->restInfo[0]->rest_id]) : $this->restaurantTaxes;

			foreach ($this->restaurantTaxes as $tax) {
				if ($tax->tax_id == $taxId)
				{
					return json_decode(json_encode($tax), true);
				}
			}
		}

		return [];
	}

	public function getResturant($tableToken=0)
	{
	    $restInfo = $this->usermodel->getResturant($tableToken);
	    
	    return $restInfo;
	}
	
	public function get_user_menus($id=0)
	{
	    $rest_id = ($id!=0) ? $id : $this->uri->segment(3);		
		
		return $this->menuModel->get_user_menus($rest_id);
	}
	
	public function get_user_items($id=0)
	{
	    $menu_id = ($id!=0) ? $id : $this->uri->segment(3);	
		return $this->menuItem->get_user_items($menu_id);
	}
	
	public function cartList()
	{
	    $cartArray=array();
	    
	    if($this->session->userdata('CartList'))
	    {
	        $cartArray = json_decode($this->session->userdata('CartList'), true);
	    }

	    /*if(!empty($cartArray))
	    {
	        /*foreach($cartArray as $listID => $listData) :
	            if($cartArray[$listID]==$_POST['cartList'][$listID])
	            {
	                print_r($cartArray[$listID]);
	            }
	        endforeach;
	    }*/
		
		
	    if(!empty($_POST['cartList']))
	    {
	        foreach($_POST['cartList'] as $itemID => $itemData) :
	            $cartArray[$itemID][$itemData['itemType']]=$itemData;
	        endforeach;
		}

		$token = $this->input->post('thirdSegment');
		$cartArray = $this->updateTaxInCartItems($cartArray, $token);

	    $this->session->set_userdata('CartList',json_encode($cartArray)); // $this->session->unset_userdata('CartList');

	    echo $this->cartHtml();
	}
	
	public function updateTaxInCartItems($cartProducts, $token)
	{
		if (!empty($cartProducts))
		{
			foreach ($cartProducts as $key => $product)
			{
				$menuItemDetail = $this->menuItem->getMenuItemDataByItemId($key);
				if (!empty($menuItemDetail))
				{
					$menuItemTaxes = unserialize($menuItemDetail->taxes);
					if (!empty($menuItemTaxes))
					{
						$itemTaxDetails = [];
						foreach($menuItemTaxes as $taxKey => $taxId)
						{
							$taxDetail = $this->getTaxDetails($taxId, $token);
							if (!empty($taxDetail))
							{
								$itemTaxDetails[] = [
									'taxName' => $taxDetail['tax_type'],
									'taxPercentage' => $taxDetail['tax_percent'],
								];
							}
						}

						$productKey = key($product);
						$cartProducts[$key][$productKey]['itemTaxes'] = $itemTaxDetails; 
					}
				}
			}
		}

		return $cartProducts;
	}

	private function getTaxDetails($taxId, $token) 
	{

		$this->restInfo = empty($this->restInfo) ? $this->getResturant($token) : $this->restInfo;

		$this->restaurantTaxes = empty($this->restaurantTaxes) ? $this->restaurantModel->getTaxList(['rest_id' => $this->restInfo[0]->rest_id]) : $this->restaurantTaxes;

		if (!empty($this->restaurantTaxes))
		{
			foreach($this->restaurantTaxes as $row)
			{
				if ($row->tax_id === $taxId)
				{
					return json_decode(json_encode($row), true);
				}
			}
		}

		return [];
	}

	public function cartRemove()
	{
	    $cartArray=array();
	    
	    if($this->session->userdata('CartList'))
	    {
	        $cartArray = json_decode($this->session->userdata('CartList'), true);
	    }
	    
	    if(isset($_POST['itemID']) && isset($_POST['itemType']))
	    {
	        unset($cartArray[$_POST['itemID']][$_POST['itemType']]);
	        
	        if(empty($cartArray[$_POST['itemID']]))
	        {
	            unset($cartArray[$_POST['itemID']]);
	        }
	    }
	    
	    $this->session->set_userdata('CartList',json_encode($cartArray));
	    
	    echo $this->cartHtml();
	}
	
	public function cartHtml()
	{
	    $html=''; $html2='';
        if($this->session->userdata('CartList')) {
            $CartLists=json_decode($this->session->userdata('CartList'), true);
            foreach($CartLists as $itemId => $itemArray) :
                $html.='<h6>';
                    $itemDetail=$this->manageCartList($itemArray);
                    //$html.='<img src="assets/img/'.$itemDetail['itemFoodType'].'.png" alt="'.$itemDetail['itemFoodType'].'" class="veg-ico"/>';
                    $html.='<b>'. $itemDetail['itemName'] .'</b>';
                    $html.='<p class="color-primary float-right">₹<span class="actual-price-'. $itemId .'">'. $itemDetail['itemNetPrice'] .'</span></p>';
                $html.='</h6>';
                    foreach($itemArray as $itemDataId => $itemDataArray) : 
                    $html.='<div class="bg-lite-blue">';
                        $html.='<p style="font-size:13px; margin-top:5px;">₹<span>'. $itemDataArray['itemPrice'] .'</span> X <span>'. $itemDataArray['itemCount'] .'</span><small class="color-white bg-primary float-right remove-item" onclick="removeCart('. "'".$itemId."'" .','. "'".$itemDataId."'" .')" style="cursor: pointer;">REMOVE</small></p>';
                        $html.='<p style="line-height:14px;"><small>Quantity: '. $itemDataArray['itemType'] .'</small></p>';
                    $html.='</div>';
                    endforeach;
                    $html.='<img src="'. base_url('assets/img/border.png') .'"/>';
            endforeach;
        }
        $html.='<div class="cart-total">';
            $html.='<h5 class="mt-10 mb-10">';
                $html.='<b>Total</b>';
                $total = 0;
                if($this->session->userdata('CartList')) {
                    $CartLists=json_decode($this->session->userdata('CartList'), true);
                    $total=$this->cartTotal($CartLists);
                }
                $html.='<p class="float-right"><b>₹<span class="total-price">'. $total .'</span></b></p>';
            $html.='</h5>';
        $html.='</div>';
        
        $html2.='<h5>';
            $html2.='<b>Sub-Total: ₹<span class="total-price">'. $total .'</span></b>';
            $html2.='<p class="float-right"><b>View Cart <i class="fa fa-chevron-right"></i></b></p>';
        $html2.='</h5>';
        $html2.='<p><small>'. count($CartLists) .' item(s) added</small></p>';
        
        return json_encode(array($html,$html2));
	}
	
	public function receiptHTML()
	{
	    $html=''; 
	    $html.='<div> TEST THE Receipt</div>';
	    
	    return $html;
	}
	
	
	public function manageCartList($cartArray=array())
	{
	    $itemName=''; $itemImage=''; $itemFoodType=''; $itemNetPrice=''; $tempArr=array();
	    if(!empty($cartArray))
	    {
	        foreach($cartArray as $itemId => $itemData):
	            if($itemName == '') { $itemName=$itemData['itemName']; }
	            if($itemImage == '') { $itemImage=$itemData['itemImage']; }
	            if($itemFoodType == '') { $itemFoodType=$itemData['itemFoodType']; }
	            if($itemNetPrice == '') { 
	                $itemNetPrice=$itemData['itemPrice'] * $itemData['itemCount']; 
	            } 
	            else { 
	                $itemNetPrice=$itemNetPrice + ( $itemData['itemPrice'] * $itemData['itemCount'] ); 
	               
	            }
	        endforeach;
		}

		if (strpos($itemNetPrice, '.') != false)
		{
			$itemNetPrice = number_format($itemNetPrice, 2, '.', '');	
		}
		
	    $tempArr['itemName']=$itemName;
	    $tempArr['itemImage']=$itemImage;
	    $tempArr['itemFoodType']=$itemFoodType;
	    $tempArr['itemNetPrice']=$itemNetPrice;
	    
	    return $tempArr;
	}
	
	public function cartTotal($cartArray=array(), $tax='yes', $rest_id=0)
	{
	    $itemTotalPrice='';
	    if(!empty($cartArray))
	    {
	        foreach($cartArray as $itemId => $itemArray) :
	            $manageCartList = $this->manageCartList($itemArray);
	            if($itemTotalPrice == '') { $itemTotalPrice = $manageCartList['itemNetPrice']; }
	            else { $itemTotalPrice = $itemTotalPrice + $manageCartList['itemNetPrice']; }
	        endforeach;
			
			if (strpos($itemTotalPrice, '.') != false)
			{
				$itemTotalPrice = number_format($itemTotalPrice, 2, '.', '');	
			}
	        // if('yes' == $tax && $rest_id != 0) :
	        //     $taxLists=$this->getTaxList($rest_id); 
	        //     if(!empty($taxLists)) :
            //         foreach($taxLists as $taxList):
            //             $itemTotalPrice = $itemTotalPrice + $this->cartTax($cartArray, $taxList->tax_percent);
            //         endforeach; 
            //     endif;
	        // endif;
	    }
	    
	    return round($itemTotalPrice);
	}
	
	public function checkout($tableToken=NULL)
	{
	    $restInfo = $sessArray =  $data = [];
	    if($tableToken!=NULL) 
	    {
	        $restInfo = $this->getResturant($tableToken);
	    
			if(!empty($restInfo))
			{
				$data['rest_id']=$restInfo[0]->rest_id;   
				$data['table_id']=$restInfo[0]->table_id;
				$data['tableToken'] = $tableToken;
			}	
		}
		$sessArray=json_decode($this->session->userdata('CartList'), true);

	    if($this->session->userdata('CartList')) {
	        if(!empty($sessArray)){
	            $this->load->view('usermenu/checkout', $data);
	        }
	        else {
	            redirect('UserMenu/menuPage/'.$tableToken,'refresh');
	        }
	    }
	    else {
	        redirect('UserMenu/menuPage/'.$tableToken,'refresh');
	    }
	}
	
	public function getTaxList($rest_id=0)
	{
	    $taxInfo = array();
	    if($rest_id!=0) {
	        $taxInfo = $this->usermodel->getTaxList($rest_id);
	    }
	    
	    return $taxInfo;
	}
	
	public function cartTax($cartArray=array(), $taxPercent=0)
	{
	    $itemTotalPrice=''; $taxPrice=0;
	    if(!empty($cartArray))
	    {
	        foreach($cartArray as $itemId => $itemArray) :
	            $manageCartList = $this->manageCartList($itemArray);
	            if($itemTotalPrice == '') { $itemTotalPrice = $manageCartList['itemNetPrice']; }
	            else { $itemTotalPrice = $itemTotalPrice + $manageCartList['itemNetPrice']; }
	        endforeach;
	        
	        if(0 != $taxPercent) :
	            $taxPrice = round( ($itemTotalPrice * $taxPercent) / 100 );
	        endif;
	    }
	    
	    return $taxPrice;
	}
	
	public function checkoutPlaceOrder($tableToken=NULL){
	    if($this->session->userdata('CartList')) {
	        $items = $this->session->userdata('CartList');
    		$CartLists = json_decode($this->session->userdata('CartList'), true);
    	    $data['res_id'] = $this->input->post('rest_id');
    	    $data['table_id'] = $this->input->post('table_id');
    	    $data['buyer_name'] = $this->input->post('name');
    	    $data['buyer_email'] = $this->input->post('email');
    	    
    	    $data['buyer_phone_number'] = $this->input->post('phone');
    	    
    	    $data['order_type'] = $this->input->post('order_type');
    	    
    	    
    	    
    	    
    	    $data['created_at'] = date('Y-m-d H:i:s');
    	    
    	    $data['item_details'] = $items;
    	    $data['item_temp_details'] = $items;
    	    $data['total'] = $this->cartTotal($CartLists,'yes',$_POST['rest_id']);
    	    if($this->input->post('pay_method') == 'Cash'){
    	        $data['payment_mode'] = 1;
    	        $data['payment_status'] = 2;
    	        $data['order_id'] = $this->lastOrder();
    	        $added = $this->usermodel->placeOrder($data);
    	        if($added){
    				$this->session->set_flashdata('SUCCESSMSG','Order Placed Successfully');
    				$this->session->set_flashdata('ORDER_ID', $data['order_id']);
    				$this->load->view('usermenu/order_success');
    			}
    			else{
    			    $this->session->set_flashdata('SUCCESSMSG','Can&apos;t Place Order');
    			    $this->session->set_flashdata('ORDER_ID', 'NA');
    			    $this->load->view('usermenu/order_success');
    			}
    	    }
    	    else if($this->input->post('pay_method') == 'Pay Online'){
    	        $check = $this->check($_POST);
    	        if($check['status']){
    				$this->session->set_flashdata('SUCCESSMSG','Order Placed Successfully');
    				$this->session->set_flashdata('ORDER_ID', $check['order_id']);
    				$this->load->view('usermenu/order_success');
    			}
    			else{
    			    $this->session->set_flashdata('SUCCESSMSG','Can&apos;t Place Order');
    			    $this->session->set_flashdata('ORDER_ID', 'NA');
    			    $this->load->view('usermenu/order_success');
    			}
    	    }
	    }
	    else {
	        redirect('UserMenu/menuPage/'.$tableToken,'refresh');
	    }
    	    
	}
	public function check($DATA=array())
	{
	    $_POST = $DATA;
		//check whether stripe token is not empty
		if(!empty($_POST['stripeToken']))
		{
		    if($this->session->userdata('CartList')) {
				$items = $this->session->userdata('CartList');
				$CartLists=json_decode($this->session->userdata('CartList'), true);
				$total=$this->cartTotal($CartLists,'yes',$_POST['rest_id']);
				$data['res_id'] = $_POST['rest_id'];
				$data['table_id'] = $this->input->post('table_id');
        	    $data['buyer_name'] = $_POST['name'];
        	    $data['buyer_email'] = $_POST['email'];
        	    
        	    $data['buyer_phone_number'] = $_POST['phone'];
                $data['order_type'] = $_POST['order_type'];
        	    $data['item_details'] = $this->session->userdata('CartList');
        	    $data['item_temp_details'] = $this->session->userdata('CartList');
        	    $data['payment_mode'] = 2;
    	        $data['payment_status'] = 1;
    	        $data['order_id'] = $this->lastOrder();
    	        $data['total'] = $total;
    	        $data['created_at'] = date('Y-m-d H:i:s');
    	        
    	        $orderInsertID = $this->usermodel->placeOrder($data); //add order
            }
			//$tableToken = $this->uri->segment(3);
		    //$res_id = $restInfo = $this->getResturant($tableToken);
			$token  = $_POST['stripeToken'];
		    $name = $data['buyer_name'];
			$email = $data['buyer_email'];
			
			$phone = $data['buyer_phone_number'];
			
			$type_of_order = $data['order_type'];
			
			//include Stripe PHP library
			require_once APPPATH."third_party/stripe/init.php";
			
			$val = $this->dashboardModel->getPayInfo($_POST['rest_id']);
    		//print_r($_POST);exit;
    		if(!empty($val)){
    		    //set api key
    			$stripe = array(
    			  "secret_key"      => $val->secret_key,
    			  "publishable_key" => $val->pub_key
    			);
    		}else{
    			    $this->session->set_flashdata('SUCCESSMSG','Cant Place Order');
    			    $this->load->view('usermenu/order_success');
			}
			
			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			
			//add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			
			//item information
			$itemName = "Shopping";
			$itemNumber = $items;
// 			$itemNumber = $this->receiptHTML();
			$itemPrice = $total*100;
			$currency = "INR";
			$orderID = $data['order_id'];
			
			//charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $itemPrice,
				'currency' => $currency,
				'description' => "Amount pending for Order ID #$orderID",
				'metadata' => array(
					'item_id' => "Amount pending for Order ID #$orderID"
				)
			));
			
			//retrieve charge details
			$chargeJson = $charge->jsonSerialize();

            //print_r($chargeJson);exit;

			//check whether the charge is successful
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
			{
				//order details 
				$amount = $chargeJson['amount']/100;
				$balance_transaction = $chargeJson['balance_transaction'];
				$currency = $chargeJson['currency'];
				$status = $chargeJson['status'];
				$receipt_url = $chargeJson['receipt_url'];
				$date = date("Y-m-d H:i:s");
				
				$source = $chargeJson['source'];
				$outcome = $chargeJson['outcome'];
				
				$card_exp_month = $source['exp_month'];
				$card_exp_year = $source['exp_year'];
				$card_last4 = $source['last4'];
				$payment_type = $source['brand'];
				$seller_message = $outcome['seller_message'];
				
				//insert tansaction data into the database
				$dataDB = array(
				    'rest_id' => $_POST['rest_id'],
					'name' => $name,
					'email' => $email,
					'phone' => $phone,
					'order_type' => $type_of_order,
					'card_type' => $payment_type, 
					'card_exp_month' => $card_exp_month, 
					'card_exp_year' => $card_exp_year, 
					'card_last_4' => $card_last4,
					'item_name' => $itemName, 
					'item_number' => $itemNumber, 
					'item_price' => $itemPrice/100, 
					'paid_amount' => $amount, 
					'paid_amount_currency' => $currency, 
					'txn_id' => $balance_transaction, 
					'receipt_url' => $receipt_url,
					'payment_status' => $status,
					'created' => $date,
					'modified' => $date
				);
				
				$updateData=array(
				    'txn_id' => $balance_transaction,
				    'payment_status' => ($status == 'succeeded') ? 1 : 2 ,
				    'order_status' => 0
				);

				if ($this->db->insert('transactions', $dataDB)) {
					if($this->db->insert_id() && $status == 'succeeded'){
						$data['insertID'] = $this->db->insert_id();
						
						$this->db->where('id', $orderInsertID);
						$this->db->update('orders', $updateData);
						//$this->load->view('payment_success', $data);
						//redirect('UserMenu/payment_success','refresh');
						return array('status'=>true, 'order_id'=>$data['order_id']);
					}else{
						//echo "Transaction has been failed";
						return array('status'=>false, 'order_id'=>$data['order_id']);
					}
				}
				else
				{
					echo "not inserted. Transaction has been failed";
				}

			}
			else
			{
				echo "Invalid Token";
				$statusMsg = "";
			}
		}
	}

	public function payment_success()
	{
		$this->load->view('stripe/payment_success');
	}

	public function payment_error()
	{
		$this->load->view('stripe/payment_error');
	}

	public function help()
	{
		$this->load->view('stripe/help');
	}
	
	public function getPaymentInfo($id=0){
	    $val = $this->dashboardModel->getPayInfo($id);
	    if(!empty($val)){
	        return $val;
	    }
	}
	
	public function getUserInfo($id=0){
	    $val = $this->usermodel->getResturantbyID($id);
	    if(!empty($val)){
	        return $val;
	    }
	}
	
	public function lastOrder()
	{
	    $O_ID = 10000001;
	    $data = $this->usermodel->lastOrder();
	    if(!empty($data))
	    {
	        if($data[0]->order_id == '' ) { $O_ID = $O_ID; }
	        else { $O_ID = $data[0]->order_id + 1; }
	        
	        return $O_ID;
	    }
	}
}