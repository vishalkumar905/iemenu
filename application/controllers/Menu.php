<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
    public $rest_id; 
    
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->email == "")
        {
            redirect('login');
        }
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('login/MenuModel','menuModel');
		$this->load->model('login/MenuPopupModel', 'menuPopup');
	}
	
	public function index($id=0)
	{
		$rest_id = ($id!=0) ? $id : $this->uri->segment(3);		
		
		$all_menus = $this->menuModel->get_menus($rest_id);
		$data['all_menus'] = $all_menus;
		$data['rest_id'] = $rest_id;
		
		$this->load->view('menu/menu_page', $data);	
	}
	
	
	// menu form
	public function store_menu($type='insert')
    {
        $dir = 'assets/uploads/menu/';
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
		}
		
		$image = (isset($_FILES['menuImage'])) ? $_FILES['menuImage']['name'] : '';
		
		$config = array(
            'file_name' => $image,
            'upload_path' => './'.$dir,
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => False,
            'max_size' => "2048"
        );

        $this->load->library('Upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload('menuImage')) {
            $path = $this->upload->data();
            $img_url = $dir . $path['file_name'];
            $data = array();
		    $data = array(
				'rest_id' => $this->input->post('rest_id'),					
                'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),		
				'note' => $this->input->post('note'),
				'image' => $img_url,
				'is_publish' => ($this->input->post('publish')) ? 'Yes' : 'No',
                'created_at' => date('Y-m-d H:i:s')
            );
        }else{
			$data = array();
			$data = array(
				'rest_id' => $this->input->post('rest_id'),					
                'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),		
				'note' => $this->input->post('note'),
				'is_publish' => ($this->input->post('publish')) ? 'Yes' : 'No',
                'created_at' => date('Y-m-d H:i:s')
            );
		}
        
        if($type=='update') {
    		$menu_id = $this->input->post('menu_id');
             
            $status = false;
    		$id = $this->menuPopup->update_menu($data, $menu_id);
        }
        else {
            $status = false;
    		$id = $this->menuPopup->create_menu($data);
        }
		
        // echo json_encode(array("status" => $status , 'data' => $data));
        redirect('Menu/index/'.$this->input->post('rest_id'),'refresh');
    }
    
    
    public function manage_status($id=0,$rest_id=0,$publish='No')
    {
        if($id!=0 && $rest_id!=0) {
            $data = array(
				'is_publish' => $publish,
            );
            $this->menuPopup->update_menu($data,$id);
        }
            
        redirect('Menu/index/'.$rest_id,'refresh');
    }
    
    
    public function delete_menu($id=0,$rest_id=0)
    {
        if($id!=0 && $rest_id!=0)
            $this->menuPopup->delete_section($id);
            
        redirect('Menu/index/'.$rest_id,'refresh');
    }

}