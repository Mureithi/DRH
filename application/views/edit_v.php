  <style>
	.edit_plan{
		margin:auto;
		width:60%;
		height: auto;
		background:whitesmoke;
		padding: 3px;
	}
	.edit_plan h2 {
		background: #a6b1ca; /* Old browsers */
		color: #fff;
		padding: 9px;
		margin: 0 0 0.625em 0;
		text-align:center;
		
	}
	.higherWider {
    height: 100%;
    overflow-y: auto;
    width: 60%;
   margin-left: -35%;
   max-height: 70em;
   
}
.sub-menu{
		width:70%;
		margin-left:2em;
		margin-bottom:1em;
		
	}
	
</style>
  <div class="sub-menu">
  		<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/editSupply_plan">Back</a>
            </div>
            <?php 
		foreach ($editdata as $val ) {
			
			
		?>
  <div class="edit_plan">
  	<h2> Receive or Delay a Consignment by editing Details below</h2>
  	<div class="form-horizontal" style=" margin-left:24%; ">
  <div class="control-group" style=" margin-top:2em; ">
    <label class="control-label" for="FpCommodity">Fp Commodity</label>
    <div class="controls">
      <input type="text" readonly="readonly" id="FpCommodity" value="<?php echo $val['fp_name'];?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="FSource">Funding Source</label>
    <div class="controls">
      <input type="text" readonly="readonly" id="FSource" value="<?php echo $val['funding_source'];?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Quantityexp">Quantity Expected</label>
    <div class="controls">
      <input type="text" readonly="readonly" id="Quantityexp" value="<?php echo number_format($val['fp_quantity']);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Dateexp">Date Expected</label>
    <div class="controls">
      <input type="text" id="Dateexp" readonly="readonly" value="<?php echo date('F j, Y ', strtotime($val['fp_date']));?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Dateexp">Action</label>
    <div class="controls">
      <select id="action">
      	<option value="0">Select Action</option>
      	<option value="1">Receive</option>
      	<option value="2">Delay</option>
      </select>
    </div>
  </div>
  <div class="controls controls-row" id="actionreceive" style=" margin-bottom:1em; ">
              <input class="span2" type="text" placeholder="Date Received" id="Receive">
              <input class="span2" type="text" placeholder="Quantity Received">
            </div>
            
  <div class="controls controls-row" style="margin-top:1em; margin-bottom:1em; " id="actiondelay">
              <input class="span2" type="text" placeholder="Date delayed to" id="delay">
              <input class="span3" type="text" placeholder="Comment">
            </div>
            
           <div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
  <button type="button" class="btn">Cancel</button>
</div>
  
</div>

  </div>
<?php }?>	 
  <script>
  	$(document).ready(function() {
	$(function() {
		$("#actionreceive").hide()
		$("#actiondelay").hide()
  	 
	$("#action").change(function(){
		
		var radio_value = $(this).val();

				if (radio_value == '1') {
					$("#actionreceive").show("slow");
					$("#actiondelay").hide("fast");

				} else if (radio_value == '2') {
					$("#actiondelay").show("slow");
					$("#actionreceive").hide("fast");
				}
    
  });	
	$( "#Receive,#delay" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M, yy', 
			
		});	
 });
  });
  </script>
