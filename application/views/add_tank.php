<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Add Water Tank </title>
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
					Add 
					<small>Water Tank</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Water Tank</li>
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
						<span class="box-title"><a href="<?php echo site_url('water_tanks'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php if (isset($ObjTank->id) && !empty($ObjTank->id)): ?>
							<?php echo form_open('save_water_tank_data/'.$ObjTank->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<?php else: ?>
							<?php echo form_open('save_water_tank_data', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<?php endif ?>
						<div class="form-group">
							<label for="inputName" class="col-sm-2 control-label">Water Tank Type</label>
							<div class="col-sm-10">
								<select class="form-control" name="tank_type" id="tank_type">
									<option value="">Select</option>
									<?php if (isset($ArrTankTypes) && !empty($ArrTankTypes)): ?>
										<?php foreach ($ArrTankTypes as $row): ?>
											<option value="<?php echo $row['id']; ?>" <?php if(isset($ObjTank->water_tank_type_id) && ($row['id'] == $ObjTank->water_tank_type_id)) { echo 'selected'; } ?>><?php echo $row['name']; ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputName" class="col-sm-2 control-label">Tank Capacity</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="tank_capacity" name="tank_capacity" required="" placeholder="Tank Capacity" value="<?php echo (isset($ObjTank) && !empty($ObjTank)) ? $ObjTank->capacity : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputName" class="col-sm-2 control-label">Tank Cleaning Charges</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="tank_cleaning_charges" name="tank_cleaning_charges" required="" placeholder="Tank Cleaning Charges" value="<?php echo (isset($ObjTank) && !empty($ObjTank)) ? $ObjTank->charges : ''; ?>">
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class=" col-sm-offset-2 col-sm-10">
								<button type="reset" class="btn btn-default">Cancel</button>	
								<button type="submit" class="btn btn-primary"><?php echo (isset($ObjTank->id) && !empty($ObjTank->id)) ? 'Update' : 'Add'; ?></button>	
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