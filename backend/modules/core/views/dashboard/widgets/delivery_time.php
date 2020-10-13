<script type="text/javascript">
$(function () {
    Highcharts.chart('delivery_time', {
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
            data: [['On Time', 78],['1 - 3 Days Late', 0],['4 - 7 Days Late', 0],['7 - 15 Days Late', 0],['15+ Days Late', 34]]
        }]

    });
});
    </script>

<div id="delivery_time" style="height: 330px; width: 100%; margin: 0 auto"></div>
