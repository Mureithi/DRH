<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>

<script>

		$(document).ready(function() {
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Stock Status'
            },
            xAxis: {
                categories: ['Male Condoms', 'Female Condoms', 'Injectables', 'COCs', 'POPs', 'EC Pills', 'IUCDs', '1-rod Implants', '2-rod Implants']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock Status'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Pending Consignment',
                data: [5, 3, 4, 7, 2,3,6,1,3,4]
            }, {
                name: 'Stock at Kemsa',
                data: [2, 2, 3, 2, 1,3,1,3,2,4]
            } ]
        });
    });
    

     });
    

	
</script>

<div id="container">
	
	</div>