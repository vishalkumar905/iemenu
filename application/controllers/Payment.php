<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller 
{
    public $rest_id; 
    
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->email == "")
        {
            redirect('login');
        }
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('restaurant/RestaurantModel','restaurantModel');
	}
	
	public function index()
	{
	    $id = $this->session->userid;
	    $condition=array('rest_id'=>$id);
	    $restaurant = $this->restaurantModel->getRestaurantList($condition);
	    if($restaurant[0]->online_pay_status == 'on'){
	        redirect('payment/paymentConfig','refresh');
	    }else{
		    $this->session->set_flashdata('Email Error','Sorry you are not allowed');
		    redirect('dashboard','refresh');
	    }
	}
	
    public function updatePayment(){
        
        if(isset($_POST) && !empty($_POST))
	     {
        
        	$status = trim($_POST['stripe']);
	        $sek_key = trim($_POST['payment_sek_key']);
	        $private_key = trim($_POST['payment_private_key']);
			$mode = trim($_POST['mode']);
			$rid = $this->session->userid;
			
			$data = array();
			
		$val = $this->dashboardModel->getPayInfo($rid);
		//print_r($_POST);exit;
		if(!empty($val)){
		    $data = array(
				'mode' => $mode,
				'secret_key' => $sek_key,
				'pub_key' => $private_key,
				'status' => $status
			);
			$updated = $this->dashboardModel->updatePayInfo($data,$rid);
			if($updated){
				$this->session->set_flashdata('SUCCESSMSG','Successfully Updated');
				redirect('payment/paymentConfig');
			}
		}else{
		    
		    $data = array(
				'rest_id' => $rid,
				'mode' => $mode,
				'secret_key' => $sek_key,
				'pub_key' => $private_key,
				'status' => $status
			);
		    
			$inserted = $this->dashboardModel->insertPayInfo($data,$rid);
			if($inserted){
				$this->session->set_flashdata('SUCCESSMSG','Successfully Updated');
				redirect('payment/paymentConfig');
			}
		}
	        
	    }
    }
    
    public function paymentConfig(){

		$rest_id = $this->session->userid;
	    $condition=array('rest_id'=>$rest_id);
	    $restaurant = $this->restaurantModel->getRestaurantList($condition);
	    if($restaurant[0]->online_pay_status == 'on'){
	        
    		$val = $this->dashboardModel->getPayInfo($rest_id);
    		if(!empty($val)){
    			$data['config'] = $val;
    			$this->load->view('payment/updatepayment',$data);
    		}else{
    			$this->load->view('payment/payment');
    		}
		
	    }else{
		    $this->session->set_flashdata('Email Error','Sorry you are not allowed');
		    redirect('dashboard','refresh');
	    }
	}
}