 <?php
$current_year = date('Y');
$earliest_year = $current_year - 4;
$current_month = date('n');

$montharray = array(1 => 'January',  2 => 'February',  3 => 'March',  4 => 'April',  5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');


?>
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
  		<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management">Back</a>
            </div>
  <div class="edit_plan">
  	<h2>
		<select name="month" id="month">
			<option>Select Month</option>
		<?php 
		for ($i=1; $i < 12 ; ) { 
			
		foreach ($montharray as $key => $val) {
			
			$year=$montharray[$key];
			
			?>
			<option value="<?php echo $i;?>"><?php echo $year;?></option>
			
		<?php $i++;}
		}
		?>
		</select>
		 
		<select name="year_from" id="year_from">
			<option>Select Year</option>
			<?php
		for($x=$current_year;$x>=$earliest_year;$x--){
			?>
			<option value="<?php echo $x;?>"
			<?php
			if ($x == $current_year) {echo "selected";
			}
			?>><?php echo $x;?></option>
			<?php }?>
		</select>
		<select name="store" id="store">
			<option>Select Store</option>
			<option value="SOHKEMSA">KEMSA</option>
			<option value="SOHPSI">PSI</option>
			
		</select>
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply  Plan Vs Actual</a>-->

	</h2>
<div id="table_filtered">
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
		<th>Actual SOH</th>
		<th>SOH in M.O.S</th>
		<th>Projected Consumption</th>
		<th>Date as of</th>
		<th>Status</th>
		
	</tr>
	</thead>
	<tbody>	<?php 
					if ($mycount==0) {
						echo "<tr><td colspan='7' style='font-size: 14px; text-align:center;'> No data available for this Month/Year</td></tr>";
							
						} ?>
						
						<?php 
	
		foreach ($kemsa_psi as  $value) {
			
		
		?>
		
					
						<tr style="font-size: 12px">
							
							<td><?php echo $value['fp_name'];?></td>
							<td><?php echo $value['Unit'];?></td>
							<td><?php echo number_format($value['fp_quantity']);?></td>
							<td><?php echo $value['sohkemsa'];?></td>
							<td><?php echo number_format($value['projected_monthly_c']);?></td>
							<td><?php echo date('F j, Y ',strtotime($value['fp_date'])); ;?></td>
							<td><?php if ($value['transaction_type']=='SOHKEMSA') {
								echo '<button class="btn btn-mini btn-success" id="" name="" >SOHKEMSA</button>';
							} elseif($value['transaction_type']=='SOHPSI') {
								echo '<button class="btn btn-mini btn-info" id="" name="" >SOHPSI</button>';
							}
							 ?></td>
					   </tr>
					   
					<?php }?>	
		</tbody>
		
			
	 
</table>
</div>
  </div>

  <script>
  	$(document).ready(function() {
	$(function() {
  	 $('#filter').click(function() {
  	 	
         var div="#table_filtered";
		var url = "<?php echo base_url()."Fp_management/soh_filtered"?>";		
		//url=url+"/"+$("#commoditychange").val();
		//alert($("#financeyear").val());
		
				ajax_request (url,div);
		
				
		});
		
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          data: { year_from: $("#year_from").val(),store: $("#store").val(),month: $("#month").val() },
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-left:45%;margin-top:10%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
            $(div).html(msg);           
          }
        });
         
}

 	$('.Editable').click(function() {
          alert("You are about to edit this field,Proceed?");
         	var trid=$(this).attr('id');
			window.location="<?php echo base_url();?>fp_management/edit_transaction/"+encodeURIComponent(trid);
		

				
		});
		
		
 });
  });
  </script>


  
  
