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
							<h5><?php echo isset($ObjInvoice->invoice_tax_rate) && ($ObjInvoice->invoice_tax_rate!=0) ? 'TAX INVOICE' : ''; ?></h5>
							<h3 style="margin-top:10px;"><b>SHREE CHINTAMANI SERVICES</b></h3>
							<h4 style="font-size:16px;"><b>Water Tank Cleaning Solutions</b></h4>
						</div>
						<div class="invoice-header-bottom">
							<h4 style="font-size:16px;">Rahatani, Pune – 411017.</h4>
							<h5>Contact: (+91) 9168096161 | Email : chintamani1937@gmail.com | Website : www.shreechintamaniservices.in</h5>
							<h5>GSTIN: 27ABCDE2292F1ZJ</h5>
						</div>
					</div>
					<div class="invoice-body">					
						<div class="table-responsive">
							<table class="table table-bordered table-customer-info">
								<tr>
									<td colspan="2">
										<b>To,</b><br>
										<?php echo $ObjInvoice->customer_name; ?><br>
										<?php echo $ObjInvoice->address; ?><br>
										<?php echo 'Contact : '.$ObjInvoice->contact_no; ?><br>
										<?php echo 'GSTIN : '.$ObjInvoice->customer_gstin; ?>
									</td>
									<td colspan="2">
										<p><b>Bill No. :</b><?php echo $ObjInvoice->invoice_no; ?></p>
										<p><b>Date :</b> <?php echo $ObjInvoice->invoice_date; ?></p>
									</td>
								</tr>
							</table>
							<table class="table table-bordered table-item-info" style="margin-bottom: 5px">
								<tr>
									<th style="width: 9%;" class="text-center">Sr. No.</th>
									<th class="text-center">Item Details</th>
									<th style="width: 10%;" class="text-center">Quantity</th>
									<th class="text-center">Rate</th>
									<th class="text-center">Amount</th>
								</tr>
								<?php
								 	$src = 1;
									if (isset($ArrInvoiceItems) && !empty($ArrInvoiceItems)) {
									foreach ($ArrInvoiceItems as $irow) {
								?>
								<tr>
									<td class="text-center"><?php echo $src++; ?></td>
									<td><?php echo $irow['item_desc']; ?></td>
									<td class="text-right"><?php echo $irow['item_quantity']; ?></td>
									<td class="text-right"><?php echo $irow['item_rate']; ?></td>
									<td class="text-right"><?php echo $irow['item_amount']; ?></td>
								</tr>
								<?php }} ?>
								<?php 
									if ((isset($ObjInvoice)) && ($ObjInvoice->invoice_tax_rate != 0)) {
								?>
								<tr class="text-right">
									<td colspan="4" class="text-right"><b>Total</b></td>
									<td><b><?php echo $ObjInvoice->invoice_amount; ?></b></td>
								</tr>
								<tr class="text-right">
									<td colspan="4" class="text-right"><b>CGST <?php echo $ObjInvoice->invoice_tax_rate/2 ?>%</b></td>
									<td><b><?php echo number_format((float)($ObjInvoice->invoice_tax_amount/2), 2, '.', ''); ?></b></td>
								</tr>
								<tr class="text-right">
									<td colspan="4" class="text-right"><b>SGST <?php echo $ObjInvoice->invoice_tax_rate/2 ?>%</b></td>
									<td><b><?php echo number_format((float)($ObjInvoice->invoice_tax_amount/2), 2, '.', ''); ?></b></td>
								</tr>
								<tr class="text-right">
									<td colspan="4" class="text-right"><b>Gross Total</b></td>
									<td><b><?php echo $ObjInvoice->invoice_net_amount; ?></b></td>
								</tr> 	
								<?php } else { ?>
								<tr class="text-right">
									<td colspan="4" class="text-right"><b>Gross Total</b></td>
									<td><b><?php echo $ObjInvoice->invoice_net_amount; ?></b></td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="5"><?php echo '<b>Amount in words</b> '. $Amount_in_words.'.'; ?></td>
								</tr>
								<tr class="text-right">
									<td colspan="5">
										<br>
										<b>Shree Chintamani Services<br><br><br>Proprieter</b>
										<br><br><br><br><br><br><br>
									</td>
								</tr>
							</table>
						</div>
						<!-- <div class="tc-box">
							<p>	Terms &amp; Conditions:</p>
							<p>1. Subject to Pune Jurisdiction.</p>
							<p>1. No warranty for electronic parts.</p>
						</div> -->
					</div>
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