<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<style>
	.mos_psi{
		
		width: 48%;
		height:280px;
		float:left;
		
		
	}
	.mos_kemsa{
		
		width: 48%;
		height:280px;
		float:left;
		
		
	}
	
</style>
<script>
	$(document).ready(function() {
	
	$('.mos_kemsa').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Public Sector Pipeline (2013-2014) '
            },
            xAxis: {
                categories: <?php echo $arrayfpname ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Months of Stock '
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            credits: {
		enabled: false
		},
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Pending Consignment',
                data: <?php echo $array_finalpend ?>
            }, {
                name: 'Actual Stocks',
                data: <?php echo $array_finalkemsa ?>
            }]
        });
        
        $('.mos_psi').highcharts({
        	colors: [
		'#8bbc21',
		'#910000'
		],
            chart: {
            	height:280,
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Private Sector Pipeline (2013-2014)'
            },
            xAxis: {
                categories: <?php echo $arrayfpname ?>
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock Status PSI in(MOS)'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                },
                
            },credits: {
		enabled: false
		},
                series: [{
                name: 'Stores MOS',
                data: <?php echo $array_finalpsi ?>
            } ]
        	});
        });
       
    
	
</script>

<div class="mos_kemsa"></div>
<div class="mos_psi"></div>