<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SujalAmcController extends CI_Controller {
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
			$this->db->select('id,cust_id,product_id,amc_date,installation_date,amc_reminder_date');
			$this->db->from('sujal_amc');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrAmc'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_customers');
			$this->db->where('deleted', 0);
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_products');
			$this->db->where('deleted', 0);
			$page_data['ArrProducts'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'samc';
			$this->load->view('sujal_amc_list',$page_data);
		}
	}

	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,cust_id,product_id,installation_date,amc_date,amc_reminder_date');
				$this->db->from('sujal_amc');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjAmc'] = $this->db->get()->row();
				$this->db->select('name');
				$this->db->from('sujal_products');
				$this->db->where('id', $page_data['ObjAmc']->product_id);
				$this->db->where('deleted', 0);
				$page_data['ProductName'] = $this->db->get()->row();
				$this->db->select('name,address');
				$this->db->from('sujal_customers');
				$this->db->where('id', $page_data['ObjAmc']->cust_id);
				$this->db->where('deleted', 0);
				$page_data['CustomerName'] = $this->db->get()->row();
			}
			$page_data['active_menu'] = 'samc';
			$this->load->view('sujal_amc_details',$page_data);
		}
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('cname','Customer Name','required');
			$this->form_validation->set_rules('pname','Product Name','required');
			$this->form_validation->set_rules('install_date','Installation Date','required');
			$this->form_validation->set_rules('amc_date','AMC Date','required');
			$this->form_validation->set_rules('amc_reminder_date','AMC Reminder Date','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'samc';
				$this->load->view('sujal_amc_details',$page_data);
			} else {
				$page_data['cust_id'] = $this->input->post('cname');
				$page_data['product_id'] = $this->input->post('pname');
				$page_data['installation_date'] = $this->input->post('install_date');
				$page_data['amc_date'] = $this->input->post('amc_date');
				$page_data['amc_reminder_date'] = $this->input->post('amc_reminder_date');
				if (isset($id) && !empty($id)) {
					$this->db->where('id',$id);
					$this->db->update('sujal_amc',$page_data);
					$this->session->set_flashdata('success','AMC updated successfully.');
					redirect('sujals_amcs');
				} 
			}
		}
	}

	public function getAmcRemDate() {
		$amc_reminder_date = date("d-m-Y", strtotime("-7 days", strtotime($this->input->post('amc_date'))));
		echo json_encode(['amc_reminder_date'=>$amc_reminder_date]);
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ ?>