  <style>
	.edit_plan{
		margin:auto;
		width:80%;
		height: auto;
	}
	.edit_plan h2 {
		background: #29527b; /* Old browsers */
		color: #fff;
		padding: 8px;
		margin: 0 0 0.625em 0;
		-webkit-box-shadow:  0px 2px 6px 0.7px #000;
        box-shadow:  0px 2px 6px 0.7px #000;
        -moz-box-shadow:  0px 2px 6px 0.7px #000;
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
        <a class="btn btn-primary " href="<?php echo base_url(); ?>stocks_management/Supply_plan_vs_actual">View Supply Plan Vs Actual</a>      
            </div>
  <div class="edit_plan">

<table class="table table-hover table-bordered">
		
     	<h2>
		
		<select  id="commoditychange" name="commoditychange" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity1) {
			$id=$fpcommodity1->id;
			$commodity=$fpcommodity1->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity;?></option>
		<?php }
		?>
	</select> 
	<select  id="commoditychange" name="commoditychange" >
    <option value="0">Select Fiscal Year</option>
    <option value="2013-2014">2013-2014</option>
    <option value="2012-2013">2012-2013</option>
    <option value="2011-2012">2012-2011</option>
		
	</select> 
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply Plan Vs Actual</a>

	</h2>
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Quantity</th>
		<th>Action</th>
		
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
							<td><?php echo number_format($value['pending']);?></td>
							<td><button class="btn btn-success" id="" name="" >Edit</button><input type="hidden" value="<?php echo $value['tr_id'];?>" /></td>
							
					   </tr>
					   
					   <?php }?>
						
		</tbody>
		
			
	 
</table>
  </div>

  
