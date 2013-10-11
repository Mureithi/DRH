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
	 echo form_open('settings/update_soh',$att); ?>
  <div class="sub-menu">
  		<a class="btn btn-primary " href="<?php echo base_url(); ?>settings/">Back</a>
            </div>
            <?php 
		foreach ($soh as $val ) {
			
			
		?>
  <div class="edit_plan">
  	<h2> Edit Details below</h2>
  	<div class="form-horizontal" style=" margin-left:24%; ">
  <div class="control-group" style=" margin-top:2em; ">
    <label class="control-label" for="FpCommodity">Fp Commodity</label>
    
    		<div class="controls controls-row" id="" >
				 <input class="span2 " readonly="readonly" type="text" id="fp_name" name="fp_name"  value="<?php echo $val['fp_name'];?>">
				 <input readonly="readonly" type="hidden" id="trid" name="trid"  value="<?php echo $val['id'];?>">
             <input type="text"  id="fpcommodityid" readonly="readonly" name="fpcommodityid" value="<?php echo $val['Unit'];?>">
            </div>
  </div>
 
  <div class="control-group">
    <label class="control-label" for="Quantity">Quantity Available</label>
    <div class="controls">
      
      <input type="text"  id="Quantity" name="Quantity" value="<?php echo $val['fp_quantity'];?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="Store">Store</label>
    <div class="controls">
      <input type="text" id="Store" name="Store" class="" value="<?php if ($val['transaction_type']=='SOHKEMSA') {
								echo 'KEMSA';
							} elseif($val['transaction_type']=='SOHPSI') {
								echo 'PSI';
							}
							 ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_of">Date as Of</label>
    <div class="controls">
      <input type="text" id="Date_of" name="Date_of" class="my_date" value="<?php echo  date('F j Y ', strtotime($val['fp_date']));?>">
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
