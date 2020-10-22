<?php
class RestaurantModel extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }
	
	public function insertRestaurantInfo($data=array())
	{
		if(is_array($data) && !empty($data))
		{
		    $inserted = $this->db->insert('erp_user',$data);
    		if($inserted){
    			return true;
    		}
    		return false;
		}
	}
	
	public function updateRestaurantInfo($data=array(),$id=NULL)
	{
		if(is_array($data) && !empty($data))
		{
		    $this->db->where('rest_id',$id);
		    $updated = $this->db->update('erp_user',$data);
    		if($updated){
    			return true;
    		}
    		return false;
		}
	}
	
	public function deleteRestaurantInfo($id=0)
	{
	    if($id!=0)
		{
		    $this->db->where('rest_id',$id);
		    $updated = $this->db->update('erp_user',array('delete_status'=>1));
    		if($updated){
    			return true;
    		}
    		return false;
		}
	}
	
	public function getRestaurantByEmail($email)
	{
		$this->db->select('*');
		$this->db->from('erp_user');
		$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getRestaurantList($cond=array())
	{
		$this->db->select('*');
		$this->db->from('erp_user');
		if(!empty($cond))
		    $this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getTaxList($cond=array())
	{
		$this->db->select('*');
		$this->db->from('res_tax');
		if(!empty($cond))
		    $this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function insertTaxInfo($data=array())
	{
		if(is_array($data) && !empty($data))
		{
		    $inserted = $this->db->insert('res_tax',$data);
    		if($inserted){
    			return true;
    		}
    		return false;
		}
	}
	
	public function deleteTaxInfo($id=0)
	{
	    if($id!=0)
		{
		    $this->db->where('tax_id',$id);
		    $updated = $this->db->delete('res_tax');
    		if($updated){
    			return true;
    		}
    		return false;
		}
	}
	
	public function getOrderList($cond=array())
	{
		$this->db->select('*');
		$this->db->from('orders');
		if(!empty($cond))
		    $this->db->where($cond);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getTransList($cond=array())
	{
		$this->db->select('*');
		$this->db->from('transactions');
		if(!empty($cond))
		    $this->db->where($cond);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function placeOrder($data=array(), $orderID=0)
    {
        $this->db->where('order_id',$orderID);
        $updated = $this->db->update('orders', $data);
        if($updated){
			return true;
		}
		return false;
    }
    
    // 11-10-2020
	function VoidOrderStatus($data=array(), $orderID=0)
    {
        $this->db->where('order_id',$orderID);
        $updated = $this->db->update('orders', $data);
        if($updated){
			return true;
		}
		return false;
	}
	
    
    public function getTableInfo($id)
    {
		$this->db->where('table_id', $id);
		$query = $this->db->get('res_table')->row();
		return $query;
	}
	
	public function getManagerPass($id){

		$this->db->select('manager_password');
		$this->db->from('erp_user');
		$this->db->where('rest_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result->manager_password;
	}
}