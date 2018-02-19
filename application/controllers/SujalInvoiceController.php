<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SujalInvoiceController extends CI_Controller {
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
			$this->db->select('id,invoice_no,customer_name,invoice_date,invoice_net_amount');
			$this->db->from('sujal_invoices');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrInvoices'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('sujal_invoices_list',$page_data);
		}
	}

	public function create($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$invoice_no = 0;
			$this->db->select('prefix');
			$this->db->from('invoice_prefix');
			$this->db->where('id',1);
			$page_data['invoice_prefix'] = $this->db->get()->row()->prefix;
			$this->db->select('id');
			$this->db->from('sujal_invoices');
			$ArrInvoiceNum = $this->db->get()->result_array();
			// print_r($ArrInvoiceNum);die;
			foreach ($ArrInvoiceNum as $row) {
				$invoice_no = $row['id'];
			}
			if(count($ArrInvoiceNum) < 0){
				$page_data['invoice_no'] = 1;
			}else{
				$page_data['invoice_no'] = $invoice_no + 1;
			}
			$this->db->select('*');
			$this->db->from('sujal_orders');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$this->db->select('contact_no,address,gstin');
			$this->db->from('sujal_customers');
			$this->db->where('id', $page_data['ObjInvoice']->sujal_cust_id);
			$page_data['ObjCustomer'] = $this->db->get()->row();
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
			$this->load->view('add_sujal_invoice',$page_data);
		}
	}

	public function store() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			// echo '<pre/>'; print_r($_POST);die;
			$this->form_validation->set_rules('customer_name','Customer Name','required');
			$this->form_validation->set_rules('invoice_no','Invoice Number','required');
			$this->form_validation->set_rules('invoice_date','Invoice Date','required');
			$this->form_validation->set_rules('caddress','Address','required');
			$this->form_validation->set_rules('mobile_no','Mobile Number','required|numeric');
			$this->form_validation->set_rules('payment_mode','Payment Mode','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'products_sold';
				$this->load->view('add_sujal_invoice',$page_data);
			} else {
				$page_data['sujal_cust_id'] = $this->input->post('customer_name');
				$page_data['customer_name'] = $this->input->post('cust_name');
				$page_data['address'] = $this->input->post('caddress');
				$page_data['contact_no'] = $this->input->post('mobile_no');
				$page_data['customer_gstin'] = $this->input->post('cgstin');
				$page_data['invoice_no'] = $this->input->post('invoice_no');
				$page_data['invoice_date'] = $this->input->post('invoice_date');
				$page_data['invoice_amount'] = $this->input->post('invoice_total');
				$page_data['invoice_tax_rate'] = $this->input->post('tax_rate');
				$page_data['invoice_tax_amount'] = $this->input->post('invoice_tax');
				$page_data['invoice_net_amount'] = $this->input->post('invoice_net_amount');
				$page_data['payment_mode'] = $this->input->post('payment_mode');
				if ($this->db->insert('sujal_invoices', $page_data)) {
					$invoice_id = $this->db->insert_id();
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['sujal_invoice_id'] = $invoice_id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('sujal_invoice_items', $invoice_item);
					}
					$order_data['order_status'] = 'invoice_generated'; 
					$order_data['invoice_id'] = $invoice_id; 
					$this->db->where('id', $this->input->post('order_id'));
					$this->db->update('sujal_orders', $order_data);
					$this->db->select('item_desc');
					$this->db->from('sujal_order_items');
					$this->db->where('sujal_order_id', $this->input->post('order_id'));
					$this->db->where('deleted', 0);
					$ArrItems = $this->db->get()->result_array();
					foreach ($ArrItems as $row) {
						$amc_data['cust_id'] = $this->input->post('customer_name');
						$amc_data['customer_name'] = $this->input->post('cust_name');
						$amc_data['product_name'] = $row['item_desc'];
						$this->db->insert('sujal_amc',$amc_data);
					}
					$this->session->set_flashdata('success','Invoice Saved successfully.');
					redirect('sujal_invoices');
				}
			}
		}
	}

	public function edit($id=''){
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('*');
			$this->db->from('sujal_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$this->db->select('*');
			$this->db->from('sujal_invoice_items');
			$this->db->where('sujal_invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrItems'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('edit_sujal_invoice',$page_data);
		}
	}

	public function update_invoice($id='') {
		// echo '<pre/>'; print_r($_POST);die;
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('customer_name','Customer Name','required');
			$this->form_validation->set_rules('invoice_no','Invoice Number','required');
			$this->form_validation->set_rules('invoice_date','Invoice Date','required');
			$this->form_validation->set_rules('caddress','Address','required');
			$this->form_validation->set_rules('mobile_no','Mobile Number','required|numeric');
			$this->form_validation->set_rules('payment_mode','Payment Mode','required');
			if ($this->form_validation->run() == FALSE) {
				$page_data['active_menu'] = 'sinvc';
				$this->load->view('edit_sujal_invoice',$page_data);
			} else {
				$page_data['sujal_cust_id'] = $this->input->post('customer_name');
				$page_data['customer_name'] = $this->input->post('cust_name');
				$page_data['address'] = $this->input->post('caddress');
				$page_data['contact_no'] = $this->input->post('mobile_no');
				$page_data['customer_gstin'] = $this->input->post('cgstin');
				$page_data['invoice_no'] = $this->input->post('invoice_no');
				$page_data['invoice_date'] = $this->input->post('invoice_date');
				$page_data['invoice_amount'] = $this->input->post('invoice_total');
				$page_data['invoice_tax_rate'] = $this->input->post('tax_rate');
				$page_data['invoice_tax_amount'] = $this->input->post('invoice_tax');
				$page_data['invoice_net_amount'] = $this->input->post('invoice_net_amount');
				$page_data['payment_mode'] = $this->input->post('payment_mode');
				$this->db->where('id',$id);
				$query = $this->db->update('sujal_invoices', $page_data);
				if ($query) {
					$this->db->where('sujal_invoice_id', $id);
					$this->db->delete('sujal_invoice_items');
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['sujal_invoice_id'] = $id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('sujal_invoice_items', $invoice_item);
					}
					$this->session->set_flashdata('success','Invoice updated successfully.');
					redirect('sujal_invoices');
				}
			}
		}	
	}

	public function show_invoice($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,invoice_no,customer_name,address,contact_no,customer_gstin,invoice_date,invoice_amount,invoice_tax_rate,invoice_tax_amount,invoice_net_amount,payment_mode');
			$this->db->from('sujal_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$page_data['Amount_in_words'] = $this->displaywords($page_data['ObjInvoice']->invoice_net_amount);
			$this->db->select('item_desc,item_quantity,item_rate,item_amount');
			$this->db->from('sujal_invoice_items');
			$this->db->where('sujal_invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrInvoiceItems'] = $this->db->get()->result_array();
			$this->load->view('non_sujal_invoice', $page_data);
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

	public function displaywords($number){
		$decimal = round($number - ($no = floor($number)), 2) * 100;
		$hundred = null;
		$digits_length = strlen($no);
		$i = 0;
		$str = array();
		$words = array(0 => '', 1 => 'One', 2 => 'Two',
			3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
			7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
			10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
			13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
			16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
			19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
			40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
			70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
		$digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
		while( $i < $digits_length ) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
			} else $str[] = null;
		}
		$Rupees = implode('', array_reverse($str));
		$paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
		return ($Rupees ? 'Rupees '. $Rupees : '') . $paise .' Only';
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */ ?>