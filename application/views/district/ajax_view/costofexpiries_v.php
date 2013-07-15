

<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
     include("Scripts/FusionCharts/FusionCharts.php");
     $currentYear = date('Y');
     $earliestYear = $currentYear-4;
      ?>
      <table align="center">
      	<td><label for='expiriesselectedyear'>Select Year:</label></td>
      	<td><select name='expiriesselectedyear' id='expiriesselectedyear'>
		<?php
		for($x=$currentYear;$x>=$earliestYear;$x--){
		?>
		<option value='<?php echo $x;?>'
		<?php
		if ($x == $currentYear) {echo 'selected';
		}
		?>><?php echo $x;?></option>
		<?php }?>
		</select></td>
		</table>
      <?php
      echo renderChart("".base_url()."scripts/FusionCharts/Line.swf", "report_management/generate_costofexpiries_chart","", "f5", 700, 400, false, true);
      
      ?>
