<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
<script>

$(function () {
    
        var colors = Highcharts.getOptions().colors,
            categories = <?php echo $arrayName ?> ,//county[1]
            name = 'Browser brands',
            data = [{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'FP Injections',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: <?php echo $arrayseries1 ?>,//district data
                        color: colors[0]
                    }
                }, {
                    y: 21.63,
                    color: colors[1],
                    drilldown: {
                        name: 'Pills Microlut',
                        categories: <?php echo $arrayN ?>,
                        data: <?php echo $arrayseries2 ?>,
                        color: colors[1]
                    }
                }, {
                    y: 11.94,
                    color: colors[2],
                    drilldown: {
                        name: 'Pills Microgynon',
                        categories: <?php echo $arrayN ?>,
                        data: <?php echo $arrayseries3 ?>,
                        color: colors[2]
                    }
                }, {
                    y: 7.15,
                    color: colors[3],
                    drilldown: {
                        name: 'IUCD insertion',
                        categories: <?php echo $arrayN ?>,
                        data: [4.55, 1.42, 0.23, 0.21, 0.20, 0.19, 0.14],
                        color: colors[3]
                    }
                }, {
                    y: 2.14,
                    color: colors[4],
                    drilldown: {
                        name: 'IUCD Removals',
                        categories: <?php echo $arrayN ?>,
                        data: [ 0.12, 0.37, 1.65],
                        color: colors[4]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'Implants insertion',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'Implants Removal',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'Sterilization BTL',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'Sterilize Vasectomy',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'NFP',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'All others FP',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'Clints condom',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories:<?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },
                {
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories:<?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                },{
                    y: 55.11,//total of district array
                    color: colors[0],
                    drilldown: {
                        name: 'MSIE versions',//FP commodity name
                        categories: <?php echo $arrayN ?>,//districts
                        data: [10.85, 7.35, 33.06, 2.81],//district data
                        color: colors[0]
                    }
                }];
    
        function setChart(name, categories, data, color) {
			chart.xAxis[0].setCategories(categories, false);
			chart.series[0].remove(false);
			chart.addSeries({
				name: name,
				data: data,
				color: color || 'white'
			}, false);
			chart.redraw();
        }
    
        var chart = $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Browser market share, April, 2011'
            },
            subtitle: {
                text: 'Click the columns to view versions. Click again to view brands.'
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
                                } else { // restore
                                    setChart(name, categories, data);
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = this.x +':<b>'+ this.y +'% market share</b><br/>';
                    if (point.drilldown) {
                        s += 'Click to view '+ point.category +' versions';
                    } else {
                        s += 'Click to return to browser brands';
                    }
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: false
            }
        })
        .highcharts(); // return chart
    });
    
    </script>
    
    <div id="container" style="min-width: 300em; height: 30em; margin: 0 auto"></div>
