<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_page extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
		$this->load->model('login/MenuModel','menuModel');
		$this->load->model('login/MenuItem_Model','menuItem');
	}
	
	public function index($id=0)
	{
	    $this->load->view('mobile_menu/mobile_menu_view');	
	}
	
	public function landingPage($a=NULL, $b=NULL)
	{
	    echo 'TEST user'; echo '\n';
	    echo $a; echo '\n';
	    echo $b; echo '\n';
	}
	
	public function menuPage($a=NULL, $b=NULL)
	{
	    $this->load->view('mobile_menu/mobile_menu_view');	
	}

	public function get_user_menus($id=0)
	{
	    $rest_id = ($id!=0) ? $id : $this->uri->segment(3);		
		
		return $this->menuModel->get_user_menus($rest_id);
	}
	
	
	
}