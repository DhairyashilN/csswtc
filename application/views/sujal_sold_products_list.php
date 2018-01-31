<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Sujal Sold Products</title>
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
					<small> Sold Products</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Sujal Sold Products</li>
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
						<span class="box-title">Sold Products <a href="<?php echo site_url('sale_new_sujal_product'); ?>"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Sale New Product</button></a></span>
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
										<th>Sale (Payment) Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$count = 1;
										if (isset($ArrInvoices) && !empty($ArrInvoices)) {
										foreach ($ArrInvoices as $row) {
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
										<td><?php echo $row['payment_date']; ?></td>
										<td>
											<a href="#" data-toggle="modal" data-target="#view_<?php echo $row['id'];?>" title="View"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
											<!-- <a href="<?php //echo site_url('edit_sujal_product_sale/'.$row['id']); ?>" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button></a> -->
											<a href="" data-toggle="modal" data-target="#<?php echo $row['id'];?>" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
											<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						                        <div class="modal-dialog" role="document">
						                        	<div class="modal-content">
						                            	<div class="modal-body text-center">
						                              		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
						                              		<br>
						                              		<h3>Are you want to delete?</h3><br/>
						                              		<a href="<?php echo site_url('delete_sujal_product/'.$row['id']);?>"><button type="button" class="btn btn-danger" >Yes</button></a>&nbsp;&nbsp;
						                              		<button type="button" class="btn btn-warning" data-dismiss="modal">No</button> 
						                            	</div>
						                          	</div>
						                        </div>
						                    </div>
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
																<li class="list-group-item"><b>Payment Date :</b> <?php echo $row['payment_date'] ?></li>
															</ul>
						                            	</div>
						                            	<div class="modal-footer">
						                        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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