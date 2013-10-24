<style>
	.addnewcons{
		margin:auto;
		padding:0.5em;
	}
	
</style>
<script>
	$(document).ready(function() {
    $('.btnDel').attr('disabled',($('.clonedtr').length  < 2));
    var inputs = 1; 
    
    $('#btnAdd').click(function() {
    	 $('.btnDel:disabled').removeAttr('disabled');
        var c = $('.clonedtr:first').clone(true);
         c.find("input").val("");
        c.children(':text').attr('id','input'+ (++inputs) ).val('');
        c.children(':button').attr('id','btnDelete'+ (inputs) );
    	$('.clonedtr:last').after(c);
    	   	refreshDatePickers();
    	
});

    
    $('.btnDel').click(function() {
        if (confirm('Sure you want to continue delete?')) {
            --inputs;
            $(this).closest('.clonedtr').remove();
            $('.btnDel').attr('disabled',($('.clonedtr').length  < 2));
        }
    });
    
    $( ".my_date" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});
		
	function refreshDatePickers() {
		var counter = 0;
		$('.my_date').each(function() {
			var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy',
				}); // re-init datepicker
				counter++;
		});
		
		
  }

    
    
});


</script>
 <?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('Fp_management/new_psi_pending',$att); ?>
<div class="addnewcons"  >
     
  
  	
    	<table class="table table-hover table-bordered">
		<thead style="font-weight:bold; background: #fefefd;font-size: 13px; ">
			<tr>
				
				
			</tr>
		</thead>
		<thead style="font-size: 13px; background: #C8D2E4 ">
	<tr>
		<th>FP Commodity</th>		
		<th>E.T.A Details</th>
		<th>Quantity</th>
		<th>Date as of</th>
		<th rowspan="2" >+/-</th>
		<th></th>
		
	</tr>
	</thead>
	<tbody>	
					
						<tr class="clonedtr" style="font-size: 12px">
							<td><select  id="pipecommodity[]" name="pipecommodity[]" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity2) {
			$id=$fpcommodity2->id;
			$commodity2=$fpcommodity2->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity2;?></option>
		<?php }
		?>
	</select> </td>
							
							
							<td><input type="text" id="etadetails" name="etadetails[]" class="my_date" placeholder="Date"></td>
							<td><input type="text" id="quantity[]" name="quantity[]" placeholder="Quantity"></td>
							<td><input type="text" id="as_of[]" name="as_of[]" placeholder="Date as of" class="my_date"></td>
							<td><a class="btn btn-mini " href="#" id="btnAdd">+</a></td>
							<td><a class="btn btn-primary btn-mini btnDel " href="#">-</a></td>

							
							
					   </tr>
		</tbody>
	 
</table>
    </div>   
  <div class="modal-footer">
    <button class="btn">Cancel</button>
    <button class="btn btn-primary" id="" name="">Submit</button>
  </div>
<?php 
echo form_close();
?>

