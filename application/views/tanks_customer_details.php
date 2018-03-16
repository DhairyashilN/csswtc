<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Dashboard</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link rel="icon" href="<?php echo base_url();?>assets/icons/favicon.png">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('layout/header'); ?>
		<?php $this->load->view('layout/sidebar'); ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Sujal 
					<small>Add Product</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">View Sujal Products</li>
				</ol>
			</section>
			<section class="content">
				<div class="box">
					<div class="box-header with-border">
						<span class="box-title"><a href="<?php echo site_url('water_tank_cleaning_customers'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<h4>Personal &amp; Contact Details</h4>
							<?php if (isset($ObjCustomer) && !empty($ObjCustomer)): ?>
							<table class="table table-bordered">
								<tr>
									<th>Name</th>
									<td><?php echo $ObjCustomer->name; ?></td>
								</tr>
								<tr>
									<th>Address</th>
									<td><?php echo $ObjCustomer->address; ?></td>
								</tr>
								<tr>
									<th>Address</th>
									<td><?php echo $ObjCustomer->address; ?></td>
								</tr>
								<tr>
									<th>Contact </th>
									<td><?php echo $ObjCustomer->contact_no; ?></td>
								</tr>
								<tr>
									<th>Email </th>
									<td><?php echo !empty($ObjCustomer->email) ? $ObjCustomer->email : 'NA'; ?></td>
								</tr>
								<tr>
									<th>GSTIN </th>
									<td><?php echo !empty($ObjCustomer->gstin) ? $ObjCustomer->gstin : 'NA'; ?></td>
								</tr>
							</table>
							<?php endif ?>
							<h4>Water Tanks Details</h4>
							<?php if (isset($ArrCustTanks) && !empty($ArrCustTanks)): ?>
							<table class="table table-bordered">
								<tr>
									<th>Sr. No. </th>
									<th>Tank Type</th>
									<th>Capacity</th>
									<th>Quantity</th>
								</tr>
								<?php 
								$srno = 1;
								foreach ($ArrCustTanks as $trow): ?>
									<tr>
										<td><?php echo $srno++; ?></td>
										<td><?php echo $trow['tank_type']; ?></td>
										<td><?php echo $trow['tank_capacity']; ?></td>
										<td><?php echo $trow['tank_quantity']; ?></td>
									</tr>
								<?php endforeach ?>
							</table>
							<?php endif ?>
							<h4>AMC Details</h4>
							<?php if (isset($ArrCustTanks) && !empty($ArrCustTanks)): ?>
							<table class="table table-bordered">
								<tr>
									<th>Sr. No. </th>
									<th>AMC Date</th>
									<th>AMC Reminder Date</th>
									<th>Next AMC Date</th>
									<th>AMC Note</th>
								</tr>
								<?php 
								$srno = 1;
								foreach ($ArrCustAMCs as $arow): ?>
									<tr>
										<td><?php echo $srno++; ?></td>
										<td><?php echo $arow['amc_date']; ?></td>
										<td><?php echo $arow['amc_reminder_date']; ?></td>
										<td><?php echo $arow['next_amc_date']; ?></td>
										<td><?php echo $arow['amc_note']; ?></td>
									</tr>
								<?php endforeach ?>
							</table>
							<?php endif ?>
						</div>
					</div><hr>
					<div class="box-footer">
						<span class="box-title"><a href="<?php echo site_url('water_tank_cleaning_customers'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
			</section>
		</div>
			<?php $this->load->view('layout/footer'); ?>
	</div>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
</body>
</html>