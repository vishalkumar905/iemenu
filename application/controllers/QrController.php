<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QrController extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');	
		$this->load->database();
		$this->load->library('ci_qr_code');
		$this->load->library('M_pdf'); 
		$this->load->library('encrypt');
		$this->config->load('qr_code');
		$this->load->model('login/DashboardModel','dashboardModel');
		$this->load->model('qrCode/QrModel','qrModel');
		$this->load->model('table/TableModel','tableModel');
		if($this->session->email == "")
        {
            redirect('login');
        }
		$this->load->model('login/DashboardModel','dashboardModel');
	}
	public function index()
	{
	    $userid = $this->session->userid;
		$data = $this->dashboardModel->getUsersInfo($userid);
		if(!empty($data)){
			$rest_id = $data[0]->rest_id;
		}
		$data['tables'] = $this->tableModel->listTable($rest_id);
		$this->load->view('qr/qrtable', $data);
	}
	/*
	public function print_qr(){
		
		$user_id=$this->input->get('id');
		$qr_code_config = array();
		$qr_code_config['cacheable'] = $this->config->item('cacheable');
		$qr_code_config['cachedir'] = $this->config->item('cachedir');
		$qr_code_config['imagedir'] = $this->config->item('imagedir');
		$qr_code_config['errorlog'] = $this->config->item('errorlog');
		$qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
		$qr_code_config['quality'] = $this->config->item('quality');
		$qr_code_config['size'] = $this->config->item('size');
		$qr_code_config['black'] = $this->config->item('black');
		$qr_code_config['white'] = $this->config->item('white');
		$this->ci_qr_code->initialize($qr_code_config);
	 
		// get full name and user details
		$user_details = $this->qrModel->getUsersInfo($user_id);
		//print_r($user_details);exit;
		$image_name = $user_id . ".png";
	 
		// create user content
		$codeContents = "Name:";
		$codeContents .= "$user_details->name";
		$codeContents .= "\n";
		$codeContents .= " Image:";
		$codeContents .= "$user_details->userimg";
		$codeContents .= "\n";
		$codeContents .= "ID No :";
		$codeContents .= $user_details->rest_id;
		$params['data'] = $codeContents;
		$params['level'] = 'H';
		$params['size'] = 2;
	 
		$params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
		$this->ci_qr_code->generate($params);
		$this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;
	 
		// save image path in tree table
	   $this->qrModel->change_userqr($user_id, $image_name);
		// then redirect to see image link
		$file = $params['savename'];
		if(file_exists($file)){
            header('Content-Description: File Transfer');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            unlink($file); // deletes the temporary file

            exit;
        }
	}*/
	public function generateQr($val){
		$rest_id = $this->session->userid;
		$tableid = $val;
		
		$qr_code_config = array();
		$qr_code_config['cacheable'] = $this->config->item('cacheable');
		$qr_code_config['cachedir'] = $this->config->item('cachedir');
		$qr_code_config['imagedir'] = $this->config->item('imagedir');
		$qr_code_config['errorlog'] = $this->config->item('errorlog');
		$qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
		$qr_code_config['quality'] = $this->config->item('quality');
		$qr_code_config['size'] = $this->config->item('size');
		$qr_code_config['black'] = $this->config->item('black');
		$qr_code_config['white'] = $this->config->item('white');
		$this->ci_qr_code->initialize($qr_code_config);

		$table_details = $this->qrModel->getTableInfo($rest_id,$tableid);
		$table_qr = $this->qrModel->qrConfigData($rest_id);
		
		//print_r($table_details);exit;
		$image_name = rand() . ".png";
		
		
		// create user content
		$enc_tableid = $this->encrypt->encode($tableid);
        $enc_rest_id = $this->encrypt->encode($rest_id);
        //$codeContents = base_url().'UserMenu/menuPage/'.$tableid.'/'.$rest_id.'/'.$table_details->token;
        $codeContents = base_url().'UserMenu/menuPage/'.$table_details->token;
		/*$codeContents = "Name:";
		$codeContents .= "$table_details->table_name";
		$codeContents .= "\n";
		$codeContents .= " Image:";
		$codeContents .= "$table_details->table_id";
		$codeContents .= "\n";
		$codeContents .= "ID No :";
		$codeContents .= $table_details->table_type;*/
		$params['data'] = $codeContents;
		$params['level'] = 'H';
		$params['size'] = 2;
		 
	 
		$params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
		$this->ci_qr_code->generate($params);
		$this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;
		
		$conid = $table_qr->con_id;
		
		$val = array(
		 'restid' => $rest_id,
		 'tableid' => $tableid,
		 'con_id' => $conid,
		 'qr' => 'global/tmp/qr_codes/'.$image_name
		);
		
	    $this->qrModel->update_table_qr($val);
		
		$file = $params['savename'];
			if(file_exists($file)){
				$target = 'global/tmp/qr_codes'.$file;
				return true;
			}
	}
	
	public function multiQrGen(){

		$rest_id = $this->session->userid;
		$tableid = $_POST['tableid'];
		$ids = $_POST['multiDel'];
		foreach($ids as $id => $val){
			$generated = $this->generateQr($val);
		}
	    if($generated){
			$this->session->set_flashdata('SUCCESSMSG','Record(s) Generated Successfully');
			redirect('/QrController/');
		}
	}


