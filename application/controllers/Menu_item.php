<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_item extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->email == "")
        {
            redirect('login');
        }
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('login/MenuItem_Model','menuItem');
		$this->load->model('login/MenuPopupModel', 'menuPopup');
        $this->load->model('restaurant/RestaurantModel','restaurantModel');
	}
	
	public function index($id=0)
	{
	    $menu_id = ($id!=0) ? $id : $this->uri->segment(3);			
		$all_items = $this->menuItem->get_menu_items($menu_id);

        $data['taxes'] = $this->restaurantModel->getTaxList(['rest_id' => $this->session->userid]);
		$data['all_items'] = $all_items;		    
		$data['menu_id'] = $menu_id;		    
    	    
	    $this->load->view('menu_item/menu_item_page', $data);	
	}
	
	// menu item form
	public function store_menuitem($type='insert')
    {
        // print_r($_POST); print_r($_FILES); exit;
        $dir = 'assets/uploads/menu_items/';
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
		}
		
		$image = (isset($_FILES['itemImage'])) ? $_FILES['itemImage']['name'] : '';
		
		$config = array(
            'file_name' => $image,
            'upload_path' => './'.$dir,
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => False,
            'max_size' => "2048"
        );

        $this->load->library('Upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('itemImage')) {
            $path = $this->upload->data();
            $img_url = $dir . $path['file_name'];
            $data = array();
		    $data = array(
				'menu_id' => $this->input->post('menu_id'),					
                'name' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'image' => $img_url,
				'price' => json_encode($this->input->post('price')),
				'price_desc' => json_encode($this->input->post('price_description')),
				'food_type' => $this->input->post('food_type'),	
				'is_publish' => ($this->input->post('publish')) ? 'Yes' : 'No',
                'created_at' => date('Y-m-d H:i:s')
            );
        }else{
			$data = array();
			$data = array(
				'menu_id' => $this->input->post('menu_id'),					
                'name' => $this->input->post('title'),
				'description' => $this->input->post('description'),	
				'price' => json_encode($this->input->post('price')),
				'price_desc' => json_encode($this->input->post('price_description')),
				'food_type' => $this->input->post('food_type'),	
				'is_publish' => ($this->input->post('publish')) ? 'Yes' : 'No',
                'created_at' => date('Y-m-d H:i:s')
            );
		}
        
        $tax = $this->input->post('tax');
        if (!empty($tax))
        {
            $data['taxes'] = serialize($tax);
        }

        if($type=='update') {
    		$item_id = $this->input->post('item_id');
             
            $status = false;
    		$id = $this->menuPopup->update_menuitem($data, $item_id);
        }
        else {
            $status = false;
    		$id = $this->menuPopup->create_menuitem($data);
        }
		
        // echo json_encode(array("status" => $status , 'data' => $data));
        redirect('Menu_item/index/'.$this->input->post('menu_id'),'refresh');
    }
    
    public function manage_status($id=0,$menu_id=0,$publish='No')
    {
        if($id!=0 && $menu_id!=0) {
            $data = array(
				'is_publish' => $publish,
            );
            $this->menuPopup->update_menuitem($data,$id);
        }
            
        redirect('Menu_item/index/'.$menu_id,'refresh');
    }
    
    
    public function delete_item($id=0,$menu_id=0)
    {
        if($id!=0 && $menu_id!=0)
            $this->menuPopup->delete_menuitem($id);
            
        redirect('Menu_item/index/'.$menu_id,'refresh');
    }
	
	
}