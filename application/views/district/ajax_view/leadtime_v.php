

<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
    include("Scripts/FusionCharts/FusionCharts.php");
    $currentYear = date('Y');
    $earliestYear = $currentYear-4;
      ?>
      <!-- An attempt at formatting the comboboxes in the same style as moh dash_board -->
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
    <style>
    .ui-combobox {
        position: relative;
        display: inline-block;
        margin-left: 100px;
    }
    .ui-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        /* adjust styles for IE 6/7 */
        *height: 1.7em;
        *top: 0.1em;
    }
    .ui-combobox-input {
        margin: 0;
        padding: 0.3em;
    }
    </style>

<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js">
$().ready(function(){
		 $( "#leadselectedyear" ).combobox({
        selected: function(event, ui) {
        		
         var data =$("#leadselectedyear").val();
         var name =encodeURI($("#leadselectedyear option:selected").text());
          
        var url = "<?php echo base_url().'report_management/get_leadtime_chart_ajax' ?>"
        $.ajax({
          type: "POST",
          data: "ajax="+name+"&id="+data,
          url: url,
          beforeSend: function() {
            $("#content").html("");
          },
          success: function(msg) {
          	alert(msg);
            $("#content").html(msg);
           
          }
        });
        return false;
            
			}
			});
});
</SCRIPT>
<table align="center">
      	<td valign="bottom"><label for='leadselectedyear'>Select Year:</label></td>
      	<td><select name='leadselectedyear' id='leadselectedyear'>
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
echo renderChart("".base_url()."scripts/FusionCharts/ScrollStackedColumn2D.swf", "report_management/generate_leadtime_chart", "", "f1", 700, 400, false, true); 
      ?>

<!-- 
<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
   /*   include("Scripts/FusionCharts/FusionCharts.php");
      $drugs = Drug::getAll();
      $strFormat = "<select id='desc' name='desc'>
    <option>----Type Commodity Name-</option>
		<?php 
		$drugs = Drug::getAll();
		foreach ($drugs as $drugs0) {
			$id=$drugs0->id;
			$drug=$drugs0->Drug_Name;
			?>
			<option value='<?php echo $id?>''><?php echo $drug;?></option>
		<?php }
		?>
	</select>";
      
      $strFormat.=' renderChart("".base_url()."scripts/FusionCharts/ScrollStackedColumn2D.swf", "report_management/generate_leadtime_chart", "", "f1", 700, 400, false, true);';
      echo $strFormat;*/
      
      ?> -->

