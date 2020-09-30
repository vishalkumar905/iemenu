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
	        $online_pay = (isset($_POST['online_pay'])) ? trim($_POST['online_pay']) : "off" ;
	        $token = rand();
	        
	        $data = array(
				'name' => $name,
				'email' => $email,
				'password' => md5($password),
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
	        $online_pay = (isset($_POST['online_pay'])) ? trim($_POST['online_pay']) : "off" ;
	        
	        $data = array(
				'name' => $name,
				'email' => $email,
				'password' => md5($password),
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
	    $this->load->view('restaurant/orderlist');
	}
	
	public function reportorderlist()
	{
	    $this->load->view('restaurant/reportorderlist');
	}
	
	public function ajaxorderlist($type="")
	{
		$rid = $this->session->userid;
		if($type=='order'){
		    $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');
    		$condition = array('res_id'=>$rid, 'DATE(created_at)'=>$curr_date);
    		
    		$orders = $this->restaurantModel->getOrderList($condition);
		} else {
		    $this->db->order_by('id','DESC');
		    $this->db->where('res_id',$rid);
		    $this->db->where('order_status',2);
		    
		    if($_POST['isFilter']=='yes'){
		        $date=json_decode($_POST['formdata'],true); $from=$date['from']; $to=$date['to'];
		        if($from!='' && $to!='') { $this->db->where("DATE(created_at) BETWEEN '$from' AND '$to'"); }
		        elseif($date['from']!='') { $this->db->where("DATE(created_at) >= '$from'"); }
		        elseif($date['to']!='') { $this->db->where("DATE(created_at) <= '$to'"); }
		    }
    		$query = $this->db->get('orders');
    		$orders = $query->result();
		}
	    
	    
	    $data = array(); $i=1;
        foreach ( $orders as $order )
        {
            if($order->order_status=='0'){ $order_status='<span class="label label-success">OPEN</span>'; }elseif($order->order_status=='1'){ $order_status='<span class="label label-warning">CONFIRM</span>'; }else{ $order_status='<span class="label label-default">CLOSE</span>'; }
            $onclick=($order->order_status=='0') ? 'disabled="disabled"' : 'onclick="updateOrder('. $order->order_id .',2)"';
            
            $sub_array   = array();
            $sub_array[] = $i;
            $sub_array[] = $order_status;
            $sub_array[] = $order->order_id;
            $sub_array[] = ($order->table_id) ? ($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-' : '-';
            $sub_array[] = $order->buyer_name;
            $sub_array[] = $order->buyer_phone_number;
            $sub_array[] = $order->order_type;
            
            $sub_array[] = ($order->payment_mode=='1') ? '<span class="label label-primary">CASH</span>' : '<span class="label label-info">ONLINE</span>' ;
            if($type=='reportorder'){ 
                
                $sub_array[] = $order->created_at; 
                
                $sub_array[] = '<div class="text-right"><a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-sm btn-danger"> View</a></div>';
            } else {
                $sub_array[] = '<div class="text-right"><a href="javascript:getOrderView('. $order->order_id .')" title="View" class="btn btn-sm btn-danger"> View</a><a href="javascript:void(0)" data-id="'. $order->id.'" class="btn btn-sm btn-default" '.$onclick.' >Close</a></div>';
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
		
		$data[] = ['Order Status','Order Id','Table Id','Customer Name','Phone Number','Order Type','Payment Mode','Total Amount','Created Date'];
		
		foreach ( $orders as $order )
        {
            if($order->order_status=='0'){ $order_status='OPEN'; }elseif($order->order_status=='1'){ $order_status='CONFIRM'; }else{ $order_status='CLOSE'; }
            $CartLists=json_decode($order->item_details, true);
            
            $sub_array   = array();
            $sub_array[] = $order_status;
            $sub_array[] = $order->order_id;
            $sub_array[] = ($order->table_id) ? ($this->getTableDetail($order->table_id)) ? $this->getTableDetail($order->table_id)->table_name : '-' : '-';
            $sub_array[] = $order->buyer_name;
            $sub_array[] = $order->buyer_phone_number;
            $sub_array[] = $order->order_type;
            $sub_array[] = ($order->payment_mode=='1') ? 'CASH' : 'ONLINE' ;
            $sub_array[] = $this->cartTotal($CartLists,'no',$rid);
            $sub_array[] = $order->created_at; 
            
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
	    $condition = array('order_id'=>$orderid);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
        $this->load->view('restaurant/invoice', $data);
	}
	
	public function printInvoice2($orderid=0)
	{
	    $data=array();
        $condition = array('order_id'=>$orderid);
		$data['order'] = $this->restaurantModel->getOrderList($condition)[0];
		$data['showTaxColumn'] = $this->checkIfTaxIsAvaliable($data['order']);
        
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
	
	public function printInvoice3($orderid=0)
	{
	    $data=array();
        $condition = array('order_id'=>$orderid);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
		$data['showTaxColumn'] = $this->checkIfTaxIsAvaliable($data['order']);
		$stylesheet = file_get_contents('/home/yd93k4ea02s3/public_html/MDB/assets/css/print2.css');
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
        ] ); 
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output();
	}

	public function checkIfTaxIsAvaliable($data)
	{
		if (!empty($data))
		{
			$itemDetails = json_decode($data->item_details, true);
			foreach ($itemDetails as $item)
			{
				$key = key($item);
				if (isset($item[$key]['itemTaxes']))
				{
					return 1;
				}
			}
			
		}

		return 0;
	}
	
	public function getOrderView($postdata=array())
	{
	    if(!empty($_POST))
	    {
            $postdata = $_POST;
	    }
	    
        $condition = array('order_id'=>$postdata['orderID']);
        $data['order'] = $this->restaurantModel->getOrderList($condition)[0];
        $this->load->view('restaurant/orderPopup', $data);
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
	    
	    return $itemTotalPrice;
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
	
	public function cartRemove()
	{
	    $cartArray=array();
	    
	    if(!empty($_POST))
	    {
	        $rid = $this->session->userid;
	        $condition = array('order_id'=>$_POST['orderID']);
	        $order = $this->restaurantModel->getOrderList($condition)[0];
	        
	        $cartArray = json_decode($order->item_details, true);
	        
	        unset($cartArray[$_POST['itemID']][$_POST['itemType']]);
	        
	        if(empty($cartArray[$_POST['itemID']]))
	        {
	            unset($cartArray[$_POST['itemID']]);
	        }
	        
	        $data['item_details'] = json_encode($cartArray);
	        $data['total'] = $this->cartTotal($cartArray, 'yes', $rid);
	    }
	    
	    $this->restaurantModel->placeOrder($data,$_POST['orderID']);
	    
	    $this->getOrderView($_POST);
	}
	
	public function updateOrderStatus()
	{
	    if(!empty($_POST))
	    {
	        $data['order_status'] = $_POST['status'];
	        $this->restaurantModel->placeOrder($data,$_POST['orderID']);
	        
	        echo '1';
	    }
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
	
	
	
	

	
}