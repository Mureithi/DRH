<table class="table table-hover table-bordered">
		
     	
			<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Quantity</th>
		<th>Status | Action</th>
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($supplyplan as $val ) {
			$id=$val['tr_id'];
			
		?>						
						<tr style="font-size: 12px">
							<td><?php echo $val['fp_name'];?></td>
							<td><?php echo $val['Unit'];?></td>
							<td><?php echo $val['funding_source'];?></td>
							<td><?php echo  date('F j, Y ', strtotime($val['fp_date']));?></td>
							<td><?php echo number_format($val['fp_quantity']);?></td>
							<td><?php if ($val['transaction_type']=='PENDINGKEMSA') {
								echo "<button class='btn btn-mini btn-warning'  >Pending</button>
								<button class='btn btn-mini btn-success Editable' id='$id'>Edit</button>";
							} elseif($val['transaction_type']=='INCOUNTRY') {
								echo "<button class='btn btn-mini btn-success' >Not Cleared</button>
								<button class='btn btn-mini btn-success Editable' id='$id' >Edit</button>";
							}elseif($val['transaction_type']=='DELAYED') {
								echo "<button class='btn btn-mini btn-danger'  >Delayed</button>'
								<button class='btn btn-mini btn-success Editable' id='$id'>Edit</button>";
							}elseif($val['transaction_type']=='RECEIVED') {
								echo "<button class='btn btn-mini btn-success'  >Received</button>'
								<button class='btn btn-mini btn-success disabled' id='$id'>Edit</button>";
							}
							 ?>
							</td>
							
					   </tr>
					   
				<?php }?>	 
						
		</tbody>
		
	 
</table>

<script>
  	$(document).ready(function() {
	$(function() {
  	 $('#filter').click(function() {
         var div="#table_filtered";
		var url = "<?php echo base_url()."Fp_management/supply_plan_filter"?>";		
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
          data: { commoditychange: $("#commoditychange").val(),financeyear: $("#financeyear").val() },
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

 	 $('.Editable').click(function() {
          alert("You are about to edit this field,Proceed?");
         	var trid=$(this).attr('id');
			window.location="<?php echo base_url();?>fp_management/edit_transaction/"+encodeURIComponent(trid);
		

				
		});
		
		
 });
  });
  </script>
