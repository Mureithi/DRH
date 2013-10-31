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
    width: 80%;
   margin-left: -40%;
   max-height: 900px;
   max-width: 1500px;
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
		margin:auto;
		height:83em;
			
	}
	
	.containkemsa{
		
		width: 49%;
		height:330px;
		float:left;
		margin-left:5em;
		
	}
	.containpsi{
		
		width: 47%;
		height:330px;
		float:right;
		
	}	
	.pipeline_data{
		width: 75%;
		height:400px;
		float:left;
		margin-top:1.5em;
		margin-left:14%;
	}
	.nav-tabs a{
		font-size:15px;
	}
</style>


<div class="sub-menu">
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/soh_home">Enter Stocks on Hand</a>
<!--<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/Supply_plan">Supply Plan</a>-->
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/editsupply_plan">Update Supply Plan</a>
<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/soh_detailed">Detailed SOH</a>
<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#supplyplanModal">View Supply Plan</button>
<!--<button class="btn btn-primary" id="" name="" data-toggle="modal" data-target="#downloadModal">Downloads</button>-->


        
            </div>
            
            <div class="dashboard">
            	<div class="containkemsa">
            		<h2>
	 
              <input class="span2 dateclass" type="text" placeholder="Date as of" id="as_of" name="as_of">
              
	<button class="btn btn-small btn-success" id="filter_kemsa" name="filter_kemsa" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<button class="btn btn-mini btn-success enlarge" id="kemsa-more" name="kemsa-more" style="margin-left: 1em;">Enlarge <i class=" icon-zoom-in"></i></button> 
	<button class="btn btn-mini btn-success enlarge" id="kemsa-less" name="kemsa-less" style="margin-left: 1em;">Return <i class=" icon-zoom-out"></i></button> 

	</h2>
            	<div class="mos_kemsa">
            		
            	</div>
            	</div>
            	
            	<div class="containpsi">
            		<h2>
		
		 
		<input class="span2 dateclass" type="text" placeholder="Date as of" id="as_of_psi" name="as_of_psi">
	<button class="btn btn-small btn-success" id="filter_psi" name="filter_psi" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<button class="btn btn-mini btn-success enlarge" id="psi-more" name="psi-more" style="margin-left: 1em;">Enlarge <i class=" icon-zoom-in"></i></button> 
	<button class="btn btn-mini btn-success enlarge" id="psi-less" name="psi-less" style="margin-left: 1em;">Return <i class=" icon-zoom-out"></i></button>
	
	<!--<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply  Plan Vs Actual</a>-->

	</h2>
            	<div class="mos_psi">
            		
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
	<select  id="financeyear" name="financeyear" >
    <option value="0">Select Fiscal Year</option>
    <option value="2013-2014">2013-2014</option>
    <option value="2012-2013">2012-2013</option>
    <option value="2011-2012">2012-2011</option>
		
	</select> 
	<select  id="graphtype" name="graphtype" >
    <option value="0">Select Graph type</option>
    <option value="line">Line & Bar</option>
    <option value="column">All bar</option>
    
		
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
      <ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home">Pipeline</a></li>
  <li><a href="#profile">Received</a></li>
  
		</ul>
		<div class="tab-content" >
<div class="tab-pane active" id="home">
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
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Date Received</th>
		<th>Revised ETA</th>
		<th>No Days Delayed</th>
		<th>Quantity Expected</th>
		<th>Quantity Received</th>
		<th>Quantity Remaining</th>
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
							 <td><?php 
								if ($val['transaction_type']=='INCOUNTRY'||$val['transaction_type']=='RECEIVED') {
									
									echo $diff = (strtotime($val['date_receive']) - strtotime($val['fp_date']))/ (60 * 60 * 24).' '.'days';
								} elseif($val['transaction_type']=='DELAYED') {
									echo $diff = (strtotime($val['delay_to']) - strtotime($val['fp_date']))/ (60 * 60 * 24).' '.'days';
								}
								
							 ?></td>
							<td><?php echo number_format($val['fp_quantity']);?></td>
							<td><?php echo number_format($val['qty_receive']);?></td>
							<td><?php echo number_format($val['fp_quantity']-$val['qty_receive']);?></td>
							<td><?php if ($val['transaction_type']=='PENDINGKEMSA') {
								echo '<button class="btn btn-mini btn-warning" id="" name="" >Pending</button>';
							} elseif($val['transaction_type']=='INCOUNTRY') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >Arrived Awaiting clearance</button>';
							}elseif($val['transaction_type']=='DELAYED') {
								echo '<button class="btn btn-mini btn-danger" id="" name="" >Delayed</button>';
							}elseif($val['transaction_type']=='RECEIVED') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >Received</button>';
							}
							 ?></td>
							
					   </tr>
					   
				<?php }?>	 
						
		</tbody>
		
			
	 
