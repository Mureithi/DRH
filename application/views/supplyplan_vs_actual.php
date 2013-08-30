<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
<style>
	
	.sub-menu{
		width:70%;
		margin-left:2em;
		margin-bottom:1em;
		
	}
	.graph{
		width:80%;
		margin:auto;
		margin-bottom:1em;
	}
	.graph_filter h2 {
		background: #29527b; /* Old browsers */
		color: #fff;
		padding: 8px;
		margin: 0 0 0.625em 0;
		-webkit-box-shadow:  0px 2px 6px 0.7px #000;
        box-shadow:  0px 2px 6px 0.7px #000;
        -moz-box-shadow:  0px 2px 6px 0.7px #000;
	}
</style>
<script>
$(document).ready(function() {
	
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'scatter',
                zoomType: 'xy'
            },
            title: {
                text: 'Actual Plan Vs Supply plan'
            },
            subtitle: {
                text: 'Source: DRH,KEMSA,NASCOP,UNFP'
            },
            xAxis: {
                title: {
                    enabled: true,
                    text: 'Time (Month)'
                },
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true
            },
            yAxis: {
                title: {
                    text: 'Months of stock (M.O.S)'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                backgroundColor: '#FFFFFF',
                borderWidth: 1
            },
            plotOptions: {
                scatter: {
                    marker: {
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true,
                                lineColor: 'rgb(100,100,100)'
                            }
                        }
                    },
                    states: {
                        hover: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{series.name}</b><br>',
                        pointFormat: '{point.x} date, {point.y} Mos'
                    }
                }
            },
            series: [{
                name: 'Supply Plan',
                color: '#910000',  		
                data: [['July', 5.6], ['Aug', 5.0], ['Sept', 4.2], ['Oct', 7.0], ['Nov', 6.6],
                    ['Dec', 9.0], ['Jan', 7.6], ['Feb', 9.8], ['March', 6.8], ['April', 5.2],['May', 9.0],['June', 5.0]
                    ]
    
            }, {
                name: 'Actual Plan',
                color: '#8bbc21',
                data: [['July', 5.6], ['Aug', 4.8], ['Sept', 2.7], ['Oct', 5.6], ['Nov', 6.2],
                    ['Dec', 7.8], ['Jan', 6.4], ['Feb', 7.4], ['March', 6.71], ['April', 5.1],['May', 7.4],['June', 5.0]
                ]
            }]
        });
    });
    
     });
    

</script>
<div class="sub-menu">

    <a class="btn btn-primary " href="<?php echo base_url(); ?>stocks_management/editSupply_plan">Edit Supply Plan</a>   
                          
            </div>
            <div class="graph">
            <div class="graph_filter">
            	<h2>
		
		<select  id="commoditychange" name="commoditychange" >
    <option>Select Commodity</option>
		<?php 
		foreach ($fpcommodity as $fpcommodity1) {
			$id=$fpcommodity1->id;
			$commodity=$fpcommodity1->fp_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $commodity;?></option>
		<?php }
		?>
	</select> 
	<select  id="commoditychange" name="commoditychange" >
    <option value="0">Select Fiscal Year</option>
    <option value="2013-2014">2013-2014</option>
    <option value="2012-2013">2012-2013</option>
    <option value="2011-2012">2012-2011</option>
		
	</select> 
	<button class="btn btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	

	</h2>
            </div>
<div id="container">
	
</div>
</div>