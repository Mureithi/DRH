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
	 echo form_open('settings/update_fptransaction',$att); ?>
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
              <select  id="fpcommodity" name="fpcommodity" class="span2" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity) {
			$id=$fpcommodity->id;
			$commodity=$fpcommodity->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity;?></option>
		<?php }
		?>
				</select>
				 <input class="span2" type="text" id="unit" name="unit"  value="<?php echo $val->unit;?>">
             <input type="hidden"  id="fpcommodityid" name="fpcommodityid" value="<?php echo $val->id;?>">
            </div>
  </div>
 
  <div class="control-group">
    <label class="control-label" for="Description">Description</label>
    <div class="controls">
      
      <input type="text"  id="Description" name="Description" value="<?php echo $val->description;?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="KEMSA">P.M.C- KEMSA</label>
    <div class="controls">
      <input type="text" id="KEMSA" name="KEMSA" class="" value="<?php echo $val->projected_monthly_c;?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="PSI">P.M.C- PSI</label>
    <div class="controls">
      <input type="text" id="PSI" name="PSI" class="" value="<?php echo $val->projected_psi;?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_of">Date as Of</label>
    <div class="controls">
      <input type="text" id="Date_of" name="Date_of" class="my_date" value="<?php echo  date('F j Y ', strtotime($val->as_of));?>">
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
	var id=$("#fpcommodityid").val();
		$("#fpcommodity").val(id);
		$('#fpcommodity').attr("disabled", true);
		$( ".my_date" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});
 });
  });
  </script>
