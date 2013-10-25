<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/TableTools.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			@import "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/css/TableTools.css";
		</style>
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
  		<a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/Supply_plan">New Consignment</a>
      <!--   <a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/pending_psi">Pending PSI</a>
       <a class="btn btn-primary " href="<?php echo base_url(); ?>fp_management/Supply_plan_vs_actual">View Supply Plan Vs Actual</a>   -->   
            </div>
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
	<input class="span2 dateclass" type="text" placeholder="Date" id="datefrom" name="datefrom">
	<select  id="funding_source" name="funding_source" >
    <option value="0">Funding Source</option>
    <?php 
		foreach ($fundingsource as $fundingsource1) {
			$id=$fundingsource1->id;
			$source=$fundingsource1->funding_source;
			?>
			<option value="<?php echo $id;?>"><?php echo $source;?></option>
		<?php }
		?>
	</select> 
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#addfpcommodityModal" href="#">View Supply Plan Vs Actual</a>

	</h2>-->
<div id="table_filtered">
	
<table id="example" class="table table-hover table-bordered">
		
     	
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>FP Commodity</th>
		<th>Unit</th>
		<th>Funding Source</th>
		<th>E.T.A Details</th>
		<th>Quantity</th>
		<th>Status | Action</th>
		
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($supplyplan as $val ) {
			$id=$val['tr_id'];
			
		?>						
						<tr style="font-size: 12px">
							<td><?php echo $val['fp_name'];?></td>
							<td><?php echo $val['Unit'];?></td>
							<td><?php echo $val['funding_source'];?></td>
							<td><?php echo  date('F j, Y ', strtotime($val['fp_date']));?></td>
							<td><?php echo number_format($val['fp_quantity']);?></td>
							<td><?php if ($val['transaction_type']=='PENDINGKEMSA') {
								echo "<button class='btn btn-mini btn-warning'  >Pending</button>
								<button class='btn btn-mini btn-success Editable' id='$id'>Edit</button>";
							} elseif($val['transaction_type']=='INCOUNTRY') {
								echo "<button class='btn btn-mini btn-success' >Arrived Awaiting clearance</button>
								<button class='btn btn-mini btn-success Editable' id='$id' >Edit</button>";
							}elseif($val['transaction_type']=='DELAYED') {
								echo "<button class='btn btn-mini btn-danger'  >Delayed</button>'
								<button class='btn btn-mini btn-success Editable' id='$id'>Edit</button>";
							}elseif($val['transaction_type']=='RECEIVED') {
								echo "<button class='btn btn-mini btn-success'  >Received-In Store</button>'
								<button class='btn btn-mini btn-success disabled' id='$id'>Edit</button>";
							}
							 ?>
							</td>
							
					   </tr>
					   
				<?php }?>	 
						
		</tbody>
		
	 
</table>
</div>
  </div>

  <script>
  	$(document).ready(function() {
  		
  		
  		$('.Editable').attr('disabled');
  		$( ".dateclass" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});	
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
          data: { commoditychange: $("#commoditychange").val(),datefrom: $("#datefrom").val() ,funding_source: $("#funding_source").val()},
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
         	var trid=$(this).attr('id');
			window.location="<?php echo base_url();?>fp_management/edit_transaction/"+encodeURIComponent(trid);
		

				
		});
		
		
 });
  });
  </script>
