<?php
class dashboardModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->library('upload');
    }
	
	public function UpdateUsersInfo($id){
		
		$Name = $this->input->post('uname');
		$Tagline = $this->input->post('tagline');
		$Tax_name = $this->input->post('tax_name');
		$Registered_no = $this->input->post('rest_reg_no');
		$Customer_care_no = $this->input->post('customer_care_number');
		
// 		$Email = $this->input->post('uemail');
// 		$Phone = $this->input->post('mobile');
// 		$Address = $this->input->post('address');
// 		$Pass = $this->input->post('password');
		$image = $_FILES['profileimg']['name'];
		
		$dir = 'assets/uploads/profile/'.$id.'/';
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
		}
			$config = array(
                'file_name' => $image,
                'upload_path' => './'.$dir,
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "2048"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);
			
		if ($this->upload->do_upload('profileimg')) {
                $path = $this->upload->data();
                $img_url = $dir . $path['file_name'];
                $data = array();
                $data = array(
								'name' => $Name,
								/*'email' => $Email,
								'password' => $Pass,
								'address' => $Address,
								'phone' => $Phone,*/
								'tagline' => $Tagline,
								'tax_name' => $Tax_name,
								'rest_reg_no' => $Registered_no,
								'userimg' => $img_url,
								'customer_care_number' => $Customer_care_no
							);
            }else{
				$data = array();
				$data = array(
								'name' => $Name,
								/*'email' => $Email,
								'password' => $Pass,
								'address' => $Address,
								'phone' => $Phone*/
								'tagline' => $Tagline,
								'tax_name' => $Tax_name,
								'rest_reg_no' => $Registered_no,
								'customer_care_number' => $Customer_care_no
							);
			}
		$this->db->where('rest_id', $id);
		$updated = $this->db->update('erp_user', $data);
		if($updated){
			return true;
		}
	}
	public function getUsersInfo($uid)
	{
		$this->db->select('*');
		$this->db->from('erp_user');
		$this->db->where('rest_id',$uid);
		$query = $this->db->get();
		return $query->result();
	}
	public function getOrderList($cond=array())
	{
		$this->db->select('*');
		$this->db->from('orders');
		if(!empty($cond))
		    $this->db->where($cond);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getPayInfo($rid)
	{
		$this->db->select('*');
		$this->db->from('payment_setup');
		$this->db->where('rest_id',$rid);
		$query = $this->db->get();
		return $query->row();
	}
		
	public function insertPayInfo($data=array())
	{
		if(is_array($data) && !empty($data))
		{
		    $inserted = $this->db->insert('payment_setup',$data);
    		if($inserted){
    			return true;
    		}
    		return false;
		}
	}
	
	public function updatePayInfo($data=array(),$id=NULL)
	{
		if(is_array($data) && !empty($data))
		{
		    $this->db->where('rest_id',$id);
		    $updated = $this->db->update('payment_setup',$data);
    		if($updated){
    			return true;
    		}
    		return false;
		}
	}
}