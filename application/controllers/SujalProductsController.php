<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SujalProductsController extends CI_Controller {
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
			$this->db->select('id,name,price,hsn_code');
			$this->db->from('sujal_products');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrProducts'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'products';
			$page_data['sub_active_menu'] = 'sproducts';
			$this->load->view('sujal_product_list',$page_data);
		}
	}

	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,name,price,hsn_code');
				$this->db->from('sujal_products');
				$this->db->where('id', $id);
				$this->db->where('deleted', 0);
				$page_data['ObjProduct'] = $this->db->get()->row();
			}
			$page_data['active_menu'] = 'products';
			$page_data['sub_active_menu'] = 'sproducts';
			$this->load->view('add_sujal_product',$page_data);
		}
	}

	public function store($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('sproduct_name','Product Name','required');
			$this->form_validation->set_rules('sproduct_price','Product Price','required|numeric');
			$this->form_validation->set_rules('sproduct_hsn','Product HSN Code','required|numeric');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products';
				$page_data['sub_active_menu'] = 'sproducts';
				$this->load->view('add_sujal_product',$page_data);
			} else {
				$page_data['name']  = $this->input->post('sproduct_name');
				$page_data['price'] = $this->input->post('sproduct_price');
				$page_data['hsn_code'] = $this->input->post('sproduct_hsn');
				if (isset($id) && !empty($id)) {
					$this->db->where('id',$id);
					$this->db->update('sujal_products',$page_data);
					$this->session->set_flashdata('success','Product updated successfully.');
				} else {
					$this->db->insert('sujal_products',$page_data);
					$this->session->set_flashdata('success','Product added successfully.');
				}
				redirect('sujal_products');
			}
		}
	}

	public function show($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('name,price,hsn_code');
				$this->db->from('sujal_products');
				$this->db->where('deleted', 0);
				$page_data['ObjProduct'] = $this->db->get()->row();
				$page_data['active_menu'] = 'products';
				$page_data['sub_active_menu'] = 'sproducts';
				$this->load->view('sujal_product_details',$page_data);	
			}
		}
	}

	public function destroy($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('sujal_products', ['deleted' => 1]);
				$this->session->set_flashdata('success','Product Deleted successfully.');
				redirect('sujal_products');
			}
		}
	}

	public function sold_products_list($value='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			$this->db->select('id,cust_id,product_id,total_amount,payment_date');
			$this->db->from('sujal_invoices');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrInvoices'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_customers');
			$this->db->where('deleted', 0);
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_products');
			$this->db->where('deleted', 0);
			$page_data['ArrProducts'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'products_sold';
			$page_data['sub_active_menu'] = 'sproducts_sold';
			$this->load->view('sujal_sold_products_list',$page_data);
		}
	}

	public function create_sale($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->select('id,cust_id,product_id,total_amount,paid_amount,due_amount,payment_date');
				$this->db->from('sujal_invoices');
				$this->db->where('deleted', 0);
				$page_data['ObjProduct'] = $this->db->get()->row();
			}
			$this->db->select('id,name');
			$this->db->from('sujal_customers');
			$this->db->where('deleted', 0);
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_products');
			$this->db->where('deleted', 0);
			$page_data['ArrProducts'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'products_sold';
			$page_data['sub_active_menu'] = 'sproducts_sold';
			$this->load->view('sale_sujal_product',$page_data);
		}
	}

	public function store_sale($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('customer','Customer','required');
			$this->form_validation->set_rules('product','Product','required');
			$this->form_validation->set_rules('sproduct_price','Product Price','required|numeric');
			$this->form_validation->set_rules('paid_amount','Paid Amount','required|numeric');
			$this->form_validation->set_rules('due_amount','Due Amount','required|numeric');
			$this->form_validation->set_rules('amount_paid_date','Amount Paid Date','required');
			$this->form_validation->set_rules('install_date','Installation Date','required');
			$this->form_validation->set_rules('amc_date','AMC Date','required');
			$this->form_validation->set_rules('amc_reminder_date','AMC Reminder Date','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products_sold';
				$page_data['sub_active_menu'] = 'sproducts_sold';
				$this->load->view('sale_sujal_product',$page_data);
			} else {
				$invoice_data['cust_id'] = $this->input->post('customer');
				$invoice_data['product_id'] = $this->input->post('product');
				$invoice_data['quantity'] = $this->input->post('sproduct_quantity');
				$invoice_data['total_amount'] = $this->input->post('paid_amount');
				$invoice_data['tax_amount'] = $this->input->post('gst_amount');
				$invoice_data['net_amount'] = $this->input->post('net_amount');
				$invoice_data['payment_date'] = $this->input->post('amount_paid_date');
				$amc_data['cust_id'] = $this->input->post('customer');
				$amc_data['product_id'] = $this->input->post('product');
				$amc_data['installation_date'] = $this->input->post('install_date');
				$amc_data['amc_date'] = $this->input->post('amc_date');
				$amc_data['amc_reminder_date'] = $this->input->post('amc_reminder_date');				if (isset($id) && !empty($id)) {
					$this->db->where('id',$id);
					$this->db->update('sujal_products',$page_data);
					$this->session->set_flashdata('success','Product updated successfully.');
				} else {
					$this->db->insert('sujal_invoices',$invoice_data);
					$this->db->insert('sujal_amc',$amc_data);
					if (($this->input->post('due_amount')!='') && ($this->input->post('due_amount') > 0))
					{
						$dues_data['cust_id'] = $this->input->post('customer');
						$dues_data['product_id'] = $this->input->post('product');
						$dues_data['quantity'] = $this->input->post('sproduct_quantity');
						$dues_data['due_amount'] = $this->input->post('due_amount');	
						$this->db->insert('sujal_payment_dues',$dues_data);
					}
					$this->session->set_flashdata('success','Product Sale added successfully.');
				}
				redirect('sujal_invoices');
			}
		}
	}

	//For AJAX from views.
	public function getProductPrice() {
		$this->db->select('price');
		$this->db->from('sujal_products');
		$this->db->where('id', $this->input->post('product'));
		$this->db->where('deleted', 0);
		$ProductPrice = $this->db->get()->row()->price;
		echo json_encode($ProductPrice);
	}

	public function getAmcDate() {
		$amc_date = date("d-m-Y", strtotime("+1 years", strtotime($this->input->post('install_date'))));
		$amc_reminder_date = date("d-m-Y", strtotime("-7 days", strtotime($amc_date)));
		echo json_encode(['amc_date'=>$amc_date, 'amc_reminder_date'=>$amc_reminder_date]);
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ ?>