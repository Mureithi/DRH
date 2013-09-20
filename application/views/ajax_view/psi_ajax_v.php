<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>
	.mos_psi{
		
		width: 48%;
		height:270px;
		float:left;
	
</style>
<script>
	$(document).ready(function() {
	
	  $('.mos_psi').highcharts({
        	colors: [
		'#8bbc21',
		'#910000'
		],
            chart: {
            	height:250,
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Private Sector Pipeline (2013-2014)'
            },plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            xAxis: {
                categories: <?php echo $arrayfpname ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Months of stock(MOS)'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
          credits: {
		enabled: false
		},
                series: [{
                name: 'Stores MOS',
                data: <?php echo $array_finalpsi ?>
            } ]
        	});
        });
       
    
	
</script>

<div class="mos_psi"></div>

