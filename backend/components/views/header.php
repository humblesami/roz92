<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->

            	<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->
					<a class="navbar-brand clearfix" href="<?php echo Yii::$app->urlManager->createUrl('/core/dashboard/main');?>">
						<img src="<?= Yii::getAlias('@web') ?>/uploads/company/<?php echo $company_logo?>" alt="Logo" title="Logo" />
					</a>
					<!-- end: LOGO -->
				</div>

				<div class="navbar-header-left">
                <div class="navbar-tools" id="noti">
                <div class="role-name"><h2><?php echo $portal_name;?></h2></div>

					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">

						<li class="dropdown current-user">
                        <span clafss="username">Welcome, </span>
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								
								<span clafss="username"></span>
								<i class="clip-chevron-down"></i>
							</a>
                            
							<ul class="dropdown-menu">
								
								<li>
									<a href="#" target="_blank">
										<i class="clip-calendar"></i>
										&nbsp;Change Password
									</a>
								</li>
                                
								<li class="divider"></li>

								<li>
									<a href="<?php echo Yii::$app->urlManager->createUrl('/core/login/logout')?>">
										<i class="clip-exit"></i>
										&nbsp;Log Out
									</a>
								</li>
							</ul>
						</li>
                        <li class="setting-tab">
                        <a  href="<?php echo Yii::$app->urlManager->createUrl('/core/settings');?>">
								<i class="clip-settings"></i>
       					</a>
                        </li>
						<!-- end: USER DROPDOWN -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
                    

				
				<!-- start: SIDEBAR -->
                <div class="clearfix"></div>
				<div class="navbar-collapse collapse top-nav">
					<div class="col-sm-12">

                    </div>
                     <div class="col-sm-2" style="margin-top:8px;">
						
                     </div>

				</div>
                                    
				</div>
        </div>

</div>            