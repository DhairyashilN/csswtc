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
				$this->db->update('water_tanks_types', ['deleted' => 1]);
				$this->session->set_flashdata('success','Water tank type Deleted successfully.');
				redirect('water_tank_types');
			}
		}
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ 