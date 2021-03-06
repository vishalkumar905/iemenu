<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__).'/Main.php');

include_once APPPATH.'/third_party/mpdf/vendor/autoload.php';
include_once APPPATH.'/libraries/SimpleXLSXGen.php';

class Restaurant extends Main 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('restaurant/RestaurantModel','restaurantModel');
		$this->load->model('UserModel','usermodel');
		$this->load->model('OrderModel','ordermodel');
	}
	
	public function index()
	{
	 
	}
	
	public function list()
	{
	    $condition=array('delete_status'=>'0');
	    $data['restaurants']=$this->restaurantModel->getRestaurantList($condition);
	    $this->load->view('restaurant/list', $data);
	}
	
	public function add()
	{
	    if(isset($_POST) && !empty($_POST))
	    {
	        $name=trim($_POST['name']);
	        $email=trim($_POST['email']);
	        $password=trim($_POST['password']);
	        $manager_password=trim($_POST['manager_password']);
	        $online_pay = (isset($_POST['online_pay'])) ? trim($_POST['online_pay']) : "off" ;
	        $token = rand();
	        
	        $data = array(
				'name' => $name,
				'email' => $email,
				'password' => md5($password),
				'manager_password' => $manager_password,
				'email_verification_code' => md5($token),
				'online_pay_status' => $online_pay
			);
			
			if($this->restaurantModel->getRestaurantByEmail($email))
			{
			    $this->session->set_flashdata('Email Error','\nEmail already exists. Try with another email...');
			    redirect('Restaurant/add','refresh');
			}
	        else
	        {
	           if($this->restaurantModel->insertRestaurantInfo($data))
	           {
	               $this->session->set_flashdata('Success MSG','Restaurant Information Inserted...');
	               redirect('Restaurant/list','refresh');
	           }
	        }
	    }
	    
	    $this->load->view('restaurant/add');
	}
	
	public function update($id=0)
	{
	    
	    if(isset($_POST) && !empty($_POST))
	    {
	        $name=trim($_POST['name']);
	        $email=trim($_POST['email']);
	        $password=trim($_POST['password']);
	        $manager_password=trim($_POST['manager_password']);
	        $online_pay = (isset($_POST['online_pay'])) ? trim($_POST['online_pay']) : "off" ;
	        
	        $data = array(
				'name' => $name,
				'email' => $email,
				'password' => md5($password),
				'manager_password' => $manager_password,
				'online_pay_status' => $online_pay
			);
			
			$rest_id = (isset($_POST['rest_id'])) ? trim($_POST['rest_id']) : $id;
			
            if($this->restaurantModel->updateRestaurantInfo($data,$rest_id));
            {
                $this->session->set_flashdata('Success MSG','Restaurant Information Updated...');
                redirect('Restaurant/list','refresh');
            }
	    }
	    
	    $condition=array('rest_id'=>$id);
	    $data['restaurant']=$this->restaurantModel->getRestaurantList($condition);
	    $this->load->view('restaurant/update', $data);
	}
	
	public function delete($id)
	{
	    if($this->restaurantModel->deleteRestaurantInfo($id))
	        $this->session->set_flashdata('Success MSG','Record Deleted Successfully...');
		else
		    $this->session->set_flashdata('Fail MSG','Error in record deletion...');
		
		redirect('Restaurant/list','refresh');
	}
	
	public function deleteTax($id)
	{
	    if($this->restaurantModel->deleteTaxInfo($id))
	        $this->session->set_flashdata('Success MSG','Record Deleted Successfully...');
		else
		    $this->session->set_flashdata('Fail MSG','Error in record deletion...');
		
		redirect('Restaurant/taxlist','refresh');
	}
	
	public function addTax()
	{
	    if(isset($_POST) && !empty($_POST))
	    {
	        $taxname = trim($_POST['taxname']);
	        $tax = trim($_POST['tax']);
			$rid = $this->session->userid;
			
	        $data = array(
				'tax_type' => $taxname,
				'tax_percent' => $tax,
				'rest_id' => $rid
			);
			
			if($this->restaurantModel->insertTaxInfo($data))
	           {
	               $this->session->set_flashdata('Success MSG','Tax Information Inserted...');
	               redirect('Restaurant/taxlist','refresh');
	           }
	    }
	    
	    $this->load->view('restaurant/addtax');
	}
	public function taxlist()
	{
		$rid = $this->session->userid;
	    $condition = array('rest_id'=>$rid);
	    $data['taxs'] = $this->restaurantModel->getTaxList($condition);
	    $this->load->view('restaurant/taxlist', $data);
	}
	
	public function orderlist()
	{
		$data['discountCoupons'] = $this->getDiscountCoupons($this->session->userid);
		$data['discountAdded'] = $this->checkIfDiscountAdded();
		$data['updateId'] = intval($this->input->get('id'));

	    $this->load->view('restaurant/orderlist', $data);
	}
	
	private function checkIfDiscountAdded()
	{
		$id = intval($this->input->get('id'));
		$discount = [
			'isApplied' => false
		];

		if ($id > 0)
		{
			$order = $this->getOrder($id);
			if (!empty($order))
			{
				if (intval($order['discount_coupon_percent']) > 0)
				{
					$discount['discountPercentage'] = $order['discount_coupon_percent'];
					$discount['isApplied'] = true;
				}
				
				if (intval($order['flat_amount_discount']) > 0)
				{
					$discount['flatDiscount'] = $order['flat_amount_discount'];
					$discount['isApplied'] = true;
				}
			}

			if ($discount['isApplied'] == false)
			{
				$subOrders = $this->ordermodel->getSubOrders($id);
				if (!empty($subOrders))
				{
					foreach($subOrders as $subOrder)
					{
						if (intval($subOrder['discount_coupon_percent']) > 0)
						{
							$discount['discountPercentage'] = $subOrder['discount_coupon_percent'];
							$discount['isApplied'] = true;
						}
						
						if (intval($subOrder['flat_amount_discount']) > 0)
						{
							$discount['flatDiscount'] = $subOrder['flat_amount_discount'];
							$discount['isApplied'] = true;
						}

						if ($discount['isApplied'] == true)
						{
							break;
						}
					}
				}
			}
		}

		return $discount;
	}

	private function getOrder($id)
	{
		if ($id > 0)
		{
			$order = $this->db->select('*')->from('orders')->where([
				'id' => $id
			])->get()->row_array();

			return $order;
		}

		return [];
	}

	private function getDiscountCoupons($rid)
    {
		$this->db->select('*');
		$this->db->from('res_discount');
		$this->db->where('rest_id', $rid);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function reportorderlist()
	{
	    $this->load->view('restaurant/reportorderlist');
	}


	//11-10-2020
	public function voidorderlist()
	{
	    $this->load->view('restaurant/voidorderlist');
	}
	
	
	//13-10-2020
	public function nckorderlist()
	{
	    $this->load->view('restaurant/nckorderlist');
	}

	public function itemWiseReport()
	{
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		$condition = [
			'res_id' => $this->session->userid,
			'order_status' => 2,
		];

		if($from !='' && $to !='') 
		{ 
			$condition["DATE(created_at) BETWEEN '$from' AND '$to'"] = null; 
		}
		elseif($from !='')
		{ 
			$condition["DATE(created_at) >= '$from'"] = null;
		}
		elseif($to !='') 
		{ 
			$condition["DATE(created_at) <= '$to'"] = null;
		}

		$orders = $this->getItemWiseReportQuery($condition);

		if (empty($orders))
		{
			redirect(base_url('Restaurant/reportorderlist'));
		}

		$products = [];

		if (!empty($orders))
		{
			foreach($orders as $order)
			{
				$itemDetails = json_decode($order['item_details'], true);

				if (!empty($itemDetails))
				{
					foreach($itemDetails as $itemId => $items)
					{
						foreach($items as $itemType => $item)
						{
							$products[$itemId]['itemName'] = $item['itemName'];
							$products[$itemId]['items'][] = $item;

							unset($item);
						}
					}
				}
			}
		}

		if (!empty($products))
		{
			foreach($products as &$product)
			{
				$subTotal = 0;
				$itemQuantity = 0;
				$itemTaxTotal = 0;
				if (!empty($product['items']))
				{
					foreach($product['items'] as $row)
					{
						$itemQuantity +=  $row['itemCount'];
						$itemPrice = (isset($row['itemOldPrice']) ? $row['itemOldPrice'] : $row['itemPrice']) * $row['itemCount'];
						$subTotal += $itemPrice;

						if (!empty($row['itemTaxes']))
						{
							$singleItemTaxAmount = 0; 
							foreach($row['itemTaxes'] as $itemTax)
							{
								$singleItemTaxAmount += ($itemPrice * $itemTax['taxPercentage']) / 100;							

								unset($itemTax);
							}

							$itemTaxTotal +=  $singleItemTaxAmount;
						}
					}

					unset($product['items']);
				}

				$grossTotal = $subTotal + $itemTaxTotal;
				$roundOff = number_format(round($grossTotal) - $grossTotal, 2, '.', '');

				$product['subTotal'] = number_format($subTotal, 2, '.', '');
				$product['itemQuantity'] = $itemQuantity;
				$product['itemTotalTax'] = number_format($itemTaxTotal, 2, '.', '');
				$product['grossAmount'] = number_format($grossTotal, 2, '.', '');
				$product['grossTotal'] = number_format(round($grossTotal), 2, '.', '');
				$product['roundOff'] = $roundOff;
			}
		}

		$excelData[] = ['S.No.', 'Item Name', 'Quantity', 'Sub Total', 'Total Tax', 'Gross Amount', 'Roundoff', 'Gross Total'];
		$counter = 1;
		foreach($products as $rowData)
		{
			$data = [];

			$data[] = $counter;
			$data[] = $rowData['itemName'];
			$data[] = $rowData['itemQuantity'];
			$data[] = $rowData['subTotal'];
			$data[] = $rowData['itemTotalTax'];
			$data[] = $rowData['grossAmount'];
			$data[] = $rowData['roundOff'];
			$data[] = $rowData['grossTotal'];

			$excelData[] = $data;

			++$counter;
		}

		$this->getExcel($excelData);
	}

	private function getItemWiseReportQuery($condition) 
	{
		$this->db->select(['id', 'order_id', 'item_details']);
		$this->db->from('orders');
		$this->db->where($condition);
		return $this->db->get()->result_array();
	}
	
	public function ajaxorderlist($type="")
	{
		$rid = $this->session->userid;
		if($type=='order'){
		    $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
    		$condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date);
    		
			$orders = $this->restaurantModel->getOrderList($condition);
			
			// 11-10-2020
		} else if($type=='voidBillReport'){
			$this->db->order_by('id','DESC');
		    $this->db->where('res_id',$rid);
			$this->db->where('order_status',3);
			
			// add filteration code

			if($_POST['isFilter']=='yes')
			{
		        $date=json_decode($_POST['formdata'],true); $from=$date['from']; $to=$date['to'];
				if($from!='' && $to !='') 
				{ 
					$this->db->where("DATE(created_at) BETWEEN '$from' AND '$to'"); 
				}
				elseif($date['from'] !='')
				{ 
					$this->db->where("DATE(created_at) >= '$from'"); 
				}
				elseif($date['to'] !='') 
				{ 
					$this->db->where("DATE(created_at) <= '$to'"); 
				}
			}
			
    		$query = $this->db->get('orders');
    		$orders = $query->result();
			
		} else if($type=='nckBill'){
			$this->db->order_by('id','DESC');
		    $this->db->where('res_id',$rid);
			$this->db->where('order_status',4);
			
			// add filteration code

			if($_POST['isFilter']=='yes')
			{
		        $date=json_decode($_POST['formdata'],true); $from=$date['from']; $to=$date['to'];
				if($from!='' && $to !='') 
				{ 
					$this->db->where("DATE(created_at) BETWEEN '$from' AND '$to'"); 
				}
				elseif($date['from'] !='')
				{ 
					$this->db->where("DATE(created_at) >= '$from'"); 
				}
				elseif($date['to'] !='') 
				{ 
					$this->db->where("DATE(created_at) <= '$to'"); 
				}
			}
			
    		$query = $this->db->get('orders');
    		$orders = $query->result();
			
		} else {
		    $this->db->order_by('id','DESC');
		    $this->db->where('res_id',$rid);
		    $this->db->where('order_status',2);
		    
			if($_POST['isFilter']=='yes')
			{
		        $date=json_decode($_POST['formdata'],true); $from=$date['from']; $to=$date['to'];
				if($from!='' && $to !='') 
				{ 
					$this->db->where("DATE(created_at) BETWEEN '$from' AND '$to'"); 
				}
				elseif($date['from'] !='')
				{ 
					$this->db->where("DATE(created_at) >= '$from'"); 
				}
				elseif($date['to'] !='') 
				{ 
					$this->db->where("DATE(created_at) <= '$to'"); 
				}
			}
			
    		$query = $this->db->get('orders');
    		$orders = $query->result();
		}
	    
	    
	    $data = array(); $i=1;
        foreach ( $orders as $order )
        {
            if($order->order_status=='0'){ 
				$order_status='<span class="label label-success">OPEN</span>'; 
			}elseif($order->order_status=='1'){ 
				$order_status='<span class="label label-warning">CONFIRM</span>'; 
			}elseif($order->order_status=='2'){ 
				$order_status='<span class="label label-default">CLOSE</span>'; 
			}elseif($order->order_status=='3'){ 
				$order_status='<span class="label label-default">VOID BILL</span>'; 
			} else {
				$order_status='<span class="label label-default">NCK BILL</span>'; 
			}
		   
			$onclick = ($order->order_status=='0') ? 'disabled="disabled"' : 'onclick="updateOrder('. $order->order_id .',2)"';
			
			if (intval($order->payment_mode))
			{
				if($order->payment_mode == '1') 
				{ 
					$payment_mode ='<span class="label label-primary">CASH</span>';
				} 
				elseif($order->payment_mode == '2') 
				{ 
					$payment_mode='<span class="label label-info">ONLINE</span>';
				} 
				elseif($order->payment_mode == '3') 
				{ 
					$payment_mode='<span class="label label-danger">UPI QR SCAN</span>';
				} 
				elseif($order->payment_mode == '4')  
				{ 
					$payment_mode='<span class="label label-success">CARD SWIPE</span>';
				}
				elseif($order->payment_mode == '5')  
				{ 
					$payment_mode='<span class="label label-warning">BTC</span>';
				}
				elseif($order->payment_mode == '6')  
				{ 
					$payment_mode='<span class="label label-default">Swiggy</span>';
				}
				elseif($order->payment_mode == '7')  
				{ 
					$payment_mode='<span class="label label-default">Zomato</span>';
				}
				else 
				{
					$payment_mode='<span class="label label-default">Magic Pin</span>';
				}
			}
			else
			{
				$payment_mode = sprintf('<span class="label label-default">%s</span>', $this->paymentMethod($order->payment_mode, $order));
			}

            $sub_array   = array();
            $sub_array[] = $i;
            $sub_array[] = $order_status;
            $sub_array[] = $order->order_id;
            $sub_array[] = ($order->table_id) ? (($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-') : '-';
            $sub_array[] = $order->buyer_name;
            $sub_array[] = $order->buyer_phone_number;
            $sub_array[] = $order->order_type;
			$sub_array[] = $payment_mode;
			
			if($type=='reportorder'){ 
			$sub_array[] = $order->discount_coupon_percent;
			$sub_array[] = $order->flat_amount_discount ;
			}
			
			if($type=='voidBillReport' || $type=='nckBill'){
			    $sub_array[] = $order->reason;
			}
			
            
			if($type=='reportorder'){ 
                $sub_array[] = $order->created_at; 
                $sub_array[] = '<div class="text-right"><a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-sm btn-danger"> View</a></div>';
			
			
			} else if($type=='voidBillReport'){ 
                $sub_array[] = $order->created_at; 
                $sub_array[] = '<div class="text-right"><a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-sm btn-danger"> View</a></div>';
			
			
			} else if($type=='nckBill'){ 
                $sub_array[] = $order->created_at; 
                $sub_array[] = '<div class="text-right"><a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-sm btn-danger"> View</a></div>';
			
			
			} 
			
			else 
			
			{  
			    if ($order->order_status=='0') {

				$sub_array[] = '<div class="text-right">
				<a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-xs btn-success"> View</a>
				<div id="nckBillBtn-'. $order->order_id .'" title="NCK Bill" class="btn btn-xs btn-danger"> NCK Bill </div>
				</div>';
				
            } 	else if ($order->order_status=='1') {
				$sub_array[] = '<div class="text-right">
				<a href="'.base_url("Restaurant/orderlist?id=".$order->id).'" title="Edit" class="btn btn-xs btn-success" name="addMoreItems"> Add more items</a>
				<a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-xs btn-success"> View</a>
				<a href="javascript:void(0)" data-id="'. $order->id.'" class="btn btn-xs btn-default" '.$onclick.' >Close</a>
				<div id="nckBillBtn-'. $order->order_id .'" title="NCK Bill" class="btn btn-xs btn-danger"> NCK Bill </div>
				</div>';
            }
			
			else if ($order->order_status=='2') {
				
				$sub_array[] = '<div class="text-right">
				<a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-xs btn-success"> View</a>
				<div id="voidBillBtn-'. $order->order_id .'" title="Void Bill" class="btn btn-xs btn-danger"> Void Bill</div>
				</div>';
            }
            
			else if ($order->order_status=='3') {
				
				$sub_array[] = '<div class="text-right">
				<a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-xs btn-success"> View</a>
				</div>';
				
            } else if ($order->order_status=='4') {
                
                $sub_array[] = '<div class="text-right">
				<a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-xs btn-success"> View</a>
				<a href="javascript:getNckBill('. $order->order_id .')" title="NCK Bill" class="btn btn-xs btn-danger"> NCK Bill</a>
				</div>';
                
            } 
            
			}
            
            $data[] = $sub_array;
            $i++;
        }
        $output = array(
            "data"              => $data
        );

        echo json_encode( $output );
        exit;
	}
	
	public function exportSheet($type='csv',$rid=0,$from='',$to='')
	{
	    $rid = $this->session->userid;
	    $this->db->order_by('id','DESC');
	    $this->db->where('res_id',$rid);
	    $this->db->where('order_status',2);
	    
        if($from!='' && $to!=''){
	        if($from!='NaN' && $to!='NaN') { $from=date("Y-m-d",$from); $to=date("Y-m-d",$to); $this->db->where(" DATE(created_at) BETWEEN '$from' AND '$to'"); }
	        elseif($from!='NaN') { $from = date("Y-m-d",$from); $this->db->where(" DATE(created_at) >= '$from'"); }
	        elseif($to!='NaN') { $to = date("Y-m-d",$to); $this->db->where(" DATE(created_at) <= '$to'"); }
	    }
    	    
		$query = $this->db->get('orders');
		$orders = $query->result();


		$data[] = ['Order Status','Order Id','Table Id','Customer Name','Phone Number','Order Type','Payment Mode', 'Sub Total', 'Item Wise Discount', 'Discount %', 'Flat Discount', 'Discount Amount' , 'Total Discount', 'Total Amount After Discount', 'Total Tax', 'Grand Total Amount', 'Roundoff', 'Container Charge', 'Delivery Charge', 'Total Billed','Created Date'];
		
		$allOrdersSubTotalAmount = $allOrdersItemWiseDiscountAmount = $allOrdersDiscountPercentage = $allOrdersFlatDiscountAmount = $allOrdersDiscountAmount = $allOrdersDiscountTotalAmount = $allOrdersOrderTotalAfterDiscount = $allOrdersOrderItemTotalTaxAmount = $allOrdersGrandTotalAmount = $allOrdersTotalRoundOff = $allOrdersContainerCharge = $allOrdersDeliveryCharge = $allOrdersOrderTotal = 0;
		$allOrdersPaymentByCash = 0;
		$allOrdersPaymentByUpi = 0;
		$allOrdersPaymentByCard = 0;
		$allOrdersPaymentByBtc = 0;
		$allOrdersPaymentBySwiggy = 0;
		$allOrdersPaymentByZomato = 0;
		$allOrdersPaymentByMagicPin = 0;

		foreach ( $orders as $order )
        {
			$order = $this->combineOrders($order->order_id);

            if($order->order_status=='0'){ $order_status='OPEN'; }elseif($order->order_status=='1'){ $order_status='CONFIRM'; }else{ $order_status='CLOSE'; }

			$orderItemsData = $this->getOrderItemsData($order);
			$orderItemWiseDiscountAmount = $orderItemsData['itemDiscountAmount'];
			$invoiceDiscountAmount = $orderItemsData['invoiceDiscountAmount'];
			$orderSubTotalAmount = $orderItemsData['orderSubTotalAmount'];
			$orderItemTotalTaxAmount = $orderItemsData['itemTaxAmount'];

			$orderDiscountAmount = $order->flat_amount_discount;
			$orderFlatDiscountAmount = $order->flat_amount_discount;
			$orderDiscountPercentage = floatval($order->discount_coupon_percent);

			// Calculate the discount amount on percentage discount
			if ($orderDiscountPercentage > 0 && $orderDiscountAmount == 0)
			{
				// This is an old order so calculate its amount to the old way.
				if ($invoiceDiscountAmount == 0)
				{
					// For older calculation: Do not use this
					// $oldOrderTotal = $orderSubTotalAmount + $orderItemTotalTaxAmount; 

					$oldOrderTotal = $orderSubTotalAmount; 
					$oldOrderDiscountAmount = round(($oldOrderTotal * $orderDiscountPercentage) / 100, 2);
					$orderDiscountAmount = $oldOrderDiscountAmount;
					
					// Apply discount on tax amount
					$orderItemTotalTaxAmount = round($orderItemTotalTaxAmount - (($orderItemTotalTaxAmount * $orderDiscountPercentage) / 100), 2);
				}
				else
				{
					$orderDiscountAmount = $invoiceDiscountAmount;
				}
			}

			$orderDiscountTotalAmount = $orderDiscountAmount + $orderItemWiseDiscountAmount;
			$orderTotalAfterDiscount = $orderSubTotalAmount - $orderDiscountTotalAmount;
            
			$tableId = ($order->table_id) ? (($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-') : '-';
			$paymentMethod = $this->paymentMethod($order->payment_mode, $order);
			$containerCharge = floatval($order->container_charge);
			$deliveryCharge = floatval($order->delivery_charge);
			$orderGrandTotalAmount = round($orderTotalAfterDiscount + $orderItemTotalTaxAmount, 2);
			
			$roundOff = number_format(($order->total - $containerCharge - $deliveryCharge) - $orderGrandTotalAmount, 2, '.', '');

			$allOrdersSubTotalAmount += $orderSubTotalAmount;
			$allOrdersItemWiseDiscountAmount += $orderItemWiseDiscountAmount;
			$allOrdersDiscountPercentage += $orderDiscountPercentage;
			$allOrdersFlatDiscountAmount += $orderFlatDiscountAmount;
			$allOrdersDiscountAmount += $orderDiscountAmount;
			$allOrdersDiscountTotalAmount += $orderDiscountTotalAmount;
			$allOrdersOrderTotalAfterDiscount += $orderTotalAfterDiscount;
			$allOrdersOrderItemTotalTaxAmount += $orderItemTotalTaxAmount;
			$allOrdersGrandTotalAmount += $orderGrandTotalAmount;
			$allOrdersTotalRoundOff += $roundOff;
			$allOrdersContainerCharge += $containerCharge;
			$allOrdersDeliveryCharge += $deliveryCharge;
			$allOrdersOrderTotal += $order->total;

			$orderPaymentByCash = !is_null($order->amountPaidByCash) ? $order->amountPaidByCash : 0;
			$orderPaymentByUpi = !is_null($order->amountPaidByUpi) ? $order->amountPaidByUpi : 0;
			$orderPaymentByCard = !is_null($order->amountPaidByCard) ? $order->amountPaidByCard : 0;
			$orderPaymentByBtc = !is_null($order->amountPaidByBtc) ? $order->amountPaidByBtc : 0;
			$orderPaymentBySwiggy = !is_null($order->amountPaidBySwiggy) ? $order->amountPaidBySwiggy : 0;
			$orderPaymentByZomato = !is_null($order->amountPaidByZomato) ? $order->amountPaidByZomato : 0;
			$orderPaymentByMagicPin = !is_null($order->amountPaidByMagicPin) ? $order->amountPaidByMagicPin : 0;

			if (!is_null($order->payment_mode))
			{
				if ($order->payment_mode == PAYEMENT_MODE_CASH)
				{
					$orderPaymentByCash = is_null($order->amountPaidByCash) ? $order->total : 0;
				}
				else if ($order->payment_mode == PAYEMENT_MODE_UPI)
				{
					$orderPaymentByUpi = is_null($order->amountPaidByUpi) ? $order->total : 0;
				}
				else if ($order->payment_mode == PAYEMENT_MODE_CARD)
				{
					$orderPaymentByCard = is_null($order->amountPaidByCard) ? $order->total : 0;
				}
				else if ($order->payment_mode == PAYEMENT_MODE_SWIGGY)
				{
					$orderPaymentBySwiggy = is_null($order->amountPaidBySwiggy) ? $order->total : 0;
				}
				else if ($order->payment_mode == PAYEMENT_MODE_SWIGGY)
				{
					$orderPaymentByZomato = is_null($order->amountPaidByZomato) ? $order->total : 0;
				}
				else if ($order->payment_mode == PAYEMENT_MODE_SWIGGY)
				{
					$orderPaymentByMagicPin = is_null($order->amountPaidByMagicPin) ? $order->total : 0;
				}
			}

			$allOrdersPaymentByCash += $orderPaymentByCash;
			$allOrdersPaymentByUpi += $orderPaymentByUpi;
			$allOrdersPaymentByCard += $orderPaymentByCard;
			$allOrdersPaymentByBtc += $orderPaymentByBtc;
			$allOrdersPaymentBySwiggy += $orderPaymentBySwiggy;
			$allOrdersPaymentByZomato += $orderPaymentByZomato;
			$allOrdersPaymentByMagicPin += $orderPaymentByMagicPin;

			$row = [
				$order_status,
				$order->order_id,
				$tableId,
				$order->buyer_name,
				$order->buyer_phone_number,
				$order->order_type,
				$paymentMethod,
				$orderSubTotalAmount,
				$orderItemWiseDiscountAmount,
				$orderDiscountPercentage,
				$orderFlatDiscountAmount,
				$orderDiscountAmount,
				$orderDiscountTotalAmount,
				$orderTotalAfterDiscount,
				$orderItemTotalTaxAmount,
				$orderGrandTotalAmount,
				$roundOff,
				$containerCharge,
				$deliveryCharge,
				$order->total,
				$order->created_at,	
			];

			$data[] = $row;
		}
		
		if (count($data) > 1)
		{
			$row = [
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				$allOrdersSubTotalAmount,
				$allOrdersItemWiseDiscountAmount,
				$allOrdersDiscountPercentage,
				$allOrdersFlatDiscountAmount,
				$allOrdersDiscountAmount,
				$allOrdersDiscountTotalAmount,
				$allOrdersOrderTotalAfterDiscount,
				$allOrdersOrderItemTotalTaxAmount,
				$allOrdersGrandTotalAmount,
				$allOrdersTotalRoundOff,
				$allOrdersContainerCharge,
				$allOrdersDeliveryCharge,
				$allOrdersOrderTotal,
				''	
			];
			
			$data[] = $row;
		}

		$totalDataCount = count($data);

		if ($totalDataCount > 1)
		{
			
			$orderStatsByPaymentModes = $this->ordermodel->getOrderRevenuByPaymentModes($rid, ORDER_STATUS_CLOSE, $from, $to);

			if (!empty($orderStatsByPaymentModes))
			{
				$paymentRow[] = 'Total Payment By Cash';
				$paymentRow[] = 'Total Payment By Online';
				$paymentRow[] = 'Total Payment By UPI';
				$paymentRow[] = 'Total Payment By Card';
				$paymentRow[] = 'Total Payment By BTC';
				$paymentRow[] = 'Total Payment By Swiggy';
				$paymentRow[] = 'Total Payment By Zomato';
				$paymentRow[] = 'Total Payment By Magic Pin';

				$data[] = $paymentRow;

				unset($paymentRow);
				
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByCash'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByOnline'] ?? 0; 
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByUpi'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByCard'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByBtc'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentBySwiggy'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByZomato'] ?? 0;
				$paymentRow[] = $orderStatsByPaymentModes['totalPaymentByMagicPin'] ?? 0;

				$data[] = $paymentRow;
			}
		}
		
        if('excel'==strtolower($type)) {
            $this->getExcel($data);
        }
        elseif('csv'==strtolower($type)) {
            $this->getCSV($data);
        }
        else {
            echo 'No other sheet and data available.';
            return false;
        }
	}
	
	
	public function exportSheetForNck($type='csv',$rid=0,$from='',$to='')
	{
	    $rid = $this->session->userid;
	    $this->db->order_by('id','DESC');
	    $this->db->where('res_id',$rid);
	    $this->db->where('order_status',4);
	    
        if($from!='' && $to!=''){
	        if($from!='NaN' && $to!='NaN') { $from=date("Y-m-d",$from); $to=date("Y-m-d",$to); $this->db->where(" DATE(created_at) BETWEEN '$from' AND '$to'"); }
	        elseif($from!='NaN') { $from = date("Y-m-d",$from); $this->db->where(" DATE(created_at) >= '$from'"); }
	        elseif($to!='NaN') { $to = date("Y-m-d",$to); $this->db->where(" DATE(created_at) <= '$to'"); }
	    }
    	    
		$query = $this->db->get('orders');
		$orders = $query->result();
		
		$data[] = ['Order Status','Order Id','Table Id','Customer Name','Phone Number','Order Type','Payment Mode', 'Reason', 'Sub Total', 'Total Tax', 'Total Amount', 'Roundoff', 'Total Billed','Created Date'];
		
		$grandTotalTaxes = $grandSubTotal = $grandTotalAmount = $grandRoundOff = $grandTotalBilledAmount = 0;

		foreach ( $orders as $order )
        {
			$order = $this->combineOrders($order->order_id);

            if($order->order_status=='0'){ $order_status='OPEN'; }elseif($order->order_status=='4'){ $order_status='NCK BILL'; }
			$CartLists=json_decode($order->item_details, true);
			
			$totalTaxes = 0;
			$subTotal = $this->calculateItemsSubtotal($order);
			$allCombinedTaxes = $this->calculateAllCombinedTaxes($order);
			
			foreach($allCombinedTaxes as $taxName => $taxValue)
			{
				$totalTaxes += $taxValue;
			}

			$totalAmount = $subTotal + $totalTaxes;
			$totalAmount = number_format($totalAmount, 2, '.', '');
			$totalBilledAmount = $this->cartTotal($CartLists,'no',$rid);
			$roundOff = number_format($totalBilledAmount - $totalAmount, 2, '.', '');

            $sub_array   = array();
            $sub_array[] = $order_status;
            $sub_array[] = $order->order_id;
            $sub_array[] = ($order->table_id) ? ($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-' : '-';
            $sub_array[] = $order->buyer_name;
            $sub_array[] = $order->buyer_phone_number;
            $sub_array[] = $order->order_type;
            $sub_array[] = $this->paymentMethod($order->payment_mode, $data['order']);
            $sub_array[] = $order->reason;
            $sub_array[] = $subTotal;
            $sub_array[] = $totalTaxes; 
            $sub_array[] = $totalAmount; 
            $sub_array[] = $roundOff; 
            $sub_array[] = $totalBilledAmount; 
            $sub_array[] = $order->created_at; 

			$grandTotalTaxes += $totalTaxes;
			$grandSubTotal += $subTotal;
			$grandTotalAmount += $totalAmount;
			$grandRoundOff += $roundOff;
			$grandTotalBilledAmount += $totalBilledAmount;

            $data[] = $sub_array;
		}
		
		if (count($data) > 1)
		{
			$sub_array   = array();
			$sub_array[] = '';
            $sub_array[] = '';
           	$sub_array[] = '';
           	$sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = $grandSubTotal;
            $sub_array[] = $grandTotalTaxes; 
            $sub_array[] = $grandTotalAmount; 
            $sub_array[] = $grandRoundOff; 
            $sub_array[] = $grandTotalBilledAmount; 
			$sub_array[] = '';
			
			$data[] = $sub_array;
		}

        
        if('excel'==strtolower($type)) {
            $this->getExcel($data);
        }
        elseif('csv'==strtolower($type)) {
            $this->getCSV($data);
        }
        else {
            echo 'No other sheet and data available.';
            return false;
        }
	}
	
		
	
	
	public function getExcel($data=array())
	{
	    $report = array();
	    
	    foreach ($data as $row) {
            $report[] = $row;
        }
        
        $xlsx = SimpleXLSXGen::fromArray( $report );
        // $xlsx->saveAs('books.xlsx');
        $xlsx->download();
	}
	
	public function getCSV($data=array())
	{
	    $filename = gmdate('YmdHis') . '.csv';
	    
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s \G\M\T' , time() ));
        header('Pragma: no-cache');
        header('Expires: 0');
         
        // create a file pointer connected to the output stream
        $file = fopen('php://output', 'w');
         
        // send the column headers fputcsv($file, $columnArray);
         
        // output each row of the data
        foreach ($data as $row)
        {
            fputcsv($file, $row);
        }
         
        // Close the file
        fclose($file);
	}
	
	public function translist($type="")
	{
		$rid = $this->session->userid;
	    $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
		$condition = array('rest_id'=>$rid, 'DATE(created)'=> $curr_date);
	    $data['transactions'] = $this->restaurantModel->getTransList($condition);
	    $this->load->view('restaurant/translist', $data);
	}
	
	public function reporttranslist($type="")
	{
		$rid = $this->session->userid;
	    $condition = array('rest_id'=>$rid);
	    $data['transactions'] = $this->restaurantModel->getTransList($condition);
	    $this->load->view('restaurant/reporttranslist', $data);
	}
	
	public function printInvoice($orderid=0)
	{
	    $condition = array('order_id'=>$orderid, 'res_id' => $this->session->userid);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
        $this->load->view('restaurant/invoice', $data);
	}
	
	public function printInvoice2($orderid=0)
	{
	    $data=array();
        $condition = array('order_id'=>$orderid, 'res_id' => $this->session->userid);
		$data['order'] = $this->restaurantModel->getOrderList($condition)[0];

		$subOrderId = $this->input->get('id');
		
		if (intval($subOrderId) > 0)
		{
			$subOrder = $this->ordermodel->getSubOrders(0, $subOrderId);
			if (!empty($subOrder))
			{
				$data['order'] = (object) $subOrder[0];

				$data['order']->order_id = $orderid;
			}
		}


		$data['showTaxColumn'] = $this->checkIfTaxIsAvaliable($data['order']);
		$data['paymentMethodName'] = $this->paymentMethod($data['order']->payment_mode, $data['order']);

        $stylesheet = file_get_contents('/home/yd93k4ea02s3/public_html/MDB/assets/css/print2.css');
        $html = $this->load->view( 'restaurant/invoice_2', $data, true );
        
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPageByArray( [
            'orientation'   => '',
            'margin-left'   => 5,
            'padding'       => 0,
            'margin-right'  => 5,
            'margin-top'    => 1,
            'margin-bottom' => 1,
            'sheet-size'    => 'A7'
        ] ); 
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output();
	}
	
	public function printInvoice3($orderId=0)
	{
		$data=array();
		
        $data['order'] = $this->combineOrders($orderId);
		$data['showTaxColumn'] = $this->checkIfTaxIsAvaliable($data['order']);
		$data['orderTaxes'] = $this->getOrderTaxes($data['order']);

		$data['paymentMethodName'] = $this->paymentMethod($data['order']->payment_mode, $data['order']);

		// $stylesheet = file_get_contents('/home/yd93k4ea02s3/public_html/MDB/assets/css/print2.css');
		$stylesheet = ".center {
			position: absolute;
			-webkit-text-fill-color: transparent;
			-webkit-background-clip: text;
			font-size: 32px;
			color: red;
			font-weight: bold;
			margin: auto;
			left: 11%;
			width: 70%;
			border: 5px solid red;
			border-radius: 3%;
			padding: 10px;
			text-align: center;
		}";

        $html = $this->load->view( 'restaurant/invoice_3', $data, true );
        
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPageByArray( [
            'orientation'   => '',
            'margin-left'   => 5,
            'padding'       => 0,
            'margin-right'  => 5,
            'margin-top'    => 1,
            'margin-bottom' => 1,
            'sheet-size'    => 'A7'
        ]); 
		
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output();
	}

	public function combineOrders($orderId)
	{
		$order = $this->restaurantModel->getOrderList([
			'order_id'=>$orderId, 
			'res_id' => $this->session->userid
		])[0];

		$orderItemDetails = json_decode($order->item_details, true);

		if (!empty($order))
		{
			$subOrders = $this->ordermodel->getSubOrders($order->id);

			if (!empty($subOrders))
			{
				$totalSubOrder = floatval($order->orderTotal);

				foreach ($subOrders as $subOrder)
				{
					$subOrderItemDetails = json_decode($subOrder['item_details'], true);
					
					foreach($subOrderItemDetails as $subOrderProductId => $subOrderItemDetail)
					{
						$subOrderProductType = key($subOrderItemDetail);

						if (isset($orderItemDetails[$subOrderProductId]))
						{
							if (isset($orderItemDetails[$subOrderProductId][$subOrderProductType]))
							{

								$orderItemCount = $orderItemDetails[$subOrderProductId][$subOrderProductType]['itemCount'];
								$orderItemTotalTax = $orderItemDetails[$subOrderProductId][$subOrderProductType]['itemTotalTax'] ?? 0;								
								$orderItemTotalAmount = $orderItemDetails[$subOrderProductId][$subOrderProductType]['itemTotalAmount'] ?? 0;								
								$orderItemDiscountAmount = $orderItemDetails[$subOrderProductId][$subOrderProductType]['itemDiscountAmount'] ?? 0;
								
								$subOrderItemCount = $subOrderItemDetail[$subOrderProductType]['itemCount'];
								$subOrderItemTotalTax = $subOrderItemDetail[$subOrderProductType]['itemTotalTax'] ?? 0;
								$subOrderItemTotalAmount = $subOrderItemDetail[$subOrderProductType]['itemTotalAmount'] ?? 0;
								$subOrderItemDiscountAmount = $subOrderItemDetail[$subOrderProductType]['itemDiscountAmount'] ?? 0;

								$totalItemCount = $orderItemCount + $subOrderItemCount;
								
								$orderItemDetails[$subOrderProductId][$subOrderProductType]['itemCount'] = $totalItemCount;
								$orderItemDetails[$subOrderProductId][$subOrderProductType]['itemTotalTax'] = $orderItemTotalTax + $subOrderItemTotalTax;
								$orderItemDetails[$subOrderProductId][$subOrderProductType]['itemDiscountAmount'] = $orderItemDiscountAmount + $subOrderItemDiscountAmount;
								$orderItemDetails[$subOrderProductId][$subOrderProductType]['itemTotalAmount'] = $orderItemTotalAmount + $subOrderItemTotalAmount;
							}
							else
							{
								$orderItemDetails[$subOrderProductId][$subOrderProductType] = $subOrderItemDetail[$subOrderProductType];
							}
						}
						else
						{
							$orderItemDetails[$subOrderProductId] = $subOrderItemDetail;
						}
					}

					$order->discount_coupon_percentage = floatval($order->discount_coupon_percentage) + floatval($subOrder['discount_coupon_percentage']);
					$order->flat_amount_discount = floatval($order->flat_amount_discount) + floatval($subOrder['flat_amount_discount']);
					$order->delivery_charge = floatval($order->delivery_charge) + floatval($subOrder['delivery_charge']);
					$order->container_charge = floatval($order->container_charge) + floatval($subOrder['container_charge']);
					
					$totalSubOrder += floatval($subOrder['orderTotal']);
				}
				
				if ($totalSubOrder > 0)
				{
					$order->total = round($totalSubOrder);
				}
			}

			$order->item_details = json_encode($orderItemDetails);
		}

		return $order; 
	}

	public function checkIfTaxIsAvaliable($data)
	{
		return false;
		if (!empty($data))
		{
			$itemDetails = json_decode($data->item_details, true);
			foreach ($itemDetails as $item)
			{
				$key = key($item);
				if (isset($item[$key]) && isset($item[$key]['itemTaxes']))
				{
					return 1;
				}
			}
		}

		return 0;
	}
	
	public function getOrderTaxes($data)
	{
		$orderItemTaxes = [];
		if (!empty($data))
		{
			$itemLists = json_decode($data->item_details, true);
			foreach ($itemLists as $itemList)
			{
				foreach($itemList as $itemDetail)
				{

					if (!empty($itemDetail['itemTaxes']))
					{
						foreach($itemDetail['itemTaxes'] as $itemTax)
						{
							$orderItemTaxes[$itemTax['taxPercentage']] = $itemTax;
						}
					}
				}
			}
		}

		return $orderItemTaxes;
	}

	public function calculateAllCombinedTaxes($data)
	{
		$combineAllTaxes = [];
		if (!empty($data))
		{
			$itemLists = json_decode($data->item_details, true);
			foreach ($itemLists as $itemList)
			{
				foreach($itemList as $itemDetail)
				{
					if (!empty($itemDetail['itemTaxes']))
					{
						foreach ($itemDetail['itemTaxes'] as $itemTax)
						{
							$calculatedTax = ((($itemDetail['itemOldPrice'] * $itemDetail['itemCount'])) * $itemTax['taxPercentage']) / 100;
							$calculatedTax = round($calculatedTax, 2);

							$combineAllTaxes[] = ['taxName' => $itemTax['taxName'], 'taxAmount' => $calculatedTax];
						}
					}
				}
			}
		}

		if (!empty($combineAllTaxes))
		{
			$tempArr = [];
			foreach($combineAllTaxes as $tax)
			{
				if (!isset($tempArr[$tax['taxName']]))
				{
					$tempArr[$tax['taxName']] = round($tax['taxAmount'], 2);
				}
				else
				{
					foreach ($tempArr as $key => $val)
					{
						if ($key === $tax['taxName'])
						{
							$tempArr[$tax['taxName']] = round($tax['taxAmount'] + $val, 2);
						}
					}
				}
			}

			$combineAllTaxes = $tempArr;
		}

		return $combineAllTaxes;
	}

	private function getOrderItemsData($data)
	{
		$totalItemTaxAmount = 0;
		$totalItemDiscountAmount = 0;
		$totalInvoiceDiscountAmount = 0;
		$orderSubTotalAmount = 0;
		
		if (!empty($data))
		{
			$itemLists = json_decode($data->item_details, true);
			foreach ($itemLists as $itemList)
			{
				foreach($itemList as $itemDetail)
				{
					if (!empty($itemDetail['itemTaxes']))
					{
						if (isset($itemDetail['itemTotalTax']))
						{
							$totalItemTaxAmount += $itemDetail['itemTotalTax'];
						}
						else
						{
							$totalTaxPercentage = 0;
							if (!empty($itemDetail['itemTaxes']))
							{
								foreach ($itemDetail['itemTaxes'] as $itemTax)
								{
									$totalTaxPercentage += $itemTax['taxPercentage'];
								}
							}

							if ($totalTaxPercentage > 0)
							{
								$totalItemTaxAmount += round((($itemDetail['itemOldPrice'] * $itemDetail['itemCount']) * $totalTaxPercentage) / 100, 2);
							}
						}
					}

					$orderSubTotalAmount += ($itemDetail['itemCount'] * (isset($itemDetail['itemOldPrice']) ? $itemDetail['itemOldPrice'] : $itemDetail['itemPrice']));

					$totalInvoiceDiscountAmount += $itemDetail['invoiceDiscount']['invoiceDiscountAmount'] ?? 0;
					$totalItemDiscountAmount += $itemDetail['itemDiscountAmount'] ?? 0;
				}
			}
		}

		return [
			'itemDiscountAmount' => $totalItemDiscountAmount,
			'itemTaxAmount' => $totalItemTaxAmount,
			'invoiceDiscountAmount' => $totalInvoiceDiscountAmount,
			'orderSubTotalAmount' => $orderSubTotalAmount,
		];
	}

	public function calculateItemsSubtotal($data)
	{
		$subTotal = 0;
		if (!empty($data))
		{
			$itemLists = json_decode($data->item_details, true);
			foreach ($itemLists as $itemList)
			{
				foreach($itemList as $itemDetail)
				{
					$subTotal += ($itemDetail['itemCount'] * (isset($itemDetail['itemOldPrice']) ? $itemDetail['itemOldPrice'] : $itemDetail['itemPrice']));
				}
			}
		}

		return $subTotal;
	}

	public function getOrderView($postdata=array())
	{
	    if(!empty($_POST))
	    {
            $postdata = $_POST;
	    }
		
		$data['order'] = $this->combineOrders($postdata['orderID']);

		$subOrders = $this->ordermodel->getSubOrders($data['order']->id);

		if (!empty($subOrders))
		{
			$data['kotPrintBtns'] = $this->kotPrintBtns($subOrders, $postdata['orderID']);
		}
		else
		{
			$data['kotPrintBtns'] = '';
		}

		$data['paymentMethodName'] = $this->paymentMethod($data['order']->payment_mode, $data['order']);
		
		$rid = $this->session->userid;
		$data['percentOff'] = $this->restaurantModel->getOnlyDiscountList($rid);

		$this->load->view('restaurant/orderPopup', $data);
	}


	public function getKotBtns($orderId)
	{
		$data['order'] = $this->combineOrders($orderId);
		$data['kotPrintBtns'] = $this->kotPrintBtns($this->ordermodel->getSubOrders($data['order']->id), $orderId);

		echo  json_encode([
			'kotPrintBtns' => $data['kotPrintBtns']
		]);
	}

	private function kotPrintBtns($subOrders, $orderId)
	{
		$kotPrintUrl = base_url("Restaurant/printInvoice2/". $orderId);
		$btn = sprintf('<button type="button" class="btn btn-primary mr-10 kotBillPrint" data-print="%s" removed="window.open(\'%s\', \'_blank\')">KOT Print %s</button>', $kotPrintUrl, $kotPrintUrl, 1);
		if (!empty($subOrders))
		{
			foreach($subOrders as $key => $subOrder)
			{	
				$printKey = $key + 2;
				$fullPrintUrl = sprintf("%s?id=%s", $kotPrintUrl, $subOrder['id']);
				$btn .= sprintf('<button type="button" class="btn btn-primary mr-10 kotBillPrint" data-print="%s"  removed="window.open(\'%s\', \'_blank\')">KOT Print %s</button>', $fullPrintUrl, $fullPrintUrl, $printKey);
			}
		}

		return $btn;
	}

	//11-10-2020
	public function getVoidBill($postdata=array())
	{
	    if(!empty($_POST))
	    {
            $postdata = $_POST;
	    }
		
        $condition = array('order_id'=>$postdata['orderID'], 'res_id' => $this->session->userid);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
		$data['paymentMethodName'] = $this->paymentMethod($data['order']->payment_mode, $data['order']);
        $this->load->view('restaurant/voidBillPopup', $data);
	}
	
	//13-10-2020
	public function getNckBill($postdata=array())
	{
	    if(!empty($_POST))
	    {
            $postdata = $_POST;
	    }
		
        $condition = array('order_id'=>$postdata['orderID'], 'res_id' => $this->session->userid);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
		$data['paymentMethodName'] = $this->paymentMethod($data['order']->payment_mode, $data['order']);
        $this->load->view('restaurant/nckBillPopup', $data);
	}

	public function paymentMethod($paymentId, $order = null)
	{
		$paymentModes = [
			1 => 'CASH',
			2 => 'ONLINE',
			3 => 'UPI QR SCAN',
			4 => 'CARD SWIPE',
			5 => 'BTC',
			6 => 'Swiggy',
			7 => 'Zomato',
			8 => 'Magic Pin'
		];

		// Check if this order has partial payments
		if (isset($order->amountPaidByMultiplePaymentMethods) && isset($order->partialPaymentMethodData))
		{
			if (!empty($order->amountPaidByMultiplePaymentMethods) && !empty($order->partialPaymentMethodData))
			{
				$partialPaymentMethodData = json_decode($order->partialPaymentMethodData, true);
				$paymentMethodNames = [];
				foreach($partialPaymentMethodData as $paymentMethod)
				{
					if (isset($paymentModes[$paymentMethod['partialPaymentMethodType']]))
					{
						$paymentMethodNames[] =  $paymentModes[$paymentMethod['partialPaymentMethodType']];
					}
				}

				return !empty($paymentMethodNames) ? implode(', ', $paymentMethodNames) : 'ONLINE';
			}
		}
		else
		{
			return isset($paymentModes[$paymentId]) ? $paymentModes[$paymentId] : 'ONLINE';
		}
	}
	
	public function cartTotal($cartArray=array(), $tax='yes', $rest_id=0)
	{
	    $itemTotalPrice='';
	    if(!empty($cartArray))
	    {
			foreach($cartArray as $itemId => $itemArray)
			{
				$manageCartList = $this->manageCartList($itemArray);
				
				if($itemTotalPrice == '') 
				{ 
					$itemTotalPrice = $manageCartList['itemNetPrice']; 
				}
				else 
				{ 
					$itemTotalPrice = $itemTotalPrice + $manageCartList['itemNetPrice']; 
				}
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
	public function manageCartList($cartArray=array())
	{
	    $itemName=''; $itemImage=''; $itemNetPrice = 0; $tempArr=array();
	    if(!empty($cartArray))
	    {
	        foreach($cartArray as $itemId => $itemData):
	            if($itemName == '') { $itemName=$itemData['itemName']; }
	            if($itemImage == '') { $itemImage=$itemData['itemImage']; }

				if (isset($itemData['itemTotalAmount']))
				{
					$itemNetPrice += $itemData['itemTotalAmount'];
				}
				else
				{
					$itemNetPrice += ($itemData['itemPrice'] * $itemData['itemCount']);
				}
	        endforeach;
	    }
	    $tempArr['itemName']=$itemName;
	    $tempArr['itemImage']=$itemImage;
	    $tempArr['itemNetPrice']=$itemNetPrice;

		return $tempArr;
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
	
	public function cartRemove()
	{
	    $cartArray=array();
	    
	    if(!empty($_POST))
	    {
	        $rid = $this->session->userid;
	        $condition = array('order_id'=>$_POST['orderID'], 'res_id' => $this->session->userid);
	        $order = $this->restaurantModel->getOrderList($condition)[0];
	        
	        $cartArray = json_decode($order->item_details, true);
	        
	        unset($cartArray[$_POST['itemID']][$_POST['itemType']]);
	        
	        if(empty($cartArray[$_POST['itemID']]))
	        {
	            unset($cartArray[$_POST['itemID']]);
	        }
	        
	        $data['item_details'] = json_encode($cartArray);
			$data['total'] = $this->cartTotal($cartArray, 'yes', $rid);

			$this->restaurantModel->placeOrder($data, $condition);
	    }
	    
	    
	    $this->getOrderView($_POST);
	}
	
	public function updateOrderStatus()
	{

		$condition = array(
			'order_id' => $_POST['orderID'], 
			'res_id' => $this->session->userid
		);

		$data['order_status'] = $_POST['status'];
		$this->restaurantModel->placeOrder($data, $condition);
		
	}  
	
	public function getTableDetail($tableID=0)
	{
	    $data=array();
	    if($tableID!=0) {
	        $data = $this->restaurantModel->getTableInfo($tableID);
	    }
	    
	    return $data;
	}
	
	public function getRestaurantDetail($Rst_ID=0)
	{
	    $data=array();
        $condition=array('rest_id'=>$Rst_ID);
	    $data=$this->restaurantModel->getRestaurantList($condition);
	    
	    return $data;
	}
	
	public function getOrderDetailByTnx($Tnx=0)
	{
	    $data=array();
        $condition = array('txn_id'=>$Tnx);
        $data = $this->restaurantModel->getOrderList($condition);
	    
	    return $data;
	}
	
	
	public function exportSheetForVoid($type='csv',$rid=0,$from='',$to='')
	{
	    $rid = $this->session->userid;
	    $this->db->order_by('id','DESC');
	    $this->db->where('res_id',$rid);
	    $this->db->where('order_status',3);
	    
        if($from!='' && $to!=''){
	        if($from!='NaN' && $to!='NaN') { $from=date("Y-m-d",$from); $to=date("Y-m-d",$to); $this->db->where(" DATE(created_at) BETWEEN '$from' AND '$to'"); }
	        elseif($from!='NaN') { $from = date("Y-m-d",$from); $this->db->where(" DATE(created_at) >= '$from'"); }
	        elseif($to!='NaN') { $to = date("Y-m-d",$to); $this->db->where(" DATE(created_at) <= '$to'"); }
	    }
    	    
		$query = $this->db->get('orders');
		$orders = $query->result();
		
		$data[] = ['Order Status','Order Id','Table Id','Customer Name','Phone Number','Order Type','Payment Mode', 'Reason', 'Sub Total', 'Total Tax', 'Total Amount', 'Roundoff', 'Total Billed','Created Date'];
		
		$grandTotalTaxes = $grandSubTotal = $grandTotalAmount = $grandRoundOff = $grandTotalBilledAmount = 0;

		foreach ( $orders as $order )
        {
			$order = $this->combineOrders($order->order_id);

            if($order->order_status=='0'){ $order_status='OPEN'; }elseif($order->order_status=='1'){ $order_status='CONFIRM'; }elseif($order->order_status=='2'){ $order_status='CLOSE'; }else{ $order_status='VOID BILL'; }
			$CartLists=json_decode($order->item_details, true);
			
			$totalTaxes = 0;
			$subTotal = $this->calculateItemsSubtotal($order);
			$allCombinedTaxes = $this->calculateAllCombinedTaxes($order);
			
			foreach($allCombinedTaxes as $taxName => $taxValue)
			{
				$totalTaxes += $taxValue;
			}

			$totalAmount = $subTotal + $totalTaxes;
			$totalAmount = number_format($totalAmount, 2, '.', '');
			$totalBilledAmount = $this->cartTotal($CartLists,'no',$rid);
			$roundOff = number_format($totalBilledAmount - $totalAmount, 2, '.', '');

            $sub_array   = array();
            $sub_array[] = $order_status;
            $sub_array[] = $order->order_id;
            $sub_array[] = ($order->table_id) ? ($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-' : '-';
            $sub_array[] = $order->buyer_name;
            $sub_array[] = $order->buyer_phone_number;
            $sub_array[] = $order->order_type;
            $sub_array[] = $this->paymentMethod($order->payment_mode, $order);
            $sub_array[] = $order->reason;
            $sub_array[] = $subTotal;
            $sub_array[] = $totalTaxes; 
            $sub_array[] = $totalAmount; 
            $sub_array[] = $roundOff; 
            $sub_array[] = $totalBilledAmount; 
            $sub_array[] = $order->created_at; 

			$grandTotalTaxes += $totalTaxes;
			$grandSubTotal += $subTotal;
			$grandTotalAmount += $totalAmount;
			$grandRoundOff += $roundOff;
			$grandTotalBilledAmount += $totalBilledAmount;

            $data[] = $sub_array;
		}
		
		if (count($data) > 1)
		{
			$sub_array   = array();
			$sub_array[] = '';
            $sub_array[] = '';
           	$sub_array[] = '';
           	$sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = '';
            $sub_array[] = $grandSubTotal;
            $sub_array[] = $grandTotalTaxes; 
            $sub_array[] = $grandTotalAmount; 
            $sub_array[] = $grandRoundOff; 
            $sub_array[] = $grandTotalBilledAmount; 
			$sub_array[] = '';
			
			$data[] = $sub_array;
		}

        
        if('excel'==strtolower($type)) {
            $this->getExcel($data);
        }
        elseif('csv'==strtolower($type)) {
            $this->getCSV($data);
        }
        else {
            echo 'No other sheet and data available.';
            return false;
        }
	}
	
	
	
	public function verifyMangerPassword()
	{	
		$user_id = $this->session->userdata('userid');
		
		$managerPassword = $this->restaurantModel->getManagerPass($user_id);
		
		if($_POST['managerPassword'] == $managerPassword) {
			$condition = array(
				'order_id' => $_POST['orderID'], 
				'res_id' => $this->session->userid
			);

			$data['order_status'] = 3;
			$data['reason'] = $_POST['reason'];

			$this->restaurantModel->placeOrder($data, $condition);
							
			echo 'correct';
		} else {
			echo '<span>Incorrect password</span>';
		}
	}
	
	public function verifyMangerPasswordForNck()
	{	
		$user_id = $this->session->userdata('userid');
		$managerPassword = $this->restaurantModel->getManagerPass($user_id);

		if($_POST['managerPasswordForNck'] == $managerPassword) {
			$condition = array(
				'order_id' => $_POST['orderID'], 
				'res_id' => $this->session->userid
			);
			
			$data['order_status'] = 4;
            $data['reason'] = $_POST['reasonForNck'];
			$this->restaurantModel->placeOrder($data, $condition);
			echo 'correct';
		} else {
			echo '<span>Incorrect password</span>';
		}
	
	}
    
    
    public function addDiscount()
	{
	    if(isset($_POST) && !empty($_POST))
	    {
	        $discName = trim($_POST['discName']);
	        $discPercent = trim($_POST['discPercent']);
			$rid = $this->session->userid;

	        $data = array(
				'discount_name' => $discName,
				'discount_percent' => $discPercent,
				'rest_id' => $rid
			);
			
			if($this->restaurantModel->insertDiscountInfo($data))
	           {
	               $this->session->set_flashdata('Success MSG','Tax Information Inserted...');
	               redirect('Restaurant/discountList','refresh');
	           }
		}
			    
	    $this->load->view('restaurant/addDiscount');
	}

	public function deleteDiscount($id)
	{
	    if($this->restaurantModel->deleteDiscountInfo($id))
	        $this->session->set_flashdata('Success MSG','Record Deleted Successfully...');
		else
		    $this->session->set_flashdata('Fail MSG','Error in record deletion...');
		
		redirect('Restaurant/discountList','refresh');
	}
	
	public function discountList()
	{
		$rid = $this->session->userid;
	    $condition = array('rest_id'=>$rid);
	    $data['discount'] = $this->restaurantModel->getDiscountList($condition);
	    $this->load->view('restaurant/discountList', $data);
	}


	public function check_offer_coupon_and_apply()
	{
		$discValue = $_POST['discPercent'];
		
		//diccount percentage
		$this->session->set_userdata('discPercent',$discValue);
		
		
		$finalDisc = $discValue / 100;
		$amount = $this->session->userdata('totalAmt');
		$finalAmount = round($amount - ($amount * $finalDisc));
		
		$this->session->set_userdata('finalDiscAmount',$finalAmount);
		// subtract percent from total
		echo '<span style="color:black">Discount Added! Total Amount to pay is ₹</span>'.'<span style="color:black;">'.$finalAmount.'</span>';

	}


	public function apply_flat_amount_off(){
		$offerAmount = $_POST['amountOff'];
		//flat off price 
		$this->session->set_userdata('flatAmountPrice',$offerAmount);
		$amount = $this->session->userdata('totalAmt');
		$finalAmount = round($amount - $offerAmount);
		$this->session->set_userdata('finalFlatOffAmount',$finalAmount);
		echo '<span style="color:black">Flat Discount Amount Added! Total Amount to pay is ₹</span>'.'<span style="color:black;">'.$finalAmount.'</span>';

	}

	
}