<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	public function validate_login() {
		$username = $this->input->post('uname');
		$password = $this->input->post('upass');
		if (empty($username) && empty($password)) {
			$this->session->set_flashdata('loginfail','Please Enter username and password');
			redirect(base_url());
		}
		$this->load->library('PasswordHash');
		$credentials = array('username' => $username);
		$query = $this->db->get_where('users', $credentials);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			if ($this->passwordhash->CheckPassword($password, $row->password)) {
				if ($row->access_level == 1) {
					$this->session->set_userdata('login', '1');
					$this->session->set_userdata('id', $row->id);
					$this->session->set_userdata('name', $row->name);
					$this->session->set_userdata('username', $row->username);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('loginfail','You have no admin rights.');
					redirect(base_url());
				}
			} else {
				$this->session->set_flashdata('loginfail','Incorrect Username & Password');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('loginfail','Incorrect username & Password');
			redirect(base_url());	
		}	
	}

	public function dashboard() {
		if ($this->session->userdata('login')!=1)
			redirect(base_url());
		$page_data['active_menu'] = 'dashboard';
		$this->load->view('dashboard',$page_data);
	}

	public function logout(){
		#AAA;
		$this->session->unset_userdata($this->session->userdata('id'));
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */