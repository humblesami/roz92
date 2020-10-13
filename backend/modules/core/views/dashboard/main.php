<script src="<?= Yii::getAlias('@web'); ?>/js/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script language="javascript">
$(function () {
	Highcharts.setOptions({
	 colors: ['#9f1320', '#ED561B', '#50B432', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
	});
});	
</script>
<style>
/* ---------------------------------------------------------------------- */
/*	Sparklines
/* ---------------------------------------------------------------------- */
.mini-stats {
	border-left: 1px solid #DDDDDD;
	list-style: none;
	margin: 0;
	padding: 0;
}
.mini-stats li {
	border-left: 1px solid #FFFFFF;
	border-right: 1px solid #DDDDDD;
	padding-bottom: 6px;
	text-align: center;
}
.mini-stats .sparkline_bar_good, .mini-stats .sparkline_bar_neutral, .mini-stats .sparkline_bar_bad {
	/* font-size: 12px; */
	/* font-weight: bold; */
	/* text-align: center; */
}
.mini-stats li:last-child {
	border-right: 0 none;
}

.mini-stats .values {
	font-size: 12px;
	padding: 10px 0;
}
.mini-stats .values strong {
	display: block;
	font-size: 18px;
	margin-bottom: 2px;
}
.mini-stats .sparkline_bar_good, .mini-stats .sparkline_bar_neutral, .mini-stats .sparkline_bar_bad {
	/* font-size: 12px; */
	/* font-weight: bold; */
	/* text-align: center; */
}
.mini-stats .sparkline_bar_good {
	color: #459D30;
}
.mini-stats .sparkline_bar_neutral {
	color: #757575;
}
.mini-stats .sparkline_bar_bad {
	color: #BA1E20;
}
.jqstooltip {
	width: auto !important;
	height: auto !important;
	padding: 2px 6px !important;
	background-color: rgba(0, 0, 0, 0.7) !important;
	border: 0 !important;
	border-radius: 3px;
}
/* ---------------------------------------------------------------------- */
/*	Easy Pie Chart
/* ---------------------------------------------------------------------- */
.easy-pie-chart {
	position: relative;
	text-align: center;
}
.easy-pie-chart .number {
	position: relative;
	display: inline-block;
	width: 70px;
	height: 70px;
	text-align: center;
}

.easy-pie-chart canvas {
	position: absolute;
	top: 0;
	left: 0;
}

.percent {
	display: inline-block;
	line-height: 70px;
	z-index: 2;
}
.percent:after {
	content: '%';
	margin-left: 0.1em;
	font-size: .8em;
}
.label-chart {
	color: #333333;
	font-size: 16px;
	font-weight: 300;
	display: inline;
	line-height: 1;
	padding: 0.2em 0.6em 0.3em;
	text-align: center;
	vertical-align: baseline;
	white-space: nowrap;
}
</style>
<div class="panel panel-default">
            <div class="panel-heading top-heading"><h2>Dashboard</h2>
            
            </div>
        	<div class="panel-body">
            
            

                    
                    
                                        
                    
                    
                    
                                       
		
                                
                    
                      
                                        
                                            
               
        	</div>
        </div>


    