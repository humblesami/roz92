<script type="text/javascript">
$(function () {
    Highcharts.chart('case_by_type', {
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
            name: 'Case Type',
            colorByPoint: true,
            data: [{
                name: 'Change Request',
                y: 38
            }, {
                name: 'Issues',
                y: 36,
                sliced: true,
                selected: true
            }]
        }]
    });
});
    </script>

<div id="case_by_type" style="height: 330px; width: 100%; margin: 0 auto"></div>
