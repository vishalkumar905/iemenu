<?php
class LoginModel extends CI_Model
{
	function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	public function login($email,$password)
	{
		$this -> db->select('*');
		$this -> db->from('erp_user');
		$this -> db->where('email', $email);
		$this -> db->where('password', md5($password));
		$this -> db->limit(1);
		$query = $this->db-> get();
		return $query;
	}

     
}