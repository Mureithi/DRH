<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
<?php $current_year = date('Y');
$earliest_year = $current_year - 10;
?>
		<script type="text/javascript" charset="utf-8">
		
		
			/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
			
			$(document).ready(function() {
				
				
				$( "#dialog1" ).dialog({
			height: 140,
			modal: true
		});
	
				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
					"bJQueryUI": true,
					"aaSorting": [ [7,'desc'], [0,'desc'] ],
					"aoColumnDefs": [
						{ "sType": 'string-case', "aTargets": [ 2 ] }
					]
				} );
			} );
		</script> 
		
<?php if(isset($msg)): ?>
<div id="dialog1">    
<?php echo $msg;?>
</div>
<?php endif;  unset($msg);?>
	<?php if(count($order_list)>0) :?>
<div id="notification">Balance=(Intital Drawing rights-Order Value)</div>
<table width="100%" id="example">
	<thead>
	<tr>
		<th>Order Number</th>
		<th>Kemsa Order No.</th>
		<th>MFL Code</th>
		<th>Facility Name</th>
		<th>Intital Drawing Rights</th>
		<th>Order Value</th>
		<th>Balance</th>
		<th>Order Date</th>
		<th>Order Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($order_list as $rows){
	   $total=$rows->orderTotal;
	   $rights=$rows->drawing_rights;
	   $bal=$rights-$total;
?>
	<tr>
		<td><?php echo $rows->id;?></td>
		<td><?php echo $rows->kemsaOrderid;?></td>
		<td><?php echo $rows->facilityCode;?></td>
		<td><?php foreach($rows->Code as $facility)
		$name=$facility->facility_name;
		 echo $name ;?></td>
		<td><?php echo  number_format($rights, 2, '.', ',');?></td>
		<td><?php echo  number_format($total, 2, '.', ',') ;?></td>
		<td><?php echo  number_format($bal, 2, '.', ',');?></td>
		<td><?php 
		$datea= $rows->orderDate;
		$fechaa = new DateTime($datea);
        $datea= $fechaa->format(' d M Y');
		echo $datea;?></td>
		<td><?php
		$order_status=$rows->orderStatus;
		 echo $order_status;?></td>
		
		<td><a href="<?php 
		if($order_status=="Pending"){
			echo site_url('order_approval/district_order_details/'.$rows->id.'/'.$rows->facilityCode);
		}else{
			echo site_url('order_management/moh_order_details/'.$rows->id.'/'.$rows->kemsaOrderid);
		}
		
		?>"class="link">View</a></td>
	</tr> 
	<?php
		}
	?>
	</tbody>
</table>
<?php 
else :
	echo '<p id="notification">No Records Found </p>';
endif; ?>
