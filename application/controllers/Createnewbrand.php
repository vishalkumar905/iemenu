<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Createnewbrand extends CI_Controller 
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
	}

    public function index()
    {
        $this->load->view('table/addnewbrand');
    }

}

?>