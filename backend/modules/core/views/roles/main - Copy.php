<?php
use yii\helpers\Html;

?>
<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
<link rel="stylesheet" href="assets/css/custom_menus.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">

<script language="javascript">
	function get_new_menu(){
		role_id = $("#role_id").val();
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/main')?>" + "&role_id=" + role_id;	
		document.location.href = url;
	}
	function expand_collaps(menu_id,feature_id,feature_name,menu_name){
		
		mdis = $("#li_id_"+ menu_id + " > div.toggle_body").css('display');
		
		if(mdis != "block"){
			mhtml = $("#d_data").html();
			mhtml	= mhtml.replace("mthis", menu_id);
			mhtml	= mhtml.replace("mfeature_name", feature_name);
			mhtml	= mhtml.replace("mfeature_id", feature_id);
			mhtml	= mhtml.replace("mfeature_id", feature_id);
			if(menu_name != ""){
				mhtml	= mhtml.replace("mmenu_name", menu_name);
			}else{
				mhtml	= mhtml.replace("mmenu_name", feature_name);
			}
			$("#li_id_"+ menu_id + " > div.dd-handle").after(mhtml);
		}else{
			$("#li_id_"+ menu_id + " > div.toggle_body").css('display','none');
		}
	}
	function remove_menu(menu_id){
		$("#li_id_" + menu_id).remove();
		UINestable.init()
	}
	function change_menu_name(menu_name, feature_id){
		value_id = feature_id + "_" + menu_name
		//$("#li_id_" + feature_id).attr("data-id", value_id);
		$("#li_id_" + feature_id).data('id',value_id);
		UINestable.init()
	}
	function search_menu(){
		search_value = $("#search_menu").val();	
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/menu_builder/search_menu/q')?>/" + search_value;
		$("#search_result").load(url);
	}
	
	
	
  function export_role(){

		
			url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/export_role/role_id/' . $role_id)?>";
			document.location.href = url;
		
	}	
  function import_role(){
		$("#import_role_div").show();
		
	}
  function update_role(){
		if($("#new_role_name").val() == ""){
			alert("Please, role name is required");
			$("#new_menu_name").focus();
			return false;
		}	  

		
		role_name = $("#new_role_name").val();
		dashboard_id = $("#dashboard_id").val();
        $csrfToken = '<?php echo Yii::$app->request->csrfToken ?>';
		menu_id = $("#menu_id").val();  
		$.post('<?php echo Yii::$app->urlManager->createUrl('/core/roles/update_role')?>', {role_id:'<?php echo $role_id;?>',role_name:role_name,dashboard_id:dashboard_id,menu_id:menu_id,<?php echo Yii::$app->request->csrfParam;?>: $csrfToken}, function(data) {
            document.location.href = document.location.href;
        });
		
	}
	
  function add_role(){

		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/assign_role_save')?>";
		$.post(url,
		$("#features_add_to_menus").serialize(),
	
		function(data){
			document.location.href = document.location.href;
			
		});
	}	
	function create_new_menu(){
		if($("#new_role_name").val() == ""){
			alert("Please, role name is required");
			$("#new_menu_name").focus();
			return false;
		}
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/create_role_save')?>";
		$.post(url,
		$("#create_menu").serialize(),
	
		function(data){
			document.location.href = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/main/role_id')?>/" + data;
			
		});		
	}
	function crate_new_menu(){
		document.location.href = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/main/role_id/0')?>";
	}
	function checked_data(data_value,state){
		
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/assing_role_save')?>/data_value/" + data_value + "/state/" + state;
		$.get(url,{
		},
		function(data, textStatus){
			
		});		
	}
	



	function load_ff_list(feature_id)
	{
		
		
		if($("#body_" + feature_id).css('display') == "none"){
		
		//$("#sub_feature_" + feature_id ).html("Loading...");
		$("#sub_feature_" + feature_id ).html($("#pre_circle").html());
		url = "<?php echo Yii::$app->urlManager->createUrl('/core/roles/load_ff_list/feature_id');?>/" + feature_id + "/role_id/"+ "<?php echo $role_id?>";
		$("#sub_feature_" + feature_id).load(url);
		
			$("#body_" + feature_id).show();
		}
		
		
	}


</script>
<?php 
    

	if (Yii::$app->session->hasFlash('menu_update')): 
		echo '<div class="alert alert-success"><button data-dismiss="alert" class="close">×</button>'.Yii::app()->user->getFlash('menu_update').'</div>'; 
	endif;
?>

    

