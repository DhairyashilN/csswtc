<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WatertanksController extends CI_Controller {

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
			$page_data['active_menu']  = 'products';
			$this->load->view('tank_types_list',$page_data);
		}
	}

	public function create($id='') {
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
			$page_data['active_menu'] = 'products';
			$this->load->view('add_tank_type',$page_data);
		}
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('type_name','Type Name','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products';
				$this->load->view('tank_types_list',$page_data);
			} else {
				$page_data['name']  = $this->input->post('type_name');
				if (isset($id) && !empty($id)) {
					$this->db->where('id',$id);
					$this->db->update('water_tanks_types',$page_data);
					$this->session->set_flashdata('success','Water tank type updated successfully.');
				} else {
					$this->db->insert('water_tanks_types',$page_data);
					$this->session->set_flashdata('success','Water tank type added successfully.');
				}
				redirect('water_tank_types');
			}
		}
	}

	public function destroy($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$query = $this->db->update('water_tanks_types', ['deleted' => 1]);
				if ($query) {
					$this->db->where('water_tank_type_id', $id);
					$query = $this->db->update('water_tanks', ['deleted' => 1]);
					$this->session->set_flashdata('success','Water tank type Deleted successfully.');
					redirect('water_tank_types');
				}
			}
		}
	}

	public function water_tanks_index() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,water_tank_type_id,capacity,charges');
			$this->db->from('water_tanks');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrTanks'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$page_data['active_menu']  = 'products';
			$this->load->view('tanks_list',$page_data);
		}
	}

	public function water_tanks_create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,water_tank_type_id,capacity,charges');
				$this->db->from('water_tanks');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjTank'] = $this->db->get()->row();
			}
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array(); 
			$page_data['active_menu'] = 'products';
			$this->load->view('add_tank',$page_data);
		}
	}

	public function store_water_tanks($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('tank_type','Tank Type','required');
			$this->form_validation->set_rules('tank_capacity','Tank Capacity','required');
			$this->form_validation->set_rules('tank_cleaning_charges','Tank Cleaning Charges','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products';
				$this->load->view('add_tank',$page_data);
			} else {
				$page_data['water_tank_type_id'] = $this->input->post('tank_type');
				$page_data['capacity'] = $this->input->post('tank_capacity');
				$page_data['charges'] = $this->input->post('tank_cleaning_charges');
				if (isset($id) && !empty($id)) {
					$this->db->where('id',$id);
					$this->db->update('water_tanks',$page_data);
					$this->session->set_flashdata('success','Water tank data updated successfully.');
				} else {
					$this->db->insert('water_tanks',$page_data);
					$this->session->set_flashdata('success','Water tank data added successfully.');
				}
				redirect('water_tanks');
			}
		}
	}

	public function destroy_water_tanks($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('water_tanks', ['deleted' => 1]);
				$this->session->set_flashdata('success','Water tank data deleted successfully.');
				redirect('water_tanks');
			}
		}
	}
}

/* End of file WaterTanksController.php */
/* Location: ./application/controllers/WaterTanksController.php */ 