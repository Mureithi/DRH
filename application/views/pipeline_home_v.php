<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>

.higherWider {
    height: 100%;
    overflow-y: auto;
    width: 72%;
   margin-left: -35%;
   max-height: 70em;
   
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
	.mos_kemsa{
		
		width: 48%;
		height:270px;
		float:left;
		
		
	}
	.mos_psi{
		width: 48%;
		height:270px;
		margin-left:1.5em;
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
<button class="btn btn-primary" id="submitpipeline" name="submitpipeline" data-toggle="modal" data-target="#addfpcommodityModal">Enter Stocks on Hand</button>
<button class="btn btn-primary" id="submitpipeline" name="submitpipeline" data-toggle="modal" data-target="#addnewconsModal">Add Consignment</button>

 <a class="btn btn-primary " href="<?php echo base_url(); ?>stocks_management/editSupply_plan">Update Supply Plan</a>

               
                          
            </div>
            
            <div class="dashboard">
            	
            	<div class="mos_kemsa">
            		
            	</div>
            	<div class="mos_psi">
            		
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
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<a class="link" data-toggle="modal" data-target="#supplyplanModal" href="#">View Supply Plan</a>

	</h2>
            		<div id="graph_content"></div>
            	</div>
            </div>

<div id="addnewconsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		
			
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 style="font-size: 15px;text-align: center" id="myModalLabel">New Consignment</h3>
      </div>
  
 
  <?php 
    $att=array("name"=>'change','id'=>'change',"class"=>'form-horizontal');
	 echo form_open('Stocks_management/submit_pipeline',$att); ?>
  <div class="control-group" style="margin-top: 1em;">
  	<span id="err"></span>
    <label class="control-label" for="inputcommodity">FP Commodity</label>
    <div class="controls">
      <select  id="pipecommodity" name="pipecommodity" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity2) {
			$id=$fpcommodity2->id;
			$commodity2=$fpcommodity2->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity2;?></option>
		<?php }
		?>
	</select> 
    </div>
  </div>
  <div class="control-group" >
    <label class="control-label" for="inputfunding">Funding Source</label>
    <div class="controls">
      <select  id="funding_source" name="funding_source" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fundingsource as $fundingsource) {
			$id=$fundingsource->id;
			$source=$fundingsource->funding_source;
			?>
			<option value="<?php echo $id;?>"><?php echo $source;?></option>
		<?php }
		?>
	</select> 
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date">ETA Date</label>
    <div class="controls">
      <input type="text" id="etadetails" name="etadetails" placeholder="Date">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="quantity">Quantity Expected</label>
    <div class="controls">
      <input type="text" id="quantity" name="quantity" placeholder="Quantity">
    </div>
  </div>
    
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary" id="submitpipeline" name="submitpipeline">Submit</button>
  </div>


</div>
<?php
echo form_close();
?>

<div id="addfpcommodityModal" class="modal hide fade" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-height:50em;">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 style="font-size: 15px;text-align: center" id="myModalLabel">Actual Stock</h3>
      </div>
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('Stocks_management/submit_stock_status',$att); ?>
  <div class="control-group" style="margin-top: 1em;">
  	
    <label class="control-label" for="inputcommodity">FP Commodity</label>
    <div class="controls">
      <select  id="actualcommodity" name="actualcommodity" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity3) {
			$id=$fpcommodity3->id;
			$commodity3=$fpcommodity3->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity3;?></option>
		<?php }
		?>
	</select> 
    </div>
  </div>
  
  <div class="control-group" >
    <label class="control-label" for="Store">Store</label>
    <div class="controls">
       <select id="store" name="store">
       	<option value="0">Select Store</option>
       	<option value="KEMSA">KEMSA</option>
       	<option value="PSI">PSI</option>
       </select>
    </div>
  </div>
  
  <div class="control-group" >
    <label class="control-label" for="actualqty">Actual Quantity</label>
    <div class="controls">
       <input type="text" id="qty" name="qty" placeholder="Quantity">
    </div>
  </div>
  
  <div class="control-group" >
    <label class="control-label" for="dateofstock">Date as of</label>
    <div class="controls">
       <input type="text" id="dateofstock" name="dateofstock" placeholder="d M, yy">
    </div>
  </div>
  
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
     <button class="btn btn-primary" id="submitactual" name="submitactual">Submit</button>
  </div>
  </div>
  
