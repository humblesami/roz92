<script src="<?= $this->theme->baseUrl; ?>/js/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>
<script language="javascript">
$(function () {
	Highcharts.setOptions({
	 colors: ['#9f1320', '#ED561B', '#50B432', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
	});
});	
</script>


<div class="panel panel-default">
            <div class="panel-heading top-heading"><h2>Dashboard</h2>
            <div class="dashboard-nav">
                    	<a href="<?php echo  Yii::$app->urlManager->createUrl('/core/dashboard/batch/');?>">Batches</a>
                        <a href="<?php echo  Yii::$app->urlManager->createUrl('/core/dashboard/main/');?>">Deliveries</a>
                        <a class="active" href="<?php echo  Yii::$app->urlManager->createUrl('/core/dashboard/case/');?>">Cases</a>        
                    </div>
            </div>
        	<div class="panel-body">

                                
                      <div class="row">
	                      	<div class="col-sm-12">
                            
                            
                            
                            
						<div class="card">
								<div class="panel panel-default">
									
									<h3>CASE HISTORY</h3>

									
								</div>
								<div class="panel-body">
									<?php echo $this->render('widgets/case_history');?>
								</div>
                                </div>
							</div>                            
                            
                            		
    	                    </div>

	                      	

					<br>
                      <div class="row">
                      		
                            		
                                    
                                  
                                    
                            	
                            
                            <div class="col-sm-6">
                            
                            
						<div class="card">
								<div class="panel panel-default">
									
									<h3>CASE BY TYPE</h3>
									
								</div>
								<div class="panel-body">
									<?php echo $this->render('widgets/case_by_type');?>
								</div>
                                </div>
							</div>                            
	                            
                
                            
                            
                            
                            <div class="col-sm-6">
                            
                            
							<div class="card">
								<div class="panel panel-default">
									
									<h3>TOP QUESTIONS</h3>
									
								</div>
								<div class="panel-body">
									<?php echo $this->render('widgets/top_question');?>
								</div>
                                </div>
							</div>                            
	                            
                            </div>
            
                      
                      <br>


                      <div class="row">
                      		
                            		
                                    
                                  
                                    
                            	
                            
                            <div class="col-sm-6">
                            
                  <div class="card">
								<div class="panel panel-default">
									
									<h3>CHANGE REQUEST BY TYPE</h3>
									
								</div>
								<div class="panel-body">
									<?php echo $this->render('widgets/change_by_type');?>
								</div>
                                </div>
							</div>                            
	                  
                            
                            
                            
                            <div class="col-sm-6">
                            
                            
							<div class="card">
								<div class="panel panel-default">
									
									<h3>TOP CHANGE REQUESTS</h3>
									
								</div>
								<div class="panel-body">
									<?php echo $this->render('widgets/top_change_request');?>
								</div>
                                </div>
							</div>                            
	                            
                            </div>
                      </div>
                      
                      <br>
                      
                      
                      
                                        
                                            
               
        	</div>



    