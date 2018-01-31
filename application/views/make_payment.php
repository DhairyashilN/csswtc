<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Pay Due Payment</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link href="<?php echo base_url();?>assets/plugins/chosen/docsupport/prism.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker.css" rel="stylesheet">
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
					<small>Pay Due Payment</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Pay Due Payment</li>
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
						<span class="box-title"><a href="<?php echo site_url('sujal_dues_payments'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php echo form_open('save_payment', array('method'=>'post','class'=>'form-horizontal')); ?>
						<input type="hidden" name="due_id" value="<?php echo $ObjDue->id; ?>">
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Customer Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer)) ? $ObjCustomer->name :'' ?>" required="">
								<input type="hidden" class="form-control" name="cname" id="cname" value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer)) ? $ObjCustomer->id :'' ?>" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Product</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo (isset($ObjCustomer) && !empty($ObjProduct)) ? $ObjProduct->name :'' ?>" required="">
								<input type="hidden" class="form-control" name="pname" id="pname" value="<?php echo (isset($ObjProduct) && !empty($ObjProduct)) ? $ObjCustomer->id :'' ?>" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="sproduct_quantity" name="sproduct_quantity" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Quantity" value="<?php echo (isset($ObjDue) && !empty($ObjDue)) ? $ObjDue->quantity : '' ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Due Amount</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="total_amount" name="total_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount" value="<?php echo (isset($ObjDue) && !empty($ObjDue)) ? round($ObjDue->due_amount,2) : '' ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Paid</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="paid_amount" name="paid_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount Paid">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Paid Date</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="amount_paid_date" name="amount_paid_date" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">GST %</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="gst_rate" name="gst_rate" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="GST Rate">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">GST Amount</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="gst_amount" name="gst_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="GST Amount">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Net Amount</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="net_amount" name="net_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Due</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="due_amount" name="due_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount Due" readonly>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class=" col-sm-offset-2 col-sm-10">
								<button type="reset" class="btn btn-default">Cancel</button>	
								<button type="submit" class="btn btn-primary">Add</button>	
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
	<script src="<?php echo base_url();?>assets/plugins/chosen/chosen.jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url();?>assets/plugins/datepicker/datepicker.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#sproduct_quantity').on('keyup', function() {
				var product_price = $('#sproduct_price').val();
				$('#total_amount').val(product_price * $('#sproduct_quantity').val());
			});
			$('#gst_rate').on('keyup', function() {
				var paid_amount = $('#paid_amount').val();
				$('#gst_amount').val((paid_amount * $('#gst_rate').val()) / 100);
				$('#net_amount').val(parseInt($('#gst_amount').val()) + parseInt($('#paid_amount').val()));
			});
			$('#paid_amount').on('keyup', function() {
				var total_amount = $('#total_amount').val();
				$('#due_amount').val(total_amount - $('#paid_amount').val());
			});

			$('#amount_paid_date,#install_date').datepicker({
				format: "dd-mm-yyyy",
				startDate: "+0d"
			});
		});
	</script>
</body>
</html>