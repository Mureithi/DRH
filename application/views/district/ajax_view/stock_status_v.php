

<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      //to help us easily embed the charts.
      
      include("Scripts/FusionCharts/FusionCharts.php");
	  
      
      echo renderChart("".base_url()."scripts/FusionCharts/Bar2D.swf", "report_management/get_stock_status", "", "chartdiv_test", "900", "2700", false, true);
      
      ?>
