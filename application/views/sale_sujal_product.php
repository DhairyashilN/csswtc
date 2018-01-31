<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Sale Sujal Product</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link href="<?php echo base_url();?>assets/plugins/chosen/docsupport/prism.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/chosen/chosen.css" rel="stylesheet">
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
					<small>Sale Product</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Sale Sujal Product</li>
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
						<span class="box-title"><a href="<?php echo site_url('sale_product'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php if (isset($ObjProduct->id) && !empty($ObjProduct->id)): ?>
							<?php echo form_open('save_sujal_product_sale/'.$ObjProduct->id, array('method'=>'post','class'=>'form-horizontal')); ?>
						<?php else: ?>
							<?php echo form_open('save_sujal_product_sale', array('method'=>'post','class'=>'form-horizontal')); ?>
						<?php endif ?>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select Customer</label>
							<div class="col-sm-10">
								<select class="form-control chosen-select" data-placeholder="Choose Customer" name="customer" id="customer">
									<option value="">Select Customer </option>
									<?php 
										if (isset($ArrCustomers) && !empty($ArrCustomers)) {
											foreach ($ArrCustomers as $crow) {
									?>
										<option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
									<?php }	} ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select Product</label>
							<div class="col-sm-10">
								<select class="form-control chosen-select" data-placeholder="Choose Product" name="product" id="product">
									<option value="">Select Product </option>
									<?php 
										if (isset($ArrProducts) && !empty($ArrProducts)) {
											foreach ($ArrProducts as $crow) {
									?>
										<option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
									<?php }	} ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Product Price</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="sproduct_price" name="sproduct_price" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Price" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="sproduct_quantity" name="sproduct_quantity" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Quantity" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="total_amount" name="total_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Paid</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="paid_amount" name="paid_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount Paid">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Paid Date</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="amount_paid_date" name="amount_paid_date" value="<?php echo (isset($ObjProduct->payment_date) && !empty($ObjProduct->payment_date)) ? $ObjProduct->payment_date : ''; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">GST %</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="gst_rate" name="gst_rate" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="GST Rate" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">GST Amount</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="gst_amount" name="gst_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="GST Amount" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Net Amount</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="net_amount" name="net_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount" value="<?php echo (isset($ObjProduct->total_amount) && !empty($ObjProduct->total_amount)) ? round($ObjProduct->total_amount, 2) : ''; ?>">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Amount Due</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="due_amount" name="due_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount Due" value="<?php echo (isset($ObjProduct->due_amount) && !empty($ObjProduct->due_amount)) ? round($ObjProduct->due_amount, 2) : ''; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Installation Date</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="install_date" name="install_date">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Next AMC Date</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="amc_date" name="amc_date" readonly="">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">AMC  Reminder Date</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="amc_reminder_date" name="amc_reminder_date" readonly="">
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class=" col-sm-offset-2 col-sm-10">
								<button type="reset" class="btn btn-default">Cancel</button>	
								<button type="submit" class="btn btn-primary"><?php echo (isset($ObjProduct->id) && !empty($ObjProduct->id)) ? 'Update' : 'Add'; ?></button>	
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
			var config = {
				'.chosen-select'           : {},
				'.chosen-select-deselect'  : {allow_single_deselect:true},
				'.chosen-select-no-single' : {disable_search_threshold:10},
				'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
				'.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
				$(selector).chosen(config[selector]);
			}

			$('#product').on('change', function() {
				var product = $('#product').val();
				if (product != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('SujalProductsController/getProductPrice'); ?>',
						data : {product:product,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								result = parseFloat(result);
								$('#sproduct_price').val(result.toFixed(0));
							} 
						}
					});
				}
			});
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
				// startDate: "+0d"
			});

			$('#install_date').on('change', function() {
				var install_date = $('#install_date').val();
				if (install_date != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('SujalProductsController/getAmcDate'); ?>',
						data : {install_date:install_date,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								$('#amc_date').val(result.amc_date);
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