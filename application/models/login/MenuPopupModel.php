<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class MenuPopupModel extends CI_Model
{   
    
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
  
  
    public function get_menu_by_id($id)
    {
        $this->db->from('menu_category');
        $this->db->where('menu_id',$id);
        $query = $this->db->get();  
        return $query->row();
    }
  
    public function create_menu($data){
        $this->db->insert('menu_category', $data);
        return $this->db->insert_id();
    }
    
    public function update_menu($data, $menu_id=0) {
        $this->db->where('menu_id', $menu_id);
        $this->db->update('menu_category', $data);
        return $menu_id;
    }
    
    public function delete_section($menu_id=0)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('menu_category');
        return $menu_id;
    }

    public function get_menu_list()
    {
        $this->db->select('title');
        $this->db->from('menu_category');
        $this->db->order_by('title','asc');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    
    // menu item
    
     public function get_menuitem_by_id($id)
    {
        $this->db->from('menu_items');
        $this->db->where('item_id',$id);
        $query = $this->db->get();  
        return $query->row();
    }
  
    public function create_menuitem($data){
        $this->db->insert('menu_items', $data);
        return $this->db->insert_id();
    }
    
    public function update_menuitem($data, $item_id=0) {
        $this->db->where('item_id', $item_id);
        $this->db->update('menu_items', $data);
        return $item_id;
    }
    
    public function delete_menuitem($item_id=0)
    {
        $this->db->where('item_id', $item_id);
        $this->db->delete('menu_items');
        return $menu_id;
    }
    
    
}


?>