<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Add Sujal Customer</title>
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
					<small>Add Customer</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Add Sujal Customer</li>
				</ol>
			</section>
			<section class="message-box">
				<?php if (validation_errors())
				echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
				?>
			</section>
			<section class="content">
				<div class="box">
					<div class="box-header with-border">
						<span class="box-title"><a href="<?php echo site_url('sujal_customers'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php if (isset($ObjCustomer->id) && !empty($ObjCustomer->id)): ?>
							<?php echo form_open('save_sujal_customer/'.$ObjCustomer->id, array('method'=>'post','class'=>'form-horizontal')); ?>
						<?php else: ?>
							<?php echo form_open('save_sujal_customer', array('method'=>'post','class'=>'form-horizontal')); ?>
						<?php endif ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="scust_name" name="scust_name" onkeyup="this.value=this.value.replace(/[^A-Z a-z,]/g,'')" placeholder="Name" value="<?php echo (isset($ObjCustomer->name) && !empty($ObjCustomer->name)) ? $ObjCustomer->name : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="scust_contact" name="scust_contact" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Contact No." value="<?php echo (isset($ObjCustomer->contact_no) && !empty($ObjCustomer->contact_no)) ? $ObjCustomer->contact_no : ''; ?>">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" id="scust_email" name="scust_email"  placeholder="Email" value="<?php echo (isset($ObjCustomer->email) && !empty($ObjCustomer->email)) ? $ObjCustomer->email : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10">
								<textarea rows="5" class="form-control" id="scust_address" name="scust_address" placeholder="Address"><?php echo (isset($ObjCustomer->address) && !empty($ObjCustomer->address)) ? $ObjCustomer->address : ''; ?></textarea>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class=" col-sm-offset-2 col-sm-10">
								<button type="reset" class="btn btn-default">Cancel</button>	
								<button type="submit" class="btn btn-primary"><?php echo (isset($ObjCustomer->id) && !empty($ObjCustomer->id)) ? 'Update' : 'Add'; ?></button>	
							</div>
						</div>					
					</div>
					<?php form_close(); ?>
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