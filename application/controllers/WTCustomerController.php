<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WTCustomerController extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	public function index() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$page_data['active_menu']  = 'customers';
			$this->load->view('tanks_customers_list',$page_data);
		}	
	}

	public function create() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,name');
				$this->db->from('water_tanks_types');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjType'] = $this->db->get()->row();
			}
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'customers';
			$this->load->view('add_tank_customer',$page_data);
		}
	}

	public function getTankbyType() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,capacity');
			$this->db->from('water_tanks');
			$this->db->where('water_tank_type_id', $this->input->post('tank_type'));
			$this->db->where('deleted', 0);
			$ArrTanks = $this->db->get()->result_array();
			// print_r($ArrTanks);die;	
			echo json_encode($ArrTanks);
		}
	}

}

/* End of file WTCustomerController.php */
/* Location: ./application/controllers/WTCustomerController.php */