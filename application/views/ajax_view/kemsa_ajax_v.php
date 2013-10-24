<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
<style>
	
	.kemsa{
		
		width: 100%;
		height:20px;
		float:left;
		
	}
	
	#mos_kemsa{
		width: 100%;
		height:260px;
		float:left;
		margin:auto;
	}
		
</style>
<script>

var chart;
	$(document).ready(function() {	
	
        
         var mos_kemsa = new Highcharts.Chart({
		chart: {
				renderTo: 'mos_kemsa',
						
						type: 'bar',
						height: 250
						
						
					},
					title: {
                text: 'Stock Status in Public Sector Pipeline As at end of <?php echo  date('F , Y ', strtotime($graphtext1)) ?> & <?php echo date('F , Y ', strtotime($graphtext2)) ?>'
            },
            subtitle: {
                text: 'Source: DRH,KEMSA,NASCOP,UNFPA,KfW,USAID,DFID,LMU',
                
            },
            xAxis: [{
                categories: <?php echo $arrayfpname ?>
            }],
            yAxis: {
                min: 0,
                title: {
                    text: 'Months of stock(MOS)'
                }
            },plotOptions: {
                series: {
                    stacking: 'normal'
                },
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
                name: 'Pending Stocks',
                 pointWidth: 9,
                data: <?php echo $array_finalpend ?>
            } ,{
                name: 'Actual Stocks',
                 pointWidth: 9,
                data: <?php echo $array_finalkemsa ?>
            }]
				});
        
        });
	
</script>

<div id="mos_kemsa">
	
</div>

<div class="kemsa">
	<div style="float: left;margin-left: 25%;">
	<div style="display: table-row;  ">
    			<div style="display: table-cell; ">
      				<label style=" font-weight: ">Central Level Min </label>
            			    				</div>
    				
    				<div style="display: table-cell;">
      				<a class="badge important" style="display: margin-right:2em;" href="" > 16</a>
    				</div>
    				
  				</div>
  				</div>
  				
  				<div style="float: left;margin-left: 2em;">
  					<div style="display: table-row;  ">
    			<div style="display: table-cell; ">
      				<label style=" font-weight: ">Central Level Max </label>
            			    				</div>
    				
    				<div style="display: table-cell;">
      				<a class="badge success" style="display: margin-right:2em;" href="" > 22</a>
    				</div>
    				
  				</div>
  				</div>
</div>
