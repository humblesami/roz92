<script language="javascript">
$(function () {
    Highcharts.chart('batch_owner', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
       
        xAxis: {
            categories: ['Joseph Woods','Michael Hawkins ','Diane Snyder','Sharon Williamson','Harry Franklin','Jeffrey Lawson']
			,
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
                name: 'Owner',
                data: [57,16,54,33,65,22]
    
            }]

    });
});
</script>

<div id="batch_owner" style="height: 330px; width: 100%; margin: 0 auto"></div>