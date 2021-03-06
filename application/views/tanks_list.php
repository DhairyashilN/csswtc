<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Water Tanks</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?php echo base_url();?>assets/icons/favicon.png">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('layout/header'); ?>
		<?php $this->load->view('layout/sidebar'); ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Water Tanks
					<small>List</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Water Tank List</li>
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
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<span class="box-title"><a href="<?php echo site_url('add_water_tank'); ?>"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button></a></span>
					</div>
					<div class="box-body">
						<!-- <pre><?php //print_r($ArrProducts); ?></pre> -->
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Tank Type</th>
										<th>Tank Capacity</th>
										<th>Tank Cleaning Charges</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$count = 1;
										if (isset($ArrTanks) && !empty($ArrTanks)) {
										foreach ($ArrTanks as $row) {
									?>
									<tr>
										<td><?php echo $count++; ?></td>
										<td>
											<?php if (isset($ArrTankTypes) && !empty($ArrTankTypes) ): ?>
												<?php foreach ($ArrTankTypes as $trow): ?>
													<?php if ($trow['id'] == $row['water_tank_type_id']): ?>
														<?php echo $trow['name']; ?>
													<?php endif ?>
												<?php endforeach ?>
											<?php endif ?>		
										</td>
										<td><?php echo $row['capacity'];?></td>
										<td><?php echo $row['charges'];?></td>
										<td>
											<a href="<?php echo site_url('edit_water_tank/'.$row['id']); ?>" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
											<a href="" data-toggle="modal" data-target="#<?php echo $row['id'];?>" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
											<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						                        <div class="modal-dialog" role="document">
						                        	<div class="modal-content">
						                            	<div class="modal-body text-center">
						                              		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
						                              		<br>
						                              		<h3>Are you want to delete?</h3><br/>
						                              		<a href="<?php echo site_url('delete_water_tank/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
						                              		<button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
						                            	</div>
						                          	</div>
						                        </div>
						                    </div>
										</td>
									</tr>
									<?php }} ?>
								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					</div>
					<!-- /.box-footer-->
				</div>
				<!-- /.box -->	
			</section>
		</div>
		<?php $this->load->view('layout/footer'); ?>
	</div><!-- /.wrapper -->
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/adminlte.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
		$(function () {
			$('#example1').DataTable()
			$('#example2').DataTable({
				'paging'      : true,
				'lengthChange': false,
				'searching'   : false,
				'ordering'    : true,
				'info'        : true,
				'autoWidth'   : true
			})
		})
	</script>
</body>
</html>