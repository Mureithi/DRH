<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/TableTools.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			@import "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/css/TableTools.css";
		</style>
		<style>

			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
	</style>	
<div class="edit_plan">
  	<!--<h2>
		
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
	<select  id="financeyear" name="financeyear" >
    <option value="0">Select Fiscal Year</option>
    <option value="2013-2014">2013-2014</option>
    <option value="2012-2013">2012-2013</option>
    <option value="2011-2012">2012-2011</option>
		
	</select> 
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply Plan Vs Actual</a>

	</h2>-->
	
<div id="table_filtered">
	
<table id="example" class="table table-hover table-bordered">
		
     	
		<thead style="font-size: 13px; background: #C8D2E4 ">
			<th colspan="7">
			* P.M.C - Projected Monthly Consumption
			<button class="btn btn-small btn-success" id="filter" style="margin-left: 70%" name="filter" >New FP <i class="icon-plus"></i></button>
		</th>
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Description</th>
		<th >P.M.C*- KEMSA</th>
		<th >P.M.C*- PSI</th>
		<th >Date</th>
		<th >Action  </th>
		
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($fpcommodity as $val ) {
			
			
		?>						
						<tr style="font-size: 12px">
							<td><?php echo $val->fp_name;?></td>
							<td><?php echo $val->unit;?></td>
							<td><?php echo $val->description;?></td>
							<td><?php echo  $val->projected_monthly_c;?></td>
							<td><?php echo  $val->projected_psi;?></td>
							<td><?php echo  date('F j, Y ', strtotime($val->as_of));?></td>
								<td><button class="btn btn-mini btn-success Editable" id="<?php echo $val->id;?>" value="" >Edit <i class="icon-edit"></i></button>|
								<button class="btn btn-mini btn-danger delete" id="<?php echo $val->id;?>" value="" >Delete <i class="icon-remove-sign"></i></button>
							</td>
							
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
		var url = "<?php echo base_url()."Fp_management/supply_plan_filter"?>";		
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
          data: { commoditychange: $("#commoditychange").val(),financeyear: $("#financeyear").val() },
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
jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
			
			$(document).ready(function() {
				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
			 "bSort": false,
					"bJQueryUI": true,
                   "bPaginate": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
			"sSwfPath": "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/swf/copy_cvs_xls_pdf.swf"
		}
				} );
			} );
 	 $('.Editable').click(function() {
          alert("You are about to edit this field,Proceed?");
         	var fpid=$(this).attr('id');
			window.location="<?php echo base_url();?>settings/edit_fptransaction/"+encodeURIComponent(fpid);
		
		});
		
		$('.delete').click(function() {
          alert("You are about to edit this field,Proceed?");
         	var fpid=$(this).attr('id');
			window.location="<?php echo base_url();?>settings/delete_fptransaction/"+encodeURIComponent(fpid);
		
		});
		
		
 });
  });
  </script>
