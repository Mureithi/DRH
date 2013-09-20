<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<script>
$(document).ready(function() {
	
	
	
	    $('#content').highcharts({
              title: {
                text: 'Supply Plan Vs Actual M.O.S for <?php echo $commodityname ?> & <?php echo $commodityname2 ?>',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: DRH',
                x: -20
            },
            xAxis: {
                categories: <?php echo $montharray ?>
            },
            yAxis: {
            	 
                title: {
                    text: 'Months of Stock (MOS)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: 'MOS',
                crosshairs: true,
                shared: true
            },credits: {
		enabled: false
		},
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [ {
                name: 'Supply Plan (<?php echo $commodityname2 ?>)',
                data: <?php echo $arrayto_graph ?>
            }, {
                name: 'Actual MOS (<?php echo $commodityname2 ?>)',
                data: <?php echo $arrayactual ?>
            },
            {
                name: 'Supply Plan (<?php echo $commodityname ?>)',
                data: <?php echo $arrayto_graph2 ?>
            }, {
                name: 'Actual MOS (<?php echo $commodityname ?>)',
                data: <?php echo $arrayactual2 ?>
            }]
       		 });
       
     });
     
</script>
<div id="content" style="height: 300px">
	
</div>