<?php $facility=$this -> session -> userdata('news');?>
<style>

#user_panel{
	float:left;
	width:82%;
	
	
}
	
</style>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			.dataTables_wrapper .ui-toolbar{
    width: 90%;
    margin:0px auto;
}
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
				$('.editlink').click(function() { 
				dbaseid=$(this).attr("value");
				alert(dbaseid);
				console.log(dbaseid);
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
		
<div id="user_panel">
	
		<table width="90%" id="example" class="data-table">
	<thead>
	<tr>
		<th>First Name </th>
		<th>Other Name</th>
		<th>Email/Username</th>
		<th>Telephone</th>
		<th>Status</th>
		<th>xx</th>
		<th>Actions</th>
		
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($result as $row){
	   
?>
	<tr>
		<td><?php echo $row->fname;?></td>
		<td><?php echo $row->lname;?></td>
		<td><?php echo $row->email;?></td>
		<td><?php echo $row->telephone ?></td>
		<td><?php if ($row->status==1) {
			echo 'Active';
		} else {
			echo 'Inactive';
		}
		 ?></td>
		
		<td><?php ?></td>
		<td value="<?php echo $row->id ?>" class="editlink"><a href="#"  >Edit</td>
		
		
	</tr> 
	<?php
		}
	?>
	</tbody>
</table>
 	

