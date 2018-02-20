<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	public function index() {	
		$this->db->select('id,prefix');
		$this->db->from('invoice_prefix');
		$this->db->where('deleted',0);
		$page_data['ArrPrefix'] = $this->db->get()->result_array();
		$page_data['active_menu'] = '';
		$this->load->view('invoice_settings', $page_data);
	}

	public function store(){
		echo '<pre/>'; print_r($_POST);
	}
 
}

/* End of file SettingsController.php */
/* Location: ./application/controllers/SettingsController.php */