<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_page extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->email == "")
        {
            redirect('login');
        }
		
	}
	
	public function index($id=0)
	{
	        
	    
	    $this->load->view('mobile_menu/mobile_menu_view');	
	}

	
	
}