<div id="container" class="assign_menu" >
		
							<input type="hidden" id="nestable-output">
							
		
						
                    <div class="form-horizontal custom_menus">
                    	<div class="form-group">
                                <label class="control-label col-sm-2 crt_cus">
                                    Select a role to edit :
                                </label>
                                <div class="col-sm-2">

								<?php
                                echo Html::dropDownList('role_id', $role_id, $roles_list, array('empty' => 'Select a Role','class'=>'form-control menu_top_field search-select','id'=>'role_id'));
								?>
									
                                </div>
                                
                                <button class="col-sm-1 btn btn-azure" type="button" onclick="get_new_menu()">
                                	Select
                                </button>
                                
                                <div class="col-sm-3 crt_new">
                                	or 
                                    <a class=""  href="javascript:void(0)" onclick="crate_new_menu()">
                                    	Create a new role
                                    </a>
                                </div>
                                
                                <div class="col-sm-3">
                                <?php if($role_id != 0){?>
                                        <button class="btn btn-azure crdt_role" style="width:30%" type="button" onclick="import_role()"> 
                                        	Import Role
                                        </button>
                                        
                                        <button class="btn btn-azure crdt_role " style="width:30%" type="button" onclick="export_role()"> 
                                        	Export Role
                                        </button>     
                                        
                                        <?php }?>                           
                                        
                                        <div id="import_role_div" style="display:none">
                                	
                                    
                                    
