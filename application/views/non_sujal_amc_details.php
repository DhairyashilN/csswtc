<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Non Sujal AMC Details</title>
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
					Other (Non Sujal)
					<small>AMC Details</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Other (Non Sujal) AMC Details</li>
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
							<span class="box-title"><a href="<?php echo site_url('non_sujals_amcs'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
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
												<a href="#" title="Edit" data-toggle="modal" data-target="#editAMC"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
												<div class="modal fade" id="editAMC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Edit AMC Details</h4>
															</div>
															<div class="modal-body">
																<form class="form-horizontal" method="POST" action="<?php echo site_url('save_amc_data/'.$row['id']) ?>">
																	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
																	<input type="hidden" name="amc_id" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc) ? $ObjAmc->id : '' ) ?>">
																	<div class="form-group">
																		<label for="inputEmail3" class="col-sm-2 control-label">AMC Date</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control" id="eamc_date" name="amc_date" placeholder="AMC Date" required="" value="<?php echo $row['amc_date'] ?>">
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
																			<textarea class="form-control" id="amc_note" name="amc_note" placeholder="AMC Notes" rows="7" required=""><?php echo $row['amc_note'] ?></textarea>
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
												<a href="" data-toggle="modal" data-target="#<?php echo $row['id'];?>" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
												<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-body text-center">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
																<br>
																<h3>Are you want to delete?</h3><br/>
																<a href="<?php echo site_url('remove_amc/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
																<button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
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
						<?php echo form_open('save_amc_data', array('method'=>'post','class'=>'form-horizontal')); ?>
						<input type="hidden" name="amc_id" value="<?php echo (isset($ObjAmc) && !empty($ObjAmc) ? $ObjAmc->id : '' ) ?>">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">AMC Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="amc_date" name="amc_date" placeholder="AMC Date" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Next AMC Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="next_amc_date" name="next_amc_date" placeholder="Next AMC Date" readonly="" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">AMC Reminder Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="amc_reminder_date" name="amc_reminder_date" placeholder="Next AMC Date" readonly="" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">AMC Notes</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="amc_note" name="amc_note" placeholder="AMC Notes" rows="7" required=""></textarea>
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
		$(document).ready(function(){
			$('#amc_date,#eamc_date').datepicker({
				format: "dd-mm-yyyy"
			});

			$('#amc_date').on('change', function() {
				var amc_date = $(this).val();
				if (amc_date != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('NonSujalAmcController/getNextAmcDates'); ?>',
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
			$('#eamc_date').on('change', function() {
				var amc_date = $(this).val();
				if (amc_date != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('NonSujalAmcController/getNextAmcDates'); ?>',
						data : {amc_date:amc_date,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								$('#enext_amc_date').val(result.amc_date);
								$('#eamc_reminder_date').val(result.amc_reminder_date);
							} 
						}
					});
				}
			});
		});
	</script>
</body>
</html>