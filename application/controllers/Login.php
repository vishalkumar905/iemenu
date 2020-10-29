<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('login/LoginModel','loginModel');
	}
	public function index()
	{
		$this->load->view('login/login');
	}
	public function adminLogin()
	{
		if(!empty($_POST))
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->loginModel->login($email,$password);
			
            if($result -> num_rows() > 0)
            {
                foreach ($result->result() as $row)
                {
                    $this->session->userid = $row->rest_id;
                    $this->session->email =  $row->email;
                    $this->session->name =  $row->name;
                    $this->session->adminrole =  $row->role;
                    redirect('dashboard','refresh');
                }
            }
            else
            {
                $data['email'] = $email;
                $data['password'] = $password;
                $this->session->set_flashdata('FailMSG','Email and Password is Wrong');
                $this->load->view('login/login',$data);
            }
        }
		else
		{
			$this->load->view('login/login');
		}
	}
	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
