<script language="javascript">
$(function () {
    Highcharts.chart('case_history', {
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
            name: 'Question',
            data: [10, 12, 9, 10, 12, 15, 10, 15, 10, 8, 11, 12]

        }, {
            name: 'Issues',
            data: [5, 11, 15, 10, 9, 0, 3, 7, 6, 12, 14, 15]

        }, {
            name: 'Change Request',
            data: [6, 5, 12, 14, 8, 7, 5, 15, 11, 19, 25, 21]

        }]
    });
});
</script>

<div id="case_history" style="height: 330px; width: 100%; margin: 0 auto"></div>