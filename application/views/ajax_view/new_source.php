<style>
	#newfp h2 {
		background: #a6b1ca; /* Old browsers */
		color: #fff;
		padding: 9px;
		margin: 0 0 0.625em 0;
		text-align:left;
		
	}
</style>
<script>
	$(document).ready(function() {
	$(function() {
		$( ".dateclass" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});	
		});
  });
</script>
<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('settings/add_source',$att); ?>
<div id="newfp" class="form-horizontal"  >
	<h2> New Source</h2>
	
	<div class="control-group">
    <label class="control-label" for="Commodity">Source name</label>
    <div class="controls">
      <input type="text"  id="Source" name="Source" value="" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="procuring_a">Procuring Agency</label>
    <div class="controls">
      <select id="procuring_a" name="procuring_a">
    	<option value="0">Procuring Agency</option>
    	<option value="1">Yes</option>
    	<option value="2">No</option>
    	
    </select>
    </div>
  </div>
  
    <div class="control-group">
    <label class="control-label" for="Description">Date as of</label>
    <div class="controls">
      <input type="text" class="span dateclass " id="dateas_of" name="dateas_of" value="" >
    </div>
  </div>
    
   <div class="form-actions">
  <button type="submit" class="btn btn-primary">Submit</button>
  
</div>  
</div>
<?php 
echo form_close();
?>