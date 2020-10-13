<script type="text/javascript">
$(function () {
    Highcharts.chart('sku_deliver', {
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
            name: 'Count',
            data: [['Perfect Delivery', 41366],['Re-work Issues', 36122],['Re-work CR', 88612]]
        }]

    });
});
    </script>

<div id="sku_deliver" style="height: 330px; width: 100%; margin: 0 auto"></div>
