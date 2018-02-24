<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}

	public function test() {
		$data['active_menu'] = 'test';
		$this->load->view('test',$data);
	}

	public function getAmcDate() {
		echo $next_amc_date = date("d-m-Y", strtotime("+3 months", strtotime($this->input->post('amc_date'))));
		echo $next_amc_date1 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date)));
		echo $next_amc_date2 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date1)));
		echo $next_amc_date3 = date("d-m-Y", strtotime("+3 months", strtotime($next_amc_date2)));
	}
}