<div class="col-md-12">
                                        				<?php 

															
    $attributes = array('class' => 'form', 'id' => 'frm_change_pic','name' => 'frm_change_pic','enctype'=>'multipart/form-data');
							
					
				echo Html::beginForm(Yii::$app->urlManager->createUrl('/core/roles/import_role_save'),'post',$attributes);
					echo Html::hiddenInput('role_id', $role_id);
															
					
														?>
                                        
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="input-group">
														<div class="form-control uneditable-input">
															<i class="fa fa-file fileupload-exists"></i>
															<span class="fileupload-preview"></span>
														</div>
														<div class="input-group-btn">
															<div class="btn btn-light-grey btn-file">
																<span class="fileupload-new"><i class="fa fa-folder-open-o"></i> Select file</span>
																<span class="fileupload-exists">
                                                                	<i class="fa fa-folder-open-o"></i> Change
                                                                	

                                                                   
                                                                </span>
																<?php // echo CHtml::activeFileField($model_upload, 'userfile'); ?>
															</div>
															<a href="#" class="btn btn-light-grey fileupload-exists" data-dismiss="fileupload">
																<i class="fa fa-times"></i> Remove
															</a>
                                                            
                                                                                                                                
                                                      
														</div>
													</div>        
                                                    </div>
                                                                  <button type="submit" class="btn btn-azure crdt_role" style="width:40px;" >
                                                                    Save
                                                                    </button>                                
                                        	 <?php echo Html::endForm(); ?>
                                            </div>                                    
                                    
                                    
                                	
                                </div>
                                </div>
                                
                            </div>
                    </div>
                    
                    <div class="clearfix"></div>



                   <div class="clear"></div>
	<!-- start: PAGE CONTENT -->


					<div class="row">
						
                        <div class="col-md-4">
				<?php 

					$attributes = array('class' => 'form-horizontal', 'id' => 'features_add_to_menus','name' => 'features_add_to_menus','role' => 'form');
					echo Html::beginForm('','post',$attributes);
					echo Html::hiddenInput('role_id', $role_id);
				?>                        
                       
							<!-- start: DRAGGABLE HANDLES 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading custom_panel_heading">
									Features
								</div>
								<div class="panel-body">
                                	<div class="tabbable">
                                       <div class="navbar-collapse collapse top-nav border0">
												<ul class="nav navbar-nav menu_builder_tab" id="myTab4">
                                            <li class="active">
                                                <a data-toggle="tab" href="#panel_tab3_example1">
                                                    Features
                                                </a>
                                            </li>
                                            <li class="">
                                                <a data-toggle="tab" href="#panel_tab3_example2">
                                                    Search
                                                </a>
                                            </li>
                                        </ul>
                                        </div>
                                        
                                        <div class="tab-content">
                                            <div id="panel_tab3_example1" class="tab-pane active">
                                            <div class="panel-group accordion-custom accordion-teal" id="accordion">	
                                
                                               <?php
                                               $min = "";
                                                foreach($module_list as $row)
                                                {
                                                    
                                                    
                                                    
                                                ?>
                                                
                                                    <div class="panel panel-default row">
                                                    <div class="panel-heading menu_builder_head">
                                                        <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $row['id'];?>">
                                                            <i class="ico-plus"></i>
                                                            <?php echo $row['name'];?>
                                                        </a></h4>
                                                    </div>
                                                    <div id="collapse_<?php echo $row['id'];?>" class="panel-collapse collapse <?php echo $min?>">
                                                        <div class="panel-body" >
                                                          <div class="leave_accor">
                                                            <ul class="dd-list">
                                                            <?php 
                                                                $min = "";																																		
                                                                $feature_list	 =	$roles_mod->feature_list($row['id']);
                                                                foreach($feature_list as $f_row) { 
                                                            ?>
                                                                <li class="dd-item" data-id="<?php echo $f_row['id'];?>">
                                                                    <div>
                                                                        <input type="checkbox" name="role_sel[]" value="<?php echo $f_row['id']  . "_" . $row['id']; ?>">
                                                                        <?php echo $f_row['name']; ?>
                                                                    </div>
                                                                </li>
                                                            <?php }?>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                                    
                                                <?php }?>   
                                                                    
                                                </div>  
                                            </div>
                                            
                                            <div id="panel_tab3_example2" class="tab-pane">
                                                <div class="form-group cust_search">
                                                    <input type="text" data-original-title="Type Here" data-rel="tooltip" placeholder="Type Here" title="" name="search_menu" id="search_menu" data-placement="top" class="form-control tooltips" >
                                                    <a class="btn btn-azure" href="javascript:void(0)" onclick="search_menu()">
                                                        <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                                <div id="search_result">
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
									<?php if($role_id != 0){?>
                                        <div class="bottom-action col-sm-12">                    
                                            <button type="button" class="btn btn-azure" onclick="add_role()">Add to role</button>
                                    
                                        </div>
                                    <?php }?>
                                                            
								</div>
							</div>
							<!-- end: DRAGGABLE HANDLES 1 PANEL -->
                             <?php echo Html::endForm(); ?>
						</div>
                        
                        
                        
                        
                        
						<div class="col-md-8">

                           
                         
                        
							<!-- start: DRAGGABLE HANDLES 2 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading custom_panel_heading menu_rite_main" style="height:auto !important;">
                                
				<?php 


                             if($role_id == 0){
	                            $attributes = array('class' => 'form-horizontal', 'id' => 'create_menu','name' => 'create_menu');
							 }else{
								
	                            $attributes = array('class' => 'form-horizontal', 'id' => 'features_assigned_to_menus','name' => 'features_assigned_to_menus');								 
							 }
					
					echo Html::beginForm('','post',$attributes);
					echo Html::hiddenInput('role_id', $role_id);
				?>                                  
                                            <label class="control-label col-sm-3 menu_name"> Role Name : </label>
                                            <span class="col-sm-4">
                                                <input type="text" data-original-title="Edit Role Name" data-rel="tooltip" placeholder="Display Menu Name Here" title="" value="<?php echo $role_name;?>" data-placement="top" class="form-control tooltips menu_name_display" id="new_role_name" name="new_role_name">
                                            </span>
                                    
                                    
                                    
                                    <span class="col-md-1">
                                    <?php if($role_id == 0){?>
                                    	<button class="btn btn-azure crt_role" type="button" onclick="create_new_menu()"> 
                                        	Create Role
                                        </button>
                                    <?php }else{?>    
                                    	<button class="btn btn-azure crt_role" type="button" onclick="update_role()"> 
                                        	Update
                                        </button>

                                    <?php }?>
                                    
                                    </span>
                                    
                                    <div class="clearfix"></div>
                                    
									<?php if($role_id != 0){?>
                                            <label class="control-label col-sm-3 menu_name" style="margin-top:13px;"> Dashboard : </label>
                                            <span class="col-sm-4" style="margin-left:-40px; margin-top:10px;">
                                                <?php echo Html::dropDownList('dashboard_id',$dashboard_id, $dashboard_list,array('empty' => 'Select Dashboard','class'=>'form-control','id'=>'dashboard_id','required' => true));?>
                                            </span>
                                        <div class="clearfix"></div>
                                        
                                        
                                            <label class="control-label col-sm-3 menu_name" style="margin-top:13px;"> Menu : </label>
                                            <span class="col-sm-4" style="margin-left:-40px; margin-top:10px;">
                                                <?php echo Html::dropDownList('menu_id',$menu_id, $menu_list,array('empty' => 'Select Menu','class'=>'form-control','id'=>'menu_id','required' => true));?>
                                            </span>
                                        <div class="clearfix"></div>
                                    <?php } ?>
                                    
                                    
                                    <?php echo Html::endForm(); ?>
                                    
								</div>
                                
                                
                                
								<div class="panel-body">
                                
                                
                                
                                    <div class="dd nestable">
                                        <?php foreach($parent_feature as $a_row){?>
                                        <div class="panel panel-default">
                                        <!-- Heading Start -->
                                        <div class="panel-heading custom_panel_heading">
                                            <label class="control-label role_panel_label menu_name"><?php echo $a_row['name'];?></label>                                                
                                            <div class="panel-tools">
                                                <a class="btn btn-xs btn-link panel-collapse expand"  href="javascript:void(0)" onclick="load_ff_list('<?php echo $a_row['id'];?>')">	
                                                </a>
                                            </div>                                                
                                        </div>
                                        <!-- Heading End -->
                                
                                        <div class="panel-body" style="display:none;" id="body_<?php echo $a_row['id'];?>">
                                        
                                        	
                                            <div class="dd nestable">
                                            	<?php
                                                    
                                                    $mcheck = "";
                                                    $check_data = $roles_mod->check_data($a_row['id'], $role_id);
                                                    if($check_data){
                                                        $mcheck = "checked";
                                                    }
                                                    
                                                    ?>
                                                    <div class="make-switch switch-small pull-right mySwitch"  data-on="danger" data-off="info">
                                                        <input value="<?php echo $a_row['module_id'] ."_" . $a_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                    </div><br />
<br />

                                                    
                                                   
                                                   

                                                    <?php
                                                    	$function_list = $roles_mod->funciton_list($a_row['id']);

														foreach($function_list as $fn_row){
													?>
                                                    	<div class="col-sm-4"><?php echo $fn_row['name'];?></div>
                                                        <div class="col-sm-8">
                                                    		<?php
                                                            
															$mcheck = "";
															$check_data = $roles_mod->check_data($fn_row['id'], $role_id);

															if($check_data){
																$mcheck = "checked";
															}
															
															?>

                                                            <div class="make-switch mySwitch"  data-on="primary" data-off="info">
                                                           
                                                                <input value="<?php echo $fn_row['module_id'] ."_" . $fn_row['id'] . "_" . $role_id?>" type="checkbox" <?php echo $mcheck;?> >
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                    <!-- Feature Funcion End -->                                                    
                                                    
                                                    <!-- Feature Funcion End -->

                                            </div>
                                            <div id="sub_feature_<?php echo $a_row['id'];?>"></div>
                                            
                                        	</div>                                    
                              			</div>          
                                        <?php }?>
                                    	</div>
                                    </div>
								</div>
							<!-- end: DRAGGABLE HANDLES 1 PANEL -->
                            
						</div>
					</div>

					<!-- end: PAGE CONTENT-->

              

                    

<div id="orderResult"></div>
<div id="d_data" style="display:none">
<div class="toggle_body">
<input type="hidden" name="feature_id[]" value="mfeature_id">
                                                        	
                                                            <div class="col-md-12 toggle_inner">
                                                            	<div class="form-group">
                                                                	<label class="control-label col-sm-12 menu_name"> Menu Name : </label>
                                                                    <span class="col-md-12">
                                                                    	<input type="text" data-original-title="Edit Menu Name" data-rel="tooltip" placeholder="Menu Name" value="mmenu_name" onblur="change_menu_name(this.value,mfeature_id)" title="" data-placement="top" class="form-control tooltips menu_name_display" id="menu_name" name="menu_name[]">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12 toggle_inner">
                                                            	<div class="form-group">
                                                                	<label class="control-label col-sm-12 menu_name"> Feature Name : </label>
                                                                    <span class="col-md-12">
                                                                    	<input type="text" data-original-title="Featured Name" data-rel="tooltip" placeholder="Featured Name" value="mfeature_name" title="" data-placement="top" class="form-control tooltips menu_name_display" id="feature_name" name="feature_name[]">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                            	<ul class="togle_nav">
                                                                	<li>
                                                                    	<a href="javascript:void(0)" onclick="remove_menu(mthis)">
                                                                            Remove
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                    	<a href="#">
                                                                            Cancel
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            
                                                        </div>       
</div>   

<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

<script>
	jQuery(document).ready(function() {
		jQuery(".search-select").select2();
	});
</script>                                                            


<link rel="stylesheet" href="assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />
<script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.js"></script>     
<script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>


<script>
    $(document).ready(function() {	
			$('.mySwitch').on('switch-change', function (e, data) {
				var $el = $(data.el)
				  , value = data.value;
				 
				 value = data.el.val();
				if(data.value == true){
					
					checked_data(value,'1')	;
				}else{
					checked_data(value,'0')	;
				}
			});	
			
	});	
</script>