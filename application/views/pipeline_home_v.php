<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
 <?php
$current_year = date('Y');
$earliest_year = $current_year - 4;
$current_month = date('n');

$montharray = array(1 => 'January',  2 => 'February',  3 => 'March',  4 => 'April',  5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');


?>
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
	.pipeline_data h2,.containkemsa h2,.containpsi h2 {
		background: #b4cbe2; /* Old browsers */
		color: #fff;
		padding: 4px;
		
		
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
	
	.containkemsa{
		
		width: 96%;
		height:330px;
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
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/soh_detailed">Detailed SOH</a>
<!--<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#SOHModal">Detailed SOH</button>-->
<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#supplyplanModal">View Supply Plan</button>

        
            </div>
            
            <div class="dashboard">
            	<div class="containkemsa">
            		<h2>
		<select name="monthkemsapsi" id="monthkemsapsi">
			<option>Select Month</option>
		<?php 
		for ($i=1; $i < 12 ; ) { 
			
		foreach ($montharray as $key => $val) {
			
			$year=$montharray[$key];
			
			?>
			<option value="<?php echo $i;?>"><?php echo $year;?></option>
			
		<?php $i++;}
		}
		?>
		</select>
		 
		<select name="year_kemsapsi" id="year_kemsapsi">
			<option>Select Year</option>
			<?php
		for($x=$current_year;$x>=$earliest_year;$x--){
			?>
			<option value="<?php echo $x;?>"
			<?php
			if ($x == $current_year) {echo "selected";
			}
			?>><?php echo $x;?></option>
			<?php }?>
		</select>
	<button class="btn btn-small btn-success" id="filter_kemsapsi" name="filter_kemsapsi" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply  Plan Vs Actual</a>-->

	</h2>
            	<div class="mos_kemsapsi">
            		
            	</div>
            	</div>
            	
            	
            	
            	<div class="pipeline_data">
            		<h2>
		
		<select  id="commoditychange1" name="commoditychange1" >
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
	<select  id="commoditychange2" name="commoditychange2" >
    <option value="0">Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity2) {
			$id=$fpcommodity2->id;
			$commodity=$fpcommodity2->fp_name;
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
	
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#supplyplanModal" href="#">View Supply Plan</a>-->

	</h2>
            		<div id="graph_content"></div>
            	</div>
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
		
		$("#commoditychange").val(1)
		
		var div="#graph_content";
		var url = "<?php echo base_url()."Fp_management/supply_plan_default"?>";
		request (url,div);
		
				
		var div=".mos_kemsapsi";
		var url = "<?php echo base_url()."Fp_management/kemsa_data"?>";
		request (url,div);
		 
     function request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
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
         	
    $('#filter').click(function() {
    	var fyear=$("#financeyear").val();
    	var fcommodity=$("#commoditychange1").val();
    	var fcommodity2=$("#commoditychange2").val();
    	
    	if (fyear==0) {
						
						alert("Please select Financial Year");
						return;
					}
					if (fcommodity==0) {
						
						alert("Please select FP Commodity.");
						return;
					}
         var div="#graph_content";
		var url = "<?php echo base_url()."Fp_management/supply_plan_default"?>";		
		//var why = $("#commoditychange").val();
		//var why = $("#financeyear").val();
				ajax_request (url,div);
		
				
		});
			
		 $('#filter_kemsapsi').click(function() {
    	var kmonth=$("#monthkemsapsi").val();
    	var kyear=$("#year_kemsapsi").val();
    	
    	if (kyear==0) {
						
						alert("Please select Year");
						return;
					}
					if (kmonth==0) {
						
						alert("Please select Month.");
						return;
					}
         var div=".mos_kemsapsi";
		var url = "<?php echo base_url()."Fp_management/kemsa_data"?>";		
		
				ajax_request (url,div);
		
				
		});
		
		
				
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
           data: {year_kemsapsi: $("#year_kemsapsi").val(),monthkemsapsi: $("#monthkemsapsi").val(),financeyear: $("#financeyear").val(),commoditychange1: $("#commoditychange1").val(),commoditychange2: $("#commoditychange2").val()},
          url: url,
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
