<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
		$this->load->model('table/TableModel','tableModel');
		
	}
	
	public function index()
	{
		$getOrderRevenuByPaymentModes = $this->ordermodel->getOrderRevenuByPaymentModes($this->session->userid, ORDER_STATUS_CLOSE, null, null, 1);

		$data['totalPaymentByCash'] = $getOrderRevenuByPaymentModes['totalPaymentByCash'] ?? 0;
		$data['totalPaymentByOnline'] = $getOrderRevenuByPaymentModes['totalPaymentByOnline'] ?? 0;
		$data['totalPaymentByUpi'] = $getOrderRevenuByPaymentModes['totalPaymentByUpi'] ?? 0;
		$data['totalPaymentByCard'] = $getOrderRevenuByPaymentModes['totalPaymentByCard'] ?? 0;
		$data['totalPaymentByBtc'] = $getOrderRevenuByPaymentModes['totalPaymentByBtc'] ?? 0;
		$data['totalPaymentBySwiggy'] = $getOrderRevenuByPaymentModes['totalPaymentBySwiggy'] ?? 0;
		$data['totalPaymentByZomato'] = $getOrderRevenuByPaymentModes['totalPaymentByZomato'] ?? 0;
		$data['totalPaymentByMagicPin'] = $getOrderRevenuByPaymentModes['totalPaymentByMagicPin'] ?? 0;


		$data['tab'] = $this->getDashOrderDetails();

		$this->load->view('dashboard',$data);
	}
	public function viewProfile(){
		$userid = $this->session->userid;
		$data['profile'] = $this->dashboardModel->getUsersInfo($userid);
		$this->load->view('admin/view_profile',$data);
	}
	public function editProfile(){
		$userid = $this->session->userid;
		$data['profile'] = $this->dashboardModel->getUsersInfo($userid);
		if(isset($_POST['updatepro'])){
			$updated = $this->dashboardModel->UpdateUsersInfo($userid);
			if($updated){
				$this->session->set_flashdata('SUCCESSMSG','Successfully Updated');
				redirect('dashboard/viewProfile');
			}
		}
		$this->load->view('admin/edit_profile',$data);
	}
	public function openOrderlist()
	{
	    $html="";
		$rid = $this->session->userid;
		$date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
	    $condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date, 'order_status'=>0);
	    $orders = $this->dashboardModel->getOrderList($condition);
	    if(!empty($orders)) {
	        foreach($orders as $order) {
	            $CartLists=json_decode($order->item_details, true);
	            $html.="<tr>";
	                $html.='<td>'. $order->order_id .'</td>';
                    $html.='<td>'. ($order->table_id) ? ($this->tableModel->getTableInfo($order->table_id)) ? $this->tableModel->getTableInfo($order->table_id)->table_name : '-' : '-' .'</td>';
                    $html.='<td>'. $order->buyer_name.'</td>';
                    $html.='<td><span class="label label-success">OPEN</span></td>';
	                $html.='<td>₹ '. $this->cartTotal($CartLists,'yes',$rid) .'</td>';
	            $html.='</tr>';
	        }
	    }
	    else{ $html = "There are no new orders today."; }
	    echo $html;
	}
	public function confirmOrderlist()
	{
	    $html="";
		$rid = $this->session->userid;
		$date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
	    $condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date, 'order_status'=>1);
	    $orders = $this->dashboardModel->getOrderList($condition);
	    if(!empty($orders)) {
	        foreach($orders as $order) {
	            $CartLists=json_decode($order->item_details, true);
	            $html.="<tr>";
	                $html.='<td>'. $order->order_id .'</td>';
                    $html.='<td>'. ($order->table_id) ? ($this->tableModel->getTableInfo($order->table_id)) ? $this->tableModel->getTableInfo($order->table_id)->table_name : '-' : '-' .'</td>';
                    $html.='<td>'. $order->buyer_name.'</td>';
                    $html.='<td><span class="label label-warning">CONFIRM</span></td>';
	                $html.='<td>₹ '. $this->cartTotal($CartLists,'yes',$rid) .'</td>';
	            $html.='</tr>';
	        }
	    }
	    else{ $html = "There are no new orders today."; }
	    echo $html;
	}
	public function closeOrderlist()
	{
	    $html="";
		$rid = $this->session->userid;
		$date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
	    $condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date, 'order_status'=>2);
	    $orders = $this->dashboardModel->getOrderList($condition);
	    if(!empty($orders)) {
	        foreach($orders as $order) {
	            $CartLists=json_decode($order->item_details, true);
	            $html.="<tr>";
	                $html.='<td>'. $order->order_id .'</td>';
                    $html.='<td>'. ($order->table_id) ? ($this->tableModel->getTableInfo($order->table_id)) ? $this->tableModel->getTableInfo($order->table_id)->table_name : '-' : '-' .'</td>';
                    $html.='<td>'. $order->buyer_name.'</td>';
                    $html.='<td><span class="label label-default">CLOSE</span></td>';
	                $html.='<td>₹ '. $this->cartTotal($CartLists,'yes',$rid) .'</td>';
	            $html.='</tr>';
	        }
	    }
	    else{ $html = "There are no new orders today."; }
	    echo $html;
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
	    $itemName=''; $itemImage=''; $itemNetPrice=''; $tempArr=array();
	    if(!empty($cartArray))
	    {
	        foreach($cartArray as $itemId => $itemData):
	            if($itemName == '') { $itemName=$itemData['itemName']; }
	            if($itemImage == '') { $itemImage=$itemData['itemImage']; }
	            if($itemNetPrice == '') { 
	                $itemNetPrice=$itemData['itemPrice'] * $itemData['itemCount']; 
	            } 
	            else { 
	                $itemNetPrice=$itemNetPrice + ( $itemData['itemPrice'] * $itemData['itemCount'] ); 
	               
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
    
    public function getDashOrderDetails()
    {
        $data=array(); $itemTotalPrice='';
        $rid = $this->session->userid;
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d');
	    $condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date, 'order_status'=>2);
	   // $condition = array('res_id'=>$rid, 'order_status'=>2);
	    $orders = $this->dashboardModel->getOrderList($condition);
	    
	    $data['closeCount']=count($orders);
	    
	    if(!empty($orders))
	    {
	        foreach($orders as $order) :
	            if($itemTotalPrice == '') { $itemTotalPrice = $order->total; }
	            else { $itemTotalPrice = $itemTotalPrice + $order->total; }
	        endforeach;
	    }
	    
	    $data['closePrice']= round($itemTotalPrice);
	    
	    return $data;
    }
    
    public function getDate()
    {
        $now = new DateTime('now'); 
        $now->setTimezone(new DateTimeZone('Asia/Kolkata'));    // Another way
        print_r($now); exit;
    }
}
