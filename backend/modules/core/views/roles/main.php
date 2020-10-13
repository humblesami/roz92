<?php
use yii\helpers\Html;
?>
<link rel="stylesheet" href="<?= Yii::getAlias('@web'); ?>/themes/basic/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
<script src="<?= Yii::getAlias('@web'); ?>/themes/basic/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>
  
    	<div class="top-content">
        <div class="row">
        	<div class="col-sm-10" >
	            <h3>Roles & Permissions</h3>
            </div>
            <div class="col-sm-2 text-right">
            
							<?php 
							$url = Yii::$app->urlManager->createUrl('/core/roles/create/');
							?>
            		        <a href="javascript:void(0)" class="red" data-xpop=".addFolder" onclick="load_popup('<?php echo $url?>','Create Role')">Create Role</a>             
            </div>
            
        </div>
        <div class="border-btm"></div>
        </div>
        
    	<div class="row" >	
        
        	<div class="col-sm-2 ht-auto-roles panel-scroll">
            	<h3>Available Roles</h3>
				
                   <div class="nav-two">
                    <ul>
                    <?php
                    foreach($roles_list as $role){
                ?>
                   	 <li <?php if($role['id'] == $role_id){echo 'class="active"';}?>>
                     <a class="accordion-toggle collapsed menu_builder_head_tgl" href="<?php echo Yii::$app->urlManager->createUrl('/core/roles/main/');?>?role_id=<?php echo $role['id'];?>"><?php echo $role['name'];?></a>
                     </li>
                      <?php }?> 
                    </ul>
                   </div>
                              
            </div>
   
            <div class="col-sm-4 ht-auto-roles panel-scroll border-left">
            	<h3 class="float-left"><?php echo $role_name;?></h3>
                <a class="red float-right" onclick="default_setting()" href="javascript:void(0)"><i class="fa fa-cog"></i> Roles Setting</a>
                <div class="clearfix"></div>

                            <div id="panel_tab3_example1" class="tab-pane active">
                                <div class="panel-group accordion-custom accordion-teal" id="accordion"> 

                                   
                             
                                                   
                    <?php foreach($menu_list as $menu){
							$menu_data = $menu['menu_data'];	
							$menu_html = $roles_mod->build_menu($menu_data,'p');
					?>
                    
                    
                   
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $menu['id'];?>">

													<i class="icon-arrow"></i>
													<?php echo $menu['name'];?>
												</a></h4>
											</div>
											<div id="collapse_<?php echo $menu['id'];?>" class="panel-collapse collapse">
												<div class="panel-body">
													<?php echo $menu_html;?>	
												</div>
											</div>
										</div>



	                    
                        
                        
                        
                    <?php }?>
                    </div>
                    </div>


            </div>

            <div class="col-sm-6 ht-auto-roles panel-scroll border-left">
            
            	<div id="feature_detail" class="feature_detail"></div>
            
            </div>
            
        </div>
    
		

<script language="javascript">
	function getFeatureDetail(feature_id){
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/feature_detail');?>?feature_id=" + feature_id + "&role_id="+ "<?php echo $role_id?>";		
		$("#feature_detail").load(url);
	}
	function default_setting(){
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/default_setting');?>?role_id="+ "<?php echo $role_id?>";		
		$("#feature_detail").load(url);
	}	
	
	function load_ff_list(feature_id)
	{
		
		
		if($("#body_" + feature_id).css('display') == "none"){
		
		//$("#sub_feature_" + feature_id ).html("Loading...");
		$("#sub_feature_" + feature_id ).html($("#pre_circle").html());
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/load_ff_list');?>?feature_id=" + feature_id + "&role_id="+ "<?php echo $role_id?>";
		$("#sub_feature_" + feature_id).load(url);
		
			$("#body_" + feature_id).show();
		}
		
		
	}

function checked_data(data_value,state){
    url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/assing_role_save')?>?data_value=" + data_value + "&state=" + state;
    $.get(url,{
    },
    function(data, textStatus){

    });
}


    
</script>    
    
    






