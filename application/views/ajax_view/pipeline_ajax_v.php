<script>
	$(function() {
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSLine.swf"?>", "ChartId", "100%", "100%", "0", "0");
		var url = '<?php echo base_url()."Stocks_management/pipeline_chart1"?>'; 
		chart.setDataURL(url);
		chart.render("chart1");
	});
	</script>
<div id="chart-area" >
	<div id="chart1" style="width: 100%; height: 100%" >
		
	</div>
</div>

