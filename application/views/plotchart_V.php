<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
<?php 
$fpcommodity=$this -> session -> userdata('commodity');
 //echo $fpcommodity; 
?>

<script>

		$(document).ready(function() {
	$(function () {
		
        $('#container').highcharts({
            chart: {
                type: 'column',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'FP Consumption By County',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: DHIS',
                x: -20
            },
            xAxis: {
                categories: <?php echo $arrayName ?> 
            },
            yAxis: {
                title: {
                    text: 'Consumption'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
           
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: $('#getcommodity').val(),
                data: <?php echo $arrayData ?>
            }]
        });
    });
    
	 });
	
</script>


<div id="container" style="min-width: 300em; height: 30em; margin: 0 auto"></div>

