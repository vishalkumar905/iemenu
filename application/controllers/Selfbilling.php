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
		$this->load->model('SelfbillingModel','Selfbilling');
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

    public function saveSelfBilling()
    {   
        header('Access-Control-Allow-Origin: *');  
		header("Content-Type: application/json", true);
        $postData = $this->input->post();
        
        foreach($postData['selectedItem'] as &$items) 
        {
            $totalPrice = floatval($items['itemPrice']) + floatval($items['itemTax']); 
            $items = [
                $items['itemType'] => [
                    "itemName" => $items['itemName'],
                    "itemNote" => $items['specialNote'],
                    "itemPrice"=> $totalPrice,
                    "itemImage"=> "",
                    "itemType"=> $items['itemType'],
                    "itemOldPrice"=> floatval($items['itemPrice']),
                    "itemFoodType"=> "",
                    "itemCount"=> $items['itemQty'],
                    "itemTaxes"=> $items['itemTaxDetails']
                ]
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
            "payment_status" => 1,
            "payment_mode" => $postData['paymentType'],
            "created_at" => date('Y-m-d H:i:s'),
            "container_charge" => $this->input->post('containerCharge'),
            "delivery_charge" => $this->input->post('deliveryCharge'),
            "customer_paid" => floatval($this->input->post('customerPaid')),
        ];

        if (isset($postData['isDiscountApplied']))
        {
            if ($postData['orderDiscountAmount'] > 0)
            {
                $data['flat_amount_discount'] = $postData['orderDiscountAmount'];
            }
            else if ($postData['orderDiscountPercent'] > 0)
            {
                $data['discount_coupon_percent'] = $postData['orderDiscountPercent'];
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
}

?>