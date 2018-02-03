<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

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
			$this->db->select('id,username,email');
			$this->db->where('id', $this->session->userdata('id'));
			$this->db->where('access_level', 1);
			$this->db->from('users');
			$page_data['active_menu'] = '';
			$page_data['ObjUser'] = $this->db->get()->row();
			$this->load->view('user_profile', $page_data);
		}	
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->load->library('PasswordHash');
			$data['username'] = $this->input->post('uname');
			$data['password'] = $this->input->post('upass');
			$data['confirm_password'] = $this->input->post('cupass');
			if (!empty($data['password'])) {
				if ($data['password'] == $data['confirm_password']) {
					$this->db->where('id', $this->session->userdata('id'));
					$this->db->where('access_level', 1);
					$this->db->update('users', array('password' =>  $this->passwordhash->HashPassword($data['password']), 'username'=>$data['username']));
					$this->session->set_flashdata('success','password updated successfully.');
				} else {
					$this->session->set_flashdata('success','password mismatch');
				}
			} else {
				$this->db->where('id', $this->session->userdata('id'));
				$this->db->where('access_level', 1);
				$this->db->update('users', array('username'=>$data['username']));
				$this->session->set_flashdata('success','User Name updated successfully.');
			}
			redirect('user','refresh');
		}
	}

}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */ 