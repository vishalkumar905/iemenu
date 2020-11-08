<?php

class SelfbillingModel extends CI_MODEL
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getMenuItems($userId, $search)
    {
        $joinCondition = sprintf('menu_items.menu_id = menu_category.menu_id AND menu_category.rest_id = %s', $userId);
        $this->db->select([
            'menu_items.item_id', 
            'menu_items.menu_id', 
            'menu_items.name', 
            'menu_items.description', 
            'menu_items.price', 
            'menu_items.price_desc', 
            'menu_items.taxes', 
            'menu_items.food_type'
        ])->from('menu_items')->join('menu_category',  $joinCondition, 'left')->where('menu_category.rest_id', $userId);
        
        if(!empty($search))
        {
            $this->db->like('menu_items.name', $search, 'both');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTaxList($taxId, $restId)
    {
        $this->db->select('*')->from('res_tax')->where_in('tax_id', $taxId)->where('rest_id', $restId);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>