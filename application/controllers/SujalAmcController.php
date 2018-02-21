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
			$this->db->select('id,cust_id,customer_name,product_name');
			$this->db->from('sujal_amc');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrAmc'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'samc';
			$this->load->view('sujal_amc_list',$page_data);
		}
	}

	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,cust_id,customer_name,product_name');
				$this->db->from('sujal_amc');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjAmc']= $this->db->get()->row();
				$this->db->select('id,amc_date,amc_reminder_date,next_amc_date,amc_note');
				$this->db->from('sujal_amc_items');
				$this->db->where('sujal_amc_id', $id);
				$this->db->where('deleted', 0);
				$page_data['ArrAmc']= $this->db->get()->result_array();
			}
			$page_data['active_menu'] = 'samc';
			$this->load->view('sujal_amc_details',$page_data);
		}
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('amc_date','AMC Date','required');
			$this->form_validation->set_rules('next_amc_date','Next AMC Date','required');
			$this->form_validation->set_rules('amc_reminder_date','AMC Reminder Date','required');
			$this->form_validation->set_rules('amc_note','AMC Notes','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'samc';
				$this->load->view('sujal_amc_details',$page_data);
			} else {
				$page_data['sujal_amc_id'] = $this->input->post('amc_id');
				$page_data['amc_date'] = $this->input->post('amc_date');
				$page_data['next_amc_date'] = $this->input->post('next_amc_date');
				$page_data['amc_reminder_date'] = $this->input->post('amc_reminder_date');
				$page_data['amc_note'] = $this->input->post('amc_note');
				if (isset($id) && !empty($id)) {
					$this->db->where('id', $id);
					$this->db->where('sujal_amc_id', $this->input->post('amc_id'));
					$this->db->update('sujal_amc_items', $page_data);
					$this->session->set_flashdata('success','AMC data updated successfully.');
				}else{
					$this->db->insert('sujal_amc_items', $page_data);
					$this->session->set_flashdata('success','AMC data added successfully.');
				}
				redirect('sujals_amcs');
			}
		}
	}

	public function destroy($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('sujal_amc', ['deleted' => 1]);
				$this->session->set_flashdata('success','Sujal AMC Deleted successfully.');
			}
			redirect('sujals_amcs');
		}
	}

	public function destroy_history($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('sujal_amc_items', ['deleted' => 1]);
				$this->session->set_flashdata('success','AMC Data Deleted successfully.');
			}
				redirect('sujals_amcs');
		}
	}

	public function getNextAmcDates() {
		$amc_date = date("d-m-Y", strtotime("+1 years", strtotime($this->input->post('amc_date'))));
		$amc_reminder_date = date("d-m-Y", strtotime("-7 days", strtotime($amc_date)));
		echo json_encode(['amc_date'=>$amc_date, 'amc_reminder_date'=>$amc_reminder_date]);
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ ?>