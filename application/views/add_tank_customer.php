<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Add Water Tank Customer </title>
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
					Add 
					<small>Water Tank Cleaning Customer </small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Add Water Tank Cleaning Customer</li>
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
						<span class="box-title"><a href="<?php echo site_url('water_tank_cleaning_customers'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php if (isset($ObjType->id) && !empty($ObjType->id)): ?>
							<?php echo form_open('save_water_tank_cleaning_customer/'.$ObjType->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<?php else: ?>
							<?php echo form_open('save_water_tank_cleaning_customer', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<?php endif ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="cust_name" name="scust_name" required="" onkeyup="this.value=this.value.replace(/[^A-Z a-z . ,]/g,'')" placeholder="Name" value="">
							</div>
							<label for="inputEmail3" class="col-sm-1 control-label">GSTIN</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="cust_gstin" name="scust_gstin"  placeholder="GSTIN" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="cust_contact" name="scust_contact" required="" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Contact No." value="">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" id="cust_email" name="scust_email"  placeholder="Email" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10">
								<textarea rows="5" class="form-control" id="scust_address" name="scust_address" required="" placeholder="Address"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select Water Tank Type</label>
							<div class="col-sm-4">
								<select class="form-control chosen-select" data-placeholder="Choose Product" id="wtank_type">
									<option value="">Select Type </option>
									<?php if (isset($ArrTankTypes) && !empty($ArrTankTypes)) {
										foreach ($ArrTankTypes as $trow) {
									?>
									<option value="<?php echo $trow['id']; ?>"><?php echo $trow['name']; ?></option>
									<?php }	} ?>
								</select>
							</div>
							<label for="inputCustomers" class="col-sm-2 control-label">Select Water Tank</label>
							<div class="col-sm-4">
								<select class="form-control" data-placeholder="Choose Water " id="wtank">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Quantity</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="wtank_quantity" placeholder="Enter Quantity">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-2">
								<button type="button" class="btn btn-primary btn-add-row">Add Item</button>
							</div>
						</div>
						<hr>
						<h4>Water Tanks Information </h4>
						<hr>
						<table class="table table-bordered" id="tanks_info_table">
							<tr>
								<th><input id="check_all" type="checkbox"></th>
								<!-- <th style="width: 6%;">Sr.No</th> -->
								<th>Tank Type</th>
								<th>Capacity</th>
								<th style="width: 10%;">Quantity</th>
							</tr>
						</table>
						<button type="button" class="btn btn-danger delete btn-sm">- Remove</button>
						<hr>
						<h4>AMC Information </h4>
						<hr>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select AMC Type</label>
							<div class="col-sm-4">
								<select class="form-control chosen-select" data-placeholder="Choose AMC Type">
									<option value="">Select</option>
									<option value="1">AMC1</option>
									<option value="2">AMC2</option>
									<option value="3">AMC3</option>
									<option value="4">AMC4</option>
								</select>
							</div>
							<label for="inputCustomers" class="col-sm-2 control-label">AMC Date</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="amc_date" id="amc_date">
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
			$('#amc_date').datepicker({
				format: "dd-mm-yyyy",
				// startDate: "+0d"
			});
			$('#wtank_type').on('change', function() {
				var tank_type = $('#wtank_type').val();
				if (tank_type != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('getTankbyType'); ?>',
						data : {tank_type:tank_type,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								var options = "";
							    for (var i = 0; i < result.length; i++) {
							        options +="<option value="+result[i].id+">"+result[i].capacity+"</option>";
							    }
							    $("#wtank").html(options);
							} 
						}
					});
				}
			});

			var i = 1;
			$('.btn-add-row').on('click', function(){
				var row = '<tr><td><input type="checkbox" class="case"></td><td><input type="text" class="form-control" name="tank_type_'+i+'" value="'+$('#wtank_type option:selected').text()+'"></td><td><input type="text" class="itemrate form-control" name="tank_capacity_'+i+'" value="'+$('#wtank option:selected').text()+'"></td><td><input type="text" class=" itemrate form-control" id="itemqty_'+i+'" name="item_qty_'+i+'" value="'+$('#wtank_quantity').val()+'"></td></td></tr>';
				$('#tanks_info_table').append(row);
				i++;
				// $('#icnt').val(i-1);
				$('#wtank_type,#wtank_quantity,#wtank').val('');
			});
		});
	</script>
</body>
</html>