<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Water Tanks AMC Details</title>
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
					Water Tank
					<small>AMC Details</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Water Tank AMC Details</li>
				</ol>
			</section>
			<section class="message-box">
				<?php if (validation_errors())
				echo '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
				if ($this->session->flashdata('success'))
					echo '<div class="alert alert-success alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>'.$this->session->flashdata('success').'</strong></div>';
				?>
			</section>
			<section class="content">
				<div class="box">
					<?php if (isset($ObjAmc) && !empty($ObjAmc) ) : ?>
						<div class="box-header with-border">
							<span class="box-title"><a href="<?php echo site_url('water_tank_cleaning_amcs'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
							<span class="box-title pull-right"><a href="#"><button class="btn btn-info" data-toggle="modal" data-target="#addAMC"><i class="fa fa-plus" aria-hidden="true"></i>Add AMC </button></a></span>
							<h4 class="text-center">Customer Name: <?= $ObjAmc->customer_name;?></h4>
						<?php endif; ?>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>Sr. No.</th>
									<th>AMC Date</th>
									<th>Next AMC Date</th>
									<th>AMC Reminder Date</th>
									<th>AMC Note</th>
									<th></th>
								</tr>
								<?php 
								$srcnt = 1;
								if (isset($ArrAmc) && !empty($ArrAmc)) :
									foreach ($ArrAmc as $row):
										?>
										<tr>
											<td><?php echo $srcnt++; ?></td>
											<td><?php echo $row['amc_date'] ?></td>
											<td><?php echo $row['next_amc_date'] ?></td>
											<td><?php echo $row['amc_reminder_date'] ?></td>
											<td><?php echo $row['amc_note'] ?></td>
											<td>
												<a href="#" title="Edit" data-toggle="modal" data-target="#editAMC_<?php echo $row['id']; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
												<div class="modal fade" id="editAMC_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Edit AMC Details</h4>
															</div>
															<div class="modal-body">
																<form class="form-horizontal" method="POST" autocomplete ="off" action="<?php echo site_url('save_tank_amcn/'.$row['id']) ?>">
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
																	<input type="hidden" name="amc_id" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc) ? $ObjAmc->id : '' ) ?>">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-2 control-label">AMC Date</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control" id="eamc_date" name="amc_date" placeholder="AMC Date" required="" value="<?php echo $row['amc_date'] ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group">
																		<label for="inputPassword3" class="col-sm-2 control-label">Next AMC Date</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control" id="enext_amc_date" name="next_amc_date" placeholder="Next AMC Date" readonly="" required="" value="<?php echo $row['next_amc_date'] ?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label for="inputPassword3" class="col-sm-2 control-label">AMC Reminder Date</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control" id="eamc_reminder_date" name="amc_reminder_date" placeholder="Next AMC Date" readonly="" required="" value="<?php echo $row['amc_reminder_date'] ?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label for="inputPassword3" class="col-sm-2 control-label">AMC Notes</label>
																		<div class="col-sm-10">
																			<textarea class="form-control" id="amc_notes" name="amc_notes" placeholder="AMC Notes" rows="7" required=""><?php echo $row['amc_note'] ?></textarea>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-offset-2 col-sm-10">
																			<button type="submit" class="btn btn-primary">Save</button>
																		</div>
																	</div>
																</form>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<?php
									endforeach;
								endif; 
								?>
							</table>
						</div>
					</div>
					<div class="box-footer">
					</div>
				</div>
			</section>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="addAMC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add AMC Details</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open('save_water_tank_amc_data', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<input type="hidden" name="amc_id" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc) ? $ObjAmc->id : '' ) ?>">
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select AMC Type</label>
							<div class="col-sm-4">
								<select class="form-control" id="amc_type" data-placeholder="Choose AMC Type">
									<option value="">Select</option>
									<option value="1">AMC1</option>
									<option value="2">AMC2</option>
									<option value="3">AMC3</option>
									<option value="4">AMC4</option>
								</select>
							</div>
						</div><hr>
						<div id="date_block_1" style="display:none;">	
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date" onchange="getAmcDate(this.value);" name="amc_date_1" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date" name="next_amc_date_1" placeholder="Next AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date" name="amc_rem_date_1" placeholder="AMC Reminder Date">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note" name="amc_note_1" rows="3" placeholder="AMC Note"></textarea>
									<input type="hidden" name="amc_type1" id="amc_type1">
								</div>
							</div>
						</div>
						<div id="date_block_2" style="display:none;">
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 1</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date1" name="amc_date1_1" onchange="getAmcDate(this.value);" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date1" name="next_amc_date1_1" placeholder="Next AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date1" name="amc_rem_date1_1" placeholder="AMC Reminder Date">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 1 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note1_1" name="amc_note1_1" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 2</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date2" name="amc_date1_2" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date2" name="next_amc_date1_2" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date2" name="amc_rem_date1_2">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 2 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note1_2" name="amc_note1_2" rows="3" placeholder="AMC Note"></textarea>
									<input type="hidden" name="amc_type2" id="amc_type2">
								</div>
							</div>
						</div>
						<div id="date_block_3" style="display:none;">
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 1</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date3" name="amc_date2_1" onchange="getAmcDate(this.value);" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date2_1" name="next_amc_date2_1" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date2_1" name="amc_rem_date2_1" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 1 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note2_1" name="amc_note2_1" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">	
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 2</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date4" name="amc_date2_2" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date2_2" name="next_amc_date2_2" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date2_2" name="amc_rem_date2_2" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 2 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note2_2" name="amc_note2_2" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 3</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date5" name="amc_date2_3" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date2_3" name="next_amc_date2_3" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date2_3" name="amc_rem_date2_3">
									<input type="hidden" name="amc_type3" id="amc_type3">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 3 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note2_3" name="amc_note2_3" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div>
						</div>
						<div id="date_block_4" style="display:none;">
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 1</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date6" name="amc_date3_1" onchange="getAmcDate(this.value);" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date3_1" name="next_amc_date3_1" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date3_1" name="amc_rem_date3_1">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 1 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note3_1" name="amc_note3_1" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 2</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date7" name="amc_date3_2" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date3_2" name="next_amc_date3_2" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date3_2" name="amc_rem_date3_2">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 2 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note3_2" name="amc_note3_2" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 3</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date8" name="amc_date3_3" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date3_3" name="next_amc_date3_3" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date3_3" name="amc_rem_date3_3">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 3 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note3_3" name="amc_note3_3" rows="3" placeholder="AMC Note"></textarea>
								</div>
							</div><hr>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Date 4</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_date9" name="amc_date3_4" placeholder="Enter AMC Date">
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">Next AMC Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="next_amc_date3_4" name="next_amc_date3_4" >
								</div>
								<label for="inputCustomers" class="col-sm-2 control-label">AMC Reminder Date</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="amc_rem_date3_4" name="amc_rem_date3_4">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">AMC 4 Note</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="amc_note3_4" name="amc_note3_4" rows="3" placeholder="AMC Note"></textarea>
									<input type="hidden" name="amc_type4" id="amc_type4">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>
						<?php form_close(); ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('layout/footer'); ?>
	</div><!-- /.wrapper -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
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
		$(document).ready(function(){
			$('#amc_date,#amc_date1,#amc_date3,#amc_date6').datepicker({
				format: "dd-mm-yyyy"
			});

			$('#amc_date').on('change', function() {
				var amc_date = $(this).val();
				if (amc_date != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('SujalAmcController/getNextAmcDates'); ?>',
						data : {amc_date:amc_date,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								$('#next_amc_date').val(result.amc_date);
								$('#amc_reminder_date').val(result.amc_reminder_date);
							} 
						}
					});
				}
			});
			$('#amc_type').on('change', function() {
				if ($('#amc_type').val() != '') {
					if($('#amc_type').val() == 1) {
						$('#date_block_1').css('display','block');
						$('#date_block_2,#date_block_3,#date_block_4').css('display','none');
						$('#amc_date1,#amc_date2,#amc_date3,#amc_date4,#amc_date5,#amc_date6,#amc_date7,#amc_date8,#amc_date9, #amc_type2, #amc_type3, #amc_type4, #next_amc_date1, #next_amc_date2, #amc_rem_date1, #amc_rem_date2, #next_amc_date2_1, #amc_rem_date2_1, #next_amc_date2_2, #amc_rem_date2_2, #next_amc_date2_3, #amc_rem_date2_3, #next_amc_date3_1, #next_amc_date3_2, #next_amc_date3_3, #next_amc_date3_4, #amc_rem_date3_1, #amc_rem_date3_2, #amc_rem_date3_3, #amc_rem_date3_4,#amc_note1_1, #amc_note1_2, #amc_note2_1, #amc_note2_2,#amc_note2_3, #amc_note3_1, #amc_note3_2, #amc_note3_3, #amc_note3_4').val('');
					} if ($('#amc_type').val() == 2) {
						$('#date_block_2').css('display','block');
						$('#date_block_1,#date_block_3,#date_block_4').css('display','none');
						$('#amc_date, #amc_date3, #amc_date4, #amc_date5, #amc_date6, #amc_date7, #amc_date8, #amc_date9, #next_amc_date, #amc_rem_date, #amc_type1, #amc_type3, #amc_type4, #next_amc_date2_1, #amc_rem_date2_1, #next_amc_date2_2, #amc_rem_date2_2, #next_amc_date2_3, #amc_rem_date2_3, #next_amc_date3_1, #next_amc_date3_2, #next_amc_date3_3, #next_amc_date3_4, #amc_rem_date3_1, #amc_rem_date3_2, #amc_rem_date3_3, #amc_rem_date3_4, #amc_note, #amc_note2_1, #amc_note2_2,#amc_note2_3, #amc_note3_1, #amc_note3_2, #amc_note3_3, #amc_note3_4').val('');
					} if ($('#amc_type').val() == 3) {
						$('#date_block_3').css('display','block');
						$('#date_block_1,#date_block_2,#date_block_4').css('display','none');
						$('#amc_date, #amc_date1, #amc_date2, #amc_date6, #amc_date7, #amc_date8, #amc_date9, #amc_type1, #amc_type2, #amc_type4, #next_amc_date, #amc_rem_date, #next_amc_date1, #next_amc_date2, #amc_rem_date1, #amc_rem_date2, #next_amc_date3_1, #next_amc_date3_2, #next_amc_date3_3, #next_amc_date3_4, #amc_rem_date3_1, #amc_rem_date3_2, #amc_rem_date3_3, #amc_rem_date3_4,#amc_note,#amc_note1_1,#amc_note1_2, #amc_note2_1, #amc_note2_2, #amc_note2_3, #amc_note3_1, #amc_note3_2, #amc_note3_3, #amc_note3_4').val('');
					} if ($('#amc_type').val() == 4) {
						$('#date_block_4').css('display','block');
						$('#date_block_1,#date_block_2,#date_block_3').css('display','none');
						$('#amc_date,#amc_date1,#amc_date2,#amc_date3,#amc_date4,#amc_date5, #amc_type1, #amc_type2, #amc_type3, #next_amc_date, #amc_rem_date, #next_amc_date1, #next_amc_date2, #amc_rem_date1, #amc_rem_date2, #next_amc_date2_1, #amc_rem_date2_1, #next_amc_date2_2, #amc_rem_date2_2, #next_amc_date2_3, #amc_rem_date2_3, #amc_note, #amc_note1_1, #amc_note1_2, #amc_note2_1, #amc_note2_2, #amc_note2_3').val('');
					}
				} else {
					$('#date_block_1,#date_block_2,#date_block_3,#date_block_4').css('display','none');
				}
			});
		});
	</script>
</body>
</html>