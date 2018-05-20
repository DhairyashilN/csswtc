<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WTAmcController extends CI_Controller {
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
			$this->db->select('id,cust_id,customer_name');
			$this->db->from('water_tanks_amcs');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrAmc'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'samc';
			$this->load->view('tanks_amc_list',$page_data);
		}
	}

	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,cust_id,customer_name');
				$this->db->from('water_tanks_amcs');
				$this->db->where('id', $id);
				$page_data['ObjAmc']= $this->db->get()->row();
				$this->db->select('id,amc_date,amc_reminder_date,next_amc_date,amc_note');
				$this->db->from('water_tanks_amc_items');
				$this->db->where('amc_id', $id);
				$this->db->where('deleted', 0);
				$page_data['ArrAmc']= $this->db->get()->result_array();
			}
			$page_data['active_menu'] = 'samc';
			$this->load->view('tanks_amc_details',$page_data);
		}
	}

	public function store() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			// echo '<pre/>'; print_r($_POST);die;
			if (($this->input->post('amc_type1')!='') && ($this->input->post('amc_type1') == 1)) {
				$amc_item['amc_id'] = $this->input->post('amc_id');	
				$amc_item['amc_date'] = $this->input->post('amc_date_1');	
				$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date_1');	
				$amc_item['next_amc_date'] = $this->input->post('next_amc_date_1');
				$amc_item['amc_note'] = $this->input->post('amc_note_1');
				$this->db->insert('water_tanks_amc_items', $amc_item);	
			} if (($this->input->post('amc_type2')!='') && ($this->input->post('amc_type2') == 2)) {
				for($i=1; $i<=2; $i++) {
					$amc_item['amc_id'] = $this->input->post('amc_id');	
					$amc_item['amc_date'] = $this->input->post('amc_date1_'.$i);	
					$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date1_'.$i);	
					$amc_item['next_amc_date'] = $this->input->post('next_amc_date1_'.$i);
					$amc_item['amc_note'] = $this->input->post('amc_note1_'.$i);
					$this->db->insert('water_tanks_amc_items', $amc_item);
				}	
			} if (($this->input->post('amc_type3')!='') && ($this->input->post('amc_type3') == 3)) {
				for($i=1; $i<=3; $i++) {
					$amc_item['amc_id'] = $this->input->post('amc_id');	
					$amc_item['amc_date'] = $this->input->post('amc_date2_'.$i);	
					$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date2_'.$i);	
					$amc_item['next_amc_date'] = $this->input->post('next_amc_date2_'.$i);
					$amc_item['amc_note'] = $this->input->post('amc_note2_'.$i);
					$this->db->insert('water_tanks_amc_items', $amc_item);
				}	
			} if (($this->input->post('amc_type4')!='') && ($this->input->post('amc_type4') == 4)) {
				for($i=1; $i<=4; $i++) {
					$amc_item['amc_id'] = $this->input->post('amc_id');	
					$amc_item['amc_date'] = $this->input->post('amc_date3_'.$i);	
					$amc_item['amc_reminder_date'] = $this->input->post('amc_rem_date3_'.$i);	
					$amc_item['next_amc_date'] = $this->input->post('next_amc_date3_'.$i);
					$amc_item['amc_note'] = $this->input->post('amc_note3_'.$i);
					$this->db->insert('water_tanks_amc_items', $amc_item);
				}	
			}
			$this->session->set_flashdata('success','AMC data added successfully.');
			redirect('water_tank_cleaning_amcs');
		}
	}

	public function save_amc_note($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('water_tanks_amc_items', ['amc_note' => $this->input->post('amc_notes')]);
				$this->session->set_flashdata('success',' Water tank AMC note updated successfully.');
				redirect('water_tank_cleaning_amcs');
			}

		}
	}

	public function destroy($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$query = $this->db->update('water_tanks_amcs', ['deleted' => 1]);
				if ($query) {
					$this->db->where('amc_id', $id);
					$this->db->update('water_tanks_amc_items', ['deleted' => 1]);
					$this->session->set_flashdata('success','WAter tank AMC deleted successfully.');
					redirect('water_tank_cleaning_amcs');
				}
			}
		}
	}
}
/* End of file WTAmcController.php */
/* Location: ./application/controllers/WTAmcController.php */ ?>