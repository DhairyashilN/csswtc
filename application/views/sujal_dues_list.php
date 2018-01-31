<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Sujal Due Payments</title>
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
					Sujal 
					<small> Due Payments</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Sujal Due Payments</li>
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
						<span class="box-title">Due Payments</span>
					</div>
					<div class="box-body">
						<!-- <pre><?php //print_r($ArrProducts); ?></pre> -->
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Customer Name</th>
										<th>Product</th>
										<th>Due Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$count = 1;
										if (isset($ArrDues) && !empty($ArrDues)) {
										foreach ($ArrDues as $row) {
									?>
									<tr>
										<td><?php echo $count++; ?></td>
										<td>
											<?php 
												if (isset($ArrCustomers) && !empty($ArrCustomers)) {
													foreach ($ArrCustomers as $crow) {
														if ($crow['id'] == $row['cust_id']) {
															echo $crow['name'];
														}
													}
												}	
											?>			
										</td>
										<td>
											<?php 
												if (isset($ArrProducts) && !empty($ArrProducts)) {
													foreach ($ArrProducts as $prow) {
														if ($prow['id'] == $row['product_id']) {
															echo $prow['name'];
														}
													}
												}	
											?>
										</td>
										<td><?php echo $row['due_amount']; ?></td>
										<td>
											<a href="#" data-toggle="modal" data-target="#view_<?php echo $row['id'];?>" title="View"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
						                    <div class="modal fade" id="view_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						                        <div class="modal-dialog" role="document">
						                        	<div class="modal-content">
						                        		<div class="modal-header">
						                        			<h4 class="modal-title">Sale Details</h4>
						                        		</div>
						                            	<div class="modal-body ">
						                              		<ul class="list-group">
																<li class="list-group-item"><b>Customer Name :</b> <?php echo $crow['name'] ?></li>
																<li class="list-group-item"><b>Product Name :</b> <?php echo $prow['name'] ?></li>
																<li class="list-group-item"><b>Due Amount :</b> <?php echo $row['due_amount'] ?></li>
															</ul>
						                            	</div>
						                            	<div class="modal-footer">
						                        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                        		</div>
						                          	</div>
						                        </div>
						                    </div>
						                    <a href="<?php echo site_url('pay_sujal_due_payment/'.$row['id']); ?>" title="Make Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-inr" aria-hidden="true"></i> Make Payment</button></a>
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