<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Add Sujal Product</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link rel="icon" href="<?php echo base_url();?>assets/icons/favicon.png">
    <link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker.css" rel="stylesheet">
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
					<li class="active">Sujal Products</li>
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
						<span class="box-title"><a href="<?php echo site_url('sujal_amcs'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php if (isset($ObjAmc->id) && !empty($ObjAmc->id)): ?>
							<?php echo form_open('save_sujal_amc/'.$ObjAmc->id, array('method'=>'post','class'=>'form-horizontal')); ?>
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Customer Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php echo (isset($CustomerName) && !empty($CustomerName)) ? $CustomerName->name : ''; ?>" readonly>
									<input type="hidden" class="form-control" id="cname" name="cname" Name" value="<?php echo (isset($ObjAmc->cust_id) && !empty($ObjAmc->cust_id)) ? $ObjAmc->cust_id : ''; ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php echo (isset($ProductName) && !empty($ProductName)) ? $ProductName->name : ''; ?>" readonly>
									<input type="hidden" id="pname" name="pname" value="<?php echo (isset($ObjAmc->product_id) && !empty($ObjAmc->product_id)) ? $ObjAmc->product_id : ''; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Installation Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" readonly="" id="install_date" name="install_date" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc)) ? $ObjAmc->installation_date : ''; ?>" >
								</div>
								<label for="inputEmail3" class="col-sm-2 control-label">AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date" name="amc_date" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc)) ? $ObjAmc->amc_date : ''; ?>" readonly>
								</div>
								<label for="inputEmail3" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_reminder_date" name="amc_reminder_date" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc)) ? $ObjAmc->amc_reminder_date : ''; ?>" readonly>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<div class="form-group">
								<div class=" col-sm-offset-2 col-sm-10">
									<button type="reset" class="btn btn-default">Cancel</button>	
									<button type="submit" class="btn btn-primary"><?php echo (isset($ObjAmc->id) && !empty($ObjAmc->id)) ? 'Update' : 'Add'; ?></button>	
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
	<script src="<?php echo base_url();?>assets/plugins/datepicker/datepicker.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#amc_date').datepicker({
				format: "dd-mm-yyyy"
			});

			$('#amc_date').on('change', function() {
				var amc_date = $('#amc_date').val();
				if (amc_date != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('SujalAmcController/getAmcRemDate'); ?>',
						data : {amc_date:amc_date,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								// $('#amc_date').val(result.amc_date);
								$('#amc_reminder_date').val(result.amc_reminder_date);
							} 
						}
					});
				}
			});
		});
	</script>
</body>
</html>