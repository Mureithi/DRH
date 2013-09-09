<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>

.higherWider {
    height: 100%;
    overflow-y: auto;
    width: 72%;
   margin-left: -35%;
   max-height: 800px;
   
   
}
	
	.pipeline_data{
	margin:auto;
	width:70%;	
		
	}
	.pipeline_data h2 {
		background: #29527b; /* Old browsers */
		color: #fff;
		padding: 8px;
		margin: 0 0 0.625em 0;
		-webkit-box-shadow:  0px 2px 6px 0.7px #000;
        box-shadow:  0px 2px 6px 0.7px #000;
        -moz-box-shadow:  0px 2px 6px 0.7px #000;
	}
	#graph_content{
		height:100%;
	}
	.sub-menu{
		width:70%;
		margin-left:2em;
		
	}
	.dashboard{
		width:98%;
		height:50em;
		margin:auto;
		height:650px;
			
	}
	.mos_kemsa_psi{
		
		width: 100%;
		margin:auto;
		height:280px;
		float:left;
		
	}
	
	.pipeline_data{
		width: 75%;
		height:300px;
		float:left;
		margin-top:1.5em;
		margin-left:14%;
	}
</style>


<div class="sub-menu">
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/soh_home">Enter Stocks on Hand</a>
<!--<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/Supply_plan">Supply Plan</a>-->
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/editSupply_plan">Update Supply Plan</a>
<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#SOHModal">Detailed SOH</button>
<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#supplyplanModal">View Supply Plan</button>

        
            </div>
            
            <div class="dashboard">
            	
            	<div class="mos_kemsa_psi">
            		
            	</div>
            	
            	<div class="pipeline_data">
            		<h2>
		
		<select  id="commoditychange" name="commoditychange" >
    <option value="0">Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity1) {
			$id=$fpcommodity1->id;
			$commodity=$fpcommodity1->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity;?></option>
		<?php }
		?>
	</select> 
	<select  id="financeyear" name="financeyear" >
    <option value="0">Select Fiscal Year</option>
    <option value="2013-2014">2013-2014</option>
    <option value="2012-2013">2012-2013</option>
    <option value="2011-2012">2012-2011</option>
		
	</select> 
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#supplyplanModal" href="#">View Supply Plan</a>-->

	</h2>
            		<div id="graph_content"></div>
            	</div>
            </div>
            
              <div id="SOHModal" class="modal hide fade higherWider" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-height:50em;">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h2 style="font-size: 16px;text-align: center" id="myModalLabel">Total Stocks at Hand</h2>
     <h3 style="font-size: 15px;text-align: center" id="myModalLabel">KEMSA Stores</h3>
      </div>

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
		<th>Financial Year</th>
		
		
	</tr>
	</thead>
	<tbody>	<?php 
		foreach ($kemsa_psi as  $value) {
			$year=$value['financial_year'];
		
		?>
					
						<tr style="font-size: 12px">
							<td><?php echo $value['fp_name'];?></td>
							<td><?php echo $value['Unit'];?></td>
							<td><?php echo number_format($value['fp_quantity']);?></td>
							<td><?php echo $value['sohkemsa'];?></td>
							<td><?php echo number_format($value['projected_monthly_c']);?></td>
							<td><?php echo $year ;?></td>
					   </tr>
					   
					<?php }?>	
		</tbody>
		
			
	 
</table>
  
  </div>
  <div id="supplyplanModal" class="modal hide fade higherWider" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-height:50em;">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h2 style="font-size: 16px;text-align: center" id="myModalLabel">Estimated Time Of Arrival Of Pending FP Consignments (Public Sector Pipeline)</h2>
     <h3 style="font-size: 15px;text-align: center" id="myModalLabel">Supply Plan</h3>
      </div>

  <table class="table table-hover table-bordered">
		<thead style="font-weight:bold; background: #fefefd;font-size: 13px; ">
			<tr>
				
				<th colspan="5" style="text-align:center"></th>
			</tr>
		</thead>
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Date Received</th>
		<th>Date Delayed</th>
		<th>Quantity</th>
		<th>Status</th>
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($supplyplan as $val ) {
			
			
		?>						
						<tr style="font-size: 12px">
							<td><?php echo $val['fp_name'];?></td>
							<td><?php echo $val['Unit'];?></td>
							<td><?php echo $val['funding_source'];?></td>
							<td><?php echo  date('F j, Y ', strtotime($val['fp_date']));?></td>
							<td><?php if ($val['date_receive']=='0000-00-00'||$val['date_receive']=='1970-01-01') {
								echo '-';
							} else {
								echo date('F j, Y ', strtotime($val['date_receive']));
							}
							 ?></td>
							<td><?php if ($val['delay_to']=='0000-00-00'||$val['delay_to']=='1970-01-01') {
								echo '-';
							} else {
								echo date('F j, Y ', strtotime($val['delay_to']));
							}
							 ?></td>
							<td><?php echo number_format($val['fp_quantity']);?></td>
							<td><?php if ($val['transaction_type']=='PENDINGKEMSA') {
								echo '<button class="btn btn-mini btn-warning" id="" name="" >Pending</button>';
							} elseif($val['transaction_type']=='INCOUNTRY') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >Received</button>';
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
		
		$("#commoditychange").val(10)
		var div="#graph_content";
		var url = "<?php echo base_url()."Fp_management/supply_plan_default"?>";
		ajax_request (url,div);
		
		var div=".mos_kemsa_psi";
		var url = "<?php echo base_url()."Fp_management/kemsa_psidata"?>";
		ajax_request (url,div);
		 
     
         	
    $('#filter').click(function() {
         var div="#graph_content";
		var url = "<?php echo base_url()."Fp_management/supply_plan_filtered"?>";		
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
    $( "#etadetails,#dateofstock" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M, yy', 
			
		});
		
	
  });
  });
</script>
