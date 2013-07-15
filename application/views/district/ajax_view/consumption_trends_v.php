<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      include("Scripts/FusionCharts/FusionCharts.php");
      echo renderChart("".base_url()."scripts/FusionCharts/MSLine.swf", "report_management/consumption_trends", "", "chartdiv_test", "900", "400", false, false);
      
      ?>
