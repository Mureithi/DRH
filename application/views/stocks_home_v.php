<style>
	.stockstatus_data_entry{
		width:70%;
		margin:auto;
		 -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  
  line-height: 1.5;
  margin: 20px auto;
  -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   box-shadow: 0px 0px 10px rgba(0,0,0,.8);	
		
	}
</style>

<script>
$(document).ready(function() {
	$(function() {
    
    
    $( "#date_stock" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M, yy', 
			
		});
    
  });
  });
</script>
<?php 
    
	 echo form_open('Stocks_management_controller/submit_stock_status'); ?>
<div class="stockstatus_data_entry">
	<table class="table table-hover table-bordered">
		<thead style="font-weight:bold; background: #fefefd;font-size: 13px; ">
			<tr>
				<th colspan="2"></th>
				<th colspan="2" style="text-align:center">Stock On Hand (SOH)</th>
				<th colspan="2" style="text-align:center"> Pending Consignments</th>
			</tr>
		</thead>
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>Commodity</th>
		<th>Unit</th>
		<th>KEMSA</th>
		<th>PSI</th>
		<th>KEMSA</th>
		<th>PSI</th>
		
		
	</tr>
	</thead>
	<tbody>
		
		<?php 
				foreach ($stock_entry as $stock_entry ) { ?>
					
					
						<tr style="font-size: 12px">
							<td><?php echo $stock_entry->fp_name ;?><input type="hidden" value="<?php echo $stock_entry->id ;?>" id="fpid[]" name="fpid[]"/></td>
							<td><?php echo $stock_entry->unit ;?></td>
							<td><input type="text" name="SOHKEMSA[]" id="SOHKEMSA[]"/></td>
							<td><input type="text" name="SOHPSI[]" id="SOHPSI[]"/></td>
							<td><input type="text" name="PendingKEMSA[]" id="PendingKEMSA[]"/></td>
							<td><input type="text" name="PendingPSI[]" id="PendingPSI[]"/></td>
					   </tr>
						
		</tbody>
		
		<?php }
					?>	
	 
</table>
<div class="modal-footer">
	<p>Date: <input type="text" id="date_stock" name="date_stock" /></p>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary" id="changepsaction" name="">Submit</button>
  </div>
</div>
<?php

echo form_close();
?>
