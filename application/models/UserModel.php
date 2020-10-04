<?php
class UserModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
    
    function getstyledata($rest_id=0) {
        $this->db->select('*');    
// 		$this->db->where('is_availaible','Yes');
		$this->db->where('rest_id', $rest_id);
		$query = $this->db->get('qr_config');					
		return  $query->result();
    }
    
    function getResturant($tableToken=0)
    {
        $this->db->select('*');    
		$this->db->where('token', $tableToken);
		$query = $this->db->get('res_table');					
		return $query->result();
    }
    
    function getResturantbyID($Id=0)
    {
        $this->db->select('*');    
		$this->db->where('rest_id', $Id);
		$query = $this->db->get('erp_user');					
		return $query->result();
    }
    
    function getTaxList($restID=0)
    {
        $this->db->select('*');    
		$this->db->where('rest_id', $restID);
		$query = $this->db->get('res_tax');					
		return $query->result();
    }
    
    function placeOrder($data)
    {
        $added = $this->db->insert('orders', $data);
        if($added){
			return $this->db->insert_id();
		}
    }
    
    function lastOrder()
    {
        $this->db->select('order_id');    
        $this->db->order_by('id',"desc");    
        $this->db->limit(1);    
        $query = $this->db->get('orders');					
        return $query->result();
    }
}