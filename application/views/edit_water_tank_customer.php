<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Edit Water Tank Customer </title>
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
					Edit 
					<small>Water Tank Cleaning Customer </small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Edit Water Tank Cleaning Customer</li>
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
						<?php if (isset($ObjCustomer) && !empty($ObjCustomer)): ?>
							<?php echo form_open('save_water_tank_cleaning_customer/'.$ObjCustomer->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<?php endif ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="cust_name" name="cust_name" required="" onkeyup="this.value=this.value.replace(/[^A-Z a-z . ,]/g,'')" placeholder="Name" value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? $ObjCustomer->name : ''); ?>">
							</div>
							<label for="inputEmail3" class="col-sm-1 control-label">GSTIN</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="cust_gstin" name="cust_gstin"  placeholder="GSTIN" value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? $ObjCustomer->gstin : ''); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Contact No.</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="cust_contact" name="cust_contact" required="" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Contact No." value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? $ObjCustomer->contact_no : ''); ?>">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-4">
								<input type="email" class="form-control" id="cust_email" name="cust_email"  placeholder="Email" value="<?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? $ObjCustomer->email : ''); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Address</label>
							<div class="col-sm-10">
								<textarea rows="5" class="form-control" id="cust_address" name="cust_address" required="" placeholder="Address"><?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? $ObjCustomer->address : ''); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select Water Tank Type</label>
							<div class="col-sm-4">
								<select class="form-control" data-placeholder="Choose Tank Type" id="wtank_type">
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
										<input type="text" class="form-control" id="wtank_quantity" placeholder="Enter Quantity" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')">
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
									<?php 
										$tank_type = 1;
										$tank_capacity = 1;
										$itemqty = 1;
										$iditemqty = 1;
										if (isset($ArrItems) && !empty($ArrItems)) {
											foreach($ArrItems as $irow) {
									?>
									<tr>
										<td><input type="checkbox" class="case"></td>
										<td>
											<input type="text" class="form-control" name="tank_type_<?php echo $tank_type++; ?>" value="<?php echo $irow['tank_type']; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="tank_capacity_<?php echo $tank_capacity++; ?>" value="<?php echo $irow['tank_capacity']; ?>">
										</td>
										<td>
											<input type="text" class="totalrows form-control" id="itemqty_<?php echo $iditemqty++; ?>" name="tank_qty_<?php echo $itemqty++; ?>" value="<?php echo $irow['tank_quantity']; ?>">
										</td>
									</tr>
									<?php }} ?>
								</table>
								<button type="button" class="btn btn-danger delete btn-sm">- Remove</button>
							</div>
							<div class="box-footer">
								<div class="form-group">
									<div class=" col-sm-offset-2 col-sm-10">
										<input type="hidden" name="icnt" id="icnt" />
										<button type="reset" class="btn btn-default">Cancel</button>	
										<button type="submit" class="btn btn-primary save-btn"><?php echo (isset($ObjCustomer) && !empty($ObjCustomer) ? 'Update' : 'Add'); ?></button>	
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
				function getAmcDate(value) {
					var amc_date = value;
					var amc_type = $('#amc_type').val();
					if ((amc_date != '') && (amc_type != '')) {
						$.post({
							type : 'POST',
							url  : '<?php echo site_url('getAmcDate'); ?>',
							data : {amc_date:amc_date,amc_type:amc_type,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
							success:function(data) {
								var result = $.parseJSON(data);
								if (result){
									if (result.amc_type == 1) {
										$('#next_amc_date').val(result.next_amc_date);
										$('#amc_rem_date').val(result.amc_rem_date);
										$('#amc_type1').val(result.amc_type);
									} if (result.amc_type == 2) {
										$('#amc_date2').val(result.next_amc_date1);
										$('#next_amc_date1').val(result.next_amc_date1);
										$('#amc_rem_date1').val(result.amc_rem_date1);
										$('#next_amc_date2').val(result.next_amc_date2);
										$('#amc_rem_date2').val(result.amc_rem_date2);
										$('#amc_type2').val(result.amc_type);
									} if (result.amc_type == 3) {
										$('#amc_date4').val(result.next_amc_date1);
										$('#amc_date5').val(result.next_amc_date2);
										$('#next_amc_date2_1').val(result.next_amc_date1);
										$('#amc_rem_date2_1').val(result.amc_rem_date1);
										$('#next_amc_date2_2').val(result.next_amc_date2);
										$('#amc_rem_date2_2').val(result.amc_rem_date2);
										$('#next_amc_date2_3').val(result.next_amc_date3);
										$('#amc_rem_date2_3').val(result.amc_rem_date3);
										$('#amc_type3').val(result.amc_type);
									} if (result.amc_type == 4) {
										$('#amc_date7').val(result.next_amc_date1);
										$('#amc_date8').val(result.next_amc_date2);
										$('#amc_date9').val(result.next_amc_date3);
										$('#next_amc_date3_1').val(result.next_amc_date1);
										$('#amc_rem_date3_1').val(result.amc_rem_date1);
										$('#next_amc_date3_2').val(result.next_amc_date2);
										$('#amc_rem_date3_2').val(result.amc_rem_date2);
										$('#next_amc_date3_3').val(result.next_amc_date3);
										$('#amc_rem_date3_3').val(result.amc_rem_date3);
										$('#next_amc_date3_4').val(result.next_amc_date4);
										$('#amc_rem_date3_4').val(result.amc_rem_date4);
										$('#amc_type4').val(result.amc_type);
									}
								} 
							}
						});
					} else { $("#wtank").html(''); }
				}
				$(document).ready(function() {
					$('#amc_date,#amc_date1,#amc_date3,#amc_date6').datepicker({
						format: "dd-mm-yyyy",
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
						} else { $("#wtank").html(''); }
					});

					var i = <?php echo (isset($ArrItems) && !empty($ArrItems)) ? count($ArrItems)+1 : '1' ?>;
					$('#icnt').val(<?php echo (isset($ArrItems) && !empty($ArrItems)) ? count($ArrItems) : '0' ?>);
					$('.btn-add-row').on('click', function(){
						var row = '<tr><td><input type="checkbox" class="case"></td><td><input type="text" class="form-control" name="tank_type_'+i+'" value="'+$('#wtank_type option:selected').text()+'"></td><td><input type="text" class="form-control" name="tank_capacity_'+i+'" value="'+$('#wtank option:selected').text()+'"></td><td><input type="text" class="totalrows form-control" id="itemqty_'+i+'" name="tank_qty_'+i+'" value="'+$('#wtank_quantity').val()+'"></td></td></tr>';
						$('#tanks_info_table').append(row);
						i++;
						$('#icnt').val(i-1);
						$('#wtank_type,#wtank_quantity,#wtank').val('');
					});
			//to check all checkboxes
			$("#tanks_info_table").on("change", "#check_all", function () {
				$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
			});
			//deletes the selected table rows
			$(".delete").on("click", function () {
				var items = 0;
				$('.case:checkbox:checked').parents("tr").remove();
				$('#check_all').prop("checked", false);
				$('.totalrows').each(function(){
					items++;
				});
				$('#icnt').val(items);
			});

			$('.save-btn').on("click" , function () {
				if($('#icnt').val() == 0) {
					alert('Water Tanks Information cannot be blank. Please add Water Tanks Information.');
					return false;
				}
			});
		});
	</script>
</body>
</html>