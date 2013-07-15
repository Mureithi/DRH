

<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
     include("Scripts/FusionCharts/FusionCharts.php");
     $currentYear = date('Y');
     $earliestYear = $currentYear-4;
      ?>
      <table align="center">
      	<td><label for='ordersselectedyear'>Select Time Period:</label></td>
      	<td><select name='ordersselectedyear' id='ordersselectedyear'>
		<?php
		for($x=$currentYear;$x>=$earliestYear;$x--){
		?>
		<option id='orderselectedyearval' value='<?php echo $x;?>'
		<?php
		if ($x == $currentYear) {echo 'selected';
		}
		?>><?php echo $x-1 .' to '. $x;?></option>
		<?php }?>
		</select></td>
		</table>
      <?php echo renderChart("".base_url()."scripts/FusionCharts/Line.swf", "report_management/generate_costofordered_chart", "", "f1", 700, 400, false, true);

      ?>