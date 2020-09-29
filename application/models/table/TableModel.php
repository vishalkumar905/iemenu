<?php
class TableModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	public function listTable($id){
	    $this->db->where('rest_id', $id);
		$query = $this->db->get('res_table')->result();
		return $query;
	}
	public function getTableInfo($id){
		$this->db->where('table_id', $id);
		$query = $this->db->get('res_table')->row();
		return $query;
	}
	public function addTable($rest_id,$entry_num){
		if($entry_num == 0){
			$data = array(  
				'table_name' => $this->input->post('table_name'), 
				'table_type' => $this->input->post('table_loc'),
				'rest_id' => $rest_id,
				'token' => md5(rand())
			);
			$added = $this->db->insert('res_table', $data);
		}
		else{
			for($i=0;$i<=$entry_num;$i++){
				$prefix = $this->input->post('table_prefix');
				$range_value = $this->input->post('table_range_from')+$i;
				$suffix = $this->input->post('table_suffix');
				$table_name = $prefix."".$range_value."".$suffix;
				$data = array(  
					'table_name' => $table_name,   
					'table_type' => $this->input->post('table_loc'),
					'rest_id' => $rest_id,
					'token' => md5(rand())
				);
				$added = $this->db->insert('res_table', $data);
			}
		}
		if($added){
			return true;
		}
	}
	public function updateTable($id){
		$data = array(  
			'table_name'     => $this->input->post('table_name'),  
			'table_type'  => $this->input->post('table_type')
		);
		$this->db->where('table_id', $id);
		$update = $this->db->update('res_table', $data);
		if($update){
			return true;
		}
	}
	public function deleteTable($id){
		$this->db->where('table_id', $id);
		$delete = $this->db->delete('res_table');
		if($delete){
			return true;
		}
	}
	public function multiDeleteTable($ids){
	    foreach($ids as $id => $val){
	        $this->db->where('table_id', $val);
    		$delete = $this->db->delete('res_table');
	    }
        if($delete){
			return true;
		}
	}
}