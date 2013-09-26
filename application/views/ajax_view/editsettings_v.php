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
	 echo form_open('settings/update_transaction',$att); ?>
  <div class="sub-menu">
  		<a class="btn btn-primary " href="<?php echo base_url(); ?>settings/">Back</a>
            </div>
            <?php 
		foreach ($editdata as $val ) {
			
			
		?>
  <div class="edit_plan">
  	<h2> Edit Details below</h2>
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
      
      <select  id="FSource" name="FSource" >
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
    <label class="control-label" for="Quantityexp">Quantity Expected</label>
    <div class="controls">
      <input type="text"  id="Quantityexp" name="Quantityexp" value="<?php echo number_format($val['fp_quantity']);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Dateexp">Date Expected</label>
    <div class="controls">
      <input type="text" id="Dateexp" name="Dateexp" class="my_date" value="<?php echo date('F j, Y ', strtotime($val['fp_date']));?>">
    </div>
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
		$("#FSource").val(<?php echo $val['funding_id'];?>)
		
		$( ".my_date" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M, yy', 
			
		});
 });
  });
  </script>
