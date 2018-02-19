<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Edit Non Sujal Invoice</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?php echo base_url();?>assets/icons/favicon.png">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.css">
	<link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker.css" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view('layout/header'); ?>
		<?php $this->load->view('layout/sidebar'); ?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Create Other (Non Sujal) 
					<small>Invoice</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Create Other (Non Sujal) Invoices</li>
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
						<span class="box-title"><a href="<?php echo site_url('non_sujal_invoices'); ?>"><button class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php echo form_open('save_sujal_invoice/'.$ObjInvoice->id, array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<div class="form-group">
							<label class="control-label col-lg-1"> To </label>
							<div class="col-lg-3">
							 	<input type="hidden" class="form-control" name="customer_name" id="customer_name" required="" value="<?php echo $ObjInvoice->sujal_cust_id ?>">
							 	<input type="text" name="cust_name" class="form-control" id="cust_name" readonly="" value="<?php echo $ObjInvoice->customer_name; ?>">
							 </div>
							 <label class="control-label col-lg-2">Invoice No.</label>
							 <div class="col-lg-2">
							 	<input type="text" name="invoice_no" id="invoice_no" class="form-control" value="<?php echo $ObjInvoice->invoice_no; ?>" required="" readonly>
							 </div>
							 <label class="control-label col-lg-2">Invoice Date</label>
							 <div class="col-lg-2">
							 	<input type="text" name="invoice_date" id="invoice_date" class="form-control" value="<?php echo $ObjInvoice->invoice_date; ?>" required="">
							 </div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-2">Address</label>
							<div class="col-lg-4">
								<textarea class="form-control" name="caddress" id="cadress" rows="5" required=""><?php echo $ObjInvoice->address; ?></textarea>
							</div>
							<label class="control-label col-lg-2">Mobile No.</label>
							<div class="col-lg-4">
							 	<input type="text" name="mobile_no" id="mobile_no" value="<?php echo $ObjInvoice->contact_no; ?>" class="form-control" required="">
							 	<br>
							 </div><br>
							 <label class="control-label col-lg-2">GSTIN</label>
							 <div class="col-lg-4">
							 	<input type="text" name="cgstin" id="cgstin" class="form-control" value="<?php $ObjInvoice->customer_gstin; ?>">
							 </div>
						</div>
						<h4>Invoice Items</h4>
						<hr>
						<table class="table table-bordered" id="invoice_items_table">
							<tr>
								<th><input id="check_all" type="checkbox"></th>
								<th style="width: 6%;">Sr.No</th>
								<th>Particulars</th>
								<th style="width: 7%;">Quantity</th>
								<th style="width: 18%;">Rate</th>
								<th style="width: 18%;">Amount</th>
							</tr>
							<?php
							$srcnt =1; 
							$itemdesc = 1;
							$itemQty = 1;
							$itemRate = 1;
							$itemAmount = 1;
							$IDitemdesc = 1;
							$IDitemQty = 1;
							$IDitemRate = 1;
							$IDitemAmount = 1;
							if(isset($ArrItems) && !empty($ArrItems)){ 
								foreach($ArrItems as $row){
							?>
							<tr>
								<td><input type="checkbox" class="case"></td>
								<td><input type="text" class="form-control" id="sr_no" value="<?php echo $srcnt++; ?>"></td>
								<td><input type="text" class="form-control" name="item_desc_<?php echo $itemdesc++; ?>" id="itemdesc_<?php echo $IDitemdesc++; ?>" value="<?php echo $row['item_desc']; ?>"></td>
								<td><input type="text" class="itemrate form-control" name="item_qty_<?php echo $itemQty++; ?>" id="itemqty_<?php echo $IDitemQty++; ?>" value="<?php echo $row['item_quantity']; ?>"></td>
								<td><input type="text" class="itemrate form-control" name="item_rate_<?php echo $itemRate++; ?>" id="itemrate_<?php echo $IDitemRate++; ?>" value="<?php echo $row['item_rate']; ?>"></td>
								<td><input type="text" class="totalLinePrice form-control" name="item_amount_<?php echo $itemAmount++; ?>" id="itemamount_<?php echo $IDitemAmount++; ?>" value="<?php echo $row['item_amount']; ?>"></td>
							</tr>
							<?php }} ?>
						</table>
						<button type="button" class="btn btn-success btn-add-row btn-sm">+ Add New</button>
						<button type="button" class="btn btn-danger delete btn-sm">- Remove</button>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Total</label>
							<div class="col-lg-2">
								<input type="text" name="invoice_total" id="invoice_total" class="form-control" required="" value="<?php echo $ObjInvoice->invoice_amount; ?>">
							</div>
						</div>
						<div class="pull-right">
							<input type="checkbox" name="add_tax" id="add_tax" onchange="valueChanged()"  <?php if($ObjInvoice->invoice_tax_amount != 0.00){ echo 'checked'; } ?>> Add Tax
						</div><br>
						<div id="tax_div" style="<?php if($ObjInvoice->invoice_tax_amount !=0.00){ echo 'display: block'; }else{ echo 'display: none'; } ?>">
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">Tax Rate</label>
								<div class="col-lg-2">
									<input type="text" name="tax_rate" id="tax_rate" class="form-control" value="<?php echo ($ObjInvoice->invoice_tax_rate); ?>"">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">CGST</label>
								<div class="col-lg-2">
									<input type="text" name="cgst" id="cgst" class="form-control" value="<?php echo ($ObjInvoice->invoice_tax_amount/2); ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">SGST</label>
								<div class="col-lg-2">
									<input type="text" name="sgst" id="sgst" class="taxnos form-control" value="<?php echo ($ObjInvoice->invoice_tax_amount/2); ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">Tax Amount</label>
								<div class="col-lg-2">
									<input type="text" name="invoice_tax" id="invoice_tax" class=" taxnos form-control" value="<?php echo ($ObjInvoice->invoice_tax_amount); ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Net Amount</label>
							<div class="col-lg-2">
								<input type="text" name="invoice_net_amount" id="invoice_net_amount" class="form-control" required="" value="<?php echo $ObjInvoice->invoice_net_amount; ?>">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="control-label col-lg-2">Payment Mode</label>
							<div class="col-lg-4">
								<input type="radio" name="payment_mode" value="Cash" required="" <?php if($ObjInvoice->payment_mode == 'Cash'){ echo 'checked';} ?>> Cash &nbsp;
								<input type="radio" name="payment_mode" value="Cheque" required="" <?php if($ObjInvoice->payment_mode == 'Cheque'){ echo 'checked';} ?>> Cheque &nbsp;
								<input type="radio" name="payment_mode" value="Online" required="" <?php if($ObjInvoice->payment_mode == 'Online'){ echo 'checked';} ?>> Online (RTGS/NEFT)
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class="col-lg-offset-5 col-lg-2">
								<button type="submit" class="btn btn-primary">Save Invoice</button>
							</div>
						</div>
						<input type="hidden" name="icnt" id="icnt" value="<?php echo (isset($ArrItems) && !empty($ArrItems)) ? count($ArrItems) : '1'; ?>"/>
						<?php form_close(); ?>
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
	<script src="<?php echo base_url();?>assets/plugins/datepicker/datepicker.js" type="text/javascript"></script>
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
			});
		$('#invoice_date').datepicker({
				format: "dd-mm-yyyy"
			});
		$('#customer_name').on('change', function(){
			if ($(this).val() != '') {
				$.post({
					type : 'POST',
					url  : '<?php echo site_url('InvoiceController/getCustomerinfo'); ?>',
					data : {id:$(this).val(),<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
					success:function(data) {
						var result = $.parseJSON(data);
							if (result){
								$('#cadress').val(result.address);
								$('#mobile_no').val(result.contact_no);
								$('#cust_name').val(result.name);
								if (result.gstin == '') {
									$('#cgstin').val('NA');
								} else{
									$('#cgstin').val(result.gstin);
								}
							} 
						}
				});
			}	
		});
        var i = <?php echo (isset($ArrItems) && !empty($ArrItems)) ? count($ArrItems)+1 : '1' ?>;
		$('.btn-add-row').on('click', function(){
			var row = '<tr><td><input type="checkbox" class="case"></td><td><input type="text" class="form-control"></td><td><input type="text" class="form-control" name="item_desc_'+i+'"></td><td><input type="text" class=" itemrate form-control" id="itemqty_'+i+'" name="item_qty_'+i+'"></td><td><input type="text" class="itemrate form-control" name="item_rate_'+i+'" id="itemrate_'+i+'"></td><td><input type="text" class="totalLinePrice form-control" id="itemamount_'+i+'" name="item_amount_'+i+'"></td></tr>';
			$('#invoice_items_table').append(row);
			i++;
			$('#icnt').val(i-1);
		});
		$("#invoice_items_table").on("keyup", ".itemrate", function () {
			id = $(this).attr('id').split("_");
			quantity = $('#itemqty_'+id[1]).val();
			price = $('#itemrate_'+id[1]).val();
			if( quantity!='' && price !='' )
				$('#itemamount_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );
			calculateTotal();
		});
		//to check all checkboxes
		$("#invoice_items_table").on("change", "#check_all", function () {
			$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
		});
		//deletes the selected table rows
		$(".delete").on("click", function () {
			var items = 0;
			$('.case:checkbox:checked').parents("tr").remove();
			$('#check_all').prop("checked", false);
			$('.totalLinePrice').each(function(){
				items++;
			});
			$('#icnt').val(items);
			calculateTotal();
		});
		$('#tax_rate').on('keyup', function(){
			var invoice_total = $('#invoice_total').val();
			var tax_rate = $('#tax_rate').val();
			var total_tax = ((parseFloat(invoice_total) * parseFloat(tax_rate))/100);
			$('#invoice_tax').val(total_tax.toFixed(2));
			$('#cgst,#sgst').val((parseFloat(total_tax)/2).toFixed(2));
			var net_total = (parseFloat($('#invoice_tax').val()) + parseFloat($('#invoice_total').val()));
			$('#invoice_net_amount').val(net_total.toFixed(2));
		});
		})
		function valueChanged() {
		    if($('#add_tax').is(":checked"))   
		        $("#tax_div").css('display','block');
		    else{
		        $("#tax_div").css('display','none');
		    	$('#cgst').val(0);
		    	$('#sgst').val(0);
		    	$('#invoice_tax').val(0);
		    	calculateTotal();
		    }
		}
		//total price calculation
		function calculateTotal(){
			subTotal = 0 ; total = 0; items=0;
			$('.totalLinePrice').each(function(){
				if($(this).val() != '')
					subTotal += parseFloat($(this).val());
				items++;
			});
			$('#invoice_total').val(subTotal.toFixed(2));
			if($('#add_tax').is(":checked")){
				tax = $('#invoice_tax').val();
				if(tax != '' && typeof(tax) != "undefined" ){
					if (items == 0) {
						$('#tax_rate').val(0);
						$('#cgst').val(0);
		    			$('#sgst').val(0);
		    			$('#invoice_tax').val(0);
						$('#invoice_net_amount').val(0);
						total = 0;	
					} else {
						var invoice_total = $('#invoice_total').val();
						var tax_rate = $('#tax_rate').val();
						var taxAmount = ((parseFloat(invoice_total) * parseFloat(tax_rate))/100);
						$('#invoice_tax').val(taxAmount.toFixed(2));
						$('#cgst,#sgst').val((parseFloat(taxAmount)/2).toFixed(2));
						total = subTotal + taxAmount;
					}
				}
			}else{
				$('#invoice_tax').val(0);
				total = subTotal;
			}
			$('#invoice_net_amount').val(total.toFixed(2) );
		}

	</script>
</body>
</html>