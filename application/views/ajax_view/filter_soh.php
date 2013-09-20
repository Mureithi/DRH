<div id="table_filtered">
<table class="table table-hover table-bordered">
		<thead style="font-weight:bold; background: #fefefd;font-size: 13px; ">
			<tr>
				
				<th colspan="5" style="text-align:center"></th>
			</tr>
		</thead>
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Actual SOH</th>
		<th>SOH in M.O.S</th>
		<th>Projected Consumption</th>
		<th>Date as Of</th>
		<th>Status</th>
		
		
	</tr>
	</thead>
	<tbody>	<?php 
		foreach ($kemsa_psi as  $value) {
			//$year=$value['financial_year'];
		
		?>
					
						<tr style="font-size: 12px">
							<td><?php echo $value['fp_name'];?></td>
							<td><?php echo $value['Unit'];?></td>
							<td><?php echo number_format($value['fp_quantity']);?></td>
							<td><?php echo $value['sohkemsa'];?></td>
							<td><?php echo number_format($value['projected_monthly_c']);?></td>
							<td><?php echo $value['fp_date']; ;?></td>
							<td><?php if ($value['transaction_type']=='PENDINGKEMSA') {
								echo '<button class="btn btn-mini btn-warning" id="" name="" >Pending</button>';
							} elseif($value['transaction_type']=='INCOUNTRY') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >Received</button>';
							}elseif($value['transaction_type']=='SOHKEMSA') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >SOH</button>';
							}else {
								echo '<button class="btn btn-mini btn-danger" id="" name="" >Delayed</button>';
							}
							 ?></td>
					   </tr>
					   
					<?php }?>	
		</tbody>
		
			
	 
</table>
</div>

<script>
  	$(document).ready(function() {
	$(function() {
  	 $('#filter').click(function() {
         var div="#table_filtered";
		var url = "<?php echo base_url()."Fp_management/soh_filter"?>";		
		//url=url+"/"+$("#commoditychange").val();
		//alert($("#financeyear").val());
		
				ajax_request (url,div);
		
		});
		
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          data: { year_from: $("#year_from").val(),month: $("#month").val() },
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-left:45%;margin-top:10%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
            $(div).html(msg);           
          }
        });
         
}

 			

				
		});
		
		
 });
  });
  </script>
