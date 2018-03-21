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
			$this->db->select('id,name,contact_no,email');
			$this->db->from('water_tanks_customers');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrCustomer'] = $this->db->get()->result_array();
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

	public function store() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			// echo '<pre>';print_r($_POST);die;
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
					$tank_type = $this->input->post('tank_type');
					$tank_quantity = $this->input->post('tank_qty');
					$tank_capacity = $this->input->post('tank_capacity');
					foreach($tank_quantity as $a => $b){
						$tanks_data['cust_id'] = $customer_id;
						$tanks_data['tank_type'] = $tank_type[$a];
						$tanks_data['tank_capacity'] = $tank_capacity[$a];
						$tanks_data['tank_quantity'] = $tank_quantity[$a];
						$this->db->insert('customers_tanks', $tanks_data);
					}
					$amc_data['cust_id'] = $customer_id;
					$amc_data['customer_name'] = $this->input->post('cust_name');
					if ($this->db->insert('water_tanks_amcs', $amc_data)) {
						$amc_id = $this->db->insert_id();
						if (!empty($this->input->post('amc_type1')) && ($this->input->post('amc_type1') == 1)) {
							$amc_item['amc_id'] = $amc_id;	
							$amc_item['amc_date'] = $this->input->post('amc_date_1');	
							$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date_1');	
							$amc_item['next_amc_date'] = $this->input->post('next_amc_date_1');
							$amc_item['amc_note'] = $this->input->post('amc_note_1');
							$this->db->insert('water_tanks_amc_items', $amc_item);	
						} if (!empty($this->input->post('amc_type2')) && ($this->input->post('amc_type2') == 2)) {
							for($i=1; $i<=2; $i++) {
								$amc_item['amc_id'] = $amc_id;	
								$amc_item['amc_date'] = $this->input->post('amc_date1_'.$i);	
								$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date1_'.$i);
								$amc_item['next_amc_date'] = $this->input->post('next_amc_date1_'.$i);
								$amc_item['amc_note'] = $this->input->post('amc_note1_'.$i);
								$this->db->insert('water_tanks_amc_items', $amc_item);
							}	
						} if (!empty($this->input->post('amc_type3')) && ($this->input->post('amc_type3') == 3)) {
							for($i=1; $i<=3; $i++) {
								$amc_item['amc_id'] = $amc_id;	
								$amc_item['amc_date'] = $this->input->post('amc_date2_'.$i);	
								$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date2_'.$i);
								$amc_item['next_amc_date'] = $this->input->post('next_amc_date2_'.$i);
								$amc_item['amc_note'] = $this->input->post('amc_note2_'.$i);
								$this->db->insert('water_tanks_amc_items', $amc_item);
							}	
						} if (!empty($this->input->post('amc_type4')) && ($this->input->post('amc_type4') == 4)) {
							for($i=1; $i<=4; $i++) {
								$amc_item['amc_id'] = $amc_id;	
								$amc_item['amc_date'] = $this->input->post('amc_date3_'.$i);	
								$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date3_'.$i);
								$amc_item['next_amc_date'] = $this->input->post('next_amc_date3_'.$i);
								$amc_item['amc_note'] = $this->input->post('amc_note3_'.$i);
								$this->db->insert('water_tanks_amc_items', $amc_item);
							}	
						}
					}
					$this->session->set_flashdata('success','Customer Saved successfully.');
					redirect('water_tank_cleaning_customers');
				}
			}
		}
	}

	public function edit($id=''){
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$this->db->select('id,name,contact_no,email,address,gstin');
			$this->db->from('water_tanks_customers');
			$this->db->where('id', $id);
			$page_data['ObjCustomer'] = $this->db->get()->row();
			$this->db->select('*');
			$this->db->from('customers_tanks');
			$this->db->where('cust_id', $id);
			$page_data['ArrItems'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'customers';
			$this->load->view('edit_water_tank_customer', $page_data);
		}
	}

	public function update($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			// echo '<pre>';print_r($_POST);die;
			$this->form_validation->set_rules('cust_name','Customer Name','required');
			$this->form_validation->set_rules('cust_contact','Contact Number','required|numeric');
			$this->form_validation->set_rules('cust_address','Address','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'customers';
				$this->load->view('edit_tank_customer',$page_data);
			} else {
				$page_data['name'] = $this->input->post('cust_name');
				$page_data['contact_no'] = $this->input->post('cust_contact');
				$page_data['email'] = $this->input->post('cust_email');
				$page_data['address'] = $this->input->post('cust_address');
				$this->db->select('cust_unique_id');
				$this->db->where('id', $id);
				$this->db->from('water_tanks_customers');
				$page_data['cust_unique_id'] = $this->db->get()->row()->cust_unique_id; 
				$page_data['gstin'] = $this->input->post('cust_gstin');
				$this->db->where('id',$id);
				$query = $this->db->update('water_tanks_customers', $page_data);
				if ($query) {
					$this->db->where('cust_id', $id);
					$this->db->delete('customers_tanks');
					$tank_type = $this->input->post('tank_type');
					$tank_quantity = $this->input->post('tank_qty');
					$tank_capacity = $this->input->post('tank_capacity');
					foreach($tank_quantity as $a => $b){
						$tanks_data['cust_id'] = $id;
						$tanks_data['tank_type'] = $tank_type[$a];
						$tanks_data['tank_capacity'] = $tank_capacity[$a];
						$tanks_data['tank_quantity'] = $tank_quantity[$a];
						$this->db->insert('customers_tanks', $tanks_data);
					}
					$this->session->set_flashdata('success','Customer data updated successfully.');
					redirect('water_tank_cleaning_customers');
				}
			}
		}
	}

	public function view($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('name,contact_no,email,cust_unique_id,gstin,address');
			$this->db->from('water_tanks_customers');
			$this->db->where('id', $id);
			$page_data['ObjCustomer'] = $this->db->get()->row();
			$this->db->select('tank_type,tank_capacity,tank_quantity');
			$this->db->from('customers_tanks');
			$this->db->where('cust_id', $id);
			$page_data['ArrCustTanks'] = $this->db->get()->result_array();
			$this->db->select('id');
			$this->db->from('water_tanks_amcs');
			$this->db->where('cust_id', $id);
			$ObjAMC = $this->db->get()->row();
			$this->db->select('amc_date,amc_reminder_date,next_amc_date,amc_note');
			$this->db->from('water_tanks_amc_items');
			$this->db->where('amc_id', $ObjAMC->id);
			$page_data['ArrCustAMCs'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'customers' ;
			$this->load->view('tanks_customer_details', $page_data);

		}
	}

	public function destroy($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$query = $this->db->update('water_tanks_customers', ['deleted' => 1]);
				if ($query) {
					$this->db->where('cust_id', $id);
					$this->db->update('water_tanks_amcs', ['deleted' => 1]);
					$this->session->set_flashdata('success','Water tank customer deleted successfully.');
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
					$next_amc_date = date("d-m-Y", strtotime("+1 year", strtotime($this->input->post('amc_date'))));
					$amc_rem_date = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date)));
					echo json_encode(['next_amc_date'=>$next_amc_date, 'amc_rem_date'=>$amc_rem_date, 'amc_type'=>1]);
				} if ($this->input->post('amc_type') == 2) {
					$next_amc_date1 = date("d-m-Y", strtotime("+6 months", strtotime($this->input->post('amc_date'))));
					$amc_rem_date1 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date1)));
					$next_amc_date2 = date("d-m-Y", strtotime("+6 months", strtotime($next_amc_date1)));
					$amc_rem_date2 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date2)));
					echo json_encode(['next_amc_date1'=>$next_amc_date1, 'amc_rem_date1'=>$amc_rem_date1, 'next_amc_date2'=>$next_amc_date2, 'amc_rem_date2'=>$amc_rem_date2, 'amc_type'=>2]);
				} if ($this->input->post('amc_type') == 3) {
					$next_amc_date1 = date("d-m-Y", strtotime("+4 months", strtotime($this->input->post('amc_date'))));
					$amc_rem_date1 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date1)));
					$next_amc_date2 = date("d-m-Y", strtotime("+4 months", strtotime($next_amc_date1)));
					$amc_rem_date2 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date2)));
					$next_amc_date3 = date("d-m-Y", strtotime("+4 months", strtotime($next_amc_date2)));
					$amc_rem_date3 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date3)));
					echo json_encode(['next_amc_date1'=>$next_amc_date1,'next_amc_date2'=>$next_amc_date2, 'next_amc_date3'=>$next_amc_date3, 'amc_rem_date1'=>$amc_rem_date1, 'amc_rem_date2'=>$amc_rem_date2, 'amc_rem_date3'=>$amc_rem_date3, 'amc_type'=>3]);
				} if ($this->input->post('amc_type') == 4) {
					$next_amc_date1 = date("d-m-Y", strtotime("+3 months", strtotime($this->input->post('amc_date'))));
					$amc_rem_date1 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date1)));
					$next_amc_date2 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date1)));
					$amc_rem_date2 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date2)));
					$next_amc_date3 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date2)));
					$amc_rem_date3 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date3)));
					$next_amc_date4 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date3)));
					$amc_rem_date4 = date("d-m-Y", strtotime("-7 days", strtotime($next_amc_date4)));
					echo json_encode(['next_amc_date1'=>$next_amc_date1,'next_amc_date2'=>$next_amc_date2,'next_amc_date3'=>$next_amc_date3, 'amc_rem_date1'=>$amc_rem_date1, 
						'amc_rem_date2'=>$amc_rem_date2, 'amc_rem_date3'=>$amc_rem_date3, 'next_amc_date4'=>$next_amc_date4, 'amc_rem_date4'=>$amc_rem_date4, 'amc_type'=>4]);
				}
			}
		}
	}
}

/* End of file WTCustomerController.php */
/* Location: ./application/controllers/WTCustomerController.php */