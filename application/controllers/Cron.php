<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function index() {
		$this->db->select('id,sujal_amc_id,amc_reminder_date,amc_date,next_amc_date');
		$this->db->from('sujal_amc_items');
		$this->db->where('deleted', 0);
		$ArrAmcItems = $this->db->get()->result_array();
		//echo '<pre/>'; print_r($ArrAmcItems);die;
		if (isset($ArrAmcItems) && !empty($ArrAmcItems)) {
			foreach ($ArrAmcItems as $row) {
				if ($row["amc_reminder_date"] == date('d-m-Y')) {
					$data['notification_title'] = 'Sujal AMC';
					$this->db->select('cust_id,customer_name');
					$this->db->from('sujal_amc');
					$this->db->where('id', $row['sujal_amc_id']);
					$this->db->where('deleted', 0);
					$ArrAmc = $this->db->get()->result_array();
					foreach ($ArrAmc as $arow) {
						$this->db->select('cust_id');
						$this->db->from('sujal_customers');
						$this->db->where('id', $arow['cust_id']);
						$this->db->where('deleted', 0);
						$Arrcustomer = $this->db->get()->result_array();
						foreach ($Arrcustomer as $crow) {
							$data['customer_unique_id'] = $crow['cust_id'];  
						}
						$data['customer_name'] = $arow['customer_name'];  
						$data['amc_date'] = $row['next_amc_date'];
						$data['amc_reminder_date'] = $row["amc_reminder_date"];
						$this->db->insert('notifications_tbl', $data);  
					}
				} else {
					echo 'Date Not Matched<br/>';
				}
			}
		}else{
			echo 'No records found';
		}
	}

	public function non_sujal_amc_reminders(){
		$this->db->select('id,non_sujal_amc_id,amc_reminder_date,amc_date,next_amc_date');
		$this->db->from('non_sujal_amc_items');
		$this->db->where('deleted', 0);
		$ArrAmcItems = $this->db->get()->result_array();
		if(isset($ArrAmcItems) && !empty($ArrAmcItems)){
			foreach ($ArrAmcItems as $row) {
				if ($row["amc_reminder_date"] == date('d-m-Y')) {
					$data['notification_title'] = 'Other (Non Sujal) AMC';
					$this->db->select('cust_id');
					$this->db->from('non_sujal_amcs');
					$this->db->where('id', $row['non_sujal_amc_id']);
					$this->db->where('deleted', 0);
					$ArrAmc = $this->db->get()->result_array();
					foreach ($ArrAmc as $arow) {
						$this->db->select('cust_unique_id,name');
						$this->db->from('non_sujal_customers');
						$this->db->where('id', $arow['cust_id']);
						$this->db->where('deleted', 0);
						$Arrcustomer = $this->db->get()->result_array();
						foreach ($Arrcustomer as $crow) {
							$data['customer_unique_id'] = $crow['cust_unique_id'];  
							$data['customer_name'] = $crow['name'];  
						}
						$data['amc_date'] = $row['next_amc_date'];
						$data['amc_reminder_date'] = $row["amc_reminder_date"];
						$this->db->insert('notifications_tbl', $data);  
					}
				} else{
					echo 'Date Not Matched<br/>';
				}
			}
		} else {
			echo 'No Records Found.'; 
		}
	}
}
