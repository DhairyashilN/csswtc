<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($this->session->userdata('login')!=1){}else{redirect('dashboard');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?php echo base_url(); ?>"><b> Shree Chintamani Services</b> </a>
		</div>
		<div class="login-box-body">
			<?php if($this->session->flashdata('loginfail')){?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo $this->session->flashdata('loginfail');?>
			</div>
			<?php }?>
			<p class="login-box-msg">Sign in to start your session</p>
			<?php echo form_open('login', array('method'=>'post','class'=>'m-t')); ?>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Email" name="uname">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="upass">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
				</div>
			</div>
			<?php form_close();?>
			<a href="#">I forgot my password</a><br>
		</div>
	</div>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>