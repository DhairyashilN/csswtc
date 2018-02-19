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
					Dashboard
					<small>Version 1.0</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>
			<section class="content">
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-aqua"><i class="fa fa-users" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total Customers</span>
								<span class="info-box-number">
									<h3>
										<?php 
										$Sujalcnt = $this->db->where('deleted',0)->from("sujal_customers")->count_all_results();
										$NonSujalcnt = $this->db->where('deleted',0)->from("non_sujal_customers")->count_all_results();
										echo $Sujalcnt + $NonSujalcnt;
										?>
									</h3>
								</span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('#') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-red"><i class="fa fa-users" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Sujal Customers</span>
								<span class="info-box-number"><h3><?php echo $this->db->where('deleted',0)->from("sujal_customers")->count_all_results(); ?></h3></span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('sujal_customers') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-green"><i class="fa fa-users" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Other (Non Sujal) Customers</span>
								<span class="info-box-number"><h3><?php echo $this->db->where('deleted',0)->from("non_sujal_customers")->count_all_results(); ?></h3></span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('non_sujal_customers') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total Enquiries</span>
								<span class="info-box-number"><h3>0</h3></span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('#') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-red"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Sujal AMC's</span>
								<span class="info-box-number"><h3><?php echo $this->db->where('deleted',0)->from("sujal_amc")->count_all_results(); ?></h3></span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('sujals_amcs') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-green"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Other (Non Sujal) AMC's</span>
								<span class="info-box-number"><h3><?php echo $this->db->where('deleted',0)->from("non_sujal_amcs")->count_all_results(); ?></h3></span>
							</div>
							<div class="info-box-footer">
								<a href="<?php echo site_url('non_sujals_amcs') ?>">View More <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>	
			</section>
		</div>
		<?php $this->load->view('layout/footer'); ?>
	</div><!-- /.wrapper -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
</body>
</html>