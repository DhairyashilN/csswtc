<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | View Non Sujal Invoice</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="icon" href="<?php echo base_url();?>assets/icons/favicon.png">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="invoice-box">
					<div class="invoice-header text-center">
						<div class="invoice-header-top">
						<h5><b>TAX INVOICE</b></h5>
						<h3 style="margin-top:10px;"><b>SHREE CHINTAMANI SERVICES</b></h3>
						<h4 style="font-size:16px;"><b>Water Tank Cleaning Solutions</b></h4>
						</div>
						<div class="invoice-header-bottom">
						<h4 style="font-size:16px;">Rahatani, Pimpri, Pune – 411017.</h4>
						<h5>Contact: (+91) 9168096161 | Email : chintamani1937@gmail.com | Website : www.shreechintamaniservices.in</h5>
						<h5>GSTIN: 27ABCDE2292F1ZJ</h5>
						</div>
					</div>
					<!-- <div class="invoice-body">					
						<div class="table-responsive">
							<table class="table table-bordered" style="margin-bottom: 5px">
								<tr>
									<td colspan="2">
										To,<br>
										<?php echo $CustomerName->name; ?><br>
										<?php echo $CustomerName->address; ?>
									</td>
									<td colspan="2">
										<span>Invoice No.: <?php echo $ObjInvoice->id; ?></span><br>
										<span>Date : <?php echo $ObjInvoice->payment_date; ?></span>
									</td>
								</tr>
								<tr>
									<th>Sr. No.</th>
									<th>Item Details</th>
									<th>Quantity</th>
									<th>Amount</th>
								</tr>
								<tr>
									<td><?php echo '1'; ?></td>
									<td><?php echo $ProductName->name; ?></td>
									<td><?php echo $ObjInvoice->quantity; ?></td>
									<td><?php echo $ObjInvoice->total_amount; ?></td>
								</tr>
								<tr>
									<td colspan="3" class="text-right">Amount Before Tax</td>
									<td><?php echo $ObjInvoice->total_amount; ?></td>
								</tr>
								<tr>
									<td colspan="3" class="text-right">CGST 9%</td>
									<td><?php echo number_format((float)($ObjInvoice->tax_amount/2), 2, '.', ''); ?></td>
								</tr>
								<tr>
									<td colspan="3" class="text-right">SGST 9%</td>
									<td><?php echo number_format((float)($ObjInvoice->tax_amount/2), 2, '.', ''); ?></td>
								</tr>
								<tr>
									<td colspan="3" class="text-right">Amount After Tax</td>
									<td><?php echo $ObjInvoice->net_amount; ?></td>
								</tr>
							</table>
						</div>
						<p><?php echo 'Amount in words '. $In_words.'.'; ?></p>
						<div class="tc-box">
							<p>	Terms &amp; Conditions:</p>
							<p>1. Subject to Pune Jurisdiction.</p>
							<p>1. No warranty for electronic parts.</p>
						</div>
						<p class="text-right">	
							<b>For, Shree Chintamani Services<br><br><br>		
							Authorised Signatory</b> 		
						</p>
					</div> -->
				</div>
				<div class="text-center">
					<button class="btn btn-default print-btn" onclick="window.print();">Print</button>
				</div>			
			</div>			
		</div>
	</div>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>