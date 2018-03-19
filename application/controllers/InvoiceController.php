<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceController extends CI_Controller {

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
			$this->db->select('id,invoice_no,customer_name,invoice_date,invoice_net_amount,payment_mode');
			$this->db->from('non_sujal_invoices');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrNSInvoices'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('non_sujal_invoices_list',$page_data);
		}
	}

	public function create() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$invoice_no = 0;
			$this->db->select('prefix');
			$this->db->from('invoice_prefix');
			$this->db->where('id',2);
			$page_data['invoice_prefix'] = $this->db->get()->row()->prefix;
			$this->db->select('id');
			$this->db->from('non_sujal_invoices');
			$ArrInvoiceNum = $this->db->get()->result_array();
			// print_r($ArrInvoiceNum);die;
			foreach ($ArrInvoiceNum as $row) {
				$invoice_no = $row['id'];
			}
			if(count($ArrInvoiceNum) < 0){
				$page_data['invoice_no'] = 1;
			} else {
				$page_data['invoice_no'] = $invoice_no + 1;
			}
			$this->db->select('id,name');
			$this->db->from('non_sujal_customers');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('add_non_sujal_invoice',$page_data);
		}
	}

	public function store() {
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
				$this->load->view('add_non_sujal_invoice',$page_data);
			} else {
				$page_data['non_sujal_cust_id'] = $this->input->post('customer_name');
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
				if ($this->db->insert('non_sujal_invoices', $page_data)) {
					$invoice_id = $this->db->insert_id();
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['non_sujal_invoice_id'] = $invoice_id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('non_sujal_invoice_items', $invoice_item);
					}
					$this->session->set_flashdata('success','Invoice Saved successfully.');
					redirect('non_sujal_invoices');
				}
			}
		}	
	}

	public function edit($id=''){
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('*');
			$this->db->from('non_sujal_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$this->db->select('*');
			$this->db->from('non_sujal_invoice_items');
			$this->db->where('non_sujal_invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrItems'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('edit_non_sujal_invoice',$page_data);
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
				$this->load->view('add_non_sujal_invoice',$page_data);
			} else {
				$page_data['non_sujal_cust_id'] = $this->input->post('customer_name');
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
				$query = $this->db->update('non_sujal_invoices', $page_data);
				if ($query) {
					$this->db->where('non_sujal_invoice_id', $id);
					$this->db->delete('non_sujal_invoice_items');
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['non_sujal_invoice_id'] = $id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('non_sujal_invoice_items', $invoice_item);
					}
					$this->session->set_flashdata('success','Invoice updated successfully.');
					redirect('non_sujal_invoices');
				}
			}
		}	
	}


	public function show_invoice($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,invoice_no,customer_name,address,contact_no,customer_gstin,invoice_date,invoice_amount,invoice_tax_rate,invoice_tax_amount,invoice_net_amount,payment_mode');
			$this->db->from('non_sujal_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$page_data['Amount_in_words'] = $this->displaywords($page_data['ObjInvoice']->invoice_net_amount);
			$this->db->select('item_desc,item_quantity,item_rate,item_amount');
			$this->db->from('non_sujal_invoice_items');
			$this->db->where('non_sujal_invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrInvoiceItems'] = $this->db->get()->result_array();
			$this->load->view('non_sujal_invoice', $page_data);
		}
	}	

	// public function generate_pdf($id='') {
	// 	$this->db->select('id,invoice_no,customer_name,address,contact_no,customer_gstin,invoice_date,invoice_amount,invoice_tax_rate,invoice_tax_amount,invoice_net_amount,payment_mode');
	// 	$this->db->from('non_sujal_invoices');
	// 	$this->db->where('id', $id);
	// 	$this->db->where('deleted', 0);
	// 	$page_data['ObjInvoice'] = $this->db->get()->row();
	// 	$page_data['Amount_in_words'] = $this->displaywords($page_data['ObjInvoice']->invoice_net_amount);
	// 	$this->db->select('item_desc,item_quantity,item_rate,item_amount');
	// 	$this->db->from('non_sujal_invoice_items');
	// 	$this->db->where('non_sujal_invoice_id', $id);
	// 	$this->db->where('deleted', 0);
	// 	$page_data['ArrInvoiceItems'] = $this->db->get()->result_array();
	// 	$html = $this->load->view('non_sujal_invoice', $page_data);
	// 	//this the the PDF filename that user will get to download
	// 	$pdfFilePath = "output_pdf_name.pdf";
 //        //load mPDF library
	// 	$this->load->library('m_pdf');
 //       //generate the PDF from the given html
	// 	$this->m_pdf->pdf->WriteHTML($html);
 //        //download it.
	// 	$this->m_pdf->pdf->Output($pdfFilePath, "D");
	// }

	public function tanks_invoices() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,invoice_no,customer_name,invoice_date,invoice_net_amount,payment_mode');
			$this->db->from('water_tanks_invoices');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrNSInvoices'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('tanks_invoices_list',$page_data);
		}
	}

	public function create_tanks_invoices() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$invoice_no = 0;
			$this->db->select('prefix');
			$this->db->from('invoice_prefix');
			$this->db->where('id',3);
			$page_data['invoice_prefix'] = $this->db->get()->row()->prefix;
			$this->db->select('id');
			$this->db->from('water_tanks_invoices');
			$ArrInvoiceNum = $this->db->get()->result_array();
			// print_r($ArrInvoiceNum);die;
			foreach ($ArrInvoiceNum as $row) {
				$invoice_no = $row['id'];
			}
			if(count($ArrInvoiceNum) < 0){
				$page_data['invoice_no'] = 1;
			} else {
				$page_data['invoice_no'] = $invoice_no + 1;
			}
			$this->db->select('id,name');
			$this->db->from('water_tanks_customers');
			$this->db->where('deleted', 0);
			$this->db->order_by('id','desc');
			$page_data['ArrCustomers'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('add_tanks_invoice',$page_data);
		}	
	}

	public function store_tank_invoice() {
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
				$this->load->view('add_tanks_invoice',$page_data);
			} else {
				$page_data['cust_id'] = $this->input->post('customer_name');
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
				if ($this->db->insert('water_tanks_invoices', $page_data)) {
					$invoice_id = $this->db->insert_id();
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['invoice_id'] = $invoice_id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('water_tanks_invoice_items', $invoice_item);
					}
					$this->session->set_flashdata('success','Invoice Saved successfully.');
					redirect('watertanks_invoices');
				}
			}
		}	
	}

	public function edit_tanks_invoice($id=''){
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('*');
			$this->db->from('water_tanks_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$this->db->select('*');
			$this->db->from('water_tanks_invoice_items');
			$this->db->where('invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrItems'] = $this->db->get()->result_array();
			$this->db->select('id,name');
			$this->db->from('water_tanks_types');
			$this->db->where('deleted', 0);
			$page_data['ArrTankTypes'] = $this->db->get()->result_array();
			$page_data['active_menu'] = 'sinvc';
			$this->load->view('edit_tanks_invoice',$page_data);
		}
	}

	public function update_tank_invoice($id='') {
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
				$this->load->view('edit_water_tanks_invoice',$page_data);
			} else {
				$page_data['cust_id'] = $this->input->post('customer_name');
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
				$query = $this->db->update('water_tanks_invoices', $page_data);
				if ($query) {
					$this->db->where('invoice_id', $id);
					$this->db->delete('water_tanks_invoice_items');
					$num = $this->input->post('icnt');
					for($i=1; $i <= $num ; $i++) {
						$invoice_item['invoice_id'] = $id;
						$invoice_item['item_desc'] = $this->input->post('item_desc_'.$i);
						$invoice_item['item_quantity'] = $this->input->post('item_qty_'.$i);
						$invoice_item['item_rate'] = $this->input->post('item_rate_'.$i);
						$invoice_item['item_amount'] = $this->input->post('item_amount_'.$i);
						$this->db->insert('water_tanks_invoice_items', $invoice_item);
					}
					$this->session->set_flashdata('success','Invoice updated successfully.');
					redirect('watertanks_invoices');
				}
			}
		}	
	}

	public function show_tanks_invoice($id='') {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('id,invoice_no,customer_name,address,contact_no,customer_gstin,invoice_date,invoice_amount,invoice_tax_rate,invoice_tax_amount,invoice_net_amount,payment_mode');
			$this->db->from('water_tanks_invoices');
			$this->db->where('id', $id);
			$this->db->where('deleted', 0);
			$page_data['ObjInvoice'] = $this->db->get()->row();
			$page_data['Amount_in_words'] = $this->displaywords($page_data['ObjInvoice']->invoice_net_amount);
			$this->db->select('item_desc,item_quantity,item_rate,item_amount');
			$this->db->from('water_tanks_invoice_items');
			$this->db->where('invoice_id', $id);
			$this->db->where('deleted', 0);
			$page_data['ArrInvoiceItems'] = $this->db->get()->result_array();
			$this->load->view('tank_cleaning_invoice', $page_data);
		}
	}

	public function getCustomerinfo() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('contact_no,address,gstin,name');
			$this->db->from('non_sujal_customers');
			$this->db->where('id', $this->input->post('id'));
			$data = $this->db->get()->row();
			// echo '<pre/>'; print_r($data['ObjCustomer']);
			echo json_encode(['address'=> $data->address, 'contact_no'=> $data->contact_no, 'gstin'=> $data->gstin, 'name'=>$data->name]);
		}	
	}

	public function getTankCustomerinfo() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('contact_no,address,gstin,name');
			$this->db->from('water_tanks_customers');
			$this->db->where('id', $this->input->post('id'));
			$data = $this->db->get()->row();
			// echo '<pre/>'; print_r($data['ObjCustomer']);
			echo json_encode(['address'=> $data->address, 'contact_no'=> $data->contact_no, 'gstin'=> $data->gstin, 'name'=>$data->name]);
		}	
	}

	public function getCharges() {
		if ($this->session->userdata('login')!=1){
			redirect(base_url());
		} else {
			$this->db->select('charges');
			$this->db->from('water_tanks');
			$this->db->where('id', $this->input->post('tank'));
			$this->db->where('deleted', 0);
			$ObjCharge = $this->db->get()->row();
			// print_r($ObjCharge);die;	
			echo json_encode($ObjCharge);
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
/* Location: ./application/controllers/controllername.php */