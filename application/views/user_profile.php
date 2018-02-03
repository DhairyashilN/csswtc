<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | User</title>
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
					User
					<small>Profile</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">User Profile</li>
				</ol>
			</section>
			<section class="message-box">
				<?php 
				if ($this->session->flashdata('success'))
					echo '<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>'.$this->session->flashdata('success').'</strong></div>';
				?>
			</section>
			<section class="content">
				<div class="box">
					<div class="box-header with-border">
					</div>
					<div class="box-body">
						<?php if (isset($ObjUser->id) && !empty($ObjUser->id)): ?>
							<?php echo form_open('save_user/'.$ObjUser->id, array('method'=>'post','class'=>'form-horizontal')); ?>
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">User Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="uname" name="uname" required="" placeholder="User Name" value="<?php echo (isset($ObjUser->username) && !empty($ObjUser->username)) ? $ObjUser->username : ''; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="upass" name="upass">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="cupass" name="cupass">
									<span id="err" style="color:red"></span>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="form-group">
								<div class=" col-sm-offset-2 col-sm-10">
									<button type="reset" class="btn btn-default">Cancel</button>	
									<button type="submit" class="btn btn-primary btn-submit">Update</button>	
								</div>
							</div>					
						</div>
						<?php form_close(); ?>
					<?php endif ?>
				</div>
			</section>
		</div>
		<?php $this->load->view('layout/footer'); ?>
	</div><!-- /.wrapper -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#cupass').on('blur', function() {
				if (($('#upass').val()) != ($('#cupass').val())) {
					$('#err').text('Password and confirm password does not match');
					$('.btn-submit').prop('disabled',true);
					return false;
				} else{
					$('#err').text('');
					$('.btn-submit').prop('disabled',false);
				}
			});
		});
	</script>
</body>
</html>