</table>
 </div> 
 <div class="tab-pane" id="profile"><div class="tab-pane" id="home">
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
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Date Received</th>
		<th>Revised ETA</th>
		<th>No Days Delayed</th>
		<th>Quantity Expected</th>
		<th>Quantity Received</th>
		<th>Quantity Remaining</th>
		<th>Status</th>
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($received as $val ) {
			
			
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
							 <td><?php 
								if ($val['transaction_type']=='INCOUNTRY'||$val['transaction_type']=='RECEIVED') {
									
									echo $diff = (strtotime($val['date_receive']) - strtotime($val['fp_date']))/ (60 * 60 * 24).' '.'days';
								} elseif($val['transaction_type']=='DELAYED') {
									echo $diff = (strtotime($val['delay_to']) - strtotime($val['fp_date']))/ (60 * 60 * 24).' '.'days';
								}
								
							 ?></td>
							<td><?php echo number_format($val['fp_quantity']);?></td>
							<td><?php echo number_format($val['qty_receive']);?></td>
							<td><?php echo number_format($val['fp_quantity']-$val['qty_receive']);?></td>
							<td><?php if ($val['transaction_type']=='RECEIVED') {
								echo '<button class="btn btn-mini btn-info" id="" name="" >Received</button>';
							} 
							 ?></td>
							
					   </tr>
					   
				<?php }?>	 
						
		</tbody>
		
			
	 
</table>
 </div> </div>
  </div>
  </div>
  <script>
	$(document).ready(function() {
	$(function() {
		$( "#kemsa-less" ).hide( "fast");
		$( "#psi-less" ).hide( "fast");
		$( ".dateclass" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});
		
		$('#myTab a').click(function (e) {
 		 e.preventDefault();
 			 $(this).tab('show');
})
			
			
		$('.enlarge').click(function(){
	
		
		var myID = $(this).attr('id');
		switch(myID){
		case'kemsa-more':
		$( ".containpsi" ).hide( "fast");	
		$( "#kemsa-less" ).show( "fast");
		$( "#kemsa-more" ).hide( "fast");
		$('.containkemsa').animate({height:'48%',width:'95%'}, 500);
		$('#mos_kemsa').animate({height:'70%',width:'95%'}, 500);
		$('.mos_kemsa').load('<?php echo base_url()."Fp_management/kemsa_data"?>');
	
		break;
				
		case'kemsa-less':
		 $( ".containpsi" ).show( "fast");	
		 $( "#kemsa-less" ).hide( "fast");
		 $( "#kemsa-more" ).show( "fast");
		 $('.containkemsa').animate({height:'50%',width:'48%'}, 500);
		 $('#mos_kemsa').animate({height:'50%',width:'48%'}, 500);
		 $('.mos_psi').load('<?php echo base_url()."Fp_management/psi_data"?>');
		 $('.mos_kemsa').load('<?php echo base_url()."Fp_management/kemsa_data"?>');
	  
		break;
		
		case'psi-more':
		$( ".containkemsa" ).hide( "fast");	
		$( "#psi-less" ).show( "fast");
		$( "#psi-more" ).hide( "fast");
		$('.containpsi').animate({height:'48%',width:'95%'}, 500);
		$('#mos_psi').animate({height:'70%',width:'95%'}, 500);
		$('.mos_psi').load('<?php echo base_url()."Fp_management/psi_data"?>');
	  
		break;
		
		case'psi-less':
		$( ".containkemsa" ).show( "fast");	
		 $( "#psi-less" ).hide( "fast");
		 $( "#psi-more" ).show( "fast");
		 $('.containpsi').animate({height:'50%',width:'48%'}, 500);
		 $('#mos_kemsa').animate({height:'50%',width:'48%'}, 500);
		 $('.mos_psi').load('<?php echo base_url()."Fp_management/psi_data"?>');
		 $('.mos_kemsa').load('<?php echo base_url()."Fp_management/kemsa_data"?>');
	  
		break;
	
		}
		
		  
	});
	
	
		
		$("#commoditychange").val(1)
		
		var div="#graph_content";
		var url = "<?php echo base_url()."Fp_management/supply_plan_default"?>";
		request (url,div);
		
				
		var div=".mos_kemsa";
		var url = "<?php echo base_url()."Fp_management/kemsa_data"?>";
		request (url,div);
		
		var div=".mos_psi";
		var url = "<?php echo base_url()."Fp_management/psi_data"?>";
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
				ajax_supply (url,div);
		
				
		});
			
		 $('#filter_kemsa').click(function() {
    	var asof=$("#as_of").val();
    	
    	
    				if (asof=='') {
						
						alert("Please Enter a Date  ");
						return;
					}
         var div=".mos_kemsa";
		var url = "<?php echo base_url()."Fp_management/kemsa_data"?>";		
		
				ajax_request (url,div);
		
				
		});
		
		$('#filter_psi').click(function() {
    	var psidate=$("#as_of_psi").val();
    	
    	
    				if (psidate=='') {
						
						alert("Please Enter date");
						return;
					}
					
         var div=".mos_psi";
		var url = "<?php echo base_url()."Fp_management/psi_data"?>";		
		
				ajax_request1 (url,div);
		
				
		});
				
		function ajax_supply (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
           data: {graphtype: $("#graphtype").val(),financeyear: $("#financeyear").val(),commoditychange1: $("#commoditychange1").val()},
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

function ajax_request1 (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
           data: {as_of_psi: $("#as_of_psi").val()},
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
function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
           data: {as_of: $("#as_of").val()},
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
			dateFormat: 'd M yy', 
			
		});
		
	
  });
  });
</script>
