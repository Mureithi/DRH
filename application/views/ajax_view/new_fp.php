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
	 echo form_open('settings/add_commodity',$att); ?>
<div id="newfp" class="form-horizontal"  >
	<h2> New FP</br> *P.M.C - Projected Monthly Consumption</h2>
	
	<div class="control-group">
    <label class="control-label" for="Commodity">Commodity name</label>
    <div class="controls">
      <input type="text"  id="Commodity" name="Commodity" value="" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Description">Description</label>
    <div class="controls">
      <input type="text"  id="Description" name="Description" value="" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="unitsize">Unit size</label>
    <div class="controls">
      <select id="unitsize" name="unitsize">
    	<option value="">Select Unit Size</option>
    	<option value="Cycles">Cycles</option>
    	<option value="Doses">Doses</option>
    	<option value="Pieces">Pieces</option>
    	<option value="Sets">Sets</option>
    	<option value="Vials">Vials</option>
    </select>
    </div>
  </div>
   <div class="controls controls-row" style="margin-top:1em; margin-bottom:1em; " id="pmckemsa">
   	
              <input class="span3 " type="number" placeholder="P.M.C KEMSA" id="pmckemsa" name="pmckemsa">
              <input class="span3 " type="number" placeholder="P.M.C PSI" id="pmcpsi" name="pmcpsi">
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