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

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			echo '<pre>';print_r($_POST);die;
			$this->form_validation->set_rules('cust_name','Customer Name','required');
			$this->form_validation->set_rules('cust_contact','Contact Number','required|numeric');
			$this->form_validation->set_rules('cust_address','Address','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'customers';
				$this->load->view('add_tank_customer',$page_data);
			} else {
				$page_data['name'] = $this->input->post('cust_name');
				$page_data['contact_no'] = $this->input->post('cust_contact');
				$page_data['email'] = $this->input->post('cust_email');
				$page_data['address'] = $this->input->post('cust_address');
				$page_data['cust_unique_id'] = uniqid('WTC'.date("ym")."_");
				$page_data['gstin'] = $this->input->post('cust_gstin');
				if ($this->db->insert('water_tanks_customers', $page_data)) {
					$customer_id = $this->db->insert_id();
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$tanks_data['cust_id'] = $customer_id;
						$tanks_data['tank_type'] = $this->input->post('tank_type_'.$i);
						$tanks_data['tank_capacity'] = $this->input->post('tank_capacity_'.$i);
						$tanks_data['tank_quantity'] = $this->input->post('tank_qty_'.$i);
						$this->db->insert('customers_tanks', $tanks_data);
					}
					$this->session->set_flashdata('success','Customer Saved successfully.');
					redirect('water_tank_cleaning_customers');
				}
			}
		}
	}

	public function getAmcDate() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (($this->input->post('amc_date') !='') && ($this->input->post('amc_type') !='')) {
				if ($this->input->post('amc_type') == 1) {
					echo $next_amc_date = date("d-m-Y", strtotime("+1 year", strtotime($this->input->post('amc_date'))));
					echo json_encode(['next_amc_date'=>$next_amc_date]);
				} if ($this->input->post('amc_type') == 2) {
					$next_amc_date = date("d-m-Y", strtotime("+6 months", strtotime($this->input->post('amc_date'))));
					echo json_encode(['next_amc_date'=>$next_amc_date,'amc_type'=>2]);
				} if ($this->input->post('amc_type') == 3) {
					$next_amc_date1 = date("d-m-Y", strtotime("+4 months", strtotime($this->input->post('amc_date'))));
					$next_amc_date2 = date("d-m-Y", strtotime("+4 months", strtotime($next_amc_date1)));
					echo json_encode(['next_amc_date1'=>$next_amc_date1,'next_amc_date2'=>$next_amc_date2,'amc_type'=>3]);
				} if ($this->input->post('amc_type') == 4) {
					$next_amc_date1 = date("d-m-Y", strtotime("+3 months", strtotime($this->input->post('amc_date'))));
					$next_amc_date2 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date1)));
					$next_amc_date3 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date2)));
					echo json_encode(['next_amc_date1'=>$next_amc_date1,'next_amc_date2'=>$next_amc_date2,'next_amc_date3'=>$next_amc_date3,'amc_type'=>4]);
				}
			}
		}
	}
}

/* End of file WTCustomerController.php */
/* Location: ./application/controllers/WTCustomerController.php */