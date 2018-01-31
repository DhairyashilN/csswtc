<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function index() {
		$this->db->select('amc_reminder_date,amc_date');
		$this->db->from('sujal_amc');
		$this->db->where('deleted', 0);
		$ArrAmc = $this->db->get()->result_array();	
		// echo '<pre/>'; print_r($ArrAmc);
		if (isset($ArrAmc) && !empty($ArrAmc)) {
			foreach ($ArrAmc as $row) {
				if ($row["amc_reminder_date"] == date('d-m-Y')) {
					// echo 'Date Matched<br/>';
					$data['notification_title'] = 'Sujal AMC'; 
					$this->db->select('cust_id,name');
					$this->db->from('sujal_customers');
					$this->db->where('deleted', 0);
					$Arrcustomer = $this->db->get()->result_array(); 
					foreach ($Arrcustomer as $crow) {
						$data['customer_unique_id'] = $crow['cust_id'];  
						$data['customer_name'] = $crow['name'];  
					}
					$data['amc_date'] = $row['amc_date'];
					$data['amc_reminder_date'] = $row["amc_reminder_date"];
					$this->db->insert('notifications_tbl', $data);  

				} else{
					echo 'Date Not Matched<br/>';
				}
			}
		}
	}
}
