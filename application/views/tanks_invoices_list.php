<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Water Tanks Invoices</title>
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
					Water Tank Cleaning 
					<small>Invoices</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Water Tank Cleaning</li>
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
						<span class="box-title">Invoices <a href="<?php echo site_url('create_tanks_invoice'); ?>"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create New</button></a></span>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Invoice No.</th>
										<th>Invoice Date</th>
										<th>Customer Name</th>
										<th>Invoice Amount</th>
										<th>Payment Mode</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$count = 1;
										if (isset($ArrNSInvoices) && !empty($ArrNSInvoices)) {
										foreach ($ArrNSInvoices as $row) {
									?>
									<tr>
										<td><?php echo $count++; ?></td>
										<td><?php echo $row['invoice_no'];?></td>
										<td><?php echo $row['invoice_date']; ?></td>
										<td><?php echo $row['customer_name']; ?></td>
										<td><?php echo $row['invoice_net_amount']; ?></td>
										<td><?php echo $row['payment_mode']; ?></td>
										<td>
											<a href="<?php echo site_url('view_tanks_invoice/'.$row['id']); ?>" title="View" target="_blank"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
											<!-- <a href="<?php// echo site_url('generate_pdf/'.$row['id']); ?>" title="PDF" target="_blank"><button class="btn btn-info btn-sm"><i class="fa fa-pdf" aria-hidden="true"></i></button></a> -->
											<a href="<?php echo site_url('edit_tanks_invoice/'.$row['id']); ?>" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
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