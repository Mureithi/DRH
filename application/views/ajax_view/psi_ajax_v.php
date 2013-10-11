<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>
	#mos_psi{
		
		width: 100%;
		height:270px;
		float:left;
	
</style>

<script>

var chart;
	$(document).ready(function() {	
	
        
         var mos_psi = new Highcharts.Chart({
		chart: {
				renderTo: 'mos_psi',
						
						type: 'bar',
						height: 250
						
					},
					title: {
                text: 'Stock Status of FP Commodities in Private Sector Pipeline '
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

<div id="mos_psi"></div>

