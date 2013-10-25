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
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('Fp_management/update_transaction',$att); ?>
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
    
    <div class="controls controls-row" id="" >
              <input class="span2" type="text" readonly="readonly" id="FpCommodity" value="<?php echo $val['fp_name'];?>">
              <input class="span2" type="text" readonly="readonly" id="FpCommodityid" value="<?php echo $val['Unit'];?>">
              <input type="hidden" readonly="readonly" id="trid" name="trid" value="<?php echo $val['tr_id'];?>">
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
      <input type="text" id="Dateexp" readonly="readonly" value="<?php echo date('F j Y ', strtotime($val['fp_date']));?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Dateexp">Action</label>
    <div class="controls">
      <select id="action" name="action">
      	<option value="0">Select Action</option>
      	<option value="1">Arrived Awaiting clearance</option>
      	<option value="2">Receive- In Store</option>
      	<option value="3">Delay</option>
      	<option value="4">Cancel</option>
      </select>
    </div>
  </div>
  <div class="controls controls-row" id="actionreceive_wait" style=" margin-bottom:1em; ">
              <input class="span2 dateclass" type="text" placeholder="Date Incountry" id="receive_wait" name="receive_wait">
              <input class="span2" type="text" placeholder="Quantity Received" id="qty_incountry" name="qty_incountry">
            </div>
            <div class="controls controls-row" id="cancel" style=" margin-bottom:1em; ">
              <input class="span2 dateclass" type="text" placeholder="Cancel Date" id="cancel_date" name="cancel_date">
               </div>
  <div class="controls controls-row" id="actionreceive" style=" margin-bottom:1em; ">
              <input class="span2 dateclass" type="text" placeholder="Date in Store" id="receive" name="receive">
              <input class="span2" type="text" placeholder="Quantity Received" id="qtyReceive" name="qtyReceive">
            </div>
            
  <div class="controls controls-row" style="margin-top:1em; margin-bottom:1em; " id="actiondelay">
              <input class="span2 dateclass" type="text" placeholder="Date delayed to" id="delay" name="delay">
              <input class="span3" type="text" placeholder="Comment" id="comment" name="comment">
            </div>
            
           <div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
  
</div>
  
</div>

  </div>
<?php }
echo form_close();
?>

	 
  <script>
  	$(document).ready(function() {
	$(function() {
		$("#actionreceive").hide()
		$("#actiondelay").hide()
		$("#cancel").hide("slow");
  	 
	$("#action").change(function(){
		
		var radio_value = $(this).val();

				if (radio_value == '1') {
					$("#actionreceive_wait").show("slow");
					$("#actiondelay").hide("fast");
					$("#cancel").hide("slow");
					$("#actionreceive").hide("fast");
					$('#delay').val('');
					$('#comment').val('');
					$('#receive_wait').val('');
					$('#qty_incountry').val('');
					$('#cancel_date').val('');

				} else if (radio_value == '3') {
					$("#actiondelay").show("slow");
					$("#actionreceive").hide("fast");
					$("#cancel").hide("slow");
					$("#actionreceive_wait").hide("fast");
					$('#Receive').val('');
					$('#qtyReceive').val('');
					$('#receive_wait').val('');
					$('#qty_incountry').val('');
					$('#cancel_date').val('');
				}
				else if (radio_value == '2') {
					$("#actionreceive").show("slow");
					$("#cancel").hide("slow");
					$("#actiondelay").hide("fast");
					$("#actionreceive_wait").hide("fast");
					$('#Receive').val('');
					$('#qtyReceive').val('');
					$('#delay').val('');
					$('#cancel_date').val('');
					$('#comment').val('');
				}else if (radio_value == '4') {
					$("#cancel").show("slow");
					$("#actionreceive_wait").hide("slow");
					$("#actiondelay").hide("fast");
					$("#actionreceive").hide("fast");
					$('#Receive').val('');
					$('#qtyReceive').val('');
					$('#delay').val('');
					$('#comment').val('');
				}
    
  });	
	$( ".dateclass" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});	
 });
  });
  </script>
