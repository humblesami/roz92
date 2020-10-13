<script type="text/javascript">
$(function () {


    Highcharts.chart('pipeline', {
        chart: {
            type: 'funnel',
            marginRight: 100
        },
        title: {
            text: '',
            x: -50
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                    softConnector: true
                },
                neckWidth: '30%',
                neckHeight: '25%'

                //-- Other available options
                // height: pixels or percent
                // width: pixels or percent
            }
        },
        legend: {
            enabled: false
        },
        series: [{
            name: 'Count',
	          data: [['Open - Created', 8000],['Open - In Aggregate Collection', 2421],['Open - In Review', 4921],['Open - Ready for Aggregate Collection', 1500],['Open - Ready for Content Collection', 2000]]
            		  
        }]
    });
});
    </script>

<div id="pipeline" style="height: 330px; width: 70%; margin: 0 auto"></div>
