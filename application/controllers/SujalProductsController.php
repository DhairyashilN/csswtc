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
				$this->db->where('id', $id);
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
			$this->db->select('id,customer_name,order_date,order_net_amount,order_paid_amount,
				order_due_amount,order_status,invoice_id');
			$this->db->from('sujal_orders');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrOrders'] = $this->db->get()->result_array();
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
			// echo '<pre>';print_r($_POST);die;
			$this->form_validation->set_rules('sale_date','Sale Date','required');
			$this->form_validation->set_rules('customer_name','Customer','required');
			$this->form_validation->set_rules('product','Product','required');
			$this->form_validation->set_rules('order_total','Order Total','required|numeric');
			$this->form_validation->set_rules('order_net_amount','Order Net Amount','required|numeric');
			$this->form_validation->set_rules('order_paid_amount','Order Paid Amount','required|numeric');
			$this->form_validation->set_rules('order_due_amount','Order Due Amount','required|numeric');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products_sold';
				$page_data['sub_active_menu'] = 'sproducts_sold';
				$this->load->view('sale_sujal_product',$page_data);
			} else {
				$page_data['order_date'] = $this->input->post('sale_date');
				$page_data['sujal_cust_id'] = $this->input->post('customer');
				$page_data['customer_name'] = $this->input->post('customer_name');
				$page_data['order_amount'] = $this->input->post('order_total');
				$page_data['order_tax_rate'] = $this->input->post('tax_rate');
				$page_data['order_tax_amount'] = $this->input->post('order_tax');
				$page_data['order_net_amount'] = $this->input->post('order_net_amount');
				$page_data['order_paid_amount'] = $this->input->post('order_paid_amount');
				$page_data['order_due_amount'] = $this->input->post('order_due_amount');
				if ($page_data['order_due_amount'] == 0) {
					$page_data['order_status'] = 'payment_paid';
				}else {
					$page_data['order_status'] = 'payment_due';
				}
				if ($this->db->insert('sujal_orders', $page_data)) {
					$order_id = $this->db->insert_id();
					$item_desc = $this->input->post('item_desc');
					$item_quantity = $this->input->post('item_qty');
					$item_rate = $this->input->post('item_rate');
					$item_amount = $this->input->post('item_amount');
					foreach($item_quantity as $a => $b) {
						$order_item['sujal_order_id'] = $order_id;
						$order_item['item_desc'] = $item_desc[$a];
						$order_item['item_quantity'] = $item_quantity[$a];
						$order_item['item_rate'] = $item_rate[$a];
						$order_item['item_amount'] = $item_amount[$a];
						$this->db->insert('sujal_order_items', $order_item);
					} 
					$this->session->set_flashdata('success','Order Saved successfully.');
					redirect('sale_product');
				}
			}
		}
	}

	public function edit_sale($id=''){
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('*');
			$this->db->from('sujal_orders');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjOrder'] = $this->db->get()->row();
			$this->db->select('*');
			$this->db->from('sujal_order_items');
			$this->db->where('sujal_order_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrItems'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('sujal_products');
			$this->db->where('deleted', 0);
			$page_data['ArrProducts'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'products_sold';
			$this->load->view('edit_sale_sujal_product',$page_data);
		}
	}

	public function update_sale($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			// echo '<pre>';print_r($_POST);die;
			$this->form_validation->set_rules('sale_date','Sale Date','required');
			$this->form_validation->set_rules('customer_name','Customer','required');
			$this->form_validation->set_rules('order_total','Order Total','required|numeric');
			$this->form_validation->set_rules('order_net_amount','Order Net Amount','required|numeric');
			$this->form_validation->set_rules('order_paid_amount','Order Paid Amount','required|numeric');
			$this->form_validation->set_rules('order_due_amount','Order Due Amount','required|numeric');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products_sold';
				$page_data['sub_active_menu'] = 'sproducts_sold';
				$this->load->view('sale_sujal_product',$page_data);
			} else {
				$page_data['order_date'] = $this->input->post('sale_date');
				$page_data['sujal_cust_id'] = $this->input->post('customer');
				$page_data['customer_name'] = $this->input->post('customer_name');
				$page_data['order_amount'] = $this->input->post('order_total');
				$page_data['order_tax_rate'] = $this->input->post('tax_rate');
				$page_data['order_tax_amount'] = $this->input->post('order_tax');
				$page_data['order_net_amount'] = $this->input->post('order_net_amount');
				$page_data['order_paid_amount'] = $this->input->post('order_paid_amount');
				$page_data['order_due_amount'] = $this->input->post('order_due_amount');
				if ($page_data['order_due_amount'] == 0) {
					$page_data['order_status'] = 'payment_paid';
				}else {
					$page_data['order_status'] = 'payment_due';
				}
				$this->db->where('id',$id);
				$query = $this->db->update('sujal_orders', $page_data);
				if ($query) {
					$this->db->where('sujal_order_id', $id);
					$this->db->delete('sujal_order_items');
					$item_desc = $this->input->post('item_desc');
					$item_quantity = $this->input->post('item_qty');
					$item_rate = $this->input->post('item_rate');
					$item_amount = $this->input->post('item_amount');
					foreach($item_quantity as $a => $b) {
						$order_item['sujal_order_id'] = $id;
						$order_item['item_desc'] = $item_desc[$a];
						$order_item['item_quantity'] = $item_quantity[$a];
						$order_item['item_rate'] = $item_rate[$a];
						$order_item['item_amount'] = $item_amount[$a];
						$this->db->insert('sujal_order_items', $order_item);
					} 
					$this->session->set_flashdata('success','Order Saved successfully.');
					redirect('sale_product');
				}
			}
		}
	}

	public function destroy_sale($id='') {
		if ($this->session->userdata('login')!=1) {
			redirect(base_url());
		} else {
			if (isset($id) && !empty($id)) {
				$this->db->where('id', $id);
				$this->db->update('sujal_orders', ['deleted' => 1]);
				$this->db->where('sujal_order_id', $id);
				$this->db->update('sujal_order_items', ['deleted' => 1]);
				$this->session->set_flashdata('success','Product Sale Deleted successfully.');
				redirect('sale_product');
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