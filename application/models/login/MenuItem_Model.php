<?php
class MenuItem_Model extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
	
	
	// fetch all items for particular menu
	
	public function get_menu_items($menu_id){

		 	$this->db->select('*');    
			$this->db->where('is_availaible','Yes');
			$this->db->where('menu_id', $menu_id);
			$this->db->order_by('name','ASC');
			$query = $this->db->get('menu_items');								
			return  $query->result();
	}
	
	
	
	// fetch all items for particular restaurant by publish
	
	public function get_user_items($menu_id){

		 	$this->db->select('*');    
			$this->db->where('is_publish','Yes');
			$this->db->where('menu_id', $menu_id);
			$this->db->order_by('name','ASC');
			$query = $this->db->get('menu_items');					
			return  $query->result();
	}
	
	
}