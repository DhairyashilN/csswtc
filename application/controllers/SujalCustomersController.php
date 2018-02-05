<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SujalCustomersController extends CI_Controller {
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
			$this->db->select('id,name,contact_no,email,cust_id,gstin');
			$this->db->from('sujal_customers');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'customers';
			$page_data['sub_active_menu'] = 'scustomers';
			$this->load->view('sujal_customers_list',$page_data);
		}
	}
	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,name,contact_no,email,cust_id,address,gstin');
				$this->db->from('sujal_customers');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjCustomer'] = $this->db->get()->row();
			}
			$page_data['active_menu'] = 'customers';
			$page_data['sub_active_menu'] = 'scustomers';
			$this->load->view('add_sujal_customer',$page_data);
		}
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('scust_name','Customer Name','required');
			$this->form_validation->set_rules('scust_contact','Customer Contact','required|numeric');
			$this->form_validation->set_rules('scust_address','Customer Address','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'customers';
				$page_data['sub_active_menu'] = 'scustomers';
				$this->load->view('add_sujal_customer',$page_data);
			} else {
				$page_data['cust_id'] = uniqid('SJ'.date("ym")."_");
				$page_data['name'] = $this->input->post('scust_name');
				$page_data['contact_no'] = $this->input->post('scust_contact');
				$page_data['email'] = $this->input->post('scust_email');
				$page_data['address'] = $this->input->post('scust_address');
				$page_data['gstin'] = $this->input->post('scust_gstin');
				if (isset($id) && !empty($id)) {
					$this->db->select('cust_id');
					$this->db->where('id', $id);
					$this->db->from('sujal_customers');
					$page_data['cust_id'] = $this->db->get()->row()->cust_id; 
					$this->db->where('id',$id);
					$this->db->update('sujal_customers',$page_data);
					$this->session->set_flashdata('success','Customer Saved successfully.');
				} else {
					$this->db->insert('sujal_customers',$page_data);
					$this->session->set_flashdata('success','Customer Saved successfully.');
				}
				redirect('sujal_customers');
			}
		}
	}

	public function show($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('name,price');
				$this->db->from('sujal_products');
				$this->db->where('deleted', 0);
				$page_data['ObjProduct'] = $this->db->get()->row();
				$page_data['active_menu'] = 'products';
				$page_data['sub_active_menu'] = 'sproducts';
				$this->load->view('sujal_product_details',$page_data);	
			}
		}
	}

	public function destroy($id=''){
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('sujal_customers', ['deleted' => 1]);
				$this->session->set_flashdata('success','Customer Deleted successfully.');
				redirect('sujal_customers');
			}
		}
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ ?>