<style>
	.contain_kemsa{
		width: 100%;
		height:280px;
		float:left;
	}
	
	.kemsa{
		
		width: 100%;
		height:20px;
		float:left;
		
	}
	
	.mos_kemsa{
		width: 48%;
		height:260px;
		float:left;
		margin:auto;
	}
	.mos_psi{
		width: 48%;
		height:260px;
		float:left;
		margin:auto;
	}
	
	
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
	
         $('.mos_kemsa').highcharts({
        	
            chart: {
            	height:250,
                type: 'bar'
            },
            title: {
                text: 'Stock Status of FP Commodities in Public Sector Pipeline (2013-2014)'
            },
            subtitle: {
                text: 'Source: DRH,KEMSA,NASCOP,UNFPA,KfW,USAID,DFID,LMU'
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
                name: 'Pending Stocks',
                data: <?php echo $array_finalpend ?>
            } ,{
                name: 'Actual Stocks',
                data: <?php echo $array_finalkemsa ?>
            }]
        	});
        
        });
	
</script>
<div class="contain_kemsa">
<div class="mos_kemsa">
	
</div>
<div class="mos_psi">
	
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
</div>