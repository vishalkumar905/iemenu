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
        $data['items'] = $this->Selfbilling->getMenuItems($userId, $search);
        echo json_encode($data);
    }
}

?>