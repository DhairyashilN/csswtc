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
		$page_data['active_menu'] = 'settings';
		$this->load->view('invoice_settings', $page_data);
	}

	public function store(){
		// echo '<pre/>'; print_r($_POST);
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else { 
			$this->form_validation->set_rules('prefix_id','Invoice Prefix Id','required');
			$this->form_validation->set_rules('invoice_prefix','Invoice Prefix','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'settings';
				$this->load->view('invoice_settings',$page_data);
			} else {
				$this->db->where('id',$this->input->post('prefix_id'));
				$this->db->update('invoice_prefix', ['prefix'=> $this->input->post('invoice_prefix')]);
				$this->session->set_flashdata('success','Invoice prefix updated successfully.');
				redirect('invoice_prefix');
			}
		}
	}

}

/* End of file SettingsController.php */
/* Location: ./application/controllers/SettingsController.php */