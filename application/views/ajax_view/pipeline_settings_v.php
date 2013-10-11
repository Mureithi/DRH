<div class="edit_plan">
  	
	
<div id="table_filtered">
	
<table class="table table-hover table-bordered">
		
     	
		<thead style="font-size: 13px; background: #C8D2E4 ">
			
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Available Quntity</th>
		<th >Stock Date as of</th>
		<th >Store</th>		
		<th >Action  </th>
		
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($pipeline as $val ) {
			
			
		?>						
						<tr style="font-size: 12px">
							<td><?php echo $val['fp_name'];?></td>
							<td><?php echo $val['Unit'];?></td>
							<td><?php echo $val ['fp_quantity'];?></td>
							<td><?php echo  $val ['fp_date'];?></td>
							<td><?php if ($val['transaction_type']=='INCOUNTRY') {
								echo 'Received - Not cleared';
							} elseif($val['transaction_type']=='RECEIVED') {
								echo 'Received - Complete';
							}
							 ?></td>
							
								<td><button class="btn btn-mini btn-success Editable" id="<?php echo $val['id'];?>" value="" >Edit <i class="icon-edit"></i></button>|
								<button class="btn btn-mini btn-danger delete" id="<?php echo $val['id'];?>" value="" >Delete <i class="icon-remove-sign"></i></button>
							</td>
							
					   </tr>
					   
				<?php }?>	 
						
		</tbody>
		
	 
</table>
</div>
  </div>

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
			window.location="<?php echo base_url();?>settings/edit_pipeline/"+encodeURIComponent(trid);
		
		});
		
		$('.delete').click(function() {
          alert("You are about to edit this field,Proceed?");
         	var trid=$(this).attr('id');
			window.location="<?php echo base_url();?>settings/delete_pipeline/"+encodeURIComponent(trid);
		
		});
		
		
 });
  });
  </script>
