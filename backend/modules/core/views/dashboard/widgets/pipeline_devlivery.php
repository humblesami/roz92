<script language="javascript">
$(function () {
    Highcharts.chart('pipeline_delivery', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },

        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Count'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
		

		
        series: [{
            name: 'Pipeline',
            data: [49, 71, 106, 129, 144, 176, 135, 148, 216, 194, 95, 54]

        }, {
            name: 'Delivered',
            data: [83, 78, 98, 93, 106, 84, 105, 104, 91, 83, 106, 92]

        }]
    });
});
</script>

<div id="pipeline_delivery" style="height: 330px; width: 100%; margin: 0 auto"></div>