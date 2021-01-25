<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Selfbilling extends CI_Controller 
{
    public function __construct()
	{
        parent::__construct();
        $this->load->library('session');
		if($this->session->email == "")
        {
            redirect('login');
        }
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('UserModel','usermodel');
		$this->load->model('OrderModel','ordermodel');
		$this->load->model('SuborderModel','subordermodel');
        $this->load->model('SelfbillingModel','Selfbilling');
		$this->load->model('restaurant/RestaurantModel','restaurantModel');
	}

    public function index()
    {
        $this->load->view('self-billing/selfbilling');
    }

    public function getMenuItems()
    {
        header('Access-Control-Allow-Origin: *');  
		header("Content-Type: application/json", true);
        $search = $this->input->get('search');
        $userId = $this->session->userid;
        $results = $this->Selfbilling->getMenuItems($userId, $search);
        
        if(!empty($results))
        {
            foreach ($results as &$result) {
                $priceDesc = json_decode($result['price_desc']);

                $taxDetails = [];
                $result['price'] = json_decode($result['price']);
                $result['price_desc'] = !empty(trim($priceDesc[0])) ? $priceDesc : [];

                if(!empty($result['taxes']))
                {
                    $taxId = unserialize($result['taxes']);
                    $taxes = $this->Selfbilling->getTaxList($taxId, $userId);
                    
                    foreach ($taxes as $tax) 
                    {
                        $taxDetails[] = ['taxName' =>  $tax['tax_type'], 'taxPercentage' => $tax['tax_percent']];
                    }

                    $result['taxes'] = $taxDetails;
                }
            }
        }
       
        $data['items'] = $results;
        echo json_encode($data);
    }

    public function lastOrder($restId)
    {
        $O_ID = 10000001;
        $data = $this->usermodel->lastOrder($restId);
        if(!empty($data))
        {
            if($data[0]->order_id == '') 
            { 
                $O_ID = $O_ID; 
            }
            else 
            { 
                $O_ID = $data[0]->order_id + 1; 
            }
        }
        
        return $O_ID;
    }

    private function calculateTaxOnPrice($itemPrice, $taxes)
    {
        $totalTax = 0;
        if (!empty($taxes))
        {
            foreach($taxes as $tax)
            {
                $itemTax = ($itemPrice * $tax['taxPercentage']) / 100;
                $totalTax += $itemTax; 
            }

            $totalTax = number_format($totalTax, 2, '.', '');
        }

        return $totalTax;
    }

    public function saveSelfBilling()
    {   
        header('Access-Control-Allow-Origin: *');  
		header("Content-Type: application/json", true);
        $postData = $this->input->post();
        
        foreach($postData['selectedItem'] as &$items) 
        {
            $itemDiscountAmount = $itemDiscountAmountOriginal = floatval($items['itemDiscountAmount'] ?? 0);

            $itemPrice = $items['itemPrice'];
            $itemDiscountType = $items['itemDiscountType'] ?? '';
            $itemDiscountValue = $items['itemDiscountValue'] ?? 0;

            if ($itemDiscountValue > 0)
            {
                $itemDiscountAmountTax = $this->calculateTaxOnPrice(($itemDiscountAmount), $items['itemTaxDetails']);
                $itemDiscountAmount = $itemDiscountAmount - $itemDiscountAmountTax;
            }
            
            $itemTax = $this->calculateTaxOnPrice($itemPrice, $items['itemTaxDetails']);

            $totalPrice = (floatval($itemPrice) + floatval($itemTax)); 
            $itemType = isset($items['itemType']) ? $items['itemType']: "";
            
            $itemInfo = [
                "itemName" => $items['itemName'],
                "itemNote" => $items['specialNote'] ?? '',
                "itemPrice"=> $totalPrice,
                "itemImage"=> "",
                "itemType"=> $itemType,
                "itemOldPrice"=> floatval($itemPrice), 
                "itemFoodType"=> "",
                "itemCount"=> $items['itemQty'],
                "itemTaxes"=> $items['itemTaxDetails'],
                "itemDiscountAmount" => $itemDiscountAmount,
                "itemDiscountAmountOriginal" => $itemDiscountAmountOriginal
            ];


            if ($itemDiscountAmount > 0)
            {
                $itemInfo['itemDiscountType'] = $itemDiscountType;
                $itemInfo['itemDiscountValue'] = $itemDiscountValue;
                $itemInfo['itemTotalAmountWithoutDiscount'] = $items['itemTotalAmountWithoutDiscount'] ?? '';
            }

            $items = [
                $itemType => $itemInfo
            ];
        }

        $userId = $this->session->userid;
        $orderId = $this->lastOrder($userId);
        $items = json_encode($postData['selectedItem']);
        
        $data = [
            "order_id" => $orderId,
            "res_id" => $userId,
            "buyer_name" => $postData['customerName'],
            "buyer_address" => $postData['address'],
            "buyer_phone_number" => $postData['mobile'],
            "order_type" => $postData['orderType'],
            "item_details" => $items,
            "item_temp_details" => $items,
            "order_status" => 1,
            "txn_id" => $postData['transictionId'],
            "total" => $postData['grandTotal'],
            "orderTotal" => $postData['orderTotal'],
            "payment_status" => 1,
            "payment_mode" => $postData['paymentType'],
            "created_at" => date('Y-m-d H:i:s'),
            "container_charge" => $this->input->post('containerCharge'),
            "delivery_charge" => $this->input->post('deliveryCharge'),
            "customer_paid" => floatval($this->input->post('customerPaid')),
        ];

        if (isset($postData['isDiscountApplied']) && $postData['isDiscountApplied'] == true)
        {
            if (isset($postData['discountAppliedType']) && $postData['discountAppliedType'] == 'flat')
            {
                $data['flat_amount_discount'] = $postData['discountAppliedAmount'];
            }
            else if (isset($postData['discountAppliedType']) && $postData['discountAppliedType'] == 'percent')
            {
                $data['discount_coupon_percent'] = $postData['discountAppliedAmount'];
            }
        }

        $response = [
            'status' => "false",
            'msg' => "Something went wrong"
        ];

        if ($this->db->insert('orders', $data))
        {
            $response = [
                'status' => "success",
                'msg' => "Order created successfully"
            ];
        }

        echo json_encode($response);
    }

    public function updateSelfBilling()
    {   
        header('Access-Control-Allow-Origin: *');  
		header("Content-Type: application/json", true);
        $postData = $this->input->post();

        foreach($postData['selectedItem'] as &$items) 
        {
            $itemDiscountAmount = $itemDiscountAmountOriginal = floatval($items['itemDiscountAmount'] ?? 0);

            $itemPrice = $items['itemPrice'];
            $itemDiscountType = $items['itemDiscountType'] ?? '';
            $itemDiscountValue = $items['itemDiscountValue'] ?? 0;

            if ($itemDiscountValue > 0)
            {
                $itemDiscountAmountTax = $this->calculateTaxOnPrice(($itemDiscountAmount), $items['itemTaxDetails']);
                $itemDiscountAmount = $itemDiscountAmount - $itemDiscountAmountTax;
            }
            
            $itemTax = $this->calculateTaxOnPrice($itemPrice, $items['itemTaxDetails']);

            $totalPrice = (floatval($itemPrice) + floatval($itemTax)); 
            $itemType = isset($items['itemType']) ? $items['itemType']: "";
            
            $itemInfo = [
                "itemName" => $items['itemName'],
                "itemNote" => $items['specialNote'] ?? '',
                "itemPrice"=> $totalPrice,
                "itemImage"=> "",
                "itemType"=> $itemType,
                "itemOldPrice"=> floatval($itemPrice), 
                "itemFoodType"=> "",
                "itemCount"=> $items['itemQty'],
                "itemTaxes"=> $items['itemTaxDetails'],
                "itemDiscountAmount" => $itemDiscountAmount,
                "itemDiscountAmountOriginal" => $itemDiscountAmountOriginal
            ];


            if ($itemDiscountAmount > 0)
            {
                $itemInfo['itemDiscountType'] = $itemDiscountType;
                $itemInfo['itemDiscountValue'] = $itemDiscountValue;
                $itemInfo['itemTotalAmountWithoutDiscount'] = $items['itemTotalAmountWithoutDiscount'] ?? '';
            }

            $items = [
                $itemType => $itemInfo
            ];
        }

        $userId = $this->session->userid;
        $orderId = $postData['id'];
        $items = json_encode($postData['selectedItem']);
        
        $data = [
            "order_id" => $orderId,
            "res_id" => $userId,
            "buyer_name" => $postData['customerName'],
            "buyer_address" => $postData['address'],
            "buyer_phone_number" => $postData['mobile'],
            "order_type" => $postData['orderType'],
            "item_details" => $items,
            "item_temp_details" => $items,
            "order_status" => 1,
            "txn_id" => $postData['transictionId'],
            "total" => $postData['grandTotal'],
            "orderTotal" => $postData['orderTotal'],
            "payment_status" => 1,
            "payment_mode" => $postData['paymentType'],
            "created_at" => date('Y-m-d H:i:s'),
            "container_charge" => $this->input->post('containerCharge'),
            "delivery_charge" => $this->input->post('deliveryCharge'),
            "customer_paid" => floatval($this->input->post('customerPaid')),
        ];

        $isDiscountApplied = isset($postData['isDiscountApplied']) ? ($postData['isDiscountApplied'] == 'true' ? true : false) : false;
        if ($isDiscountApplied)
        {
            $discountType = isset($postData['discountAppliedType']) ? $postData['discountAppliedType'] : '';
            $discountAmount = isset($postData['discountAppliedAmount']) ? $postData['discountAppliedAmount'] : 0;

            if (isset($postData['discountAppliedType']) && $postData['discountAppliedType'] == 'flat')
            {
                $data['flat_amount_discount'] = $postData['discountAppliedAmount'];
            }
            else if (isset($postData['discountAppliedType']) && $postData['discountAppliedType'] == 'percent')
            {
                $data['discount_coupon_percent'] = $postData['discountAppliedAmount'];
            }

            $this->addDiscountToAllPreviousOrders($orderId, $discountAmount, $discountType);
        }

        $response = [
            'status' => "false",
            'msg' => "Something went wrong"
        ];

        if ($this->db->insert('sub_orders', $data))
        {
            $response = [
                'status' => "success",
                'msg' => "Order created successfully"
            ];
        }

        echo json_encode($response);
    }

    public function getOrderId()
    {
        header('Access-Control-Allow-Origin: *');  
        header("Content-Type: application/json", true);
        $id = $this->input->get('id');
        
        $condition = array('id'=>$id);
		$data = $this->restaurantModel->getOrderList($condition);
        echo json_encode($data);
    }

    private function addDiscountToAllPreviousOrders($orderId, $discountAmount, $discountType)
    {
        if ($orderId > 0)
        {
            $orderCondition['id'] = $orderId;

            if ($discountType == 'percent')
            {
                $condition['discount_coupon_percent IS NULL'] = NULL;
                $orderCondition['discount_coupon_percent IS NULL'] = NULL;
            }
            else if ($discountType == 'flat')
            {
                $condition['flat_amount_discount IS NULL'] = NULL;
                $orderCondition['flat_amount_discount IS NULL'] = NULL;
            }
            
            $order = $this->ordermodel->getWhereCustom('*', $orderCondition)->row_array();

            if (!empty($order))
            {
                $updateOrderData = [];

                if ($discountType == 'percent')
                {
                    $updateOrderData['discount_coupon_percent'] = $discountAmount;

                    $orderTotal = round($order['orderTotal'] - ($order['orderTotal'] * $discountAmount) / 100, 2);
                    
                    $updateOrderData['orderTotal'] = $orderTotal;
                    $updateOrderData['total'] = round($orderTotal);

                }
                else if ($discountType == 'flat')
                {
                    $condition['flat_amount_discount IS NULL'] = NULL;                
                    $updateOrderData['flat_amount_discount'] = $discountAmount;

                    $orderTotal = round(($order['orderTotal'] - $discountAmount), 2);

                    $updateOrderData['orderTotal'] = $orderTotal;
                    $updateOrderData['total'] = round($orderTotal);
                }

                if (!empty($discountAmount > 0) && !empty($updateOrderData))
                {
                    $this->ordermodel->update($order['id'], $updateOrderData);
                }
            }
    
            // Update previous sub orders which has no discount
            $subOrders = $this->subordermodel->getWhereCustom('*', $condition)->result_array();
            if (!empty($subOrders) && $discountAmount > 0 && !empty($discountType))
            {
                foreach($subOrders as $subOrder)
                {
                    $updateData = [];
                    $updateId = $subOrder['id'];
    
                    if ($discountType == 'percent')
                    {
                        
                        $orderTotal = round($subOrder['orderTotal'] - ($subOrder['orderTotal'] * $discountAmount) / 100, 2);
                        
                        $updateData['orderTotal'] = $orderTotal;
                        $updateData['total'] = round($orderTotal);
                        $updateData['discount_coupon_percent'] = $discountAmount;
                    }
                    else if ($discountType == 'flat')
                    {
                        $orderTotal = round(($subOrder['orderTotal'] - $discountAmount), 2);
                        
                        $updateData['orderTotal'] = $orderTotal;
                        $updateData['total'] = round($orderTotal);
                        $updateData['flat_amount_discount'] = $discountAmount;
                    }

                    if (!empty($discountAmount > 0) && !empty($updateData))
                    {
                        $this->subordermodel->update($updateId, $updateData);
                    }
                }
            }
        }
    }
}

?>