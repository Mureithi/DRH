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
                text: 'Stock Status in Private Sector Pipeline As at end of <?php echo  date('F , Y ', strtotime($graphtext1)) ?> '
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
                name: 'Pending MOS(PSI)',
                pointWidth: 9,
                data: <?php echo $array_finalpend ?>
            },{
                name: 'Actual MOS(PSI)',
                 pointWidth: 9,
                data: <?php echo $array_finalpsi ?>
            }  ]
        	
				});
        
        });
	
</script>

<div id="mos_psi"></div>

