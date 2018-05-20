<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chintamani Services | Sale Sujal Product</title>
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
					Sujal 
					<small>Sale Product</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Sale Sujal Product</li>
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
						<span class="box-title"><a href="<?php echo site_url('sale_product'); ?>"><button class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to List</button></a></span>
					</div>
					<div class="box-body">
						<?php echo form_open('save_sujal_product_sale', array('method'=>'post','class'=>'form-horizontal','autocomplete'=>'off')); ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Sale Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="sale_date" name="sale_date" placeholder="Sale Date">
							</div>
						</div>
						<div class="form-group">
							<label for="inputCustomers" class="col-sm-2 control-label">Select Customer</label>
							<div class="col-sm-10">
								<select class="form-control chosen-select" data-placeholder="Choose Customer" name="customer" id="customer" required="">
									<option value="">Select Customer </option>
									<?php 
									if (isset($ArrCustomers) && !empty($ArrCustomers)) {
										foreach ($ArrCustomers as $crow) {
											?>
											<option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
											<?php }	} ?>
										</select>
										<input type="hidden" name="customer_name" id="customer_name">
									</div>
								</div>
							<div class="form-group">
								<label for="inputCustomers" class="col-sm-2 control-label">Select Product</label>
								<div class="col-sm-10">
									<select class="form-control chosen-select" data-placeholder="Choose Product" name="product" id="product">
										<option value="">Select Product </option>
										<?php 
											if (isset($ArrProducts) && !empty($ArrProducts)) {
												foreach ($ArrProducts as $crow) {
													?>
										<option value="<?php echo $crow['id']; ?>"><?php echo $crow['name']; ?></option>
										<?php }	} ?>
									</select>
									</div>
							</div>
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Product Price</label>
							<div class="col-sm-10">
								<input type="hidden"  id="sproduct_name">
								<input type="text" class="form-control" id="sproduct_price" name="sproduct_price" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Price">
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Rate</label>
							<div class="col-sm-2">
								<input type="text" class="form-control price" id="sproduct_rate" name="sproduct_rate" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Rate">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
							<div class="col-sm-2">
								<input type="text" class="form-control price" id="sproduct_quantity" name="sproduct_quantity" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Product Quantity">
							</div>
							<label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" id="sproduct_amount" name="sproduct_amount" onkeyup="this.value=this.value.replace(/[^\d,]/g,'')" placeholder="Amount">
							</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-lg-10">
							<button type="button" class="btn btn-primary btn-add-row" id="">Add Item</button>
						</div>
						</div>
						<h4>Order Items</h4>
						<hr>
						<table class="table table-bordered" id="order_items_table">
											<tr>
												<th><input id="check_all" type="checkbox"></th>
												<!-- <th style="width: 6%;">Sr.No</th> -->
												<th>Particulars</th>
												<th style="width: 7%;">Quantity</th>
												<th style="width: 18%;">Rate</th>
												<th style="width: 18%;">Amount</th>
											</tr>
						</table>
						<button type="button" class="btn btn-danger delete btn-sm">- Remove</button>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Total</label>
							<div class="col-lg-2">
								<input type="text" name="order_total" id="order_total" class="form-control" required="">
							</div>
						</div>
						<div class="pull-right">
							<input type="checkbox" name="add_tax" id="add_tax" onchange="valueChanged()"> Add Tax
						</div><br>
						<div id="tax_div" style="display: none;">
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">Tax Rate</label>
								<div class="col-lg-2">
									<input type="text" name="tax_rate" id="tax_rate" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">CGST</label>
								<div class="col-lg-2">
									<input type="text" name="cgst" id="cgst" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">SGST</label>
								<div class="col-lg-2">
									<input type="text" name="sgst" id="sgst" class="taxnos form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-lg-offset-8 col-lg-2">Tax Amount</label>
								<div class="col-lg-2">
									<input type="text" name="order_tax" id="order_tax" class=" taxnos form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Net Amount</label>
							<div class="col-lg-2">
								<input type="text" name="order_net_amount" id="order_net_amount" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Paid Amount</label>
							<div class="col-lg-2">
								<input type="text" name="order_paid_amount" id="order_paid_amount" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-offset-8 col-lg-2">Due Amount</label>
							<div class="col-lg-2">
								<input type="text" name="order_due_amount" id="order_due_amount" class="form-control" required="">
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
							<div class=" col-sm-offset-2 col-sm-10">
								<button type="reset" class="btn btn-default">Cancel</button>	
								<button type="submit" class="btn btn-primary save-btn">Save Order</button>	
							</div>
						</div>					
					</div>
					<input type="hidden" name="icnt" id="icnt" />
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
		$(document).ready(function() {
			var config = {
				'.chosen-select'           : {},
				'.chosen-select-deselect'  : {allow_single_deselect:true},
				'.chosen-select-no-single' : {disable_search_threshold:10},
				'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
				'.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
				$(selector).chosen(config[selector]);
			}
			$('#customer').on('change', function() {
				if ($('#customer').val() != '') {
					$('#customer_name').val(($("#customer option:selected").text()));
				}
			});
			$('#product').on('change', function() {
				var product = $('#product').val();
				if (product != '') {
					$.post({
						type : 'POST',
						url  : '<?php echo site_url('SujalProductsController/getProductPrice'); ?>',
						data : {product:product,<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash();?>'},
						success:function(data) {
							var result = $.parseJSON(data);
							if (result){
								result = parseFloat(result);
								$('#sproduct_name').val($("#product option:selected").text());
								$('#sproduct_price').val(result.toFixed(0));
							} 
						}
					});
				}
			});
			$('.price').on('keyup', function() {
				var sproduct_rate = $('#sproduct_rate').val();
				$('#sproduct_amount').val(sproduct_rate * $('#sproduct_quantity').val());
			});

			var i = 1;
			$('.btn-add-row').on('click', function(){
				var row = '<tr><td><input type="checkbox" class="case"></td><td><input type="text" class="form-control" name="item_desc[]" value="'+$('#sproduct_name').val()+'"></td><td><input type="text" class=" itemrate form-control" id="itemqty_'+i+'" name="item_qty[]" value="'+$('#sproduct_quantity').val()+'"></td><td><input type="text" class="itemrate form-control" name="item_rate[]" id="itemrate_'+i+'" value="'+$('#sproduct_rate').val()+'"></td><td><input type="text" class="totalLinePrice form-control" id="itemamount_'+i+'" name="item_amount[]" value="'+$('#sproduct_amount').val()+'"></td></tr>';
				$('#order_items_table').append(row);
				i++;
				$('#icnt').val($('#tanks_info_table tr').length-1);
				calculateTotal();
				$('#sproduct_name').val('');
				$('#sproduct_price').val('');
				$('#sproduct_quantity').val('');
				$('#sproduct_rate').val('');
				$('#sproduct_amount').val('');
			});

			$("#order_items_table").on("keyup", ".itemrate", function () {
				id = $(this).attr('id').split("_");
				quantity = $('#itemqty_'+id[1]).val();
				price = $('#itemrate_'+id[1]).val();
				if( quantity!='' && price !='' )
					$('#itemamount_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );
				calculateTotal();
			});
			//to check all checkboxes
			$("#order_items_table").on("change", "#check_all", function () {
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
				$('#icnt').val($('#tanks_info_table tr').length-1);
				calculateTotal();
			});
			$('#tax_rate').on('keyup', function(){
				var order_total = $('#order_total').val();
				var tax_rate = $('#tax_rate').val();
				var total_tax = ((parseFloat(order_total) * parseFloat(tax_rate))/100);
				$('#order_tax').val(total_tax.toFixed(2));
				$('#cgst,#sgst').val((parseFloat(total_tax)/2).toFixed(2));
				var net_total = (parseFloat($('#order_tax').val()) + parseFloat($('#order_total').val()));
				$('#order_net_amount').val(net_total.toFixed(2));
			})
			$('#order_paid_amount').on('keyup', function() {
				var order_net_amount = $('#order_net_amount').val();
				if ((parseInt($('#order_paid_amount').val())) > parseInt(order_net_amount)) {
					alert('Amount Paid value should not be greater than Amount value.');
					$('#order_due_amount').val('0');
					return false;
				} else{
					$('#order_due_amount').val(order_net_amount - $('#order_paid_amount').val());
				}
			});

			$('#sale_date').datepicker({
				format: "dd-mm-yyyy",
				// startDate: "+0d"
			});
			
			$('.save-btn').on("click" , function () {
				if($('#icnt').val() == 0) {
					alert('Water Tanks Information cannot be blank. Please add Water Tanks Information.');
					return false;
				}
			});
		});
		function valueChanged() {
			if($('#add_tax').is(":checked"))   
				$("#tax_div").css('display','block');
			else{
				$("#tax_div").css('display','none');
				$('#tax_rate').val(0);
				$('#cgst').val(0);
				$('#sgst').val(0);
				$('#order_tax').val(0);
				calculateTotal();
			}
		}
		function calculateTotal(){
				subTotal = 0 ; total = 0; items=0;
				$('.totalLinePrice').each(function(){
					if($(this).val() != '')
						subTotal += parseFloat($(this).val());
					items++;
				});
				$('#order_total').val(subTotal.toFixed(2));
				if($('#add_tax').is(":checked")){
					tax = $('#order_tax').val();
					if(tax != '' && typeof(tax) != "undefined" ){
						if (items == 0) {
							$('#tax_rate').val(0);
							$('#cgst').val(0);
							$('#sgst').val(0);
							$('#order_tax').val(0);
							$('#order_net_amount').val(0);
							total = 0;	
						} else {
							var order_total = $('#order_total').val();
							var tax_rate = $('#tax_rate').val();
							var taxAmount = ((parseFloat(order_total) * parseFloat(tax_rate))/100);
							$('#order_tax').val(taxAmount.toFixed(2));
							$('#cgst,#sgst').val((parseFloat(taxAmount)/2).toFixed(2));
							total = subTotal + taxAmount;
						}
					}
				}else{
					$('#order_tax').val(0);
					total = subTotal;
				}
				$('#order_net_amount').val(total.toFixed(2) );
		}
	</script>
</body>
</html>