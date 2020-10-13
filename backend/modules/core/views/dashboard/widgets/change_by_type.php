<script type="text/javascript">
$(function () {
    Highcharts.chart('change_by_type', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
		series: [{
            type: 'pie',
            name: 'Case Type',
            data: [['Content Aggregation', 9],['Re-do Research', 1],['Re-do Bullet', 6],['Collect competitor info', 15],['Change Attributes', 1],['Collect mfg#', 1],['Collect brand name', 1],['Provided UOM', 1],['Include Bullet label in bullets value', 1],['Remove 100 character limit', 1],['Re-Writing', 1]]
        }]

    });
});
    </script>

<div id="change_by_type" style="height: 330px; width: 100%; margin: 0 auto"></div>
