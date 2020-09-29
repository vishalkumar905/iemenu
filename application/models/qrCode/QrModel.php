<?php
class QrModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	public function qrConfigData($rid)
	{
		$this->db->select('*');
		$this->db->from('qr_config');
		$this->db->where('rest_id',$rid);
		$query = $this->db->get();
		return $query->row();
	}
	public function getTableInfo($uid,$tid)
	{
		$this->db->select('*');
		$this->db->from('res_table');
		$this->db->where('rest_id',$uid);
		$this->db->where('table_id',$tid);
		$query = $this->db->get();
		return $query->row();
	}
	public function update_table_qr($data)
    {
        $this->db->where('rest_id', $data['restid']);
        $this->db->where('table_id', $data['tableid']);
        $this->db->set('table_qr',$data['qr']);
        $this->db->set('con_id',$data['con_id']);
        $this->db->update('res_table');
		return true;
    }
    
    //mj
//     public function update_table_qr_selfOrder($data)
//     {
//         $this->db->where('rest_id', $data['restid']);
//         $this->db->where('table_id', $data['tableid']);
//         $this->db->set('table_qr',$data['qr']);
//         $this->db->set('con_id',$data['con_id']);
//         $this->db->update('res_table');
// 		return true;
//     }
    
    
    
    
    
    
    
    
    public function qrConfigSaveData($rid){
		
		$display_logo = $this->input->post('display_logo');
			if($display_logo == 'on'){
				$display_logo = 1;
			}else{
				$display_logo = 0;
			}	
		$display_table = $this->input->post('display_table');
			if($display_table == 'on'){
				$display_table = 1;
			}else{
				$display_table = 0;
			}
		$display_venue = $this->input->post('display_venue');
			if($display_venue == 'on'){
				$display_venue = 1;
			}else{
				$display_venue = 0;
			}
		$display_bg = $this->input->post('display_bg');
			if($display_bg == 'on'){
				$display_bg = 1;
			}else{
				$display_bg = 0;
			}
		$wlcm = $this->input->post('wlcm');
		$custom_msg = $this->input->post('custom_msg');
		$image = $_FILES['bg_img']['name'];
		$dir = 'assets/uploads/qrconfig/'.$rid.'/';
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
		}
			$config = array(
                'file_name' => $image,
                'upload_path' => './'.$dir,
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
			
		if ($this->upload->do_upload('bg_img')) {
                $path = $this->upload->data();
                $img_url = $dir . $path['file_name'];
                $data = array();
                $data = array(
								'rest_id' => $rid,
								'bg_status' => $display_bg,
								'logo_status' => $display_logo,
								'venue_name_staus' => $display_venue,
								'welcome_msg' => $wlcm,
								'custom_msg' => $custom_msg,
								'table_name_status' => $display_table,
								'bg_img' => $img_url 
							);
            }else{
				$data = array();
				$data = array(
								'rest_id' => $rid,
								'bg_status' => $display_bg,
								'logo_status' => $display_logo,
								'venue_name_staus' => $display_venue,
								'welcome_msg' => $wlcm,
								'custom_msg' => $custom_msg,
								'table_name_status' => $display_table
							);
			}
		$insert = $this->db->insert('qr_config', $data);
		$insert_id = $this->db->insert_id();

		if($insert){
			$this->db->where('rest_id', $rid);
			$this->db->set('con_id',$insert_id);
			$this->db->update('res_table');
			return true;
		}
	}
    public function qrConfigUpdateData($rid){
		
		$display_logo = $this->input->post('display_logo');
			if($display_logo == 'on'){
				$display_logo = 1;
			}	
		$display_table = $this->input->post('display_table');
			if($display_table == 'on'){
				$display_table = 1;
			}
		$display_venue = $this->input->post('display_venue');
			if($display_venue == 'on'){
				$display_venue = 1;
			}
		$display_bg = $this->input->post('display_bg');
			if($display_bg == 'on'){
				$display_bg = 1;
			}
		$wlcm = $this->input->post('wlcm');
		$custom_msg = $this->input->post('custom_msg');
		$image = $_FILES['bg_img']['name'];
		$dir = 'assets/uploads/qrconfig/'.$rid.'/';
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
		}
			$config = array(
                'file_name' => $image,
                'upload_path' => './'.$dir,
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
			
		if ($this->upload->do_upload('bg_img')) {
                $path = $this->upload->data();
                $img_url = $dir . $path['file_name'];
                $data = array();
                $data = array(
								'rest_id' => $rid,
								'bg_status' => $display_bg,
								'logo_status' => $display_logo,
								'venue_name_staus' => $display_venue,
								'welcome_msg' => $wlcm,
								'custom_msg' => $custom_msg,
								'table_name_status' => $display_table,
								'bg_img' => $img_url
							);
            }else{
				$data = array();
				$data = array(
								'rest_id' => $rid,
								'bg_status' => $display_bg,
								'logo_status' => $display_logo,
								'venue_name_staus' => $display_venue,
								'welcome_msg' => $wlcm,
								'custom_msg' => $custom_msg,
								'table_name_status' => $display_table
							);
			}
		$this->db->where('rest_id', $rid);
		$updated = $this->db->update('qr_config', $data);
		if($updated){
			return true;
		}
	}
}