// mj
    public function selfOrder(){
    
    		$rest_id = $this->session->userid;
    		$tableid = $_POST['tableid'];
    		$ids = $_POST['multiDel'];
    		foreach($ids as $id => $val){
    			$generated = $this->selfOrderTab($val);
    		}
    	    if($generated){
    			$this->session->set_flashdata('SUCCESSMSG','Record(s) Generated Successfully');
    			redirect('/QrController/');
    		}
    	}
    	
    	
//     public function selfOrderTab($val){
// 		$rest_id = $this->session->userid;
// 		$tableid = $val;
		

// 		$table_details = $this->qrModel->getTableInfo($rest_id,$tableid);
// 		$table_qr = $this->qrModel->qrConfigData($rest_id);
		
//         $codeContents = base_url().'UserMenu/menuPage/'.$table_details->token;
	
		
// 		$conid = $table_qr->con_id;
		
// 		$val = array(
// 		 'restid' => $rest_id,
// 		 'tableid' => $tableid,
// 		 'con_id' => $conid,
// 		 'qr' => 'self order'
// 		);
		
// 	    $this->qrModel->update_table_qr_selfOrder($val);
		
// 	}
	
	//mj end
    	
    	
  

    
    




	public function singleQrGen(){

		$rest_id = $this->session->userid;
		$tableid = $_POST['tableid'];
		
		$generated = $this->generateQr($tableid);
		//$data = $generated;
		if ($generated){
			
			$tableinfo = $this->qrModel->getTableInfo($rest_id,$tableid);
			
			$data = array(
			"table_name" => $tableinfo->table_name,
			"table_id" => $tableinfo->table_id,
			"table_type" => $tableinfo->table_type,
			"table_qr" => $tableinfo->table_qr
			);
			
			
			//$data['res'] = 'done';
			if ($this->input->is_ajax_request())
			{
				echo json_encode($data);
				exit;
			}
		}

	}
	public function qrConfigSave(){

		$rest_id = $this->session->userid;
		$val = $this->qrModel->qrConfigData($rest_id);
		//print_r($_POST);exit;
		if(!empty($val)){
			$updated = $this->qrModel->qrConfigUpdateData($rest_id);
			if($updated){
				$this->session->set_flashdata('SUCCESSMSG','Successfully Updated');
				redirect('QrController/qrConfig');
			}
		}else{
			$inserted = $this->qrModel->qrConfigSaveData($rest_id);
			if($inserted){
				$this->session->set_flashdata('SUCCESSMSG','Successfully Updated');
				redirect('QrController/qrConfig');
			}
		}
	}
	public function qrConfig(){

		$rest_id = $this->session->userid;
		$val = $this->qrModel->qrConfigData($rest_id);
		//print_r($val);exit;
		if(!empty($val)){
			$data['config'] = $val;
			$this->load->view('qr/qrconfigupdated',$data);
		}else{
			$this->load->view('qr/qrconfig');
		}
	}
	public function printMultiQr(){
	    $html = "";
		$rest_id = $this->session->userid;
		$ids = $_POST['multiDel'];
		$rest_data = $this->dashboardModel->getUsersInfo($rest_id);
		$config = $this->qrModel->qrConfigData($rest_id);
		if( !empty($config) ){
    		foreach($ids as $id => $val){
    			$multi_generate[] = $this->tableModel->getTableInfo($val);
    		}
    		foreach($multi_generate as $qr_data){
    			$html .= '<div class="col-md-6"><div class="qr-img-conf">';
    			if($config->logo_status == 1){
    			    $html .= '<img src="'.base_url($rest_data[0]->userimg).'" class="qr-logo" />';
    			}
    			$html .= '<p style="color: #a78234;margin-top: 20px;font-size: 24px;font-weight: 400;">E-Menu</p>';
    			if($config->welcome_msg != ''){
    			    $html .= '<p>'.$config->welcome_msg.'</p>';
    			}
    			$html .= '<img src="'.base_url($qr_data->table_qr).'" style="width: 65%;">';
    			if($config->table_name_status == 1){
    			    $html .= '<p><b>'.$qr_data->table_name.'</b></p>';
    			}
    			if($config->custom_msg != '' && $config->venue_name_staus == 1){
    		        $html .= '<p><small>'.$config->custom_msg.'</small></p>';
    			}
    			$html .= '</div></div>';
    		}
		}
		else{
		    $html = '<div class="col-md-12"><p>Please, Complete QR Configration Setup <a href="'.base_url('QrController/qrConfig').'">Here</a>.</p></div>';
		}
		echo $html;
	}
	
	
	
	
	//mj
	
		public function selfOrderPrintMultiQr(){
	    $html = "";
		$rest_id = $this->session->userid;
		$ids = $_POST['multiDel'];
		$rest_data = $this->dashboardModel->getUsersInfo($rest_id);
		$config = $this->qrModel->qrConfigData($rest_id);
		if( !empty($config) ){
    		foreach($ids as $id => $val){
    			$multi_generate[] = $this->tableModel->getTableInfo($val);
    		}
    		foreach($multi_generate as $qr_data){
    			$html .= '<div class="col-md-6"><div class="qr-img-conf">';
    			if($config->logo_status == 1){
    			    $html .= '<img src="'.base_url($rest_data[0]->userimg).'" class="qr-logo" />';
    			}
    			$html .= '<p style="color: #a78234;margin-top: 20px;font-size: 24px;font-weight: 400;">E-Menu</p>';
    			if($config->welcome_msg != ''){
    			    $html .= '<p>'.$config->welcome_msg.'</p>';
    			}
    			$html .= '<img src="'.base_url($qr_data->table_qr).'" style="width: 65%;">';
    			if($config->table_name_status == 1){
    			    $html .= '<p><b>'.$qr_data->table_name.'</b></p>';
    			}
    			if($config->custom_msg != '' && $config->venue_name_staus == 1){
    		        $html .= '<p><small>'.$config->custom_msg.'</small></p>';
    			}
    			$html .= '</div></div>';
    		}
		}
		else{
		    $html = '<div class="col-md-12"><p>Please, Complete QR Configration Setup <a href="'.base_url('QrController/qrConfig').'">Here</a>.</p></div>';
		}
		echo $html;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    public function save_pdf(){ 
        $mpdf = new \Mpdf\Mpdf();
        $html = "";
		$rest_id = $this->session->userid;
		$ids = $_POST['multiDel'];
		$data['config'] = $this->qrModel->qrConfigData($rest_id);
		$data['rest_data'] = $this->dashboardModel->getUsersInfo($rest_id);
		foreach($ids as $id => $val){
			$data['multi_generate'][] = $this->tableModel->getTableInfo($val);
		}
		$html=$this->load->view('pdf/qr_pdf',$data, true); 
        $pdfFilePath ="assets/uploads/pdf/webpdf-".time().".pdf"; 
        ini_set("memory_limit","-1");
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath,'F');
        echo $pdfFilePath;
    }
}
