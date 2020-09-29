<?php
class MenuModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
	
	
	// fetch all menus for particular restaurant
	
	public function get_menus($rest_id){

		 	$this->db->select('*');    
			$this->db->where('is_availaible','Yes');
			$this->db->where('rest_id', $rest_id);
			$query = $this->db->get('menu_category');					
			return  $query->result();
	}
	
	
	// fetch all menus for particular restaurant by publish
	
	public function get_user_menus($rest_id){

		 	$this->db->select('*');    
			$this->db->where('is_publish','Yes');
			$this->db->where('rest_id', $rest_id);
			$query = $this->db->get('menu_category');					
			return  $query->result();
	}
	
     
}