<?php
echo form_close();
?>
  
  
  <div id="supplyplanModal" class="modal hide fade higherWider" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-height:50em;">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h2 style="font-size: 16px;text-align: center" id="myModalLabel">Estimated Time Of Arrival Of Pending FP Consignments (Public Sector Pipeline)</h2>
     <h3 style="font-size: 15px;text-align: center" id="myModalLabel">Supply Plan</h3>
      </div>
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('/',$att); ?>
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
		<th>Quantity</th>
		
	</tr>
	</thead>
	<tbody>	<?php 
		foreach ($supplyplan as  $value) {
			
		
		?>
					
						<tr style="font-size: 12px">
							<td><?php echo $value['fp_name'];?></td>
							<td><?php echo $value['Unit'];?></td>
							<td><?php echo $value['funding_source'];?></td>
							<td><?php echo  date('F j, Y ', strtotime($value['eta_details']));?></td>
							<td><?php echo number_format($value['pending']) ;?></td>
							
					   </tr>
					   
					   <?php }?>
						
		</tbody>
		
			
	 
</table>
  
  </div>
  
  <script>
	$(document).ready(function() {
	$(function() {
		
		$("#commoditychange").val(3)
		 $('.mos_kemsa').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Public Sector Pipeline (2013-2014) '
            },
            xAxis: {
                categories: <?php echo $arrayfpkemsa ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Months of Stock '
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            credits: {
		enabled: false
		},
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Pending Consignment',
                data: <?php echo $arraypending ?>
            }, {
                name: 'Delayed Consignment',
                data: <?php echo $arraydelayed ?>
            }, {
                name: 'Actual Stocks',
                data: <?php echo $arraysohkemsa ?>
            }]
        });
        
        $('.mos_psi').highcharts({
        	colors: [
		'#8bbc21',
		'#910000'
		],
            chart: {
            	height:280,
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Private Sector Pipeline (2013-2014)'
            },
            xAxis: {
                categories: <?php echo $arrayfppsi ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock Status PSI in(MOS)'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                },
                
            },credits: {
		enabled: false
		},
                series: [{
                name: 'Stores MOS',
                data: <?php echo $arraysohpsi ?>
            } ]
        });
    $('#graph_content').highcharts({
              title: {
                text: 'Supply Plan Vs Actual M.O.S (2013-2014)',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: DRH',
                x: -20
            },
            xAxis: {
                categories: <?php echo $montharray ?>
            },
            yAxis: {
                title: {
                    text: 'Months of Stock (MOS)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'MOS',
                crosshairs: true,
                shared: true
            },credits: {
		enabled: false
		},
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [ {
                name: 'Supply Plan',
                data: <?php echo $arrayto_graph ?>
            }, {
                name: 'Actual MOS',
                data: <?php echo $arrayactual ?>
            }]
        });
     
         
    $('#filter').click(function() {
         var div="#graph_content";
		var url = "<?php echo base_url()."Stocks_management/supply_plan_filtered"?>";		
		//url=url+"/"+$("#commoditychange").val();
		
				ajax_request (url,div)
		
				
		});
		
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          data: { commoditychange: $("#commoditychange").val() },
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-left:45%;margin-top:15%;' src="+loading_icon+">");
            
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
		
		$('#submitpipeline').submit(function(){
			
			 $.ajax({
	            type: $('#submitpipeline').attr('method'),

	            	url:$('#submitpipeline').attr('action'),
					cache:"false",
					data:$('#submitpipeline').serialize(),
					dataType:'json',
					beforeSend:function(){
						 $("#err").html("Processing...");
					},
					complete:function(){
						
					},
					success: function(data){
						//return;
						//alert(data.response);
					if(data.response=='false'){
						
						 $('#err').html(data.msg);
						
							}else if(data.response=='true'){
								alert('haha');
								return;
								$("#err").empty();
								
								$('#err').html(data.msg);
								
							}

						}
	
							
	});

	return false;
	});
	
	$('#submitactual').submit(function(){
			
			 $.ajax({
	            type: $('#submitactual').attr('method'),

	            	url:$('#submitactual').attr('action'),
					cache:"false",
					data:$('#submitactual').serialize(),
					dataType:'json',
					beforeSend:function(){
						 $("#err").html("Processing...");
					},
					complete:function(){
						
					},
					success: function(data){
						//return;
						//alert(data.response);
					if(data.response=='false'){
						
						 $('#err').html(data.msg);
						
							}else if(data.response=='true'){
								alert('haha');
								return;
								$("#err").empty();
								
								$('#err').html(data.msg);
								
							}

						}
	
							
	});

	return false;
	});
    //new
   	


  });
  });
</script>
