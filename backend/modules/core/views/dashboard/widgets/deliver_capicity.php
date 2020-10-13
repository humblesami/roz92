
<script language="javascript">
$(function () {

    Highcharts.chart('container', {

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: ''
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#fff']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#fff'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 0,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#cbd6ea',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

	    // the value axis
	    yAxis: {
	        min: 0,
	        max: '200000',
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 30,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 2,
	            rotation: 'auto'
	        },
	        title: {
	            text: 'Monthly Production Capacity'
	        },

		
		plotBands: [{
                from: 0,
                to: '30000',
                color: '#3945e7' // yellow
            },{
                from: '30000',
                to: '60000',
                color: '#07a5b1' // green
            }, {
                from: '60000',
                to: '80000',
                color: '#61a907' // yellow
            }, {
                from: '80000',
                to: '90000',
                color: '#9e0d10' // red
            }]
        },
	
	    series: [{
	        name: 'Speed',
	        data: [104332],
	        tooltip: {
	            valueSuffix: ' Product Delivered'
	        }
	    }]

    },
    // Add some life
    function (chart) {
        if (!chart.renderer.forExport) {
            setInterval(function () {
                var point = chart.series[0].points[0],
                    newVal,
                    inc = Math.round((Math.random() - 0.5) * 20);

                newVal = point.y + inc;
                if (newVal < 0 || newVal > 200) {
                    newVal = point.y - inc;
                }

                point.update(newVal);

            }, 3000);
        }
    });
});



</script>
<div id="container" style=" height: 330px; width: 100%; margin: 0 auto"></div>
