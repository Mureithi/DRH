<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>
	
	.pipelinegraph{
	margin:auto;
	width:70%;	
		
	}
	.pipelinegraph h2 {
		background: #195f87; /* Old browsers */
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
<button class="btn btn-primary" id="submitpipeline" name="submitpipeline" data-toggle="modal" data-target="#receivefpconsModal">Receive Consignment</button>
<button class="btn btn-primary" id="submitpipeline" name="submitpipeline" data-toggle="modal" data-target="#addfpcommodityModal">Delay Consignment</button>
                
                          
            </div>
            
            <div class="dashboard">
            	
            	<div class="mos_kemsa">
            		
            	</div>
            	<div class="mos_psi">
            		
            	</div>
            	<div class="pipeline_data">
            		<div id="graph_content"></div>
            	</div>
            </div>

<div id="addnewconsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		
			
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
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
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 style="font-size: 15px;text-align: center" id="myModalLabel">New Stock</h3>
      </div>
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('Stocks_management/',$att); ?>
  <div class="control-group" style="margin-top: 1em;">
  	
    <label class="control-label" for="inputcommodity">FP Commodity</label>
    <div class="controls">
      <select  id="pipecommodity" name="pipecommodity" >
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
       <select>
       	<option>Select Store</option>
       	<option>KEMSA</option>
       	<option>PSI</option>
       </select>
    </div>
  </div>
  
  <div class="control-group" >
    <label class="control-label" for="actualqty">Actual Quantity</label>
    <div class="controls">
       <input type="text" id="actualqty" name="actualqty" placeholder="Quantity">
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
    <button class="btn btn-primary" id="" name="" >Submit</button>
  </div>
  </div>
  
  <div id="receivefpconsModal" class="modal hide fade" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-height:50em;">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 style="font-size: 15px;text-align: center" id="myModalLabel">New Stock</h3>
      </div>
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('Stocks_management/',$att); ?>
  <div class="control-group" style="margin-top: 1em;">
  	
    <label class="control-label" for="inputcommodity">FP Commodity</label>
    <div class="controls">
      <select  id="pipecommodity" name="pipecommodity" >
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
  
  
  
  
  
  
  
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    
  </div>
  </div>
  
  <script>
	$(document).ready(function() {
	$(function() {
		 $('.mos_kemsa').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Public Sector Pipeline '
            },
            xAxis: {
                categories: <?php echo $arrayfp ?>
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
                name: 'Received Consignment',
                data: <?php echo $arrayreceived ?>
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
                text: 'Stock Status of FP Commodities in Private Sector Pipeline'
            },
            xAxis: {
                categories: ['Male Condoms', 'Female Condoms', 'Injectables', 'COCs', 'POPs', 'EC Pills', 'IUCDs', '1-rod Implants', '2-rod Implants','Cycle Beads']
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
                data: [5, 3, 4, 7, 2,3,6,1,3,4]
            }, {
                name: 'SDP MOS',
                data: [2, 2, 3, 2, 1,3,1,3,2,4]
            } ]
        });
    
     
     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSLine.swf"?>", "ChartId4", "100%", "100%", "0", "0");
    var url = '<?php echo base_url()."Stocks_management/pipeline_chart"?>'; 
    chart.setDataURL(url);
    chart.render("graph_content");
    
    $('#filter').click(function() {
         var div="#graph_content";
		var url = "<?php echo base_url()."Stocks_management/loadgraph"?>";		
		//url=url+"/"+$("#commoditychange").val();
		
		if($("#commoditychange").val() =='0') {
			return;	
		}else{
		ajax_request (url,div)
		
		}
		
		
		});
		
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          data: { commoditychange: $("#commoditychange").val() },
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-top:-10%;' src="+loading_icon+">");
            
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
    //new
   	


  });
  });
</script>
