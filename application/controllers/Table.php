<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('table/TableModel','tableModel');
		if($this->session->email == "")
        {
            redirect('login');
        }
	}
	public function index()
	{
	    $userid = $this->session->userid;
		$data = $this->dashboardModel->getUsersInfo($userid);
		if(!empty($data)){
			$rest_id = $data[0]->rest_id;
		}
		$data['tables'] = $this->tableModel->listTable($rest_id);
		$this->load->view('table/table', $data);
	}
	public function addTable(){
		$userid = $this->session->userid;
		$data = $this->dashboardModel->getUsersInfo($userid);
		if(!empty($data)){
			$rest_id = $data[0]->rest_id;
		}
		else{
			$this->session->set_flashdata('FailMSG','There is some problem');
			redirect('table');
		}
		if(isset($_POST['addSingleTable'])){
			$entry_num = 0;
			$added = $this->tableModel->addTable($rest_id, $entry_num);
			if($added){
				$this->session->set_flashdata('SUCCESSMSG','Record Added Successfully');
				redirect('table');
			}
		}
		if(isset($_POST['addGroupTable'])){
			$range_from = $this->input->post('table_range_from');
			$range_to = $this->input->post('table_range_to');
			$entry_num = $range_to - $range_from; 
			$added = $this->tableModel->addTable($rest_id, $entry_num);
			if($added){
				$this->session->set_flashdata('SUCCESSMSG','Record Added Successfully');
				redirect('table');
			}
		}
		$this->load->view('table/add_table');
	}
	public function updateTable($id){
		$data['table'] = $this->tableModel->getTableInfo($id);
		if(isset($_POST['updateTable'])){
			$update = $this->tableModel->updateTable($id);
			if($update){
				$this->session->set_flashdata('SUCCESSMSG','Record updated Successfully');
				redirect('table');
			}
		}
		$this->load->view('table/update_table', $data);
	}
	public function deleteTable($id){
		$delete = $this->tableModel->deleteTable($id);
		if($delete){
			$this->session->set_flashdata('SUCCESSMSG','Record Deleted Successfully');
			redirect('table');
		}
	}
	public function multiDeleteTable(){
	    $ids = $_POST['multiDel'];
	    $delete = $this->tableModel->multiDeleteTable($ids);
	    if($delete){
			$this->session->set_flashdata('SUCCESSMSG','Record(s) Deleted Successfully');
			redirect('table');
		}
	    
	}
}