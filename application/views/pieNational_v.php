<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>


<script>
	
	
	$(function () {
		$(document).ready(function() {
    	
    	
		
		
		// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'National Consumption Data by No of Clients/Commodity 2013'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+  Math.round(this.percentage*100)/100 +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'National Consumption Data by No of Clients/Commodity',
                data: [
                   	<?php echo $arraycommodity1 ?>,
                    <?php echo $arraycommodity2 ?>,
                    <?php echo $arraycommodity3 ?>,
                    <?php echo $arraycommodity4 ?>,
                    <?php echo $arraycommodity5 ?>,
                    <?php echo $arraycommodity6 ?>,
                    <?php echo $arraycommodity7 ?>,
                    <?php echo $arraycommodity8 ?>,
                    <?php echo $arraycommodity9 ?>,
                    <?php echo $arraycommodity10 ?>,
                    <?php echo $arraycommodity11 ?>,
                    <?php echo $arraycommodity12 ?>
                ]
            }]
        });
    });
    
    
    });
    

	
</script>
<div id="container" style="min-width: 100em; height: 60em; margin: 0 auto">
	
	
</div>